<?php
    include_once "inc/connect.php";

    $messages = [];

    function formNoErrors($username, $email, $password, $confirm_password) {
        global $messages;
        $no_errors = TRUE;

        if(empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
            $messages["mainLog"] = ['error', 'All fields must be filled!'];
            return FALSE;
        }

        if(isUsernameUnique($username) === FALSE) {
            $messages["username"] = 'This username exists!';
            return FALSE;
        }

        if(!preg_match('/^[a-zA-Z0-9_]*$/', $username)) {
            $messages["username"] = 'Invalid username!';
            $no_errors = FALSE;
        }

        if(filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
            $messages["email"] = 'Invalid email!';
            $no_errors = FALSE;
        }

        if(strlen($password) < 8 || is_string($password) === FALSE) {
            $messages["password"] = 'Invalid password! The password must be at least 8 characters!';
            $no_errors = FALSE;
        }

        if(is_string($confirm_password) === FALSE || $password !== $confirm_password) {
            $messages["confirmPassword"] = 'The confirmed password must be the same as entered password!';
            $no_errors = FALSE;
        }

        return $no_errors;
    }

    function isUsernameUnique($username) {
        global $conn;
        $query = "SELECT username FROM users WHERE username = '$username';";
        $results = mysqli_query($conn, $query);

        if(mysqli_num_rows($results) > 0) return FALSE;
        return TRUE;
    }

    if(isset($_POST['submit'])) {
        $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $password = htmlspecialchars($_POST["password"]);
        $confirm_password = htmlspecialchars($_POST["confirmPassword"]);

        if(formNoErrors($username, $email, $password, $confirm_password)) {
            $password = md5($password);

            $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password');";
            mysqli_query($conn, $query);

            $messages["mainLog"] = ['success', 'Account has been created! Please sign in to use the account!'];
        } 

        echo json_encode($messages);
    }