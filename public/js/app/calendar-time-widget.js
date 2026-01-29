let isLocationSet = false;
function updateTime() {
    const liveTimeElement = document.getElementById('live-time');
    if (liveTimeElement) {
        const now = new Date();
        const timeString = now.toLocaleTimeString('en-US', { hour12: false });
        liveTimeElement.textContent = timeString + " WIB";
    }
}
function locationTag() {
    if (!document.getElementById('location') && !document.getElementById('lokasi')) return;
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function (position) {
                let latitude = position.coords.latitude;
                let longitude = position.coords.longitude;

                // Convert coordinates to a readable location using a service
                fetch(`https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${latitude}&longitude=${longitude}&localityLanguage=en`)
                    .then(response => response.json())
                    .then(data => {
                        let location = data.city || data.locality || data.principalSubdivision || 'Location unavailable';
                        let locEl = document.getElementById('location');
                        if (locEl) locEl.textContent = location;
                        isLocationSet = true;
                    })
                    .catch(error => {
                        console.error('Error fetching location:', error);
                        let locEl = document.getElementById('location');
                        if (locEl) locEl.textContent = 'Location unavailable';
                        isLocationSet = true;
                    });

            },
            function (error) {
                console.error('Geolocation error:', error);
                let lokEl = document.getElementById('lokasi');
                if (lokEl) lokEl.textContent = 'Location permission denied';
            }
        );
    } else {
        let lokEl = document.getElementById('lokasi');
        if (lokEl) lokEl.innerText = 'Geolocation not supported';
    }
}
function main() {
    updateTime();
    if (!isLocationSet) locationTag();
}
window.addEventListener('load', function () {
    setInterval(main, 1000); // Update every second
});
