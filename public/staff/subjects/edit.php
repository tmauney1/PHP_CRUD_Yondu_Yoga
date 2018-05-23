<?php

require_once('../../../private/initialize.php');
require_login();
if(!isset($_GET['id'])){
	redirect_to(url_for('/staff/subjects/index.php'));
}
	$id = $_GET['id'];
	
	
	

	if(is_post_request()){
		// Handle form values sent by new.php
		
		$customer = [];
		$customer['id'] = $id;
		$customer['first_name'] = $_POST['first_name'] ?? '';
		$customer['last_name'] = $_POST['last_name'] ?? '';
		$customer['class_type'] = $_POST['class_type'] ?? '';
		$customer['class_time'] = $_POST['class_time'] ?? '';
		
		$result = update_customer($customer);
		if($result === true){
			$_SESSION['message'] = 'THe subject was created successfully.';
			redirect_to(url_for('/staff/subjects/show.php?id=' . $id));
		} else{
			$errors = $result;
		}
	} else {
		$customer = find_customer_by_id($id);
	}
	?>

	<?php $page_title = 'Edit Subject'; ?>
	<?php include(SHARED_PATH . '/staff_header.php'); ?>

	<div id="content">

	  <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>

	  <div class="subject edit">
		<h1>Edit Subject</h1>
		
	<?php echo display_errors($errors); ?>
		<form action="<?php echo url_for('/staff/subjects/edit.php?id=' . h(u($id))); ?>" method="post">
		  <dl>
			<dt>First Name</dt>
			<dd><input type="text" name="first_name" value="<?php echo h($customer['first_name']); ?>" /></dd>
		  </dl>
		  <dl>
			<dt>Last Name</dt>
			<dd><input type="text" name="last_name" value="<?php echo h($customer['last_name']); ?>" /></dd>
		  </dl>
		  <dl>
			<dt>Yoga Type</dt>
			<dd>
			  <select name="class_type">
				<option value="Vinyasa"<?php  if($customer['class_type'] == "Vinyasa") { echo "Vinyasa";} ?>>Vinyasa</option>
				<option value="Hatha"<?php  if($customer['class_type'] == "Hatha") { echo "Hatha";} ?>>Hatha</option>
				<option value="Ashtanga"<?php  if($customer['class_type'] == "Ashtanga") { echo "Ashtanga";} ?>>Ashtanga</option>
			  </select>
			</dd>
		  </dl>
		  <dl>
			<dt>Class Time</dt>
			<dd>
			  <select name="class_time">
				<option value="Morning"<?php  if($customer['class_time'] == "Morning") { echo "Morning";} ?>>Morning</option>
				<option value="Afternoon"<?php  if($customer['class_time'] == "Afternoon") { echo "Afternoon";} ?>>Afternoon</option>
				<option value="Night"<?php  if($customer['class_time'] == "Night") { echo "Night";} ?>>Night</option>
			  </select>
			</dd>
		  </dl>
		  <div id="operations">
			<input type="submit" value="Edit Customer" />
		  </div>
		</form>

	  </div>

	</div>

	<?php include(SHARED_PATH . '/staff_footer.php'); ?>
