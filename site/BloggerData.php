<?php
/**
 * Description of ExternalData
 *
 * implemented retrieval of external data (Blogger, Twitter, etc.), including cached data from dB and
 * and new from the provider itself
 *
 * @author Alex Slepak
 */

require_once("DBConnect.php");
require_once("post.php");
require_once("defines.php");

class ExternalData
{
    private $dbCon;
    private $script = "";
    private $rgNewPosts = null;
    private $siteid;
    
    private $bloggerLast;
    private $lastPostDate;
    private $twitterLastId;
    private $fbLast;
    private $title;
    private $startDate;
    private $center;
    private $label;
    private $twitterUser;
	private $debug = 0;

    private $urlFeed;

    function __construct($siteid)
    {
        $this->siteid = $siteid;
        $this->dbCon = new DBConnect();

        $timezone = 'GMT';
        $query = preg_replace("/__SITEID__/", $this->siteid, QUERY_MASTER);
        $result = $this->dbCon->RunQuery($query);
        $row = mysql_fetch_object($result);     // no while loop here - there should only be one entry per site
        $this->bloggerLast = $row->blogupdate;
        $this->twitterLastId = $row->twitterlastid;
        $this->twitterUser = $row->twitteruser;
        $this->fbLast = $row->fbupdate;
        $this->urlFeed = $row->feed;
        $this->title = $row->title;
		$this->lastPostDate = null;
		$this->endDate = $row->enddate;
		$this->twitterLastDate = $row->twitterlastdate;
        if ($row->timezone != null)
        {
            $timezone = $row->timezone;
            //date_default_timezone_set('America/Los_Angeles');
            date_default_timezone_set($timezone);
        }
        $this->startDate = strtotime($row->startdate);
        $this->center = $row->center;
        $this->label = $row->label;

        // start the main div that'll hold all the posts
        echo "<div style=\"width:" . WIDTH . "\" id=\"idItemsList\">";
    }

    public function GetCachedCenter()
    {
        return $this->center;
    }

    public function GetLabel()
    {
        return $this->label;
    }

    public function GetCachedPosts()
    {
        $query = preg_replace("/__SITEID__/", $this->siteid, QUERY_POSTS);
		$this->RunAndProcessQuery($query);
	}
	
	public function GetPhotoAlbums()
	{
		$this->RunAndProcessQuery(QUERY_ALL_ALBUMS);	
	}
		
	private function RunAndProcessQuery($query)
	{
        $result = $this->dbCon->RunQuery($query);

        while ($row = mysql_fetch_object($result))
        {
            $post = null;
            switch ($row->type)
            {
                case LOC:
                    $post = new LocationPost();
                    break;
                case BLOG:
                    $post = new BlogPost();
                    break;
                case PIC:
                    $post = new PicPost();
                    break;
            }
            $post->Init($row, $this->startDate, $this->dbCon);
            $this->script = $post->GetScript() . $this->script;
            $post->OutputPost($this->siteid);
        }
    }
	
	private function DebugOutputDates($lastDate, $string)
	{
		if ($this->debug)
		{
			echo "is enddate null: " . (($this->endDate == null) ? "true" : "false") . "<br />";
			$end = strtotime($this->endDate);
			$last = strtotime($lastDate);
			echo "end: " . date('Y-m-d', $end) . "<br />" . "$string last: " . date('Y-m-d', $last) . "<br />" . ($last < $end) . "<br />";
			if ($last < $end)
				echo "$string last is Less than enddate! Need to check for updates <br />";
			else
				echo "$string last is Greater than (or equal to) enddate! Nothing to see here <br /><br />";
		}
	}

