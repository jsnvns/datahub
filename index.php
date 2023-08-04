<?php
// Подключение к базе данных (замените значения на свои)
$servername = "server12.hosting.reg.ru";
$username = "u2176038_shortur";
$password = "#eXposure812!";
$dbname = "u2176038_shorturls";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Если пользователь отправил форму с URL для сокращения
if (isset($_POST['original_url'])) {
    $originalURL = $_POST['original_url'];

    // Генерируем случайный код для сокращения ссылки
    $shortCode = generateRandomString();

    // Вставляем данные в базу данных
    $sql = "INSERT INTO short_links (short_code) VALUES ('$shortCode')";
    $conn->query($sql);

    $shortenedURL = "http://your_domain.com/$shortCode"; // Замените на свой домен
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Сокращение ссылок</title>
</head>
<body>
    <h1>Сокращение ссылок</h1>
    <form method="post">
        <label for="original_url">Введите URL для сокращения:</label>
        <input type="text" name="original_url" id="original_url" required>
        <button type="submit">Сократить</button>
    </form>

    <?php
    if (isset($shortenedURL)) {
        echo "<p>Сокращенная ссылка: <a href='$shortenedURL'>$shortenedURL</a></p>";
    }
    ?>

</body>
</html>

<?php
// Функция для генерации случайной строки
function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>
