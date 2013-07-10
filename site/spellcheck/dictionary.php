<?php
    session_start();

    if (array_key_exists("url", $_GET))
    {
        $_SESSION['dictionary'] = new Dictionary($_GET['url']);
    }
    else if (array_key_exists("random", $_GET) && ($_GET['random']) && ($_SESSION['dictionary'] != null))
    {
        $dictionary = $_SESSION['dictionary'];
        $dictionary->Randomize();
    }

    class Dictionary
    {
        private $url;
        private $rgPatterns;

        function __construct($url)
        {
            $error = null;
            $this->url = $url;
            // Open the Curl session
            $session = curl_init($url);

            // Return the call not the headers
            curl_setopt($session, CURLOPT_HEADER, false);
            curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($session, CURLOPT_FAILONERROR, true);

            // get the data
            if ($error = curl_error($session))
                echo 'ERROR: ',$error;
            $rgWords = preg_split("/,/", curl_exec($session), -1);
            $this->rgPatterns = array();
            for ($w = 0; $w < count($rgWords); $w++)
            {
                $word = strtolower(trim($rgWords[$w]));
                $vowel = 1;
                $rgLetters = preg_split("//", $word);
                $pattern = "/^";
                for ($l = 1; $l < (count($rgLetters)-1); $l++)
                {
                    $letter = $rgLetters[$l];
                    if (preg_match("/[aouie]/", $letter))
                    {
                        $pattern .= ("([aouie])\\" . $vowel . "*");
                        $vowel = $vowel + 1;
                    }
                    else
                    {
                        $pattern .= ($letter . "+");
                    }
                }
                $pattern .= "$/";
                array_push($this->rgPatterns, array('word' => $word, 'pattern' => $pattern));
            }

            curl_close($session);

            if ($error == null)
            {
                echo "SUCCESS";
                $this->PrintList();
            }
        }

        function GetUrl()
        {
            return $this->url;
        }

        function CheckSpelling($word)
        {
            $answer = "NO SUGGESTIONS";

            foreach ($this->rgPatterns as $pattern)
            {
//                echo "pattern: " . $pattern['pattern'] . "\n" . " word: " . $word . "\n";
                if (preg_match($pattern['pattern'], strtolower($word)))
                {
                    $answer = $pattern['word'];
                }
            }

            echo $answer;
            return ($answer == "NO SUGGESTIONS");
        }

        function PrintList()
        {
            foreach ($this->rgPatterns as $pattern)
            {
                echo $pattern['word'] . "<br /> ";
            }
        }

        function Randomize()
        {
            $fFail = 0;
            $rgVowels = array('a', 'e', 'i', 'o', 'u');
            for ($c = 0; $c < 100; $c++)
            {
                $word = $this->rgPatterns[rand(0, count($this->rgPatterns)-1)]['word'];
                $rgLetters = preg_split("//", $word);
                $word = "";
                for ($l = 1; $l < (count($rgLetters)-1); $l++)
                {
                    $letter = $rgLetters[$l];
                    // roll the dice on replacing a vowel
                    if (preg_match("/[aouie]/", $letter))
                    {
                        $letter = $rgVowels[rand(0,4)];
                    }

                    // replicate each letter up to 10 times
                    for ($i=0; $i < rand(1,10); $i++)
                    {
                        // roll the dice on converting letters to upper case, each time
                        $word .= (rand(1,2) == 1) ? $letter : strtoupper($letter);
                    }
                }
                echo $word . ": ";
                $fFail += $this->CheckSpelling($word);
                echo "<br />";
            }
            echo "<br /><b>". $fFail . " generated strings did not match</b>";
        }
    }
?>
