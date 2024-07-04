<?php include "header.php"; ?>


<?php

if (!isset($_SESSION['UserLogin_id'])) {
    echo "<META http-equiv=refresh content=0;url=login.php>"; 	
    exit;
}


if (isset($_SESSION['do'])) {

    $do = $_SESSION['do'];

    echo "<script>";
    echo " Swal.fire({";
    echo "  title: 'สำเร็จ!', ";
    echo "  text: '$do', ";
    echo "  icon: 'success', ";
    echo "  imageUrl: 'https://unsplash.it/400/200', ";
    echo "  imageWidth: 400, ";
    echo "  imageHeight: 200, ";
    echo "  imageAlt: 'Custom image', ";
    echo "  })";
    echo " </script>";
    unset($_SESSION['do']);
}


if (isset($_SESSION['error'])) {

    echo   $error = $_SESSION['error'];

    echo "<script>";
    echo " Swal.fire({";
    echo "  title: 'ไม่สำเร็จ!', ";
    echo "  text: '$error', ";
    echo "  icon: 'error', ";
    echo "  imageUrl: 'https://unsplash.it/400/200', ";
    echo "  imageWidth: 400, ";
    echo "  imageHeight: 200, ";
    echo "  imageAlt: 'Custom image', ";
    echo "  })";
    echo " </script>";
    unset($_SESSION['error']);
}


?>


<?php

function random_char($len)
{
    //$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"; //ตัวอักษรที่สามารถสุ่มได้
    $chars = "abcdefghijklmnopqrstuvwxyz"; //ตัวอักษรที่สามารถสุ่มได้
    $ret_char = "";
    $num = strlen($chars);
    for ($i = 0; $i < $len; $i++) {
        $ret_char .= $chars[rand() % $num];
        $ret_char .= "";
    }
    return $ret_char;
}


function random_pass($len)
{
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789*"; //ตัวอักษรที่สามารถสุ่มได้
    //$chars = "abcdefghijklmnopqrstuvwxyz"; //ตัวอักษรที่สามารถสุ่มได้
    $ret_char = "";
    $num = strlen($chars);
    for ($i = 0; $i < $len; $i++) {
        $ret_char .= $chars[rand() % $num];
        $ret_char .= "";
    }
    return $ret_char;
}


$random_username =  "lbt" . random_char(4);    //สุ่มตัวอักษรตามต้องการในที่นี้คือ  7 
$random_password =  "@" . $random_username;    //สุ่มตัวอักษรตามต้องการในที่นี้คือ  7 

?>





<div class="pagetitle">
    <h1>ข้อมูล สมาชิก </h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">สมาชิก</li>
        </ol>

        <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#verticalycentered">
            <i class="ri-add-circle-fill"></i> เพิ่มสมาชิก
        </button>
    </nav>
</div><!-- End Page Title -->




<?php




if (!empty($_POST['submit_del'])) {

    include "config.inc.php";
   

    $member_id = $_POST['member_id'];
    $sql_del= "DELETE FROM tbl_member WHERE md5(member_id) = '$_POST[member_id]' ";
    $conn->query($sql_del);

    $conn->close();

    $_SESSION['do'] = 'ลบข้อมูลสำเร็จ';

    echo "<script type='text/javascript'>";
    // echo "alert('[บันทึกข้อมูสำเร็จ]');";
    echo "window.location='member.php';";
    echo "</script>";
}


?>





<form class="needs-validation" novalidate method="post" action="" enctype="multipart/form-data">
    <div class="modal fade" id="verticalycentered" tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">


            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class=" ri-add-circle-fill"></i> เพิ่ม สมาชิก </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">



                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>ชื่อ</label>
                            <input type="text" name="member_name" class="form-control" placeholder="ชื่อ" value="" required>
                        </div>
                    </div>
                    <br>


                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>สกุล</label>
                            <input type="text" name="member_lastname" class="form-control" placeholder="สกุล" value="" required>
                        </div>
                    </div>
                    <br>


                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>เบอร์โทร</label>
                            <input type="text" name="member_tel" class="form-control" placeholder="เบอร์โทร" value="" required>
                        </div>
                    </div>
                    <br>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Username </label>
                            <input type="text" id="member_user" name="member_user" class="form-control" placeholder="" value="" required>
                            <span id="msg1"></span>
                        </div>
                    </div>
                    <br>


                    <div class="col-sm-12">
                        <div class="form-group">
                        

                                <label>Password  </label>
                                <input type="text" name="member_pass" class="form-control" placeholder="Password" value="" required>


                        </div>
                    </div>
                    <br>




                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button name="submit" type="submit" value="submit" class="btn btn-primary">Submit</button>
                </div>

            </div>

        </div>

    </div><!-- End Vertically centered Modal-->
