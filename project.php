<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Internship CRUD Project</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="datatable/dataTable.bootstrap.min.css">
	<style>
		.height10 {
			height: 10px;
		}

		.mtop10 {
			margin-top: 10px;
		}

		.modal-label {
			position: relative;
			top: 7px
		}

		.link {
			font-weight: 900;
			color: blue;
		}
		.boxContainer{
			display: flex;
			width: 80vw;
			height: 50vw;
			padding: 32px;
		}
		.box1 {
			height: 100%;
			width: 25%;
			border: 2px solid black;
			margin-right: 10px;
		}
		.box2 {
			height: 100%;
			width: 40%;
			border: 2px solid black;
			margin-right: 10px;
		}
		.box3 {
			height: 100%;
			width: 25%;
			border: 2px solid black;
			margin-right: 10px;
		}
	</style>
</head>

<body>
	<div class="container">
		<h1 class="page-header text-center">Restaurent Billing System</h1>
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="row">
					<?php
					if (isset($_SESSION['error'])) {
						echo
						"
					<div class='alert alert-danger text-center'>
						<button class='close'>&times;</button>
						" . $_SESSION['error'] . "
					</div>
					";
						unset($_SESSION['error']);
					}
					if (isset($_SESSION['success'])) {
						echo
						"
					<div class='alert alert-success text-center'>
						<button class='close'>&times;</button>
						" . $_SESSION['success'] . "
					</div>
					";
						unset($_SESSION['success']);
					}
					?>
				</div>
			</div>
		</div>
		<div class="boxContainer">
			<div class="box1">
					<h3 class="headings">Food Items</h3>
			</div>
			<div class="box2">
					<h3 class="headings">Order Food</h3>
			</div>
			<div class="box3">
					<h3 class="headings">Bill</h3>
			</div>
		</div>
	</div>
	<?php include('add_modal.php') ?>

	<script src="jquery/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="datatable/jquery.dataTables.min.js"></script>
	<script src="datatable/dataTable.bootstrap.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#myTable').DataTable();

			$(document).on('click', '.close', function() {
				$('.alert').hide();
			})
		});
	</script>
	<footer>
		<div class="PP">
			<p>Brought To You By:<a href="https://github.com/CodesofAkash"> CodesOfAkash</a> || <a class="link" href="http://localhost/internship"> Go back to class
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
					</svg>
				</a></p>
		</div>
	</footer>
	<style>
		.PP {
			text-align: center;
		}
	</style>
</body>

</html>