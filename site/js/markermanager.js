var MARKER_HTML_WIDTH = 300;

// Class Marker
function Marker(name, point, label)
{
    var _name = name;
    var _point = point;
    var _gmarker = new GMarker(point, {title:label + ": " + name});
    var _rgDivs = [];

    function getPoint()
    {
        return _point;
    }

    function getName()
    {
        return _name;
    }

    function getGMarker()
    {
        return _gmarker;
    }

    function getDiv(divName)
    {
        return _rgDivs[divName];
    }

    function getDivs()
    {
        return _rgDivs;
    }

    function addDiv(divName, html, addNavigation)
    {
        if (_rgDivs[divName] == null)
        {
            var divStart = document.createElement("div");
            divStart.className = "markerDiv";
            divStart.innerHTML = html;
            _rgDivs[divName] = divStart;
        }
        else
        {
            _rgDivs[divName].innerHTML = html + "<br /><br />" + _rgDivs[divName].innerHTML;
        }

        return true;
    }

    function addNavigationDiv(div)
    {
        if (div != null)
        {
            var divParent = document.createElement("div");
            divParent.appendChild(_rgDivs["Location"]);
            div.className = "navDiv";
            divParent.appendChild(div);
            _rgDivs["Location"] = divParent;
        }
    }

    this.GetPoint = getPoint;
    this.GetName = getName;
    this.GetDiv = getDiv;
    this.GetDivs = getDivs;
    this.AddDiv = addDiv;
    this.GetGMarker = getGMarker;
    this.AddNavigationDiv = addNavigationDiv;
}

