<?php
include("connections.php");

if (isset($_GET['id'])) {
    $patient_id = $_GET['id'];

    $query = "SELECT * FROM `diet_db` WHERE `Patient_id` = ?";
    $stmt = $connections->prepare($query);
    $stmt->bind_param("i", $patient_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>Patient ID</th>
                    <td><?php echo htmlspecialchars($row['Patient_id']); ?></td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                </tr>
                <tr>
                    <th>Age</th>
                    <td><?php echo htmlspecialchars($row['age']); ?></td>
                </tr>
                <tr>
                    <th>Birthdate</th>
                    <td><?php echo htmlspecialchars($row['birthdate']); ?></td>
                </tr>
                <tr>
                    <th>Food Recommendation</th>
                    <td><?php echo htmlspecialchars($row['food_recom']); ?></td>
                </tr>
                <tr>
                    <th>Treatment</th>
                    <td><?php echo htmlspecialchars($row['treatment']); ?></td>
                </tr>
                <tr>
                    <th>Medicine</th>
                    <td><?php echo htmlspecialchars($row['medecine']); ?></td>
                </tr>
                <tr>
                    <th>Time</th>
                    <td><?php echo htmlspecialchars($row['Time']); ?></td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td><?php echo htmlspecialchars($row['Date']); ?></td>
                </tr>
            </table>
        </div>
        <?php
    } else {
        echo "No records found.";
    }
} else {
    echo "Invalid request.";
}
?>
