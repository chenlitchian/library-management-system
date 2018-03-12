<?php  
 if(isset($_POST["book_id"]))  
 {  
      $output = '';  
      $connect = mysqli_connect("localhost", "root", "", "library");  
      $query = "SELECT * FROM library WHERE book_no = '".$_POST["book_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
                     <td width="30%"><label>Title</label></td>  
                     <td width="70%">'.$row["book_title"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Author</label></td>  
                     <td width="70%">'.$row["book_author"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Code</label></td>  
                     <td width="70%">'.$row["book_code"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Category</label></td>  
                     <td width="70%">'.$row["book_category"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Status</label></td>  
                     <td width="70%">'.$row["book_status"].'</td>  
                </tr>
                 <tr>  
                     <td width="30%"><label>Description</label></td>  
                     <td width="70%">'.$row["book_desc"].'</td>  
                </tr>    
                ';  
      }  
      $output .= "</table></div>";  
      echo $output;  
 }  
 ?>