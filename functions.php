<?php 
	session_start();

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'school');

	// variable declaration
	$username = "";
	$email    = "";
	$errors   = array(); 

	// call the register() function if register_btn is clicked
	if (isset($_POST['register_btn'])) {
		register();
	}

	// call the login() function if login_btn is clicked
	if (isset($_POST['login_btn'])) {
		login();
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['user']);
		header("location: index.php");
	}

	if (isset($_GET['logout1'])) {
		session_destroy();
		unset($_SESSION['user']);
		header("location: ../login.php");
	}

	if (isset($_POST['edit_news_btn'])) {
		edit_news();
	}

	if (isset($_POST['addNews_btn'])) {
		addNews();
	}

	// REGISTER USER
	function register(){
		global $db, $errors;

		// receive all input values from the form
		$username    =  e($_POST['username']);
		$email       =  e($_POST['email']);
		$password_1  =  e($_POST['password_1']);
		$password_2  =  e($_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { 
			array_push($errors, "Username is required"); 
		}
		if (empty($email)) { 
			array_push($errors, "Email is required"); 
		}
		if (empty($password_1)) { 
			array_push($errors, "Password is required"); 
		}
		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		$sql_u = "SELECT * FROM user WHERE username='$username'";
		$sql_e = "SELECT * FROM user WHERE email='$email'";
		$res_u = mysqli_query($db, $sql_u);
		$res_e = mysqli_query($db, $sql_e);
		
		if (mysqli_num_rows($res_u) > 0) {
			array_push($errors, "Sorry... username already taken"); 	
		}else if(mysqli_num_rows($res_e) > 0){
			array_push($errors, "Sorry... email already taken"); 	
		}
		
		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database

			if (isset($_POST['user_type'])) {
				$user_type = e($_POST['user_type']);
				$query = "INSERT INTO user (username, email, user_type, password) 
						  VALUES('$username', '$email', '$user_type', '$password')";
				mysqli_query($db, $query);
				$_SESSION['success']  = "New user successfully created!!";
				header('location: home.php');
			}else{
				$query = "INSERT INTO user (username, email, user_type, password) 
						  VALUES('$username', '$email', 'unknown', '$password')";
				mysqli_query($db, $query);

				// get id of the created user
				$logged_in_user_id = mysqli_insert_id($db);

				$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
				$_SESSION['success']  = "You are now logged in";
				header('location: index.php');				
			}

		}

	}

	// return user array from their id
	function getUserById($id){
		global $db;
		$query = "SELECT * FROM user WHERE id=" . $id;
		$result = mysqli_query($db, $query);
		$user = mysqli_fetch_assoc($result);
		return $user;
	}

	// LOGIN USER
	function login(){
		global $db, $username, $errors;

		// grap form values
		$username = e($_POST['username']);
		$password = e($_POST['password']);

		// make sure form is filled properly
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		// attempt login if no errors on form
		if (count($errors) == 0) {
			$password = md5($password);

			$query = "SELECT * FROM user WHERE username='$username' AND password='$password' LIMIT 1";
			
            $results = mysqli_query($db, $query);
			if (mysqli_num_rows($results) == 1) { // user found
				// check if user is admin or user
				$logged_in_user = mysqli_fetch_assoc($results);
				if ($logged_in_user['user_type'] == 'superadmin') {

					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";
					header('location: superadmin/home.php');		  
				}else if ($logged_in_user['user_type'] == 'admin') {

					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";
					header('location: admin/home.php');		  
				}else{
					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";

					header('location: index.php');
				}
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

	function isLoggedIn()
	{
		if (isset($_SESSION['user'])) {
			return true;
		}else{
			return false;
		}
	}

	function isSuperAdmin()
	{
		if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'superadmin' ) {
			return true;
		}else{
			return false;
		}
	}

	function isAdmin()
	{
		if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
			return true;
		}else{
			return false;
		}
	}

	function isTeacher()
	{
		if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'teacher' ) {
			return true;
		}else{
			return false;
		}
	}

	function isStudent()
	{
		if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'student' ) {
			return true;
		}else{
			return false;
		}
	}

	function isUnknown()
	{
		if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'unknown' ) {
			return true;
		}else{
			return false;
		}
	}


	// escape string
	function e($val){
		global $db;
		return mysqli_real_escape_string($db, trim($val));
	}

	function display_error() {
		global $errors;

		if (count($errors) > 0){
			echo '<div class="error">';
				foreach ($errors as $error){
					echo $error .'<br>';
				}
			echo '</div>';
		}
	}

	function mailList(){
		global $db;
		$query = "SELECT email FROM user WHERE user_type = 'superadmin' OR user_type = 'admin'";
		$result = mysqli_query($db, $query);

		while ($row = mysqli_fetch_assoc($result)) {
			echo ('<option value="');
			echo $row['email'];
			echo ('">');
		}
	}

	function display_news() {	// Display news, the newest first
		global $db;
		$query = "SELECT * FROM news ORDER by date DESC";
		$result = mysqli_query($db, $query);


		while ($row = mysqli_fetch_assoc($result)) {

			$pID = $row['publishedBy'];	//publisher ID
			$title = $row['title'];
			$content = $row['content'];
			$date = strtotime($row['date']);

			$query2 = "SELECT * FROM user WHERE id=" . $pID; // Find user data 
			$result2 = mysqli_query($db, $query2);
			$publisher = mysqli_fetch_assoc($result2);
			
			echo ('<div class="carousel-item">');
			echo "<br><h3>$title</p>";
			echo "<div class='carousel__p'>";
			echo "<br><p>$content</p>";
			echo "</div>";
			echo ('<br>Publisher: ' . $publisher['username']);
			echo ('<br>Date: ' . date("d.m.Y. H:i", $date));
			echo ('</div>');
		}
	}

	function getNewsByID($nID, $what) {
		global $db;
		$query = "SELECT * FROM news WHERE id=$nID";
		$result = mysqli_query($db, $query);


		while ($row = mysqli_fetch_assoc($result)) {
			//$row = mysqli_fetch_assoc($result);

			$title = $row['title'];
			$content = $row['content'];
			//$date = strtotime($row['date']);

			if($what == "title"){
				return $title;
			}
			else if($what == "content"){
				return $content;
			}
			
			//echo ('<br>Date: ' . date("d.m.Y. H:i", $date));
		}
	}

	if(isset($_GET["action"]) && $_GET["action"]=="delete_news") {
		global $db;
		$id = $_GET["id"];
		
		if(!mysqli_connect_errno($db)) {
			$query = "DELETE FROM news WHERE id = $id"; 
			$results = mysqli_query($db, $query);
		} else {
			print(" Error, can not connect to database; " . mysqli_connect_error());
		}
	}

	function edit_news(){
		global $db;

		// receive all input values from the form
		$nID = e($_POST['newsID']);
		$title = e($_POST['title']);
		$content = e($_POST['content']);
		$editorsID = $_SESSION['user']['id'];
		

		if(!mysqli_connect_errno($db)) {
			$query = "UPDATE news SET title = '$title', content = '$content', editedBy =$editorsID  WHERE id = $nID;"; 
			echo($query);
			mysqli_query($db, $query);
		} else {
			print(" Error, can not connect to database; " . mysqli_connect_error());
		}

	}

	function addNews(){
		global $db;

		// receive all input values from the form
		$title = e($_POST['title']);
		$content = e($_POST['content']);
		$editorsID = $_SESSION['user']['id'];
		

		if(!mysqli_connect_errno($db)) {
			$query = "INSERT INTO news (title, content, publishedBy, editedBy) 
						VALUES('$title', '$content', '$editorsID', '$editorsID')";
			mysqli_query($db, $query);
			//print($query);
		} else {
			print(" Error, can not connect to database; " . mysqli_connect_error());
		}
	}
    

?>