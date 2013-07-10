// IE supports document.all, but not getElementById, Firefox is the reverse - this is a browser-independent function
function GetNamedElement(parentElem, name)
{
	var all = (document.all) ? parentElem.all : parentElem.getElementsByTagName("*");
	return all[name];
}


function show(div)
{
        try
        {
            all = (document.all) ? div.all : div.getElementsByTagName("*");
            all['begin'].style.display = 'none';
            all['dots'].style.display = 'none';
            all['hidden'].style.display = 'inline';
            all['less'].style.display = 'inline';
            all['more'].style.display='none';

        }
        catch (e)
        {
            alert(e.message);
        }
}

function hide(div)
{
        try
        {
            all = (document.all) ? div.all : div.getElementsByTagName("*");
            all['begin'].style.display = 'inline';
            all['dots'].style.display = 'inline';
            all['hidden'].style.display = 'none';
            all['less'].style.display = 'none';
            all['more'].style.display='inline';
        }
        catch (e)
        {
            alert(e.message);
        }
}

// This function zooms in or out
// it's not necessary to check for out of range zoom numbers, because the API checks
function myzoom(a)
{
    gMapWrapper.GetMap().setZoom(gMapWrapper.GetMap().getZoom() + a);
}

function AddToArray(rg, tag, id)
{
    if (rg != null)
    {
        if (rg[tag] == null)
        {
            rg[tag] = [];
            rg[tag][0] = id;
        }
        else
        {
            rg[tag].push(id);
        }
    }
}

String.prototype.startsWithQ = function(data)
{
    return (this.match("^"+data) == data);
}

String.prototype.endsWith = function(data)
{
    return (this.match(data+"$") == data);
}

function GetAllCollection(element)
{
    return (document.all) ? element.all : element.getElementsByTagName("*");
}

