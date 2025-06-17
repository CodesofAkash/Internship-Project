<?php
include('connection.php');

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $query = "DELETE FROM members WHERE ID='$id'";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = "Member deleted successfully!";
    } else {
        $_SESSION['error'] = "Error: " . mysqli_error($conn);
    }

    header('Location: index.php');
}
?>
