<?php
include("../../../koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // Update payment_status to "paid"
    $updateQuery = "UPDATE periksa SET payment_status = 'paid' WHERE id = $id";
    $updateResult = mysqli_query($mysqli, $updateQuery);

    // Properly encode the id for URL
    $encodedId = urlencode($id);

    if ($updateResult) {
        // Use JavaScript to display an alert and redirect
        echo '<script>
                alert("Payment status updated successfully.");
                window.location.href = "payment.php?id=' . $encodedId . '";
              </script>';
    } else {
        // Use JavaScript to display an alert with the error message and redirect
        $errorMessage = urlencode(mysqli_error($mysqli));
        echo '<script>
                alert("Error updating payment status: ' . $errorMessage . '");
                window.location.href = "payment.php?id=' . $encodedId . '";
              </script>';
    }
}
