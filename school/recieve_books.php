<?php
session_start();
if(isset($_SESSION['lkg_uname'])&&!empty($_SESSION['lkg_pass'])&&!empty($_SESSION['academic_year']))
{
$cur_academic_year = $_SESSION['academic_year'];

require("header.php");	

?>
<head>
 <link rel="stylesheet" href="bootstrap-theme.min.css">
<script src="typeahead.min.js"></script>
<style type="text/css">
	
.bs-example{
	font-family: sans-serif;
	position: relative;
	margin: 50px;
}
.typeahead, .tt-query, .tt-hint {
	border: 1px solid #CCCCCC;
	
	font-size: 14px;
	height: 30px;
	line-height: 30px;
	outline: medium none;
	padding: 8px 12px;
	width: 396px;
}
.typeahead {
	background-color: #FFFFFF;
}
.typeahead:focus {
	border: 2px solid #0097CF;
}
.tt-query {
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
}
.tt-hint {
	color: #999999;
}
.tt-dropdown-menu {
	background-color: #FFFFFF;
	border: 1px solid rgba(0, 0, 0, 0.2);
	border-radius: 8px;
	box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	margin-top: 12px;
	padding: 8px 0;
	width: 422px;
}
.tt-suggestion {
	font-size: 14px;
	line-height: 24px;
	padding: 3px 20px;
}
.tt-suggestion.tt-is-under-cursor {
	background-color: #0097CF;
	color: #FFFFFF;
}
.tt-suggestion p {
	margin: 0;
}

</style>
</head>
<?php 
	if(isset($_GET["availibility"])){
	$searched=$_GET["name"];
	
	$searched_array=explode(",",$searched);
	$book_name=$searched_array[0];
	$author=$searched_array[1];
	
	$sql_book="select * from books where book_name='".$book_name."'";
		$result_book=mysqli_query($conn,$sql_book);
		if($row_book=mysqli_fetch_array($result_book,MYSQLI_ASSOC))
		{
		 $no_books=$row_book["no_books"];
		}
		}
	
	?>
    <div class="container-fluid">
    <div class="row">
  
	<div class="col-sm-3">
	</div>
	<div class="col-sm-6">
	<div class="panel panel-red">
     <div class="panel-heading"><h4>Get Book Details</h4></div>
      <div class="panel-body">
	  <form action="recieve_books.php" method="get">
	  <div class="form-group">
	   <label>Enter Book Name:</label>
		<input type="text" name="name" class="form-control typeahead_book "  autocomplete="off" spellcheck="false" placeholder="Search Books" required>
		</div>
		<input type="hidden" name="bor_name" value="<?php echo $_GET['first_name'];?>">
		<input type="hidden" name="bor_id" value="<?php echo $_GET['roll_no'];?>">
		<input type="submit" class="btn btn-primary" name="availibility" value="Get Details">
	</form>
	<?php 
	if(isset($_GET['availibility']))
	{
	?>
		<h3>Book Details</h3>
		<table class="table table-bordered" style="width: 100%; ">
		<tbody>
		<tr>
		<td style="width: 50%; ">Book Name</td>
		<td style="width: 50%; "><span style="color: #003399; "><?php echo $row_book["book_name"];?></span></td>
		</tr>
		
		<tr>
		<td style="width: 50%; ">Category</td>
		<td style="width: 50%; "><span style="color: #003399; "><?php echo $row_book["cat"];?></span></td>
		</tr>
		
		<tr>
		<td style="width: 50%; ">Author Name</td>
		<td style="width: 50%; "><span style="color: #003399; "><?php echo $row_book["author"];?></span></td>
		</tr>
		
		<tr>
		<td style="width: 50%; ">Available Books</td>
		<td style="width: 50%; "><span style="color: #003399; "><?php echo $row_book["no_books"];?></span></td>
		</tr>
		
		<tr>
		<td style="width: 50%; ">Book ID</td>
		<td style="width: 50%; "><span style="color: #003399; "><?php echo $row_book["book_id"];?></span></td>
		</tr>
		
		</tbody>
		</table>
		
	
		
		<form action="lib_rec.php" method="get">
		<input type="hidden" name="bor_name" value="<?php echo $_GET['bor_name'];?>">
		<input type="hidden" name="bor_id" value="<?php echo $_GET['bor_id'];?>">
		<input type="hidden" name="book_name" value="<?php echo $row_book['book_name'];?>">
		<input type="hidden" name="book_id" value="<?php echo $row_book['book_id'];?>">
		<input type="hidden" name="cat" value="<?php echo $row_book['cat'];?>">
		<input type="hidden" name="author" value="<?php echo $row_book['author'];?>">
		<input type="hidden" name="no_books" value="<?php echo $row_book['no_books'];?>">
		
		<input type="submit" value="Receive Book" class="btn btn-success" name="recieve_book">
		</form>
		<?php
		}
		?>
    </div>
    </div>
    </div>
	
	<div class="col-sm-3">
	
    </div>
    </div>
    </div>

	




<?php
			
}
else
{
header("Location:login.php");
}
?>  