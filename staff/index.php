<?php
session_start();
if(isset($_SESSION['staff_uname'])&&!empty($_SESSION['staff_pass'])&&!empty($_SESSION['class_teach']))
{

$class_teach=$_SESSION['class_teach'];
$staff_uname=$_SESSION['staff_uname'];
$staff_pass=$_SESSION['staff_pass'];
require("header.php");
?>

<div class="container-fluid">
 <br><br>
	 <div class="row">
    <div class="col-md-8">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="form-inline" method="get" role="form">
	  
		<div class="form-group">
        <?php echo '<select class="form-control" name="subject_name">';
        echo '<option value="">Select Subject</option>';
        $sql="select distinct subject_name from subjects";
        $result=mysqli_query($conn,$sql);
        foreach($result as $value)
        {
        ?>
        <option value='<?php echo $value["subject_name"];?>'><?php echo $value["subject_name"];?></option>
        <?php
        }
        echo '</select>';
        ?>
        </div>
	<button type="submit" name="filt_submit" class="btn btn-primary">Filter</button>
	<a href="index.php" class="btn btn-success">View All Classes</a>
	<a href="add_online_class.php" class="btn btn-primary">Add Online Class</a>

	
	</form>
	
	
	</div>
	
	
    <div class="col-md-4">
	
    </div>
	</div>
	</div>
	<br><br>

	<div class="container">
	<div class="row">
	
    <div class="col-sm-12">
	
	<h2 style="font-weight:bold;">All Online Classes - <?php echo strtoupper($class_teach);?></h2>
	<div class="table-responsive">
	<table class="table table-bordered">
	<tbody>
	<tr style="background-color:#eee;color:#000;font-weight:bold;">
		<td style="width:10%;"><span style="font-weight: bold;">SL No</span></td>
		<td>Subject | Chapter Name </td>
		
		<td style="width:10%"></td>
		<td style="width:10%"></td>
	</tr>
								
	<?php
	require("connection.php");
	
	// Pagination code starts here
	if (isset($_GET['pageno'])) {
		$pageno = $_GET['pageno'];
	  } else {
		$pageno = 1;
	  }
	  $no_of_records_per_page = 50;
	  $offset = ($pageno-1) * $no_of_records_per_page;

	  
	  // Pagination code ends here 
	if(isset($_GET["filt_submit"]))
	{
		if(!empty($_GET['subject_name']))
		{
			$subject_name=$_GET["subject_name"];
			$sql="select * from online_class where present_class='".$class_teach."'  and subject_name='".$subject_name."'  ORDER BY id desc  LIMIT $offset, $no_of_records_per_page";
			$total_pages_sql = "SELECT COUNT(*) FROM online_class where present_class='".$class_teach."'";
			
		}
	}
		else
		{
			$sql="select * from online_class where present_class='".$class_teach."'  ORDER BY id desc  LIMIT $offset, $no_of_records_per_page";
			$total_pages_sql = "SELECT COUNT(*) FROM online_class where present_class='".$class_teach."'";			
		}

	///////////////// Pagination code
	  $result_pages = mysqli_query($conn,$total_pages_sql);
	  $total_rows = mysqli_fetch_array($result_pages)[0];
	  $total_pages = ceil($total_rows / $no_of_records_per_page);
	///////////////// Pagination code
	
	$result=mysqli_query($conn,$sql);
	$row_count =1;
	$total_class=mysqli_num_rows($result);

	foreach($result as $row)
	{
		 $id = $row["id"];
		 $updated_by = $row["updated_by"];
		 $updated_at= date('d-m-Y', strtotime( $row['date_posted'] ));
	
	
	?>
    <tr>
		<td><span style="color: #207FA2; "><?php echo $row_count;?></span></td>
		<td><a href="<?php echo 'video_description.php?id='.$id;?>" style="color:blue;"><?php echo strtoupper($row["subject_name"]);?>  <br><?php echo $row["chapter"];?></a>    <small><span style="color:black;">Added on <?php echo $updated_at;?> by <?php echo $updated_by;?></span></small></td>
		<td><a href="<?php echo 'video_description.php?id='.$id;?>"><img src="../school/images/play.png"></a></td>
		<td><a href="<?php echo 'edit_online_class.php?id='.$id;?>" class="btn btn-default btn-sm">Edit Class</a></td>
    </tr>
		<?php 
		$row_count++; 
	}
	?>
	</table>
	</div>

	 <!----  Pagination code starts here---->
	 <ul class="pagination">
                <li><a href="?pageno=1">First</a></li>
                <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                    <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
                </li>
                <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                    <a
                        href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
                </li>
                <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
            </ul>
              <!----  Pagination code ends here---->
			  <br>
			  <button onclick="goBack()" class="btn btn-default">Go Back</button>
	</div>
    
  </div>
  <div class="row" style="padding-top:30px;padding-bottom:100px;">
  <?php
  foreach($result as $value)
  {
	  $ids = $value["id"];
	
  ?>
  <center>
  <a href="<?php echo 'video_description.php?id='.$ids;?>" style="color:blue;">
		<div class="col-sm-3" style="background-color:#0e94ff;padding:10px;border:1px solid white;">
		<h4 style="font-weight:bold;color:#fff;text-align:center;"><?php echo strtoupper($value["subject_name"]);?></h4>
		<p style="color:#fff;text-align:center;"><?php echo $value["chapter"];?></p>
		<small style="color:#e8f2ff;">Uploaded on: <?php echo $updated_at;?></small>
		</div>
  </a>
  </center>
  <?php
  }
  ?>
  </div>
</div>

<?php
require("footer.php");			
}
else
{
header("Location:login.php");
}
?>  