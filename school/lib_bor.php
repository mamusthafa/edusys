<?php
session_start();
if(isset($_SESSION['lkg_uname'])&&!empty($_SESSION['lkg_pass'])&&!empty($_SESSION['academic_year']))
{
$cur_academic_year = $_SESSION['academic_year'];
require("connection.php");
if(isset($_GET["issue_book"]))
{
	$bor_name=$_GET["bor_name"];
	$bor_id=$_GET["bor_id"];
	$book_name=$_GET["book_name"];
	$book_id=$_GET["book_id"];
	$no_books=$_GET["no_books"];
	
	
	if(($no_books)>=1){
	$book_now=$no_books-1;
		
	$sql_update="update books set no_books=$book_now where  book_name='$book_name' and book_id='$book_id'";
	$conn->query($sql_update);
		
	$sql='insert into library (bor_name,bor_id,book_name,book_id,academic_year) values("'.$bor_name.'","'.$bor_id.'","'.$book_name.'","'.$book_id.'","'.$cur_academic_year.'")';
	//var_dump($sql);
	if ($conn->query($sql) === TRUE) 
	{
	header("Location:description.php?first_name=".$bor_name."&roll_no=".$bor_id);
	}
	}
	}
	}
	else
	{
	header("Location:login.php");
	}
?>