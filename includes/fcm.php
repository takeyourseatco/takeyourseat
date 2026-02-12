<?php

function getAccessToken() {
    $json = json_decode(file_get_contents(__DIR__ . "/service-account.json"), true);

    $now = time();

    $header = base64_encode(json_encode([
        "alg" => "RS256",
        "typ" => "JWT"
    ]));

    $payload = base64_encode(json_encode([
        "iss" => $json['client_email'],
        "scope" => "https://www.googleapis.com/auth/firebase.messaging",
        "aud" => $json['token_uri'],
        "iat" => $now,
        "exp" => $now + 3600
    ]));

    openssl_sign("$header.$payload", $signature, $json['private_key'], "SHA256");

    $jwt = "$header.$payload." . base64_encode($signature);

    $ch = curl_init($json['token_uri']);
    curl_setopt_array($ch, [
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => http_build_query([
            "grant_type" => "urn:ietf:params:oauth:grant-type:jwt-bearer",
            "assertion" => $jwt
        ])
    ]);

    $res = json_decode(curl_exec($ch), true);
    return $res['access_token'] ?? null;
}

include __DIR__ . '/../config/db.php';
require_once __DIR__ . '/get-admin-tokens.php';

function sendFCMToAdmins($conn, $title, $body) {

  $accessToken = getAccessToken();
  $tokens = getAllAdminTokens($conn);

  if (empty($tokens)) return;

  foreach ($tokens as $token) {

    $response = sendSingleFCM($accessToken, $token, $title, $body);

    if (isset($response['error'])) {
      $errorCode = $response['error']['status'] ?? '';

      if (in_array($errorCode, ['UNREGISTERED', 'INVALID_ARGUMENT', 'NOT_FOUND'])) {
        mysqli_query(
          $conn,
          "DELETE FROM admin_fcm_tokens WHERE token = '" . mysqli_real_escape_string($conn, $token) . "'"
        );
        file_put_contents(
          __DIR__ . "/fcm-invalid-tokens.log",
          date('Y-m-d H:i:s') . " Removed token: $token\n",
          FILE_APPEND
        );
      }
    }
  }
}


function sendSingleFCM($accessToken, $token, $title, $body) {

  $projectId = "takeyourseat-01";

  $payload = [
    "message" => [
      "token" => $token,
      "notification" => [
        "title" => $title,
        "body" => $body
      ],
      "webpush" => [
        "notification" => [
          "icon" => "/assets/favicon/favicon-96x96.png"
        ]
      ]
    ]
  ];

  $ch = curl_init("https://fcm.googleapis.com/v1/projects/$projectId/messages:send");
  curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => [
      "Authorization: Bearer $accessToken",
      "Content-Type: application/json"
    ],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS => json_encode($payload)
  ]);

  $response = curl_exec($ch);
  curl_close($ch);

  file_put_contents("fcm-log.txt", date('Y-m-d H:i:s') . $response . "\n", FILE_APPEND);

  return json_decode($response, true);
}
