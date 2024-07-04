<?php include "header.php";


if (isset($_SESSION['do'])) {

    $do = $_SESSION['do'];

    echo "<script>";
    echo " Swal.fire({";
    echo "  title: 'Success!',";
    echo "  text: '$do',";
    echo "  icon: 'success',";
    echo "  imageUrl: 'https://unsplash.it/400/200',";
    echo "  imageWidth: 400,";
    echo "  imageHeight: 200,";
    echo "  imageAlt: 'Custom image',";
    echo "  })";
    echo " </script>";
    unset($_SESSION['do']);
  }

  if (isset($_SESSION['error'])) {

    echo   $error = $_SESSION['error'];
    echo "<script>";
    echo " Swal.fire({";
    echo "  title: 'Error!',";
    echo "  text: '$error',";
    echo "  icon: 'error',";
    echo "  imageUrl: 'https://unsplash.it/400/200',";
    echo "  imageWidth: 400,";
    echo "  imageHeight: 200,";
    echo "  imageAlt: 'Custom image',";
    echo "  })";
    echo " </script>";
    unset($_SESSION['error']);
  }

?>





<div class="pagetitle">
    <h1><i class="bi bi-unlock-fill"></i> Login to access </h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Login</li>
        </ol>
    </nav>
</div><!-- End Page Title -->








<section class="section dashboard">



    <div class="col-lg-12">
        <div class="row justify-content-md-center">


      
                <div class="col-xxl-6 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-unlock-fill"></i> Login to access </h5>

                            <form class="needs-validation" novalidate method="post" action="check_login.php">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="username" class="form-label"> Username </label>
                                            <input name="username" type="text" class="form-control" placeholder="Username" required>
                                            <div class="invalid-feedback"> Please enter Username </div>
                                        </div>
                                    </div>
                                    <br>
                                    <p></p>
                                    <!--  pattern="([1-9])+(?:-?\d){9,}" -->
                                    <br>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="password" class="form-label"> Password </label>
                                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                                            <div class="invalid-feedback"> Please enter password </div>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button type="submit" class="btn btn-info">Submit</button>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
        </div>
        







    </div>
    </div>




</section>



<?php include "footer.php"; ?>