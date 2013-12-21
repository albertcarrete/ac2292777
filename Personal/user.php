<?php 
/**
* 
*/
class User
{
	
	function __construct()
	{
		# code...
	}


	function getInfo($user_id,$data_retrieve,$dbc){
		$selectUserToEdit 	= "SELECT username,first_name,last_name,email FROM `47924`.`ac2292777_personal_users` WHERE user_id='$user_id'";		
		$queryUserToEdit 	= @mysqli_query ($dbc, $selectUserToEdit);
		$user = mysqli_fetch_array($queryUserToEdit, MYSQLI_ASSOC);

		if($data_retrieve == 'username'){
			return $user['username'];
		}
		elseif($data_retrieve == 'fullname'){
			return $user['first_name']." ".$user['last_name'];
		}
		else{
			return "Error: No data was retrieved.";
		}
	}
}

?>