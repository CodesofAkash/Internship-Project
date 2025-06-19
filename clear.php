<?php
    session_start();
    include_once('connection2.php');

    $sql = "TRUNCATE foodOrder";
    $result = $conn->query($sql);

    if ($result) {
        $_SESSION['message'] = "All orders have been cleared successfully.";
    $resetSql = "ALTER TABLE foodOrder AUTO_INCREMENT = 1";
    $resetResult = $conn->query($resetSql);

    if ($resetResult) {
        $_SESSION['message'] = "All orders have been cleared and menu AUTO_INCREMENT reset successfully.";
    } else {
        $_SESSION['message'] = "Orders cleared, but failed to reset menu AUTO_INCREMENT: " . $conn->error;
    }
    } else {
    $_SESSION['message'] = "Failed to clear orders: " . $conn->error;
    }

    header('location: project.php');
?>