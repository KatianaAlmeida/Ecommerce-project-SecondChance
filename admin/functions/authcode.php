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
    $check_email = "SELECT email FROM users WHERE email=?";
    $check_stmt = mysqli_prepare($connection, $check_email);
    mysqli_stmt_bind_param($check_stmt, "s", $email);
    mysqli_stmt_execute($check_stmt);
    $check_result = mysqli_stmt_get_result($check_stmt);

    if (mysqli_num_rows($check_result) > 0) {
        $_SESSION['message'] = 'Email already registered!';
        header('Location: ../add_users.php');
    } else {
        if ($password == $confirmed_password) {
            // create user
            $createUserSql = "CREATE USER ?@'localhost' IDENTIFIED BY ?";
            $createUserStmt = mysqli_prepare($connection, $createUserSql);
            mysqli_stmt_bind_param($createUserStmt, "ss", $username, $password);
            $createUserSql_run = mysqli_stmt_execute($createUserStmt);

            // insert user data
            $insert_query = "INSERT INTO users (username, full_name, email, password, role) VALUES (?, ?, ?, ?, ?)";
            $insert_stmt = mysqli_prepare($connection, $insert_query);
            mysqli_stmt_bind_param($insert_stmt, "sssss", $username, $fullName, $email, $password, $role);
            $insert_query_run = mysqli_stmt_execute($insert_stmt);

            if ($insert_query_run && $createUserSql_run) {
                $_SESSION['message'] = 'Registered Successfully!';
                header('Location: ../add_users.php');
            } else {
                $_SESSION['message'] = 'Something went wrong!';
                header('Location: ../add_users.php');
            }
        } else {
            $_SESSION['message'] = 'Password do not match!';
            header('Location: ../add_users.php');
        }
    }
}

if (isset($_POST['login-btn'])) {

    if (isset($_SESSION['auth_admin'])) {
        header('Location: ../dashboard.php');
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $login_query = "SELECT * FROM users WHERE email=? AND password=? AND role != 'customer'";
        $login_stmt = mysqli_prepare($connection, $login_query);
        mysqli_stmt_bind_param($login_stmt, "ss", $email, $password);
        mysqli_stmt_execute($login_stmt);
        $run_query = mysqli_stmt_get_result($login_stmt);

        if (mysqli_num_rows($run_query) > 0) {
            $_SESSION['auth_admin'] = true;
            $userdata = mysqli_fetch_array($run_query);
            $user_name = $userdata['full_name'];
            $user_email = $userdata['email'];

            $_SESSION['auth_user_admin'] = [
                'full_name' => $user_name,
                'email' => $user_email
            ];
            header('Location: ../dashboard.php');
        } else {
            $_SESSION['message'] = 'Invalid Credentials!';
            header('Location: ../index.php');
        }
    }
}
?>