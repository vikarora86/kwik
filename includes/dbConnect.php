<?php    
    
    // ***********************************************
	// *********** Connect to the database ***********
	// ***********************************************
   	
	
	$dbLink = mysql_connect('localhost', 'root', '');
	
    if (!$dbLink) {
        die('<br />Could not connect: ' . mysql_error());
    }

    mysql_select_db("kwik");
    
?>
