<?php
    include "inc/connect.php";
    include "inc/header.php";

    $messages = [];

    function formNoErrors($username, $password) {
        global $messages;
        $no_errors = TRUE;

        if(!preg_match('/^[a-zA-Z0-9_]*$/', $username)) {
            $messages["username"] = 'Invalid username!';
            $no_errors = FALSE;
        }

        return $no_errors;
    }

    if(isset($_POST["login-submit"])) {
        $username = filter_var($_POST["login-username"], FILTER_SANITIZE_STRING);
        $password = htmlspecialchars($_POST["login-password"]);

        if(formNoErrors($username, $password)) {
            $password = md5($password);
            $query = "SELECT username, password FROM users WHERE username = '$username' AND password = '$password' LIMIT 1;";
            $results = mysqli_query($conn, $query);

            if(mysqli_num_rows($results) === 1) {
                $rows = mysqli_fetch_array($results);

                session_start();
                $_SESSION["username"] = $username;
                header("Location:http://localhost:8080/PHP/Mini%20projects/PHP%20Login%20and%20Registration%20Form/dashboard.php");
                exit;
            }
            else {
                session_start();
                $_SESSION["message"] = "Username or password is invalid. Create an account if you didn't sign up!";
                header("Location:http://localhost:8080/PHP/Mini%20projects/PHP%20Login%20and%20Registration%20Form/");
                exit;
            }
        }
        else {
            session_start();
            $_SESSION["message"] = "Username is not valid!";
            header("Location:http://localhost:8080/PHP/Mini%20projects/PHP%20Login%20and%20Registration%20Form/");
            exit;
        }
    }

