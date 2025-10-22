<?php

$dsn = 'mysql:host=localhost;dbname=;charset=utf8';
$username = '';
$password = '';

try {
	$pdo = new PDO($dsn, $username, $password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	die('Ошибка подключения к базе данных: ' . $e->getMessage());
}

$file = fopen('product.csv', 'r');
fgets($file);

$data = [];
while (($row = fgetcsv($file, 0, ';')) !== false) {
	$data[] = [
		'name' => $row[0],
		'art' => $row[1],
		'price' => $row[2],
		'quantity' => $row[3]
	];
}
fclose($file);

$added_count = 0;
$updated_count = 0;

foreach ($data as $item) {
	$select_stmt = $pdo->prepare("SELECT name, art FROM product WHERE name = :name AND art = :art");
	$select_stmt->execute(['name' => $item['name'], 'art' => $item['art']]);
	$answer = $select_stmt->fetch(PDO::FETCH_ASSOC);

	if ($answer) {
		$update_stmt = $pdo->prepare("
			UPDATE product 
			SET price = :price, quantity = :quantity 
			WHERE name = :name AND art = :art
		");
		$update_stmt->execute([
			'price' => $item['price'],
			'quantity' => $item['quantity'],
			'name' => $item['name'],
			'art' => $item['art']
		]);
		$updated_count++;
	} else {
		$insert_stmt = $pdo->prepare("
			INSERT INTO product (name, art, price, quantity) 
			VALUES (:name, :art, :price, :quantity)
		");
		$insert_stmt->execute([
			'name' => $item['name'],
			'art' => $item['art'],
			'price' => $item['price'],
			'quantity' => $item['quantity']
		]);
		$added_count++;
	}
}

echo "Добавлено: $added_count, обновлено: $updated_count";

$pdo = null;
