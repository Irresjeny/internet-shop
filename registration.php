<?php
session_start();
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['address'])
    && isset($_POST['password']) && isset($_POST['password1'])) {
    if (strlen($_POST['name']) && strlen($_POST['email']) && strlen($_POST['address']) && strlen($_POST['password'])
        && strlen($_POST['password1'])) {
        if ($_POST['password'] == $_POST['password1']) {
            $connection = new mysqli('MYSQL5045.site4now.net', 'a7d73a_mydb', 'BjV96SsFsh*zfL4', 'db_a7d73a_mydb');
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            } else {
                $sql_query = "INSERT INTO basket(products) VALUES('')";
                if ($connection->query($sql_query) === TRUE) {
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $address = $_POST['address'];
                    $password = password_hash($_POST['password'], PASSWORD_BCRYPT, ["cost" => 10]);
                    $basketId = $connection->insert_id;
                    $sql_query = "INSERT INTO user(name, email, address, password, basketId)
                                  VALUES('$name', '$email', '$address', '$password', '$basketId')";
                    if ($connection->query($sql_query) === TRUE) {
                        $_SESSION['is_auth'] = true;
                        header('Location: index.php');
                    }
                    else{
                        echo "Error: " . $sql_query . "<br>" . $connection->error;
                    }

                } else {
                    echo "Error: " . $sql_query . "<br>" . $connection->error;
                }

            }
        }
        else{
            echo 'Password mismatch<br>';
            echo '<form><input type="submit" formaction="registration.html" value="registration"></form>';
        }

    }
    else{
        echo 'fields must not be empty<br>';
        echo '<form><input type="submit" formaction="registration.html" value="registration"></form>';
    }
}
else{
    echo 'fields must not be empty 1<br>';
    echo '<form><input type="submit" formaction="registration.html" value="registration"></form>';
}