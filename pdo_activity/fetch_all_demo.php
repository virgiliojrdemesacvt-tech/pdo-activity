<?php
require_once "dbconfig.php";   // bring in the $pdo connection

// Prepare and run a query that returns many rows
$stmt = $pdo->prepare("SELECT item_id, item_name, brand_name, price_aud FROM grocery_items WHERE category = :category");
$stmt->execute([':category' => 'Dairy']);

// fetchAll() returns ALL rows at once as an array of arrays
$items = $stmt->fetchAll();

echo "<h2>fetchAll() Demo - Dairy items</h2>";
echo "<pre>";
print_r($items);     // print_r inside <pre> keeps the formatting readable
echo "</pre>";
