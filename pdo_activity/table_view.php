<?php
require_once "dbconfig.php";   // bring in the $pdo connection

// COMPLEX QUERY: shows items priced above their own category's average.
// - Derived table (subquery) computes the average price and item count per category
// - JOIN links each item to its category stats
// - WHERE filters items above average, HAVING in the subquery ignores tiny categories
// - ORDER BY shows the biggest price gaps first
$sql = "SELECT g.item_id, g.item_name, g.brand_name, g.category, g.package_size,
               g.price_aud, c.avg_price,
               ROUND(g.price_aud - c.avg_price, 2) AS above_average
        FROM grocery_items g
        JOIN (SELECT category, AVG(price_aud) AS avg_price, COUNT(*) AS total_items
              FROM grocery_items
              GROUP BY category
              HAVING COUNT(*) >= 5) c ON g.category = c.category
        WHERE g.price_aud > c.avg_price
        ORDER BY above_average DESC
        LIMIT 20";

$rows = $pdo->query($sql)->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Above-Average Priced Grocery Items</title>
  <style>
    table { border-collapse: collapse; width: 100%; font-family: Arial, sans-serif; }
    th, td { border: 1px solid #999; padding: 6px 10px; text-align: left; }
    th { background: #2e7d32; color: #fff; }
    tr:nth-child(even) { background: #f2f2f2; }
  </style>
</head>
<body>
  <h2>Australian Grocery Items Priced Above Their Category Average</h2>
  <table>
    <tr>
      <th>ID</th><th>Item</th><th>Brand</th><th>Category</th>
      <th>Size</th><th>Price (AUD)</th><th>Category Avg</th><th>Above Avg</th>
    </tr>
    <?php foreach ($rows as $row): ?>
    <!-- One table row per record; htmlspecialchars prevents HTML injection -->
    <tr>
      <td><?= htmlspecialchars($row['item_id']) ?></td>
      <td><?= htmlspecialchars($row['item_name']) ?></td>
      <td><?= htmlspecialchars($row['brand_name']) ?></td>
      <td><?= htmlspecialchars($row['category']) ?></td>
      <td><?= htmlspecialchars($row['package_size']) ?></td>
      <td>$<?= number_format($row['price_aud'], 2) ?></td>
      <td>$<?= number_format($row['avg_price'], 2) ?></td>
      <td>+$<?= number_format($row['above_average'], 2) ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>
