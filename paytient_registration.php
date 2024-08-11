<?php
include("connections.php");

// Generate unique Patient ID
$Patient_id = uniqid(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $age = $_POST['age'];
    $birthdate = $_POST['birthdate'];
    $food_recom = $_POST['food_recom'];
    $treatment = $_POST['treatment'];
    $medecine = $_POST['medecine'];
    $Time = $_POST['Time'];
    $Date = $_POST['Date'];

    // Insert data into the database
    $sql = "INSERT INTO `diet_db` (name, age, birthdate, food_recom, treatment, medecine, Time, Date) 
            VALUES ('$name', '$age', '$birthdate', '$food_recom', '$treatment', '$medecine', '$Time', '$Date')";

    if ($connections->query($sql) === TRUE) {
        // Redirect to adminn.php after successfully adding a new record
        header("Location: adminn.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $connections->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Registration</title>
    <link rel="stylesheet" href="diett.css">
    
    <script src="logout.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>
<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        
    </header>

    <footer class="footer1">
        <div class="footer-section">
            <br>
            <a href="#" style="margin-left: 10px;"><b>● Diet management</a></b>
        </div>
    </footer>

    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> 
                <a href="adminn.php" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">Diet Management</span> </a>
                <div class="nav_list"> 
                    <a href="adminn.php" class="nav_link active"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a> 
                    <a href="paytient_registration.php" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Patient Registration</span> </a> 
                </div> 
                <a href="login.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Log Out</span> </a>
            </div>
        </nav>
    </div>
    
    <br><br><br>
    <div class="form-container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="name"> Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="age">Age </label>
                <input type="text" id="age" name="age" required>
            </div>
            
            <div class="form-group">
                <label for="birthdate">Birthdate</label>
                <input type="date" id="birthdate" name="birthdate" required>
            </div>

            <div class="form-group">
                <label for="food_recom">Food Recommendation</label>
                <input type="text" id="food_recom" name="food_recom" required>
            </div>

            <div class="form-group">
                <label for="treatment">Treatment</label>
                <input type="text" id="treatment" name="treatment" required>
            </div>

            <div class="form-group">
                <label for="medecine">Medicine</label>
                <input type="text" id="medecine" name="medecine" required>
            </div>

            <div class="form-group">
                <label for="Date">Date</label>
                <input type="date" id="Date" name="Date" required>
            </div>
            <br>
            <center>
            <input type="submit" class="allroundbutton" value="Submit">
            </center>
        </form>
    </div>

  
    <script>
    function addCurrentTimeToForm() {
        const now = new Date();
        const hours = now.getHours();
        const minutes = now.getMinutes();
        const ampm = hours >= 12 ? 'PM' : 'AM';
        const formattedHours = hours % 12 || 12;
        const time = formattedHours + ':' + (minutes < 10 ? '0' : '') + minutes + ' ' + ampm;

        const timeInput = document.createElement('input');
        timeInput.type = 'hidden';
        timeInput.name = 'Time';
        timeInput.value = time;

        const form = document.querySelector('form');
        form.appendChild(timeInput);
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('input[type="submit"]').addEventListener('click', addCurrentTimeToForm);
    });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            const showNavbar = (toggleId, navId, bodyId, headerId) => {
                const toggle = document.getElementById(toggleId),
                nav = document.getElementById(navId),
                bodypd = document.getElementById(bodyId),
                headerpd = document.getElementById(headerId)

                if(toggle && nav && bodypd && headerpd) {
                    toggle.addEventListener('click', () => {
                        nav.classList.toggle('show')
                        toggle.classList.toggle('bx-x')
                        bodypd.classList.toggle('body-pd')
                        headerpd.classList.toggle('body-pd')
                    })
                }
            }

            showNavbar('header-toggle','nav-bar','body-pd','header')
        
            const linkColor = document.querySelectorAll('.nav_link')
        
            function colorLink(){
                if(linkColor){
                    linkColor.forEach(l => l.classList.remove('active'))
                    this.classList.add('active')
                }
            }
            linkColor.forEach(l => l.addEventListener('click', colorLink))
        });
    </script>
</body>
</html>
