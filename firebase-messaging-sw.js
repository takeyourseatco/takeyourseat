importScripts("https://www.gstatic.com/firebasejs/10.7.1/firebase-app-compat.js");
importScripts("https://www.gstatic.com/firebasejs/10.7.1/firebase-messaging-compat.js");

firebase.initializeApp({
  apiKey: "AIzaSyCSkzAISKeZHTsJo_2YHbAlecPtC_Bxq_Q",
  authDomain: "takeyourseat-01.firebaseapp.com",
  projectId: "takeyourseat-01",
  messagingSenderId: "547655609873",
  appId: "1:547655609873:web:f9ff150d9b279282230bb0"
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {
  self.registration.showNotification(payload.notification.title, {
    body: payload.notification.body,
    icon: "/assets/favicon/favicon-96x96.png"
  });
});
