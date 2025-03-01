<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Mixtape</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Create Your Mixtape</h1>
        <form action="save_mixtape.php" method="POST" id="mixtape-form">
            <label for="name">Mixtape Name:</label>
            <input type="text" id="name" name="name" placeholder="e.g., Chill Vibes" required><br><br>

            <label>YouTube URLs:</label><br>
            <div id="url-list">
                <div class="url-entry">
                    <input type="url" name="urls[]" placeholder="https://www.youtube.com/watch?v=..." required>
                    <button type="button" class="test-btn" onclick="testUrl(this)">Test</button><br>
                </div>
            </div>
            <button type="button" onclick="addUrlField()">Add Another URL</button><br><br>

            <input type="submit" value="Save Mixtape">
        </form>
        <div id="preview-player" style="display: none;"></div>
    </div>
    <script src="script.js"></script>
    <script src="https://www.youtube.com/iframe_api"></script>
</body>
</html>