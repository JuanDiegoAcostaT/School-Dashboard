<?php include('functions.php') ?>
<!------------------------------>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./styles/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">    
    <title>Index</title>
</head>
<body>
    <?php
        if (isLoggedIn()) {
            echo $_SESSION['user']['username'] ;
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
            <!-- <h2>TŠČ - index site</h2> -->

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
    
    <section class="index__img">
        <div class="slider">
            <div class="slide_viewer">
                <div class="slide_group">
                    <div class="slide">
                    </div>
                    <div class="slide">
                    </div>
                    <div class="slide">
                    </div>
                    <div class="slide">
                    </div>
                    <div class="slide">
                    </div>
                    <div class="slide">
                    </div>
                    <div class="slide">
                    </div>
                    <div class="slide">
                    </div>
                    <div class="slide">
                    </div>
                </div>
            </div>
        </div>

        <div class="slide_buttons">
        </div>

            <div class="directional_nav">
                <div class="previous_btn" title="Previous">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="65px" height="65px" viewBox="-11 -11.5 65 66">
                    <g>
                        <g>
                        <path fill="#474544" d="M-10.5,22.118C-10.5,4.132,4.133-10.5,22.118-10.5S54.736,4.132,54.736,22.118
                            c0,17.985-14.633,32.618-32.618,32.618S-10.5,40.103-10.5,22.118z M-8.288,22.118c0,16.766,13.639,30.406,30.406,30.406 c16.765,0,30.405-13.641,30.405-30.406c0-16.766-13.641-30.406-30.405-30.406C5.35-8.288-8.288,5.352-8.288,22.118z"/>
                        <path fill="#474544" d="M25.43,33.243L14.628,22.429c-0.433-0.432-0.433-1.132,0-1.564L25.43,10.051c0.432-0.432,1.132-0.432,1.563,0	c0.431,0.431,0.431,1.132,0,1.564L16.972,21.647l10.021,10.035c0.432,0.433,0.432,1.134,0,1.564	c-0.215,0.218-0.498,0.323-0.78,0.323C25.929,33.569,25.646,33.464,25.43,33.243z"/>
                        </g>
                    </g>
                    </svg>
                </div>
                <div class="next_btn" title="Next">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="65px" height="65px" viewBox="-11 -11.5 65 66">
                    <g>
                        <g>
                        <path fill="#474544" d="M22.118,54.736C4.132,54.736-10.5,40.103-10.5,22.118C-10.5,4.132,4.132-10.5,22.118-10.5	c17.985,0,32.618,14.632,32.618,32.618C54.736,40.103,40.103,54.736,22.118,54.736z M22.118-8.288	c-16.765,0-30.406,13.64-30.406,30.406c0,16.766,13.641,30.406,30.406,30.406c16.768,0,30.406-13.641,30.406-30.406 C52.524,5.352,38.885-8.288,22.118-8.288z"/>
                        <path fill="#474544" d="M18.022,33.569c 0.282,0-0.566-0.105-0.781-0.323c-0.432-0.431-0.432-1.132,0-1.564l10.022-10.035 			L17.241,11.615c 0.431-0.432-0.431-1.133,0-1.564c0.432-0.432,1.132-0.432,1.564,0l10.803,10.814c0.433,0.432,0.433,1.132,0,1.564 L18.805,33.243C18.59,33.464,18.306,33.569,18.022,33.569z"/>
                        </g>
                    </g>
                    </svg>
                </div>
            </div>
        
    </section>
    
    <h3 class="news__title">School news</h3>
    

    <div class="grid-container">
        <section class="carousel">
            <div class="carousel__container">
                <?php display_news(); ?>
            </div>
        </section>
    </div>

    
    <footer class="footer">
        <a class="footer__img" href="http://www.ss-tehnicka-ck.skole.hr/"><img src="./images/header_logo.png" alt=""></a>
        <div class="nav__footer">
            <ul>
                <li><a href="http://www.ss-tehnicka-ck.skole.hr/">Link to official site</a></li>
                <?php if(!isLoggedIn()) { echo ("<li><a href='login.php'>Login</a></li>"); } ?>         <!-- Show login only if isn't loged in -->
                <?php if(!isLoggedIn()) { echo ("<li><a href='register.php'>Register</a></li>"); } ?>   <!-- Show Register only if isn't loged in -->
                <li><a href="mail_sender/mail_sender.php">Mail sender</a></li>
                <li><a href="calendar/3a-calendar.php">Calendar</a></li>
                <?php if(isLoggedIn()) { echo (" <li><a href='index.php?logout='1'>Logout</a></li>"); } ?>
            </ul>
        </div>
    </footer>


    <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
        <script>
                        $('.slider').each(function() {
            var $this = $(this);
            var $group = $this.find('.slide_group');
            var $slides = $this.find('.slide');
            var bulletArray = [];
            var currentIndex = 0;
            var timeout;
            
            function move(newIndex) {
                var animateLeft, slideLeft;
                
                advance();
                
                if ($group.is(':animated') || currentIndex === newIndex) {
                return;
                }
                
                bulletArray[currentIndex].removeClass('active');
                bulletArray[newIndex].addClass('active');
                
                if (newIndex > currentIndex) {
                slideLeft = '100%';
                animateLeft = '-100%';
                } else {
                slideLeft = '-100%';
                animateLeft = '100%';
                }
                
                $slides.eq(newIndex).css({
                display: 'block',
                left: slideLeft
                });
                $group.animate({
                left: animateLeft
                }, function() {
                $slides.eq(currentIndex).css({
                    display: 'none'
                });
                $slides.eq(newIndex).css({
                    left: 0
                });
                $group.css({
                    left: 0
                });
                currentIndex = newIndex;
                });
            }
            
            function advance() {
                clearTimeout(timeout);
                timeout = setTimeout(function() {
                if (currentIndex < ($slides.length - 1)) {
                    move(currentIndex + 1);
                } else {
                    move(0);
                }
                }, 4000);
            }
            
            $('.next_btn').on('click', function() {
                if (currentIndex < ($slides.length - 1)) {
                move(currentIndex + 1);
                } else {
                move(0);
                }
            });
            
            $('.previous_btn').on('click', function() {
                if (currentIndex !== 0) {
                move(currentIndex - 1);
                } else {
                move(3);
                }
            });
            
            $.each($slides, function(index) {
                var $button = $('<a class="slide_btn">&bull;</a>');
                
                if (index === currentIndex) {
                $button.addClass('active');
                }
                $button.on('click', function() {
                move(index);
                }).appendTo('.slide_buttons');
                bulletArray.push($button);
            });
            
            advance();
            });

        </script>

</body>
</html>