/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    encrypted: true,
    forceTls: true
});

// export async function subscribeUserToPush() {
//     try {
//         const registration = await navigator.serviceWorker.ready;

//         const subscription = await registration.pushManager.subscribe({
//             userVisibleOnly: true,
//             applicationServerKey: urlBase64ToUint8Array(import.meta.env.VITE_VAPID_PUBLIC_KEY)
//         });

//         await saveSubscription(subscription);
//         console.log('User is subscribed:', subscription);
//     } catch (error) {
//         console.error('Failed to subscribe the user:', error);
//     }
// }

export async function subscribeUserToPush() {
    try {
        // Request notification permission
        const permission = await Notification.requestPermission();

        if (permission !== 'granted') {
            console.log('You need to enable notifications in your browser settings to receive push notifications.');
            return;
        }

        const registration = await navigator.serviceWorker.ready;
        
        const subscription = await registration.pushManager.subscribe({
            userVisibleOnly: true,
            applicationServerKey: import.meta.env.VITE_VAPID_PUBLIC_KEY
            });
            
            // console.log(subscription);
        await saveSubscription(subscription);
        console.log('User is subscribed:', subscription);
    } catch (error) {
        console.error('Failed to subscribe the user:', error);
        // alert('Failed to subscribe the user for push notifications. Please check your browser settings.');
    }
}


async function saveSubscription(subscription) {
    // Send the subscription object to your server to save it
    await axios.post('/save-subscription', subscription);
}

// Ensure service worker is registered
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/service-worker.js').then(function(registration) {
        console.log('ServiceWorker registration successful with scope: ', registration.scope);
    }).catch(function(error) {
        console.log('ServiceWorker registration failed: ', error);
    });
}
