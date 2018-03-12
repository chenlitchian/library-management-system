<?php
		 
	require_once 'includes/config.php';
	
	if (isset($_REQUEST['id'])) {
			
		$id = intval($_REQUEST['id']);
		$query = "SELECT * FROM library WHERE book_no=:id";
		$stmt = $dbh->prepare( $query );
		$stmt->execute(array(':id'=>$id));
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
			
		?>
			
		<div class="table-responsive">
		
		<table class="table table-striped table-bordered">
		    
		     <tr><img src="img/pd.jpg" class="img-responsive" width=50% height=auto></tr>
		    <tr>
			    <th>First Name</th>
				<td><?php echo $book_title; ?></td>
			</tr>
			 <tr>
				<th>Last Name</th>
				<td><?php echo $book_title; ?></td>
			</tr>
			<tr>
				<th>Email ID</th>
				<td><?php echo $book_title; ?></td>
			</tr>
			<tr>
				<th>Position</th>
				<td><?php echo $book_title; ?></td>
			</tr>
			<tr>
				<th>Office</th>
				<td><?php echo $book_title; ?></td>
			</tr> 
		</table>
			
		</div>
			
		<?php				
	}