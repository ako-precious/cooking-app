


//     event.waitUntil(
//         clients.matchAll({ type: 'window', includeUncontrolled: true }).then(clientList => {
//             for (let i = 0; i < clientList.length; i++) {
//                 let client = clientList[i];
//                 if (client.url === event.notification.data.url && 'focus' in client) {
//                     return client.focus();
//                 }
//             }
//             if (clients.openWindow) {
//                 return clients.openWindow(event.notification.data.url);
//             }
//         })
//     );
// });

// self.addEventListener("push", (event) => {
//     let notificationData = {};

//     if (event.data) {
//         notificationData = event.data.json();
//     } else {
//         notificationData = {
//             title: "Default Title",
//             body: "You have a new notification.",
//             icon: "./images/logo2.png",
//             data: {
//                 url: "/"
//             }
//         };
//     }

//     const options = {
//         body: notificationData.body,
//         icon: notificationData.icon,
//         data: {
//             url: notificationData.data.url || "/"
//         },
//         vibrate: [200, 100, 200], // Add vibration pattern for mobile
//     };

//     event.waitUntil(
//         self.registration.showNotification(notificationData.title, options)
//     );
// });

// self.addEventListener("notificationclick", (event) => {
//     event.notification.close(); // Close the notification

//     event.waitUntil(
//         clients.matchAll({ type: 'window', includeUncontrolled: true }).then(clientList => {
//             for (let i = 0; i < clientList.length; i++) {
//                 let client = clientList[i];
//                 if (client.url === event.notification.data.url && 'focus' in client) {
//                     return client.focus();
//                 }
//             }
//             if (clients.openWindow) {
//                 return clients.openWindow(event.notification.data.url);
//             }
//         })
//     );
// });