    public function GetNewPosts()
    {
        $count = 0;
		$this->DebugOutputDates($this->bloggerLast, "Blogger");
        if ((($this->endDate == null) || (strtotime($this->bloggerLast) < strtotime($this->endDate))) && ($this->urlFeed != null))
        {
			// BUGBUG (id: 18) - we really need to do $this->bloggerLast + 1 sec, but having trouble parsing what I get from blogger and turning it into a proper date...
			// BUGBUG (id: 19) - check for edited/deleted posts too!
			$dtToday = date('Y-m-d', strtotime(date('Y-m-d', time()) . "+1 day"));
            $url = $this->urlFeed . "?published-min=" . $this->bloggerLast . "&published-max=" . $dtToday . "&alt=json";
			if ($debug)
				echo $url . "<br />";

            // Open the Curl session
            $session = curl_init($url);

            // Return the call not the headers
            curl_setopt($session, CURLOPT_HEADER, false);
            curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

            if ( !function_exists('json_decode') ){
                function json_decode($content, $assoc=false){
                            require_once 'json.php';
                            if ( $assoc ){
                                $json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
                    } else {
                                $json = new Services_JSON;
                            }
                    return $json->decode($content);
                }
            }

            // get the data
            $this->rgNewPosts = json_decode(curl_exec($session), true);
            if ($this->rgNewPosts != null)
            {
                $t = '$t';
                $index = 0;

                if ($this->rgNewPosts["feed"]["entry"] != null)
                {
                    $count = count($this->rgNewPosts["feed"]["entry"]);
//					echo "# new posts: " . $count . "<br />";
					$postindex = 0; 
                    foreach ($this->rgNewPosts["feed"]["entry"] as $entry)
                    {
						if ($postindex >= ($count -1))
						{
							break;
						}
						$postindex++;

                        // parse the data
                        $url = $this->getUrl($entry["link"]);
                        $dt = $entry["published"][$t];
						if ($index == 0)		// last comes first
						{
							$this->lastPostDate = $dt;
						}
                        $title = $entry["title"][$t];
//						echo "\"$title\" published on: $dt<br />";
                        $author = $entry["author"][0]["name"][$t];
                        $content = $entry["content"][$t];
                        $tags = "";
                        foreach ($entry["category"] as $tag)
                        {
                            if ($tags == "")
                            {
                                $tags = $tag["term"];
                            }
                            else
                            {
                                $tags = $tags . "," . $tag["term"];
                            }
                        }

                        $post = new BlogPost();
                        $post->InitCore($url, $dt, $title, $author, $content, "_" . $index++, $tags, $this->startDate);

                        $this->script = $post->GetScript() . $this->script;
                        $post->OutputPost($this->siteid);
                    }
                }
            }
        }

		// get new location updates from twitter, if needed
		// if endDate is null, this trip is ongoing. if endDate is not null, but the last twitter update date is less than the endDate, there
		// could be some updates in between that need to be processed.
		// BUGBUG Assumption: twitterLastId and twitterLastDate are always in sync(!). Change the twitter URL to act on date if possible?
		$this->DebugOutputDates($this->twitterLastDate, "twit");
		
		if (($this->endDate == null) || (strtotime($this->twitterLastDate) < strtotime($this->endDate)))
		{
			// Open the Curl session
			$url = "http://twitter.com/statuses/user_timeline/" . $this->twitterUser . ".json?since_id=" . $this->twitterLastId;
			if ($debug)
				echo $url;
			$session = curl_init($url);

			// Return the call not the headers
			curl_setopt($session, CURLOPT_HEADER, false);
			curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

			// call the data
			$data = curl_exec($session);
			curl_close($session);
			$array = json_decode($data, true);
			$lastId = $this->twitterLastId;
			$lastDate = $this->endDate;
			if ($array != null)
			{
				foreach ($array as $tweet)
				{
					$dt = strtotime($tweet["created_at"]);
					if ($dt > strtotime($this->endDate))			// as soon as we exceed the end date of this trip, break out
					{
						break;
					}
					$post = new LocationPost();
					$post->Init3($dt, $this->startDate, $tweet["text"], $tweet["id"], $this->dbCon);
					$this->script = $post->GetScript() . $this->script;
					$post->OutputPost($this->siteid);
					if ($tweet["id"] > $lastId)
					{
						$lastId = $tweet["id"];
						$lastDate = $tweet["created_at"];
					}
				}
			}
			// run this even if the twitterLastId didn't change - if we got into here, that means twitterLastDate needs to be updated
			$query = "UPDATE master SET twitterlastid=\"" . $lastId . "\", twitterlastdate=\"" . $lastDate . "\" where siteid=" . $this->siteid . ";";
			$this->dbCon->RunQuery($query);
		}
        
/*        if (false)
        {
            $result = $this->dbCon->RunQuery("SELECT * FROM newlocs WHERE siteid=" . $this->siteid . " ORDER BY id ASC");
            $dtLast = null;
            $dtLastDb = strtotime($this->twitterLast);
            while ($row = mysql_fetch_object($result))
            {
                $dt = strtotime($row->date);
                if ($dt > $dtLastDb)
                {
                    if ($dt > $dtLast)
                    {
                        $dtLast = $dt;
                    }
                    $post = new LocationPost();
                    $post->Init2($row, $this->startDate, $this->dbCon);
                    $this->script = $post->GetScript() . $this->script;
                    $post->OutputPost($this->siteid);
                }
            }

            if ($dtLast != null)
            {
                $dtLastStr = date('Y-m-d H:i:s', $dtLast);
                $query = "UPDATE `master` m SET twitterupdate=\"" . $dtLastStr . "\" where siteid=" . $this->siteid . ";";
                $this->dbCon->RunQuery($query);
            }

        }*/

        return $count-1;
    }

