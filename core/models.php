<?php

// Escape output for safe display in HTML
function e($value) {
	return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

// ================= BRANDS (PARENT) =================

function insertBrand($pdo, $brand_name, $country, $founded_year, $headquarters) {
	$sql = "INSERT INTO brands (brand_name, country, founded_year, headquarters) VALUES (?,?,?,?)";
	$stmt = $pdo->prepare($sql);
	return $stmt->execute([$brand_name, $country, $founded_year, $headquarters]);
}

function updateBrand($pdo, $brand_name, $country, $founded_year, $headquarters, $brand_id) {
	$sql = "UPDATE brands
			SET brand_name = ?,
				country = ?,
				founded_year = ?,
				headquarters = ?
			WHERE brand_id = ?";
	$stmt = $pdo->prepare($sql);
	return $stmt->execute([$brand_name, $country, $founded_year, $headquarters, $brand_id]);
}

function deleteBrand($pdo, $brand_id) {
	// Delete the brand's models first, then the brand, inside one transaction
	// so a failure never leaves half-deleted data.
	try {
		$pdo->beginTransaction();

		$deleteModels = $pdo->prepare("DELETE FROM car_models WHERE brand_id = ?");
		$deleteModels->execute([$brand_id]);

		$deleteBrand = $pdo->prepare("DELETE FROM brands WHERE brand_id = ?");
		$deleteBrand->execute([$brand_id]);

		$pdo->commit();
		return true;
	}
	catch (Exception $ex) {
		if ($pdo->inTransaction()) {
			$pdo->rollBack();
		}
		return false;
	}
}

function getAllBrands($pdo) {
	$sql = "SELECT * FROM brands ORDER BY brand_name";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll();
}

function getBrandByID($pdo, $brand_id) {
	$sql = "SELECT * FROM brands WHERE brand_id = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$brand_id]);
	return $stmt->fetch();
}


// ================= CAR MODELS (CHILD) =================

function getModelsByBrand($pdo, $brand_id) {
	$sql = "SELECT car_models.*, brands.brand_name AS brand_name
			FROM car_models
			JOIN brands ON car_models.brand_id = brands.brand_id
			WHERE car_models.brand_id = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$brand_id]);
	return $stmt->fetchAll();
}

function getModelByID($pdo, $model_id) {
	$sql = "SELECT car_models.*, brands.brand_name AS brand_name
			FROM car_models
			JOIN brands ON car_models.brand_id = brands.brand_id
			WHERE car_models.model_id = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$model_id]);
	return $stmt->fetch();
}

function insertModel($pdo, $model_name, $body_type, $year_model, $color, $transmission,
	$fuel_type, $seating_capacity, $price, $stock, $brand_id) {

	$sql = "INSERT INTO car_models (model_name, body_type, year_model, color, transmission,
			fuel_type, seating_capacity, price, stock, brand_id) VALUES (?,?,?,?,?,?,?,?,?,?)";
	$stmt = $pdo->prepare($sql);
	return $stmt->execute([$model_name, $body_type, $year_model, $color, $transmission,
		$fuel_type, $seating_capacity, $price, $stock, $brand_id]);
}

function updateModel($pdo, $model_name, $body_type, $year_model, $color, $transmission,
	$fuel_type, $seating_capacity, $price, $stock, $model_id) {

	$sql = "UPDATE car_models
			SET model_name = ?,
				body_type = ?,
				year_model = ?,
				color = ?,
				transmission = ?,
				fuel_type = ?,
				seating_capacity = ?,
				price = ?,
				stock = ?
			WHERE model_id = ?";
	$stmt = $pdo->prepare($sql);
	return $stmt->execute([$model_name, $body_type, $year_model, $color, $transmission,
		$fuel_type, $seating_capacity, $price, $stock, $model_id]);
}

function deleteModel($pdo, $model_id) {
	$sql = "DELETE FROM car_models WHERE model_id = ?";
	$stmt = $pdo->prepare($sql);
	return $stmt->execute([$model_id]);
}

?>
