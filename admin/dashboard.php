<?php

session_start();
error_reporting(0);
include('includes/config.php');

$user_role = 'admin';

if(strlen($_SESSION['alogin'])==0)
{ 
  header('location:index.php');
}
else{

  if(isset($_GET['rtn']))
  {
    $id=$_GET['rtn'];
    $title=$_GET['title'];
    $applicant = $_GET['applicant'];
    $sql = "UPDATE application
    SET status = '3'
    WHERE id=:id";
    $query = $dbh->prepare($sql);
    $query -> bindParam(':id',$id, PDO::PARAM_STR);
    $query -> execute();

    $affected_rows = $query->rowCount();


    if ($affected_rows > 0){
      $_SESSION['returnmsg']="Application returned scuccessfully ";
      $file = 'log.txt';
      $t=time();
      $text = (date("Y-m-d h:i:sa",$t)) . "\treturn application by " . $applicant . " of book_title " . $title . PHP_EOL;
      $text1 = "admin " . "return " . $title;
      file_put_contents($file, $text, FILE_APPEND | LOCK_EX);
      $sql = "insert into admin_log (log)
values(:text)";
    $query = $dbh->prepare($sql);
    $query -> bindParam(':text',$text1, PDO::PARAM_STR);
    $query -> execute();
      header('location:dashboard.php');

    }
  }


  if(isset($_GET['cancel']))
  {
    $id=$_GET['cancel'];
    $title=$_GET['title'];
    $applicant = $_GET['applicant'];
    $sql = "UPDATE application
    SET status = '4'
    WHERE id=:id";
    $query = $dbh->prepare($sql);
    $query -> bindParam(':id',$id, PDO::PARAM_STR);
    $query -> execute();

    $affected_rows = $query->rowCount();


    if ($affected_rows > 0){
      $_SESSION['cancelmsg']="Application canceled scuccessfully ";
      $file = 'log.txt';
      $text = date("Y-m-d h:i:sa") . "\tcancel application by " . $applicant . " of book_title " . $title . PHP_EOL;
      file_put_contents($file, $text, FILE_APPEND | LOCK_EX);
      header('location:dashboard.php');
    }
  }


  if(isset($_GET['apv']))
  {
    $id=$_GET['apv'];
    $title=$_GET['title'];
    $applicant = $_GET['applicant'];
    $sql = "UPDATE application
    SET status = '2'
    WHERE id=:id";
    $query = $dbh->prepare($sql);
    $query -> bindParam(':id',$id, PDO::PARAM_STR);
    $query -> execute();

    $affected_rows = $query->rowCount();


    if ($affected_rows > 0){
      $_SESSION['approvemsg']="Application approved scuccessfully ";
      $file = 'log.txt';
      $text = date("Y-m-d h:i:sa") . "\tapproved application by " . $applicant . " of book_title " . $title . PHP_EOL;
      file_put_contents($file, $text, FILE_APPEND | LOCK_EX);
      $text1 = "approve " . $title;
      file_put_contents($file, $text, FILE_APPEND | LOCK_EX);
      $sql = "insert into admin_log (user_role, log) values(:role, :text)";
      $query = $dbh->prepare($sql);
      $query -> bindParam(':role', $GLOBALS['user_role'], PDO::PARAM_STR);
      $query -> bindParam(':text',$text1, PDO::PARAM_STR);
      $query -> execute();
      header('location:dashboard.php');
   // header('location:manage-books2.php');
    }
  }


  if(isset($_GET['rej']))
  {
    $id=$_GET['rej'];
     $title=$_GET['title'];
    $applicant = $_GET['applicant'];
    $sql = "UPDATE application
    SET status = '4'
    WHERE id=:id";
    $query = $dbh->prepare($sql);
    $query -> bindParam(':id',$id, PDO::PARAM_STR);
    $query -> execute();

    $affected_rows = $query->rowCount();


    if ($affected_rows > 0){
      $_SESSION['rejectmsg']="Application rejected scuccessfully ";
      $file = 'log.txt';
      $text = date("Y-m-d h:i:sa") . "\treject application by " . $applicant . " of book_title " . $title . PHP_EOL;
      file_put_contents($file, $text, FILE_APPEND | LOCK_EX);
      header('location:dashboard.php');
   // header('location:manage-books2.php');
    }
  }




// code for block student    
  if(isset($_GET['inid']))
  {
    $id=$_GET['inid'];
    $user=$_GET['user'];
    $status=0;
    $sql = "update tblstudents set Status=:status  WHERE id=:id";
    $query = $dbh->prepare($sql);
    $query -> bindParam(':id',$id, PDO::PARAM_STR);
    $query -> bindParam(':status',$status, PDO::PARAM_STR);
    $query -> execute();
     $file = 'log.txt';
      $text = date("Y-m-d h:i:sa") . "\tblock" . " registration of" .  $user . PHP_EOL;
      file_put_contents($file, $text, FILE_APPEND | LOCK_EX);
    header('location:dashboard.php');
  }



//code for active students
  if(isset($_GET['id']))
  {
    $id=$_GET['id'];
    $user=$_GET['user'];
    $status=1;
    $sql = "update tblstudents set Status=:status  WHERE id=:id";
    $query = $dbh->prepare($sql);
    $query -> bindParam(':id',$id, PDO::PARAM_STR);
    $query -> bindParam(':status',$status, PDO::PARAM_STR);
    $query -> execute();
    $file = 'log.txt';
      $text = date("Y-m-d h:i:sa") . "\tapprove" . " registration of " . $user . PHP_EOL;
      file_put_contents($file, $text, FILE_APPEND | LOCK_EX);
    header('location:dashboard.php');
  }







  ?>
  <!DOCTYPE html>
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <![endif]-->
      <title>Online Library Management System | Admin Dash Board</title>
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

      <!-- Slider start -->
         <!-- 

         <div class="row">

         <div class="col-md-12 col-sm-12 col-xs-12">
                    <div id="carousel-example" class="carousel slide slide-bdr" data-ride="carousel" >
                   
                    <div class="carousel-inner">
                        <div class="item active">

                            <img style="width:100%;" src="assets/img/1.jpg" alt="" />
                           
                        </div>
                        <div class="item">
                            <img style="width:100%;" src="assets/img/2.jpg" alt="" />
                          
                        </div>
                        <div class="item">
                            <img style="width:100%;" src="assets/img/3.jpg" alt="" />
                           
                        </div>
                    </div>
                    <!--INDICATORS-->
                   <!--  <ol class="carousel-indicators">
                        <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example" data-slide-to="1"></li>
                        <li data-target="#carousel-example" data-slide-to="2"></li>
                      </ol> -->
                      <!--PREVIUS-NEXT BUTTONS-->
                    <!-- 
                    <a class="left carousel-control" href="#carousel-example" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
-->
           <!--     </div>
              </div>
            </div>
          -->
          <!-- Slider end here -->




          <div class="content-wrapper">
           <div class="container">

         <!-- <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">ADMIN DASHBOARD</h4>
                
                            </div>

                          </div> -->

                          <div class="row">




                           <div class="col-md-3 col-sm-3 col-xs-6">
                            <div class="alert alert-success back-widget-set text-center">
                              <i class="fa fa-book fa-5x"></i>
                              <?php 
                              $sql ="SELECT book_no from library ";
                              $query = $dbh -> prepare($sql);
                              $query->execute();
                              $results=$query->fetchAll(PDO::FETCH_OBJ);
                              $listdbooks=$query->rowCount();
                              ?>


                              <h3><?php echo htmlentities($listdbooks);?></h3>
                              Books Listed
                            </div>
                          </div>


                          <div class="col-md-3 col-sm-3 col-xs-6">
                            <div class="alert alert-info back-widget-set text-center">
                              <i class="fa fa-bars fa-5x"></i>
                              <?php 
                              $sql1 ="SELECT id from tblissuedbookdetails ";
                              $query1 = $dbh -> prepare($sql1);
                              $query1->execute();
                              $results1=$query1->fetchAll(PDO::FETCH_OBJ);
                              $issuedbooks=$query1->rowCount();
                              ?>

                              <h3><?php echo htmlentities($issuedbooks);?> </h3>
                              Times Book Issued
                            </div>
                          </div>

                          <div class="col-md-3 col-sm-3 col-xs-6">
                            <div class="alert alert-warning back-widget-set text-center">
                              <i class="fa fa-recycle fa-5x"></i>
                              <?php 
                              $status=1;
                              $sql2 ="SELECT id from tblissuedbookdetails where RetrunStatus=:status";
                              $query2 = $dbh -> prepare($sql2);
                              $query2->bindParam(':status',$status,PDO::PARAM_STR);
                              $query2->execute();
                              $results2=$query2->fetchAll(PDO::FETCH_OBJ);
                              $returnedbooks=$query2->rowCount();
                              ?>

                              <h3><?php echo htmlentities($returnedbooks);?></h3>
                              Times  Books Returned
                            </div>
                          </div>
                          <div class="col-md-3 col-sm-3 col-xs-6">
                            <div class="alert alert-danger back-widget-set text-center">
                              <i class="fa fa-users fa-5x"></i>
                              <?php 
                              $sql3 ="SELECT id from tblstudents ";
                              $query3 = $dbh -> prepare($sql3);
                              $query3->execute();
                              $results3=$query3->fetchAll(PDO::FETCH_OBJ);
                              $regstds=$query3->rowCount();
                              ?>
                              <h3><?php echo htmlentities($regstds);?></h3>
                              Registered Users
                            </div>
                          </div>
                          <?php if($_SESSION['error']!="")
                          {?>
                            <div class="col-md-6">
                              <div class="alert alert-danger" >
                               <strong>Error :</strong> 
                               <?php echo htmlentities($_SESSION['error']);?>
                               <?php echo htmlentities($_SESSION['error']="");?>
                             </div>
                           </div>
                           <?php } ?>


                           <?php if($_SESSION['returnmsg']!="")
                           {?>
                            <div class="col-md-6">
                              <div class="alert alert-success" >
                               <strong>Success :</strong> 
                               <?php echo htmlentities($_SESSION['returnmsg']);?>
                               <?php echo htmlentities($_SESSION['returnmsg']="");?>
                             </div>
                           </div>
                           <?php } ?>

                           <?php if($_SESSION['cancelmsg']!="")
                           {?>
                            <div class="col-md-6">
                              <div class="alert alert-success" >
                               <strong>Success :</strong> 
                               <?php echo htmlentities($_SESSION['cancelmsg']);?>
                               <?php echo htmlentities($_SESSION['cancelmsg']="");?>
                             </div>
                           </div>
                           <?php } ?>

                           <?php if($_SESSION['approvemsg']!="")
                           {?>
                            <div class="col-md-6">
                              <div class="alert alert-success" >
                               <strong>Success :</strong> 
                               <?php echo htmlentities($_SESSION['approvemsg']);?>
                               <?php echo htmlentities($_SESSION['approvemsg']="");?>
                             </div>
                           </div>
                           <?php } ?>


                           <?php if($_SESSION['rejectmsg']!="")
                           {?>
                            <div class="col-md-6">
                              <div class="alert alert-success" >
                               <strong>Success :</strong> 
                               <?php echo htmlentities($_SESSION['rejectmsg']);?>
                               <?php echo htmlentities($_SESSION['rejectmsg']="");?>
                             </div>
                           </div>
                           <?php } ?>
                         </div>

<!--

 <div class="row">

 <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="alert alert-success back-widget-set text-center">
                            <i class="fa fa-user fa-5x"></i>
<?php 
$sql4 ="SELECT id from tblauthors ";
$query4 = $dbh -> prepare($sql4);
$query4->execute();
$results4=$query4->fetchAll(PDO::FETCH_OBJ);
$listdathrs=$query4->rowCount();
?>


                            <h3><?php echo htmlentities($listdathrs);?></h3>
                      Authors Listed
                        </div>
                    </div>

            
                 <div class="col-md-3 col-sm-3 rscol-xs-6">
                      <div class="alert alert-info back-widget-set text-center">
                            <i class="fa fa-file-archive-o fa-5x"></i>
<?php 
$sql5 ="SELECT id from tblcategory ";
$query5 = $dbh -> prepare($sql5);
$query5->execute();
$results5=$query5->fetchAll(PDO::FETCH_OBJ);
$listdcats=$query5->rowCount();
?>

                            <h3><?php echo htmlentities($listdcats);?> </h3>
                           Listed Categories
                        </div>
                    </div>
             

        </div>             
      -->



      <!-- Table for Inactive User-->

      <?php $sql = "SELECT * from tblstudents where status = '2'";
      $query = $dbh -> prepare($sql);
      $query->execute();
      $results=$query->fetchAll(PDO::FETCH_OBJ);
      $cnt=1;
      if($query->rowCount() > 0)
      {
       ?>  

       <div class="row">
        <div class="col-md-12">
          <!-- Advanced Tables -->
          <div class="panel panel-default">
            <div class="panel-heading">
              Please activate or block user
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>#</th>

                      <th>Student Name</th>
                      <th>Email id </th>
                      <th>Mobile Number</th>
                      <th>Reg Date</th>

                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $sql = "SELECT * from tblstudents where status = '2'";
                    $query = $dbh -> prepare($sql);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount() > 0)
                    {
                      foreach($results as $result)
                        {               ?>                                      
                          <tr class="odd gradeX">
                            <td class="center"><?php echo htmlentities($cnt);?></td>

                            <td class="center"><?php echo htmlentities($result->FullName);?></td>
                            <td class="center"><?php echo htmlentities($result->EmailId);?></td>
                            <td class="center"><?php echo htmlentities($result->MobileNumber);?></td>
                            <td class="center"><?php echo htmlentities($result->RegDate);?></td>

                            <td class="center">

                              <a href="dashboard.php?id=<?php echo htmlentities($result->id);?>&user=<?php echo htmlentities($result->FullName);?>" onclick="return confirm('Are you sure you want to active this registration?');""><button class="btn btn-success btn-xs"><i class="fa fa-check "></i></button> 
                                <a href="dashboard.php?inid=<?php echo htmlentities($result->id);?>&user=<?php echo htmlentities($result->FullName);?>" onclick="return confirm('Are you sure you want to delete this registration?');""><button class="btn btn-danger btn-xs"><i class="fa fa-times "></i></button> 


                                </td>
                              </tr>
                              <?php $cnt=$cnt+1;}}?>                                      
                            </tbody>
                          </table>
                        </div>

                      </div>
                    </div>
                    <!--End Advanced Tables -->
                  </div>
                </div>
                <?php }?>
                <!-- End Table for Inactive User-->



                <!-- Table for Active Application-->
