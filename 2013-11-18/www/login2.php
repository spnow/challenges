<?php
require_once('ua.php');
session_start();
$info = (object)array();
$info->username = "login2";
$info->password = "61Ux3zZHicdr9FR";
$info->database = "login2";
$info->level	= "login2";
$error = "";
if(isset($_POST['username']) && isset($_POST['password'])) {
	$link = mysql_connect("127.0.0.1", $info->username, $info->password);
	mysql_select_db($info->database, $link);

	$result = mysql_query('SELECT * FROM users WHERE username = \'' . $_POST['username'] . '\'');
	if(mysql_num_rows($result) != 0) {
		$errorContent = '';
		while(($user = mysql_fetch_assoc($result))) {
			if($user['password'] == sha1($_POST['password'])) {
				$_SESSION[$info->level] = true;	
				break;
			}
			$errorContent .= 'Wrong password for ' . htmlspecialchars($user['username'], ENT_QUOTES) . '.<br />';
		}
		$error = '<div class="error">' . $errorContent . '</div>';
	} else {
		$error = '<div class="error">Wrong username / password.</div>';
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Login 2</title>	
	</head>
	<body>
		<style type="text/css">
			body {
				background-color: black;
			}	
			
			section {
				margin: auto;
				margin-top: 50px;				
				width: 533px;
				height: 310px;
				background-image: url(login.png);
				box-shadow: 0 0 10px white;
				border-radius: 5px;
				text-align: center;
			}	

			section .title {
				color: white;
				margin-left: 20px;
				padding-top: 20px;
				font-size: 0.50cm;
				font-weight: bold;			
			}

			.error {
				background-color: #950909;
				border: 3px solid #DB0000;
				padding: 7px;
				color: white;
				width: 500px;
				margin: auto;
				margin-top: 20px;
				text-align: center;
			}	

			section form {
				text-align: center;
				margin: auto;
				margin-top: 70px;
				width: 400px;
			}

			section form input {
				margin-bottom: 10px;
				padding: 7px;
				width: 350px;
			}
			
			section footer {
				margin-top: 25px;
				color: white;
				font-size: 0.3cm;
			}

			.flag {
				color: #65be00;
				width: 400px;
				margin: auto;
				margin-top: 50px;
				text-align: center;
			}
		</style>
		<?php if(isset($_SESSION[$info->level])) {
			echo '<div class="flag">FLAG-wlez73yxtkae9mpr8aerqay7or</div>';
		} else { ?>	
		<section>
			<div class="title">
			Login portal 2			
			</div>
			<form action="" method="post">
				<input type="text" placeholder="Username" name="username">
				<input type="password" placeholder="Password" name="password">
				<input type="Submit" value="Login">
			</form>
			<footer>Hackfest &copy; 2013</footer>
		</section>
		<?php echo $error; ?>
		<?php } ?>
	</body>
</html>
