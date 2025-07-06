<?php
session_start();
include '../includes/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$userId = $_SESSION['user_id'];
$email = "";

// Get email from `users` table
$query = $conn->prepare("SELECT email FROM users WHERE id = ?");
$query->bind_param("i", $userId);
$query->execute();
$query->bind_result($email);
$query->fetch();
$query->close();

// Initialize profile fields
$title = $firstName = $middleName = $lastName = $nationality = $dob = $gender = "";
$address1 = $address2 = $address3 = $city = $zip = $country = "";

// Check if profile already exists
$checkProfile = $conn->prepare("SELECT * FROM user_profiles WHERE email = ?");
$checkProfile->bind_param("s", $email);
$checkProfile->execute();
$result = $checkProfile->get_result();
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $title = $row['title'];
    $firstName = $row['first_name'];
    $middleName = $row['middle_name'];
    $lastName = $row['last_name'];
    $nationality = $row['nationality'];
    $dob = $row['dob'];
    $gender = $row['gender'];
    $address1 = $row['address1'];
    $address2 = $row['address2'];
    $address3 = $row['address3'];
    $city = $row['city'];
    $zip = $row['zip'];
    $country = $row['country'];
}
$checkProfile->close();

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'] ?? '';
    $firstName = $_POST['first_name'] ?? '';
    $middleName = $_POST['middle_name'] ?? '';
    $lastName = $_POST['last_name'] ?? '';
    $nationality = $_POST['nationality'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $address1 = $_POST['address1'] ?? '';
    $address2 = $_POST['address2'] ?? '';
    $address3 = $_POST['address3'] ?? '';
    $city = $_POST['city'] ?? '';
    $zip = $_POST['zip'] ?? '';
    $country = $_POST['country'] ?? '';

    // If profile already exists, update
    $check = $conn->prepare("SELECT id FROM user_profiles WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $stmt = $conn->prepare("UPDATE user_profiles SET 
            title=?, first_name=?, middle_name=?, last_name=?, nationality=?, dob=?, gender=?, 
            address1=?, address2=?, address3=?, city=?, zip=?, country=?
            WHERE email=?");
        $stmt->bind_param("ssssssssssssss", $title, $firstName, $middleName, $lastName, $nationality, $dob, $gender,
            $address1, $address2, $address3, $city, $zip, $country, $email);
    } else {
        // If no profile yet, insert new
        $stmt = $conn->prepare("INSERT INTO user_profiles 
            (title, first_name, middle_name, last_name, nationality, email, dob, gender, address1, address2, address3, city, zip, country) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssssssss", $title, $firstName, $middleName, $lastName, $nationality, $email, $dob, $gender,
            $address1, $address2, $address3, $city, $zip, $country);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Information saved successfully!'); window.location.href='profile.php';</script>";
        exit();
    } else {
        echo "<script>alert('Failed to save information: " . addslashes($stmt->error) . "');</script>";
    }
    $stmt->close();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>A Place to Update Your Details</title>
    <link rel="stylesheet" href="../assets/css/profile.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
</head>
<body>
    <header class="hero" id="about">
        <div class="topbar" id="navbar">
            <a href="../index.php"><img src="../assets/images/logo.png" alt="Juno Logo" class="logo"></a>
            <div class="nav-links">
                <a href="../index.php" class="about-link">Home</a>
                <a href="../pages/about.php" class="contact-link">About Us</a>
            </div>
        </div>
    </header>

    <h1>A Place to Update Your Details</h1>
    <p>All fields are mandatory unless stated otherwise.</p>

    <form method="POST" action="">
        <h2>Personal Information</h2>
        <div class="form-section">
            <div>
                <label for="title">Title (Optional)</label>
                <select name="title" id="title">
                    <option value="">Select</option>
                    <option value="Mr" <?= ($title == "Mr") ? "selected" : "" ?>>Mr.</option>
                    <option value="Ms" <?= ($title == "Ms") ? "selected" : "" ?>>Ms.</option>
                    <option value="Mrs" <?= ($title == "Mrs") ? "selected" : "" ?>>Mrs.</option>
                </select>

                <label for="middle_name">Middle Name (Optional)</label>
                <input type="text" name="middle_name" id="middle_name" value="<?= htmlspecialchars($middleName) ?>">

                <label for="nationality">Nationality (Optional)</label>
                <input type="text" name="nationality" id="nationality" value="<?= htmlspecialchars($nationality) ?>">

                <label for="dob">Date of Birth (Optional)</label>
                <input type="date" name="dob" id="dob" value="<?= htmlspecialchars($dob) ?>">
            </div>

            <div>
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" required value="<?= htmlspecialchars($firstName) ?>">

                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" required value="<?= htmlspecialchars($lastName) ?>">

                <label for="email">Email</label>
                <input type="email" name="email" id="email" required value="<?= htmlspecialchars($email) ?>" readonly>



                <label for="gender">Gender (Optional)</label>
                <select name="gender" id="gender">
                    <option value="">Select</option>
                    <option value="Male" <?= ($gender == "Male") ? "selected" : "" ?>>Male</option>
                    <option value="Female" <?= ($gender == "Female") ? "selected" : "" ?>>Female</option>
                    <option value="Other" <?= ($gender == "Other") ? "selected" : "" ?>>Other</option>
                </select>
            </div>
        </div>

        <h2>Address Information</h2>
        <div class="form-section">
            <div>
                <label for="address1">Address Line 1 (Optional)</label>
                <input type="text" name="address1" id="address1" value="<?= htmlspecialchars($address1) ?>">

                <label for="address3">Address Line 3 (Optional)</label>
                <input type="text" name="address3" id="address3" value="<?= htmlspecialchars($address3) ?>">

                <label for="zip">ZIP / Post Code (Optional)</label>
                <input type="text" name="zip" id="zip" value="<?= htmlspecialchars($zip) ?>">
            </div>
            <div>
                <label for="address2">Address Line 2 (Optional)</label>
                <input type="text" name="address2" id="address2" value="<?= htmlspecialchars($address2) ?>">

                <label for="city">City (Optional)</label>
                <input type="text" name="city" id="city" value="<?= htmlspecialchars($city) ?>">

                <label for="country">Country of Residence</label>
                <input type="text" name="country" id="country" required value="<?= htmlspecialchars($country) ?>">
            </div>
        </div>

        <button type="submit">Save</button>
    </form>

    <footer>
        <div class="footer-left">
            <img src="../assets/images/junologo.png" alt="Juno Footer Logo">
            <p>© 2025 Juno Hotel. All rights reserved.</p>
        </div>
        <div class="footer-right">
            <p><a href="#">Contact Us</a></p>
            <p>📞 <u><a href="tel:+63281234567">(02) 8123 4567</a></u></p>
            <p>✉️ <u><a href="mailto:info@junohotel.com">info@junohotel.com</a></u></p>
            <p><a href="#about">About Us</a></p>
            <p><a href="#faqs">FAQs</a></p>
        </div>
    </footer>
</body>
</html>
