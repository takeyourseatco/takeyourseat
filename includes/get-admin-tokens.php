<?php
function getAllAdminTokens($conn) {
  $tokens = [];
  $result = mysqli_query($conn, "SELECT token FROM admin_fcm_tokens");

  while ($row = mysqli_fetch_assoc($result)) {
    $tokens[] = $row['token'];
  }

  return $tokens;
}
