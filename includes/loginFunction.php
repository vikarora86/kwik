<?php  
	include "dbConnect.php";  
	include "clsCommon.php";  
    
    class clsLogin {
    	
    	function userRegistration($fname, $lname, $email, $password) {
    		$password = md5($password);
    	
    		//Check user email is unique
    		$email = strtolower($email);
    		$query = " SELECT * 
                         FROM tblUser
			            WHERE emailAddress = '$email'
			         ";
			$result = mysql_query($query);
	        $row = mysql_fetch_array($result);
	        
	        $userId = $row['userId'];
	        
	        if($userID != "") {
	        	//Raise error: Email ID already exist
	        	
	        	exit;
	        }
	        
	        $objCommon = new clsCommon();
	        
	        
	        //Generate User Name: must be unique
	        $userName = $fname . $lname;
	        $userName = strtolower($userName);
	        
	        $userNameCounter = 0;
	        
			do {
				if($userNameCounter == 0) {
					$userNameNew = $userName;
				}
				else {
					$userNameNew = $userName . $userNameCounter;
				}
			
				$query = " SELECT * 
							 FROM tblUser
							WHERE userName = '$userNameNew'
						 ";
				$result = mysql_query($query);
				$row = mysql_fetch_array($result);
		
				$userId = $row['userId'];
				$userNameCounter = $userNameCounter + 1;
			} while ($userID != "");
			
			$userName = $userNameNew;
			
			
			//Generate User Hash: must be unique
	        do {
				$userHash = $objCommon->randomPrefix(20);
			
				$query = " SELECT * 
							 FROM tblUser
							WHERE userHash = '$userHash'
						 ";
				$result = mysql_query($query);
				$row = mysql_fetch_array($result);
		
				$userId = $row['userId'];
			} while ($userID != "");
			
			
			//Insert into tblUser
			$query = "
					INSERT INTO `tblUser` (
						`firstName`, `lastName`, `emailAddress`, `password`, `dateRegistered`, `userName`, `userHash`
					)
					VALUES (
						'{$fname}', '{$lname}', '{$email}', '{$password}', NOW(), '{$userName}', '{$userHash}'
					)";
			
			// Execute the query
			$result = mysql_query($query);
			
			if($result) {
			}
			else {
				echo '<br />Error! Failed to register<br />';
				exit(); 
			} 
    	}
    	
    	
    	function userLogin($email, $password) {
    		$password = md5($password);
    	
    		//Check user email is unique
    		$email = strtolower($email);
    		$query = " SELECT * 
                         FROM tblUser
			            WHERE emailAddress = '$email'
			              AND password = '$password'
			         ";
			$result = mysql_query($query);
	        $row = mysql_fetch_array($result);
	        
	        $userId = $row['userId'];
	        
	        if($userID == "") {
	        	//Raise error: Wrong Email ID or Password
	        	
	        	exit;
	        }
	        
	        return $userId;
    	}
    
    }
    
?>
