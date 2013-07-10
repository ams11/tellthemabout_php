<?php
require_once("defines.php");
require_once("DBConnect.php");

 define ('LOC', 0);
 define ('BLOG', 1);
 define ('PIC', 2);

/**
 * class Post
 *
 * @author Alex Slepak
 */
abstract class Post
{
    protected $url;
    protected $header;
    protected $title;
    protected $author;
    protected $content;
    protected $index;
    protected $script;
    protected $rgTags;
	
	protected $dbCon;

    abstract public function Init($row, $startDate, $dbCon);
    abstract protected function getSpriteImgParams();
	abstract protected function Type();

    private function echoSpriteImg($rgImgParams)
    {
        $style = "style=\"margin-right: " . $rgImgParams["margin-right"] . "px;" .
                 "background-position: 0 -" . $rgImgParams["background-position"] . "px;" .
                 "height: " . $rgImgParams["height"] . "px !important;" .
                 "width:" . $rgImgParams["width"] . "px;\"";
        echo "<img class=\"sprite\" " . $style . " src=\"/img/menu/blank.gif\" />";
    }

    public function OutputPost($siteid)
    {
		$author = $this->author;
        $rgImages = array(
            'slepak' => 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/hs304.ash1/23138_1046387715_5681_q.jpg',
            'lott' => 'http://profile.ak.fbcdn.net/v223/450/15/q587101572_6319.jpg',
            'logan' => 'http://profile.ak.fbcdn.net/profile/1786/109/q1305102_18848.jpg',
            'cyrus' => 'http://profile.ak.fbcdn.net/profile5/1361/101/q780240513_2658.jpg'
        );

        switch (strtolower($author))
        {
            case 'alex':
                $img = $rgImages['slepak'];
                $profile = "http://www.facebook.com/profile.php?id=1046387715";
                break;
            case 'dlott':
                $img = $rgImages['lott'];
                $profile = "http://www.facebook.com/david.t.lott";
                break;
            case 'logan':
                $img = $rgImages['logan'];
                $profile = "http://www.facebook.com/profile.php?id=1305102";
                break;
            case 'cyrus':
                $img = $rgImages['cyrus'];
                $profile = "http://www.facebook.com/profile.php?id=1046387715&ref=mf";
                break;
            default:
				if ($siteid == 4)
				{
					$img = "/img/quark.gif";
					$author = "Akademik Ioffe";
					$profile = "http://www.quarkexpeditions.com/our-ships/akademik-ioffe";
				}
				else
				{
					$img = "http://www.theadventurists.com/images/team_list_logos/305.jpeg";
					$profile = "http://rickshawrun08w.theadventurists.com/index.php?mode=team&sub=display&pagemode=ontheroad&name=SafetyThird";
				}
                break;
        }
        if ($this->url == "")
        {
            $url2 = "";     // or javascript:void(0)
            $target = "";
        }
        else
        {
            $url2 = "href=\"" . urldecode($this->url) . "\"";
            $target = "target=\"blog\"";
        }

        // output the data
        $tagCount = ($this->rgTags != null) ? count($this->rgTags) : 0;
        echo "<div class=\"item\" id=\"div" . $this->index . "\" tagCount=\"" . $tagCount . "\">\n";
        echo "<a title=\"" . $author . "\" href=\"" . $profile . "\" target=\"_profile\">";
        echo "<img class=\"itemPic\" alt=\"" . $author . "\" src=\"" . $img . "\"/></a>\n";
        echo "<div class=\"itemBody\">\n";
        echo "<h3 id=\"idh3\"><a " . $target . " id=\"a" . $this->index . "\"" . $url2 . ">" . $this->title . "</a></h3>\n";
        echo "<span class=\"itemHead\" style=\"min-height:16px\" id=\"head\">\n";
        $this->echoSpriteImg($this->getSpriteImgParams());
        echo $this->header . "\n";
        $len = strlen(trim($this->content));
        if ($len > 0)
        {
            if (($len > 300) && ($this->Type() != PIC))
            {
                echo "<span id=\"less\" class=\"mylink itemLess\"><a onclick=\"hide(document.getElementById('div" . $this->index . "'));\">Hide</a></span>" . "\n";
            }
			$class = "itemPost";
			if ($this->Type() != PIC)
			{
				$class .= " itemWBorderL";
			}
            echo "</span>\n<div class=\"" . $class . "\" id=\"itemPost\">\n<span id=\"begin\">";     // close the itemHead span
			if ($this->Type() == PIC)
			{
				echo $this->content . "</span>\n";
			}
            else if ($len < 300)     // Blogger is embedding a tracker DIV at the end of each post - get rid of it!
            {
                echo substr(strip_tags($this->content), 0, 300) . "</span>";
            }
            else
            {
                echo substr(strip_tags($this->content), 0, 300) . "</span><span id=\"dots\">...&nbsp;</span>";
                echo "<span class=\"mylink\" id=\"more\"><a onclick=\"show(document.getElementById('div" . $this->index . "'));\">Read More</a></span>";
                echo "<span id=\"hidden\" style=\"display:none\">";
                echo $this->content . "</span>\n";
            }
            echo "</div>";
        }
        else
        {
            echo "</span>\n";
        }
        if ($this->rgTags != null)
        {
            echo "<div class=\"itemHead tagDiv\">";
            //$this->echoSpriteImg(array("margin-right" => 5,"background-position" => 1566,"height" => 12,"width" => 13));
            echo "<span class=\"bold\" style=\"background: transparent url(/img/tag.jpg) no-repeat scroll left; padding-left:16px\">Tags:&nbsp;</span>";
            $indexTag = 0;
            foreach ($this->rgTags as $tag)
            {
                if ($indexTag > 0)
                {
                    echo ",&nbsp;";
                }
                echo "<a id=\"aid" . $this->index . $indexTag . "\">" . trim($tag) . "</a>";
                $indexTag++;
            }
            echo "</div>";
        }
        echo "</div></div>\n\n";
    }

