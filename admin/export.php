 <?php  
      //export.php  
 if(isset($_POST["export"]))  
 {  
      $connect = mysqli_connect("localhost", "root", "", "library");  
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      echo "\xEF\xBB\xBF";
      $output = fopen("php://output", "w");    
      $query = "SELECT * from admin_log";  
      $result = mysqli_query($connect, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row, ";"); 

      }  
      fclose($output);  
 }  
 ?>  