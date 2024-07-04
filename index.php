<?php include "header.php";?>


<div class="pagetitle">
    <h1> หน้าหลัก </h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">หน้าหลัก</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div><!-- End Page Title -->




<section class="section dashboard">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Datatables  </h5>


											<?php
											include "config.inc.php";
											$sql = "SHOW TABLES FROM db_project_vaccine";
											$query = $conn->query($sql);
											while ($result = $query->fetch_assoc())
											{
											$Tables = $result["Tables_in_db_project_vaccine"];

											echo  $Tables;
											echo  "<br>";
											}

											?>


			</div>
		</div>
	</div>
</section>






<?php include "footer.php";?>
