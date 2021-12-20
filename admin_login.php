<?php
session_start();
if(isset($_POST['password'])){
    $connection = new mysqli('MYSQL5045.site4now.net', 'a7d73a_mydb', 'BjV96SsFsh*zfL4', 'db_a7d73a_mydb');
    $sql_query= "SELECT password FROM user WHERE name LIKE '__admin__'";
    $pass = $connection->query($sql_query)->fetch_assoc()["password"];
    if (password_verify($_POST['password'], $pass)){
        $_SESSION['is_auth'] = true;
        $_SESSION['is_admin'] = true;
        header('Location: admin_panel.php');
    }
    else{
        header('Location: login.html');
    }
}