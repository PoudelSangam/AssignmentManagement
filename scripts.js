

let deferredPrompt;

window.addEventListener('beforeinstallprompt', (e) => {
  e.preventDefault();
  deferredPrompt = e;
  showInstallModal();
});

function showInstallModal() {
  const installModal = document.getElementById('installModal');
  installModal.classList.remove('hidden');

  document.getElementById('installAppButton').addEventListener('click', () => {
    installModal.classList.add('hidden');
    deferredPrompt.prompt();
    deferredPrompt.userChoice.then((choiceResult) => {
      if (choiceResult.outcome === 'accepted') {
        console.log('User accepted the install prompt');
      } else {
        console.log('User dismissed the install prompt');
      }
      deferredPrompt = null;
    });
  });

  document.getElementById('closeModalButton').addEventListener('click', () => {
    installModal.classList.add('hidden');
  });
}

function urlBase64ToUint8Array(base64String) {
  const padding = '='.repeat((4 - base64String.length % 4) % 4);
  const base64 = (base64String + padding).replace(/-/g, '+').replace(/_/g, '/');
  const rawData = window.atob(base64);
  const outputArray = new Uint8Array(rawData.length);
  for (let i = 0; i < rawData.length; ++i) {
    outputArray[i] = rawData.charCodeAt(i);
  }
  return outputArray;
}


        
        
        
        
        
        
        
        
        
        
        
  function updateOnlineStatus() {
  const statusElement = document.getElementById('status');

  if (navigator.onLine) {
    // If online, hide the offline message and fetch data
    // statusElement.textContent = "You are online";
    // statusElement.style.color = "green";
    // dataElement.style.display = "block";
   
  } else {
    // If offline, show the offline message and hide the data
    statusElement.textContent = "You are offline";
    statusElement.style.color = "red";
    dataElement.style.display = "none";
  }
}

// Listen for the online and offline events
window.addEventListener('online', updateOnlineStatus);
window.addEventListener('offline', updateOnlineStatus);

// Initial check for online status when the page loads
window.addEventListener('load', updateOnlineStatus);

if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/service-worker.js')
            .then(registration => {
                console.log('ServiceWorker registration successful with scope: ', registration.scope);
            })
            .catch(error => {
                console.log('ServiceWorker registration failed: ', error);
            });
    });
}

