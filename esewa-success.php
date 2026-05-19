<?php
include 'includes/header.php';
include 'config/db.php';

$data = $_SESSION['booking_data'];
$package_id = $data['package_id'];

if (!isset($_SESSION['booking_data'])) {
    header("Location: tours?error=invalid");
}

$pid = $_SESSION['pid'] ?? '';


$stmt = $conn->prepare("
    INSERT INTO package_bookings
    (package_id, user_id, name, email, phone, travel_date, persons, payment_status, payment_method, transaction_id)
    VALUES (?, ?, ?, ?, ?, ?, ?, 'paid', 'eSewa', ?)
");

$stmt->bind_param(
    "iissssis",
    $data['package_id'],
    $data['user_id'],
    $data['name'],
    $data['email'],
    $data['phone'],
    $data['date'],
    $data['persons'],
    $pid
);

$stmt->execute();

unset($_SESSION['booking_data']);
unset($_SESSION['pid']);

header("Location: tour-details?id=" . $data['package_id'] . "&success=booked");
exit; 
