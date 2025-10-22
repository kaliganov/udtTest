<?php
$fileContent = file_get_contents('mock_data.json');
$data = json_decode($fileContent, true);

// Выводим всех пользователей
echo "<h2>Пользователи:</h2>";
foreach ($data['users'] as $user) {
	echo "<p>ID: " . $user['ID'] . ", Имя: " . $user['NAME'] . ", Email: " . $user['EMAIL'] . "</p>";
}

// Выводим все сделки со статусом WON или LOSE
echo "<h2>Сделки со статусом WON или LOSE:</h2>";
foreach ($data['deals'] as $deal) {
	if ($deal['STATUS'] === 'WON' || $deal['STATUS'] === 'LOSE') {
		echo "<p>ID: " . $deal['ID'] . ", Название: " . $deal['TITLE'] . ", Статус: " . $deal['STATUS'] . ", Сумма: " . $deal['AMOUNT'] . "</p>";
	}
}