<?php
session_start();
if(isset($_POST['login'])){
    if ($_POST['login'] == '__admin__'){
        header('Location: admin_login.html');
    }
    elseif(isset($_POST['password'])){
        $connection = new mysqli('MYSQL5045.site4now.net', 'a7d73a_mydb', 'BjV96SsFsh*zfL4', 'db_a7d73a_mydb');
        $email = $_POST['login'];
        $sql_query= "SELECT password FROM user WHERE email LIKE '$email'";
        $pass = $connection->query($sql_query)->fetch_assoc()["password"];
        if (password_verify($_POST['password'], $pass)){
            $_SESSION['is_auth'] = true;
            $_SESSION['is_admin'] = false;
            header('Location: index.php');
        }
        else{
            header('Location: login.html');
        }
    }

}
