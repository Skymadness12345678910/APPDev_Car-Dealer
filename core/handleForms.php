<?php

session_start();

require_once 'dbConfig.php';
require_once 'models.php';

// only register and login can be used while logged out
if (!isset($_SESSION['user_id']) && !isset($_POST['registerBtn']) && !isset($_POST['loginBtn'])) {
	header("Location: ../login.php");
	exit;
}

// ----- BRAND: INSERT -----
if (isset($_POST['insertBrandBtn'])) {

	$query = insertBrand($pdo, $_POST['brandName'], $_POST['country'],
		$_POST['foundedYear'], $_POST['headquarters'], $_SESSION['user_id']);

	if ($query) {
		header("Location: ../index.php");
	}
	else {
		echo "Insertion failed";
	}
}

// ----- BRAND: UPDATE -----
if (isset($_POST['editBrandBtn'])) {

	$query = updateBrand($pdo, $_POST['brandName'], $_POST['country'],
		$_POST['foundedYear'], $_POST['headquarters'], $_SESSION['user_id'], $_GET['brand_id']);

	if ($query) {
		header("Location: ../index.php");
	}
	else {
		echo "Edit failed";
	}
}

// ----- BRAND: DELETE -----
if (isset($_POST['deleteBrandBtn'])) {

	$query = deleteBrand($pdo, $_GET['brand_id']);

	if ($query) {
		header("Location: ../index.php");
	}
	else {
		echo "Deletion failed";
	}
}

// ----- MODEL: INSERT -----
if (isset($_POST['insertModelBtn'])) {

	$query = insertModel($pdo, $_POST['modelName'], $_POST['bodyType'], $_POST['yearModel'],
		$_POST['color'], $_POST['transmission'], $_POST['fuelType'],
		$_POST['seatingCapacity'], $_POST['price'], $_POST['stock'],
		$_GET['brand_id'], $_SESSION['user_id']);

	if ($query) {
		header("Location: ../viewmodels.php?brand_id=" . $_GET['brand_id']);
		exit;
	}
	else {
		echo "Insertion failed";
	}
}

// ----- MODEL: UPDATE -----
if (isset($_POST['editModelBtn'])) {

	$query = updateModel($pdo, $_POST['modelName'], $_POST['bodyType'], $_POST['yearModel'],
		$_POST['color'], $_POST['transmission'], $_POST['fuelType'],
		$_POST['seatingCapacity'], $_POST['price'], $_POST['stock'],
		$_SESSION['user_id'], $_GET['model_id']);

	if ($query) {
		header("Location: ../viewmodels.php?brand_id=" . $_GET['brand_id']);
		exit;
	}
	else {
		echo "Update failed";
	}
}

// ----- MODEL: DELETE -----
if (isset($_POST['deleteModelBtn'])) {

	$query = deleteModel($pdo, $_GET['model_id']);

	if ($query) {
		header("Location: ../viewmodels.php?brand_id=" . $_GET['brand_id']);
		exit;
	}
	else {
		echo "Deletion failed";
	}
}

// ----- USER: REGISTER -----
if (isset($_POST['registerBtn'])) {

	$username = trim($_POST['username']);
	$password = $_POST['password'];
	$confirmPassword = $_POST['confirmPassword'];

	if ($password !== $confirmPassword) {
		$_SESSION['message'] = "Passwords do not match.";
		header("Location: ../register.php");
	}
	else if (strlen($password) < 6) {
		$_SESSION['message'] = "Password must be at least 6 characters.";
		header("Location: ../register.php");
	}
	else if (getUserByUsername($pdo, $username)) {
		$_SESSION['message'] = "Username is already taken.";
		header("Location: ../register.php");
	}
	else {
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

		$query = registerUser($pdo, trim($_POST['firstName']), trim($_POST['lastName']),
			trim($_POST['address']), $_POST['age'], $username, $hashedPassword);

		if ($query) {
			$_SESSION['message'] = "Registration successful! You can now log in.";
			$_SESSION['messageType'] = "success";
			header("Location: ../login.php");
		}
		else {
			$_SESSION['message'] = "Registration failed.";
			header("Location: ../register.php");
		}
	}
	exit;
}

// ----- USER: LOGIN -----
if (isset($_POST['loginBtn'])) {

	$user = getUserByUsername($pdo, trim($_POST['username']));

	if ($user && password_verify($_POST['password'], $user['password'])) {
		session_regenerate_id(true);
		$_SESSION['user_id'] = $user['user_id'];
		$_SESSION['username'] = $user['username'];
		$_SESSION['full_name'] = $user['first_name'] . " " . $user['last_name'];
		header("Location: ../index.php");
	}
	else {
		$_SESSION['message'] = "Invalid username or password.";
		header("Location: ../login.php");
	}
	exit;
}

?>