<?php include('../functions.php') ?>
<!------------------------------>
<?php
// MONTHS
$months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

// DEFAULT MONTH/YEAR = TODAY
$unix = strtotime("today");
$monthNow = date("M", $unix);
$yearNow = date("Y", $unix); ?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="../styles/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">  
    <title>Simple PHP Calendar</title>
    <script src="public/3b-calendar.js"></script>
    <link href="public/3c-theme.css" rel="stylesheet">
  </head>
  <body>
    
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
	
    <br><br><br>
    <div class="calendar">
            <!-- [DATE SELECTOR] -->
        <div id="selector">
          <select id="month"><?php
            foreach ($months as $m) {
              printf("<option %svalue='%s'>%s</option>", 
                $m==$monthNow ? "selected='selected' " : "", $m, $m
              );
            }
          ?></select>
          <select id="year"><?php
            // 10 years range - change if not enough for you
            for ($y=$yearNow-10; $y<=$yearNow+10; $y++) {
              printf("<option %svalue='%s'>%s</option>",
                $y==$yearNow ? "selected='selected' " : "", $y, $y
              );
            }
          ?></select>
          <input type="button" value="SET" onclick="cal.list()"/>
        </div>

        <!-- [CALENDAR] -->
        <div id="container"></div>

        <!-- [EVENT] -->
        <div id="event"></div>

    </div>
    <br><br>
    <footer class="footer">
        <a class="footer__img" href="http://www.ss-tehnicka-ck.skole.hr/"><img src="../images/header_logo.png" alt=""></a>
        <div class="nav__footer">
            <ul>
                <li><a  href="http://www.ss-tehnicka-ck.skole.hr/">Link to official site</a></li>
                <?php if(!isLoggedIn()) { echo ("<li ><a  href='login.php'>Login</a></li>"); } ?>         <!-- Show login only if isn't loged in -->
                <?php if(!isLoggedIn()) { echo ("<li ><a  href='register.php'>Register</a></li>"); } ?>   <!-- Show Register only if isn't loged in -->
                <li><a href="mail_sender/mail_sender.php">Mail sender</a></li>
                <?php if(isLoggedIn()) { echo (" <li><a href='index.php?logout='1'>Logout</a></li> "); } ?>
            </ul>
        </div>
    </footer>

  </body>
</html>