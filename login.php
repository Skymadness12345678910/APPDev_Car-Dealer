<?php session_start(); ?>
<?php
// if already logged in, go to the homepage
if (isset($_SESSION['user_id'])) {
	header("Location: index.php");
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<div class="auth-box">
		<h1>Car Dealing System Login</h1>

		<?php if (isset($_SESSION['message'])) { ?>
			<p class="message <?php echo $_SESSION['messageType'] ?? ''; ?>"><?php echo $_SESSION['message']; ?></p>
			<?php unset($_SESSION['message']); unset($_SESSION['messageType']); ?>
		<?php } ?>

		<form action="core/handleForms.php" method="POST">
			<p>
				<label>Username</label>
				<input type="text" name="username" required>
			</p>
			<p>
				<label>Password</label>
				<input type="password" name="password" required>
			</p>
			<p>
				<input type="submit" name="loginBtn" value="Login">
			</p>
		</form>

		<p>No account yet? <a href="register.php">Register here</a></p>
	</div>
</body>
</html>