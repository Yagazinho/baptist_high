<div class="pagetitle d-flex px-3 py-1">
    <h1><?php
			if(defined("HEADER")){
				print HEADER;
			}
			else{
				print "Dashboard";
			}
				?></h1>
    <div class="mx-auto">
        <?php include('alerts.php');?>
    </div>
    <nav class="ms-auto">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $clientBase ?>"><i class="bi bi-house"></i></a></li>
            <li class="breadcrumb-item active">
                <?php 
               
               if(defined("BREADCRUMB")){
                   print BREADCRUMB;
               }
               else{
                   print "Dashboard";
               }
               ?></li>
        </ol>
    </nav>
</div><!-- End Page Title -->
