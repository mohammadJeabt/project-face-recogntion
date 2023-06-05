<?php
$error_message = ""; // initialize error message variable

// check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];


    // connect to the database
    $servername = 'localhost';
    $dbusername = 'adanmw_user';
    $dbpassword = 'adan@mw123';
    $dbname = 'adanmw_dt';

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // check if connection was successful
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // query the database for the user
    $sql = "SELECT * FROM login WHERE username='$username'";

    $result = $conn->query($sql);

    // check if the user exists
    if ($result->num_rows == 0) {
        $error_messages['username'] = 'שם משתמש שגוי';
    } else {
        $row = $result->fetch_assoc();

        // check if the password is correct
        if ($row['password'] != $password) {
            $error_messages['password'] = 'סיסמה שגויה';
        } else {
            // successful login, redirect to main page
            header('Location: files/Home.html');
            exit();
        }
    }

    // close the database connection
    $conn->close();
}


?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title> LogIn </title>
        
        <!-- font awesome cdn link -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;400;500&family=Roboto:wght@100;300;400;500&display=swap" rel="stylesheet">
  
        <!-- custom css file link -->
        <link rel="stylesheet" type="text/css" href="css/style.css">

	</head>
    <body dir="rtl">

		<!-- header section starts -->
		<header>
			<img src="images/logo.png" alt="" height="40px">
            <h1>התחברות למערכת נוכחות</h1>
			
			
		</header>
		<!-- header section ends -->

		<main>
            
            <!-- LogIn section starts -->
            <section class="LogIn">
				<div class="content">
					<div class="box">
                        <span class="borderLine"></span>
                        <form action="login.php" method="POST" >
                            <h2>התחברות</h2>
                            <div class="inputBox">
                                <input type="text" name="username" required="required">
                                <span>שם משתמש</span>
                                <i></i>
                            </div> 
                             
                            <span class="error"><?php echo $error_messages['username']; ?></span><br>
                      
                            <div class="inputBox">
                                <input type="password" name="password" required="required">
                                <span>סיסמה</span>
                                <i></i>
                            </div>
                           
                            <span class="error"><?php echo $error_messages['password']; ?></span><br>
                           
                            <input type="submit" name="submit" value="Login">
                        </form>
                    </div>
                </div>
				
				<div class="image">
					<img src="../images/camera_img.png" alt="">	
				</div>
			</section>	
			
			<!-- LogIn section ends -->

        </main>

        <!-- footer section starts -->
		<footer>
				<div class="box-container">
					<div class="box1">
						<h1> <span>smart</span>Tracker</h1>
                        <p>המערכת תוכננה כדי להקל את תהליך ניהול הנוכחות בכיתות ובכנסים, ולעקוב אחר הנוכחות של הסטודנטים באופן יעיל ומקיף.</p>
                        <p>בכך, המערכת מאפשרת לך לחסוך זמן ומשאבים ולהגדיל את האמינות והמדידה של נוכחות הסטודנטים והמידע הקשור לכך.</p>
					</div>

					<div class="box1">
						<h1><span>contact</span> us</h1>	
						<p><i class="fas fa-phone"></i>0541234567</p>
						<p><i class="fas fa-envelope"></i>example@gmail.com</p>
						<p><i class="fas fa-map-marker-alt"></i>tel aviv,israel - xxxxxx</p>
					</div>
					
					
				</div>	
				<h1 class="creat"> created by <span> adan & mohammad & hamoudy </span> | all rights reserved</h1>
		</footer>
        <!-- footer section ends -->
        <?php
	if (!empty($error_message)) {
		echo '<p>' . $error_message . '</p>';
	}
	?>
	</body>
</html>		