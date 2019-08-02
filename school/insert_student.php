<?php
session_start();
if(isset($_SESSION['lkg_uname'])&&!empty($_SESSION['lkg_pass'])&&!empty($_SESSION['academic_year']))
{
$cur_academic_year = $_SESSION['academic_year'];
require("connection.php");
if(isset($_POST["register"]))
{
	$sex=test_input($_POST["sex"]);
	$dob=test_input($_POST["dob"]);
	$place_birth=test_input($_POST["place_birth"]);
	$rollno=test_input($_POST["rollno"]);
	$village=test_input($_POST["village"]);
	$town=test_input($_POST["town"]);
	$taluk=test_input($_POST["taluk"]);
	$district="Kodagu";
	//$academic_year=test_input($_POST["academic_year"]);
	$father_name=test_input($_POST["father_name"]);
	$mother_name=test_input($_POST["mother_name"]);
	$stay_with=test_input($_POST["stay_with"]);
	$father_add=test_input($_POST["father_add"]);
	$fa_occu=test_input($_POST["fa_occu"]);
	$ma_occu=test_input($_POST["ma_occu"]);
	$nation=test_input($_POST["nation"]);
	$religion=test_input($_POST["religion"]);
	$caste=test_input($_POST["caste"]);
	$sc_st=test_input($_POST["sc_st"]);
	$back_caste=test_input($_POST["back_caste"]);
	$mother_tongue=test_input($_POST["mother_tongue"]);
	$other_lang=test_input($_POST["other_lang"]);
	$no_bro=test_input($_POST["no_bro"]);
	$no_sis=test_input($_POST["no_sis"]);
	$section=test_input($_POST["section"]);
	$adhaar_no=test_input($_POST["adhaar_no"]);
	$address=test_input($_POST["address"]);
	$perm_address=test_input($_POST["perm_address"]);
	$vaccinated=test_input($_POST["vaccinated"]);
	$illness_sick=test_input($_POST["illness_sick"]);
	$class_join=test_input($_POST["class_join"]);
	$first_name=test_input($_POST["first_name"]);
	$admission=test_input($_POST["admission"]);
	$roll_no=test_input($_POST["admission"]);
	$blood=test_input($_POST["blood"]);
	$join_date=test_input($_POST["join_date"]);
	$parent_contact=test_input($_POST["parent_contact"]);
	$student_type=test_input($_POST["student_type"]);
	
	

	
	$filetmp = $_FILES["photo"]["tmp_name"];

	$filename = $_FILES["photo"]["name"];

	$filetype = $_FILES["photo"]["type"];

	$filepath = "photo/".$filename;

	move_uploaded_file($filetmp,$filepath);
	
	
	$filetmp1 = $_FILES["adhar"]["tmp_name"];

	$filename1 = $_FILES["adhar"]["name"];

	$filetype1 = $_FILES["adhar"]["type"];

	$filepath1 = "adhar/".$filename1;
	move_uploaded_file($filetmp1,$filepath1);
	
	
	$filetmp2 = $_FILES["birth"]["tmp_name"];

	$filename2 = $_FILES["birth"]["name"];

	$filetype2 = $_FILES["birth"]["type"];

	$filepath2 = "birth/".$filename2;
	move_uploaded_file($filetmp2,$filepath2);
	
	$sql="insert into students (present_class,admission_no,blood,join_date,sex,dob,place_birth,roll_no,village,town,taluk,district,academic_year,father_name,mother_name,stay_with,father_add,fa_occu,ma_occu,nation,religion,caste,sc_st,back_caste,mother_tongue,other_lang,no_bro,no_sis,perm_address,vaccinated,illness_sick,class_join,first_name,parent_contact,rollno,section,address,adhaar_no,photo_name,photo_path,photo_type,adhar_name,adhar_path,adhar_type,birth_name,birth_path,birth_type,student_type) values('$class_join','$admission','$blood','$join_date','$sex','$dob','$place_birth','$roll_no','$village','$town','$taluk','$district','$cur_academic_year','$father_name','$mother_name','$stay_with','$father_add','$fa_occu','$ma_occu','$nation','$religion','$caste','$sc_st','$back_caste','$mother_tongue','$other_lang','$no_bro','$no_sis','$perm_address','$vaccinated','$illness_sick','$class_join','$first_name','$parent_contact','$rollno','$section','$address','$adhaar_no','$filename','$filepath','$filetype','$filename1','$filepath1','$filetype1','$filename2','$filepath2','$filetype2','$student_type')";
	
	
	
	if ($conn->query($sql) === TRUE) 
	{
		//echo "success";
		//var_dump($sql);	
	
	header("Location:register_students.php?success=.'success'");
    } 
	else 
	{
	//var_dump($sql);			
		
	}
}
}else{
		header("Location:login.php");
	}
	
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
	
?>