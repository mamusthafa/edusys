<?php
session_start();
if(isset($_SESSION['lkg_uname'])&&!empty($_SESSION['lkg_pass'])&&!empty($_SESSION['academic_year']))
{
$cur_academic_year = $_SESSION['academic_year'];
require("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = test_input($_POST["name"]);
	$parent_name = test_input($_POST["parent_name"]);
	$roll_no = test_input($_POST["roll_no"]);
	//$academic_year = test_input($_POST["academic_year"]);
	
	$class = test_input($_POST["present_class"]);
	$section = test_input($_POST["section"]);
	$adm_fee = test_input($_POST["adm_fee"]);
	
	$rec_date = test_input($_POST["rec_date"]);
	$rec_no = test_input($_POST["rec_no"]);
	$note = test_input($_POST["note"]);

	

  $sql="insert into student_fee (name,parent_name,roll_no,academic_year,class,section,tot_paid,rec_date,rec_no,note) values('$name','$parent_name','$roll_no','$cur_academic_year','$class','$section','$adm_fee','$rec_date','$rec_no','$note')";
		  if ($conn->query($sql) === TRUE) {
			  //$sql_upd="update students set  tot_paid=tot_paid+'".$adm_fee."' where academic_year='".$cur_academic_year."' and  first_name='".$name."' and roll_no='".$roll_no."'";
			  $conn->query($sql_upd);
			header("Location:student_fee_sms.php?name=".$name."&tot_paid=".$adm_fee."&rec_no=".$rec_no."&rec_date=".$rec_date."&roll_no=".$roll_no."&note=".$note);
			} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
			}
			
	}
	}
			//}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>			
