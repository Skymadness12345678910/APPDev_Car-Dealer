<?php
require_once 'core/auth.php';
require_once 'core/dbConfig.php';
require_once 'core/models.php';

$error = '';

// ----- HANDLE FORM SUBMISSION -----
if (isset($_POST['insertModelBtn'])) {

	$brandId = $_POST['brandId'] ?? '';

	if ($brandId === '' || !getBrandByID($pdo, $brandId)) {
		$error = 'Please choose a valid brand.';
	}
	else {
		$query = insertModel(
			$pdo,
			trim($_POST['modelName']),
			$_POST['bodyType'],
			$_POST['yearModel'],
			trim($_POST['color']),
			$_POST['transmission'],
			$_POST['fuelType'],
			$_POST['seatingCapacity'],
			$_POST['price'],
			$_POST['stock'],
			$brandId,
			$_SESSION['user_id']
		);

		if ($query) {
			header("Location: viewmodels.php?brand_id=" . urlencode($brandId));
			exit;
		}
		else {
			$error = 'Insertion failed. Please try again.';
		}
	}
}

$getAllBrands = getAllBrands($pdo);
$selectedBrand = $_POST['brandId'] ?? ($_GET['brand_id'] ?? '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add Car Model</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php include 'core/userbar.php'; ?>
	<a href="index.php">Return to home</a>
	<h1>Add New Car Model</h1>

	<?php if ($error !== '') { ?>
		<p class="warning"><?php echo e($error); ?></p>
	<?php } ?>

	<?php if (empty($getAllBrands)) { ?>
		<p class="warning">No brands yet. Please <a href="index.php">add a brand</a> first.</p>
	<?php } else { ?>
	<form action="insert.php" method="POST">
		<p>
			<label>Brand</label>
			<select name="brandId" required>
				<option value="">-- Select Brand --</option>
				<?php foreach ($getAllBrands as $brand) { ?>
					<option value="<?php echo e($brand['brand_id']); ?>"
						<?php if ($selectedBrand == $brand['brand_id']) echo 'selected'; ?>>
						<?php echo e($brand['brand_name']); ?>
					</option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label>Model Name</label>
			<input type="text" name="modelName" required>
		</p>
		<p>
			<label>Body Type</label>
			<select name="bodyType">
				<option value="Sedan">Sedan</option>
				<option value="SUV">SUV</option>
				<option value="Hatchback">Hatchback</option>
				<option value="Pickup">Pickup</option>
				<option value="Van">Van</option>
			</select>
		</p>
		<p>
			<label>Year Model</label>
			<input type="number" name="yearModel" min="1900" max="2100" required>
		</p>
		<p>
			<label>Color</label>
			<input type="text" name="color" required>
		</p>
		<p>
			<label>Transmission</label>
			<select name="transmission">
				<option value="Automatic">Automatic</option>
				<option value="Manual">Manual</option>
			</select>
		</p>
		<p>
			<label>Fuel Type</label>
			<select name="fuelType">
				<option value="Gasoline">Gasoline</option>
				<option value="Diesel">Diesel</option>
				<option value="Hybrid">Hybrid</option>
				<option value="Electric">Electric</option>
			</select>
		</p>
		<p>
			<label>Seating Capacity</label>
			<input type="number" name="seatingCapacity" min="1" required>
		</p>
		<p>
			<label>Price</label>
			<input type="number" step="0.01" min="0" name="price" required>
		</p>
		<p>
			<label>Stock</label>
			<input type="number" min="0" name="stock" required>
			<input type="submit" name="insertModelBtn" value="Add">
		</p>
	</form>
	<?php } ?>
</body>
</html>