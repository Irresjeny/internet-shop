<?php
$connection = new mysqli('MYSQL5045.site4now.net', 'a7d73a_mydb', 'BjV96SsFsh*zfL4', 'db_a7d73a_mydb');
$sql_query = "SELECT * FROM product";
$products = $connection->query($sql_query);
if ($products->num_rows > 0) {
    foreach ($products as $product) {
        echo $product["name"] . ':' . $product["amount"] . 'kg <br>';
    }
}

$sql_query = "SELECT * FROM country";
$countries = $connection->query($sql_query);
$sql_query = "SELECT * FROM category";
$categories = $connection->query($sql_query);


echo '<form action="add.php" method="post">
      <label>Name<br>
      <input type="text" placeholder="input name" name="name"></label>
      <br>
      <label>Description<br>
        <input type="text" placeholder="input description" name="description"></label>
      <br>
      <label>Country<br>
      <select name="country">';
foreach ($countries as $country) {
    echo '<option value='.$country['id'].'>'.$country["name"].'</option>';
}
echo '</select></label>
      <br>
      <label>Price<br>
        <input type="text" placeholder="input price in dollars" name="price"></label>
      <br>
      <label>Supplier<br>
        <input type="text" placeholder="input supplier" name="supplier"></label>
      <br>
      <label>Amount<br>
        <input type="text" placeholder="input amount" name="amount"></label>
      <br>
      <label>Category<br>
      <select name="category">';
foreach ($categories as $category) {
    echo '<option value='.$category['id'].'>'.$category["name"].'</option>';
}
echo '</select></label>
<br>
      <input type="submit" value="add">
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <input type="submit" formaction="logout.php" value="logout">
</form>';