<nav class="navbar navbar-expand-lg navbar-light bg-light " style="width:100vw; padding:0; background-color:linear-gradient(135deg, #004aad, #cb6ce6);" >
    <div class="container-fluid top-bar1 px-md-5 pt-1">

        <a href="/pollify/index.php">
            <div class="top-bar-title">
            <!-- <h1 style="font-family: 'ITC Bauhaus', sans-serif;"> Pollify </h1> -->
            <img src="/pollify/img/pollifysmall.png" height="60px" alt="logo">
            </div>
        </a>
        <?php
        if (!session_id()) {
            session_start();
        }
        if (isset($_SESSION['uid'])) {
            $login = 1;
        } else {
            $login = 0;
        }
        ?>
        <!-- <button class="navbar-toggler" style="background-color: white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> -->
        <div class='collapse navbar-collapse' id='navbarNav'>
            <div class='navigate'>
                <?php
                // show Login and register button for the Users not already logged in
                if ($login == 0) {
                    echo ("
                        <a href='register.php'>Register</a>
                        <a href='/pollify/login.php'>Login</a>
                   ");
                }
                ?>
                <?php
                // show Logout button for the Users already logged in
                if ($login == 1) {
                    echo ("
                        <a href='/pollify/polls/mypolls.php'>My Polls</a>
                        <a href='/pollify/user-profile.php'>My Profile</a>
                        <a href='/pollify/components/logoutprocess.php'>
                            <img src='/pollify/img/logout.png' height='40px' alt='Logout'>
                        </a>
                    ");
                }
                ?>
            </div>
        </div>
    </div>
    </div>

    
</nav>

<style>
/* body, h1, h2, h3, p, ul, li {
    margin: 0;
    padding: 0;
} */

body {
    font-family: 'ITC Bauhaus', sans-serif;
}

nav {
    width: 100vw;
    padding: 0;
    background: linear-gradient(135deg, #004aad, #cb6ce6);
    position: fixed;
    top: 0;
    z-index: 1000; /* Ensure it is above other elements */
}

.container-fluid {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 1rem;
}

.top-bar-title {
    text-decoration: none;
    color: white;
}

.top-bar-title img {
    height: 60px;
}

.navigate {
    display: flex;
}

.navigate a {
    color: white;
    text-decoration: none;
    margin-right: 1rem;
}

/* Responsive styles */
@media (max-width: 768px) {
    .container-fluid {
        flex-direction: column;
        align-items: flex-start;
    }

    .navigate {
        flex-direction: column;
        align-items: flex-start;
        margin-top: 1rem;
    }

    .navigate a {
        margin-right: 0;
        margin-bottom: 0.5rem; 
    }
}


</style>