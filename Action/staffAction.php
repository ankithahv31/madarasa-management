<?php
require_once '../db/db.class.php';
$db = new DB();
session_start();
require_once '../vendor/autoload.php';
require_once '../mailer/mailer.php';

date_default_timezone_set('Asia/Kolkata');
$currentDate = date('Y-m-d');
$currentTime = date('H:i:s');
$currentYear = date('Y');


if (isset($_POST['command'])) {
    $command = $_POST['command'];
    if ($command == "saveattendance") {
        $checkboxValues = $_POST["checkbox"];
        $StaffId = $_SESSION['Staffid'];
        $Studentclass = $_POST['Studentclass'];
        $temp = 1;
        $sqli = "SELECT * FROM attendance WHERE studentclass=$Studentclass  AND date='$currentDate'AND temp=1";
        $res = $db->executeSelect($sqli);
        if (count($res) > 0) {
            echo "<script>alert('Attendance already taken'); window.location.href='../Staff/Attendance.php'</script>";
        } else {
            try {
                $sql = "INSERT INTO attendance (student_id,studentclass,date,staff_id,attendnce_time,temp,attendance) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $db->con->prepare($sql);
                // Loop through the data array and execute the statement for each row
                foreach ($checkboxValues as $key => $attendance) {
                    $stmt->bind_param(
                        "sssssss",
                        $key,
                        $Studentclass,
                        $currentDate,
                        $StaffId,
                        $currentTime,
                        $temp,
                        $attendance
                    );
                    $stmt->execute();
                    if ($attendance == 0) {
                        $emailId = GetEmaiByID($key, $db);
                        $fname = GetName($key, $db);
                        $lastname = GetLastName($key, $db);
                        $subject="Attendance";
                        $MailBody="Your Child ".$fname." ".$lastname." is absent today";
                        sendMail($subject,$MailBody,$emailId);
                    }
                }
                echo "<script>alert('Successfully Saved'); window.location.href='../Staff/Attendance.php'</script>";

                $stmt->close();
            } catch (Exception $ex) {
                throw $ex;
            }
        }
    } elseif ($command == "applyLeave") {
        $StaffId = $_SESSION['Staffid'];
        $fromDate = $_POST['from_date'];
        $ToDate = $_POST['to_date'];
        $Type = $_POST['type'];
        $Days = $_POST['days'];
        $Description = $_POST['des'];

        $insert = "INSERT INTO staff_leave(staff_id,from_date,to_date,type,days,description)";
        $values = " VALUES($StaffId,'$fromDate','$ToDate',$Type,$Days,'$Description')";
        $sql = $insert . $values;
        $res = $db->executeInsertAndGetId($sql);
        if ($res > 0) {
            echo "<script>alert('Successfully Applied'); window.location.href='../Staff/manageLeave.php'</script>";
        } else {
            // echo 'Something went wrong. Try again';
            echo "<script>alert('Something went wrong. Try again'); window.location.href='../Staff/manageLeave.php'</script>";
        }
    }
} elseif (isset($_GET['command'])) {
    $command = $_GET['command'];
    if ($command == "forgotPassword") {
        $email = $_GET['email'];
        $sql = "SELECT * FROM staff WHERE email='$email'";
        $res = $db->executeSelect($sql);
        if (count($res) > 0) {
            $paswrd = $res[0]['password'];
            $mailBody = "Your password is $paswrd.";

            $is_send = sendMail("Recovery Password", $mailBody, $email);
            if ($is_send) {

                echo "<script>alert('Please Check Your email for login Credentials'); window.location.href='../Staff/login.php'</script>";
            }
        } else {
            echo "<script>alert('Invalid Email id'); window.location.href='../Staff/forgotPassword.php'</script>";
        }
    } elseif ($command == "login") {
        $email = $_GET['email'];
        $password = $_GET['password'];

        $sql = "SELECT * FROM staff WHERE email='$email' AND password='$password'";
        $res = $db->executeSelect($sql);
        if (count($res) > 0) {
            $flag = $res[0]['flag'];
            if ($flag == 1) {
                $_SESSION['Staffid'] = $res[0]['id'];
                header('location:../Staff/home.php');
            } else {
                echo "<script>alert('Please Contact Admin'); window.location.href='../Staff/login.php'</script>";
            }
        } else {
            echo "<script>alert('Invalid User'); window.location.href='../Staff/login.php'</script>";
        }
    } elseif ($command == "getStudentNames") {
        $StudentClass = $_GET['Studentclass'];
        $sql = "SELECT * FROM admission_form WHERE student_class=$StudentClass";
        $sql2 = "SELECT DISTINCT(DATE) AS days FROM attendance WHERE studentclass=$StudentClass";
        $result = $db->executeSelect($sql);
        $result2 = $db->executeSelect($sql2);
        $ResultData = array($result, $result2);

        echo json_encode($ResultData);
    } elseif ($command == "GetAvalilableDays") {
        $Type = $_GET['type'];
        $StaffID = $_SESSION['Staffid'];
        $selct = "SELECT * FROM leave_manage WHERE staff_id=$StaffID AND year='$currentYear'";
        $res = $db->executeSelect($selct);
        if (count($res) > 0) {
            if ($Type == "1") {
                $Days = $res[0]['total_EL'];
            } else {
                $Days = $res[0]['total_CL'];
            }

            echo json_encode(array(
                'days' => $Days,
                'status' => true,
            ));
        } else {
            echo json_encode(array('status' => false));
        }
    }
    // } elseif ($command == "getAsgnedClass") {
    //     $id = $_GET['id'];
    //     $year = $_GET['year'];
    //     $sql = "SELECT * FROM asign_class WHERE staff_id= $id AND YEAR=  $year ORDER BY classid ASC ";
    //     $res = $db->executeSelect($sql);
    //     echo json_encode($res);
    // }
}

