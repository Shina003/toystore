<?php
    // Include the database connection script
    require 'includes/database-connection.php';

    // Retrieve the value of the 'toynum' parameter from the URL query string
    $toy_id = $_GET['toynum'];

    /*
     * Define a function that retrieves ALL toy and manufacturer info from the database based on the toynum parameter from the URL query string.
     */
    function get_toy_and_manufacturer(PDO $pdo, string $toynum) {
        // SQL query to retrieve toy and manufacturer information
        $sql = "
            SELECT 
                toy.name AS toy_name, toy.description, toy.price, toy.agerange AS age_range, toy.numinstock AS stock, toy.imgSrc,
                manuf.name AS manufacturer_name, 
                CONCAT(manuf.Street, ', ', manuf.City, ', ', manuf.State, ' ', manuf.ZipCode) AS address,
                manuf.phone, manuf.contact
            FROM toy
            JOIN manuf ON toy.manid = manuf.manid
            WHERE toy.toynum = :toynum
        ";

        // Prepare and execute the query
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['toynum' => $toynum]);

        // Fetch the result as an associative array
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Retrieve toy and manufacturer info based on the 'toynum' parameter
    $toy_info = get_toy_and_manufacturer($pdo, $toy_id);

    // If no toy is found, redirect to an error page or display a message
    if (!$toy_info) {
        die("Toy not found.");
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
            <div class="toy-details-container">
                <div class="toy-image">
                    <!-- Display image of toy with its name as alt text -->
                    <img src="<?= $toy_info['imgSrc'] ?>" alt="<?= $toy_info['toy_name'] ?>">
                </div>
                <div class="toy-details">
                    <!-- Display name of toy -->
                    <h1><?= $toy_info['toy_name'] ?></h1>
                    <hr />
                    <h3>Toy Information</h3>
                    <!-- Display description of toy -->
                    <p><strong>Description:</strong> <?= $toy_info['description'] ?></p>
                    <!-- Display price of toy -->
                    <p><strong>Price:</strong> $<?= $toy_info['price'] ?></p>
                    <!-- Display age range of toy -->
                    <p><strong>Age Range:</strong> <?= $toy_info['age_range'] ?></p>
                    <!-- Display stock of toy -->
                    <p><strong>Number In Stock:</strong> <?= $toy_info['stock'] ?></p>
                    <br />
                    <h3>Manufacturer Information</h3>
                    <!-- Display name of manufacturer -->
                    <p><strong>Name:</strong> <?= $toy_info['manufacturer_name'] ?></p>
                    <!-- Display address of manufacturer -->
                    <p><strong>Address:</strong> <?= $toy_info['address'] ?></p>
                    <!-- Display phone of manufacturer -->
                    <p><strong>Phone:</strong> <?= $toy_info['phone'] ?></p>
                    <!-- Display contact of manufacturer -->
                    <p><strong>Contact:</strong> <?= $toy_info['contact'] ?></p>
                </div>
            </div>
        </main>
    </body>
</html>