<?php include "header.php";

if (!isset($_SESSION['UserLogin_id'])) {
    // echo "<META http-equiv=refresh content=0;url=login.php>"; 	
    // exit;
}

?>



<div class="pagetitle">
    <h1> ข้อมูลนักเรียน </h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">นักเรียน</li>
        </ol>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            เพิ่มข้อมูลนักเรียน
        </button>
    </nav>
</div><!-- End Page Title -->



                    <!-- Modal -->

                    <form method="post" class="row g-3 needs-validation" novalidate enctype="multipart/form-data">
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            เพิ่มข้อมูลนักเรียน
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="row g-3">

                                            <div class="col-md-12">
                                                <label for="validationCustomUsername" class="form-label"> ห้อง </label>
                                                <div class="input-group has-validation">
                                                        <select name="room_id" id="room_id" class="form-select" required>
                                                            <option value="">กรุณาเลือก</option>
                                                            <?php
                                                            include "config.inc.php";
                                                            $sql_room = " SELECT * FROM tbl_room ORDER BY room_id DESC ";
                                                            $query_room = $conn->query($sql_room);
                                                            while ($result_room = $query_room->fetch_assoc()) {
                                                            ?>
                                                                <option value="<?php echo $result_room['room_id'];?>"><?php echo $result_room['room_name'];?></option>
                                                            <?php  } $conn->close();  ?>
                                                            </select>
                                                    <div class="invalid-feedback">
                                                        กรุณาเลือก ห้อง
                                                    </div>
                                                </div>
                                            </div>




                                            <div class="col-md-12">
                                                <label for="validationCustomUsername" class="form-label"> ชื่อ</label>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="student_name" class="form-control"
                                                        id="validationCustomUsername"
                                                        aria-describedby="inputGroupPrepend" required />
                                                    <div class="invalid-feedback">
                                                        กรุณากรอก ชื่อ
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <label for="validationCustomUsername" class="form-label">
                                                    นามสกุล</label>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="student_last" class="form-control"
                                                        id="validationCustomUsername"
                                                        aria-describedby="inputGroupPrepend" required />
                                                    <div class="invalid-feedback">
                                                        กรุณากรอก นามสกุล
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <label for="validationCustomUsername" class="form-label"> ชื่อเล่น
                                                </label>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="student_nickname" class="form-control"
                                                        id="validationCustomUsername"
                                                        aria-describedby="inputGroupPrepend" required />
                                                    <div class="invalid-feedback">
                                                        กรุณากรอก ชื่อเล่น
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <label for="validationCustomUsername" class="form-label"> วันเดือนปีเกิด
                                                </label>
                                                <div class="input-group has-validation">
                                                    <input type="date" name="student_bd" class="form-control"
                                                        id="validationCustomUsername"
                                                        aria-describedby="inputGroupPrepend" required />
                                                    <div class="invalid-feedback">
                                                        กรุณากรอก วันเดือนปีเกิด
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-md-12">
                                                <label for="validationCustomUsername" class="form-label"> รูปภาพ</label>
                                                <div class="input-group has-validation">
                                                    <input type="file" name="student_img" class="form-control"
                                                        id="validationCustomUsername"
                                                        aria-describedby="inputGroupPrepend" required />
                                                    <div class="invalid-feedback">
                                                        กรุณากรอก ภาพ
                                                    </div>
                                                </div>
                                            </div>




                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                        <button name="add_student" class="btn btn-primary" type="submit"
                                            value="add_student">
                                            Submit form
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <?php


    if(!empty($_POST['del_student'])){

        $student_id = $_POST['student_id'];

        include "config.inc.php";
        if (isset($_POST['student_id'])  && !empty($_POST['student_id'])) {

        $sql_del = "DELETE FROM tbl_student WHERE student_id = $student_id";
        $conn->query($sql_del);

        }
        $conn -> close();

        echo "<script type='text/javascript'>";
        echo "window.location='student.php';";
        echo "</script>";
    }




  if(!empty($_POST['add_student'])){

    include "config.inc.php";

    $student_name  = $_POST['student_name'];


    if (isset($_POST['student_name'])  && !empty($_POST['student_name'])) {
        $student_name = $conn->real_escape_string($_POST['student_name']);
    } else {
        $student_name = '';
    }

    if (isset($_POST['student_last'])  && !empty($_POST['student_last'])) {
        $student_last = $conn->real_escape_string($_POST['student_last']);
    } else {
        $student_last = '';
    }

    if (isset($_POST['student_nickname'])  && !empty($_POST['student_nickname'])) {
        $student_nickname = $conn->real_escape_string($_POST['student_nickname']);
    } else {
        $student_nickname = '';
    }

    if (isset($_POST['student_bd'])  && !empty($_POST['student_bd'])) {
        $student_bd = $conn->real_escape_string($_POST['student_bd']);
    } else {
        $student_bd = '';
    }


    if (isset($_POST['room_id'])  && !empty($_POST['room_id'])) {
        $room_id = $conn->real_escape_string($_POST['room_id']);
    } else {
        $room_id = 0;
    }



    if (isset($_POST['student_id'])  && !empty($_POST['student_id'])) {

        $student_id = $_POST['student_id'];

        if ($_FILES["student_img"]["name"] != "") // เช็คค่ารับไฟล์ ถ้ามีไฟล์ส่งมาให้ทำตามเงือนไขต่อไป
        {
            $new_name = "student_img_" . date('Ymdhis') . ".WebP";
            if (move_uploaded_file($_FILES["student_img"]["tmp_name"], "student_img/" . $new_name)) //อัพไฟล์ขึ้น
            {
                $student_img = $new_name;

                $student_img_unlink = $_POST['student_img_s'];
                if(!empty($_POST['student_img_s'])){
                 @unlink("student_img/$student_img_unlink");
                }
            }
        } else {
                $student_img = $_POST['student_img_s'];
        }


        $sql_update = "UPDATE tbl_student SET
                        room_id = '$room_id',
                        student_name = '$student_name',
                        student_last = '$student_last',
                        student_nickname = '$student_nickname',
                        student_bd = '$student_bd',
                        student_img = '$student_img'
                        WHERE tbl_student.student_id = $student_id";
        $conn->query($sql_update);

    }else{

        if ($_FILES["student_img"]["name"] != "") // เช็คค่ารับไฟล์ ถ้ามีไฟล์ส่งมาให้ทำตามเงือนไขต่อไป
        {
            $new_name = "student_img_" . date('Ymdhis') . ".WebP";
            if (move_uploaded_file($_FILES["student_img"]["tmp_name"], "student_img/" . $new_name)) //อัพไฟล์ขึ้น
            {
                $student_img = $new_name;
            }
        } else {
                $student_img = '';
        }

        $sql_in = "INSERT INTO tbl_student  (student_id, room_id, student_name, student_last, student_nickname, student_bd, student_img, student_status)
                                     VALUES (null, '$room_id', '$student_name', '$student_last', '$student_nickname', '$student_bd', '$student_img', 1 )";
        $conn->query($sql_in);



    }

 


    $conn -> close();


    echo "<script type='text/javascript'>";
    echo "window.location='student.php';";
    echo "</script>";



  }

  ?>



 <br>

               


