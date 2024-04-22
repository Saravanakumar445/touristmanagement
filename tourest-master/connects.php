<?php
// Database connection settings
$host = "localhost"; // Change this to your database host
$dbname = "your_database_name"; // Change this to your database name
$username = "your_username"; // Change this to your database username
$password = "your_password"; // Change this to your database password

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create a table to store email addresses if it doesn't exist
    $createTableSql = "CREATE TABLE IF NOT EXISTS emails (
                        id INT(11) AUTO_INCREMENT PRIMARY KEY,
                        email VARCHAR(255) NOT NULL UNIQUE
                    )";
    $pdo->exec($createTableSql);
    
    // Email addresses to insert into the database
    $emailAddresses = ["email1@example.com", "email2@example.com", "email3@example.com"];
    
    // Insert email addresses into the database
    $insertEmailSql = "INSERT INTO emails (email) VALUES (:email)";
    $stmt = $pdo->prepare($insertEmailSql);
    foreach ($emailAddresses as $email) {
        $stmt->execute(['email' => $email]);
    }
    
    // Display a success message if connected and email addresses are inserted
    echo "Email addresses inserted successfully";
} catch(PDOException $e) {
    // Display an error message if connection or insertion fails
    echo "Error: " . $e->getMessage();
}
?>
