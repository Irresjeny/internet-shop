<?php
class Cart{
    private $connection;
    public $name;
    public $description;
    public $country;
    public $price;
    public $supplier;
    public $amount;
    public $category;
    public function __construct($name, $description, $country, $price, $supplier, $amount, $category){
        $this->connection = new mysqli('MYSQL5045.site4now.net', 'a7d73a_mydb', 'BjV96SsFsh*zfL4', 'db_a7d73a_mydb');
        $this->name = $name;
        $this->description = $description;
        $this->country = $country;
        $this->price = $price;
        $this->supplier = $supplier;
        $this->amount = $amount;
        $this->category = $category;
    }

    public function getCart(){
        echo '<style>
                h3{
                    margin: 3px;
                }
                h5{
                    margin: 3px;
                }
              </style>';
        $sql_query = "SELECT name FROM country where id LIKE '$this->country'";
        $this->country = $this->connection->query($sql_query)->fetch_assoc()["name"];
        $sql_query = "SELECT name FROM category where id LIKE '$this->category'";
        $this->category = $this->connection->query($sql_query)->fetch_assoc()["name"];
        echo '<div style="border: 1px solid black; margin-right: 10px; margin-top: 10px; width: 300px">
                <h3>'.$this->name.'</h3><br>
                <h5>'.$this->description.'</h5><br>
                <h5>Country: '.$this->country.'</h5><br>
                <h5>Price: '.$this->price.'$</h5><br>
                <h5>Supplier:'.$this->supplier.'</h5><br>
                <h5>Amount:'.$this->amount.'kg.</h5><br>
                <h5>Category:'.$this->category.'</h5><br>
              </div>';
    }
}

session_start();
if(isset($_SESSION["is_auth"])){
    if(!$_SESSION["is_auth"]){
        header('Location: login.html');
    }
}
else{
    header('Location: login.html');
}


$connection = new mysqli('MYSQL5045.site4now.net', 'a7d73a_mydb', 'BjV96SsFsh*zfL4', 'db_a7d73a_mydb');
$sql_query = "SELECT * FROM category";
$categories = $connection->query($sql_query);

if(isset($_POST['category'])){
    $category = $_POST['category'];
}
else{
    $category = 'All';
}
if ($category == 'All'){
    $sql_query = "SELECT * FROM product";
    $products = $connection->query($sql_query);
}
else{
    $sql_query = "SELECT id FROM category where name LIKE '$category'";
    $categoryId = $connection->query($sql_query)->fetch_assoc()["id"];
    $sql_query = "SELECT * FROM product where categoryId LIKE '$categoryId'";
    $products = $connection->query($sql_query);
}
$carts = array();
foreach ($products as $product){
    $carts[] = new Cart($product["name"], $product["description"], $product["countryId"], $product["price"],
        $product["supplier"], $product["amount"], $product["categoryId"]);
}

echo '<form action="index.php" method="post">
<input type="submit" name="category" value="All">';
foreach ($categories as $category){
    echo '<input type="submit" name="category" value="'.$category["name"].'">';
}
echo '</form>';

echo "<div style='display: flex'>";
foreach ($carts as $cart){
    $cart->getCart();
}
echo '</div>';
?>
