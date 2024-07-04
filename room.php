<?php include "header.php";?>



<div class="pagetitle">
    <h1> ข้อมูลห้อง </h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">หน้าหลัก</a></li>
            <li class="breadcrumb-item active">ห้อง</li>
        </ol>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            เพิ่มข้อมูลห้อง
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
                                            เพิ่มข้อมูลห้อง
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="row g-3">

                                            <div class="col-md-12">
                                                <label for="validationCustomUsername" class="form-label"> ชื่อห้อง</label>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="room_name" class="form-control"
                                                        id="validationCustomUsername"
                                                        aria-describedby="inputGroupPrepend" required />
                                                    <div class="invalid-feedback">
                                                        กรุณากรอก ชื่อห้อง
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <label for="validationCustomUsername" class="form-label">
                                                    รายละเอียดห้อง</label>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="room_detail" class="form-control"
                                                        id="validationCustomUsername"
                                                        aria-describedby="inputGroupPrepend" required />
                                                    <div class="invalid-feedback">
                                                        กรุณากรอก รายละเอียดห้อง
                                                    </div>
                                                </div>
                                            </div>



                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                        <button name="add_room" class="btn btn-primary" type="submit"
                                            value="add_room">
                                            Submit form
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <?php


    if(!empty($_POST['del_room'])){

        $room_id = $_POST['room_id'];

        include "config.inc.php";
        if (isset($_POST['room_id'])  && !empty($_POST['room_id'])) {

        $sql_del = "DELETE FROM tbl_room WHERE room_id = $room_id";
        $conn->query($sql_del);

        }
        $conn -> close();

        echo "<script type='text/javascript'>";
        echo "window.location='room.php';";
        echo "</script>";
    }




  if(!empty($_POST['add_room'])){

    include "config.inc.php";

    $room_name  = $_POST['room_name'];


    if (isset($_POST['room_name'])  && !empty($_POST['room_name'])) {
        $room_name = $conn->real_escape_string($_POST['room_name']);
    } else {
        $room_name = '';
    }

    if (isset($_POST['room_detail'])  && !empty($_POST['room_detail'])) {
        $room_detail = $conn->real_escape_string($_POST['room_detail']);
    } else {
        $room_detail = '';
    }

   



    if (isset($_POST['room_id'])  && !empty($_POST['room_id'])) {

        $room_id = $_POST['room_id'];



        $sql_update = "UPDATE tbl_room SET
                        room_id = '$room_id',
                        room_name = '$room_name',
                        room_detail = '$room_detail'
                        WHERE tbl_room.room_id = $room_id";
        $conn->query($sql_update);

    }else{

        $sql_in = "INSERT INTO tbl_room  (room_id, room_name, room_detail, room_status)
                                     VALUES (null, '$room_name', '$room_detail',  1 )";
        $conn->query($sql_in);

    }




    $conn -> close();


    echo "<script type='text/javascript'>";
    echo "window.location='room.php';";
    echo "</script>";



  }

  ?>



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
                                                    <th scope="col">ลำดับที่</th>
                                                    <th scope="col">ชื่อห้อง</th>
                                                    <th scope="col">รายละเอียดห้อง</th>
                                                    <th scope="col">จัดการข้อมูล</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                        include "config.inc.php";
                                        $sql = " SELECT * FROM tbl_room ORDER BY room_id DESC ";
                                        $query = $conn->query($sql);
                                        $i = 0;
                                        while ($result = $query->fetch_assoc()) {
                                        $i++;
                                        $room_id = $result['room_id'];
                                        ?>

                                                <tr>
                                                    <td> <?php echo $i;?> </td>
                                                    <td><?php echo $result['room_name'];?> </td>
                                                    <td> <?php echo $result['room_detail'];?></td>
                                                    <td>

                                                        <button type="button" class="btn btn-info btn-sm"
                                                            data-bs-toggle="modal" data-bs-target="#EditModal<?php echo $room_id;?>">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>

                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-bs-toggle="modal" data-bs-target="#DelModal<?php echo $room_id;?>">
                                                            <i class="bi bi-trash"></i>
                                                        </button>

                                                    </td>
                                                </tr>




                                                    <div class="modal fade" id="EditModal<?php echo $room_id;?>" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="exampleModalLabel">
                                                                        แก้ไขข้อมูลห้อง <?php echo $room_id;?>
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <form name="Edit<?php echo $room_id;?>" method="post" class="row g-3 needs-validation" novalidate  enctype="multipart/form-data">

                                                                <div class="modal-body">

                                                                <input name="room_id" type="hidden" value="<?php echo $result['room_id']; ?>" />
                                                                    <div class="row g-3">
                                                                        <div class="col-md-12">
                                                                            <label
                                                                                for="validationCustomUsername"
                                                                                class="form-label"> ชื่อห้อง</label>
                                                                            <div
                                                                                class="input-group has-validation">
                                                                                <input type="text"
                                                                                    name="room_name"
                                                                                    class="form-control"
                                                                                    id="validationCustomUsername"
                                                                                    aria-describedby="inputGroupPrepend"
                                                                                    value = "<?php echo $result['room_name'];?>"
                                                                                    required />
                                                                                <div class="invalid-feedback">
                                                                                    กรุณากรอก ชื่อห้อง
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <label
                                                                                for="validationCustomUsername"
                                                                                class="form-label">
                                                                                รายละเอียดห้อง</label>
                                                                            <div
                                                                                class="input-group has-validation">
                                                                                <input type="text"
                                                                                    name="room_detail"
                                                                                    class="form-control"
                                                                                    id="validationCustomUsername"
                                                                                    aria-describedby="inputGroupPrepend"
                                                                                    value = "<?php echo $result['room_detail'];?>"
                                                                                    required />
                                                                                <div class="invalid-feedback">
                                                                                    กรุณากรอก รายละเอียดห้อง
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
                                                                    <button name="add_room"
                                                                        class="btn btn-primary" type="submit"
                                                                        value="add_room">
                                                                        Submit form
                                                                    </button>
                                                                </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="modal fade" id="DelModal<?php echo $room_id;?>" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-danger">
                                                                    <h5 class="modal-title"
                                                                        id="exampleModalLabel">
                                                                       <font color = '#fff'> ลบข้อมูลห้อง (<?php echo $room_id;?>) </font>
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <form name="Del<?php echo $room_id;?>" method="post" class="row g-3 needs-validation" novalidate  enctype="multipart/form-data">
                                                                <div class="modal-body">
                                                                <input name="room_id" type="hidden" value="<?php echo $result['room_id']; ?>" /> 
                                                                    <h2> ยืนยันการลบอีกครั้ง </h2>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        ยกเลิก
                                                                    </button>
                                                                    <button name="del_room"
                                                                        class="btn btn-danger" type="submit"
                                                                        value="del_room">
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