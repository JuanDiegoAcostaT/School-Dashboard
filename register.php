<?php include('functions.php') ?>
<!------------------------------>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="./styles/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">  
    <meta charset="UTF-8">
	<title>Register</title>
</head>
<body>

    <div class="header__Logo">
        <a href="http://www.ss-tehnicka-ck.skole.hr/"><img src="./images/header_logo.png" alt=""></a>
            <div class="header__username">
                <?php
                    if (isLoggedIn()) {
                     echo $_SESSION['user']['username'] ;
                    }
                ?>
            </div>
    </div>

    <header class="header">
        <div class="nav">
            <ul>
                <?php if(!isLoggedIn()) { echo ("<li class='btn__header'><a  href='login.php'>Login</a></li>"); } ?>         <!-- Show login only if isn't loged in -->
                <?php if(!isLoggedIn()) { echo ("<li class='btn__header'><a  href='register.php'>Register</a></li>"); } ?>   <!-- Show Register only if isn't loged in -->
                <li class="btn__header"><a href="mail_sender/mail_sender.php">Mail sender</a></li>
                <li class="btn__header"><a href="calendar/3a-calendar.php">Calendar</a></li>
                <?php if(isLoggedIn()) { echo (" <li  class='btn__header'><a href='index.php?logout='1' >Logout</a></li> "); } ?>
            </ul>
        </div>
    </header>


	<h2 class="h2__register" >Register</h2>

	<div class="form__register--container">
	    <form class="form__register" method="post" action="register.php">
            <?php echo display_error(); ?>

            <label>Username</label>
            <input type="text" name="username" value="<?php echo $username; ?>"> <br>

            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>"> <br>

            <label>Password</label>
            <input type="password" name="password_1"> <br>


            <label>Confirm password</label>
            <input type="password" name="password_2"> <br>

            <button class="btn__register" type="submit" class="btn" name="register_btn">Register</button>

            <p> Already a member? <a href="login.php">Sign in</a></p>
	
        </form>
	</div>

    <footer class="footer">
        <a class="footer__img" href="http://www.ss-tehnicka-ck.skole.hr/"><img src="./images/header_logo.png" alt=""></a>
        <div class="nav__footer">
            <ul>
                <li ><a  href="http://www.ss-tehnicka-ck.skole.hr/">Link to official site</a></li>
                <?php if(!isLoggedIn()) { echo ("<li ><a  href='login.php'>Login</a></li>"); } ?>         <!-- Show login only if isn't loged in -->
                <?php if(!isLoggedIn()) { echo ("<li ><a  href='register.php'>Register</a></li>"); } ?>   <!-- Show Register only if isn't loged in -->
                <li ><a href="mail_sender/mail_sender.php">Mail sender</a></li>
                <li "><a  href="calendar/3a-calendar.php">Calendar</a></li>
                <?php if(isLoggedIn()) { echo (" <li  ><a ' href='index.php?logout='1'' >Logout</a></li> "); } ?>
            </ul>
        </div>
    </footer>

</body>
</html>