<?php include "header.php";?>


<div class="pagetitle">
    <h1> ข้อมูลวัคซีนวัคซีน </h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">หน้าหลัก</a></li>
            <li class="breadcrumb-item active">ข้อมูลวัคซีน</li>
        </ol>
    </nav>
</div><!-- End Page Title -->






<?php


    if(!empty($_POST['del_vaccine_data'])){

        $vaccine_data_id = $_POST['vaccine_data_id'];

        include "config.inc.php";
        if (isset($_POST['vaccine_data_id'])  && !empty($_POST['vaccine_data_id'])) {

        $sql_del = "DELETE FROM tbl_vaccine_data WHERE vaccine_data_id = $vaccine_data_id";
        $conn->query($sql_del);

        }
        $conn -> close();

        echo "<script type='text/javascript'>";
        echo "window.location='vaccine_data.php';";
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
    echo "window.location='vaccine_data.php';";
    echo "</script>";



  }

  ?>

<?php
    if(!empty($_GET['action'])){

        $action =  $_GET['action'];
        }else{
        $action =  '';
        }

?>



<br>

<a href="vaccine_data.php?action=" class="btn btn-info btn-sm">
    <i class="bi bi-pie-chart"></i> แสดงข้อมูล ทั้งหมด
</a>

<a href="vaccine_data.php?action=5" class="btn btn-info btn-sm">
    <i class="bi bi-pie-chart"></i> กำหนดน้อยกว่า 5 วัน
</a>

<a href="vaccine_data.php?action=<?php echo $action;?>&line=1" class="btn btn-success btn-sm">
    <i class="bi bi-pie-chart"></i> ส่ง Line
</a>


<section class="section dashboard">
    <div class="row">
        <div class="card">






            <div class="card-body">
                <h5 class="card-title">Datatables Vaccine </h5>
                <div class="table-responsive">
                    <table name="myTable" id="myTable" class="table align-middle table-hover ">
                        <thead>
                            <tr>
                                <th scope="col"> ลำดับที่</th>
                                <th scope="col"> ชื่อ - สกุล</th>
                                <th scope="col"> ชื่อวัคซีน</th>
                                <th scope="col"> จำนวนเข็ม </th>
                                <th scope="col"> วันที่ฉีด </th>
                                <th scope="col"> วันที่ฉีดครั้งถัดไป </th>
                                <th scope="col"> หมายเหตุ </th>
                                <th scope="col"> ผู้บันทึก</th>
                                <th scope="col">กำหนด</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                            include "config.inc.php";
                                            $student_names = array();
                                            $sql = "SELECT vd.*,  DATEDIFF(vd.vaccine_data_date_next, CURDATE()) AS days_to_expiry,
                                                    sd.*,  v.*, sf.*
                                                    FROM tbl_vaccine_data as vd
                                                    INNER JOIN  tbl_student as sd on sd.student_id = vd.student_id
                                                    INNER JOIN  tbl_vaccine as v on v.vaccine_id = vd.vaccine_id
                                                    INNER JOIN  tbl_staff as sf on sf.staff_id = vd.staff_id ";

                                            if(!empty($action)){
                                            $sql .= "   WHERE vd.vaccine_data_date_next BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL $action DAY) ";
                                            }

                                            $sql .= "        ORDER BY DATEDIFF(vd.vaccine_data_date_next, CURDATE()) ASC ";
                                            $query = $conn->query($sql);
                                            $i = 0;
                                            while ($result = $query->fetch_assoc()) {
                                            $i++;
                                            $vaccine_data_id = $result['vaccine_data_id'];
                                            $days_to_expiry = $result['days_to_expiry'];

                                            $date_next = $result['vaccine_data_date_next'];
                                            $date = date('Y-m-d');
                                            $next_day = round(abs(strtotime($date) - strtotime($date_next))/60/60/24);

                                            $full_name = $result['student_name'] . " " . $result['student_last']. " > " . $result['vaccine_name'] . " : " . $next_day." วัน";
                                            // เพิ่มชื่อเต็มลงใน array
                                            $student_names[] = $full_name;
                                        ?>

                                <?php if($days_to_expiry <= 5){?>
                                <tr class="table-danger">
                                <?php }else{ ?>
                                <tr>
                                <?php } ?>

                                <td> <?php echo $i;?> </td>
                                <td><?php echo $result['student_name'];?>
                                    <?php echo $result['student_last'];?> </td>
                                <td><?php echo $result['vaccine_name'];?></td>
                                <td><?php echo $result['vaccine_data_quantity'];?></td>
                                <td><?php echo $result['vaccine_data_date'];?></td>
                                <td><?php echo $result['vaccine_data_date_next'];?></td>
                                <td><?php echo $result['vaccine_data_note'];?></td>
                                <td><?php echo $result['staff_name'];?> <?php echo $result['staff_lastname'];?></td>
                                <td> <?php echo $result['days_to_expiry'];?> วัน </td>
                            </tr>





                            <?php  } ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <?php
    if(!empty($_GET['line'])){  //เช็คการส่ง Line

    // สร้างข้อความที่รวมรายชื่อนักเรียนทั้งหมด
    $student_list = implode("\n", $student_names);

    // สร้างข้อความสุดท้าย
    $message = "New..! รายชื่อนักเรียนถึงกำหนดน้อยกว่า 5 วัน : \n" . $student_list;

    // แสดงข้อความ
    //echo $message;

    $token_line = "guYfA3rKvOt8AVChLNaBdJTezd1cfUtlFtUdNBV9ZCB";

    if($token_line!=""){ // เช็ค Token Line 

        $sToken = $token_line;
        $sMessage = $message;
        $chOne = curl_init();
        curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
        curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt( $chOne, CURLOPT_POST, 1);
        curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage);
        $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
        curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec( $chOne );
        //Result error
        if(curl_error($chOne))
        {
            echo 'error:' . curl_error($chOne);
        }
        else {
            $result_ = json_decode($result, true);
        //	echo "status : ".$result_['status']; echo "message : ". $result_['message'];
        }
        curl_close( $chOne );

    }//if





    }
     ?>




    <?php include "footer.php";?>

    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
    </script>