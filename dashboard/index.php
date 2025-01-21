<?php
include("inc/config.php");

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
				<div class="col-lg-12">
					<div class="row">

						<!-- Sales Card -->
						<div class="col-xxl-4 col-md-6">
							<div class="card info-card sales-card">

								<div class="filter">
									<a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
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
									<h5 class="card-title">Position</h5>

									<div class="d-flex align-items-center">
										<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
											<i class="bx bx-trending-up"></i>
										</div>
										<div class="ps-3">
											<h6>14<sup>th</sup> </h6>
											<p class="text-muted">moved up<span class="text-success small pt-1 fw-bold mx-1">6</span>places</p>

										</div>
									</div>
								</div>

							</div>
						</div><!-- End Sales Card -->

						<!-- Revenue Card -->
						<div class="col-xxl-4 col-md-6">
							<div class="card info-card revenue-card">

								<div class="filter">
									<a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
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
									<h5 class="card-title">Class Total</h5>

									<div class="d-flex align-items-center">
										<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
											<i class="bi bi-people-fill"></i>
										</div>
										<div class="ps-3">
											<h6>56</h6>
											<span class="text-danger small pt-1 fw-bold">10%</span> <span class="text-muted small pt-2 ps-1">decrease</span>

										</div>
									</div>
								</div>

							</div>
						</div><!-- End Revenue Card -->

						<!-- Customers Card -->
						<div class="col-xxl-4 col-xl-12">

							<div class="card info-card customers-card">

								<div class="filter">
									<a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
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
									<h5 class="card-title">Average</h5>

									<div class="d-flex align-items-center">
										<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
											<i class="bi bi-bar-chart-fill"></i>
										</div>
										<div class="ps-3">
											<h6>78.43%</h6>
											<span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

										</div>
									</div>

								</div>
							</div>

						</div><!-- End Customers Card -->

					</div>
				</div>
				<div class="col-lg-12">    

<div class="card">
  <div class="card-body">
	<h5 class="card-title">2022/23 Session First Term Result</h5>

	<!-- Table with stripped rows -->
	<table class="table table-striped table-responsive">
	  <thead>
		<tr>
		  <th scope="col">#</th>
		  <th scope="col">Subjects</th>
		  <th scope="col">1<sup>st</sup> Term(20mks)</th>
		  <th scope="col">2<sup>nd</sup> Term(20mks)</th>
		  <th scope="col">3<sup>rd</sup> Term(20mks)</th>
		  <th scope="col">Exam (40mks)</th>
		  <th scope="col">Term Total</th>
		  <th scope="col">Class Average</th>
		  <th scope="col">Highest in Class</th>
		  <th scope="col">Lowest in Class</th>
		  <th scope="col">Position</th>
		  <th scope="col">Remark</th>
		  <th scope="col">Status</th>
		</tr>
	  </thead>
	  <tbody>
		<tr>
		  <th scope="row">1</th>
		  <td>Igbo language</td>
		  <td>19</td>
		  <td>16</td>
		  <td>18</td>
		  <td>35</td>
		  <td>88</td>
		  <td>76.56</td>
		</tr>
	  </tbody>
	</table>
	<!-- End Table with stripped rows -->

</div>
</div>
			</div>
		</section>

	</main>

	<?php include('inc/footer.php'); ?>
	<?php include('inc/foot.php'); ?>
