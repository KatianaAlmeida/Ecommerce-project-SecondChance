<?php

session_start();
include('../../config/dbcon.php');

if (isset($_POST['register-btn'])) {
    $fullName = $_POST['fullName'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmed_password = $_POST['confirm-password'];
    $role = $_POST['role'];

    // check if email already registered
    $check_email_sql = "SELECT email FROM users WHERE email = $1";
    $check_result = pg_query_params($connection, $check_email_sql, [$email]);

    if ($check_result && pg_num_rows($check_result) > 0) {
        $_SESSION['message'] = 'Email already registered!';
        header('Location: ../add_users.php');
        exit();
    } else {
        if ($password == $confirmed_password) {

            // insert user data into the users table
            $insert_query = "INSERT INTO users (username, full_name, email, password, role)
                             VALUES ($1, $2, $3, $4, $5)";
            $insert_query_run = pg_query_params($connection, $insert_query, [$username, $fullName, $email, $password, $role]);

            if ($insert_query_run) {
                $_SESSION['message'] = 'Registered Successfully!';
                header('Location: ../add_users.php');
                exit();
            } else {
                $_SESSION['message'] = 'Something went wrong!';
                header('Location: ../add_users.php');
                exit();
            }

        } else {
            $_SESSION['message'] = 'Password do not match!';
            header('Location: ../add_users.php');
            exit();
        }
    }
}

if (isset($_POST['login-btn'])) {

    if (isset($_SESSION['auth_admin'])) {
        header('Location: ../dashboard.php');
        exit();
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $login_query = "SELECT * FROM users WHERE email = $1 AND password = $2 AND role != 'customer'";
        $run_query = pg_query_params($connection, $login_query, [$email, $password]);

        if ($run_query && pg_num_rows($run_query) > 0) {
            $_SESSION['auth_admin'] = true;

            $userdata = pg_fetch_assoc($run_query);
            $user_name = $userdata['full_name'];
            $user_email = $userdata['email'];

            $_SESSION['auth_user_admin'] = [
                'full_name' => $user_name,
                'email' => $user_email
            ];
            header('Location: ../dashboard.php');
            exit();
        } else {
            $_SESSION['message'] = 'Invalid Credentials!';
            header('Location: ../index.php');
            exit();
        }
    }
}
?>