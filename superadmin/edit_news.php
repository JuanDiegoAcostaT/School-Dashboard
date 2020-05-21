<?php include('../functions.php') ?>
<!------------------------------>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../styles/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet"> 
    <meta charset="UTF-8">
    <title>Edit news</title>
</head>

<body>

<?php   // Check if have access to this site
        if (isSuperAdmin()) {
            echo("<i>It looks I'm in xD</i>");
        }
        else if(isAdmin()){
            header('location: ../admin/home.php');
        }
        else if(isTeacher()){
            header('location: ../teacher/home.php');
        }
        else if(isStudent()){
            header('location: ../student/home.php');
        }
        else if(isUnknown()){
            header('location: ../wait.php');
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

    <div class="drop__button">
     <button onclick="myFunction()" class="dropbtn" ><span id="togglebutton" class="icon-menu icon-cross">Menu</span></button>
    </div>

    <div class="dropdownMenu">

        <div id="myDropdown" class="dropdown-contentMenu fadeInDown">
            <div class="drop__container">
                <button class="dropbtnMenu"><a href="http://www.ss-tehnicka-ck.skole.hr/">Link to official site</a></button>
                <button class="dropbtnMenu"><a href="register.php">Register new user</a></button>
                <button class="dropbtnMenu"><a href="update.php">Update user data</a></button>
                <button class="dropbtnMenu__news"><a href="news.php">Show news</a></button> <!-- Make it with blue background -->
                <button class="dropbtnMenu"><a href="add_news.php">Add news</a></button>
                <button class="dropbtnMenu"><a href="../index.php">Index web</a></button>
                <button class="dropbtnMenu"><a href="home.php?logout1=1">Logout</a></button>
            </div>
        </div>
    </div>


    <div class="form__mail_sender--container">
        
        <form class="form__mail_sender" method="post" action="edit_news.php">
            <?php echo display_error(); ?>
            <?php 
                if (! isset($_POST["id"])){
                    header("Location: news.php");
                }
                $news_id = $_POST["id"];
                $old_title = getNewsByID($news_id, "title");
                $old_content = getNewsByID($news_id, "content");
            ?>


            <label>Title</label>
            <input type="text" name="title" placeholder="<?php echo($old_title); ?>"> <br>
            <label>Content</label>
            <textarea id="content" name="content" rows="5" cols="33" placeholder="<?php echo($old_content); ?>"></textarea> <br>

            <input type="hidden" name="newsID" value="<?php echo($news_id); ?>">
            <button class="btn__register" type="submit" name="edit_news_btn">Edit</button>

        
            </form>
    </div>

    <div class="home__link">
        <a  href="../index.php">Home</a>
    </div>

    <footer class="footer">
        <a class="footer__img" href="http://www.ss-tehnicka-ck.skole.hr/"><img src="../images/header_logo.png" alt=""></a>
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

        <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
        <script>

            $('#togglebutton').click(function() {
            $(this).toggleClass('icon-menu');
            });


            function myFunction() {
                document.getElementById("myDropdown").classList.toggle("show");
            }
            

            window.onclick = function(event) {
                if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                    }
                }
                }
            }
        </script>

</body>
</html>