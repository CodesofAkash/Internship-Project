<?php
    session_start();
    include_once('connection2.php');

    if(isset($_POST['itemName']) && isset($_POST['quantity'])){
        $itemName = $_POST['itemName'];
        $quantity = $_POST['quantity'];
        $result = $conn->query("SELECT itemPrice FROM menu WHERE itemName = '$itemName'");
        if($row = $result->fetch_assoc()){
            $itemPrice = $row['itemPrice'];
        } else {
            $itemPrice = 0;
        }

        $check = $conn->query("SELECT quantity FROM foodOrder WHERE itemName = '$itemName'");
        if($check->num_rows > 0){
            $row = $check->fetch_assoc();
            $newQuantity = $row['quantity'] + $quantity;
            $sql = "UPDATE foodOrder SET quantity = '$newQuantity' WHERE itemName = '$itemName'";
        } else {
            $sql = "INSERT INTO foodOrder (itemName, quantity, itemPrice) VALUES ('$itemName', '$quantity', '$itemPrice')";
        }

        if($conn->query($sql)){
            $_SESSION['success'] = 'Member added/updated successfully';
        } else{
            $_SESSION['error'] = 'Something went wrong while adding/updating';
        }
    } else{
        $_SESSION['error'] = 'Fill up add form first';
    }

    header('location: project.php');
?>