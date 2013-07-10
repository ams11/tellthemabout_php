<?php

require_once("dictionary.php");

if (!array_key_exists("word", $_GET))
{
    echo "No Word Entered; Please Enter a Word to Spell Check";
}
else
{
    if (array_key_exists("dictionary", $_SESSION))
    {
        echo $_SESSION['dictionary']->CheckSpelling($_GET['word']);
    }
    else
    {
        echo "Error: No Dictionary Loaded; Please Load a Valid Dictionary";
    }
}

?>
