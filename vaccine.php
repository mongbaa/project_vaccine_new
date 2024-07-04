<?php include "header.php";?>



<div class="pagetitle">
    <h1> วัคซีน </h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">หน้าหลัก</a></li>
            <li class="breadcrumb-item active">วัคซีน</li>
        </ol>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            เพิ่มข้อมูลวัคซีน
        </button>
    </nav>
</div><!-- End Page Title -->



                    <form method="post" class="row g-3 needs-validation" novalidate enctype="multipart/form-data">
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            เพิ่มข้อมูลวัคซีน
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="row g-3">

                                           <div class="col-md-12">
                                                <label for="validationCustomUsername" class="form-label"> รหัสวัคซีน</label>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="vaccine_no" class="form-control"
                                                        id="validationCustomUsername"
                                                        aria-describedby="inputGroupPrepend" required />
                                                    <div class="invalid-feedback">
                                                        กรุณากรอก รหัสวัคซีน
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <label for="validationCustomUsername" class="form-label"> ชื่อวัคซีน</label>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="vaccine_name" class="form-control"
                                                        id="validationCustomUsername"
                                                        aria-describedby="inputGroupPrepend" required />
                                                    <div class="invalid-feedback">
                                                        กรุณากรอก ชื่อวัคซีน
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <label for="validationCustomUsername" class="form-label">
                                                    รายละเอียด</label>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="vaccine_detail" class="form-control"
                                                        id="validationCustomUsername"
                                                        aria-describedby="inputGroupPrepend" required />
                                                    <div class="invalid-feedback">
                                                        กรุณากรอก รายละเอียด
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <label for="validationCustomUsername" class="form-label"> ช่วงอายุเริ่มต้น
                                                </label>
                                                <div class="input-group has-validation">
                                                    <input type="number" name="vaccine_age_start" class="form-control"
                                                        id="validationCustomUsername"
                                                        aria-describedby="inputGroupPrepend"   step="0.01" required />
                                                    <div class="invalid-feedback">
                                                        กรุณากรอก ช่วงอายุเริ่มต้น
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <label for="validationCustomUsername" class="form-label"> ช่วงอายุสิ้นสุด
                                                </label>
                                                <div class="input-group has-validation">
                                                    <input type="number" name="vaccine_age_end" class="form-control"
                                                        id="validationCustomUsername"
                                                        aria-describedby="inputGroupPrepend"   step="0.01"  required />
                                                    <div class="invalid-feedback">
                                                        กรุณากรอก ช่วงอายุสิ้นสุด
                                                    </div>
                                                </div>
                                            </div>





                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                        <button name="add_vaccine" class="btn btn-primary" type="submit"
                                            value="add_vaccine">
                                            Submit form
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <?php


    if(!empty($_POST['del_vaccine'])){

        $vaccine_id = $_POST['vaccine_id'];

        include "config.inc.php";
        if (isset($_POST['vaccine_id'])  && !empty($_POST['vaccine_id'])) {

        $sql_del = "DELETE FROM tbl_vaccine WHERE vaccine_id = $vaccine_id";
        $conn->query($sql_del);

        }
        $conn -> close();

        echo "<script type='text/javascript'>";
        echo "window.location='vaccine.php';";
        echo "</script>";
    }




  if(!empty($_POST['add_vaccine'])){

    include "config.inc.php";


    if (isset($_POST['vaccine_no'])  && !empty($_POST['vaccine_no'])) {
        $vaccine_no = $conn->real_escape_string($_POST['vaccine_no']);
    } else {
        $vaccine_no = '';
    }


    if (isset($_POST['vaccine_name'])  && !empty($_POST['vaccine_name'])) {
        $vaccine_name = $conn->real_escape_string($_POST['vaccine_name']);
    } else {
        $vaccine_name = '';
    }

    if (isset($_POST['vaccine_detail'])  && !empty($_POST['vaccine_detail'])) {
        $vaccine_detail = $conn->real_escape_string($_POST['vaccine_detail']);
    } else {
        $vaccine_detail = '';
    }

    if (isset($_POST['vaccine_age_start'])  && !empty($_POST['vaccine_age_start'])) {
        $vaccine_age_start = $conn->real_escape_string($_POST['vaccine_age_start']);
    } else {
        $vaccine_age_start = '';
    }

    if (isset($_POST['vaccine_age_end'])  && !empty($_POST['vaccine_age_end'])) {
        $vaccine_age_end = $conn->real_escape_string($_POST['vaccine_age_end']);
    } else {
        $vaccine_age_end = '';
    }

    $vaccine_status = 1;


    if (isset($_POST['vaccine_id'])  && !empty($_POST['vaccine_id'])) {

        $vaccine_id = $_POST['vaccine_id'];


        $sql_update = "UPDATE tbl_vaccine SET
                        vaccine_no = '$vaccine_no',
                        vaccine_name = '$vaccine_name',
                        vaccine_detail = '$vaccine_detail',
                        vaccine_age_start = '$vaccine_age_start',
                        vaccine_age_end = '$vaccine_age_end',
                        vaccine_status = '$vaccine_status'
                        WHERE tbl_vaccine.vaccine_id = $vaccine_id";
        $conn->query($sql_update);

    }else{


        $sql_in = "INSERT INTO tbl_vaccine  (vaccine_id, vaccine_no, vaccine_name, vaccine_detail, vaccine_age_start, vaccine_age_end,  vaccine_status)
                                     VALUES (null, '$vaccine_no', '$vaccine_name', '$vaccine_detail', '$vaccine_age_start', '$vaccine_age_end', '$vaccine_status' )";
        $conn->query($sql_in);



    }

 


    $conn -> close();


    echo "<script type='text/javascript'>";
    echo "window.location='vaccine.php';";
    echo "</script>";



  }

  ?>



                    <br>
