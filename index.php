<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Lookup</title>
    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        h1 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        form {
            display: flex;
            gap: 12px;
            margin-bottom: 30px;
        }

        input[type="text"] {
            flex: 1;
            padding: 12px;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        button {
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            background: #2563eb;
            color: white;
        }

        button:hover {
            background: #1e4ed8;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 14px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        th {
            background: #f1f5f9;
            font-weight: 600;
        }

        .empty {
            color: #6b7280;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Search Order</h1>

    <form method="post">
        <input type="text" name="orderNum" placeholder="Enter order number" required>
        <button type="submit">Search</button>
    </form>

    <?php
    require "App/config/Database.php";
    $db = new Database;
    $conn = $db->connect();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $orderNum = $_POST["orderNum"];

        $sql = "SELECT * FROM classicmodels.orders WHERE orderNumber = $orderNum";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            echo "<table>";
            echo "<tr>
                    <th>Order #</th>
                    <th>Order Date</th>
                    <th>Required Date</th>
                    <th>Shipped Date</th>
                    <th>Status</th>
                    <th>Customer #</th>
                  </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['orderNumber']}</td>
                        <td>{$row['orderDate']}</td>
                        <td>{$row['requiredDate']}</td>
                        <td>{$row['shippedDate']}</td>
                        <td>{$row['status']}</td>
                        <td>{$row['customerNumber']}</td>
                      </tr>";
            }

            echo "</table>";
        } else {
            echo "<p class='empty'>No order found.</p>";
        }
    }
    ?>
</div>

</body>
</html>