    public function GetScript()
    {
        return $this->script;
    }
	
	protected function ParseTags($tags, $prefix)
	{
        if (($tags != null) && (strlen($tags) > 0))
        {
            $this->rgTags = explode(",", $tags);
            $indexTag = 0;
            foreach ($this->rgTags as $tag)
            {
                $this->script .= "AddToArray(rgTags, \"" . trim($this->rgTags[$indexTag]) . "\",\"" . $prefix . ":" . $this->index . "\");\n";
                $indexTag++;
            }
        }
        else
        {
            $this->rgTags = null;
            $this->script = "";
        }
	}
}

class PicPost extends Post
{
	protected function Type()
	{
		return PIC;
	}

	public function Init($row, $startDate, $dbCon)
	{
        // BUGBUG id:13, get rid of the switch when moving to dB
        $profileUrl = "http://rickshawrun08w.theadventurists.com/index.php?mode=team&sub=display&pagemode=ontheroad&name=SafetyThird";
        switch (strtolower($row->author))
        {
            case 'alex':
                $profileUrl = "http://www.facebook.com/profile.php?id=1046387715&ref=mf";
                break;
            case 'dlott':
                $profileUrl = "http://www.facebook.com/profile.php?id=1046387715&ref=mf";
                break;
            case 'logan':
                $profileUrl = "http://www.facebook.com/profile.php?id=1046387715&ref=mf";
                break;
            case 'cyrus':
                $profileUrl = "http://www.facebook.com/profile.php?id=1046387715&ref=mf";
                break;
        }

        $this->url = $row->url;
        $this->author = trim($row->author);
        $this->header = "Posted by <a href=\"" . $profileUrl . "\" target=\"_profile\">$this->author</a> on " . date('l, F j, Y', strtotime($row->date));
        $this->title = trim($row->title);
        $this->index = $row->id;
        $this->ParseTags($row->tags, "ph");
		
        $query = preg_replace("/__PHOTOID__/", $this->index, QUERY_PICS);
        $result = $dbCon->RunQuery($query);
        $this->content = "<div class=\"picsDiv\" id=\"picsDiv\">\n";
        $rowPics = mysql_fetch_object($result);
		if (($rowPics->imgurl1 != null) && ($rowPics->url1 != null))
		{
			$this->content .= "<div class=\"picDiv picDivMore\">" . "<a target=\"blog\" href=\"" . $rowPics->url1 . "\">\n";
			$this->content .= "<div class=\"picInnerDiv\" onmouseover=\"this.className='picInnerDivMouseOver';\" onmouseout=\"this.className='picInnerDiv';\">" . 
							"<img alt=\"\" src=\"" . $rowPics->imgurl1 . "\"/></div></a></div>";
		}
		if (($rowPics->imgurl2 != null) && ($rowPics->url2 != null))
		{
			$this->content .= "<div class=\"picDiv picDivMore\" id=\"idPic2\">" . "<a target=\"blog\" href=\"" . $rowPics->url2 . "\">\n";
			$this->content .= "<div class=\"picInnerDiv\" onmouseover=\"this.className='picInnerDivMouseOver';\" onmouseout=\"this.className='picInnerDiv';\">" . 
							"<img alt=\"\" src=\"" . $rowPics->imgurl2 . "\"/></div></a></div>";
		}
		if (($rowPics->imgurl3 != null) && ($rowPics->url3 != null))
		{
			$this->content .= "<div class=\"picDiv\" id=\"idPic3\">" . "<a target=\"blog\" href=\"" . $rowPics->url3 . "\">\n";
			$this->content .= "<div class=\"picInnerDiv\" onmouseover=\"this.className='picInnerDivMouseOver';\" onmouseout=\"this.className='picInnerDiv';\">" . 
							"<img alt=\"\" src=\"" . $rowPics->imgurl3 . "\"/></div></a></div>";
		}
		$this->content .= "</div><div class=\"itemHead picCount\"><span class=\"bold\">photo album <a target=\"blog\" href=\"" . $this->url . "\">" . $this->title . "</a></span>:&nbsp;" . $rowPics->count . " new photos</div>";
	}
	
