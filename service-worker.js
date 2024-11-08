self.addEventListener('install', event => {
  event.waitUntil(
    caches.open('users').then(cache => {
      return cache.addAll([
         './Assignment/header.php',
         './img/logo512*512.png',
         './img/logo192*192.png',
         './img/icon.png'
      ]);
    }).catch(error => {
      console.error('Cache failed:', error);
    })
  );
});



self.addEventListener('push', function(event) {
    let data = {};
    if (event.data) {
        data = event.data.json();
    }
    
self.addEventListener('fetch', (event) => {
  event.respondWith(
    caches.match(event.request).then((cachedResponse) => {
      // Serve cached response immediately if available
      if (cachedResponse) {
        // Fetch from the network in the background and update the cache
        event.waitUntil(
          fetch(event.request).then((networkResponse) => {
            caches.open('users').then((cache) => {
              cache.put(event.request, networkResponse.clone());
            });
          })
        );
        return cachedResponse; // Return cached data immediately
      }

      // If no cached response, fetch from the network
      return fetch(event.request).then((networkResponse) => {
        return caches.open('users').then((cache) => {
          cache.put(event.request, networkResponse.clone()); // Update cache
          return networkResponse; // Return network response
        });
      }).catch(() => {
        return caches.match('/fallback'); // Fallback in case of network failure
      });
    })
  );
});



       const options = {
        body: data.body || 'Default body',
        icon: 'img/logo192x192.png',
        badge: 'img/icon.png',
        data: { link: data.link || '/' }, // add link to data object
        actions: data.actions || [],
    };

    event.waitUntil(
        self.registration.showNotification(data.title || 'Default title', options)
    );
});

self.addEventListener('notificationclick', function(event) {
    event.notification.close();
    const link = event.notification.data.link; // access link in data
    event.waitUntil(
        clients.openWindow(link) // open the link
    );
});