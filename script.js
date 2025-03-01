function addUrlField() {
    const urlList = document.getElementById('url-list');
    const div = document.createElement('div');
    div.className = 'url-entry';
    div.innerHTML = `
        <input type="url" name="urls[]" placeholder="https://www.youtube.com/watch?v=..." required>
        <button type="button" class="test-btn" onclick="testUrl(this)">Test</button><br>
    `;
    urlList.appendChild(div);
}

let previewPlayer;
function testUrl(button) {
    const input = button.previousElementSibling;
    const url = input.value;
    const videoId = getVideoId(url);
    if (!videoId) {
        alert('Invalid YouTube URL');
        return;
    }
    if (previewPlayer) previewPlayer.destroy();
    document.getElementById('preview-player').innerHTML = '';
    previewPlayer = new YT.Player('preview-player', {
        height: '0',
        width: '0',
        videoId: videoId,
        events: {
            'onReady': (event) => event.target.playVideo()
        }
    });
}

function getVideoId(url) {
    const regExp = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/;
    const match = url.match(regExp);
    return match ? match[1] : null;
}

document.getElementById('mixtape-form').addEventListener('submit', (e) => {
    const inputs = document.querySelectorAll('input[name="urls[]"]');
    for (let input of inputs) {
        if (!getVideoId(input.value)) {
            e.preventDefault();
            alert('All URLs must be valid YouTube links.');
            return;
        }
    }
});