<?php  
	//include "dbConnect.php";  
    
    class clsCommon {
    	
    	function randomPrefix($length) 
		{ 
			$random= "";
			srand((double)microtime()*1000000);

			$data = "AbcDE123IJKLMN67QRSTUVWXYZ"; 
			$data .= "aBCdefghijklmn123opq45rs67tuv89wxyz"; 
			$data .= "0FGH45OP89";

			for($i = 0; $i < $length; $i++) 
			{ 
				$random .= substr($data, (rand()%(strlen($data))), 1); 
			}

			return $random; 
		}
    }
    
?>
