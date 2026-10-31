<?php require_once 'core/auth.php'; ?>
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
	<title>Delete Model</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php include 'core/userbar.php'; ?>
	<h1>Are you sure you want to delete this model?</h1>
	<div class="card">
		<h2>Model: <?php echo e($getModelByID['model_name']); ?></h2>
		<h2>Body Type: <?php echo e($getModelByID['body_type']); ?></h2>
		<h2>Year: <?php echo e($getModelByID['year_model']); ?></h2>
		<h2>Color: <?php echo e($getModelByID['color']); ?></h2>
		<h2>Transmission: <?php echo e($getModelByID['transmission']); ?></h2>
		<h2>Fuel Type: <?php echo e($getModelByID['fuel_type']); ?></h2>
		<h2>Seating Capacity: <?php echo e($getModelByID['seating_capacity']); ?></h2>
		<h2>Price: ₱<?php echo number_format($getModelByID['price'], 2); ?></h2>
		<h2>Stock: <?php echo e($getModelByID['stock']); ?></h2>
		<h2>Brand: <?php echo e($getModelByID['brand_name']); ?></h2>
		<h2>Date Added: <?php echo e($getModelByID['date_added']); ?></h2>

		<div class="actions">
			<form action="core/handleForms.php?model_id=<?php echo $modelId; ?>&brand_id=<?php echo $brandId; ?>" method="POST">
				<input type="submit" name="deleteModelBtn" value="Delete">
			</form>
		</div>
	</div>
	<a href="viewmodels.php?brand_id=<?php echo $brandId; ?>">Cancel</a>
</body>
</html>