	protected function getSpriteImgParams()
	{
        // style="margin-right: 5px;background-position: 0 -990px;height: 15px !important;width:16px;";
        return array("margin-right" => 5,
                     "background-position" => 990,
                     "height" => 15,
                     "width" => 16);	
	}
}

class BlogPost extends Post
{
	protected function Type()
	{
		return BLOG;
	}

    public function Init($row, $startDate, $dbCon)
    {
        $this->InitCore($row->url, $row->date, $row->title, $row->author, $row->text, $row->id, $row->tags, $startDate);
    }

    protected function getSpriteImgParams()
    {
        // style="margin-right: 5px;background-position: 0 -1320px;height: 15px !important;width:16px;";
        return array("margin-right" => 5,
                     "background-position" => 1320,
                     "height" => 15,
                     "width" => 16);
    }

    public function InitCore($url, $date, $title, $author, $content, $index, $tags, $startDate)
    {
        // BUGBUG id:13, get rid of the switch when moving to dB
        $profileUrl = "http://rickshawrun08w.theadventurists.com/index.php?mode=team&sub=display&pagemode=ontheroad&name=SafetyThird";
        switch (strtolower($author))
        {
            case 'alex':
                $profileUrl = "http://www.facebook.com/profile.php?id=1046387715&ref=mf";
                break;
            case 'dlott':
                $profileUrl = "http://www.facebook.com/profile.php?id=1046387715&ref=mf";
                break;
            case 'logan':
                $profileUrl = "http://www.facebook.com/profile.php?id=1046387715&ref=mf";
                break;
            case 'cyrus':
                $profileUrl = "http://www.facebook.com/profile.php?id=1046387715&ref=mf";
                break;
        }

        $this->url = $url;
        $this->author = trim($author);
        $this->header = "Posted by <a href=\"" . $profileUrl . "\" target=\"_profile\">$this->author</a> on " . date('l, F j, Y', strtotime($date));
        $this->title = trim($title);
        $this->content = html_entity_decode($content);
        $this->index = $index;
		$this->ParseTags($tags, "bg");
    }
}

class LocationPost extends Post
{
	protected function Type()
	{
		return LOC;
	}

    private function _hastime($dttime)
    {
            $hr = date('H', $dttime);
            if ($hr == "00")
            {
                    $min = date('i', $dttime);
                    if ($min == "00")
                    {
                            $sec = date('s', $dttime);
                            if ($sec == "00")
                                    return false;
                    }
            }
            return true;
    }

