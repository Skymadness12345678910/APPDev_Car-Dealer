<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<div class="auth-box">
		<h1>Create an Account</h1>

		<?php if (isset($_SESSION['message'])) { ?>
			<p class="message"><?php echo $_SESSION['message']; ?></p>
			<?php unset($_SESSION['message']); ?>
		<?php } ?>

		<form action="core/handleForms.php" method="POST">
			<p>
				<label>First Name</label>
				<input type="text" name="firstName" required>
			</p>
			<p>
				<label>Last Name</label>
				<input type="text" name="lastName" required>
			</p>
			<p>
				<label>Address</label>
				<input type="text" name="address" required>
			</p>
			<p>
				<label>Age</label>
				<input type="number" name="age" min="1" required>
			</p>
			<p>
				<label>Username</label>
				<input type="text" name="username" required>
			</p>
			<p>
				<label>Password</label>
				<input type="password" name="password" required>
			</p>
			<p>
				<label>Confirm Password</label>
				<input type="password" name="confirmPassword" required>
			</p>
			<p>
				<input type="submit" name="registerBtn" value="Register">
			</p>
		</form>

		<p>Already have an account? <a href="login.php">Login here</a></p>
	</div>
</body>
</html>