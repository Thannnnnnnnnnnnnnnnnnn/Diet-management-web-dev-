<?php
include("connections.php");


if (isset($_GET['id'])) {
    $caseId = $_GET['id'];
   
    $query = "SELECT * FROM `diet_db` WHERE Patient_id = ?";


    $stmt = mysqli_prepare($connections, $query);

    if ($stmt) {
 
        mysqli_stmt_bind_param($stmt, "s", $caseId);


        mysqli_stmt_execute($stmt);

  
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
          
                echo "<form id='edit-case-form' method='post' action='update_case.php'>";
                echo "<input type='hidden' name='edit-case-ID' value='{$row['Patient_id']}'>";
                echo "<div class='mb-3'>";
                echo "<label for='edit-case-Name' class='form-label'>Name</label>";
                echo "<input type='text' class='form-control' id='edit-case-Name' name='edit-case-Name' value='{$row['name']}' required>";
                echo "</div>";
                echo "<div class='mb-3'>";
                echo "<label for='edit-case-Age' class='form-label'>Age</label>";
                echo "<input type='text' class='form-control' id='edit-case-Age' name='edit-case-Age' value='{$row['age']}' required>";
                echo "</div>";
                echo "<div class='mb-3'>";
                echo "<label for='edit-case-Birthdate' class='form-label'>Birthdate</label>";
                echo "<input type='date' class='form-control' id='edit-case-Birthdate' name='edit-case-Birthdate' value='{$row['birthdate']}' required>";
                echo "</div>";
                echo "<div class='mb-3'>";
                echo "<label for='edit-case-Food_Recom' class='form-label'>Food Recommendation</label>";
                echo "<input type='text' class='form-control' id='edit-case-Food_Recom' name='edit-case-Food_Recom' value='{$row['food_recom']}' required>";
                echo "</div>";
                echo "<div class='mb-3'>";
                echo "<label for='edit-case-Treatment' class='form-label'>Treatment</label>";
                echo "<input type='text' class='form-control' id='edit-case-Treatment' name='edit-case-Treatment' value='{$row['treatment']}' required>";
                echo "</div>";
                echo "<div class='mb-3'>";
                echo "<label for='edit-case-Medecine' class='form-label'>Medicine</label>";
                echo "<input type='text' class='form-control' id='edit-case-Medecine' name='edit-case-Medecine' value='{$row['medecine']}' required>";
                echo "</div>";
                echo "<div class='mb-3'>";
                echo "<label for='edit-case-Time' class='form-label'>Time</label>";
                echo "<input type='text' class='form-control' id='edit-case-Time' name='edit-case-Time' value='{$row['Time']}' disabled>";
                echo "</div>";
                echo "<div class='mb-3'>";
                echo "<label for='edit-case-Date' class='form-label'>Date</label>";
                echo "<input type='date' class='form-control' id='edit-case-Date' name='edit-case-Date' value='{$row['Date']}' required>";
                echo "</div>";
                echo "<button type='submit' class='btn btn-primary'>Save Changes</button>";
           
                echo "<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>";
         
                echo "</form>";
            } else {
                echo "No record found for the provided ID.";
            }
        } else {
            echo "Query execution failed: " . mysqli_error($connections);
        }


        mysqli_stmt_close($stmt);
    } else {
        echo "Failed to prepare the SQL statement.";
    }
} else {
    echo "No ID provided.";
}


mysqli_close($connections);
?>
