<?php
$db = new mysqli('localhost', 'user', 'pass', 'db');
if (!$db) { die('Ошибка'); }
$result = $db->query("SELECT * FROM product");
while ($row = $result->fetch_assoc()) {
    echo $row['name'];
}