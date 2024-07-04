<?php include "header.php";?>



<div class="pagetitle">
    <h1> ข้อมูลเจ้าหน้าที่ </h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">หน้าหลัก</a></li>
            <li class="breadcrumb-item active">เจ้าหน้าที่</li>
        </ol>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
             เพิ่มข้อมูลเจ้าหน้าที่
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
                                            เพิ่มข้อมูลเจ้าหน้าที่
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="row g-3">

                                            <div class="col-md-12">
                                                <label for="validationCustomUsername" class="form-label"> ระดับผูู้ใช้งาน </label>
                                                <div class="input-group has-validation">
                                                        <select name="level_id" id="level_id" class="form-select" required>
                                                            <option value="">กรุณาเลือก</option>
                                                            <?php
                                                            include "config.inc.php";
                                                            $sql_level = " SELECT * FROM tbl_level ORDER BY level_id DESC ";
                                                            $query_level = $conn->query($sql_level);
                                                            while ($result_level = $query_level->fetch_assoc()) {
                                                            ?>
                                                                <option value="<?php echo $result_level['level_id'];?>"><?php echo $result_level['level_name'];?></option>
                                                            <?php  } $conn->close();  ?>
                                                            </select>
                                                    <div class="invalid-feedback">
                                                        กรุณาเลือก ระดับผูู้ใช้งาน
                                                    </div>
                                                </div>
                                            </div>




                                            <div class="col-md-12">
                                                <label for="validationCustomUsername" class="form-label"> ชื่อ</label>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="staff_name" class="form-control"
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
                                                    <input type="text" name="staff_lastname" class="form-control"
                                                        id="validationCustomUsername"
                                                        aria-describedby="inputGroupPrepend" required />
                                                    <div class="invalid-feedback">
                                                        กรุณากรอก นามสกุล
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <label for="validationCustomUsername" class="form-label"> ชื่อผู้ใช้งาน
                                                </label>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="staff_username" class="form-control"
                                                        id="validationCustomUsername"
                                                        aria-describedby="inputGroupPrepend" required />
                                                    <div class="invalid-feedback">
                                                        กรุณากรอก ชื่อผู้ใช้งาน
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <label for="validationCustomUsername" class="form-label"> รหัสผ่านผู้ใช้งาน
                                                </label>
                                                <div class="input-group has-validation">
                                                    <input type="password" name="staff_password" class="form-control"
                                                        id="validationCustomUsername"
                                                        aria-describedby="inputGroupPrepend" required />
                                                    <div class="invalid-feedback">
                                                        กรุณากรอก รหัสผ่านผู้ใช้งาน
                                                    </div>
                                                </div>
                                            </div>




                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                        <button name="add_staff" class="btn btn-primary" type="submit"
                                            value="add_staff">
                                            Submit form
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <?php


    if(!empty($_POST['del_staff'])){

        $staff_id = $_POST['staff_id'];

        include "config.inc.php";
        if (isset($_POST['staff_id'])  && !empty($_POST['staff_id'])) {

        $sql_del = "DELETE FROM tbl_staff WHERE staff_id = $staff_id";
        $conn->query($sql_del);

        }
        $conn -> close();

        echo "<script type='text/javascript'>";
        echo "window.location='staff.php';";
        echo "</script>";
    }




  if(!empty($_POST['add_staff'])){

    include "config.inc.php";

    $staff_name  = $_POST['staff_name'];


    if (isset($_POST['staff_name'])  && !empty($_POST['staff_name'])) {
        $staff_name = $conn->real_escape_string($_POST['staff_name']);
    } else {
        $staff_name = '';
    }

    if (isset($_POST['staff_lastname'])  && !empty($_POST['staff_lastname'])) {
        $staff_lastname = $conn->real_escape_string($_POST['staff_lastname']);
    } else {
        $staff_lastname = '';
    }

    if (isset($_POST['staff_username'])  && !empty($_POST['staff_username'])) {
        $staff_username = $conn->real_escape_string($_POST['staff_username']);
    } else {
        $staff_username = '';
    }

    if (isset($_POST['staff_password'])  && !empty($_POST['staff_password'])) {
        $staff_password = $conn->real_escape_string($_POST['staff_password']);
    } else {
        $staff_password = '';
    }


    if (isset($_POST['level_id'])  && !empty($_POST['level_id'])) {
        $level_id = $conn->real_escape_string($_POST['level_id']);
    } else {
        $level_id = 0;
    }

    $staff_status = 1;

    if (isset($_POST['staff_id'])  && !empty($_POST['staff_id'])) {

        $staff_id = $_POST['staff_id'];

        $sql_update = "UPDATE tbl_staff SET
                        level_id = '$level_id',
                        staff_name = '$staff_name',
                        staff_lastname = '$staff_lastname',
                        staff_username = '$staff_username',
                        staff_password = '$staff_password',
                        staff_status = '$staff_status'
                        WHERE tbl_staff.staff_id = $staff_id";
        $conn->query($sql_update);

    }else{


        $sql_in = "INSERT INTO tbl_staff  (staff_id, level_id, staff_name, staff_lastname, staff_username, staff_password, staff_status)
                                 VALUES (null, '$level_id', '$staff_name', '$staff_lastname', '$staff_username', '$staff_password', '$staff_status' )";
        $conn->query($sql_in);



    }




    $conn -> close();


    echo "<script type='text/javascript'>";
    echo "window.location='staff.php';";
    echo "</script>";



  }

  ?>



                    <br>
