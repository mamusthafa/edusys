<?php
session_start();
if(isset($_SESSION['lkg_uname'])&&!empty($_SESSION['lkg_pass'])&&!empty($_SESSION['academic_year']))
{
$cur_academic_year = $_SESSION['academic_year'];

require("connection.php");
if(isset($_POST["admin"]))
{
	
	
	$user_name=$_POST["user_name"];
	$password=$_POST["password"];
	$user_access="admin";
	
	
	$sql="insert into ad_members (username,log_pas,user_access,academic_year) values('$user_name','$password','$user_access','$cur_academic_year')";
	
	
	if ($conn->query($sql) === TRUE) 
	{
		echo "success";
	
	header("Location:ad_members.php?success=.'success'");


	} 
	else 
	{
				
	header("Location:ad_members.php?failed=.'failed'");	
		
	}


}

	}else{
		header("Location:login.php");
	}
	
?>