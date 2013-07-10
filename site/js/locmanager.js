var DIR = 0;
var STRAIGHT = 1;
var DIR_RG_LIMIT = 25;

function PointsEqual(pointA, pointB)
{
    var fEqual;
    if ((pointA == null) != (pointB == null))
    {
        fEqual = false;
    }
    else
    {
        fEqual = ((Math.abs(pointA.y - pointB.y) < 0.01) && (Math.abs(pointA.x - pointB.x) < 0.01));
    }

    return fEqual;
}

// Class Location
function Location(id, name, day, datetime, datetimeOrig, html, point, author, ptIndex, forceNew, type)
{
    try
    {
        if (typeof(point) == 'undefined')
        {
            point = null;
        }
        this.id = id;
        this.name = name;
        this.day = day;
        this.datetime = datetime;
        this.datetimeOriginal = datetimeOrig;
        this.html = html;
        this.point = point;
        this.duplicate = false;
        this.author = author;
        this.newLocation = ((point == null) || forceNew);
        if (type != null)
        {
            type = type.toLowerCase();
        }
        this.type = type;
        this.ptIndex = ptIndex;
        this.bNeedUpdate = false;
        this.rgTags = null;
        this.first = false;
        this.last = false;

        function pointType()       // BUGBUG - well, this isn't actually correct, is it now?
        {
            if ((this.type != null) && (this.type == "s"))
                return STRAIGHT;
            if (this.Region() != null)
                return DIR;
            else
                return STRAIGHT;
        }

        function region()
        {
            var region = null;
            var name = this.name.toLowerCase();
            if (name.endsWith("india"))
            {
                region = "India";
            }
            else if (name.endsWith("thailand"))
            {
                region = "Thailand";
            }
            else if (name.endsWith("usa") || name.endsWith("canada"))
            {
                region="USCanada";
            }
            else if (name.endsWith("japan"))
            {
                region = "Japan";
            }
            else if (name.endsWith("england") || name.endsWith("scotland") || name.endsWith("hungary") || name.endsWith("serbia")
                 || name.endsWith("bulgaria")  || name.endsWith("macedonia") || name.endsWith("greece") || name.endsWith("italy")
                 || name.endsWith("switzerland") || name.endsWith("france") || name.endsWith("ireland") || name.endsWith("austria")
                 || name.endsWith("wales"))
            {
                region = "Europe";
            }
            else if (name.endsWith("china") || name.endsWith("tibet"))
            {
                region = "China";
            }
            else if (name.endsWith("taiwan"))
            {
                region = "Taiwan";
            }
            else if (name.endsWith("egypt"))
            {
                region = "Egypt";
            }
            else if (name.endsWith("israel") || name.endsWith("palestine") || name.endsWith("palestinian territories"))
            {
                //region = "Israel";    // Israel directions aren't supported in the API apparently...
            }
            else if (name.endsWith("jordan"))
            {
                region = "Jordan";
            }
            else if (name.endsWith("tunisia"))
            {
                region = "NAfrica";
            }

            return region;
        }

        function pointEquals(point)
        {
            return PointsEqual(point, this.point);
        }

        function forceUpdate(update)
        {
            this.bNeedUpdate = update;
        }

        function needUpdate()
        {
            return (this.bNeedUpdate || this.newLocation) && (this.point != null);
        }

        function addTags(rgTags)
        {
            this.rgTags = rgTags;
        }

        function locationLess()
        {
            return (this.name == "Safety Third!");
        }

        this.PointType = pointType;
        this.Region = region;
        this.PointEquals = pointEquals;
        this.ForceUpdate = forceUpdate;
        this.NeedUpdate = needUpdate;
        this.AddTags = addTags;
        this.LocationLess = locationLess;
    }
    catch (e)
    {
        alert(e.message);
    }
}

function PointsContainer(type)
{
    var _rgPoints = [];
    var _type = type;
    var _polyline = null;
    var _iCur = 0;

    function addPoint(location, locationPrev)
    {
        var pointsContainerNext = null;
        if (location.PointType() == _type)
        {
            if ((_type == DIR) && (locationPrev != null) && (location.Region() != locationPrev.Region()))
            {
                pointsContainerNext = new PointsContainer(STRAIGHT);
                pointsContainerNext.AddPoint(locationPrev, null);
                pointsContainerNext.AddPoint(location, null);
            }
            else
            {
                if ((_type == STRAIGHT) ||  (_rgPoints.length < DIR_RG_LIMIT))
                {
                    _rgPoints.push(location.point);
                }
                else
                {
                    pointsContainerNext = new PointsContainer(_type);
                    pointsContainerNext.AddPoint(locationPrev, null);
                    pointsContainerNext.AddPoint(location, null);
                }
            }
        }
        else
        {
            if (_type == STRAIGHT)
            {
                _rgPoints.push(location.point);
                pointsContainerNext = new PointsContainer(DIR);
                pointsContainerNext.AddPoint(location, null);
            }
            else
            {
                pointsContainerNext = new PointsContainer(STRAIGHT);
                pointsContainerNext.AddPoint(locationPrev, null);
                pointsContainerNext.AddPoint(location, null);
            }
        }

        return pointsContainerNext;
    }

    function setPolyline(polyline)
    {
        _polyline = polyline;
    }

    function getNthPoint(n)
    {
        var point;
        _iCur = n;
        if (_type == DIR)
        {
            if (_polyline == null)
            {
                _showMessage("asking for a Polyline vertex, but Polyline hasn't been set yet")
                point = null;
            }
            else
            {
                point = _polyline.getVertex(n);
            }
        }
        else
        {
            point = (n >= _rgPoints.length) ? null : _rgPoints[n];
        }
        return point;
    }

    function getFirstPoint()
    {
        _iCur = 0;
        return getNthPoint(_iCur);
    }

    function getNext()
    {
        _iCur++;
        return getNthPoint(_iCur);
    }

    function isDone()
    {
        return isValidIndex(_iCur);
    }

    function isValidIndex(index)
    {
        return (_type == DIR) ? index < (_polyline.getVertexCount()) : index < _rgPoints.length;
    }

    this.Type = function() { return _type; };
    this.GetPoints = function() { return _rgPoints; };
    this.AddPoint = addPoint;
    this.SetPolyline = setPolyline;
    // build an abstract point iterator
    this.GetFirstPoint = getFirstPoint;
    this.GetNextPoint = getNext;
    this.GetIndexPoint = getNthPoint;
    this.Done = isDone;
    this.IsValidIndex = isValidIndex;
}

