<?php
    session_start();
    include_once('connection2.php');

    $sql = "TRUNCATE foodOrder";
    $result = $conn->query($sql);

    if ($result) {
        $_SESSION['message'] = "All orders have been cleared successfully.";
    } else {
        $_SESSION['message'] = "Failed to clear orders: " . $conn->error;
    }

    header('location: project.php');
?>