<section class="section dashboard">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Datatables  Staff </h5>

                                    <div class="table-responsive">
                                    <table name="myTable" id="myTable" class="table align-middle table-hover m-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ลำดับที่</th>
                                                    <th scope="col">ระดับผูู้ใช้งาน</th>
                                                    <th scope="col">ชื่อ - สกุล</th>
                                                    <th scope="col">ชื่อผู้ใช้งาน </th>
                                                    <th scope="col">รหัสผ่านผู้ใช้งาน</th>
                                                    <th scope="col">จัดการข้อมูล</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                        include "config.inc.php";
                                        $sql = "SELECT * FROM tbl_staff as s
                                                INNER JOIN  tbl_level as l on s.level_id = l.level_id
                                                ORDER BY s.staff_id DESC ";
                                        $query = $conn->query($sql);
                                        $i = 0;
                                        while ($result = $query->fetch_assoc()) {
                                        $i++;
                                        $staff_id = $result['staff_id'];
                                        ?>

                                                <tr>
                                                    <td> <?php echo $i;?> </td>
                                                    <td><?php echo $result['level_name'];?></td>
                                                    <td><?php echo $result['staff_name'];?>
                                                        <?php echo $result['staff_lastname'];?></td>
                                                    <td><?php echo $result['staff_username'];?></td>
                                                    <td><?php echo $result['staff_password'];?></td>
                                                    <td>

                                                        <button type="button" class="btn btn-info btn-sm"
                                                            data-bs-toggle="modal" data-bs-target="#EditModal<?php echo $staff_id;?>">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>

                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-bs-toggle="modal" data-bs-target="#DelModal<?php echo $staff_id;?>">
                                                            <i class="bi bi-trash"></i>
                                                        </button>

                                                    </td>
                                                </tr>




                                                <form name="Edit<?php echo $staff_id;?>" method="post" class="row g-3 needs-validation" novalidate  enctype="multipart/form-data">
                                                    <div class="modal fade" id="EditModal<?php echo $staff_id;?>" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="exampleModalLabel">
                                                                        แก้ไขข้อมูลเจ้าหน้าที่ <?php echo $staff_id;?>
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">

                                                                <input name="staff_id" type="hidden" value="<?php echo $result['staff_id']; ?>" />
                                                                    <div class="row g-3">




                                                                    <div class="col-md-12">
                                                                            <label for="validationCustomUsername" class="form-label"> ระดับผูู้ใช้งาน </label>
                                                                            <div class="input-group has-validation">
                                                                                    <select name="level_id" id="level_id" class="form-select" required>
                                                                                        <option value="">กรุณาเลือก</option>
                                                                                        <?php
                                                                                        $level_id =  $result['level_id'];
                                                                                        $sql_level = " SELECT * FROM tbl_level ORDER BY level_id DESC ";
                                                                                        $query_level = $conn->query($sql_level);
                                                                                        while ($result_level = $query_level->fetch_assoc()) {
                                                                                        ?>
                                                                                            <option value="<?php echo $result_level['level_id'];?>"

                                                                                            <?php if (!(strcmp($result_level['level_id'], $level_id))) {
                                                                                            echo "selected=\"selected\"";
                                                                                            } ?>>

                                                                                            <?php echo $result_level['level_name'];?></option>
                                                                                        <?php  } ?>
                                                                                        </select>
                                                                                <div class="invalid-feedback">
                                                                                    กรุณาเลือก ระดับผูู้ใช้งาน
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
                                                                                    name="staff_name"
                                                                                    class="form-control"
                                                                                    id="validationCustomUsername"
                                                                                    aria-describedby="inputGroupPrepend"
                                                                                    value = "<?php echo $result['staff_name'];?>"
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
                                                                                    name="staff_lastname"
                                                                                    class="form-control"
                                                                                    id="validationCustomUsername"
                                                                                    aria-describedby="inputGroupPrepend"
                                                                                    value = "<?php echo $result['staff_lastname'];?>"
                                                                                    required />
                                                                                <div class="invalid-feedback">
                                                                                    กรุณากรอก นามสกุล
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <label
                                                                                for="validationCustomUsername"
                                                                                class="form-label"> ชื่อผู้ใช้งาน
                                                                            </label>
                                                                            <div
                                                                                class="input-group has-validation">
                                                                                <input type="text"
                                                                                    name="staff_username"
                                                                                    class="form-control"
                                                                                    id="validationCustomUsername"
                                                                                    aria-describedby="inputGroupPrepend"
                                                                                    value = "<?php echo $result['staff_username'];?>"
                                                                                    required />
                                                                                <div class="invalid-feedback">
                                                                                    กรุณากรอก ชื่อผู้ใช้งาน
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-md-12">
                                                                            <label
                                                                                for="validationCustomUsername"
                                                                                class="form-label">
                                                                                รหัสผ่านผู้ใช้งาน </label>
                                                                            <div
                                                                                class="input-group has-validation">
                                                                                <input type="password"
                                                                                    name="staff_password"
                                                                                    class="form-control"
                                                                                    id="validationCustomUsername"
                                                                                    aria-describedby="inputGroupPrepend"
                                                                                    value = "<?php echo $result['staff_password'];?>"
                                                                                    required />
                                                                                <div class="invalid-feedback">
                                                                                    กรุณากรอก รหัสผ่านผู้ใช้งาน
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
                                                                    <button name="add_staff"
                                                                        class="btn btn-primary" type="submit"
                                                                        value="add_staff">
                                                                        Submit form
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>



                                                <form name="Del<?php echo $staff_id;?>" method="post" class="row g-3 needs-validation" novalidate  enctype="multipart/form-data">
                                                    <div class="modal fade" id="DelModal<?php echo $staff_id;?>" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-danger">
                                                                    <h5 class="modal-title"
                                                                        id="exampleModalLabel">
                                                                       <font color = '#fff'> ลบข้อมูลเจ้าหน้าที่ (<?php echo $staff_id;?>) </font>
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                <input name="staff_id" type="hidden" value="<?php echo $result['staff_id']; ?>" /> 
                                                                    <h2> ยืนยันการลบอีกครั้ง </h2>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        ยกเลิก
                                                                    </button>
                                                                    <button name="del_staff"
                                                                        class="btn btn-danger" type="submit"
                                                                        value="del_staff">
                                                                        ยืนยัน
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>



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