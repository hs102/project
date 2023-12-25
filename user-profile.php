 <?php include('./components/userUpdate.php') ?> 

<html>

<head>
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
   
    <link rel="stylesheet" type="text/css" href="../pollify/css/userpfp.css">
    
    
</head>

<body class="h-100 d-flex flex-column">
    

    <div class="center">

        <div>
            <div class="profile-image">
            <img src="/pollify/img/pfp.png" alt="User Profile Image" style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%;">
            </div>
            <h3>User Profile</h3>
            <div class="user-name mb-3">
                Name: <strong><?php echo $_SESSION["fName"]  ?></strong>
            </div>
           
            <div class="user-email mb-3">
                Email: <strong><?php echo $_SESSION['email'] ?></strong>
            </div>

            
            <div class="error-message mt-2">
                <?php
                // Display the proper error if any error occurred
                if (isset($errors) && !empty($errors)) {
                    echo $errors;
                }
                ?>
            </div>
        </div>
    </div>
    <?php include('./components/navigation.php') ?>
   

    <?php include('components/footer.php') ?>




</body>

</html>
