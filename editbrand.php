<?php require_once 'core/auth.php'; ?>
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
	<title>Edit Brand</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php include 'core/userbar.php'; ?>
	<a href="index.php">Return to home</a>
	<h1>Edit the brand!</h1>
	<form action="core/handleForms.php?brand_id=<?php echo urlencode($_GET['brand_id']); ?>" method="POST">
		<p>
			<label>Brand Name</label>
			<input type="text" name="brandName" value="<?php echo e($getBrandByID['brand_name']); ?>" required>
		</p>
		<p>
			<label>Country</label>
			<input type="text" name="country" value="<?php echo e($getBrandByID['country']); ?>" required>
		</p>
		<p>
			<label>Founded Year</label>
			<input type="number" name="foundedYear" value="<?php echo e($getBrandByID['founded_year']); ?>" required>
		</p>
		<p>
			<label>Headquarters</label>
			<input type="text" name="headquarters" value="<?php echo e($getBrandByID['headquarters']); ?>" required>
			<input type="submit" name="editBrandBtn" value="Update">
		</p>
	</form>
</body>
</html>
