<?php
    // Include the database connection script
    require 'includes/database-connection.php';

    /*
     * Define a function that retrieves ALL customer and order info from the database based on values entered into the form.
     */
    function get_order_info(PDO $pdo, string $email, string $orderNum) {
        // SQL query to retrieve customer and order information
        $sql = "
            SELECT 
                customer.cname AS customer_name,
                customer.username,
                orders.ordernum,
                orders.quantity,
                orders.date_ordered,
                orders.date_deliv
            FROM orders
            JOIN customer ON orders.custnum = customer.custnum
            WHERE customer.email = :email AND orders.ordernum = :orderNum
        ";

        // Prepare and execute the query
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email, 'orderNum' => $orderNum]);

        // Fetch the result as an associative array
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Initialize the variable to hold order info
    $order_info = null;

    // Check if the request method is POST (i.e., form submitted)
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the value of the 'email' field from the POST data
        $email = $_POST['email'];

        // Retrieve the value of the 'orderNum' field from the POST data
        $orderNum = $_POST['orderNum'];

        // Retrieve info about the order from the database using the provided PDO connection
        $order_info = get_order_info($pdo, $email, $orderNum);

        // If no order is found, display an error message
        if (!$order_info) {
            echo "<p style='color: red;'>Order not found. Please check your email and order number.</p>";
        }
    }
?> 

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Toys R URI</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    </head>
    <body>
        <header>
            <div class="header-left">
                <div class="logo">
                    <img src="imgs/logo.png" alt="Toy R URI Logo">
                </div>
                <nav>
                    <ul>
                        <li><a href="index.php">Toy Catalog</a></li>
                        <li><a href="about.php">About</a></li>
                    </ul>
                </nav>
            </div>
            <div class="header-right">
                <ul>
                    <li><a href="order.php">Check Order</a></li>
                </ul>
            </div>
        </header>

        <main>
            <div class="order-lookup-container">
                <h1>Order Lookup</h1>
                <form action="order.php" method="POST">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="orderNum">Order Number:</label>
                        <input type="text" id="orderNum" name="orderNum" required>
                    </div>

                    <button type="submit">Lookup Order</button>
                </form>
            </div>

            <?php if (!empty($order_info)): ?>
                <div class="order-details">
                    <h1>Order Details</h1>
                    <p><strong>Name: </strong> <?= htmlspecialchars($order_info['customer_name']) ?></p>
                    <p><strong>Username: </strong> <?= htmlspecialchars($order_info['username']) ?></p>
                    <p><strong>Order Number: </strong> <?= htmlspecialchars($order_info['ordernum']) ?></p>
                    <p><strong>Quantity: </strong> <?= htmlspecialchars($order_info['quantity']) ?></p>
                    <p><strong>Date Ordered: </strong> <?= htmlspecialchars($order_info['date_ordered']) ?></p>
                    <p><strong>Delivery Date: </strong> <?= htmlspecialchars($order_info['date_deliv']) ?></p>
                </div>
            <?php endif; ?>
        </main>
    </body>
</html>