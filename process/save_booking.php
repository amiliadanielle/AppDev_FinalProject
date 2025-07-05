<?php
session_start();

// Read JSON input
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'Invalid data format.']);
    exit;
}

// Extract values
$quantity       = $data['quantity'] ?? 0;
$preferences    = $data['preferences'] ?? [];
$breakfast      = $data['breakfast'] ?? [];
$specialReqs    = $data['specialRequests'] ?? [];
$checkinDate    = $data['checkinDate'] ?? null;
$guests         = $data['guests'] ?? null;

// Example: Set a 1-night stay, compute total
$roomName       = implode(', ', $preferences);
$hasBreakfast   = in_array('yes', $breakfast);
$pricePerRoom   = 5000; // Replace this with actual pricing logic later
$totalPrice     = $quantity * $pricePerRoom;

// Fake checkout date = +1 day
$checkoutDate = date('Y-m-d', strtotime($checkinDate . ' +1 day'));

// Save booking data to session
$_SESSION['booking_data'] = [
    'quantity'      => $quantity,
    'room_name'     => $roomName,
    'breakfast'     => $hasBreakfast,
    'checkin_date'  => $checkinDate,
    'checkout_date' => $checkoutDate,
    'adults'        => $guests,
    'children'      => 0,
    'total_price'   => $totalPrice
];

// Return success with the same structure the JS expects
echo json_encode([
    'success' => true,
    'bookingDetails' => [
        'roomName'     => $roomName,
        'quantity'     => $quantity,
        'breakfast'    => $hasBreakfast,
        'checkinDate'  => date('d M Y', strtotime($checkinDate)),
        'checkoutDate' => date('d M Y', strtotime($checkoutDate)),
        'guests'       => "$guests Guest(s)",
        'totalPrice'   => $totalPrice
    ]
]);
