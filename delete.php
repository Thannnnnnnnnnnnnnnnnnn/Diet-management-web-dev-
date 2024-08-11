<?php
include("connections.php");

if (isset($_GET['id'])) {
    $Patient_id = $_GET['id'];


    $sql = "DELETE FROM `diet_db` WHERE Patient_id = ?";
    $stmt = $connections->prepare($sql);
    $stmt->bind_param("s", $Patient_id);

    if ($stmt->execute()) {
    
        header("Location: adminn.php?message=Record+deleted+successfully");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $connections->error;
    }
} else {
    echo "Invalid request.";
}
?>
