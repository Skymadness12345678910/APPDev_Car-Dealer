<?php

// helper: safely print text on a page
function e($value) {
	return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

// ================= USERS =================

function getUserByUsername($pdo, $username) {
	$sql = "SELECT * FROM users WHERE username = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$username]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function registerUser($pdo, $first_name, $last_name, $address, $age, $username, $password) {
	$sql = "INSERT INTO users (first_name, last_name, address, age, username, password) VALUES (?,?,?,?,?,?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$first_name, $last_name, $address, $age, $username, $password]);

	if ($executeQuery) {
		return true;
	}
}


// ================= BRANDS (PARENT) =================

function insertBrand($pdo, $brand_name, $country, $founded_year, $headquarters, $user_id) {
	$sql = "INSERT INTO brands (brand_name, country, founded_year, headquarters, added_by, last_updated_by)
			VALUES (?,?,?,?,?,?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$brand_name, $country, $founded_year, $headquarters, $user_id, $user_id]);

	if ($executeQuery) {
		return true;
	}
}

function updateBrand($pdo, $brand_name, $country, $founded_year, $headquarters, $user_id, $brand_id) {
	$sql = "UPDATE brands
			SET brand_name = ?,
				country = ?,
				founded_year = ?,
				headquarters = ?,
				last_updated_by = ?,
				last_updated = NOW()
			WHERE brand_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$brand_name, $country, $founded_year, $headquarters, $user_id, $brand_id]);

	if ($executeQuery) {
		return true;
	}
}

function deleteBrand($pdo, $brand_id) {
	// delete the models of the brand first
	$deleteModels = "DELETE FROM car_models WHERE brand_id = ?";
	$deleteStmt = $pdo->prepare($deleteModels);
	$executeDeleteQuery = $deleteStmt->execute([$brand_id]);

	if ($executeDeleteQuery) {
		$sql = "DELETE FROM brands WHERE brand_id = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$brand_id]);

		if ($executeQuery) {
			return true;
		}
	}
}

function getAllBrands($pdo) {
	$sql = "SELECT brands.*,
				CONCAT(adder.first_name, ' ', adder.last_name) AS added_by_name,
				CONCAT(updater.first_name, ' ', updater.last_name) AS updated_by_name
			FROM brands
			JOIN users AS adder ON brands.added_by = adder.user_id
			JOIN users AS updater ON brands.last_updated_by = updater.user_id";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getBrandByID($pdo, $brand_id) {
	$sql = "SELECT * FROM brands WHERE brand_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$brand_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}


// ================= CAR MODELS (CHILD) =================

function getModelsByBrand($pdo, $brand_id) {
	$sql = "SELECT car_models.*,
				brands.brand_name AS brand_name,
				CONCAT(adder.first_name, ' ', adder.last_name) AS added_by_name,
				CONCAT(updater.first_name, ' ', updater.last_name) AS updated_by_name
			FROM car_models
			JOIN brands ON car_models.brand_id = brands.brand_id
			JOIN users AS adder ON car_models.added_by = adder.user_id
			JOIN users AS updater ON car_models.last_updated_by = updater.user_id
			WHERE car_models.brand_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$brand_id]);

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getModelByID($pdo, $model_id) {
	$sql = "SELECT car_models.*,
				brands.brand_name AS brand_name,
				CONCAT(adder.first_name, ' ', adder.last_name) AS added_by_name,
				CONCAT(updater.first_name, ' ', updater.last_name) AS updated_by_name
			FROM car_models
			JOIN brands ON car_models.brand_id = brands.brand_id
			JOIN users AS adder ON car_models.added_by = adder.user_id
			JOIN users AS updater ON car_models.last_updated_by = updater.user_id
			WHERE car_models.model_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$model_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function insertModel($pdo, $model_name, $body_type, $year_model, $color, $transmission,
	$fuel_type, $seating_capacity, $price, $stock, $brand_id, $user_id) {

	$sql = "INSERT INTO car_models (model_name, body_type, year_model, color, transmission,
			fuel_type, seating_capacity, price, stock, brand_id, added_by, last_updated_by)
			VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$model_name, $body_type, $year_model, $color, $transmission,
		$fuel_type, $seating_capacity, $price, $stock, $brand_id, $user_id, $user_id]);

	if ($executeQuery) {
		return true;
	}
}

function updateModel($pdo, $model_name, $body_type, $year_model, $color, $transmission,
	$fuel_type, $seating_capacity, $price, $stock, $user_id, $model_id) {

	$sql = "UPDATE car_models
			SET model_name = ?,
				body_type = ?,
				year_model = ?,
				color = ?,
				transmission = ?,
				fuel_type = ?,
				seating_capacity = ?,
				price = ?,
				stock = ?,
				last_updated_by = ?,
				last_updated = NOW()
			WHERE model_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$model_name, $body_type, $year_model, $color, $transmission,
		$fuel_type, $seating_capacity, $price, $stock, $user_id, $model_id]);

	if ($executeQuery) {
		return true;
	}
}

function deleteModel($pdo, $model_id) {
	$sql = "DELETE FROM car_models WHERE model_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$model_id]);

	if ($executeQuery) {
		return true;
	}
}

?>