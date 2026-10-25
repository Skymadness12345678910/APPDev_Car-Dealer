<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<?php
$getBrandByID = getBrandByID($pdo, $_GET['brand_id'] ?? 0);
if (!$getBrandByID) {
	header("Location: index.php");
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Brand</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Are you sure you want to delete this brand?</h1>
	<p class="warning">Warning: all models under this brand will also be deleted.</p>
	<div class="card">
		<h2>Brand: <?php echo e($getBrandByID['brand_name']); ?></h2>
		<h2>Country: <?php echo e($getBrandByID['country']); ?></h2>
		<h2>Founded Year: <?php echo e($getBrandByID['founded_year']); ?></h2>
		<h2>Headquarters: <?php echo e($getBrandByID['headquarters']); ?></h2>
		<h2>Date Added: <?php echo e($getBrandByID['date_added']); ?></h2>

		<div class="actions">
			<form action="core/handleForms.php?brand_id=<?php echo urlencode($_GET['brand_id']); ?>" method="POST">
				<input type="submit" name="deleteBrandBtn" value="Delete">
			</form>
		</div>
	</div>
	<a href="index.php">Cancel</a>
</body>
</html>