    public function Init($row, $startDate, $dbCon)
    {
        $datetime = strtotime($row->date);
        $dtstr = $this->_hastime($datetime) ? date('j M, Y, H:i', $datetime) . " GMT" :
                                              date('j M, Y', $datetime);
        $this->url = "";
        $day = floor(($datetime - $startDate)/60/60/24)+1;
        $this->header = "Day " . $day . ": " . $dtstr;
        $this->title = trim($row->loc);
        $this->author = "Safety Third";
        $this->content = trim($row->text);
        $this->index = $row->id;
        $this->rgTags = null;
        $msg = str_replace("\r\n", "", $this->content);
        $msg = str_replace("\"", "\\\"", $msg);
        $point = (($row->lat != null) && ($row->lng != null)) ? "new GLatLng($row->lat, $row->lng)" : "null";
        $ptIndex = ($row->ptIndex != null) ? $row->ptIndex : "null";
        $this->script = "rgLocations.push(new Location($row->id, \"$this->title\", $day, \"$dtstr\", null, \"$msg\", $point, null, $ptIndex));\n" . $this->script;
    }

/*    public function Init2($row, $startDate, $dbCon)
    {
        $datetime = strtotime($row->date);
        $dtstr = $this->_hastime($datetime) ? date('j M, Y, H:i', $datetime) . " GMT" :
                                              date('j M, Y', $datetime);
        $this->url = "";
        $this->header = "Day " . "2" . ": " . $dtstr;
        $rgParts = explode(":", $row->text, 2);
		echo "got text: " . $row->text . "<br />";
        if (count($rgParts) > 0)
        {
            if (preg_match("/^[[:alnum:]]{3}\.([[:alnum:]]{2}\.)?[[:alnum:]]{3}(s|f)?$/", $rgParts[0]))
            {
                if (preg_match("/[[:alnum:]]{3}(s|f){1}$/", $rgParts[0]))
                {
                    $code = substr($rgParts[0], 0, strlen($rgParts[0])-1);
                    $type = substr($rgParts[0], -1);
                }
                else
                {
                    $code = $rgParts[0];
                    $type = null;
                }
                $query = "SELECT * FROM loccodes where abbr=\"" . $code . "\"";
                $result = $dbCon->RunQuery($query);
                $loc = mysql_fetch_object($result);
                $this->title = $loc->name;
                $point = "new GLatLng($loc->lat, $loc->lng)";
            }
            else
            {
                $this->title = $rgParts[0];
                $point = "null";
            }
            $this->content = trim($rgParts[1]);
        }
        else
        {
            $this->title = "Title";
            $this->content = trim($row->text);
        }
        $this->author = "Safety Third";
        $this->index = $row->id + 200;
        $this->rgTags = null;
        $msg = str_replace("\r\n", "", $this->content);
        $msg = str_replace("\"", "\\\"", $msg);
        $ptIndex = "null";
        $day = floor(($datetime - $startDate)/60/60/24);
        $strType = ($type == null) ? "null" : "\"" . $type . "\"";
        $this->script = "rgLocations.push(new Location($this->index, \"$this->title\", \"" . $day . "\", \"$dtstr\", \"$datetime\", \"$msg\", $point, null, null, true, $strType));\n" . $this->script;
    }*/

    public function Init3($date, $startDate, $text, $id, $dbCon)
    {
        $dtstr = $this->_hastime($date) ? date('j M, Y, H:i', $date) . " GMT" :
                                              date('j M, Y', $date);
        $this->url = "";
        $day = floor(($date - $startDate)/60/60/24);
        $this->header = "Day " . $day . ": " . $dtstr;
        $rgParts = explode("::", $text, 2);
        if (count($rgParts) > 1)
        {
            if (preg_match("/^[[:alnum:]]{3}\.([[:alnum:]]{2}\.)?[[:alnum:]]{3}(s|f)?$/", $rgParts[0]))
            {
                if (preg_match("/[[:alnum:]]{3}(s|f){1}$/", $rgParts[0]))
                {
                    $code = substr($rgParts[0], 0, strlen($rgParts[0])-1);
                    $type = substr($rgParts[0], -1);
                }
                else
                {
                    $code = $rgParts[0];
                    $type = null;
                }
                if ($code == "SIR.PPC")
                {
                    $code = "PHP.PPC";
                }
                $query = "SELECT * FROM loccodes where abbr=\"" . $code . "\"";
                $result = $dbCon->RunQuery($query);
                $loc = mysql_fetch_object($result);
                $this->title = $loc->name;
                $point = "new GLatLng($loc->lat, $loc->lng)";
            }
            else
            {
                $this->title = $rgParts[0];
                $point = "null";
            }
            $this->content = trim($rgParts[1]);
        }
        else
        {
            $this->title = "Safety Third!";
            $this->content = trim($text);
            $point = "null";
        }
        $this->author = "Safety Third";
        $this->index = $id;
        $this->rgTags = null;
        $msg = str_replace("\r\n", "", $this->content);
        $msg = str_replace("\"", "\\\"", $msg);
        $ptIndex = "null";
        $strType = ($type == null) ? "null" : "\"" . $type . "\"";
        $this->script = "rgLocations.push(new Location($this->index, \"$this->title\", \"" . $day . "\", \"$dtstr\", \"$date\", \"$msg\", $point, null, null, true, $strType));\n" . $this->script;
    }

    protected function getSpriteImgParams()
    {
        // style="margin-right: 2px;background-position: 0 -1540px;height: 11px !important;width:16px;";
        return array("margin-right" => 2,
                     "background-position" => 1540,
                     "height" => 11,
                     "width" => 16);
    }
}
?>
