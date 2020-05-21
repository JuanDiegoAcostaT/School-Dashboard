<?php include('../functions.php') ?>
<!------------------------------>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet"> 
    <title>Mail sender</title>
</head>

<body>
    <?php
        if (isLoggedIn()) {
            echo($_SESSION['user']['username']);
        }
        
    ?>
    <?php   // Check if have access to this site
        if (isSuperAdmin()) {
            //header('location: superadmin/home.php');
        }
        else if(isAdmin()){
            //header('location: admin/home.php');
        }
        else if(isTeacher()){
            //header('location: teacher/home.php');
        }
        else if(isStudent()){
            //header('location: student/home.php');
        }
        else if(isUnknown()){
            //header('location: ../wait.php');
        }
        else {
            $_SESSION['msg'] = "You must log in first";
            header('location: ../login.php');
        }
    ?>

    <div class="header__Logo">
        <a href="http://www.ss-tehnicka-ck.skole.hr/"><img src="../images/header_logo.png" alt=""></a>
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
    
    </br></br>

    <div class="form__mail_sender--container">
         <form class="form__mail_sender" id="form" action="probno2.php" method="post">
            <?php global $errors; ?>
            <?php echo display_error(); ?>

            <label>To:</label>

            <input list="mail_admins" name="sendTo" id="sendTo">
            <datalist id="mail_admins">
            <?php mailList(); ?>
            <option value="leon.vlasic24@gmail.com">
            </datalist> </br>

            <label>Subject:</label>
            <input type="text" name="sendSubject"> <br>
            <label>Message:</label>
            <textarea id="message" name="sendMessage" rows="5" cols="33"></textarea> <br>

			<input class="btn__mail_sender" type="submit" value="Send" style="padding: 20px;" name="sending" id="sending">

        </form>
    </div>
    </br>

    <div class="frame">
        <div class="center">
            <div class="mail-window"></div>
            <svg viewBox="0 0 100 100" class="envelope">
                <polyline points="100,20 0,20 50,55 100,20" />
                <polyline points="0,20 0,80 100,80 100,20" />
			</svg>
        </div>
	</div>
	
  <p style="padding-left: 40%; padding-bottom : 2%" >Recharge the page for sending a new Email</p>

    <footer class="footer">
        <a class="footer__img" href="http://www.ss-tehnicka-ck.skole.hr/"><img src="../images/header_logo.png" alt=""></a>
        <div class="nav__footer">
            <ul>
                <li><a href="http://www.ss-tehnicka-ck.skole.hr/">Link to official site</a></li>
                <li><a href="../mail_sender/mail_sender.php">Mail sender</a></li>
                <li><a href="../calendar/3a-calendar.php">Calendar</a></li>
                <li><a href="home.php?logout1=1">Logout</a></li>
            </ul>
        </div>
    </footer>

   <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
   <script>
		$('#sending').click( function(event){
            $('form').submit(function (e) {
                var form = this;
                e.preventDefault();
                setTimeout(function () {
                    form.submit();
                }, 2000);
            });
            $('.frame').css("display" , "block")
			$('.mail-window').css("animation" , "shrink-1 4s linear forwards");
			$('svg').css("animation" , "hide-envelope 8s linear forwards");
		})

    </script>
    
    
</body>
</html>