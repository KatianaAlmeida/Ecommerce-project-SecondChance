<?php

session_start();
include('../config/dbcon.php');

if(isset($_POST['register-btn'])){
  $password = mysqli_real_escape_string($connection, $_POST['password']);
  $confirmed_password = mysqli_real_escape_string($connection, $_POST['confirm-password']);
  
  // check if email alredy registered
  $check_email = $connection->prepare("SELECT email FROM users WHERE email= ? ");
  $check_email->bind_param("s", $email);

  $email = $_POST['email'];
  $role = 'customer';
  $check_email->execute();
  $check_query_run = $check_email->get_result();

  if($check_query_run->num_rows > 0){
    $_SESSION['message'] = 'Email alredy registered!';
    header('Location: ../register.php');
  }else{
    if($password == $confirmed_password){
      // insert user data
      $insert_query = $connection->prepare("INSERT INTO users (username, full_name, email, password, role) 
      VALUES (?, ?, ?, ?, ?)");

      if (!$insert_query) {
        die("Prepare failed: " . $connection->error);
      }
      $insert_query->bind_param("sssss", $username, $fullName, $email, $password, $role);
      $username = $_POST['username'];
      $fullName = $_POST['fullName'];
      $hashed_password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
  
      if($insert_query->execute()){
        $_SESSION['regis'] = true;
        $_SESSION['message'] = 'Registered Successfully!';
        header('Location: ../login.php');
      }else{
        $_SESSION['message'] = 'Something went wrong!';
        header('Location: ../register.php');
      }
    }else{
      $_SESSION['message'] = 'Password do not match!';
      header('Location: ../register.php');
    }
  }
}

if (isset($_POST['login-btn'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Prepare the statement to retrieve the stored hash and other user data
  $stmt = $connection->prepare("SELECT id, full_name, email, username, password FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
      $userdata = $result->fetch_assoc();
      $hashed_password = $userdata['password'];

      if (password_verify($password, $hashed_password)) {
          $_SESSION['auth'] = true;
          $_SESSION['auth_user'] = [
              'full_name' => $userdata['full_name'],
              'email' => $userdata['email'],
              'id' => $userdata['id'],
              'username' => $userdata['username']
          ];
          header('Location: ../home.php');
      } else if ($password == $hashed_password) {
        // for accounts created before the hash code
        $_SESSION['auth'] = true;
          $_SESSION['auth_user'] = [
              'full_name' => $userdata['full_name'],
              'email' => $userdata['email'],
              'id' => $userdata['id'],
              'username' => $userdata['username']
          ];
          header('Location: ../home.php');

      }else {
          $_SESSION['message'] = 'Invalid Password!';
          header('Location: ../login.php');
      }
  } else {
      $_SESSION['message'] = 'Invalid Credentials!';
      header('Location: ../login.php');
  }

  $stmt->close();
}
?>