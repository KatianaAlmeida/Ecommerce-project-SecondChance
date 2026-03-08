<?php

session_start();
include('../config/dbcon.php');

if (isset($_POST['register-btn'])) {

    $email = $_POST['email'];
    $role = 'customer';
    $password = $_POST['password'];
    $confirmed_password = $_POST['confirm-password'];

    // Check if email already registered
    $check_email_sql = "SELECT email FROM users WHERE email = $1";
    $check_query_run = pg_query_params($connection, $check_email_sql, [$email]);

    if ($check_query_run && pg_num_rows($check_query_run) > 0) {
        $_SESSION['message'] = 'Email already registered!';
        header('Location: ../register.php');
        exit();
    } else {

        if ($password == $confirmed_password) {

            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Insert user data
            $username = $_POST['username'];
            $fullName = $_POST['fullName'];

            $insert_query = "INSERT INTO users (username, full_name, email, password, role)
                             VALUES ($1, $2, $3, $4, $5)";
            $insert_query_run = pg_query_params($connection, $insert_query, [$username, $fullName, $email, $hashed_password, $role]);

            if ($insert_query_run) {
                $_SESSION['regis'] = true;
                $_SESSION['message'] = 'Registered Successfully!';
                header('Location: ../login.php');
                exit();
            } else {
                $_SESSION['message'] = 'Something went wrong!';
                header('Location: ../register.php');
                exit();
            }

        } else {
            $_SESSION['message'] = 'Password do not match!';
            header('Location: ../register.php');
            exit();
        }
    }
}

if (isset($_POST['login-btn'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Retrieve stored user data
    $login_sql = "SELECT id, full_name, email, username, password FROM users WHERE email = $1";
    $result = pg_query_params($connection, $login_sql, [$email]);

    if ($result && pg_num_rows($result) > 0) {
        $userdata = pg_fetch_assoc($result);
        $hashed_password = $userdata['password'];

        if (password_verify($password, $hashed_password) || $password == $hashed_password) {
            // Either hashed or old plain password
            $_SESSION['auth'] = true;
            $_SESSION['auth_user'] = [
                'full_name' => $userdata['full_name'],
                'email' => $userdata['email'],
                'id' => $userdata['id'],
                'username' => $userdata['username']
            ];
            header('Location: ../home.php');
            exit();
        } else {
            $_SESSION['message'] = 'Invalid Password!';
            header('Location: ../login.php');
            exit();
        }

    } else {
        $_SESSION['message'] = 'Invalid Credentials!';
        header('Location: ../login.php');
        exit();
    }
}
?>