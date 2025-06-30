<?php
include 'inc/config.php';
include 'inc/auth.php';

define("TITLE", "Dashboard");
define("HEADER", "Dashboard");
define("BREADCRUMB", "home");

include('inc/head.php'); 
?>
<body>
<?php include('inc/header.php'); ?>

	<?php include('inc/aside.php'); ?>

	<main id="main" class="main">
	<?php include('inc/pagetitle.php'); ?>

		<section class="section dashboard">
			<div class="row">
				<div class="col-lg-8">
					<div class="row">

						<!-- Sales Card -->
						<div class="col-md-6">
							<div class="card info-card sales-card">

								<div class="card-body">
									<h5 class="card-title">Teachers</h5>

									<div class="d-flex align-items-center">
										<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
											<i class="bx bxs-graduation"></i>
										</div>
										<div class="ps-3">
											<h6><?= countRows('teachers')?></h6>
										</div>
									</div>
								</div>

							</div>
						</div>
						<div class="col-md-6">
							<div class="card info-card revenue-card">
								<div class="card-body">
									<h5 class="card-title">Students</h5>

									<div class="d-flex align-items-center">
										<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
											<i class="bi bi-people-fill"></i>
										</div>
										<div class="ps-3">
											<h6><?= countRows('students')?></h6>
										</div>
									</div>
								</div>

							</div>
						</div>

						
						<div class="col-md-6">

							<div class="card info-card parents-card">
								<div class="card-body">
									<h5 class="card-title">Parents</h5>

									<div class="d-flex align-items-center">
										<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
											<i class="bi bi-person-fill-check"></i>
										</div>
										<div class="ps-3">
											<h6><?= countRows('parents')?></h6>
										</div>
									</div>
								</div>
							</div>

						</div>
						
						<div class="col-md-6">

							<div class="card info-card staff-card">
								<div class="card-body">
									<h5 class="card-title">Staff</h5>

									<div class="d-flex align-items-center">
										<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
											<i class="bi bi-person-fill-gear"></i>
										</div>
										<div class="ps-3">
											<h6><?= countRows('parents')?></h6>
										</div>
									</div>
								</div>
							</div>

						</div>

					</div>
				</div>
				<div class="col-lg-4">
					<div class="row">
						<div class="col-lg-12">

<div class="card info-card customers-card">

	<div class="filter">
		<a class="icon" href="#" title="Go to attendance" data-bs-toggle="dropdown"><i class="bi bi-arrow-right"></i></a>
		<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
			<li class="dropdown-header text-start">
				<h6>Filter</h6>
			</li>

			<li><a class="dropdown-item" href="#">Today</a></li>
			<li><a class="dropdown-item" href="#">This Month</a></li>
			<li><a class="dropdown-item" href="#">This Year</a></li>
		</ul>
	</div>

	<div class="card-body">
		<h5 class="card-title">Todays attendance</h5>

		<div class="d-flex align-items-center">
			<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
				<i class="bi bi-bar-chart-fill"></i>
			</div>
			<div class="ps-3">
				<h6>0</h6>
				<span class="text-success small pt-1 fw-bold">0</span> <span class="text-muted small pt-2 ps-1">students are present for todays class</span>

			</div>
		</div>

	</div>
</div>

</div>
					</div>
				</div>
			</div>
		</section>

	</main>

	<?php include('inc/footer.php'); ?>
	<?php include('inc/foot.php'); ?>
