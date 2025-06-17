<?php
include('connection.php');

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    $query = "UPDATE members SET firstName='$firstName', lastName='$lastName', Address='$address' WHERE ID='$id'";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = "Member updated successfully!";
    } else {
        $_SESSION['error'] = "Error: " . mysqli_error($conn);
    }

    header('Location: index.php');
}
?>
