importScripts("https://cdn.pushalert.co/sw-54962.js");


// var staticCacheName = "pwa";
 
// self.addEventListener("install", function (e) {
//   e.waitUntil(
//     caches.open(staticCacheName).then(function (cache) {
//       return cache.addAll(["/"]);
//     })
//   );
// });
 
// self.addEventListener("fetch", function (event) {
//   console.log(event.request.url);
 
//   event.respondWith(
//     caches.match(event.request).then(function (response) {
//       return response || fetch(event.request);
//     })
//   );
// });


const cacheName = "HOHCPCache-v1";
const appShellFiles = [
  "index.php",
  "index.html",
  "css/style.css",
  "homescreen.php",
];

self.addEventListener("install", (e) => {
  console.log("[Service Worker] Install");
  e.waitUntil(
    (async () => {
      const cache = await caches.open(cacheName);
      console.log("[Service Worker] Caching all: app shell and content");
      //await cache.addAll(contentToCache);
    })()
  );
});

self.addEventListener("fetch", (e) => {
  e.respondWith(
    (async () => {
      if(true || e.request.url.indexOf('https://test.houseofhiranandani-prioritycircle.in/' > -1)){
        const r = await caches.match(e.request);
        console.log(`[Service Worker] Fetching resource: ${e.request.url}`);
        if (r) {
          console.log('returing from cache');
          return r;
        }
        const response = await fetch(e.request);
        const cache = await caches.open(cacheName);
        console.log(`[Service Worker] Caching new resource: ${e.request.url}`);
        cache.put(e.request, response.clone());
        return response;
      }
      
    })()
  );
});