<?php

include 'connections.php';

$email = $password = $register = "";
$email_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //check email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    } else {
        $email = trim($_POST["email"]);
    }

    //check password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } else {
        $password = trim($_POST["password"]);
    }

    //check if email already registered
    $sql_check_email = "SELECT Email FROM accounts WHERE Email = '$email'";
    $result_check_email = $connections->query($sql_check_email);
    if ($result_check_email->num_rows > 0) {
        $email_err = "Email is already registered.";
    }

    //if success, data will go in the database
    if (empty($email_err) && empty($password_err)) {
        $sql = "INSERT INTO accounts ( Email, password) VALUES ('$email', '$password')";

        if ($connections->query($sql) === TRUE) {
            $register = "Registered Successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="Main.css">
    
</head>
<body>

<div class="login-container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1>SignUp</h1>
        <span><?php echo $register?></span>
        <span><?php echo $email_err ?></span>
        <span><?php echo $password_err ?></span>
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <input type="submit" class="submit-btn" value="Sign up"><br><br>
        <a href="login.php" class="submit-btn">Login</a></p>
    </form>

    
</div>

</body>
</html>