<?php
include 'config/db.php';

header("Content-Type: text/plain");

$message = trim($_POST['message'] ?? '');

if (!$message) {
    echo "Ask something...";
    exit;
}

$query = mysqli_query($conn, "SELECT * FROM chatbot_quiries");

while ($row = mysqli_fetch_assoc($query)) {
    if (strpos(strtolower($message), $row['keyword']) !== false) {
        echo $row['answer'];
        exit;
    }
}

$apiKey = "AIzaSyAQ8aq0wl9Qv9g1BwvfUgfnOoQo6aBwkZk";

$url = "https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent?key=$apiKey";

$data = [
  "contents" => [
    [
      "parts" => [
        ["text" => "You are a helpful assistant for a tours, bus, and travel booking website. Give short, clear, and helpful answers.\nUser: " . $message]
      ]
    ]
  ]
];

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

if (isset($result['error'])) {
    echo "Error: " . $result['error']['message'];
    exit;
}

echo $result['candidates'][0]['content']['parts'][0]['text'] ?? "No response";
