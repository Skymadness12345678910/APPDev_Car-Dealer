<?php require_once 'core/auth.php'; ?>
<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>View Models</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php include 'core/userbar.php'; ?>
	<a href="index.php">Return to home</a>
	<?php $getBrandByID = getBrandByID($pdo, $_GET['brand_id']); ?>
	<h1>Brand: <?php echo e($getBrandByID['brand_name']); ?> (<?php echo e($getBrandByID['country']); ?>)</h1>
	<h1>Add New Model</h1>
	<form action="core/handleForms.php?brand_id=<?php echo $_GET['brand_id']; ?>" method="POST">
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
			<input type="number" name="yearModel" required>
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
			<input type="number" name="seatingCapacity" required>
		</p>
		<p>
			<label>Price</label>
			<input type="number" step="0.01" name="price" required>
		</p>
		<p>
			<label>Stock</label>
			<input type="number" name="stock" required>
			<input type="submit" name="insertModelBtn" value="Add">
		</p>
	</form>

	<table>
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
	    <th>Added By</th>
	    <th>Last Updated By</th>
	    <th>Last Updated</th>
	    <th>Action</th>
	  </tr>
	  <?php $getModelsByBrand = getModelsByBrand($pdo, $_GET['brand_id']); ?>
	  <?php foreach ($getModelsByBrand as $row) { ?>
	  <tr>
	  	<td><?php echo $row['model_id']; ?></td>
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
	  	<td><?php echo e($row['added_by_name']); ?></td>
	  	<td><?php echo e($row['updated_by_name']); ?></td>
	  	<td><?php echo e($row['last_updated']); ?></td>
	  	<td>
	  		<a href="editmodel.php?model_id=<?php echo $row['model_id']; ?>&brand_id=<?php echo $_GET['brand_id']; ?>">Edit</a>
	  		<a href="deletemodel.php?model_id=<?php echo $row['model_id']; ?>&brand_id=<?php echo $_GET['brand_id']; ?>">Delete</a>
	  	</td>
	  </tr>
	  <?php } ?>
	</table>
</body>
</html>