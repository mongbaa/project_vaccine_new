<?php include "header.php";?>



<div class="pagetitle">
    <h1> บันทึกข้อมูลวัคซีน </h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">หน้าหลัก</a></li>
            <li class="breadcrumb-item active">บันทึกข้อมูลวัคซีน</li>
        </ol>
    </nav>
</div><!-- End Page Title -->





                    <!-- Modal -->



<?php

if(!empty($_POST['del_vaccine_data'])){

    $vaccine_data_id = $_POST['vaccine_data_id'];
    $student_id = $_POST['student_id'];

    include "config.inc.php";
    if (isset($_POST['vaccine_data_id'])  && !empty($_POST['vaccine_data_id'])) {

    $sql_del = "DELETE FROM tbl_vaccine_data WHERE vaccine_data_id = $vaccine_data_id";
    $conn->query($sql_del);

    }
    $conn -> close();

    echo "<script type='text/javascript'>";
    echo "window.location='add_vaccine_data.php?student_id=$student_id';";
    echo "</script>";
}




  if(!empty($_POST['add_vaccine_data'])){




    include "config.inc.php";


    if (isset($_POST['student_id'])  && !empty($_POST['student_id'])) {
        $student_id = $conn->real_escape_string($_POST['student_id']);
    } else {
        $student_id = 1;
    }

    if (isset($_POST['staff_id'])  && !empty($_POST['staff_id'])) {
        $staff_id = $conn->real_escape_string($_POST['staff_id']);
    } else {
        $staff_id = 1;
    }


    if (isset($_POST['vaccine_id'])  && !empty($_POST['vaccine_id'])) {
        $vaccine_id = $conn->real_escape_string($_POST['vaccine_id']);
    } else {
        $vaccine_id = 1;
    }

    if (isset($_POST['vaccine_data_quantity'])  && !empty($_POST['vaccine_data_quantity'])) {
        $vaccine_data_quantity = $conn->real_escape_string($_POST['vaccine_data_quantity']);
    } else {
        $vaccine_data_quantity = 0;
    }

    if (isset($_POST['vaccine_data_date'])  && !empty($_POST['vaccine_data_date'])) {
        $vaccine_data_date = $conn->real_escape_string($_POST['vaccine_data_date']);
    } else {
        $vaccine_data_date = '';
    }

    if (isset($_POST['vaccine_data_date_next'])  && !empty($_POST['vaccine_data_date_next'])) {
        $vaccine_data_date_next = $conn->real_escape_string($_POST['vaccine_data_date_next']);
    } else {
        $vaccine_data_date_next = '';
    }

    if (isset($_POST['vaccine_data_note'])  && !empty($_POST['vaccine_data_note'])) {
        $vaccine_data_note = $conn->real_escape_string($_POST['vaccine_data_note']);
    } else {
        $vaccine_data_note = '';
    }

    $vaccine_data_status = 1;


    if (isset($_POST['vaccine_data_id'])  && !empty($_POST['vaccine_data_id'])) {

        $vaccine_data_id = $_POST['vaccine_data_id'];


        $sql_update = "UPDATE tbl_vaccine_data SET
                        student_id = '$student_id',
                        staff_id = '$staff_id',
                        vaccine_id = '$vaccine_id',
                        vaccine_data_quantity = '$vaccine_data_quantity',
                        vaccine_data_date = '$vaccine_data_date',
                        vaccine_data_date_next = '$vaccine_data_date_next',
                        vaccine_data_note = '$vaccine_data_note',
                        vaccine_data_status = '$vaccine_data_status'
                        WHERE tbl_vaccine_data.vaccine_data_id = $vaccine_data_id";
        $conn->query($sql_update);

    }else{

        $sql_in = "INSERT INTO tbl_vaccine_data  (vaccine_data_id, student_id, staff_id, vaccine_id, vaccine_data_quantity, vaccine_data_date, vaccine_data_date_next, vaccine_data_note, vaccine_data_status)
                                     VALUES (null, '$student_id', '$staff_id', '$vaccine_id', '$vaccine_data_quantity', '$vaccine_data_date', '$vaccine_data_date_next', '$vaccine_data_note', 1 )";
        $conn->query($sql_in);
    }

    $conn -> close();


    echo "<script type='text/javascript'>";
    echo "window.location='add_vaccine_data.php?student_id=$student_id';";
    echo "</script>";



  }

  ?>



                    <br>