function GetEmaiByID($id, $db)
{
    $sql = "SELECT * FROM admission_form WHERE add_id=$id";
    $res = $db->executeSelect($sql);
    $email = $res[0]['email'];
    return $email;
}

function GetName($id, $db)
{
    $sql = "SELECT * FROM admission_form WHERE add_id=$id";
    $res = $db->executeSelect($sql);
    $name = $res[0]['fname'];
    // $lname = $res[0]['fname'];
    return $name;
}


function GetLastName($id, $db)
{
    $sql = "SELECT * FROM admission_form WHERE add_id=$id";
    $res = $db->executeSelect($sql);
    $name = $res[0]['lname'];
    // $lname = $res[0]['fname'];
    return $name;
}



// function UpdateMorningAttendance($checkboxValues, $Studentclass, $currentDate, $db, $currentTime)
// {
//     $sql = "UPDATE attendance SET morning_att = ?, morning_time = ? WHERE studentclass = ? AND date = ? AND student_id = ?";
//     $stmt = $db->con->prepare($sql);

//     if ($stmt === false) {
//         // Handle prepare error
//         echo "Error preparing the statement: " . $db->con->error;
//         exit;
//     }

//     foreach ($checkboxValues as $key => $attendance) {
//         $stmt->bind_param('sssss', $attendance, $currentTime, $Studentclass, $currentDate, $key);

//         $stmt->execute();

//         if ($stmt->error) {
//             // Handle execute error if necessary
//             echo "Error executing the statement: " . $stmt->error;
//             exit;
//         }
//     }

//     if ($stmt->affected_rows > 0) {
//         echo "<script>alert('Successfully Updated'); window.location.href='../Staff/Attendance.php'</script>";
//     } else {
//         echo "<script>alert('Something went wrong! Try again'); window.location.href='../Staff/Attendance.php'</script>";
//     }
// }

// function UpdateEveningAttendance($checkboxValues, $Studentclass, $currentDate, $db, $currentTime)
// {
//     $sql = "UPDATE attendance SET eve_attendance = ?, eve_time = ? WHERE studentclass = ? AND date = ? AND student_id = ?";
//     $stmt = $db->con->prepare($sql);

//     if ($stmt === false) {
//         // Handle prepare error
//         echo "Error preparing the statement: " . $db->con->error;
//         exit;
//     }

//     foreach ($checkboxValues as $key => $attendance) {
//         $stmt->bind_param('sssss', $attendance, $currentTime, $Studentclass, $currentDate, $key);

//         $stmt->execute();

//         if ($stmt->error) {
//             // Handle execute error if necessary
//             echo "Error executing the statement: " . $stmt->error;
//             exit;
//         }
//     }

//     if ($stmt->affected_rows > 0) {
//         echo "<script>alert('Successfully Updated'); window.location.href='../Staff/Attendance.php'</script>";
//     } else {
//         echo "<script>alert('Something went wrong! Try again'); window.location.href='../Staff/Attendance.php'</script>";
//     }
// }