<section class="section dashboard">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Datatables  Donations </h5>


                                    <div class="table-responsive">
                                        <table name="myTable" id="myTable" class="table align-middle table-hover m-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ลำดับที่</th>
                                                    <th scope="col"> รูป </th>
                                                    <th scope="col">ห้อง</th>
                                                    <th scope="col">ชื่อ - สกุล</th>
                                                    <th scope="col">ชื่อเล่น </th>
                                                    <th scope="col">วันเดือนปีเกิด</th>
                                                    <th scope="col">อายุ</th>
                                                    <th scope="col">จัดการข้อมูล</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
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
                                                        ORDER BY s.student_id DESC
                                                        ";
                                        $query = $conn->query($sql);
                                        $i = 0;
                                        while ($result = $query->fetch_assoc()) {
                                        $i++;
                                        $student_id = $result['student_id'];
                                        ?>

                                                <tr>
                                                    <td> <?php echo $i;?> </td>
                                                    <td scope="row">

                                                        <?php if(!empty($result['student_img'])){?>
                                                            <img src="student_img/<?php echo $result['student_img']; ?>" alt="" width="120" height="120" style="border-radius:50%;" class="img-circle responsive">
                                                        <?php } ?>

                                                    </td>
                                                    <td><?php echo $result['room_name'];?></td>
                                                    <td><?php echo $result['student_name'];?>
                                                        <?php echo $result['student_last'];?></td>
                                                    <td><?php echo $result['student_nickname'];?></td>
                                                    <td><?php echo $result['student_bd'];?></td>
                                                    <td><?php echo $result['age_formatted'];?></td>

                                                    <td>

                                                        <button type="button" class="btn btn-info btn-sm"
                                                            data-bs-toggle="modal" data-bs-target="#EditModal<?php echo $student_id;?>">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>

                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-bs-toggle="modal" data-bs-target="#DelModal<?php echo $student_id;?>">
                                                            <i class="bi bi-trash"></i>
                                                        </button>


                                                        <a href="add_vaccine_data.php?student_id=<?php echo $result['student_id'];?>" class="btn btn-info btn-sm">
                                                                <i class="bi bi-pie-chart"></i>
                                                                [บันทึกข้อมูล]
                                                        </a>


                                                    </td>
                                                </tr>




                                                    <div class="modal fade" id="EditModal<?php echo $student_id;?>" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="exampleModalLabel">
                                                                        แก้ไขข้อมูลนักเรียน <?php echo $student_id;?>
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <form name="Edit<?php echo $student_id;?>" method="post" class="row g-3 needs-validation" novalidate  enctype="multipart/form-data">

                                                                <div class="modal-body">

                                                                <input name="student_id" type="hidden" value="<?php echo $result['student_id']; ?>" />
                                                                    <div class="row g-3">




                                                                    <div class="col-md-12">
                                                                            <label for="validationCustomUsername" class="form-label"> ห้อง </label>
                                                                            <div class="input-group has-validation">
                                                                                    <select name="room_id" id="room_id" class="form-select" required>
                                                                                        <option value="">กรุณาเลือก</option>
                                                                                        <?php
                                                                                        $room_id =  $result['room_id']; 
                                                                                        $sql_room = " SELECT * FROM tbl_room ORDER BY room_id DESC ";
                                                                                        $query_room = $conn->query($sql_room);
                                                                                        while ($result_room = $query_room->fetch_assoc()) {
                                                                                        ?>
                                                                                            <option value="<?php echo $result_room['room_id'];?>"

                                                                                            <?php if (!(strcmp($result_room['room_id'], $room_id))) {
                                                                                            echo "selected=\"selected\"";
                                                                                            } ?>>

                                                                                            <?php echo $result_room['room_name'];?></option>
                                                                                        <?php  } ?>
                                                                                        </select>
                                                                                <div class="invalid-feedback">
                                                                                    กรุณาเลือก ห้อง
                                                                                </div>
                                                                            </div>
                                                                        </div>




                                                                        <div class="col-md-12">
                                                                            <label
                                                                                for="validationCustomUsername"
                                                                                class="form-label"> ชื่อ</label>
                                                                            <div
                                                                                class="input-group has-validation">
                                                                                <input type="text"
                                                                                    name="student_name"
                                                                                    class="form-control"
                                                                                    id="validationCustomUsername"
                                                                                    aria-describedby="inputGroupPrepend"
                                                                                    value = "<?php echo $result['student_name'];?>"
                                                                                    required />
                                                                                <div class="invalid-feedback">
                                                                                    กรุณากรอก ชื่อ
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <label
                                                                                for="validationCustomUsername"
                                                                                class="form-label">
                                                                                นามสกุล</label>
                                                                            <div
                                                                                class="input-group has-validation">
                                                                                <input type="text"
                                                                                    name="student_last"
                                                                                    class="form-control"
                                                                                    id="validationCustomUsername"
                                                                                    aria-describedby="inputGroupPrepend"
                                                                                    value = "<?php echo $result['student_last'];?>"
                                                                                    required />
                                                                                <div class="invalid-feedback">
                                                                                    กรุณากรอก นามสกุล
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <label
                                                                                for="validationCustomUsername"
                                                                                class="form-label"> ชื่อเล่น
                                                                            </label>
                                                                            <div
                                                                                class="input-group has-validation">
                                                                                <input type="text"
                                                                                    name="student_nickname"
                                                                                    class="form-control"
                                                                                    id="validationCustomUsername"
                                                                                    aria-describedby="inputGroupPrepend"
                                                                                    value = "<?php echo $result['student_nickname'];?>"
                                                                                    required />
                                                                                <div class="invalid-feedback">
                                                                                    กรุณากรอก ชื่อเล่น
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-md-12">
                                                                            <label
                                                                                for="validationCustomUsername"
                                                                                class="form-label">
                                                                                วันเดือนปีเกิด </label>
                                                                            <div
                                                                                class="input-group has-validation">
                                                                                <input type="date"
                                                                                    name="student_bd"
                                                                                    class="form-control"
                                                                                    id="validationCustomUsername"
                                                                                    aria-describedby="inputGroupPrepend"
                                                                                    value = "<?php echo $result['student_bd'];?>"
                                                                                    required />
                                                                                <div class="invalid-feedback">
                                                                                    กรุณากรอก วันเดือนปีเกิด
                                                                                </div>
                                                                            </div>
                                                                        </div>



                                                                        <div class="col-md-12">
                                                                            <label
                                                                                for="validationCustomUsername"
                                                                                class="form-label">
                                                                                รูปภาพ</label>
                                                                            <div
                                                                                class="input-group has-validation">
                                                                                <input type="file"
                                                                                    name="student_img"
                                                                                    class="form-control"
                                                                                    id="validationCustomUsername"
                                                                                    aria-describedby="inputGroupPrepend"
                                                                                    />
                                                                                <input name="student_img_s" type="hidden" value="<?php echo $result['student_img']; ?>" />

                                                                                <div class="invalid-feedback">
                                                                                    กรุณากรอก ภาพ
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
                                                                    <button name="add_student"
                                                                        class="btn btn-primary" type="submit"
                                                                        value="add_student">
                                                                        Submit form
                                                                    </button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>




                                                    <div class="modal fade" id="DelModal<?php echo $student_id;?>" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-danger">
                                                                    <h5 class="modal-title"
                                                                        id="exampleModalLabel">
                                                                       <font color = '#fff'> ลบข้อมูลนักเรียน (<?php echo $student_id;?>) </font>
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <form name="Del<?php echo $student_id;?>" method="post" class="row g-3 needs-validation" novalidate  enctype="multipart/form-data">

                                                                <div class="modal-body">
                                                                <input name="student_id" type="hidden" value="<?php echo $result['student_id']; ?>" /> 
                                                                    <h2> ยืนยันการลบอีกครั้ง </h2>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        ยกเลิก
                                                                    </button>
                                                                    <button name="del_student"
                                                                        class="btn btn-danger" type="submit"
                                                                        value="del_student">
                                                                        ยืนยัน
                                                                    </button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>




                                                <?php  } ?>


                                            </tbody>
                                        </table>
                                    </div>


            </div>
        </div>
     </div>
</<section >









<?php include "footer.php";?>

<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>