<section class="section dashboard">
    <div class="row">
        <div class="card p-2">
            <div class="card-body">

                                         <?php
                                        $student_id = $_GET['student_id'];
                                        include "config.inc.php";
                                        $sql = " SELECT
                                                        s.student_id, s.student_name, s.student_last, s.student_nickname, s.student_bd,
                                                        s.student_img, s.student_status, r.room_id, r.room_name,
                                                        TIMESTAMPDIFF(YEAR, s.student_bd, CURDATE()) AS years, -- คำนวณปี
                                                        TIMESTAMPDIFF(MONTH, s.student_bd, CURDATE()) % 12 AS months, -- คำนวณเดือน
                                                        CONCAT(
                                                            TIMESTAMPDIFF(YEAR, s.student_bd, CURDATE()),
                                                            '.',
                                                            TIMESTAMPDIFF(MONTH, s.student_bd, CURDATE()) % 12
                                                        ) AS age_formatted
                                                 FROM
                                                        tbl_student as s
                                                        INNER JOIN  tbl_room as r on s.room_id = r.room_id
                                                        WHERE s.student_id = $student_id 
                                                    ";
                                        $query = $conn->query($sql);
                                        $result = $query->fetch_assoc();
                                        ?>

                                        <?php if(!empty($result['student_img'])){?>
                                            <img src="student_img/<?php echo $result['student_img']; ?>" alt="" width="120" height="120" style="border-radius:50%;" class="img-circle responsive">
                                        <?php } ?>


                                        <?php 
                                        echo $result['student_name'];
                                        echo " ";
                                        echo $result['student_last'];
                                        echo " (";
                                        echo $result['student_nickname'];
                                        echo ") อายุ  ";
                                        echo $result['age_formatted'];
                                        ?>

                                <form method="post" class="row g-3 needs-validation" novalidate enctype="multipart/form-data">

                                        <div class="row g-3">

                                        <input name="student_id" type="hidden" value="<?php echo $result['student_id']; ?>" />

                                            <div class="col-md-8">
                                                <label for="validationCustomUsername" class="form-label"> วัคซีน </label>
                                                <div class="input-group has-validation">
                                                        <select name="vaccine_id" id="vaccine_id" class="form-select select2" required>
                                                            <option value="">กรุณาเลือก</option>
                                                            <?php
                                                            include "config.inc.php";
                                                            $sql_vaccine = " SELECT * FROM tbl_vaccine  WHERE vaccine_status = 1 ORDER BY vaccine_id DESC ";
                                                            $query_vaccine = $conn->query($sql_vaccine);
                                                            while ($result_vaccine = $query_vaccine->fetch_assoc()) {
                                                            ?>
                                                                <option value="<?php echo $result_vaccine['vaccine_id'];?>">
                                                                    <?php echo $result_vaccine['vaccine_no'];?> /
                                                                    <?php echo $result_vaccine['vaccine_name'];?>

                                                                    ( ช่วงอายุ <?php echo $result_vaccine['vaccine_age_start'];?>-
                                                                    <?php echo $result_vaccine['vaccine_age_end'];?> )
                                                                </option>
                                                            <?php  } $conn->close();  ?>
                                                            </select>
                                                    <div class="invalid-feedback">
                                                        กรุณาเลือก วัคซีน
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-md-4">
                                                <label for="validationquantity" class="form-label">  จำนวนเข็ม	 </label>
                                                <div class="input-group has-validation">
                                                    <input type="number" name="vaccine_data_quantity" class="form-control"
                                                        id="validationquantity"
                                                        aria-describedby="inputGroupPrepend" required />
                                                    <div class="invalid-feedback">
                                                        กรุณากรอก จำนวนเข็ม
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <label for="validationvaccine_data_date" class="form-label"> วันที่ฉีด	 </label>
                                                <div class="input-group has-validation">
                                                    <input type="date" name="vaccine_data_date" class="form-control"
                                                        id="validationvaccine_data_date"
                                                        aria-describedby="inputGroupPrepend" required />
                                                    <div class="invalid-feedback">
                                                        กรุณากรอก วันที่ฉีด
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <label for="validationvaccine_data_date_next" class="form-label"> วันที่ฉีดครั้งถัดไป	 </label>
                                                <div class="input-group has-validation">
                                                    <input type="date" name="vaccine_data_date_next" class="form-control"
                                                        id="validationvaccine_data_date_next"
                                                        aria-describedby="inputGroupPrepend" required />
                                                    <div class="invalid-feedback">
                                                        กรุณากรอก วันที่ฉีดครั้งถัดไป
                                                    </div>
                                                </div>
                                            </div>



                                        </div>


                                        <div class="row g-3">

                                            <div class="col-md-12">
                                                <label for="validationnote" class="form-label"> หมายเหตุ	 </label>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="vaccine_data_note" class="form-control"
                                                        id="validationnote"
                                                        aria-describedby="inputGroupPrepend" />
                                                    <div class="invalid-feedback">
                                                        กรุณากรอก วันที่ฉีดครั้งถัดไป
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                        <button name="add_vaccine_data" class="btn btn-primary" type="submit"
                                            value="add_vaccine_data">
                                            Submit form
                                        </button>

                                </form>


            </div>
        </div>
    </div>