// class LocationManager
function LocationManager(rgPoints, rgLocations, fnShowMessage, fnShowError)
{
    var _rgPts = rgPoints;
    var _rgLocations = rgLocations;
    var _rgPointsContainer = [];
    var _curIndex;
    var _appendOnly = true;

    _fnShowMessage = fnShowMessage;
    var _fnShowError = fnShowError;

    function addPoint(location, locationPrev)
    {
		_showMessage("adding point: " + location.name);
        if (_rgPointsContainer.length == 0)
        {
            _rgPointsContainer.push(new PointsContainer(location.PointType()));
            _curIndex = 0;
        }

        var pointsContainer = _rgPointsContainer[_curIndex].AddPoint(location, locationPrev);
        if (pointsContainer != null)
        {
            _curIndex++;
            _rgPointsContainer[_curIndex] = pointsContainer;
        }
    }

    function parseLocations()
    {
        var seenNew = false;

        _showMessage("parsing locations");
        for (var i = 0; i < _rgLocations.length; i++)
        {
            if (_rgLocations[i].LocationLess())
            {
                continue;
            }
            // our first new location - everything from here on out gets treated as a new location
            if (_rgLocations[i].newLocation && !seenNew)
            {
                if (i > 0)
                {
					var j = i-1;
					while (j >= 0)
					{
						_showMessage("Previous: " + _rgLocations[j].name);
						if (!_rgLocations[j].LocationLess())
						{
							if ((_rgLocations[j].ptIndex >= 0) && (_rgLocations[j].ptIndex != null) && (_rgLocations[j].ptIndex <= _rgPts.length))
							{
								_rgPts.length = (_rgLocations[j].ptIndex+1);
							}
							// start with the previous point, so we can build directions
							addPoint(_rgLocations[j], null);
							break;
						}
						j--;
					}
                }
                else if (i == 0)
                {
                    _rgPts.length = 0;
                }
                seenNew = true;
            }

            if (seenNew)
            {
                if (!_rgLocations[i].newLocation)
                {
                    _appendOnly = false;
                }
                if (_rgLocations[i].duplicate)
                {
                    if ((i > 0) && (_rgLocations[i].PointEquals(_rgLocations[i-1].point) || _rgLocations[i-1].LocationLess()))
                    {
                        continue;
                    }
                }
				var j = i-1;
				while (j >= 0)
				{
					if (!_rgLocations[j].LocationLess())
					{
						addPoint(_rgLocations[i], _rgLocations[j]);
						break;
					}
					j--;
				}
				if (j<0)
				{
					addPoint(_rgLocations[i], null);
				}
            }
        }

        _curIndex = 0;
        return seenNew;
    }

    function getNextPointsContainer()
    {
        var pointContainerRet = null;
        if ((_curIndex+1) < _rgPointsContainer.length)
        {
            _curIndex++;
            pointContainerRet = _rgPointsContainer[_curIndex];
        }
        return pointContainerRet;
    }

    function setPolyline(polyline)
    {
        if (_curIndex < _rgPointsContainer.length)
        {
            _rgPointsContainer[_curIndex].SetPolyline(polyline);
        }
        else
        {
            _showMessage("trying to set the polyline past the end of point containers")
        }
    }

    function getCachedPoints()
    {
        return _rgPts;
    }

    function _showError(fnName, e)
    {
        if (_fnShowError != null)
        {
            _fnShowError(fnName, e);
        }
    }

    this.ParseLocations = parseLocations;
    this.GetNextPointsContainer = getNextPointsContainer;
    this.GetCachedPoints = getCachedPoints;
    this.StartIterator = function() { _curIndex = -1; };
    this.IsAppendOnly = function() { return _appendOnly; };
    this.SetPolyline = setPolyline;
}

var _fnShowMessage = null;
function _showMessage(msg)
{
    if (_fnShowMessage != null)
    {
        _fnShowMessage(msg);
    }
}