<?php
class Database
{
	private $pdo;
	private $logFile = 'error.log';

	public function __construct($host, $dbname, $user, $pass)
	{
		$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

		try {
			$this->pdo = new PDO($dsn, $user, $pass);
			// Устанавливаем режим ошибок PDO
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			$this->logError('Connection failed: ' . $e->getMessage());
			die('Ошибка подключения к базе данных.');
		}
	}

	public function query($sql)
	{
		try {
			return $this->pdo->query($sql);
		} catch (PDOException $e) {
			$this->logError('Query error: ' . $e->getMessage());
			return false;
		}
	}

	private function logError($message)
	{
		file_put_contents($this->logFile, date('Y-m-d H:i:s') . ' - ' . $message . PHP_EOL, FILE_APPEND);
	}
}

// Использование класса
$db = new Database('localhost', '', '', '');

$result = $db->query("SELECT * FROM product");
if ($result !== false) {
	while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
		echo $row['name'];
	}
} else {
	echo 'Ошибка при выполнении запроса.';
}

