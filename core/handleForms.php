<?php

require_once 'dbConfig.php';
require_once 'models.php';

// ----- BRAND: INSERT -----
if (isset($_POST['insertBrandBtn'])) {

	$query = insertBrand($pdo, trim($_POST['brandName']), trim($_POST['country']),
		$_POST['foundedYear'], trim($_POST['headquarters']));

	if ($query) {
		header("Location: ../index.php");
		exit;
	}
	else {
		echo "Insertion failed";
	}
}

// ----- BRAND: UPDATE -----
if (isset($_POST['editBrandBtn'])) {

	$query = updateBrand($pdo, trim($_POST['brandName']), trim($_POST['country']),
		$_POST['foundedYear'], trim($_POST['headquarters']), $_GET['brand_id']);

	if ($query) {
		header("Location: ../index.php");
		exit;
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
		exit;
	}
	else {
		echo "Deletion failed";
	}
}

// ----- MODEL: INSERT -----
if (isset($_POST['insertModelBtn'])) {

	$query = insertModel($pdo, trim($_POST['modelName']), $_POST['bodyType'], $_POST['yearModel'],
		trim($_POST['color']), $_POST['transmission'], $_POST['fuelType'],
		$_POST['seatingCapacity'], $_POST['price'], $_POST['stock'], $_GET['brand_id']);

	if ($query) {
		header("Location: ../viewmodels.php?brand_id=" . urlencode($_GET['brand_id']));
		exit;
	}
	else {
		echo "Insertion failed";
	}
}

// ----- MODEL: UPDATE -----
if (isset($_POST['editModelBtn'])) {

	$query = updateModel($pdo, trim($_POST['modelName']), $_POST['bodyType'], $_POST['yearModel'],
		trim($_POST['color']), $_POST['transmission'], $_POST['fuelType'],
		$_POST['seatingCapacity'], $_POST['price'], $_POST['stock'], $_GET['model_id']);

	if ($query) {
		header("Location: ../viewmodels.php?brand_id=" . urlencode($_GET['brand_id']));
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
		header("Location: ../viewmodels.php?brand_id=" . urlencode($_GET['brand_id']));
		exit;
	}
	else {
		echo "Deletion failed";
	}
}

?>
