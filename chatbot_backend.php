if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userMessage = $_POST['message'];
    // Simple rule-based responses
    if (stripos($userMessage, 'hello') !== false) {
        echo 'Hello! How can I help you?';
    } elseif (stripos($userMessage, 'donate') !== false) {
        echo 'To donate food, please go to the donation page and fill out the form.';
    } elseif (stripos($userMessage, 'contact') !== false) {
        echo 'You can contact us via the contact page or email.';
    } else {
        echo 'Sorry, I did not understand that. Please try asking something else.';
    }
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userMessage = $_POST['message'];

    // Check for delivery status update command
    if (preg_match('/update delivery (\d+) to ([a-zA-Z_\- ]+)/i', $userMessage, $matches)) {
        $id = (int)$matches[1];
        $status = trim($matches[2]);
        require_once __DIR__ . '/database/db_conn.php';
        $stmt = $mysqli->prepare('UPDATE food_donations SET status = ? WHERE Fid = ?');
        $stmt->bind_param('si', $status, $id);
        if ($stmt->execute() && $stmt->affected_rows > 0) {
            echo "Delivery status for ID $id updated to '$status'.";
        } else {
            echo "Failed to update status. Please check the delivery ID.";
        }
        $stmt->close();
        $mysqli->close();
    }
    // Simple rule-based responses
    elseif (stripos($userMessage, 'hello') !== false) {
        echo 'Hello! How can I help you?';
    } elseif (stripos($userMessage, 'donate') !== false) {
        echo 'To donate food, please go to the donation page and fill out the form.';
    } elseif (stripos($userMessage, 'contact') !== false) {
        echo 'You can contact us via the contact page or email.';
    } else {
        echo 'Sorry, I did not understand that. Please try asking something else.';
    }
}
?>
