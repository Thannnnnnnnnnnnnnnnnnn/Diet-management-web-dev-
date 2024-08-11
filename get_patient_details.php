<?php

include("connections.php");


if(isset($_GET['id'])) {

    $caseId = mysqli_real_escape_string($connections, $_GET['id']);


    $query = "SELECT * FROM `diet_db` WHERE Patient_id = '$caseId'";
    $result = mysqli_query($connections, $query);


    if($result && mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);
?>

        <form id="editForm">
            <input type="hidden" name="id" value="<?php echo $row['Patient_id']; ?>">
            Name: <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>
            Age: <input type="text" name="age" value="<?php echo $row['age']; ?>"><br>
            Birthdate: <input type="text" name="birthdate" value="<?php echo $row['birthdate']; ?>"><br>
            Food Recommendation: <input type="text" name="food_recom" value="<?php echo $row['food_recom']; ?>"><br>
            Treatment: <input type="text" name="treatment" value="<?php echo $row['treatment']; ?>"><br>
            Medicine: <input type="text" name="medicine" value="<?php echo $row['medicine']; ?>"><br>
            Time: <input type="text" name="time" value="<?php echo $row['Time']; ?>"><br>
            Date: <input type="text" name="date" value="<?php echo $row['Date']; ?>"><br>
            <!-- Add more fields as needed -->
            <button type="submit">Update</button>
        </form>
<?php
    } else {
        echo "No record found with ID: " . $caseId;
    }
} else {
    echo "Case ID not provided.";
}
?>
