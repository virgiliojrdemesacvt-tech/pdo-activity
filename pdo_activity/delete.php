<?php
require_once "dbconfig.php";   // bring in the $pdo connection

// Delete one record by its primary key.
// ALWAYS use WHERE, or every row will be deleted!
$stmt = $pdo->prepare("DELETE FROM grocery_items WHERE item_id = :id");
$stmt->execute([':id' => 102]);   // 102 = the Anzac Biscuits added by insert.php

echo $stmt->rowCount() . " record(s) deleted.";
