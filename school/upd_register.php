<?php
session_start();
if(isset($_SESSION['lkg_uname'])&&!empty($_SESSION['lkg_pass'])&&!empty($_SESSION['academic_year']))
{
$cur_academic_year = $_SESSION['academic_year'];
require("header.php");
require("connection.php");
$id=$_GET['id'];


?>
<div class="container-fluid"><br>
<div class="row">
<div class="col-sm-3">
</div>
<?php 
$sql="select * from students where id='".$id."'";
$result=mysqli_query($conn,$sql);
if($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
{

?>
 <form action="update_student.php" method="post" enctype="multipart/form-data" role="form">
    <div class="col-sm-6">
	  
		<div class="panel panel-primary">
		
			  <div class="panel-body">
			  <h3>Edit Student Detials</h3>

					
					
					<div class="form-group">
					<label><span style="color:red;font-size:18px;">*</span>Enter Admission No</label>
					 <input type="text" name="admission" required placeholder="Admission No" value="<?php echo $row["admission_no"]; ?>" class="form-control" id="usr">
					</div>

					<div class="form-group">
					   <label for="sel1"><span style="color:red;font-size:18px;">*</span>Student Name:</label>
					  <input type="text" placeholder="Student Name" name="first_name" value="<?php echo $row["first_name"]; ?>" required class="form-control" id="usr">
					</div>
					
			
	

		  <div class="form-group">
					<label for="sel1">Select Class</label>
					<select class="form-control" name="class_join">
					<option value="<?php echo $row['present_class']; ?>"><?php echo $row["present_class"]; ?></option>
					<?php
						require("connection.php");
						$sql_class="select class_name from class_name where academic_year='".$cur_academic_year."'";
						$result_class=mysqli_query($conn,$sql_class);
						foreach($result_class as $value_class)
						{
						?>
						<option value='<?php echo $value_class["class_name"];?>'><?php echo $value_class["class_name"];?></option>
						<?php
						}
						echo '</select>';
						?>
						</div>
		

					<div class="form-group">
					  <label for="sel1"><span style="color:red;font-size:18px;">*</span>Section:</label>
					  <select class="form-control" name="section"  id="sel1">
						<option value="<?php echo $row["section"]; ?>"><?php echo $row["section"]; ?></option>
						<option value="">--------</option>
						<option value="Section A">Section A</option>
						<option value="Section B">Section B</option>
						<option value="Section C">Section C</option>
					 </select>
					</div>
					
					<div class="form-group">
					  <label for="sel1"><span style="color:red;font-size:18px;">*</span>Select Gender:</label>
					  <select class="form-control" name="sex"  id="sel1">
						<option value="<?php echo $row["sex"]; ?>"><?php echo $row["sex"]; ?></option>
						<option value="male">Male</option>
						<option value="female">Female</option>
					 </select>
					</div>
                   
					

				
					<div class="form-group">
						<label>Enrollment No</label>
					  <input type="text" placeholder="Enrollment No" name="roll_no" value="<?php echo $row["roll_no"]; ?>"  class="form-control">
					</div>
					
			
					
					<div class="form-group">
					  <label for="usr"><span style="color:red;font-size:18px;">*</span>Date of Birth:</label>
					  <input type="date" class="form-control" value="<?php echo $row["dob"]; ?>" name="dob">
					</div>
					
					<div class="form-group">
						<label>Blood Group</label>
					  <input type="text" placeholder="Blood group" name="blood" value="<?php echo $row["blood"]; ?>"  class="form-control">
					</div>
					
					<div class="form-group">
						<label>Mother Tongue</label>
					  <input type="text" placeholder="Mother Tongue" name="mother_tongue" value="<?php echo $row["mother_tongue"]; ?>"  class="form-control">
					</div>
					
					<div class="form-group">
					 <label>Father Name</label>
					  <input type="text" class="form-control" placeholder="Father Name" value="<?php echo $row["father_name"]; ?>" name="father_name"  id="usr">
					</div>	
					
					<div class="form-group">
					 <label>Mother Name</label>
					  <input type="text" class="form-control" placeholder="Mother Name" value="<?php echo $row["mother_name"]; ?>"  name="mother_name"  id="usr">
					</div>	
					
					<div class="form-group">
					  <label for="usr"><span style="color:red;font-size:18px;">*</span>Address:</label>
					  <textarea rows="4" class="form-control"  name="address"><?php echo $row["address"]; ?></textarea>
					</div>
					
					<div class="form-group">
						<label><span style="color:red;font-size:18px;">*</span>Mobile</label>
					  <input type="text" placeholder="Contact No" name="parent_contact" value="<?php echo $row["parent_contact"];?>" class="form-control" id="usr">
					</div>
	                 <div class="form-group">
						<label><span style="color:red;font-size:18px;">*</span>Caste</label>
					  <input type="text" placeholder="Caste" name="caste" value="<?php echo $row["caste"]; ?>"  class="form-control" id="usr">
					</div>
	
				    <div class="form-group">
						<label>Adhaar No</label>
					  <input type="text" placeholder="Adhaar No" name="adhaar_no" value="<?php echo $row["adhaar_no"]; ?>"  class="form-control" id="usr">
					</div>
					
				
				
					<input type="hidden"  name="id" value="<?php echo $id; ?>"  class="form-control" id="usr">
					
				
			</div>
		</div>
	</div>
	<Input type="submit" class="btn btn-primary" name="upd_register" value="Update" >
	</form>
   
	</div>
    
  </div>
  </form>
  <div class="col-sm-3">
</div>
</div>



<?php
}
require("footer.php");
}
else
{
header("Location:login.php");
}
?>  

			