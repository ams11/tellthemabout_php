function isIE()
{
    return /MSIE (\d+\.\d+);/.test(navigator.userAgent);
}

function SetObjText(obj, text)
{
    if (isIE())
        obj.innerText = text;
    else
        obj.textContent = text;

    // are there browsers out there that don't support either?
}

function SpellCheck(evt)
{
    try
    {
        var keyCode = (evt != null) ? evt.keyCode : event.keyCode;      // use event for IE
        if (keyCode == 13)      // 'Enter' key
        {
            var ta = document.getElementById("idTextArea");
            var patt = />.*\n$/;
            var str = new String(patt.exec(ta.value));

            var xhSpellCheck = new XMLHttpRequest();
            xhSpellCheck.open("GET", "check.php?word=" + str.substring(1), false);
            xhSpellCheck.send(null);
            ta.value += (xhSpellCheck.responseText + "\n>");
        }
    }
    catch (e)
    {
        alert(e.message);
    }
}

onload = function()
{
    var ta = document.getElementById("idTextArea");
    if (ta != null)
    {
        ta.focus();
        if (isIE())
        {
            // IE keeps the focus before the '>' symbol - send the textarea an 'End' key stroke
 //           ta.fireEvent("onkeydown", event);
        }
        ta.onkeyup = SpellCheck;
    }
}

function LoadDictionary(url)
{
    SetObjText(document.getElementById("idDictionary"), "Loading...");
    var xhDictionary = new XMLHttpRequest();
    xhDictionary.open("GET", "dictionary.php?url=" + url, false);
    xhDictionary.send(null);
//    alert(xhDictionary.responseText);
    if (xhDictionary.responseText.substring(0,7) == "SUCCESS")
    {
        SetObjText(document.getElementById("idDictionary"), url);
        SetObjText(document.getElementById("idHeader"), "Dictionary Listing:");
        document.getElementById("idList").innerHTML = xhDictionary.responseText.substring(7);
    }
    else
    {
        alert("Failed to load a dictionary from " + url + ". Please check your url. Error Response:\n" + xhDictionary.responseText);
    }
}

function Randomize()
{
    var xhDictionary = new XMLHttpRequest();
    xhDictionary.open("GET", "dictionary.php?random=true", false);
    xhDictionary.send(null);

    SetObjText(document.getElementById("idHeader"), "Results of Randomized Test:");
    document.getElementById("idList").innerHTML = xhDictionary.responseText;
}