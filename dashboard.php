<?php 
    session_start(); 
    include "inc/header.php";

    if(!isset($_SESSION["username"])) {
        header("Location:http://localhost:8080/PHP/Mini%20projects/PHP%20Login%20and%20Registration%20Form/");
        exit();
    }
?>
<body>
    <div class="container">
        <div class="main-dashboard">
            <div class="greeting">
                <h1>Hello <?php echo $_SESSION["username"]; ?>!</h1>
                <h2>Welcome to our website!</h2>
            </div>
            <p>No features here at the moment...</p>
            <form method="POST">
                <button id="signout" name="signout">Sign Out</button>
            </form>
            <?php
                if(isset($_POST["signout"])) {
                    session_destroy();
                    session_abort();
                    header("Location:http://localhost:8080/PHP/Mini%20projects/PHP%20Login%20and%20Registration%20Form/");
                    exit();
                }
            ?>
        </div>
    </div>
    <?php include "inc/footer.php"?>