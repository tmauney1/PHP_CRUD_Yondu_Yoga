<?php

  function find_all_subjects() {
    global $db;

    $sql = "SELECT * FROM customers ";
    $result = mysqli_query($db, $sql);
	confirm_result_set($result);
    return $result;
  }
  
	function find_customer_by_id($id){
		global $db;
		
		$sql = "SELECT * FROM customers ";
		$sql .= "WHERE id='" . db_escape($db,$id) . "'";
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$customer = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $customer; // returns an assoc array
	}
	
	function validate_customer($customer) {

		$errors = [];
		  
		  // first_name
		  if(is_blank($customer['first_name'])) {
			$errors[] = "First name cannot be blank.";
		  }elseif(!has_length($customer['first_name'], ['min' => 2, 'max' => 255])) {
			$errors[] = "First name must be between 2 and 255 characters.";
		  }
		  
		   // last_name
		  if(is_blank($customer['last_name'])) {
			$errors[] = "Last name cannot be blank.";
		  }elseif(!has_length($customer['last_name'], ['min' => 2, 'max' => 255])) {
			$errors[] = "Last name must be between 2 and 255 characters.";
		  }

		  return $errors;
		}

	
	function insert_customer($customer){
		global $db;
		
		$errors = validate_customer($customer);
		if(!empty($errors)){
			return $errors;
		}
		$sql = "INSERT INTO customers ";
		$sql .= "(first_name, last_name, class_type, class_time) ";
		$sql .= "VALUES (";
		$sql .= "'" . db_escape($db, $customer['first_name']) . "',";
		$sql .= "'" . db_escape($db, $customer['last_name']) . "',";
		$sql .= "'" . db_escape($db, $customer['class_type']) . "',";
		$sql .= "'" . db_escape($db, $customer['class_time']) . "'";
		$sql .= ")";
		$result = mysqli_query($db, $sql);
		//for INSERT statements, $result is true/false
		
		if($result){
			return true;
			
		} else {
			//INSERT failed
			echo mysqli_error($db);
			db_disconnect($db);
			exit;
		}
	}

	
	function update_customer($customer){	
		global $db;
		
		$errors = validate_customer($customer);
		if(!empty($errors)){
			return $errors;
		}
		$sql = "UPDATE customers SET ";
		$sql .= "first_name='" . db_escape($db, $customer['first_name']) . "',";
		$sql .= "last_name='" . db_escape($db, $customer['last_name']) . "',";
		$sql .= "class_type='" . db_escape($db, $customer['class_type']) . "',";
		$sql .= "class_time='" . db_escape($db, $customer['class_time']) . "' ";
		$sql .= "WHERE id='" . db_escape($db, $customer['id']) . "' ";
		$sql .= "LIMIT 1";
		
		$result = mysqli_query($db, $sql);
		//for UPDATE statements, the result is true/false
		
		if($result){
			return true;
		} else{
			//UPDATE failed
			echo mysqli_error($db);
			db_disconnect($db);
			exit;
		}
	}
	
	  function delete_customer($id) {
    global $db;

    $sql = "DELETE FROM customers ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }
	
	
	function find_all_admins() {
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "ORDER BY last_name ASC, first_name ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_admin_by_id($id) {
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $admin = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $admin; // returns an assoc. array
  }
 
 function find_admin_by_username($username) {
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $admin = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $admin; // returns an assoc. array
  }

  function validate_admin($admin) {

    if(is_blank($admin['first_name'])) {
      $errors[] = "First name cannot be blank.";
    } elseif (!has_length($admin['first_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "First name must be between 2 and 255 characters.";
    }

    if(is_blank($admin['last_name'])) {
      $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($admin['last_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Last name must be between 2 and 255 characters.";
    }

    if(is_blank($admin['email'])) {
      $errors[] = "Email cannot be blank.";
    } elseif (!has_length($admin['email'], array('max' => 255))) {
      $errors[] = "Last name must be less than 255 characters.";
    } elseif (!has_valid_email_format($admin['email'])) {
      $errors[] = "Email must be a valid format.";
    }

    if(is_blank($admin['username'])) {
      $errors[] = "Username cannot be blank.";
    } elseif (!has_length($admin['username'], array('min' => 8, 'max' => 255))) {
      $errors[] = "Username must be between 8 and 255 characters.";
    } elseif (!has_unique_username($admin['username'], $admin['id'] ?? 0)) {
      $errors[] = "Username not allowed. Try another.";
    }

    if(is_blank($admin['password'])) {
      $errors[] = "Password cannot be blank.";
    } elseif (!has_length($admin['password'], array('min' => 12))) {
      $errors[] = "Password must contain 12 or more characters";
    } elseif (!preg_match('/[A-Z]/', $admin['password'])) {
      $errors[] = "Password must contain at least 1 uppercase letter";
    } elseif (!preg_match('/[a-z]/', $admin['password'])) {
      $errors[] = "Password must contain at least 1 lowercase letter";
    } elseif (!preg_match('/[0-9]/', $admin['password'])) {
      $errors[] = "Password must contain at least 1 number";
    } elseif (!preg_match('/[^A-Za-z0-9\s]/', $admin['password'])) {
      $errors[] = "Password must contain at least 1 symbol";
    }

    if(is_blank($admin['confirm_password'])) {
      $errors[] = "Confirm password cannot be blank.";
    } elseif ($admin['password'] !== $admin['confirm_password']) {
      $errors[] = "Password and confirm password must match.";
    }

    return $errors;
  }

  function insert_admin($admin) {
    global $db;

    $errors = validate_admin($admin);
    if (!empty($errors)) {
      return $errors;
    }

    $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO admins ";
    $sql .= "(first_name, last_name, email, username, hashed_password) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $admin['first_name']) . "',";
    $sql .= "'" . db_escape($db, $admin['last_name']) . "',";
    $sql .= "'" . db_escape($db, $admin['email']) . "',";
    $sql .= "'" . db_escape($db, $admin['username']) . "',";
    $sql .= "'" . db_escape($db, $hashed_password) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);

    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function update_admin($admin) {
    global $db;

    $errors = validate_admin($admin);
    if (!empty($errors)) {
      return $errors;
    }

    $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);

    $sql = "UPDATE admins SET ";
    $sql .= "first_name='" . db_escape($db, $admin['first_name']) . "', ";
    $sql .= "last_name='" . db_escape($db, $admin['last_name']) . "', ";
    $sql .= "email='" . db_escape($db, $admin['email']) . "', ";
    $sql .= "hashed_password='" . db_escape($db, $hashed_password) . "',";
    $sql .= "username='" . db_escape($db, $admin['username']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $admin['id']) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function delete_admin($admin) {
    global $db;

    $sql = "DELETE FROM admins ";
    $sql .= "WHERE id='" . db_escape($db, $admin['id']) . "' ";
    $sql .= "LIMIT 1;";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

?>