</<section>

                    <br>



















<section class="section dashboard">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Datatables  Room </h5>
                                    <div class="table-responsive">
                                        <table name="myTable" id="myTable" class="table align-middle table-hover m-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col"> ลำดับที่</th>
                                                    <th scope="col"> ชื่อ - สกุล</th>
                                                    <th scope="col"> ชื่อวัคซีน</th>
                                                    <th scope="col"> จำนวนเข็ม	</th>
                                                    <th scope="col"> วันที่ฉีด </th>
                                                    <th scope="col"> วันที่ฉีดครั้งถัดไป </th>
                                                    <th scope="col"> หมายเหตุ </th>
                                                    <th scope="col"> ผู้บันทึก</th>
                                                    <th scope="col">จัดการข้อมูล</th>
                                                    <th scope="col">กำหนด</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                        include "config.inc.php";
                                                $sql = "SELECT * FROM tbl_vaccine_data as vd
                                                        INNER JOIN  tbl_student as sd on sd.student_id = vd.student_id
                                                        INNER JOIN  tbl_vaccine as v on v.vaccine_id = vd.vaccine_id
                                                        INNER JOIN  tbl_staff as sf on sf.staff_id = vd.staff_id
                                                        WHERE  vd.student_id = $student_id
                                                        ORDER BY vd.vaccine_data_id DESC ";
                                        $query = $conn->query($sql);
                                        $i = 0;
                                        while ($result = $query->fetch_assoc()) {
                                        $i++;
                                        $vaccine_data_id = $result['vaccine_data_id'];
                                        ?>

                                                <tr>
                                                    <td> <?php echo $i;?> </td>
                                                    <td><?php echo $result['student_name'];?> <?php echo $result['student_last'];?> </td>
                                                    <td><?php echo $result['vaccine_name'];?></td>
                                                    <td><?php echo $result['vaccine_data_quantity'];?></td>
                                                    <td><?php echo $result['vaccine_data_date'];?></td>
                                                    <td><?php echo $result['vaccine_data_date_next'];?></td>
                                                    <td><?php echo $result['vaccine_data_note'];?></td>
                                                    <td><?php echo $result['staff_name'];?> <?php echo $result['staff_lastname'];?></td>
                                                    <td>

                                                        <!-- <button type="button" class="btn btn-info btn-sm"
                                                            data-bs-toggle="modal" data-bs-target="#EditModal<?php echo $vaccine_data_id;?>">
                                                            <i class="bi bi-pencil"></i>
                                                        </button> -->

                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-bs-toggle="modal" data-bs-target="#DelModal<?php echo $vaccine_data_id;?>">
                                                            <i class="bi bi-trash"></i>
                                                        </button>

                                                    </td>
                                                    <td>
                                                        <?php
                                                        $date_next = $result['vaccine_data_date_next'];
                                                        $date = date('Y-m-d');
                                                        echo round(abs(strtotime($date) - strtotime($date_next))/60/60/24);
                                                        echo ' วัน';
                                                        ?>
                                                    </td>
                                                </tr>




                                                    <div class="modal fade" id="DelModal<?php echo $vaccine_data_id;?>" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-danger">
                                                                    <h5 class="modal-title"
                                                                        id="exampleModalLabel">
                                                                       <font color = '#fff'> ลบข้อมูลนักเรียน (<?php echo $vaccine_data_id;?>) </font>
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <form name="Del<?php echo $vaccine_data_id;?>" method="post" class="row g-3 needs-validation" novalidate  enctype="multipart/form-data">

                                                                <div class="modal-body">

                                                                <input name="vaccine_data_id" type="hidden" value="<?php echo $result['vaccine_data_id']; ?>" />
                                                                <input name="student_id" type="hidden" value="<?php echo $result['student_id']; ?>" />
                                                                    <h2> ยืนยันการลบอีกครั้ง </h2>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        ยกเลิก
                                                                    </button>
                                                                    <button name="del_vaccine_data"
                                                                        class="btn btn-danger" type="submit"
                                                                        value="del_vaccine_data">
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
</section>




<?php include "footer.php";?>

<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>