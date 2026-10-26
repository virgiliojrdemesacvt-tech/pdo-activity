<?php
require_once "dbconfig.php";   // bring in the $pdo connection

// Prepared statement with named placeholders protects against SQL injection
$sql = "INSERT INTO grocery_items (item_name, brand_name, category, package_size, price_aud, stock_quantity)
        VALUES (:item_name, :brand_name, :category, :package_size, :price_aud, :stock_quantity)";
$stmt = $pdo->prepare($sql);

// Run the statement with the values for the new record
$stmt->execute([
    ':item_name'      => 'Anzac Biscuits',
    ':brand_name'     => 'Arnott\'s',
    ':category'       => 'Biscuits & Snacks',
    ':package_size'   => '250g',
    ':price_aud'      => 3.60,
    ':stock_quantity' => 50,
]);

// rowCount() = number of rows affected, lastInsertId() = auto-increment id of the new row
echo "Inserted " . $stmt->rowCount() . " record. New item_id: " . $pdo->lastInsertId();
