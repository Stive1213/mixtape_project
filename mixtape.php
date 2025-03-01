<?php
$host = 'localhost';
$db = 'mixtape_db';
$user = 'root'; // Replace with your MySQL username
$pass = '';     // Replace with your MySQL password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $slug = $_GET['slug'];
    $stmt = $pdo->prepare("SELECT name, urls FROM mixtapes WHERE slug = :slug");
    $stmt->execute(['slug' => $slug]);
    $mixtape = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$mixtape) {
        die("Mixtape not found!");
    }

    $urls = explode(',', $mixtape['urls']);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($mixtape['name']); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($mixtape['name']); ?></h1>
        <div class="radiotape">
            <div class="tape" id="tape">
                <span class="tape-label"><?php echo htmlspecialchars($mixtape['name']); ?></span>
                <div class="reel-left"></div>
                <div class="reel-right"></div>
            </div>
            <div id="track-info">Loading track...</div>
            <div class="progress-bar">
                <div id="progress"></div>
            </div>
            <div class="controls">
                <button id="play-pause" disabled>▶</button>
                <button id="prev" disabled>Previous</button>
                <button id="next" disabled>Next</button>
                <button id="shuffle" disabled>Shuffle</button>
                <button id="repeat" disabled>Repeat</button>
                <input type="range" id="volume" min="0" max="100" value="50" disabled>
            </div>
            <div id="error-message" class="error-message"></div>
        </div>
    </div>
    <script>
        const urls = <?php echo json_encode($urls); ?>;
        let currentIndex = 0;
        let player;
        let nextPlayer;
        const tape = document.getElementById('tape');
        const playPauseBtn = document.getElementById('play-pause');
        const progress = document.getElementById('progress');
        const trackInfo = document.getElementById('track-info');
        const errorMessage = document.getElementById('error-message');
        let isPlaying = false;
        let shuffleMode = false;
        let repeatMode = false;

        console.log('Attempting to load YouTube API...');
        const tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        tag.onerror = () => console.error('Failed to load YouTube API script');
        document.head.appendChild(tag);

        function onYouTubeIframeAPIReady() {
            console.log('YouTube API Loaded');
            initPlayer();
            initNextPlayer();
        }

        function getVideoId(url) {
            const regExp = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/;
            const match = url.match(regExp);
            return match ? match[1] : null;
        }

        function initPlayer() {
            player = new YT.Player('player', {
                height: '0',
                width: '0',
                videoId: getVideoId(urls[currentIndex]),
                playerVars: { 'autoplay': 0, 'controls': 0 },
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange,
                    'onError': onPlayerError
                }
            });
        }

        function initNextPlayer() {
            const nextIndex = getNextIndex();
            if (nextIndex !== null) {
                nextPlayer = new YT.Player('next-player', {
                    height: '0',
                    width: '0',
                    videoId: getVideoId(urls[nextIndex]),
                    playerVars: { 'autoplay': 0, 'controls': 0 }
                });
            }
        }

        function onPlayerReady(event) {
            console.log('Player Initialized');
            ['play-pause', 'prev', 'next', 'shuffle', 'repeat', 'volume'].forEach(id => {
                document.getElementById(id).disabled = false;
            });

            playPauseBtn.addEventListener('click', togglePlayPause);
            document.getElementById('prev').addEventListener('click', prevTrack);
            document.getElementById('next').addEventListener('click', nextTrack);
            document.getElementById('shuffle').addEventListener('click', () => {
                shuffleMode = !shuffleMode;
                this.textContent = shuffleMode ? 'Shuffle On' : 'Shuffle';
            });
            document.getElementById('repeat').addEventListener('click', () => {
                repeatMode = !repeatMode;
                this.textContent = repeatMode ? 'Repeat On' : 'Repeat';
            });
            document.getElementById('volume').addEventListener('input', (e) => player.setVolume(e.target.value));

            player.setVolume(50);
            fetchTrackTitle(urls[currentIndex]);
            updateProgress();
        }

        function togglePlayPause() {
            if (isPlaying) {
                player.pauseVideo();
                playPauseBtn.textContent = '▶';
                isPlaying = false;
            } else {
                player.playVideo();
                playPauseBtn.textContent = '❚❚';
                isPlaying = true;
            }
        }

        function onPlayerStateChange(event) {
            if (event.data === YT.PlayerState.PLAYING) {
                tape.classList.add('playing');
                playPauseBtn.textContent = '❚❚';
                isPlaying = true;
            } else if (event.data === YT.PlayerState.PAUSED || event.data === YT.PlayerState.ENDED) {
                tape.classList.remove('playing');
                playPauseBtn.textContent = '▶';
                isPlaying = false;
            }
            if (event.data === YT.PlayerState.ENDED) {
                nextTrack();
            }
        }

        function onPlayerError(event) {
            errorMessage.textContent = `Track ${currentIndex + 1} failed to play. Skipping...`;
            setTimeout(() => errorMessage.textContent = '', 3000);
            nextTrack();
        }

        function getNextIndex() {
            if (shuffleMode) {
                let newIndex = Math.floor(Math.random() * urls.length);
                return newIndex !== currentIndex ? newIndex : (newIndex + 1) % urls.length;
            }
            return currentIndex < urls.length - 1 ? currentIndex + 1 : (repeatMode ? 0 : null);
        }

        function nextTrack() {
            const nextIndex = getNextIndex();
            if (nextIndex !== null) {
                currentIndex = nextIndex;
                player.loadVideoById(getVideoId(urls[currentIndex]));
                if (nextPlayer) nextPlayer.destroy();
                initNextPlayer();
                fetchTrackTitle(urls[currentIndex]);
            }
        }

        function prevTrack() {
            if (currentIndex > 0) {
                currentIndex--;
                player.loadVideoById(getVideoId(urls[currentIndex]));
                if (nextPlayer) nextPlayer.destroy();
                initNextPlayer();
                fetchTrackTitle(urls[currentIndex]);
            }
        }

        function fetchTrackTitle(url) {
            const videoId = getVideoId(url);
            fetch(`https://www.googleapis.com/youtube/v3/videos?part=snippet&id=${videoId}&key=AIzaSyBz030k_GkQWFgJaKQC5muFBzMvWUz2IuU`)
                .then(response => response.json())
                .then(data => {
                    trackInfo.textContent = data.items[0]?.snippet.title || 'Unknown Track';
                })
                .catch(() => trackInfo.textContent = 'Unknown Track');
        }

        function updateProgress() {
            setInterval(() => {
                if (isPlaying) {
                    const current = player.getCurrentTime();
                    const duration = player.getDuration();
                    progress.style.width = `${(current / duration) * 100}%`;
                }
            }, 1000);
        }

        setTimeout(() => {
            if (!window.YT || !player) alert('Failed to load YouTube player.');
        }, 10000);
    </script>
    <div id="player" style="display: none;"></div>
    <div id="next-player" style="display: none;"></div>
</body>
</html>