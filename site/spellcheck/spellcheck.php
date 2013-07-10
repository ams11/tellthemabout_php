<?php
require_once("dictionary.php");
?>

<html>
    <body>
        <link href="spellchecker.css" type="text/css" rel="stylesheet">
        <script type="text/javascript" src="spellcheck.js"></script>
        <div class="dictionaries">
            <div class="title">Current Dictionary: <span class="bold" id="idDictionary"><?php echo array_key_exists('dictionary', $_SESSION) ? $_SESSION['dictionary']->GetUrl() : "None"; ?></span></div>
            Available Dictionaries, Click to Load the Selected Dictionary:<br />
            <ul>
<?php
$dictionaries = array(
    array('name' => 'Alex\' Test Dictionary',
          'href' => 'http://www.tellthemabout.com/spellcheck/dictionary.txt'),
    array('name' => 'Second Dictionary',
          'href' => 'http://www.tellthemabout.com/spellcheck/dictionary2.txt')
    );

foreach ($dictionaries as $dictionary)
{
?>
                <li><a href="<?php echo $dictionary['href'] ?>" onclick="LoadDictionary(this.href); return false;"><?php echo $dictionary['name'] ?></a></li>
<?php
}
?>
                <li>
                    <span class="custom">
                        Custom:
                        <input value="http://" id="href" type="text"></input>
                        <button class="load" onclick="LoadDictionary(this.parentNode.children['href'].value); return false;">Load</button>
                    </span>
                </li>
                <li> <a href="#" onclick="Randomize(); return false;">Generate Random Test</a>
            </ul>
        </div>
        <div>
            Spell Checker - type a word to check and press Enter:
        </div>
        <textarea rows="10" cols="50" id="idTextArea">&gt;</textarea>

        <div class="heading">
            <span id="idHeader">Dictionary Listing:</span>
        <div class="list" id="idList">
<?php
if (array_key_exists('dictionary', $_SESSION))
{
    $dictionary = $_SESSION['dictionary'];
    $dictionary->PrintList();
}
?>
        </div>
        </div>
    </body>
</html>