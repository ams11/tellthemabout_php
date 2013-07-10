function AJAXUtil()
{
    var _httpRequest = null;
    var _fnRespond = null;

    function init()
    {
        if (window.XMLHttpRequest)
        {
            _httpRequest = new XMLHttpRequest();
            if ((_httpRequest != null) && _httpRequest.overrideMimeType)
            {
                _httpRequest.overrideMimeType("text/html");
            }
        }
        else if (window.ActiveXObject)
        {
            try
            {
                _httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
            }
            catch (e)
            {
                try
                {
                    _httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
                }
                catch(e) {}
            }
        }
    }

    function _handleResponse()
    {
        var ready = false;
        var response = "not ready yet";
        if (_httpRequest.readyState == 4)
        {
            if (_httpRequest.status == 200)
            {
                response = _httpRequest.responseText;
                ready = true;
            }
            else
            {
                response = "fail";
            }
        }

        _fnRespond(ready, response);
    }

    function _post(url, paramString, fnRespond)
    {
        if (_httpRequest == null)
        {
            init();
        }

        if (_httpRequest == null)
        {
            return false;
        }
        else
        {
            _fnRespond = fnRespond;

            _httpRequest.onreadystatechange = _handleResponse;
            _httpRequest.ontimeout = function () { _fnRespond(false, "timeout"); };
            _httpRequest.open("POST", url, true);
            _httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            _httpRequest.setRequestHeader("Content-length", paramString.length);
            _httpRequest.setRequestHeader("Connection", "close");
            _httpRequest.send(paramString);
        }

        return true;        // only means we sent the request off... get success/failure from callback
    }

    this.Post = _post;
}