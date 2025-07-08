<?php
session_start();

// Get form values from POST
$transactionId = $_POST['transaction_id'] ?? 'N/A';
$room = $_POST['room'] ?? 'N/A';
$checkin = $_POST['checkin'] ?? 'N/A';
$checkout = $_POST['checkout'] ?? 'N/A';
$guests = $_POST['guests'] ?? 'N/A';
$services = $_POST['services'] ?? 'N/A';
$servicePrice = $_POST['service_price'] ?? '0';
$total = $_POST['total'] ?? '0';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reservation Confirmed</title>
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background: #f5f5f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .confirmation {
      background-color: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0,0,0,0.15);
      text-align: center;
      max-width: 600px;
      width: 90%;
    }

    .confirmation h1 {
      color: #4caf50;
      margin-bottom: 15px;
    }

    .confirmation .summary {
      text-align: left;
      margin-top: 20px;
      font-size: 15px;
    }

    .confirmation .note {
      background: #fffbe6;
      border-left: 4px solid #ff9800;
      padding: 15px;
      margin-top: 25px;
      font-size: 14px;
      text-align: left;
    }

    .btn {
      display: inline-block;
      margin-top: 25px;
      padding: 10px 25px;
      background-color: #4caf50;
      color: white;
      border: none;
      border-radius: 6px;
      text-decoration: none;
      font-size: 16px;
    }

    .btn:hover {
      background-color: #388e3c;
    }
  </style>
</head>
<body>

<div class="confirmation">
  <h1>Reservation Confirmed ✅</h1>
  <p>Your transaction has been successfully processed.</p>

  <div class="summary">
    <p><strong>Transaction ID:</strong> <?= htmlspecialchars($transactionId) ?></p>
    <p><strong>Room:</strong> <?= htmlspecialchars($room) ?></p>
    <p><strong>Check-in:</strong> <?= htmlspecialchars($checkin) ?></p>
    <p><strong>Check-out:</strong> <?= htmlspecialchars($checkout) ?></p>
    <p><strong>Guests:</strong> <?= htmlspecialchars($guests) ?></p>
    <p><strong>Services:</strong> <?= htmlspecialchars($services) ?> - PHP <?= number_format($servicePrice) ?></p>
    <p><strong>Total:</strong> PHP <?= number_format($total) ?></p>
  </div>

  <div class="note">
    <strong>Cancellation Policy:</strong><br>
    - 20% penalty if cancelled within 2 days (48 hrs)<br>
    - 15% penalty if cancelled within 4 days<br>
    - 10% penalty if cancelled 5 days or more in advance
  </div>

  <a href="../index.php" class="btn">Return to Home</a>
</div>

</body>
</html>
