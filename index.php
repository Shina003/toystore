<?php   										// Opening PHP tag
	
	// Include the database connection script
	require 'includes/database-connection.php';

	/*
	 * Retrieve toy information from the database based on the toy ID.
	 * 
	 * @param PDO $pdo       An instance of the PDO class.
	 * @param string $id     The ID of the toy to retrieve.
	 * @return array|null    An associative array containing the toy information, or null if no toy is found.
	 */
	function get_toy(PDO $pdo, string $id) {

		// SQL query to retrieve toy information based on the toy ID
		$sql = "SELECT * 
			FROM toy
			WHERE toynum= :id;";	// :id is a placeholder for value provided later 
		                               // It's a parameterized query that helps prevent SQL injection attacks and ensures safer interaction with the database.


		// Execute the SQL query using the pdo function and fetch the result
		$toy = pdo($pdo, $sql, ['id' => $id])->fetch();		// Associative array where 'id' is the key and $id is the value. Used to bind the value of $id to the placeholder :id in  SQL query.

		// Return the toy information (associative array)
		return $toy;
	}
	/*
 * Retrieve all toys from the database.
 * 
 * @param PDO $pdo       An instance of the PDO class.
 * @return array         An array of associative arrays containing toy information.
 */
function get_all_toys(PDO $pdo) {
    // SQL query to retrieve all toys
    $sql = "SELECT * FROM toy";

    // Execute the SQL query and fetch all results
    $toys = pdo($pdo, $sql)->fetchAll();

    // Return the array of toys
    return $toys;
}

	// Retrieve info about toy with ID '0001' from the db using provided PDO connection
	$toy1 = get_toy($pdo, '0001');
	

	/*
	 * TO-DO: Retrieve info for ALL remaining toys from the db
	 */
	$all_toys = get_all_toys($pdo);
?>


<!DOCTYPE>
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
        <section class="toy-catalog">

            <div class="toy-card">
                <!-- Create a hyperlink to toy.php page with toy number as parameter -->
                <a href="toy.php?toynum=<?= $toy1['toynum'] ?>">

                    <!-- Display image of toy with its name as alt text -->
                    <img src="<?= $toy1['imgSrc'] ?>" alt="<?= $toy1['name'] ?>">
                </a>

                <!-- Display name of toy -->
                <h2><?= $toy1['name'] ?></h2>

                <!-- Display price of toy -->
                <p>$<?= $toy1['price'] ?></p>
            </div>


            <!-- 
				  -- TO DO: Fill in the rest of the cards for ALL remaining toys from the db
  				  -->
            <?php foreach ($all_toys as $toy): ?>
            <div class="toy-card">
                <a href="toy.php?toynum=<?= $toy['toynum'] ?>">
                    <img src="<?= $toy['imgSrc'] ?>" alt="<?= $toy['name'] ?>">
                </a>
                <h2><?= $toy['name'] ?></h2>
                <p>$<?= $toy['price'] ?></p>
            </div>
            <?php endforeach; ?>

            <div class="toy-card">
                <a href="toy.php?toynum=<?= '' ?>">
                    <img src="<?= '' ?>" alt="<?= '' ?>">
                </a>
                <h2><?= '' ?></h2>
                <p>$<?= '' ?></p>
            </div>

            <div class="toy-card">
                <a href="toy.php?toynum=<?= '' ?>">
                    <img src="<?= '' ?>" alt="<?= '' ?>">
                </a>
                <h2><?= '' ?></h2>
                <p>$<?= '' ?></p>
            </div>

            <div class="toy-card">
                <a href="toy.php?toynum=<?= '' ?>">
                    <img src="<?= '' ?>" alt="<?= '' ?>">
                </a>
                <h2><?= '' ?></h2>
                <p>$<?= '' ?></p>
            </div>

            <div class="toy-card">
                <a href="toy.php?toynum=<?= '' ?>">
                    <img src="<?= '' ?>" alt="<?= '' ?>">
                </a>
                <h2><?= '' ?></h2>
                <p>$<?= '' ?></p>
            </div>

            <div class="toy-card">
                <a href="toy.php?toynum=<?= '' ?>">
                    <img src="<?= '' ?>" alt="<?= '' ?>">
                </a>
                <h2><?= '' ?></h2>
                <p>$<?= '' ?></p>
            </div>

            <div class="toy-card">
                <a href="toy.php?toynum=<?= '' ?>">
                    <img src="<?= '' ?>" alt="<?= '' ?>">
                </a>
                <h2><?= '' ?></h2>
                <p>$<?= '' ?></p>
            </div>

            <div class="toy-card">
                <a href="toy.php?toynum=<?= '' ?>">
                    <img src="<?= '' ?>" alt="<?= '' ?>">
                </a>
                <h2><?= '' ?></h2>
                <p>$<?= '' ?></p>
            </div>

            <div class="toy-card">
                <a href="toy.php?toynum=<?= '' ?>">
                    <img src="<?= '' ?>" alt="<?= '' ?>">
                </a>
                <h2><?= '' ?></h2>
                <p>$<?= '' ?></p>
            </div>

            <div class="toy-card">
                <a href="toy.php?toynum=<?= '' ?>">
                    <img src="<?= '' ?>" alt="<?= '' ?>">
                </a>
                <h2><?= '' ?></h2>
                <p>$<?= '' ?></p>
            </div>

        </section>
    </main>

</body>

</html>