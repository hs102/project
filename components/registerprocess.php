<?php
// include database connection 
include('connect.php');

$errors = '';
// add a new post to the DB if user fills the form
if (isset($_POST['submit'])) {
    //get the details of the form
    $firstName = $_POST['firstName'];
    
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    // Validate Email is not already exists
    $query1 =  "SELECT * FROM users WHERE email='$email'";
    $res = $conn->query($query1);

    if (!(isset($_POST['firstName']) && isset($_POST['email']) && isset($_POST['password']))) {
        // validate details
        $errors = 'Please fill all details!';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //validate email
        $errors = 'Email not valid!';
    } else if (($data = $res->fetch())) {
        //error if already exist email
        $errors = 'Email already exists!'; 
    } else if (strlen($_POST['password']) < 8) {
        //error if password is too short than 8 characters
        $errors = 'Enter Atleast 8 Character Password!';
        // regular expression 
    } else if (!preg_match("#^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$#", $_POST['password'])) {
        //error if password doesn't meet requirements
        $errors = '<small>Password must contain atleast one uppercase letter and one alphanumeric character or symbol.</small>';
    } else {
        $sql =  "INSERT INTO users (firstName, email, password) 
                    VALUES ('$firstName', '$email', '$password')";
        //RETURN TO Login IF QUERY SUCCESS  
        if ($conn->exec($sql)) {
            header('Location: ./login.php');
        } else {
            $errors = 'Database Issue!';
        }

    }
    
}
?>



<script> // AJAX function
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('register-btn').addEventListener('click', function () {
            // Get form data
            var formData = new FormData(document.getElementById('register-form'));

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
                    document.getElementById('error-message').innerHTML = data.message;
                }
            })
            .catch(error => console.error('Error:', error));
        });

        // AJAX request to check if email is already taken
        document.getElementById('email').addEventListener('blur', function () {
            var email = this.value;
            fetch('<?php echo $_SERVER['PHP_SELF']; ?>', {
                method: 'POST',
                body: 'email=' + email,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'error') {
                    // Display email error message
                    document.getElementById('email-error').innerHTML = data.message;
                } else {
                    document.getElementById('email-error').innerHTML = '';
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
</script>