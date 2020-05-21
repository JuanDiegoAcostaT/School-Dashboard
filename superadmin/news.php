<?php include('../functions.php') ?>
<!------------------------------>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../styles/main.css">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet"> 
    <meta charset="UTF-8">
    <title>Super Admin</title>
</head>
<body>
    <?php   // Check if have access to this site
        if (isSuperAdmin()) {
            echo($_SESSION['user']['username']);
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

    
    <?php
        if(isset($_GET["action"])){
            if($_GET["action"]=="sort_asc"){
                $query = "SELECT * FROM news ORDER by date ASC";
            }else{
                $query = "SELECT * FROM news ORDER by date DESC";
            }
        }
        else{
            $query = "SELECT * FROM news ORDER by date ASC";
        }
        
        $result = mysqli_query($db, $query);
        

        print("<h2 class='title__news' >News</h2>");
        print("<div class='title__news'><a a class='btn__news' href='add_news.php' >Add news</a></div>");
        print("<div class='table__news'>");
            print("<table class='table__news--table' >
                    <thead class='table__thead'>
                        <tr>
                            <td class='eq'>ID</td>
                            <td class='eq'>Date <a style='color:white; text-decoration: none;' href='?action=sort_asc'> &#9650</a><a style='color:white; text-decoration: none;' href='?action=sort_desc'>&#9660 </a></td>
                            <td class='eq'>Title</td> <td class='eq'>Content</td>
                            <td class='eq'>Edit</td> <td class='eq'>Delete</td>
                        </tr>
                    </thead>");
			  
		while ($row = mysqli_fetch_assoc($result)) {

            $nID = $row['id'];          // News ID
			$pID = $row['publishedBy'];	// Publisher ID
			$title = $row['title'];
			$content = substr($row['content'], 0, 25) . "...";
            $date = date("d.m.Y. H:i", strtotime($row['date']));

            

			$query2 = "SELECT * FROM user WHERE id=" . $pID; // Find user data 
			$result2 = mysqli_query($db, $query2);
            $publisher = mysqli_fetch_assoc($result2);
            
                
                print("<tbody class='table__tbody'>");
                    print("<tr>");
                     print("<td>{$nID}</td> <td>{$date}</td> <td>{$title}</td> <td>{$content}</td><td>
                     <form class='td__btn--form' action='edit_news.php' method='POST'> <input type='hidden' name='id' value='{$row['id']}'> <input type='hidden' name='action' value='edit_news'> <input class='td__btn' type='submit' name='Submit' value='Edit'></form></td></td><td>
                     <form class='td__btn--delete--form' action='news.php' method='GET'> <input type='hidden' name='id' value='{$row['id']}'> <input class='td__btn' type='hidden' name='action' value='delete_news'> <input  class='td__btn--delete' type='submit' name='Submit' value='Delete'></form></td>");
                    print("</tr>");
                print("</tbody>");
        }
            print("</table>");
        print("</div>");
    ?>

    <br><br><br>
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