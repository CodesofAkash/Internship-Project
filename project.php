<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Internship CRUD Project</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
	<div class="">
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a class="nav-link" aria-current="page" href="http://localhost/internship/">Classwork</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="http://localhost/internship/project.php">Project</a>
			</li>
		</ul>
		<h1 class="page-header text-center fs-3 my-4">Restaurent Billing System</h1>
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="row">
					<?php
					if (isset($_SESSION['error'])) {
						echo
						"
					<div class='alert alert-danger alert-dismissible fade show text-center mx-auto' style='max-width: 500px;' role='alert'>
						" . $_SESSION['error'] . "
						<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
					</div>
					";
						unset($_SESSION['error']);
					}
					if (isset($_SESSION['success'])) {
						echo
						"
					<div class='alert alert-success alert-dismissible fade show text-center mx-auto' style='max-width: 500px;' role='alert'>
						" . $_SESSION['success'] . "
						<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
					</div>
					";
						unset($_SESSION['success']);
					}
					?>
				</div>
			</div>
		</div>



		<div class="album py-3 bg-light">
			<div class="container">
				<div class="row">



					<div class="col-md-4">
						<div class="card">
							<div class="card-body">
								<h3 class="card-title text-center">Menu</h3>
								<div class="row mtop10">
									<table id="myTable" class="table table-bordered table-striped">
										<thead>
											<th>Item ID</th>
											<th>Item Name</th>
											<th>Item Price</th>
										</thead>
										<tbody>
											<?php
											include_once('connection2.php');
											$sql = "SELECT * FROM menu";
											$menu;
											$query = $conn->query($sql);
											$i = 0;
											while ($row = $query->fetch_assoc()) {
												$menu[$i++] = $row['itemName'];
												echo
												"<tr>
									<td>" . $row['itemID'] . "</td>
									<td>" . $row['itemName'] . "</td>
									<td>" . $row['itemPrice'] . "</td>
								</tr>";
											}

											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>



					<div class="col-md-4">
						<div class="card">
							<div class="card-body">
								<h3 class="card-title text-center">Order Food</h3>
								<div class="container">
									<div class="row mb-4">
										<form action="add2.php" method="POST" class="d-flex flex-column align-items-center justify-content-start gap-2 mt-2">
											<select class="form-select" name="itemName" aria-label="Default select example">
												<option value="" disabled selected>Select food item</option>
												<?php
												if (isset($menu) && is_array($menu)) {
													foreach ($menu as $item) {
														echo "<option value=\"{$item}\">{$item}</option>";
													}
												}
												?>
											</select>
											<input type="number" name="quantity" class="form-control" placeholder="Quantity" aria-label="quantity">
											<button type="submit" class="btn btn-outline-info">Add</button>
										</form>
									</div>
									<div class="row">
										<table id="myTable" class="table table-bordered table-striped">
											<thead>
												<th>S. No.</th>
												<th>Item Name</th>
												<th>Item Price</th>
												<th>Quantity</th>
											</thead>
											<tbody>
												<?php
												include_once('connection2.php');
												$sql = "SELECT * FROM foodOrder";
												$query = $conn->query($sql);
												if($query->num_rows > 0) {
													while ($row = $query->fetch_assoc()) {
													echo
													"<tr>
														<td>" . $row['sNo'] . "</td>
														<td>" . $row['itemName'] . "</td>
														<td> ₹" . $row['itemPrice'] . "</td>
														<td>" . $row['quantity'] . "</td>
													</tr>";
													}
												} else {
													echo
													"<td colspan='4' class='text-center'>
														Add food items
													</td>";
												}

												?>
											</tbody>
										</table>
										<form class="d-flex justify-content-center" action="clear.php" method="POST">
											<button type="submit" class="btn btn-outline-danger my-2">Clear</button>
										</form>
										<hr class="border border-primary border-3 opacity-75">
										<form action="save.php" method="POST" class="d-flex flex-column align-items-center justify-content-start gap-2 my-2">
											<input type="text" name="fullName" class="form-control" placeholder="Full Name" aria-label="Username">
											<input type="number" name="phoneNumber" class="form-control" placeholder="Phone Number" aria-label="Username">
											<button type="submit" class="btn btn-outline-success">Save</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>



					<div class="col-md-4">
						<div class="card">
							<div class="card-body">
								<h3 class="card-title text-center">Thank you for your purchase</h3>
								<div class="row">
									<?php
									include_once('connection2.php');
									$sql = "SELECT * FROM bill";
									$query = $conn->query($sql);
									while ($row = $query->fetch_assoc()) {
										echo
										"<ul class='list-unstyled'>
																	<li class='text-black'>" . $row['fullName'] . "</li>
																	<li class='text-muted mt-1'><span class='text-black'>Phone Number : </span>" . $row['phoneNumber'] . "</li>
																	<li class='text-black mt-1'>" . $row['dateTime'] . "</li>
																</ul>";
									}
									?>

								</div>
								<div class="row">
									<table id="myTable" class="table table-bordered table-striped">
										<thead>
											<th>S. No.</th>
											<th>Item Name</th>
											<th>Item Price</th>
											<th>Quantity</th>
										</thead>
										<tbody>
											<?php
											include_once('connection2.php');
											$sql = "SELECT * FROM foodOrder";
											$total = 0;
											$query = $conn->query($sql);
											while ($row = $query->fetch_assoc()) {
												$total += $row['quantity'] * $row['itemPrice'];
												echo
												"<tr>
									<td>" . $row['sNo'] . "</td>
									<td>" . $row['itemName'] . "</td>
									<td> ₹" . $row['itemPrice'] . "</td>
									<td>" . $row['quantity'] . "</td>
								</tr>";
											}

											?>
										</tbody>
									</table>
								</div>

								<div class="row text-black">

									<div class="col-xl-12">
										<?php
										echo "<p class='float-end fw-bold'>Total: ₹$total </p>"
										?>
									</div>
								</div>
								<div class="d-flex flex-column justify-content-center align-items-center">
									<p class="text-center mt-4" style="font-size: 13px;">--- Thank you for visiting! ---</p>
									<p class="text-center" style="font-size: 12px; color: #888;">&copy; <?php echo date('Y'); ?> CodesOfAkash. All rights reserved.</p>
								</div>

								<div class="d-flex justify-content-center">
									<a href="print.php" class="btn btn-outline-success">Print PDF</a>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>