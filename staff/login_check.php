<?php
session_start();
/* if(isset($_SESSION['marks_uname'])) unset($_SESSION['marks_uname']);
if(isset($_SESSION['marks_pass'])) unset($_SESSION['marks_pass']);
if(isset($_SESSION['class'])) unset($_SESSION['class']);
if(isset($_SESSION['section'])) unset($_SESSION['section']);
if(isset($_SESSION['academic_year'])) unset($_SESSION['academic_year']);
 */


	if((isset($_POST['staff_uname']))&&(!empty($_POST['staff_pass'])))
	{
	require("connection.php");
	$user=mysqli_real_escape_string($conn,$_POST['staff_uname']);
	
	$password=mysqli_real_escape_string($conn,$_POST['staff_pass']);

	
	
	$sql='select id,username,log_pas,user_access from ad_members where username="'.$user.'" and  user_access="staff"';
	$result=mysqli_query($conn,$sql);	
	
	$f=false;
	if($row=mysqli_fetch_array($result))
		{
		$secure = password_verify($password, $row["log_pas"]);	
		$admin_id = $row["id"];
		
		if($secure){
			header("location: index.php");
			$_SESSION['staff_uname']=$user;
			$_SESSION['staff_pass']=$secure;
			$_SESSION['admin_id']=$admin_id;
			$f=true;
		}
			
		
		}
		else
		{
		$status="User/Password incorrect1!";
		header("Location:login.php?failed=failed");
		}
	if($f)
		{
		if($secure){
			header("location: index.php");
		}
		}
		else
		{
		$status="User/Password incorrect2!";
		header("Location:login.php?failed=failed");
		}
		
		
        }
		
		/*  
		$password = $_POST["password"]; // password
		$options = ['cost' => 12];  //salt 
		$secure = password_hash($password, PASSWORD_DEFAULT, $options); // hashing password
		*/
	
?>