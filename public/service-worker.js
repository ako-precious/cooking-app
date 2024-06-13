self.addEventListener("push", (event) => {
    const notification = event.data.json();
    
    event.waitUntil(
        self.registration.showNotification(notification.title, {
            body: notification.body,
            icon: "./images/logo2.png",
            data: {
                url: notification.data.url
            }
        })
    );
});

self.addEventListener("notificationclick", (event) => {
    event.notification.close(); // Close the notification

    event.waitUntil(
        clients.matchAll({ type: 'window', includeUncontrolled: true }).then(clientList => {
            for (let i = 0; i < clientList.length; i++) {
                let client = clientList[i];
                if (client.url === event.notification.data.url && 'focus' in client) {
                    return client.focus();
                }
            }
            if (clients.openWindow) {
                return clients.openWindow(event.notification.data.url);
            }
        })
    );
});