</form><!-- End General Form Elements -->


<?php

if (isset($_POST['submit'])) {
    include "config.inc.php";



    if (isset($_POST['member_id'])  && !empty($_POST['member_id'])) {
        $member_id = $conn->real_escape_string($_POST['member_id']);
    } else {
        $member_id = 0;
    }


  

    if (isset($_POST['member_name'])  && !empty($_POST['member_name'])) {
        $member_name = $conn->real_escape_string($_POST['member_name']);
    } else {
        $member_name = '';
    }

    if (isset($_POST['member_lastname'])  && !empty($_POST['member_lastname'])) {
        $member_lastname = $conn->real_escape_string($_POST['member_lastname']);
    } else {
        $member_lastname = '';
    }

    if (isset($_POST['member_tel'])  && !empty($_POST['member_tel'])) {
        $member_tel = $conn->real_escape_string($_POST['member_tel']);
    } else {
        $member_tel = '';
    }

   

    if (isset($_POST['member_user'])  && !empty($_POST['member_user'])) {
        $member_user = $conn->real_escape_string($_POST['member_user']);
    } else {
        $member_user = '';
    }


    if (isset($_POST['member_pass'])  && !empty($_POST['member_pass'])) {
        $member_pass = $conn->real_escape_string($_POST['member_pass']);
        $member_pass = MD5($member_pass);
    } else {
        $member_pass = $_POST['member_pass_s'];
    }


    if (isset($_POST['member_status'])  && !empty($_POST['member_status'])) {
        $member_status = $conn->real_escape_string($_POST['member_status']);
    } else {
        $member_status = 1;
    }



    if (!empty($member_id)) {

      

        $sql_up = "UPDATE tbl_member SET  member_name = '$member_name',   member_lastname = '$member_lastname',   member_tel = '$member_tel',  member_user = '$member_user',   member_pass = '$member_pass',    member_status = '$member_status' WHERE  member_id= '$member_id'";
        $conn->query($sql_up);

        $_SESSION['do'] = 'แก้ไขข้อมูลสำเร็จ';
    } else {

 



        $sql_in = " INSERT INTO tbl_member (member_id,  member_name, member_lastname, member_tel,  member_user, member_pass,  member_status) VALUES (NULL,  '$member_name', '$member_lastname', '$member_tel', '$member_user', '$member_pass', '$member_status')";
        $conn->query($sql_in);

        $_SESSION['do'] = 'บันทึกข้อมูลสำเร็จ';
    }



    echo "<script type='text/javascript'>";
    //echo "alert('[บันทึกข้อมูสำเร็จ]');";
    echo "window.location='member.php';";
    echo "</script>";
}


?>




