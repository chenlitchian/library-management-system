<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{   
    header('location:index.php');
}
else{
    if(isset($_GET['del']))
    {
        $id=$_GET['del'];
        $sql = "delete from application WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query -> bindParam(':id',$id, PDO::PARAM_STR);
        $query -> execute();

        $affected_rows = $query->rowCount();


        if ($affected_rows > 0){
            $_SESSION['delmsg']="Application deleted scuccessfully ";
   // header('location:manage-books2.php');
        }
    }



    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Online Library Management System | Manage Application</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONT AWESOME STYLE  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- DATATABLE STYLE  -->
        <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
        <!-- CUSTOM STYLE  -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    </head>
    <body>
      <!------MENU SECTION START-->
      <?php include('includes/header.php');?>
      <!-- MENU SECTION END-->
      <div class="content-wrapper">
       <div class="container">

        <div class="col-md-12">
            <h4 class="header-line">Apllication</h4>
        </div>
        <div class="row">
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
               <?php if($_SESSION['msg']!="")
               {?>
                <div class="col-md-6">
                    <div class="alert alert-success" >
                       <strong>Success :</strong> 
                       <?php echo htmlentities($_SESSION['msg']);?>
                       <?php echo htmlentities($_SESSION['msg']="");?>
                   </div>
               </div>
               <?php } ?>



               <?php if($_SESSION['delmsg']!="")
               {?>
                <div class="col-md-6">
                    <div class="alert alert-success" >
                       <strong>Success :</strong> 
                       <?php echo htmlentities($_SESSION['delmsg']);?>
                       <?php echo htmlentities($_SESSION['delmsg']="");?>
                   </div>
               </div>
               <?php } ?>

           </div>

           <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                      Issued Books 
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
                                    <!-- <th>Date</th> -->
                                    <th>Status</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sql = "SELECT tblstudents.FullName,library.book_title,library.book_category,application.created_date,application.update_date,application.status,application.id 
                                as rid 
                                from  application 
                                join tblstudents 
                                on tblstudents.StudentId=application.user_id 
                                join library 
                                on library.book_no=application.book_id 
                                order by application.id desc";
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
                                                <td class="center"><?php echo htmlentities($result->book_title);?></td>
                                                <td class="center"><?php echo htmlentities($result->created_date);?></td>
                                                <!-- <td class="center"><?php echo htmlentities($result->status);?></td> -->
                                                <td class="center"><?php if($result->status=="1")
                                                {
                                                    $str = '<button class="btn btn-success btn-xs">Pending</button>';                                                   
                                                    echo "$str";
                                                } else if($result->status=="2"){
                                                     $str = '<button class="btn btn-success btn-xs">Active</button>';                                                   
                                                    echo "$str";

                                                   
                                                }else if($result->status=="3"){
                                                     $str = '<button class="btn btn-primary btn-xs">Returned</button>';                                                   
                                                    echo "$str";
                                                    
                                                    // echo ("<button class="btn btn-success btn-xs">approve</button>");

                                                }else{
                                                    $str = '<button class="btn btn-danger btn-xs">Rejected</button>';                                                   
                                                    echo "$str";
                                                   
                                                }
                                                ?></td>
                                                <!-- <td class="center">

                                                    <a href="application.php?del=<?php echo htmlentities($result->rid);?>"  onclick="return confirm('Are you sure you want to delete?');"><button class="btn btn-danger btn-xs"></i>Delete</button> 

                                                    </td> -->
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
            <!-- DATATABLE SCRIPTS  -->
            <script src="assets/js/dataTables/jquery.dataTables.js"></script>
            <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
            <!-- CUSTOM SCRIPTS  -->
            <script src="assets/js/custom.js"></script>
        </body>
        </html>
        <?php } ?>
