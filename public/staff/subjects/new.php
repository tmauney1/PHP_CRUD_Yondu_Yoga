<?php

require_once('../../../private/initialize.php');

if(is_post_request()){
	// Handle form values sent by new.php
	
		$customer = [];
		$customer['first_name'] = $_POST['first_name'] ?? '';
		$customer['last_name'] = $_POST['last_name'] ?? '';
		$customer['class_type'] = $_POST['class_type'] ?? '';
		$customer['class_time'] = $_POST['class_time'] ?? '';
	
	$result = insert_customer($customer);
	if($result === true){
		$new_id = mysqli_insert_id($db);
		$_SESSION['message'] = 'THe subject was created successfully.';
		redirect_to(url_for('/staff/subjects/show.php?id=' . $new_id));
	} else {
		$errors = $result;
	}
	
} else {
	
}
require_login();

?>

<?php $page_title = 'Create Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject new">
    <h1>Create Subject</h1>
	<?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/staff/subjects/new.php')?>" method="post">
      <dl>
        <dt>First Name</dt>
        <dd><input type="text" name="first_name" value="" /></dd>
      </dl>
	  <dl>
        <dt>Last Name</dt>
        <dd><input type="text" name="last_name" value="" /></dd>
      </dl>
      <dl>
        <dt>Yoga Type</dt>
        <dd>
          <select name="class_type">
            <option value="Vanyasa">Vanyasa</option>
			<option value="Hatha">Hatha</option>
			<option value="Ashtanga">Ashtanga</option>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Class Time</dt>
        <dd>
          <select name="class_time">
            <option value="Morning">Morning</option>
			<option value="Afternoon">Afternoon</option>
			<option value="Night">Night</option>
          </select>
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Customer" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