<section class="section dashboard">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Datatables Vaccine </h5>
                                    <div class="table-responsive">
                                        <table name="myTable" id="myTable" class="table align-middle table-hover m-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ลำดับที่</th>
                                                    <th scope="col">รหัสวัคซีน </th>
                                                    <th scope="col">ชื่อวัคซีน</th>
                                                    <th scope="col">ช่วงอายุเริ่มต้น </th>
                                                    <th scope="col">ช่วงอายุสิ้นสุด</th>
                                                    <th scope="col">จัดการข้อมูล</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                        include "config.inc.php";
                                        $sql = "SELECT * FROM tbl_vaccine ORDER BY vaccine_id DESC ";
                                        $query = $conn->query($sql);
                                        $i = 0;
                                        while ($result = $query->fetch_assoc()) {
                                        $i++;
                                        $vaccine_id = $result['vaccine_id'];
                                        ?>

                                                <tr>
                                                    <td> <?php echo $i;?> </td>
                                                    <td><?php echo $result['vaccine_no'];?></td>
                                                    <td><?php echo $result['vaccine_name'];?>
                                                        <?php echo $result['vaccine_detail'];?></td>
                                                    <td><?php echo $result['vaccine_age_start'];?></td>
                                                    <td><?php echo $result['vaccine_age_end'];?></td>
                                                    <td>

                                                        <button type="button" class="btn btn-info btn-sm"
                                                            data-bs-toggle="modal" data-bs-target="#EditModal<?php echo $vaccine_id;?>">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>

                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-bs-toggle="modal" data-bs-target="#DelModal<?php echo $vaccine_id;?>">
                                                            <i class="bi bi-trash"></i>
                                                        </button>

                                                    </td>
                                                </tr>




                                                    <div class="modal fade" id="EditModal<?php echo $vaccine_id;?>" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="exampleModalLabel">
                                                                        แก้ไขข้อมูลวัคซีน <?php echo $vaccine_id;?>
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <form name="Edit<?php echo $vaccine_id;?>" method="post" class="row g-3 needs-validation" novalidate  enctype="multipart/form-data">

                                                                <div class="modal-body">

                                                                <input name="vaccine_id" type="hidden" value="<?php echo $result['vaccine_id']; ?>" />
                                                                    <div class="row g-3">


                                                                        <div class="col-md-12">
                                                                            <label
                                                                                for="validationCustomUsername"
                                                                                class="form-label"> รหัสวัคซีน</label>
                                                                            <div
                                                                                class="input-group has-validation">
                                                                                <input type="text"
                                                                                    name="vaccine_no"
                                                                                    class="form-control"
                                                                                    id="validationCustomUsername"
                                                                                    aria-describedby="inputGroupPrepend"
                                                                                    value = "<?php echo $result['vaccine_no'];?>"
                                                                                    required />
                                                                                <div class="invalid-feedback">
                                                                                    กรุณากรอก รหัสวัคซีน
                                                                                </div>
                                                                            </div>
                                                                        </div>



                                                                        <div class="col-md-12">
                                                                            <label
                                                                                for="validationCustomUsername"
                                                                                class="form-label"> ชื่อวัคซีน</label>
                                                                            <div
                                                                                class="input-group has-validation">
                                                                                <input type="text"
                                                                                    name="vaccine_name"
                                                                                    class="form-control"
                                                                                    id="validationCustomUsername"
                                                                                    aria-describedby="inputGroupPrepend"
                                                                                    value = "<?php echo $result['vaccine_name'];?>"
                                                                                    required />
                                                                                <div class="invalid-feedback">
                                                                                    กรุณากรอก ชื่อวัคซีน
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <label
                                                                                for="validationCustomUsername"
                                                                                class="form-label">
                                                                                รายละเอียด</label>
                                                                            <div
                                                                                class="input-group has-validation">
                                                                                <input type="text"
                                                                                    name="vaccine_detail"
                                                                                    class="form-control"
                                                                                    id="validationCustomUsername"
                                                                                    aria-describedby="inputGroupPrepend"
                                                                                    value = "<?php echo $result['vaccine_detail'];?>"
                                                                                    required />
                                                                                <div class="invalid-feedback">
                                                                                    กรุณากรอก รายละเอียด
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <label
                                                                                for="validationCustomUsername"
                                                                                class="form-label"> ช่วงอายุเริ่มต้น
                                                                            </label>
                                                                            <div
                                                                                class="input-group has-validation">
                                                                                <input type="number"
                                                                                    name="vaccine_age_start"
                                                                                    class="form-control"
                                                                                    id="validationCustomUsername"
                                                                                    step="0.01"
                                                                                    aria-describedby="inputGroupPrepend"
                                                                                    value = "<?php echo $result['vaccine_age_start'];?>"
                                                                                    required />
                                                                                <div class="invalid-feedback">
                                                                                    กรุณากรอก ช่วงอายุเริ่มต้น
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-md-12">
                                                                            <label
                                                                                for="validationCustomUsername"
                                                                                class="form-label">
                                                                                ช่วงอายุสิ้นสุด </label>
                                                                            <div
                                                                                class="input-group has-validation">
                                                                                <input type="number"
                                                                                    name="vaccine_age_end"
                                                                                    class="form-control"
                                                                                    id="validationCustomUsername"
                                                                                    step="0.01"
                                                                                    aria-describedby="inputGroupPrepend"
                                                                                    value = "<?php echo $result['vaccine_age_end'];?>"
                                                                                    required />
                                                                                <div class="invalid-feedback">
                                                                                    กรุณากรอก ช่วงอายุสิ้นสุด
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        Close
                                                                    </button>
                                                                    <button name="add_vaccine"
                                                                        class="btn btn-primary" type="submit"
                                                                        value="add_vaccine">
                                                                        Submit form
                                                                    </button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>




                                                    <div class="modal fade" id="DelModal<?php echo $vaccine_id;?>" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-danger">
                                                                    <h5 class="modal-title"
                                                                        id="exampleModalLabel">
                                                                       <font color = '#fff'> ลบข้อมูลวัคซีน (<?php echo $vaccine_id;?>) </font>
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <form name="Del<?php echo $vaccine_id;?>" method="post" class="row g-3 needs-validation" novalidate  enctype="multipart/form-data">

                                                                <div class="modal-body">
                                                                <input name="vaccine_id" type="hidden" value="<?php echo $result['vaccine_id']; ?>" /> 
                                                                    <h2> ยืนยันการลบอีกครั้ง </h2>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        ยกเลิก
                                                                    </button>
                                                                    <button name="del_vaccine"
                                                                        class="btn btn-danger" type="submit"
                                                                        value="del_vaccine">
                                                                        ยืนยัน
                                                                    </button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>



                                                <?php  } ?>


                                            </tbody>
                                        </table>
                                    </div>
            </div>
        </div>
    </div>
</section>





<?php include "footer.php";?>

<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>