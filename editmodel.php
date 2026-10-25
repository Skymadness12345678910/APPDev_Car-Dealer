<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<?php
$getModelByID = getModelByID($pdo, $_GET['model_id'] ?? 0);
if (!$getModelByID) {
	header("Location: index.php");
	exit;
}
$brandId = urlencode($_GET['brand_id'] ?? $getModelByID['brand_id']);
$modelId = urlencode($_GET['model_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Model</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<a href="viewmodels.php?brand_id=<?php echo $brandId; ?>">View The Models</a>
	<h1>Edit the model!</h1>
	<form action="core/handleForms.php?model_id=<?php echo $modelId; ?>&brand_id=<?php echo $brandId; ?>" method="POST">
		<p>
			<label>Model Name</label>
			<input type="text" name="modelName" value="<?php echo e($getModelByID['model_name']); ?>" required>
		</p>
		<p>
			<label>Body Type</label>
			<select name="bodyType">
				<?php foreach (['Sedan', 'SUV', 'Hatchback', 'Pickup', 'Van'] as $type) { ?>
					<option value="<?php echo $type; ?>" <?php if ($getModelByID['body_type'] == $type) echo 'selected'; ?>><?php echo $type; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label>Year Model</label>
			<input type="number" name="yearModel" min="1900" max="2100" value="<?php echo e($getModelByID['year_model']); ?>" required>
		</p>
		<p>
			<label>Color</label>
			<input type="text" name="color" value="<?php echo e($getModelByID['color']); ?>" required>
		</p>
		<p>
			<label>Transmission</label>
			<select name="transmission">
				<?php foreach (['Automatic', 'Manual'] as $t) { ?>
					<option value="<?php echo $t; ?>" <?php if ($getModelByID['transmission'] == $t) echo 'selected'; ?>><?php echo $t; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label>Fuel Type</label>
			<select name="fuelType">
				<?php foreach (['Gasoline', 'Diesel', 'Hybrid', 'Electric'] as $f) { ?>
					<option value="<?php echo $f; ?>" <?php if ($getModelByID['fuel_type'] == $f) echo 'selected'; ?>><?php echo $f; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label>Seating Capacity</label>
			<input type="number" name="seatingCapacity" min="1" value="<?php echo e($getModelByID['seating_capacity']); ?>" required>
		</p>
		<p>
			<label>Price</label>
			<input type="number" step="0.01" min="0" name="price" value="<?php echo e($getModelByID['price']); ?>" required>
		</p>
		<p>
			<label>Stock</label>
			<input type="number" min="0" name="stock" value="<?php echo e($getModelByID['stock']); ?>" required>
			<input type="submit" name="editModelBtn" value="Update">
		</p>
	</form>
</body>
</html>
