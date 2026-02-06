<h1> Please enter order number : <h1>
<form method="post">
    <input type="text" name="orderNum" placeholder="Order number ">
    <button type="submit">Search</button>
</form>



<?php
require "App\config\Database.php";
$db=new Database;
$conn=$db->connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $orderNum = $_POST["orderNum"];
   
$sql = "SELECT * FROM classicmodels.orders where orderNumber = $orderNum";

$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<h3>";
        echo "<td>{$row['orderNumber']} </td>";
        
        echo "<td>{$row['orderDate']} </td>";
        echo "<td>{$row['requiredDate']} </td>";
        echo "<td>{$row['shippedDate']} </td>";
        echo "<td>{$row['status']} </td>";
        echo "<td>{$row['customerNumber']} </td>";
     
        
        echo "</tr>";
    }
}
    ?>



