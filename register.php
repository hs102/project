<?php
//check whether user already logged, redirect to home if logged
include('./components/registerprocess.php');
session_start();
if (isset($_SESSION['uid'])) {
    header("location: index.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container">
        <div class="login">

            <div class="loginpic margin-top">
                <img src="img/pollifylogin.png" alt="login">
                <div class="not-registered-1" style="width: 300px; text-align:center; margin-top:10px">
                    <p>Already have an account?</p>
                    <a style="margin-top:10px" href="login.php">Login</a>
                </div>
            </div>
            <!-- Member registration form -->
            <form method="POST" name="regform" class="loginform" style="margin-top: 0px;">

                <h2 class="logintitle">Register</h2>
                <div class="inputbox">
                    <input class="input" type="text" name="firstName" placeholder="First Name">
                </div>
                
                <div class="inputbox">
                    <input class="input" type="email" title="Only Gmails are acceptable" name="email" placeholder="Email">
                </div>
                <div class="inputbox">
                    <input class="input" type="password" name="password" placeholder="Password">
                </div>
                <div class="errormsg">
                    <?php
                    //Display the proper error if any error occured
                    if (isset($errors) && !empty($errors)) {
                        echo $errors;
                    }
                    ?>
                </div>
                <div class="btnarea">
                    <button name="submit" class="loginbtn">Register Now<button>
                </div>

            </form>

            <div class="not-registered-2" style=" text-align:center; margin-top:10px">
                <p>Already have an account?</p>
                <a style="margin-top:10px" href="login.php">Login</a>
            </div>

        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('register-btn').addEventListener('click', function () {
            // Get form data
            var formData = new FormData(document.getElementById('register-form'));

            // Set the check_email parameter for email validation
            formData.append('check_email', '1');

            // AJAX request to the same file
            fetch('<?php echo $_SERVER['PHP_SELF']; ?>', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Registration successful
                    alert(data.message);
                    // You can redirect or perform any other action on success
                } else if (data.status === 'error') {
                    // Display error message
                    document.getElementById('email-error').innerHTML = data.message;
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
</script>


</body>

</html>