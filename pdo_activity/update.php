<?php
require_once "dbconfig.php";   // bring in the $pdo connection

// Update the price and stock of one item (WHERE keeps it to a single row)
$sql = "UPDATE grocery_items
        SET price_aud = :price, stock_quantity = :stock
        WHERE item_id = :id";
$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':price' => 7.50,   // new price
    ':stock' => 150,    // new stock
    ':id'    => 22,     // item_id of Vegemite
]);

echo $stmt->rowCount() . " record(s) updated.";