// Class MarkerManager
function MarkerManager()
{
    var _rgMarkers = [];
    var _rgKeys = [];
    var _rgFlags = {"burma" : "burma.GIF",
                    "canada" : "canada.GIF",
                    "china" : "china.GIF",
                    "england" : "england.GIF",
                    "hong kong" : "hk.GIF",
                    "iceland" : "iceland.GIF",
                    "india" : "india.GIF",
                    "japan" : "japan.GIF",
                    "sri lanka" : "lanka.GIF",
                    "nepal" : "nepal.GIF",
                    "philippines" : "php.GIF",
                    "qatar" : "qatar.GIF",
                    "scotland" : "scotland.GIF",
                    "thailand" : "thai.GIF",
                    "tibet" : "tibet.GIF",
                    "usa" : "usa.GIF",
                    "bulgaria" : "bulgaria.GIF",
                    "egypt" : "egypt.GIF",
                    "france" : "france.GIF",
                    "greece" : "greece.GIF",
                    "hungary" : "hungary.GIF",
                    "austria" : "austria.GIF",
                    "ireland" : "ireland.GIF",
                    "israel" : "israel.GIF",
                    "italy" : "italy.GIF",
                    "jordan" : "jordan.GIF",
                    "kosovo" : "kosovo.GIF",
                    "macedonia" : "macedonia.GIF",
                    "serbia" : "serbia.GIF",
                    "switzerland" : "switzerland.GIF",
                    "tunisia" : "tunisia.GIF",
                    "wales" : "wales.GIF",
                    "palestine" : "palestine.GIF",
                    "palestinian territories" : "palestine.GIF",
                    "taiwan" : "taiwan.GIF",
					"argentina" : "argentina.GIF",
					"antarctica" : "antarctica.GIF"};

    function getMarker(name, point, label)
    {
        var orgname = name;
        name = name.toLowerCase();
        var marker = _rgMarkers[name];
		if (typeof(marker) == "undefined")
		{
			marker = null;
		}
        if ((marker == null) && (point != null))        // don't create if a point isn't passed in -
        {                                               // just use this function to check if a marker has already been created then
            _rgMarkers[name] = new Marker(orgname, point, label);
            marker = _rgMarkers[name];
            _rgKeys.push(name);
        }

        return marker;
    }

    function addLocation(location)
    {
        var fSuccess = false;
        var name = location.name.toLowerCase();
        var marker = _rgMarkers[name];
        if (marker != null)
        {
            var country = location.name.substr(location.name.lastIndexOf(",")+2);
            var flag = "";
            if (_rgFlags[country.toLowerCase()] != null)
            {
                flag = "<img src='img/" + _rgFlags[country.toLowerCase()] + "' class='flagImg' alt='" + country + "'/>"
            }
            var html = "<div class='flagDiv'>" + flag + "Day " + location.day;
            if (location.datetime != null)
            {
                html += ": " + location.datetime;
            }
            html += "<br />" + location.name + "</div><br />";
            if (location.html != null)
            {
                 html += location.html;
            }

            fSuccess = marker.AddDiv("Location", html, true);
        }

        return fSuccess;
    }

    function _removeChild(element, id)
    {
        var allDiv = GetAllCollection(element);
        var remove = allDiv[id];
        if (remove != null)
        {
            element.removeChild(remove);
        }

        return remove;
    }

    function addBlogPost(location, all)
    {
        var fSuccess = false;
        var name = location.name.toLowerCase();
        var marker = _rgMarkers[name];
        if ((marker != null) && (location.rgTags != null))
        {
            for (var t=0; t<location.rgTags.length; t++)
            {
                var postId = location.rgTags[t].substr(3);
				var type = location.rgTags[t].substr(0, 2);
                var divPost = all["div" + postId];
                if (divPost != null)
                {
                    var divT = document.createElement("DIV");
                    var allDiv = GetAllCollection(divPost);
                    divT.appendChild(allDiv["idh3"].cloneNode(true));
                    var elementT = divT.appendChild(allDiv["head"].cloneNode(true));
                    _removeChild(elementT, "less");
                    elementT = divT.appendChild(allDiv["itemPost"].cloneNode(true));
                    _removeChild(elementT, "hidden");
                    if (_removeChild(elementT, "more") != null)
                    {
                        var span = document.createElement("SPAN");
                        span.className = "mylink";
                        span.innerHTML = "<a onclick=\"show(document.getElementById('div" + postId + "'));document.getElementById('div" + postId + "').scrollIntoView();\">Read More</a>";
                        elementT.appendChild(span);
                    }
					if (type == "ph")
					{
						elementT = GetAllCollection(elementT)["picsDiv"];
						_removeChild(elementT, "idPic3");
					}

					var tabname = (type == "ph") ? "Photos" : "Blog";
                    fSuccess = marker.AddDiv(tabname, divT.innerHTML, false);

                    for (var i=0; i<parseInt(divPost.attributes["tagCount"].nodeValue); i++)
                    {
                        var alink = allDiv["aid" + postId + i];
                        if ((alink != null) && name.startsWithQ(alink.innerHTML.toLowerCase()))
                        {
                            alink.onclick = function() { GEvent.trigger(_rgMarkers[name].GetGMarker(), (type == "ph") ? "clickphoto" : "clickblog"); };
                        }
                    }
                }
            }
        }

        return fSuccess;
    }

    function getMarkerPoint(name)
    {
        name = name.toLowerCase();
        var point = null;
        if (_rgMarkers[name] != null)
        {
            point = _rgMarkers[name].GetPoint();
        }

        return point;
    }

    function _addMarkerLink(text, marker)
    {
        return "<a onclick='gMapWrapper.OpenMarker(\"" + marker.GetName() + "\", true);'>" + text + "</a>";
    }

    function addNavigation()
    {
        if (_rgKeys.length > 0)
        {
            var markerFirst = _rgMarkers[_rgKeys[0]];
            var markerLast = _rgMarkers[_rgKeys[_rgKeys.length-1]];
            
            // first marker
            var div = document.createElement("div");
            div.innerHTML = "<< First  < Previous ";
            if (_rgKeys.length > 1)
            {
                div.innerHTML += ("&nbsp;" + _addMarkerLink("Next >", _rgMarkers[_rgKeys[1]]) + "&nbsp;&nbsp;");
                div.innerHTML += _addMarkerLink("Last >>", markerLast);
            }
            else
            {
                div.innerHTML += " Next >  Last >>";
            }
            _rgMarkers[_rgKeys[0]].AddNavigationDiv(div);

            // everything in the middle
            for (var i=1; i<_rgKeys.length-1; i++)
            {
                div = document.createElement("div");
                div.innerHTML = _addMarkerLink("<< First", markerFirst);
                div.innerHTML += ("&nbsp;&nbsp;" + _addMarkerLink("< Prev", _rgMarkers[_rgKeys[i-1]]) + "&nbsp;");
                div.innerHTML += ("&nbsp;" + _addMarkerLink("Next >", _rgMarkers[_rgKeys[i+1]]) + "&nbsp;&nbsp;");
                div.innerHTML += _addMarkerLink("Last >>", markerLast);
                _rgMarkers[_rgKeys[i]].AddNavigationDiv(div);
            }

            // last marker
            if (_rgKeys.length > 1)
            {
                div = document.createElement("div");
                div.innerHTML = _addMarkerLink("<< First", markerFirst);
                div.innerHTML += ("&nbsp;&nbsp;" + _addMarkerLink("< Prev", _rgMarkers[_rgKeys[_rgKeys.length-2]]) + "&nbsp;");
                div.innerHTML += " Next >  Last >>";
                _rgMarkers[_rgKeys[_rgKeys.length-1]].AddNavigationDiv(div);
            }
        }
    }

    this.GetMarkerPoint = getMarkerPoint;
    this.GetMarker = getMarker;
    this.AddLocation = addLocation;
    this.AddBlogPost = addBlogPost;
    this.AddNavigation = addNavigation;
}