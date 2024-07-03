<?php
if (isset($_POST['pay'])) {
    $paymentMethod = $_POST['paymentMethod'];
    $presetAmount = $_POST['presetAmount'];
    $customAmount = $_POST['customAmount'];
    $amount = !empty($customAmount) ? $customAmount : $presetAmount;
    $trcode = $_POST['trcode'];

    // Perform database insertion or any other necessary processing
    // Replace with your database connection and insertion logic
    $conn = new mysqli('localhost', 'username', 'password', 'database_name');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO tithe (Amount, Trcode, PaymentMethod, na) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $amount, $trcode, $paymentMethod, $session_id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
    $conn->close();
}
?>
