<?php
    session_start();
    include_once('connection2.php');

    if(isset($_POST['fullName']) && isset($_POST['phoneNumber'])){
        $fullName = $_POST['fullName'];
        $phoneNumber = $_POST['phoneNumber'];

        $sql = "SELECT * FROM bill LIMIT 1";
        $result = $conn->query($sql);

        if($result && $result->num_rows > 0){
            $updateSql = "UPDATE bill SET fullName = '$fullName', phoneNumber = '$phoneNumber' LIMIT 1";
            $conn->query($updateSql);
            $_SESSION['success'] = 'Record replaced successfully';
        } else {
            $insertSql = "INSERT INTO bill (fullName, phoneNumber) VALUES ('$fullName', '$phoneNumber')";
            $conn->query($insertSql);
            $_SESSION['success'] = 'Record added successfully';
        }
    } else{
        $_SESSION['error'] = 'Fill up add form first';
    }

    header('location: project.php');
?>