<?php
include("connections.php");

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patientId = $_POST['edit-case-ID'];
    $name = $_POST['edit-case-Name'];
    $age = $_POST['edit-case-Age'];
    $birthdate = $_POST['edit-case-Birthdate'];
    $foodRecom = $_POST['edit-case-Food_Recom'];
    $treatment = $_POST['edit-case-Treatment'];
    $medecine = $_POST['edit-case-Medecine'];
    $date = $_POST['edit-case-Date'];

    $query = "UPDATE `diet_db` SET name = ?, age = ?, birthdate = ?, food_recom = ?, treatment = ?, medecine = ?, Date = ? WHERE Patient_id = ?";

    if ($stmt = mysqli_prepare($connections, $query)) {
        mysqli_stmt_bind_param($stmt, "sissssss", $name, $age, $birthdate, $foodRecom, $treatment, $medecine, $date, $patientId);

        if (mysqli_stmt_execute($stmt)) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
            $response['error'] = "Error executing query: " . mysqli_error($connections);
        }

        mysqli_stmt_close($stmt);
    } else {
        $response['success'] = false;
        $response['error'] = "Error preparing query: " . mysqli_error($connections);
    }
} else {
    $response['success'] = false;
    $response['error'] = "Invalid request method.";
}

mysqli_close($connections);

echo json_encode($response);
?>
