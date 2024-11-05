// Check if Service Worker and Push Manager are supported
if ('serviceWorker' in navigator && 'PushManager' in window) {
    navigator.serviceWorker.register('../../service-worker.js').then(function(registration) {
        // console.log('Service Worker registered with scope:', registration.scope);

        // Check if the user is already subscribed
        return registration.pushManager.getSubscription().then(function(subscription) {
            // if (subscription === null) {
                // User is not subscribed, show prompt to subscribe after user interaction
                document.getElementById('subscribeButton').addEventListener('click', function() {
                   
                    
                    subscribeUser(registration);
                   
                });
                 document.getElementById('subscribeButton2').addEventListener('click', function() {
                   
                    
                    subscribeUser(registration);
                    // document.getElementById("subscribeModal").style.display = "none";
                  
                });
            // } else {
            //     console.log('User is already subscribed:', subscription);
            // }
        });
    }).catch(function(error) {
        // console.error('Error during service worker registration:', error);
    });
} else {
    console.warn('Push notifications or service workers are not supported in this browser.');
}

// Function to subscribe the user
function subscribeUser(registration) {
    Notification.requestPermission().then(function(permission) {
        if (permission === 'granted') {
            registration.pushManager.subscribe({
                userVisibleOnly: true,
                applicationServerKey: urlBase64ToUint8Array('BDs46EIkl1gFaLqEp0vRoKJZa5ngo-xmUkA1TKqdxUFRQXpTsF35bgWVLfeLE-9EIxbpS4xO4kGM8TNYFyhVzyg')
            }).then(function(subscription) {
                console.log('User is subscribed:', subscription);
                // Send subscription to your server
                saveSubscription(subscription);
            }).catch(function(error) {
                console.error('Failed to subscribe the user:', error);
            });
        } else {
            console.warn('Notification permission denied');
        }
    });
}

// Function to send subscription to the server
function saveSubscription(subscription) {
    fetch('../Assignment/send_notification/save-subscription.php', {
        method: 'POST',
        body: JSON.stringify(subscription),
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(function(response) {
        if (!response.ok) {
            throw new Error('Network response was not ok.');
        }
        return response.json();
    }).then(function(data) {
        console.log('Server response:', data);
    }).catch(function(error) {
        console.error('Failed to send subscription to the server:', error);
    });
}

// Helper function to convert VAPID key
function urlBase64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - base64String.length % 4) % 4);
    const base64 = (base64String + padding)
        .replace(/\-/g, '+')
        .replace(/_/g, '/');
    const rawData = window.atob(base64);
    const outputArray = new Uint8Array(rawData.length);

    for (let i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
}
