<?php
$host = 'localhost';
$db = 'mixtape_db';
$user = 'root'; // Replace with your MySQL username
$pass = '';     // Replace with your MySQL password

function generateSlug($name) {
    $slug = strtolower(preg_replace('/[^a-z0-9]+/', '-', trim($name)));
    return substr($slug, 0, 50);
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $urls = implode(',', $_POST['urls']);
        $slug = generateSlug($name);
        $suffix = '';
        $counter = 1;
        while ($pdo->query("SELECT COUNT(*) FROM mixtapes WHERE slug = '$slug$suffix'")->fetchColumn()) {
            $suffix = "-$counter";
            $counter++;
        }
        $slug .= $suffix;

        $stmt = $pdo->prepare("INSERT INTO mixtapes (name, slug, urls) VALUES (:name, :slug, :urls)");
        $stmt->execute(['name' => $name, 'slug' => $slug, 'urls' => $urls]);

        $shareUrl = "http://localhost/mixtape_project/mixtape.php?slug=$slug"; // Update domain
        $embedCode = "<iframe src='$shareUrl' width='800' height='400' frameborder='0' allowfullscreen></iframe>";
        echo "<div class='container'><div class='save-message'>Mixtape saved!<br>Share this URL: <a href='$shareUrl'>$shareUrl</a><br>Embed code: <textarea readonly>$embedCode</textarea></div></div>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>