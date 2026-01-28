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
                        document.getElementById('location').textContent = location;
                        // isLocationSet = true;
                    })
                    .catch(error => {
                        console.error('Error fetching location:', error);
                        document.getElementById('location').textContent = 'Location unavailable';

                        // isLocationSet = true;
                    });

            },
            function (error) {
                console.error('Geolocation error:', error);
                document.getElementById('lokasi').textContent = 'Location permission denied';
            }
        );
    } else {
        document.getElementById('lokasi').innerText = 'Geolocation not supported';
    }
}
function main() {
    updateTime();
    if (!isLocationSet) locationTag();
}
window.onload = function () {
    setInterval(main, 1000); // Update every second
}
