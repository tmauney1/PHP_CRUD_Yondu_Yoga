<?php require_once('../../../private/initialize.php'); ?>

<?php


  $customer_set = find_all_subjects();
require_login();
?>

<?php $page_title = 'Subjects'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="subjects listing">
    <h1>Subjects</h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/staff/subjects/new.php');?>">Create New Subject</a>
    </div>

  	<table class="list">
  	  <tr>
        <th>ID</th>
        <th>Pirst Name</th>
        <th>Last Name</th>
  	    <th>Class Type</th>
		<th>Class Time</th>
  	    <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
  	  </tr>

      <?php while($customer = mysqli_fetch_assoc($customer_set)){ ?>
        <tr>
          <td><?php echo h($customer['id']); ?></td>
          <td><?php echo h($customer['first_name']); ?></td>
          <td><?php echo h($customer['last_name']); ?></td>
    	    <td><?php echo h($customer['class_type']); ?></td>
			   <td><?php echo h($customer['class_time']); ?></td>
          <td><a class="action" href="<?php echo url_for('/staff/subjects/show.php?id=' . h(u($customer['id']))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/subjects/edit.php?id=' . h(u($customer['id'])));?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/subjects/delete.php?id=' . h(u($customer['id'])));?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>
	<?php

		 mysqli_free_result($customer_set);

	?>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
