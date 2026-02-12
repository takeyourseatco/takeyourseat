import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
import { getMessaging, getToken, onMessage } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-messaging.js";

const firebaseConfig = {
  apiKey: "AIzaSyCSkzAISKeZHTsJo_2YHbAlecPtC_Bxq_Q",
  authDomain: "takeyourseat-01.firebaseapp.com",
  projectId: "takeyourseat-01",
  messagingSenderId: "547655609873",
  appId: "1:547655609873:web:f9ff150d9b279282230bb0"
};

const app = initializeApp(firebaseConfig);
const messaging = getMessaging(app);

// Ask permission first
Notification.requestPermission().then(permission => {
  if (permission !== "granted") {
    console.warn("Notification permission denied");
    return;
  }

  navigator.serviceWorker.register("../firebase-messaging-sw.js")
    .then(registration => {
      return getToken(messaging, {
        vapidKey: "BObQoRTGIS7lvi-3BgagS3YOCRMg_ymw7Tnl55vBaWF_3FriDs2oRLWG9QjKH73s4vC3RaHMyaJlWj8aHJFfH5o",
        serviceWorkerRegistration: registration
      });
    })
    .then(token => {
      if (token) {
        fetch("../admin/save-token", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ token })
        });
      }
    })
    .catch(err => console.error("FCM error:", err));
});

// Foreground notifications
onMessage(messaging, payload => {
  new Notification(payload.notification.title, {
    body: payload.notification.body,
    icon: "../assets/favicon/favicon-96x96.png"
  });
});
