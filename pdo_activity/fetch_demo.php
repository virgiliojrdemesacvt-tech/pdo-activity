<?php
require_once "dbconfig.php";   // bring in the $pdo connection

// Prepare a query that should return ONE row (look up by primary key)
$stmt = $pdo->prepare("SELECT * FROM grocery_items WHERE item_id = :id");
$stmt->execute([':id' => 22]);          // item 22 = Vegemite

// fetch() returns only the NEXT row (a single associative array)
// It returns false if no row was found
$item = $stmt->fetch();

echo "<h2>fetch() Demo - Single item</h2>";
echo "<pre>";
print_r($item);
echo "</pre>";
