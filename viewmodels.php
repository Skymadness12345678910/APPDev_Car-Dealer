<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<?php
$getBrandByID = getBrandByID($pdo, $_GET['brand_id'] ?? 0);
if (!$getBrandByID) {
	header("Location: index.php");
	exit;
}
$brandId = urlencode($_GET['brand_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>View Models</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<a href="index.php">Return to home</a>
	<h1>Brand: <?php echo e($getBrandByID['brand_name']); ?> (<?php echo e($getBrandByID['country']); ?>)</h1>
	<h1>Add New Model</h1>
	<form action="core/handleForms.php?brand_id=<?php echo $brandId; ?>" method="POST">
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

	<table style="width:100%; margin-top: 50px;">
	  <tr>
	    <th>ID</th>
	    <th>Model</th>
	    <th>Body Type</th>
	    <th>Year</th>
	    <th>Color</th>
	    <th>Transmission</th>
	    <th>Fuel</th>
	    <th>Seats</th>
	    <th>Price</th>
	    <th>Stock</th>
	    <th>Brand</th>
	    <th>Date Added</th>
	    <th>Action</th>
	  </tr>
	  <?php $getModelsByBrand = getModelsByBrand($pdo, $_GET['brand_id']); ?>
	  <?php foreach ($getModelsByBrand as $row) { ?>
	  <tr>
	  	<td><?php echo e($row['model_id']); ?></td>
	  	<td><?php echo e($row['model_name']); ?></td>
	  	<td><?php echo e($row['body_type']); ?></td>
	  	<td><?php echo e($row['year_model']); ?></td>
	  	<td><?php echo e($row['color']); ?></td>
	  	<td><?php echo e($row['transmission']); ?></td>
	  	<td><?php echo e($row['fuel_type']); ?></td>
	  	<td><?php echo e($row['seating_capacity']); ?></td>
	  	<td>₱<?php echo number_format($row['price'], 2); ?></td>
	  	<td><?php echo e($row['stock']); ?></td>
	  	<td><?php echo e($row['brand_name']); ?></td>
	  	<td><?php echo e($row['date_added']); ?></td>
	  	<td>
	  		<a href="editmodel.php?model_id=<?php echo urlencode($row['model_id']); ?>&brand_id=<?php echo $brandId; ?>">Edit</a>
	  		<a href="deletemodel.php?model_id=<?php echo urlencode($row['model_id']); ?>&brand_id=<?php echo $brandId; ?>">Delete</a>
	  	</td>
	  </tr>
	  <?php } ?>
	</table>
</body>
</html>