<!-- 
<?php $sql = "SELECT * from application where status in (1,2)";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
 ?>   -->

 <div class="row">
  <div class="col-md-12">
    <!-- Advanced Tables -->
    <div class="panel panel-default">
      <div class="panel-heading">
        Active Application
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
              <tr>
                <th>#</th>
                <th>User</th>
                <th>Book</th>
                <th>Date</th>                                            
                <th>Status</th>                                            
                <th>Action</th>
              </tr>
            </thead>
            <tbody><?php $sql = "SELECT tblstudents.FullName as applicant,library.book_title as title,library.book_category,application.created_date,application.update_date,application.status,application.id 
            as rid 
            from  application 
            join tblstudents 
            on tblstudents.StudentId=application.user_id 
            join library 
            on library.book_no=application.book_id 
            where application.status in (1,2)
            order by status desc, application.id desc";
            $query = $dbh -> prepare($sql);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            $cnt=1;
            if($query->rowCount() > 0)
            {
              foreach($results as $result)
                {               ?>                                      
                  <tr class="odd gradeX">
                    <td class="center"><?php echo htmlentities($cnt);?></td>
                    <td class="center"><?php echo htmlentities($result->applicant);?></td>
                    <td class="center"><?php echo htmlentities($result->title);?></td>
                    <td class="center"><?php echo htmlentities($result->created_date);?></td>
                    <!-- <td class="center"><?php echo htmlentities($result->status);?></td> -->
                    <td class="center"><?php if($result->status=="1")
                    {
                      echo htmlentities("Pending");
                    } else if($result->status=="2"){


                      echo htmlentities("Active");
                    }else{

                      echo htmlentities("Complete");
                    }
                    ?></td>

                    <td class="center"><?php if($result->status=="1"){

                    }
                    ?>

                    <?php if ($result->status=="2"): ?>
                      <a href="dashboard.php?rtn=<?php echo htmlentities($result->rid);?>&title=<?php echo htmlentities($result->title);?>&applicant=<?php echo htmlentities($result->applicant);?>"  onclick="return confirm('Are you sure you want to return?');"><button class="btn btn-primary btn-xs"></i>return</button></a> 
                      <a href="dashboard.php?cancel=<?php echo htmlentities($result->rid);?>&title=<?php echo htmlentities($result->title);?>&applicant=<?php echo htmlentities($result->applicant);?>"  onclick="return confirm('Are you sure you want to cancel?');"><button class="btn btn-danger btn-xs"></i>cancel</button></a> 
                    <?php endif; ?>

                    <?php if ($result->status=="1"): ?>
                      <a href="dashboard.php?apv=<?php echo htmlentities($result->rid);?>&title=<?php echo htmlentities($result->title);?>&applicant=<?php echo htmlentities($result->applicant);?>"  onclick="return confirm('Are you sure you want to approve?');"><button class="btn btn-success btn-xs">approve</button></a>
                    <?php endif; ?>

                    <?php if ($result->status=="1"): ?>
                      <a href="dashboard.php?rej=<?php echo htmlentities($result->rid);?>&title=<?php echo htmlentities($result->title);?>&applicant=<?php echo htmlentities($result->applicant);?>"  onclick="return confirm('Are you sure you want to reject?');"><button class="btn btn-danger btn-xs"></i>reject</button></a>  
                    <?php endif; ?>






                  </td>
                </tr>
                <?php $cnt=$cnt+1;}} ?>                                 
              </tbody>
            </table>
          </div>

        </div>
      </div>
      <!--End Advanced Tables -->
    </div>
  </div>
  <?php }?>
  <!-- End Table for Active Application-->


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
