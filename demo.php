<?php
require "App\config\Database.php";  // your Database class

// Create Database instance and connect
$db = new Database();
$conn = $db->connect();
?>

<h1 style="text-align:center; font-family: Arial, sans-serif; color:#333;">Please enter order number:</h1>

<form method="post" style="text-align:center; margin-bottom: 20px;">
    <input type="text" name="orderNum" placeholder="Order number" 
           style="padding:8px; width:200px; border:1px solid #ccc; border-radius:4px;">
    <button type="submit" 
            style="padding:8px 16px; background-color:#4CAF50; color:white; border:none; border-radius:4px; cursor:pointer;">
        Search
    </button>
</form>

<?php
// ---------- ORDER SEARCH ----------
if (isset($_POST["orderNum"])) {
    
    $orderNum = $_POST["orderNum"];
    $sql = "SELECT * FROM classicmodels.orders WHERE orderNumber = $orderNum";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h3 style='text-align:center;'>Order Details</h3>";
        echo "<table style='width:80%; margin:0 auto; border-collapse: collapse; font-family: Arial, sans-serif;'>";
        echo "<tr style='background-color:#4CAF50; color:white; text-align:center;'>";
        echo "<th style='padding:10px; border:1px solid #ddd;'>Order Number</th>";
        echo "<th style='padding:10px; border:1px solid #ddd;'>Order Date</th>";
        echo "<th style='padding:10px; border:1px solid #ddd;'>Required Date</th>";
        echo "<th style='padding:10px; border:1px solid #ddd;'>Shipped Date</th>";
        echo "<th style='padding:10px; border:1px solid #ddd;'>Status</th>";
        echo "<th style='padding:10px; border:1px solid #ddd;'>Customer Number</th>";
        echo "</tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr style='text-align:center; border:1px solid #ddd;'>";
            echo "<td style='padding:8px'>{$row['orderNumber']}</td>";
            echo "<td style='padding:8px'>{$row['orderDate']}</td>";
            echo "<td style='padding:8px'>{$row['requiredDate']}</td>";
            echo "<td style='padding:8px'>{$row['shippedDate']}</td>";
            echo "<td style='padding:8px'>{$row['status']}</td>";
            echo "<td style='padding:8px'>{$row['customerNumber']}</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p style='text-align:center; font-family: Arial, sans-serif; color:#555;'>No orders found for order number $orderNum</p>";
    }
}
?>

<hr style="margin:40px 0;">

<h1 style="text-align:center; font-family: Arial, sans-serif; color:#333;">Please enter customer number:</h1>

<form method="post" style="text-align:center; margin-bottom: 20px;">
    <input type="text" name="custNum" placeholder="Customer number" 
           style="padding:8px; width:200px; border:1px solid #ccc; border-radius:4px;">
    <button type="submit" 
            style="padding:8px 16px; background-color:#4CAF50; color:white; border:none; border-radius:4px; cursor:pointer;">
        Search
    </button>
</form>

<?php
// ---------- CUSTOMER SEARCH ----------
if (isset($_POST["custNum"])) {
    
    $custNum = $_POST["custNum"];
    $sql = "SELECT * FROM classicmodels.customers WHERE customerNumber = $custNum";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h3 style='text-align:center;'>Customer Details</h3>";
        echo "<table style='width:90%; margin:0 auto; border-collapse: collapse; font-family: Arial, sans-serif;'>";
        echo "<tr style='background-color:#4CAF50; color:white; text-align:center;'>";
        echo "<th style='padding:10px; border:1px solid #ddd;'>Customer Number</th>";
        echo "<th style='padding:10px; border:1px solid #ddd;'>Name</th>";
        echo "<th style='padding:10px; border:1px solid #ddd;'>Contact Last Name</th>";
        echo "<th style='padding:10px; border:1px solid #ddd;'>Contact First Name</th>";
        echo "<th style='padding:10px; border:1px solid #ddd;'>Phone</th>";
        echo "<th style='padding:10px; border:1px solid #ddd;'>Address</th>";
        echo "<th style='padding:10px; border:1px solid #ddd;'>City</th>";
        echo "<th style='padding:10px; border:1px solid #ddd;'>Postal Code</th>";
        echo "<th style='padding:10px; border:1px solid #ddd;'>Country</th>";
        echo "<th style='padding:10px; border:1px solid #ddd;'>Credit Limit</th>";
        echo "</tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr style='text-align:center; border:1px solid #ddd;'>";
            echo "<td style='padding:8px'>{$row['customerNumber']}</td>";
            echo "<td style='padding:8px'>{$row['customerName']}</td>";
            echo "<td style='padding:8px'>{$row['contactLastName']}</td>";
            echo "<td style='padding:8px'>{$row['contactFirstName']}</td>";
            echo "<td style='padding:8px'>{$row['phone']}</td>";
            echo "<td style='padding:8px'>{$row['addressLine1']}</td>";
            echo "<td style='padding:8px'>{$row['city']}</td>";
            echo "<td style='padding:8px'>{$row['postalCode']}</td>";
            echo "<td style='padding:8px'>{$row['country']}</td>";
            echo "<td style='padding:8px'>{$row['creditLimit']}</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p style='text-align:center; font-family: Arial, sans-serif; color:#555;'>No customer found for customer number $custNum</p>";
    }
}
?>