    public function UpdateCache()       // add new data to the dB
    {
        $t = '$t';
        if ($this->rgNewPosts != null)
        {
			$count = count($this->rgNewPosts["feed"]["entry"]);
			$postIndex = 0;
            foreach ($this->rgNewPosts["feed"]["entry"] as $entry)
            {
				if ($postIndex >= ($count - 1))
				{
					break;
				}
				$postIndex++;
                $dtstr = date('Y-m-d H:i:s', strtotime($entry["published"][$t]));
                $title = $entry["title"][$t];
                $content = htmlentities($entry["content"][$t]);
                $url = urlencode($this->getUrl($entry["link"]));
                $author = $entry["author"][0]["name"][$t];
                $tags = "";
                foreach ($entry["category"] as $tag)
                {
                    if ($tags == "")
                    {
                        $tags = $tag["term"];
                    }
                    else
                    {
                        $tags = $tags . "," . $tag["term"];
                    }
                }
                $query = "INSERT INTO rr2008_msgs (type, date, title, author, url, text, tags, siteid) VALUES(" .
                    BLOG . ", \"$dtstr\",\"$title\",\"$author\",\"$url\",\"$content\",\"" . $tags . "\"," . $this->siteid . ");";
//				echo $query;
                $this->dbCon->RunQuery($query);
            }
			if ($this->lastPostDate != null)
			{
				$query = "UPDATE `master` m SET blogupdate=\"" . $this->lastPostDate . "\" where siteid=" . $this->siteid . ";";
            	$this->dbCon->RunQuery($query);
			}
        }
    }

    private function getUrl($rgLinks)
    {
        $url = "http://safety3rd.blogspot.com";
        foreach ($rgLinks as $link)
        {
            if (($link["type"] == "text/html") && ($link["rel"] == "alternate"))
            {
                $url = $link["href"];
                break;
            }
        }

        return $url;
    }

    public function FinalizeOutput()
    {
        echo "</div>\n";
        echo "<script type=\"text/javascript\">\n";
        echo "try {\n";
        echo "document.title = \"" . $this->title . "\";\n";
        echo "var rgLocations = [];\n";
        echo "var rgTags = [];\n";
        echo $this->script;
        echo "} catch(e)\n{alert(e.message);}\n";
        echo "</script>";
    }
}
?>
