<!-- <?php
echo file_get_contents( "log.txt" ); // get the contents, and echo it out.
?> -->

<?php 

  $fh = fopen("log.txt", 'r');

    $pageText = fread($fh, 25000);

    echo nl2br($pageText);
 ?>