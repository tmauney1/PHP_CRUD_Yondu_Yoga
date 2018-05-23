<?php

require_once('../../../private/initialize.php');

if(!isset[$_GET])){
	redirect_to(url_for('/staff/pages/index.php'));
}
	$id = $_GET['id'];
	$first_name = '';
	$last_name = '';
	$class_type = '';
	$class_time = '';

if(is_post_request()){
	// Handle form values sent by new.php

	$first_name = $_POST['first_name'] ?? '';
	$last_name = $_POST['last_name'] ?? '';
	$type = $_POST['type'] ?? '';
	$class_time = $_POST['class_time'] ?? '';

	echo "Form parameters<br />";
	echo "First name: " . $first_name . "<br />";
	echo "Last name: " . $last_name . "<br />";
	echo "Type: " . $type . "<br />";
	echo "Class time: " . $class_time . "<br />";
} 
?>

<?php $page_title = 'Create Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject new">
    <h1>Page Edit</h1>

    <form action="<?php echo url_for('/staff/pages/edit.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>First Name</dt>
        <dd><input type="text" name="first_name" value="<?php echo h($first_name); ?>" /></dd>
      </dl>
	  <dl>
        <dt>Last Name</dt>
        <dd><input type="text" name="last_name" value="<?php echo h($last_name); ?>" /></dd>
      </dl>
      <dl>
        <dt>Yoga Type</dt>
        <dd>
          <select name="class_type">
            <option value="Vanyasa">Vanyasa</option>
			<option value="Vanyasa">Vanyasa</option>
			<option value="Vanyasa">Vanyasa</option>
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
        <input type="submit" value="Create Subject" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
