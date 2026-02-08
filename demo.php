<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Order & Customer Lookup</title>

<style>
    :root {
        --bg: #f5f7fb;
        --card: #ffffff;
        --text: #1f2937;
        --muted: #6b7280;
        --accent: #111827;
        --border: #e5e7eb;
    }

    body {
        margin: 0;
        font-family: Inter, system-ui, sans-serif;
        background: var(--bg);
        color: var(--text);
        padding: 50px 0;
    }

    .container {
        width: 1100px;
        margin: auto;
    }

    .card {
        background: var(--card);
        border-radius: 14px;
        padding: 30px;
        margin-bottom: 40px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
    }

    h1 {
        margin: 0 0 20px;
        font-size: 26px;
    }

    form {
        display: flex;
        gap: 14px;
        margin-bottom: 25px;
    }

    input {
        flex: 1;
        padding: 14px;
        font-size: 15px;
        border-radius: 10px;
        border: 1px solid var(--border);
    }

    button {
        padding: 14px 22px;
        font-size: 15px;
        border-radius: 10px;
        border: none;
        background: var(--accent);
        color: white;
        cursor: pointer;
    }

    button:hover {
        opacity: 0.9;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    th, td {
        padding: 14px;
        border-bottom: 1px solid var(--border);
        text-align: left;
    }

    th {
        background: #f9fafb;
        font-weight: 600;
    }

    .empty {
        color: var(--muted);
        text-align: center;
        margin-top: 20px;
    }
</style>
</head>
<body>
<?php
require "App/config/Database.php";
$db = new Database();
$conn = $db->connect();
?>

<div class="container">

    <!-- ORDER SEARCH -->
    <div class="card">
        <h1>Order Lookup</h1>

        <form method="post">
            <input type="number" name="orderNum" placeholder="Enter order number" required>
            <button type="submit">Search</button>
        </form>

        <?php
        if (!empty($_POST['orderNum'])) {
            $stmt = $conn->prepare(
                "SELECT orderNumber, orderDate, requiredDate, shippedDate, status, customerNumber 
                 FROM classicmodels.orders 
                 WHERE orderNumber = ?"
            );
            $stmt->bind_param("i", $_POST['orderNum']);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<table>
                        <tr>
                            <th>Order #</th>
                            <th>Order Date</th>
                            <th>Required</th>
                            <th>Shipped</th>
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

    <!-- CUSTOMER SEARCH -->
    <div class="card">
        <h1>Customer Lookup</h1>

        <form method="post">
            <input type="number" name="custNum" placeholder="Enter customer number" required>
            <button type="submit">Search</button>
        </form>

        <?php
        if (!empty($_POST['custNum'])) {
            $stmt = $conn->prepare(
                "SELECT customerNumber, customerName, phone, city, country, creditLimit
                 FROM classicmodels.customers
                 WHERE customerNumber = ?"
            );
            $stmt->bind_param("i", $_POST['custNum']);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<table>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>City</th>
                            <th>Country</th>
                            <th>Credit Limit</th>
                        </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['customerNumber']}</td>
                            <td>{$row['customerName']}</td>
                            <td>{$row['phone']}</td>
                            <td>{$row['city']}</td>
                            <td>{$row['country']}</td>
                            <td>{$row['creditLimit']}</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "<p class='empty'>No customer found.</p>";
            }
        }
        ?>
    </div>

</div>

</body>
</html>
