<?php
// order-service/index.php
$pdo = new PDO('sqlite:orders.db');

// Initialize database
$pdo->exec("CREATE TABLE IF NOT EXISTS orders (id INTEGER PRIMARY KEY, clientName TEXT, productName TEXT, quantity INTEGER)");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $pdo->query("SELECT * FROM orders");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $stmt = $pdo->prepare("INSERT INTO orders (clientName, productName, quantity) VALUES (?, ?, ?)");
    $stmt->execute([$data['clientName'], $data['productName'], $data['quantity']]);
    echo json_encode(['id' => $pdo->lastInsertId(), 'clientName' => $data['clientName'], 'productName' => $data['productName'], 'quantity' => $data['quantity']]);
}
?>
