<?php
	if(!isset($page_title)) { $page_title = 'Staff Area';}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Yondu Yoga <?php echo $page_title;?></title>
		<meta charset="utf-8">
		<link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/brand2.css'); ?>" />
		<link href="https://fonts.googleapis.com/css?family=Cinzel+Decorative" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Vollkorn+SC" rel="stylesheet">
	</head>
	
	<body>
		<header>
			<h1>Yondu Yoga Staff Area</h1>
		<header>
		<nav>
      <ul>
        <li>User: <?php echo $_SESSION['username'] ?? ''; ?></li>
        <li><a href="<?php echo url_for('/staff/index.php'); ?>">Menu</a></li>
        <li><a href="<?php echo url_for('/staff/logout.php'); ?>">Logout</a></li>
      </ul>
    </nav>
	
	<?php echo display_session_message(); ?>