<section class="section dashboard">


    <div class="row">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Datatables ข้อมูล สมาชิก </h5>

                <!-- Table with stripped rows -->

                <table id="DataTable1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>

                            <th>ชื่อ</th>
                            <th>สกุล</th>
                            <th>เบอร์โทร</th>
                            <th>Username</th>
                            <th>สถานะ</th>
                            <th>จัดการข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?PHP
                        include "config.inc.php";
                        $sql  = " SELECT * FROM tbl_member as m ";
                        $sql .= " WHERE  m.member_status != 0 ";
                        $sql .= " ORDER BY m.member_id ASC ";
                        $query = $conn->query($sql);
                        $i = 0;
                        while ($result = $query->fetch_assoc()) {
                        $i++;

                           $member_id  =  $result['member_id'];
                           $member_name =  $result['member_name'];
                           $member_lastname =  $result['member_lastname'];
                           $member_tel =  $result['member_tel'];
                           $member_user =  $result['member_user'];
                           $member_pass =  $result['member_pass'];
                           $member_status =  $result['member_status'];
                          

                        ?>
                            <tr>
                                <th scope="row">
                                    <?php echo $i; ?>
                                </th>
                                <td><?php echo $result['member_name']; ?> </td>
                                <td><?php echo $result['member_lastname']; ?> </td>
                                <td><?php echo $result['member_tel']; ?> </td>
                                <td><?php echo $result['member_user']; ?> </td>
                                <td>
                                    <?php
                                    $member_status = $result['member_status'];
                                    switch ($member_status) { // Harder page
                                        case 1:
                                            //$tools_stock_status = "<h5><span class='badge bg-success'>เปิดใช้งาน <i class='ri-checkbox-circle-line'></i>  </span></h5>";
                                            echo " <a href='#' class='btn btn-success rounded-pill btn-sm'>เปิดใช้งาน</a>";
                                            break;
                                        case 2:
                                            //$tools_stock_status =  "<h5><span class='badge bg-danger'>ปิดใช้งาน <i class='ri-close-circle-line'></i> </span></h5>";
                                            echo " <a href='#' class='btn btn-danger rounded-pill btn-sm'> ปิดใช้งาน </a>";
                                            break;
                                        default:
                                            echo  "";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php $member_id = md5($result['member_id']); ?>
                                    <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $member_id; ?>">
                                        <i class='ri-edit-line'></i> จัดการข้อมูล
                                    </button>
                                </td>
                            </tr>




                            <!-- Modal -->
                            <div class="modal fade" id="delModal<?php echo $member_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                <div class="modal-dialog modal-dialog-centered">
                                    <form name="form<?php echo $member_id; ?>" method="post" action="" enctype="multipart/form-data">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    <font color='#fff'> <i class='ri-delete-bin-5-line'></i> Delete </font>
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input name="member_id" type="hidden" value="<?php echo $member_id; ?>" />
                                                <?php echo $member_id; ?>
                                                <center>
                                                    <h3>
                                                        <font color="red"> ยืนยันการลบอีกครั้ง </font>
                                                    </h3>

                                                </center>
                                            </div>
                                            <div class="modal-footer">
                                                <button name="submit_del" type="submit" value="submit_del" class="btn btn-danger">ยืนยัน</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>







                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal<?php echo $member_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                <div class="modal-dialog">

                                    <form name="form<?php echo $member_id; ?>" method="post" action="" enctype="multipart/form-data">

                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"> แก้ไข <?php echo $member_id; ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">


                                                <input name="member_id" type="hidden" value="<?php echo $result['member_id']; ?>" />


                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>ชื่อ</label>
                                                            <input type="text" name="member_name" class="form-control" placeholder="ชื่อ" value="<?php echo $member_name; ?>" required>
                                                        </div>
                                                    </div>
                                                    <br>



                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>สกุล</label>
                                                            <input type="text" name="member_lastname" class="form-control" placeholder="สกุล" value="<?php echo $member_lastname; ?>" required>
                                                        </div>
                                                    </div>
                                                    <br>


                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>เบอร์โทร</label>
                                                            <input type="text" name="member_tel" class="form-control" placeholder="เบอร์โทร" value="<?php echo $member_tel; ?>" required>
                                                        </div>
                                                    </div>
                                                    <br>



                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>Username </label>
                                                            <input type="text" id="member_user" name="member_user" class="form-control" placeholder="" value="<?php echo $member_user; ?>" required>
                                                            <span id="msg1"></span>
                                                        </div>
                                                    </div>
                                                    <br>




                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                                <label>Password </label>
                                                                <input type="text" name="member_pass" class="form-control" placeholder="Password" value="">
                                                                <input name="member_pass_s" type="hidden" value="<?php echo $member_pass; ?>" />
                                                        </div>
                                                    </div>
                                                    <br>



                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>สถานะ</label>
                                                            <select name="member_status" id="member_status" class="form-control select2" required>
                                                                <option value=""> เลือก สถานะ </option>
                                                                <option value="1" <?php if (!(strcmp(1,  $member_status))) {
                                                                                        echo "selected=\"selected\"";
                                                                                    } ?>>เปิดการใช้งาน</option>
                                                                <option value="2" <?php if (!(strcmp(2,  $member_status))) {
                                                                                        echo "selected=\"selected\"";
                                                                                    } ?>>ปิดการใช้งาน</option>
                                                            </select>
                                                        </div>
                                                    </div>




                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delModal<?php echo $member_id; ?>">
                                                    <i class='ri-delete-bin-5-line'></i> Delete
                                                </button>
                                                <button name="submit" type="submit" value="submit" class="btn btn-primary"> <i class='ri-save-2-line'></i> Save changes</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Close</button>
                                            </div>
                                        </div>
                                    </form>



                                </div>
                            </div>




                        <?php
                        }
                        $conn->close();
                        ?>

                    </tbody>
                </table>
                <!-- End Table with stripped rows -->

            </div>
        </div>



        <!-- Button trigger modal -->






    </div>
</section>




<?php include "footer.php"; ?>