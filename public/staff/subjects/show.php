<?php require_once('../../../private/initialize.php'); ?>

<?php

require_login();
// $id = isset($_GET['id']) ? $_GET['id'] : '1';
$id = $_GET['id'] ?? '1'; // PHP > 7.0

$customer = find_customer_by_id($id);
?>

<?php $page_title = 'Show Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

	<div id="content">

	  <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>

	  <div class="subject show">

		<h1>Subject: <?php echo h($customer['first_name']) . " " .h($customer['last_name']); ?></h1>

	<div class="attributes">
	  <dl>
		<dt>First Name</dt>
		<dd><?php echo h($customer['first_name']); ?></dd>
	  </dl>
	  <dl>
		<dt>Last Name</dt>
		<dd><?php echo h($customer['last_name']); ?></dd>
	  </dl>
	  <dl>
		<dt>Class Type</dt>
		<dd><?php echo h($customer['class_type']); ?></dd>
	  </dl>
	  <dl>
		<dt>Class Time</dt>
		<dd><?php echo h($customer['class_time']); ?></dd>
	  </dl>
	</div>


	  </div>

	</div>
