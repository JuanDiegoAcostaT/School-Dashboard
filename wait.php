<?php include('functions.php') ?>
<!------------------------------>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./styles/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet"> 
    <title>Wait, is not your time yet</title>
</head>
<body>
    <?php   // Check if have access to this site
        if (isSuperAdmin()) {
            header('location: superadmin/home.php');
        }
        else if(isAdmin()){
            header('location: admin/home.php');
        }
        else if(isTeacher()){
            header('location: teacher/home.php');
        }
        else if(isStudent()){
            header('location: student/home.php');
        }
        else if(isUnknown()){
            
        }
        else {
            $_SESSION['msg'] = "You must log in first";
            header('location: login.php');
        }
    ?>
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


    <section class="wait__main">
        <p class="wait__ads" >Sorry but no one has verified your account yet</p>
        <p>If you have a trouble with this, please contact admin through mail sender.</p>
        <a class="btn__email" href="mail_sender/mail_sender.php">Send e-mail</a>
    </section>

    
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