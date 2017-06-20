<?php
    /*
    This script is used to change the data formate display in the page

    Author: Zhiyue Zhao
    Date: February 13, 2016
    */
    function format_datetime ($eventTime)
    {
    // Place 8601 time into a Unix-timestamp, for the date() function below
        $unixTime = mktime (substr ($eventTime, 11, 2), // hour
                            substr ($eventTime, 14, 2), // minute
                            0,                          // second
                            substr ($eventTime, 5, 2),  // month
                            substr ($eventTime, 8, 2),  // day
                            substr ($eventTime, 0, 4)); // year
        // Show time as "Monthname, dd, yyyy  [hh:mm] am/pm"
        $formattedDateTime = date ("F j, Y  g:i a", $unixTime);
        return $formattedDateTime;
    }
?>