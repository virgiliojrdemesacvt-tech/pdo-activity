<?php
// dbconfig.php - database connection file using PDO
// Every other file includes this one with require_once.

$host     = "localhost";      // XAMPP runs MySQL on this machine
$dbname   = "grocery_db";     // database created by grocery_australia.sql
$username = "root";           // default XAMPP user
$password = "";               // default XAMPP password is empty
$charset  = "utf8mb4";        // supports all characters

// DSN = Data Source Name (tells PDO which driver and database to use)
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

// PDO options
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,  // throw exceptions on SQL errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,        // rows come back as associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false,                   // use real prepared statements
];

try {
    // Create the connection object ($pdo) used by the other files
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    // Stop the script and show the error if connection fails
    die("Connection failed: " . $e->getMessage());
}