function sprintf ( )
{
    // Return a formatted string
    //
    // version: 909.322
    // discuss at: http://phpjs.org/functions/sprintf
    // +   original by: Ash Searle (http://hexmen.com/blog/)
    // + namespaced by: Michael White (http://getsprink.com)
    // +    tweaked by: Jack
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +      input by: Paulo Ricardo F. Santos
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +      input by: Brett Zamir (http://brett-zamir.me)
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // *     example 1: sprintf("%01.2f", 123.1);
    // *     returns 1: 123.10
    // *     example 2: sprintf("[%10s]", 'monkey');
    // *     returns 2: '[    monkey]'
    // *     example 3: sprintf("[%'#10s]", 'monkey');
    // *     returns 3: '[####monkey]'
    var regex = /%%|%(\d+\$)?([-+\'#0 ]*)(\*\d+\$|\*|\d+)?(\.(\*\d+\$|\*|\d+))?([scboxXuidfegEG])/g;
    var a = arguments, i = 0, format = a[i++];

    // pad()
    var pad = function (str, len, chr, leftJustify) {
        if (!chr) {chr = ' ';}
        var padding = (str.length >= len) ? '' : Array(1 + len - str.length >>> 0).join(chr);
        return leftJustify ? str + padding : padding + str;
    };

    // justify()
    var justify = function (value, prefix, leftJustify, minWidth, zeroPad, customPadChar) {
        var diff = minWidth - value.length;
        if (diff > 0) {
            if (leftJustify || !zeroPad) {
                value = pad(value, minWidth, customPadChar, leftJustify);
            } else {
                value = value.slice(0, prefix.length) + pad('', diff, '0', true) + value.slice(prefix.length);
            }
        }
        return value;
    };

    // formatBaseX()
    var formatBaseX = function (value, base, prefix, leftJustify, minWidth, precision, zeroPad) {
        // Note: casts negative numbers to positive ones
        var number = value >>> 0;
        prefix = prefix && number && {'2': '0b', '8': '0', '16': '0x'}[base] || '';
        value = prefix + pad(number.toString(base), precision || 0, '0', false);
        return justify(value, prefix, leftJustify, minWidth, zeroPad);
    };

    // formatString()
    var formatString = function (value, leftJustify, minWidth, precision, zeroPad, customPadChar) {
        if (precision != null) {
            value = value.slice(0, precision);
        }
        return justify(value, '', leftJustify, minWidth, zeroPad, customPadChar);
    };

    // doFormat()
    var doFormat = function (substring, valueIndex, flags, minWidth, _, precision, type) {
        var number;
        var prefix;
        var method;
        var textTransform;
        var value;

        if (substring == '%%') {return '%';}

        // parse flags
        var leftJustify = false, positivePrefix = '', zeroPad = false, prefixBaseX = false, customPadChar = ' ';
        var flagsl = flags.length;
        for (var j = 0; flags && j < flagsl; j++) {
            switch (flags.charAt(j)) {
                case ' ': positivePrefix = ' '; break;
                case '+': positivePrefix = '+'; break;
                case '-': leftJustify = true; break;
                case "'": customPadChar = flags.charAt(j+1); break;
                case '0': zeroPad = true; break;
                case '#': prefixBaseX = true; break;
            }
        }

        // parameters may be null, undefined, empty-string or real valued
        // we want to ignore null, undefined and empty-string values
        if (!minWidth) {
            minWidth = 0;
        } else if (minWidth == '*') {
            minWidth = +a[i++];
        } else if (minWidth.charAt(0) == '*') {
            minWidth = +a[minWidth.slice(1, -1)];
        } else {
            minWidth = +minWidth;
        }

        // Note: undocumented perl feature:
        if (minWidth < 0) {
            minWidth = -minWidth;
            leftJustify = true;
        }

        if (!isFinite(minWidth)) {
            throw new Error('sprintf: (minimum-)width must be finite');
        }

        if (!precision) {
            precision = 'fFeE'.indexOf(type) > -1 ? 6 : (type == 'd') ? 0 : undefined;
        } else if (precision == '*') {
            precision = +a[i++];
        } else if (precision.charAt(0) == '*') {
            precision = +a[precision.slice(1, -1)];
        } else {
            precision = +precision;
        }

        // grab value using valueIndex if required?
        value = valueIndex ? a[valueIndex.slice(0, -1)] : a[i++];

        switch (type) {
            case 's': return formatString(String(value), leftJustify, minWidth, precision, zeroPad, customPadChar);
            case 'c': return formatString(String.fromCharCode(+value), leftJustify, minWidth, precision, zeroPad);
            case 'b': return formatBaseX(value, 2, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
            case 'o': return formatBaseX(value, 8, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
            case 'x': return formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
            case 'X': return formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad).toUpperCase();
            case 'u': return formatBaseX(value, 10, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
            case 'i':
            case 'd':
                number = parseInt(+value, 10);
                prefix = number < 0 ? '-' : positivePrefix;
                value = prefix + pad(String(Math.abs(number)), precision, '0', false);
                return justify(value, prefix, leftJustify, minWidth, zeroPad);
            case 'e':
            case 'E':
            case 'f':
            case 'F':
            case 'g':
            case 'G':
                number = +value;
                prefix = number < 0 ? '-' : positivePrefix;
                method = ['toExponential', 'toFixed', 'toPrecision']['efg'.indexOf(type.toLowerCase())];
                textTransform = ['toString', 'toUpperCase']['eEfFgG'.indexOf(type) % 2];
                value = prefix + Math.abs(number)[method](precision);
                return justify(value, prefix, leftJustify, minWidth, zeroPad)[textTransform]();
            default: return substring;
        }
    };

    return format.replace(regex, doFormat);
}

function HtmlDecode(s)
{
      var out = "";
      if (s==null) return "";

      var l = s.length;
      for (var i=0; i<l; i++)
      {
            var ch = s.charAt(i);

            if (ch == '&')
            {
                var semicolonIndex = s.indexOf(';', i+1);

                if (semicolonIndex > 0)
                {
                    var entity = s.substring(i + 1, semicolonIndex);
                    if (entity.length > 1 && entity.charAt(0) == '#')
                    {
                          if (entity.charAt(1) == 'x' || entity.charAt(1) == 'X')
                                ch = String.fromCharCode(eval('0'+entity.substring(1)));
                          else
                                ch = String.fromCharCode(eval(entity.substring(1)));
                    }
                    else
                    {
                              switch (entity)
                              {
                                    case 'quot': ch = String.fromCharCode(0x0022); break;
                                    case 'amp': ch = String.fromCharCode(0x0026); break;
                                    case 'lt': ch = String.fromCharCode(0x003c); break;
                                    case 'gt': ch = String.fromCharCode(0x003e); break;
                                    case 'nbsp': ch = String.fromCharCode(0x00a0); break;
                                    case 'iexcl': ch = String.fromCharCode(0x00a1); break;
                                    case 'cent': ch = String.fromCharCode(0x00a2); break;
                                    case 'pound': ch = String.fromCharCode(0x00a3); break;
                                    case 'curren': ch = String.fromCharCode(0x00a4); break;
                                    case 'yen': ch = String.fromCharCode(0x00a5); break;
                                    case 'brvbar': ch = String.fromCharCode(0x00a6); break;
                                    case 'sect': ch = String.fromCharCode(0x00a7); break;
                                    case 'uml': ch = String.fromCharCode(0x00a8); break;
                                    case 'copy': ch = String.fromCharCode(0x00a9); break;
                                    case 'ordf': ch = String.fromCharCode(0x00aa); break;
                                    case 'laquo': ch = String.fromCharCode(0x00ab); break;
                                    case 'not': ch = String.fromCharCode(0x00ac); break;
                                    case 'shy': ch = String.fromCharCode(0x00ad); break;
                                    case 'reg': ch = String.fromCharCode(0x00ae); break;
                                    case 'macr': ch = String.fromCharCode(0x00af); break;
                                    case 'deg': ch = String.fromCharCode(0x00b0); break;
                                    case 'plusmn': ch = String.fromCharCode(0x00b1); break;
                                    case 'sup2': ch = String.fromCharCode(0x00b2); break;
                                    case 'sup3': ch = String.fromCharCode(0x00b3); break;
                                    case 'acute': ch = String.fromCharCode(0x00b4); break;
                                    case 'micro': ch = String.fromCharCode(0x00b5); break;
                                    case 'para': ch = String.fromCharCode(0x00b6); break;
                                    case 'middot': ch = String.fromCharCode(0x00b7); break;
                                    case 'cedil': ch = String.fromCharCode(0x00b8); break;
                                    case 'sup1': ch = String.fromCharCode(0x00b9); break;
                                    case 'ordm': ch = String.fromCharCode(0x00ba); break;
                                    case 'raquo': ch = String.fromCharCode(0x00bb); break;
                                    case 'frac14': ch = String.fromCharCode(0x00bc); break;
                                    case 'frac12': ch = String.fromCharCode(0x00bd); break;
                                    case 'frac34': ch = String.fromCharCode(0x00be); break;
                                    case 'iquest': ch = String.fromCharCode(0x00bf); break;
                                    case 'Agrave': ch = String.fromCharCode(0x00c0); break;
                                    case 'Aacute': ch = String.fromCharCode(0x00c1); break;
                                    case 'Acirc': ch = String.fromCharCode(0x00c2); break;
                                    case 'Atilde': ch = String.fromCharCode(0x00c3); break;
                                    case 'Auml': ch = String.fromCharCode(0x00c4); break;
                                    case 'Aring': ch = String.fromCharCode(0x00c5); break;
                                    case 'AElig': ch = String.fromCharCode(0x00c6); break;
                                    case 'Ccedil': ch = String.fromCharCode(0x00c7); break;
                                    case 'Egrave': ch = String.fromCharCode(0x00c8); break;
                                    case 'Eacute': ch = String.fromCharCode(0x00c9); break;
                                    case 'Ecirc': ch = String.fromCharCode(0x00ca); break;
                                    case 'Euml': ch = String.fromCharCode(0x00cb); break;
                                    case 'Igrave': ch = String.fromCharCode(0x00cc); break;
                                    case 'Iacute': ch = String.fromCharCode(0x00cd); break;
                                    case 'Icirc': ch = String.fromCharCode(0x00ce ); break;
                                    case 'Iuml': ch = String.fromCharCode(0x00cf); break;
                                    case 'ETH': ch = String.fromCharCode(0x00d0); break;
                                    case 'Ntilde': ch = String.fromCharCode(0x00d1); break;
                                    case 'Ograve': ch = String.fromCharCode(0x00d2); break;
                                    case 'Oacute': ch = String.fromCharCode(0x00d3); break;
                                    case 'Ocirc': ch = String.fromCharCode(0x00d4); break;
                                    case 'Otilde': ch = String.fromCharCode(0x00d5); break;
                                    case 'Ouml': ch = String.fromCharCode(0x00d6); break;
                                    case 'times': ch = String.fromCharCode(0x00d7); break;
                                    case 'Oslash': ch = String.fromCharCode(0x00d8); break;
                                    case 'Ugrave': ch = String.fromCharCode(0x00d9); break;
                                    case 'Uacute': ch = String.fromCharCode(0x00da); break;
                                    case 'Ucirc': ch = String.fromCharCode(0x00db); break;
                                    case 'Uuml': ch = String.fromCharCode(0x00dc); break;
                                    case 'Yacute': ch = String.fromCharCode(0x00dd); break;
                                    case 'THORN': ch = String.fromCharCode(0x00de); break;
                                    case 'szlig': ch = String.fromCharCode(0x00df); break;
                                    case 'agrave': ch = String.fromCharCode(0x00e0); break;
                                    case 'aacute': ch = String.fromCharCode(0x00e1); break;
                                    case 'acirc': ch = String.fromCharCode(0x00e2); break;
                                    case 'atilde': ch = String.fromCharCode(0x00e3); break;
                                    case 'auml': ch = String.fromCharCode(0x00e4); break;
                                    case 'aring': ch = String.fromCharCode(0x00e5); break;
                                    case 'aelig': ch = String.fromCharCode(0x00e6); break;
                                    case 'ccedil': ch = String.fromCharCode(0x00e7); break;
                                    case 'egrave': ch = String.fromCharCode(0x00e8); break;
                                    case 'eacute': ch = String.fromCharCode(0x00e9); break;
                                    case 'ecirc': ch = String.fromCharCode(0x00ea); break;
                                    case 'euml': ch = String.fromCharCode(0x00eb); break;
                                    case 'igrave': ch = String.fromCharCode(0x00ec); break;
                                    case 'iacute': ch = String.fromCharCode(0x00ed); break;
                                    case 'icirc': ch = String.fromCharCode(0x00ee); break;
                                    case 'iuml': ch = String.fromCharCode(0x00ef); break;
                                    case 'eth': ch = String.fromCharCode(0x00f0); break;
                                    case 'ntilde': ch = String.fromCharCode(0x00f1); break;
                                    case 'ograve': ch = String.fromCharCode(0x00f2); break;
                                    case 'oacute': ch = String.fromCharCode(0x00f3); break;
                                    case 'ocirc': ch = String.fromCharCode(0x00f4); break;
                                    case 'otilde': ch = String.fromCharCode(0x00f5); break;
                                    case 'ouml': ch = String.fromCharCode(0x00f6); break;
                                    case 'divide': ch = String.fromCharCode(0x00f7); break;
                                    case 'oslash': ch = String.fromCharCode(0x00f8); break;
                                    case 'ugrave': ch = String.fromCharCode(0x00f9); break;
                                    case 'uacute': ch = String.fromCharCode(0x00fa); break;
                                    case 'ucirc': ch = String.fromCharCode(0x00fb); break;
                                    case 'uuml': ch = String.fromCharCode(0x00fc); break;
                                    case 'yacute': ch = String.fromCharCode(0x00fd); break;
                                    case 'thorn': ch = String.fromCharCode(0x00fe); break;
                                    case 'yuml': ch = String.fromCharCode(0x00ff); break;
                                    case 'OElig': ch = String.fromCharCode(0x0152); break;
                                    case 'oelig': ch = String.fromCharCode(0x0153); break;
                                    case 'Scaron': ch = String.fromCharCode(0x0160); break;
                                    case 'scaron': ch = String.fromCharCode(0x0161); break;
                                    case 'Yuml': ch = String.fromCharCode(0x0178); break;
                                    case 'fnof': ch = String.fromCharCode(0x0192); break;
                                    case 'circ': ch = String.fromCharCode(0x02c6); break;
                                    case 'tilde': ch = String.fromCharCode(0x02dc); break;
                                    case 'Alpha': ch = String.fromCharCode(0x0391); break;
                                    case 'Beta': ch = String.fromCharCode(0x0392); break;
                                    case 'Gamma': ch = String.fromCharCode(0x0393); break;
                                    case 'Delta': ch = String.fromCharCode(0x0394); break;
                                    case 'Epsilon': ch = String.fromCharCode(0x0395); break;
                                    case 'Zeta': ch = String.fromCharCode(0x0396); break;
                                    case 'Eta': ch = String.fromCharCode(0x0397); break;
                                    case 'Theta': ch = String.fromCharCode(0x0398); break;
                                    case 'Iota': ch = String.fromCharCode(0x0399); break;
                                    case 'Kappa': ch = String.fromCharCode(0x039a); break;
                                    case 'Lambda': ch = String.fromCharCode(0x039b); break;
                                    case 'Mu': ch = String.fromCharCode(0x039c); break;
                                    case 'Nu': ch = String.fromCharCode(0x039d); break;
                                    case 'Xi': ch = String.fromCharCode(0x039e); break;
                                    case 'Omicron': ch = String.fromCharCode(0x039f); break;
                                    case 'Pi': ch = String.fromCharCode(0x03a0); break;
                                    case ' Rho ': ch = String.fromCharCode(0x03a1); break;
                                    case 'Sigma': ch = String.fromCharCode(0x03a3); break;
                                    case 'Tau': ch = String.fromCharCode(0x03a4); break;
                                    case 'Upsilon': ch = String.fromCharCode(0x03a5); break;
                                    case 'Phi': ch = String.fromCharCode(0x03a6); break;
                                    case 'Chi': ch = String.fromCharCode(0x03a7); break;
                                    case 'Psi': ch = String.fromCharCode(0x03a8); break;
                                    case 'Omega': ch = String.fromCharCode(0x03a9); break;
                                    case 'alpha': ch = String.fromCharCode(0x03b1); break;
                                    case 'beta': ch = String.fromCharCode(0x03b2); break;
                                    case 'gamma': ch = String.fromCharCode(0x03b3); break;
                                    case 'delta': ch = String.fromCharCode(0x03b4); break;
                                    case 'epsilon': ch = String.fromCharCode(0x03b5); break;
                                    case 'zeta': ch = String.fromCharCode(0x03b6); break;
                                    case 'eta': ch = String.fromCharCode(0x03b7); break;
                                    case 'theta': ch = String.fromCharCode(0x03b8); break;
                                    case 'iota': ch = String.fromCharCode(0x03b9); break;
                                    case 'kappa': ch = String.fromCharCode(0x03ba); break;
                                    case 'lambda': ch = String.fromCharCode(0x03bb); break;
                                    case 'mu': ch = String.fromCharCode(0x03bc); break;
                                    case 'nu': ch = String.fromCharCode(0x03bd); break;
                                    case 'xi': ch = String.fromCharCode(0x03be); break;
                                    case 'omicron': ch = String.fromCharCode(0x03bf); break;
                                    case 'pi': ch = String.fromCharCode(0x03c0); break;
                                    case 'rho': ch = String.fromCharCode(0x03c1); break;
                                    case 'sigmaf': ch = String.fromCharCode(0x03c2); break;
                                    case 'sigma': ch = String.fromCharCode(0x03c3); break;
                                    case 'tau': ch = String.fromCharCode(0x03c4); break;
                                    case 'upsilon': ch = String.fromCharCode(0x03c5); break;
                                    case 'phi': ch = String.fromCharCode(0x03c6); break;
                                    case 'chi': ch = String.fromCharCode(0x03c7); break;
                                    case 'psi': ch = String.fromCharCode(0x03c8); break;
                                    case 'omega': ch = String.fromCharCode(0x03c9); break;
                                    case 'thetasym': ch = String.fromCharCode(0x03d1); break;
                                    case 'upsih': ch = String.fromCharCode(0x03d2); break;
                                    case 'piv': ch = String.fromCharCode(0x03d6); break;
                                    case 'ensp': ch = String.fromCharCode(0x2002); break;
                                    case 'emsp': ch = String.fromCharCode(0x2003); break;
                                    case 'thinsp': ch = String.fromCharCode(0x2009); break;
                                    case 'zwnj': ch = String.fromCharCode(0x200c); break;
                                    case 'zwj': ch = String.fromCharCode(0x200d); break;
                                    case 'lrm': ch = String.fromCharCode(0x200e); break;
                                    case 'rlm': ch = String.fromCharCode(0x200f); break;
                                    case 'ndash': ch = String.fromCharCode(0x2013); break;
                                    case 'mdash': ch = String.fromCharCode(0x2014); break;
                                    case 'lsquo': ch = String.fromCharCode(0x2018); break;
                                    case 'rsquo': ch = String.fromCharCode(0x2019); break;
                                    case 'sbquo': ch = String.fromCharCode(0x201a); break;
                                    case 'ldquo': ch = String.fromCharCode(0x201c); break;
                                    case 'rdquo': ch = String.fromCharCode(0x201d); break;
                                    case 'bdquo': ch = String.fromCharCode(0x201e); break;
                                    case 'dagger': ch = String.fromCharCode(0x2020); break;
                                    case 'Dagger': ch = String.fromCharCode(0x2021); break;
                                    case 'bull': ch = String.fromCharCode(0x2022); break;
                                    case 'hellip': ch = String.fromCharCode(0x2026); break;
                                    case 'permil': ch = String.fromCharCode(0x2030); break;
                                    case 'prime': ch = String.fromCharCode(0x2032); break;
                                    case 'Prime': ch = String.fromCharCode(0x2033); break;
                                    case 'lsaquo': ch = String.fromCharCode(0x2039); break;
                                    case 'rsaquo': ch = String.fromCharCode(0x203a); break;
                                    case 'oline': ch = String.fromCharCode(0x203e); break;
                                    case 'frasl': ch = String.fromCharCode(0x2044); break;
                                    case 'euro': ch = String.fromCharCode(0x20ac); break;
                                    case 'image': ch = String.fromCharCode(0x2111); break;
                                    case 'weierp': ch = String.fromCharCode(0x2118); break;
                                    case 'real': ch = String.fromCharCode(0x211c); break;
                                    case 'trade': ch = String.fromCharCode(0x2122); break;
                                    case 'alefsym': ch = String.fromCharCode(0x2135); break;
                                    case 'larr': ch = String.fromCharCode(0x2190); break;
                                    case 'uarr': ch = String.fromCharCode(0x2191); break;
                                    case 'rarr': ch = String.fromCharCode(0x2192); break;
                                    case 'darr': ch = String.fromCharCode(0x2193); break;
                                    case 'harr': ch = String.fromCharCode(0x2194); break;
                                    case 'crarr': ch = String.fromCharCode(0x21b5); break;
                                    case 'lArr': ch = String.fromCharCode(0x21d0); break;
                                    case 'uArr': ch = String.fromCharCode(0x21d1); break;
                                    case 'rArr': ch = String.fromCharCode(0x21d2); break;
                                    case 'dArr': ch = String.fromCharCode(0x21d3); break;
                                    case 'hArr': ch = String.fromCharCode(0x21d4); break;
                                    case 'forall': ch = String.fromCharCode(0x2200); break;
                                    case 'part': ch = String.fromCharCode(0x2202); break;
                                    case 'exist': ch = String.fromCharCode(0x2203); break;
                                    case 'empty': ch = String.fromCharCode(0x2205); break;
                                    case 'nabla': ch = String.fromCharCode(0x2207); break;
                                    case 'isin': ch = String.fromCharCode(0x2208); break;
                                    case 'notin': ch = String.fromCharCode(0x2209); break;
                                    case 'ni': ch = String.fromCharCode(0x220b); break;
                                    case 'prod': ch = String.fromCharCode(0x220f); break;
                                    case 'sum': ch = String.fromCharCode(0x2211); break;
                                    case 'minus': ch = String.fromCharCode(0x2212); break;
                                    case 'lowast': ch = String.fromCharCode(0x2217); break;
                                    case 'radic': ch = String.fromCharCode(0x221a); break;
                                    case 'prop': ch = String.fromCharCode(0x221d); break;
                                    case 'infin': ch = String.fromCharCode(0x221e); break;
                                    case 'ang': ch = String.fromCharCode(0x2220); break;
                                    case 'and': ch = String.fromCharCode(0x2227); break;
                                    case 'or': ch = String.fromCharCode(0x2228); break;
                                    case 'cap': ch = String.fromCharCode(0x2229); break;
                                    case 'cup': ch = String.fromCharCode(0x222a); break;
                                    case 'int': ch = String.fromCharCode(0x222b); break;
                                    case 'there4': ch = String.fromCharCode(0x2234); break;
                                    case 'sim': ch = String.fromCharCode(0x223c); break;
                                    case 'cong': ch = String.fromCharCode(0x2245); break;
                                    case 'asymp': ch = String.fromCharCode(0x2248); break;
                                    case 'ne': ch = String.fromCharCode(0x2260); break;
                                    case 'equiv': ch = String.fromCharCode(0x2261); break;
                                    case 'le': ch = String.fromCharCode(0x2264); break;
                                    case 'ge': ch = String.fromCharCode(0x2265); break;
                                    case 'sub': ch = String.fromCharCode(0x2282); break;
                                    case 'sup': ch = String.fromCharCode(0x2283); break;
                                    case 'nsub': ch = String.fromCharCode(0x2284); break;
                                    case 'sube': ch = String.fromCharCode(0x2286); break;
                                    case 'supe': ch = String.fromCharCode(0x2287); break;
                                    case 'oplus': ch = String.fromCharCode(0x2295); break;
                                    case 'otimes': ch = String.fromCharCode(0x2297); break;
                                    case 'perp': ch = String.fromCharCode(0x22a5); break;
                                    case 'sdot': ch = String.fromCharCode(0x22c5); break;
                                    case 'lceil': ch = String.fromCharCode(0x2308); break;
                                    case 'rceil': ch = String.fromCharCode(0x2309); break;
                                    case 'lfloor': ch = String.fromCharCode(0x230a); break;
                                    case 'rfloor': ch = String.fromCharCode(0x230b); break;
                                    case 'lang': ch = String.fromCharCode(0x2329); break;
                                    case 'rang': ch = String.fromCharCode(0x232a); break;
                                    case 'loz': ch = String.fromCharCode(0x25ca); break;
                                    case 'spades': ch = String.fromCharCode(0x2660); break;
                                    case 'clubs': ch = String.fromCharCode(0x2663); break;
                                    case 'hearts': ch = String.fromCharCode(0x2665); break;
                                    case 'diams': ch = String.fromCharCode(0x2666); break;
                                    default: ch = ''; break;
                              }
                        }
                        i = semicolonIndex;
                  }
            }
            out += ch;
      }

      return out;
}

 
// Simulates PHP's date function
Date.prototype.format = function(format) {
	var returnStr = '';
	var replace = Date.replaceChars;
	for (var i = 0; i < format.length; i++) {
		var curChar = format.charAt(i);
		if (i - 1 >= 0 && format.charAt(i - 1) == "\\") { 
			returnStr += curChar;
		}
		else if (replace[curChar]) {
			returnStr += replace[curChar].call(this);
		} else if (curChar != "\\"){
			returnStr += curChar;
		}
	}
	return returnStr;
};
 
Date.replaceChars = {
	shortMonths: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
	longMonths: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
	shortDays: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
	longDays: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
	
	// Day
	d: function() { return (this.getDate() < 10 ? '0' : '') + this.getDate(); },
	D: function() { return Date.replaceChars.shortDays[this.getDay()]; },
	j: function() { return this.getDate(); },
	l: function() { return Date.replaceChars.longDays[this.getDay()]; },
	N: function() { return this.getDay() + 1; },
	S: function() { return (this.getDate() % 10 == 1 && this.getDate() != 11 ? 'st' : (this.getDate() % 10 == 2 && this.getDate() != 12 ? 'nd' : (this.getDate() % 10 == 3 && this.getDate() != 13 ? 'rd' : 'th'))); },
	w: function() { return this.getDay(); },
	z: function() { var d = new Date(this.getFullYear(),0,1); return Math.ceil((this - d) / 86400000); }, // Fixed now
	// Week
	W: function() { var d = new Date(this.getFullYear(), 0, 1); return Math.ceil((((this - d) / 86400000) + d.getDay() + 1) / 7); }, // Fixed now
	// Month
	F: function() { return Date.replaceChars.longMonths[this.getMonth()]; },
	m: function() { return (this.getMonth() < 9 ? '0' : '') + (this.getMonth() + 1); },
	M: function() { return Date.replaceChars.shortMonths[this.getMonth()]; },
	n: function() { return this.getMonth() + 1; },
	t: function() { var d = new Date(); return new Date(d.getFullYear(), d.getMonth(), 0).getDate() }, // Fixed now, gets #days of date
	// Year
	L: function() { var year = this.getFullYear(); return (year % 400 == 0 || (year % 100 != 0 && year % 4 == 0)); },	// Fixed now
	o: function() { var d  = new Date(this.valueOf());  d.setDate(d.getDate() - ((this.getDay() + 6) % 7) + 3); return d.getFullYear();}, //Fixed now
	Y: function() { return this.getFullYear(); },
	y: function() { return ('' + this.getFullYear()).substr(2); },
	// Time
	a: function() { return this.getHours() < 12 ? 'am' : 'pm'; },
	A: function() { return this.getHours() < 12 ? 'AM' : 'PM'; },
	B: function() { return Math.floor((((this.getUTCHours() + 1) % 24) + this.getUTCMinutes() / 60 + this.getUTCSeconds() / 3600) * 1000 / 24); }, // Fixed now
	g: function() { return this.getHours() % 12 || 12; },
	G: function() { return this.getHours(); },
	h: function() { return ((this.getHours() % 12 || 12) < 10 ? '0' : '') + (this.getHours() % 12 || 12); },
	H: function() { return (this.getHours() < 10 ? '0' : '') + this.getHours(); },
	i: function() { return (this.getMinutes() < 10 ? '0' : '') + this.getMinutes(); },
	s: function() { return (this.getSeconds() < 10 ? '0' : '') + this.getSeconds(); },
	u: function() { var m = this.getMilliseconds(); return (m < 10 ? '00' : (m < 100 ?
'0' : '')) + m; },
	// Timezone
	e: function() { return "Not Yet Supported"; },
	I: function() { return "Not Yet Supported"; },
	O: function() { return (-this.getTimezoneOffset() < 0 ? '-' : '+') + (Math.abs(this.getTimezoneOffset() / 60) < 10 ? '0' : '') + (Math.abs(this.getTimezoneOffset() / 60)) + '00'; },
	P: function() { return (-this.getTimezoneOffset() < 0 ? '-' : '+') + (Math.abs(this.getTimezoneOffset() / 60) < 10 ? '0' : '') + (Math.abs(this.getTimezoneOffset() / 60)) + ':00'; }, // Fixed now
	T: function() { var m = this.getMonth(); this.setMonth(0); var result = this.toTimeString().replace(/^.+ \(?([^\)]+)\)?$/, '$1'); this.setMonth(m); return result;},
	Z: function() { return -this.getTimezoneOffset() * 60; },
	// Full Date/Time
	c: function() { return this.format("Y-m-d\\TH:i:sP"); }, // Fixed now
	r: function() { return this.toString(); },
	U: function() { return this.getTime() / 1000; }
};