<?php
/**
 * DBConnect
 *
 * @author Alex Slepak
 */
 
class DBConnect
{
    // Connect to the database
	// local settings
/*    private $dbhost = 'localhost';
    private $dbusername = 'root';
    private $dbpasswd = '';
    private $database_name = 'simple';*/
	
	// hosted settings
    private $dbhost = 'db2664.perfora.net';
    private $dbusername = 'dbo347804695';
    private $dbpasswd = 'sfty3rd';
    private $database_name = 'db347804695';

    private $connected = false;

    public function Connect()
    {
        $connection = mysql_connect("$this->dbhost","$this->dbusername","$this->dbpasswd")
            or die ('Couldn\'t connect to server.');
        $db = mysql_select_db("$this->database_name", $connection)
            or die('Couldn\'t select database.');
    }

    public function RunQuery($query)
    {
        if (!$this->connected)
        {
            $this->Connect();
            $this->connected = true;
        }

        // Retrieve code from database.
        $result = mysql_query( $query )
            or die ( 'It Didn\'t Work: ' . mysql_error() );

        return ($result);
    }
	
	// BUGBUG - this doesn't belong here!
	public function FormatDateRange($strStartDate, $strEndDate, $long)
	{
		$startDate = strtotime($strStartDate);
		$endDate = strtotime($strEndDate);
		$sameYr = (date('Y', $startDate) == date('Y', $endDate));
		$format1 = $long ? 'F j' : 'M';
		$format2 = $long ? 'F j, Y' : 'M Y';
		if (date('n', $startDate) != date('n', $endDate))
		{
			$dates = ($sameYr) ? date($format1, $startDate) : date($format2, $startDate);
			$dates .= ' - ' . date($format2, $endDate);
		}
		else if ($long)
		{
			$dates = date('F j', $startDate) . ' - ' . date('j, Y', $endDate);
		}
		else
		{
			$dates = date($format2, $startDate);
		}
		
		return $dates;
	}
}
?>
