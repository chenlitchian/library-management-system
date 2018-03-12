<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['disable']))
{
    $status=0;
   $bookid=intval($_GET['bookid']);
    
    $sql="update library set book_status=:status where book_no=:bookid";
    $query = $dbh->prepare($sql);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
$query->execute();
$_SESSION['msg']="Book info updated successfully";
echo "<script type='text/javascript'> document.location ='manage-books2.php'; </script>";

}
if(isset($_POST['activate']))
{
    $status=1;
   $bookid=intval($_GET['bookid']);
    
    $sql="update library set book_status=:status where book_no=:bookid";
    $query = $dbh->prepare($sql);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
$query->execute();
$_SESSION['msg']="Book info updated successfully";
echo "<script type='text/javascript'> document.location ='manage-books2.php'; </script>";

}

if(isset($_POST['update']))
{
$bookname=$_POST['bookname'];
$author=$_POST['author'];
$category=$_POST['category'];
$code=$_POST['code'];
$desc=$_POST['desc'];
$status=$_POST['status'];
$bookid=intval($_GET['bookid']);
$sql="update library set book_title=:bookname,book_author=:author, book_category=:category, book_code=:code, book_desc=:desc, book_status=:status where book_no=:bookid";
$query = $dbh->prepare($sql);
$query->bindParam(':bookname',$bookname,PDO::PARAM_STR);
$query->bindParam(':author',$author,PDO::PARAM_STR);
$query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
$query->bindParam(':code',$code,PDO::PARAM_STR);
$query->bindParam(':desc',$desc,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':category',$category,PDO::PARAM_STR);
$query->execute();
$_SESSION['msg']="Book info updated successfully";
//header('location:manage-books2.php');
echo "<script type='text/javascript'> document.location ='manage-books2.php'; </script>";

}

/*
if(isset($_POST['disable']))
{
    $status=1
    $bookid=intval($_GET['bookid']);
    $sql="update library set book_status=:status where book_no=:bookid";
    $query = $dbh->prepare($sql);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
$query->execute();
$_SESSION['msg']="Book info updated successfully";
echo "<script type='text/javascript'> document.location ='manage-books2.php'; </script>";

}
*/

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Edit Book</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wra
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Add Book</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
<div class="panel panel-info">
<div class="panel-heading">
Book Info
</div>
<div class="panel-body">
<form role="form" method="post">
<?php 
$bookid=intval($_GET['bookid']);
$sql = "SELECT book_title, book_author, book_code, book_category, book_desc, book_status, book_no as bookid from library where book_no=:bookid";
$query = $dbh -> prepare($sql);
$query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  

<div class="form-group">
<label>Book Name<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="bookname" value="<?php echo htmlentities($result->book_title);?>" required />
</div>

<div class="form-group">
<label> Author<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="author" value="<?php echo htmlentities($result->book_author);?>" required="required"/>
</div>

<div class="form-group">
<label> Code<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="code" value="<?php echo htmlentities($result->book_code);?>" required="required"/>
</div>

<div class="form-group">
<label> status<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="status" value="<?php 
if($result->book_status == 1) echo "Active";
else echo "Inactive";
    ;?>" required="required" disabled/>
</div>

<!--
<div class="form-group">
<label> Status<span style="color:red;">*</span></label>
<select class="form-control" name="status" value="<?php $status ?>" required="required">

  <option value="0">Not Active</option>
  <option value="1">Active</option>
</select>
-->

</div>

<div class="form-group">
<label> Description<span style="color:red;">*</span></label>
<textarea class="form-control" rows="5" name="desc" value="<?php echo htmlentities($result->book_desc);?>" required ="required">
    <?php echo htmlentities($result->book_desc);?>
</textarea>
</div>

<div class="form-group">
<label> Category<span style="color:red;">*</span></label>
<select class="form-control" name="category" required="required">
<option value="<?php echo htmlentities($result->book_category);?>"><?php echo htmlentities($catname=$result->book_category);?></option>
<?php 
$catstatus=1;
$sql = "SELECT * from  tblcategory where Status=:catstatus";
$query = $dbh -> prepare($sql);
$query -> bindParam(':catstatus',$catstatus, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $resultx)
{               ?>  
<option value="<?php echo htmlentities($resultx->CategoryName);?>"><?php echo htmlentities($resultx->CategoryName);?></option>
 <?php }} ?> 
</select>
</div>

<?php }} ?>

<button type="submit" name="update" class="btn btn-info" onclick="return confirm('Are you sure you want to edit this book?');">Update </button>

<?php 

if($result->book_status == '1')
{
    ?>
<button type="submit" name="disable" class="btn btn-danger" onclick="return confirm('Are you sure you want to inactive this book?');">Inactivate </button>
<?php
}else{
?>
<button type="submit" name="activate" class="btn btn-success" onclick="return confirm('Are you sure you want to active this book?');">activate </button>

<?php } ?>



                                    </form>
                            </div>
                        </div>
                            </div>

        </div>
   
    </div>
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
