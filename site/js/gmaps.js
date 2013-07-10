var N = 20;

function getTime()
{
    var d = new Date();

    var curr_hour = d.getHours();
    var curr_min = d.getMinutes();
    var curr_sec = d.getSeconds();

    return (curr_hour + ":" + curr_min + ":" + curr_sec);
}

function roundNum(num, dec)
{
    var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);
    return result;
}

function GMapsHandler(divMap, divDir, divError, divItems, imgBackground, pointCenter, siteid, label)
{
    var _divMap = divMap;
    var _divError = divError;
    var _divDir = divDir;
    var _divItems = divItems;
    var _pointStartCenter = pointCenter;
    var _siteid = siteid;
    var _label = label;
    if ((pointCenter == null) || (pointCenter == ""))
    {
        _pointStartCenter = new GLatLng(47.61,-122.33);     // default to Seattle, why not?
    }
    _divMap.style.backgroundImage = imgBackground;

    // internal variables
    var _rgLocations = [];
    var _markerManager = new MarkerManager();
    var _gAjax = null;
	var _lastLoc = null;

    // Display the map, with some controls and set the initial location
    var _gmap = new GMap2(_divMap);
    // _gmap.addControl(new YSliderControl());
    var _geocoder = new GClientGeocoder();
    _gmap.addControl(new GLargeMapControl());
    _gmap.addControl(new GMapTypeControl());
    _gmap.setCenter(_pointStartCenter,5);
    _gmap.addControl(new GOverviewMapControl(new GSize(125,125)));

    // === create a GDirections Object ===
    var _gdir = new GDirections(null, _divDir);
    GEvent.addListener(_gdir, "error", function() {_showMessage(_gdir.getStatus().code + ": " + _gdir.getStatus().request);})
    var _bounds = new GLatLngBounds();
    var rgMarkerImgs = {start : "img/dd-start.png", current : "img/yellow-dot.png",
                        normal : "img/red-dot.png", hover : "img/hover.png"};

    // Utility functions
    function _showError(fnName, e)
    {
        if (_divError != null)
        {
            _divError.innerHTML += "<br />An Error has occurred in method " + fnName + ": " + e.message;
        }
    }

    function _showMessage(msg)
    {
        if (_divError != null)
        {
            _divError.innerHTML += "<br />Message: " + msg + " at " + getTime();
        }
    }

    // parse the given XML file to construct our internal array of locations
    function _loadFromXmlFile(file, fnCallback)
    {
        try
        {
            // Read the data from the file
            GDownloadUrl(file, function(doc)
             {
                var xmlDoc = GXml.parse(doc);
                var markers = xmlDoc.documentElement.getElementsByTagName("marker");

                for (var i=0; i < markers.length; i++)
                {
                    var loc = markers[i].getAttribute("loc");
                    var html = markers[i].getAttribute("html");
                    var day = markers[i].getAttribute("day");
                    var dtTime = markers[i].getAttribute("datetime");
                    _rgLocations[i] = new Location(loc, day, dtTime, html);
                }
                _showMessage("done reading");
                fnCallback();
             }
            );
        }
        catch (e)
        {
            _showError("_loadFromXmlFile", e);
        }
    }

    function _showRoute(rgPts, lastPoint)
    {
        try
        {
            function processNext(locManager, line)
            {
                if (line != null)
                {
                    _showMessage("processNext: displaying a line");
                    _gmap.addOverlay(line);
                }

                var pointsContainer = locManager.GetNextPointsContainer();
                if (pointsContainer == null)        // we're done
                {
                    _showMessage("route is displayed");
		    _openMarkerExternal(_lastLoc.name, false);		// open the last marker
                    
                    // update center point
                    if (!PointsEqual(_pointStartCenter, lastPoint))
                    {
                        if (_gAjax == null)
                        {
                            var _gAjax = new AJAXUtil();
                        }
                        var paramString = "center=\"" + roundNum(lastPoint.lat(),2) + "," + roundNum(lastPoint.lng(),2) + "\"&siteid=" + _siteid;;
                        if (!_gAjax.Post("updatemaster.php", paramString, _handleResponse))
                        {
                            _showMessage("processNext failed to send the request");
                        }
                    }

                    _storePts(locManager);
                }
                else
                {
                    var rgContainerPoints = pointsContainer.GetPoints();
                    if ((rgContainerPoints == null) || (rgContainerPoints.length < 2))
                    {
                        _showMessage("less than two points in this container, sending in null");
                        processNext(locManager, null);
                    }
                    else
                    {
                        if (pointsContainer.Type() == STRAIGHT)
                        {
                            _showMessage("sending in a straight Polyline");
                            var myopts = {geodesic:true};       // BUGBUG - check for flights specifically, otherwise any lines in non-directions regions will become geodesic
                            processNext(locManager, new GPolyline(pointsContainer.GetPoints(),null,null,null,myopts));
                        }
                        else
                        {
                            _showMessage("asking for directions");
                            var opts = {getPolyline:true};
                            // loadFromWayPoints should eventually call right back to here via the listener defined below
                            _gdir.loadFromWaypoints(pointsContainer.GetPoints(), opts);
                        }
                    }
                }
            }

            _showMessage("computing and showing the route");
            var locManager = new LocationManager(rgPts, _rgLocations, _showMessage, _showError);
            if (!locManager.ParseLocations())       // false == we didn't find any new (non-cached) locations
            {                                       // so, just use the previously cached route line
                var myopts = {geodesic:true};       // BUGBUG - check for flights specifically, otherwise any lines in non-directions regions will become geodesic
                var line = new GPolyline(rgPts,null,null,null,myopts);
                _gmap.addOverlay(line);
		_openMarkerExternal(_lastLoc.name, false);
                _addNewLocations();     // there may be location-less locations we should keep track of
            }
            else
            {
                // 1st: the line built from pre-cached points
                var rgCachedPoints = locManager.GetCachedPoints();
                if (rgCachedPoints.length > 0)
                {
                    _showMessage("displaying a cached Polyline");
                    var cacheopts = {geodesic:true};       // BUGBUG - check for flights specifically, otherwise any lines in non-directions regions will become geodesic
                    var lineCached = new GPolyline(rgCachedPoints,null,null,null,cacheopts);
                    _gmap.addOverlay(lineCached);
                }
                // now plot the rest
                GEvent.addListener(_gdir, "load", function()
                {
                    try
                    {
                        _showMessage("sending in a computed Polyline");
                        var polyline = _gdir.getPolyline();
                        locManager.SetPolyline(polyline);
                        processNext(locManager, polyline);
                    }
                    catch(e)
                    {
                        _showError("_showRoute", e);
                    }
                });
                locManager.StartIterator();
                processNext(locManager, null);
            }
        }
        catch (e)
        {
            _showError("_showRoute", e);
        }
    }

    // if AppendOnly, just go through GetNextPointsContainer,
    // if not, regenerate everything, starting with GetCachedPoints
    function _storePts(locManager)
    {
        try
        {
            function IncrementCurrent(iCur, update)
            {
                if (iCur < _rgLocations.length)
                {
                    var lastPoint = _rgLocations[iCur].point;
                    var ptIndex = _rgLocations[iCur].ptIndex;
                    iCur++;
                    while (iCur < _rgLocations.length)
                    {
                        // is this point a duplicate of the one before?
                        if (_rgLocations[iCur].duplicate && _rgLocations[iCur].PointEquals(lastPoint))
                        {
                            _showMessage("skipping duplicate: " + _rgLocations[iCur].name);
                            if (update)
                            {
                                _rgLocations[iCur].ptIndex = ptIndex;
                                _rgLocations[iCur].ForceUpdate(true);
                            }
                            iCur++;
                        }
                        else
                        {
                            break;
                        }
                    }
                }
                return iCur;
            }

            locManager.StartIterator();

            var paramString = "&pts=";
            var url;
            var rgPoints;
            var iCur;
            var point;
            var iIndex, i, k;
            if (locManager.IsAppendOnly())        // skip ahead to the new points
            {
                _showMessage("append only");
                url = "ptsappend.php";
                for (var loc=0; loc<_rgLocations.length; loc++)
                {
                    if (_rgLocations[loc].newLocation)
                    {
                        iCur = loc;
                        break;
                    }
                }

                // if there are no cached points, start at 0, not -1
                iIndex = Math.max(0, locManager.GetCachedPoints().length-1);
            }
            else
            {
                url = "ptsupdate.php";
                iCur = iIndex = 0;
                
                rgPoints = locManager.GetCachedPoints();
                for (var j=0; j<rgPoints.length; j++)
                {
                    point = rgPoints[j];
                    paramString += "X(" + roundNum(point.lat(),2) + "," + roundNum(point.lng(),2) + "),";
                    if (_rgLocations[iCur].PointEquals(point))
                    {
                        iCur = IncrementCurrent(iCur, false);
                    }
                    iIndex++;
                }
            }

            var pointsContainer = locManager.GetNextPointsContainer();
            while (pointsContainer != null)
            {
                var rgPts = pointsContainer.GetPoints();
                if ((rgPts != null) && (rgPts.length == 1))
                {
                    paramString += "X(" + roundNum(rgPts[0].lat(),2) + "," + roundNum(rgPts[0].lng(),2) + "),";
                }
                else
                {
                    var type = pointsContainer.Type();
                    var incr = (type == DIR) ? N : 1;
                    for (i = 0; pointsContainer.IsValidIndex(i); i=i+incr)
                    {
                        point = pointsContainer.GetIndexPoint(i);
                        if (point == null)
                        {
                            continue;
                        }
                        // for Directions, get every Nth vertex, for Polylines, get every vertex
                        paramString += "X(" + roundNum(point.lat(),2) + "," + roundNum(point.lng(),2) + "),";

                        if (iCur >= _rgLocations.length)
                        {
                            continue;
                        }
                        if (_rgLocations[iCur].PointEquals(point))
                        {
                            _showMessage("found " + _rgLocations[iCur].name);
                            _rgLocations[iCur].ptIndex = iIndex;
                            _rgLocations[iCur].ForceUpdate(true);
                            iCur = IncrementCurrent(iCur, true);
                        }
                        iIndex++;

                        if (type == DIR)
                        {
                            // and all the vertices that correspond to the actual city locations (only applicable to directions)
                            for (k=i+1; (k<(i+incr) && pointsContainer.IsValidIndex(k)); k++)
                            {
                                if (iCur >= _rgLocations.length)    // we found a match, but it wasn't actually the last point (rounding of coordinates may cause this)
                                {
                                    break;
                                }
                                point=pointsContainer.GetIndexPoint(k);
                                if (_rgLocations[iCur].PointEquals(point))
                                {
                                    paramString += "X(" + roundNum(point.lat(),2) + "," + roundNum(point.lng(),2) + "),";
                                    _showMessage("found " + _rgLocations[iCur].name);
                                    _rgLocations[iCur].ptIndex = iIndex;
                                    _rgLocations[iCur].ForceUpdate(true);
                                    iCur = IncrementCurrent(iCur, true);
                                }
                                iIndex++;
                            }
                        }
                    }
                }

                pointsContainer = locManager.GetNextPointsContainer();
            }

            _showMessage("finito");
            // take care of duplicates at the end
            IncrementCurrent(iCur, true);

            if (paramString != "&pts=")
            {
                if (_gAjax == null)
                {
                    var _gAjax = new AJAXUtil();
                }
                _showMessage(paramString);
                paramString += "&siteid=" + _siteid;
                if (!_gAjax.Post(url, paramString, _handleResponse))
                {
                    _showMessage("_storePts failed to send the request");
                }
            }

            _addNewLocations();
            _updateNewLocations();
        }
        catch (e)
        {
            _showError("_storePts", e);
        }
    }

    function _addNewLocations()
    {
        try
        {
            _showMessage("adding new Locations");
            var paramString = "";
            for (var iLoc = 0; iLoc < _rgLocations.length; iLoc++)
            {
				_showMessage(_rgLocations[iLoc].name);
                if (_rgLocations[iLoc].LocationLess())
                {
                    if (_rgLocations[iLoc].point == null)
                    {
                        paramString += (paramString != "" ? "&" : "") +
                                       "locs[" + iLoc + "][dt]="  + _rgLocations[iLoc].datetimeOriginal +
                                       "&locs[" + iLoc + "][loc]="  + _rgLocations[iLoc].name +
                                       "&locs[" + iLoc + "][txt]="  + _rgLocations[iLoc].html +
                                       "&locs[" + iLoc + "][lat]="  + "-1" +
                                       "&locs[" + iLoc + "][lng]="  + "-1" +
                                       "&locs[" + iLoc + "][pti]="  + "-1" +
                                       "&locs[" + iLoc + "][sid]="  + _siteid;
                    }
                }
                else
                {
                    if (!_rgLocations[iLoc].NeedUpdate())
                    {
                        continue;
                    }
                    paramString += (paramString != "" ? "&" : "") +
                                   "locs[" + iLoc + "][dt]="  + _rgLocations[iLoc].datetimeOriginal +
                                   "&locs[" + iLoc + "][loc]="  + _rgLocations[iLoc].name +
                                   "&locs[" + iLoc + "][txt]="  + _rgLocations[iLoc].html +
                                   "&locs[" + iLoc + "][lat]="  + _rgLocations[iLoc].point.lat() +
                                   "&locs[" + iLoc + "][lng]="  + _rgLocations[iLoc].point.lng() +
                                   "&locs[" + iLoc + "][pti]="  + _rgLocations[iLoc].ptIndex +
                                   "&locs[" + iLoc + "][sid]="  + _siteid;
                }
            }
            if (paramString != "")
            {
                _showMessage(paramString);
                if (_gAjax == null)
                {
                    var _gAjax = new AJAXUtil();
                }
                if (!_gAjax.Post("locadd.php", paramString, _handleResponse))
                {
                    _showMessage("_addNewLocations failed to send the request");
                }
            }
        }
        catch(e)
        {
            _showError("_addNewLocations", e);
        }
    }

    function _updateNewLocations()
    {
        try
        {
            _showMessage("updating new Locations");
            var paramString = "";
            for (var iLoc = 0; iLoc < _rgLocations.length; iLoc++)
            {
                if (!_rgLocations[iLoc].NeedUpdate())
                {
                    continue;
                }
                paramString += (iLoc > 0 ? "&" : "") +
                                "locs[" + iLoc + "][id]=" + _rgLocations[iLoc].id +
                               "&locs[" + iLoc + "][lat]="  + _rgLocations[iLoc].point.lat() +
                               "&locs[" + iLoc + "][lng]="  + _rgLocations[iLoc].point.lng() +
                               "&locs[" + iLoc + "][pti]="  + _rgLocations[iLoc].ptIndex;
            }
            if (paramString != "")
            {
                if (_gAjax == null)
                {
                    var _gAjax = new AJAXUtil();
                }
                if (!_gAjax.Post("locupdate.php", paramString, _handleResponse))
                {
                    _showMessage("_updateNewLocations failed to send the request");
                }
            }
        }
        catch(e)
        {
            _showError("_updateNewLocations", e);
        }
    }

    function _openMarkerExternal(name, scroll)
    {
        try
        {
            var marker = _markerManager.GetMarker(name, null);
            _openMarker(marker, 0, scroll);
        }
        catch (e)
        {
            _showError("_openMarkerExternal", e);
        }
    }

    // show a marker info window
    function _openMarker(marker, index, scroll)
    {
        try
        {
            if (scroll)
            {
                _divMap.scrollIntoView();		// BUGBUG - with the new layout, we need to be scrolling all the way to the top, or at least to the menu bar...
            }
            var rgTabs = [];
			if (index == 2)		// photos - make sure we have a blog tab, if not, index should just be 1 - BUGBUG: this ain't workin'
			{
				if (marker.GetDiv("Blog") == null)
				{
					index = 1;
				}
			}
            var opts = {"selectedTab" : index, maxWidth : 300, maxHeight: 200};
            for (var divName in marker.GetDivs())
            {
                rgTabs.push(new GInfoWindowTab(divName, marker.GetDiv(divName)));
            }
            marker.GetGMarker().openInfoWindowTabsHtml(rgTabs, opts);
        }
        catch(e)
        {
            _showError("_openMarker", e);
        }
    }

    // A function to create the marker and set up the event window
    /*   struct Location
     *   {
     *      string name;     // name of the location
     *      string html;    // message from this location
     *      int day;        // day number
     *      string datetime;// date
     *      GLatLng point;  // coordinates for this location
     *    }  */

    function _createMarker(location)
    {
        try
        {
            var marker = _markerManager.GetMarker(location.name, location.point, _label);
            var gmarker = null;
            if (marker != null)
            {
                gmarker = marker.GetGMarker();
                if (!_markerManager.AddLocation(location))
                {
                    _showMessage("createMarker: failed to add location message to marker for " + location.name);
                }

                if (!location.duplicate && (location.rgTags != null))
                {
                    if (!_markerManager.AddBlogPost(location, (GetAllCollection(_divItems))))
                    {
                        _showMessage("createMarker: failed to add blog post to marker for " + location.name);
                    }
                }

                // set up all the events
                GEvent.addListener(gmarker, "click", function() {
                    _openMarker(marker, 0, true);
                });
                GEvent.addListener(gmarker, "clickblog", function() {
                    _openMarker(marker, 1, true);
                });
                GEvent.addListener(gmarker, "clickphoto", function() {
                    _openMarker(marker, 2, true);
                });
                GEvent.addListener(gmarker, "mouseover", function() {
                    gmarker.setImage(rgMarkerImgs["hover"]);
                });
                GEvent.addListener(gmarker, "mouseout", function() {
                    var img;
                    if (location.first)
                    {
                        img = rgMarkerImgs["start"];
                    }
                    else if (location.last)
                    {
                        img = rgMarkerImgs["current"];
                    }
                    else
                    {
                        img = rgMarkerImgs["normal"];
                    }
                    gmarker.setImage(img);
                });

                var alink = GetAllCollection(_divItems)["a" + location.id];
                alink.onclick = function() { GEvent.trigger(gmarker, "click"); };
            }
            else
            {
                _showMessage("_createMarker: something went horroibly wrong, and we couldn't get a Marker object");
            }

            return gmarker;
        }
        catch (e)
        {
            _showError("_createMarker", e);
            return null;
        }
    }     // createMarker

    function _handleResponse(ready, response)
    {
        if (ready)
        {
            _showMessage("ajax response: " + response);
        }
    }

    // need a hashtable, or, at least, an associative array! BUGBUG: id #14
    function _assignTags(rgTags)
    {
        for (var tag in rgTags)
        {
            for (var j=0; j<_rgLocations.length; j++)
            {
                if (_rgLocations[j].name.startsWithQ(tag))
                {
                    _rgLocations[j].AddTags(rgTags[tag]);
                }
            }
        }
    }

    function _displayRoute(rgLocations, rgPts, rgTags)
    {
        _showMessage("displaying the route");

        if (rgLocations != null)
        {
            _rgLocations = rgLocations;
            _assignTags(rgTags);
        }

        function _processLocation(location)
        {
            try
            {
                // create the marker
                var gmarker = _createMarker(location);
                _gmap.addOverlay(gmarker);
                if ((_locIndex - _skip) == 0)
                {
                    location.first = true;
                    _showMessage("first location is " + location.name);
                    gmarker.setImage(rgMarkerImgs["start"]);
                }
                else if (_locIndex == _rgLocations.length-1)
                {
					// BUGBUG - if the last location is LocationLess, we don't correctly id the last marker initially
					// bug id: 22
                    location.last = true;
                    _showMessage("last location is " + location.name);
                    gmarker.setImage(rgMarkerImgs["current"]);
                    _markerManager.AddNavigation();
                }
                else
                {
                    gmarker.setImage(rgMarkerImgs["normal"]);       // stay consistent with the mouseout event in case Google changes their icons
                }

                // each time a point is found, extend the bounds to include it
                _bounds.extend(location.point);
                var type = (location.newLocation ? (location.duplicate ? "duplicate" : "new") : "existing");
                _showMessage("Processed " + type + " location: " + location.name);
            }
            catch (e)
            {
                _showError("_processLocation", e);
            }
        }
 
        function _handleLocation(location, fnNext)
        {
          if (location.LocationLess())     // location-less tweet, don't try creating a marker or integrating into route
          {
              _skip++;
			  if (_locIndex == _rgLocations.length-1)
			  {
                    location.last = true;
					var iLoc = _locIndex-1;
					while (iLoc > 0)
					{
						if (_rgLocations[iLoc].LocationLess())
						{
							iLoc--;
							continue;
						}
	                    _showMessage("last location is " + _rgLocations[iLoc].name);
						var marker = _markerManager.GetMarker(_rgLocations[iLoc].name, null);
						marker.GetGMarker().setImage(rgMarkerImgs["current"]);
						_markerManager.AddNavigation();
						break;
					}
			  }
              fnNext();
          }
          else
          {
              if (location.newLocation && (_markerManager.GetMarker(location.name, null) == null) && (location.point == null))
              {
				  _showMessage("retrieving coordinates for " + location.name);
                  _geocoder.getLocations(location.name, function(result)
                    {
                        try
                        {
                            if (result.Status.code == G_GEO_SUCCESS)
                                {
                                var p = result.Placemark[0].Point.coordinates;
                                location.point = new GLatLng(p[1],p[0]);

                                _processLocation(location);
                                }
                            else
                                {
                                _showMessage("getLocations failed with code: " + result.Status.code);
                                }
                            _lastPoint = location.point;
                            fnNext();
                        }
                        catch(e)
                        {
                            _showError("_handleLocation", e);
                        }
                    }
                  );
              }
              else
              {
                  if (_markerManager.GetMarker(location.name, null) != null)
                  {
                      location.duplicate = true;
                      location.point = _markerManager.GetMarkerPoint(location.name);
                  }
                  _processLocation(location);
                  _lastPoint = location.point;
                  fnNext();
              }
          }
        }

        function processNext()
        {
             if (_locIndex < (_rgLocations.length-1))
            {
                _locIndex++;
                _handleLocation(_rgLocations[_locIndex], processNext);
            }
            else        // finish up
            {
				_lastLoc = _rgLocations[_rgLocations.length-1];
                if (_rgLocations[_rgLocations.length-1].LocationLess())
                {
                    for (var i=(_rgLocations.length-2); i>0; i--)
                    {
                        if (!_rgLocations[i].LocationLess())
                        {
                            _rgLocations[i].last = true;
                            _showMessage("last location (with coordinates) is " + _rgLocations[i].name);
							_lastLoc = _rgLocations[i];
                            break;
                        }
                    }
                }
                _showMessage("done");

                // determine the zoom level from the bounds - max 5
                _gmap.setZoom(Math.max(5, Math.min(15, _gmap.getBoundsZoomLevel(_bounds))));

                // reset the center using the bounds if needed
                if (!PointsEqual(_pointStartCenter, _lastPoint))
                {
                    _gmap.setCenter((_lastPoint != null) ? _lastPoint : (_pointStartCenter != null) ? _pointStartCenter : _bounds.getCenter());
                }

                _showRoute(_rgPts, _lastPoint);
            }
        }

        var _rgPts = rgPts;
        var _locIndex = -1;
        var _lastPoint = null;
        var _skip = 0;
        processNext();
    }

    function _getDirections(from, to)
    {
        try
        {
            var opts = {};
/*          if (document.getElementById("walk").checked)
 *          {
               opts.travelMode = G_TRAVEL_MODE_WALKING;
            }
            if (document.getElementById("highways").checked)
            {
               opts.avoidHighways = true;
            }*/
            // ==== set the start and end locations ====
//            var saddr = document.getElementById("saddr").value
//            var daddr = document.getElementById("daddr").value
            // gdir.load("from: "+saddr+" to: "+daddr+" to: agra, india", opts);
            _gdir.load("from: "+from+" to: "+to, opts);
        }
        catch (e)
        {
            _showError("_getDirections", e);
        }
    }

    function _handleTwitterResponse(ready, response)
    {
        try
        {
            if (ready)
            {
                var rgResponses = eval(response);
                for (var i=0; i<rgResponses.length; i++)
                {
                    _showMessage("on " + rgResponses[i].created_at + ", " + rgResponses[i].user.name + " said:<br />" + rgResponses[i].text);
                }
            }
        }
        catch(e)
        {
            alert(e.message);
        }
    }

    function _runTest()
    {
        try
        {
            try
            {
                if (_gAjax == null)
                {
                    var _gAjax = new AJAXUtil();
                }
                if (!_gAjax.Post("http://localhost/twitterstatus.php", "id=cyrusgray", _handleTwitterResponse))
                {
                    _showMessage("failed to send the request");
                }
/*                var rgPoints = [new GLatLng(9.93963, 76.2595), new GLatLng(48.856667,2.350987)];
                var myopts = {geodesic:true};
                _gmap.addOverlay(new GPolyline(rgPoints, "black", 5, 0.5, myopts));*/
            }
            catch(e)
            {
                alert(e.message);
            }
        }
        catch (e)
        {
            alert(e.message);
        }
    }

    this.LoadFromXmlFile = _loadFromXmlFile;
    this.DisplayRoute = _displayRoute;
    this.GetDirections = _getDirections;
    this.ShowRoute = _showRoute;
    this.GetMap = function() { return _gmap; };
    this.OpenMarker = _openMarkerExternal;

    this.RunTest = _runTest;
}