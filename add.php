<?php
if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['country']) && isset($_POST['price'])
    && isset($_POST['supplier']) && isset($_POST['amount']) && isset($_POST['category'])){
    $name = $_POST['name'];
    $description = addcslashes($_POST['description'], '\'');
    $country = $_POST['country'];
    $price = $_POST['price'];
    $supplier = $_POST['supplier'];
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    if(strlen($name) && strlen($description) && strlen($country) && strlen($price) && strlen($supplier)
        && strlen($amount)&& strlen($category)){
        $connection = new mysqli('MYSQL5045.site4now.net', 'a7d73a_mydb', 'BjV96SsFsh*zfL4', 'db_a7d73a_mydb');
        $sql_query = "INSERT INTO product(name, description, countryid, price, supplier, amount, categoryid)
                    VALUES('$name', '$description', '$country', '$price', '$supplier', '$amount', '$category')";
        if ($connection->query($sql_query) === TRUE) {
            header('Location: admin_panel.php');
        }
        else{
            echo "Error: " . $sql_query . "<br>" . $connection->error;
        }
    }
    else{
        echo '--';
    }
}
else{
    var_dump($_POST);
}