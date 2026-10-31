<?php require_once 'core/auth.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Car Dealing System</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php include 'core/userbar.php'; ?>
	<h1>Welcome To Car Dealing System. Add new Car Brands!</h1>
	<form action="core/handleForms.php" method="POST">
		<p>
			<label>Brand Name</label>
			<input type="text" name="brandName" required>
		</p>
		<p>
			<label>Country</label>
			<input type="text" name="country" required>
		</p>
		<p>
			<label>Founded Year</label>
			<input type="number" name="foundedYear" required>
		</p>
		<p>
			<label>Headquarters</label>
			<input type="text" name="headquarters" required>
			<input type="submit" name="insertBrandBtn" value="Add">
		</p>
	</form>

	<?php $getAllBrands = getAllBrands($pdo); ?>
	<?php foreach ($getAllBrands as $row) { ?>
	<div class="card">
		<h3>Brand: <?php echo e($row['brand_name']); ?></h3>
		<h3>Country: <?php echo e($row['country']); ?></h3>
		<h3>Founded Year: <?php echo e($row['founded_year']); ?></h3>
		<h3>Headquarters: <?php echo e($row['headquarters']); ?></h3>
		<h3>Date Added: <?php echo e($row['date_added']); ?></h3>
		<h3>Added By: <?php echo e($row['added_by_name']); ?></h3>
		<h3>Last Updated By: <?php echo e($row['updated_by_name']); ?></h3>
		<h3>Last Updated: <?php echo e($row['last_updated']); ?></h3>

		<div class="actions">
			<a href="viewmodels.php?brand_id=<?php echo $row['brand_id']; ?>">View Models</a>
			<a href="editbrand.php?brand_id=<?php echo $row['brand_id']; ?>">Edit</a>
			<a href="deletebrand.php?brand_id=<?php echo $row['brand_id']; ?>">Delete</a>
		</div>
	</div>
	<?php } ?>
</body>
</html>