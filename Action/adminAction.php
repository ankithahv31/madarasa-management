<?php
require_once '../db/db.class.php';
$db = new DB();
session_start();
require_once '../vendor/autoload.php';
require_once '../mailer/mailer.php';
$currentYear = date('Y');
if (isset($_POST['command'])) {
    $command = $_POST['command'];
    if ($command == "login") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if ($username == "Admin" && $password == "Admin") {
            header('Location:../Admin/home.php');
        } else {
            echo "<script>alert('Invalid Credentials'); window.location.href='../Admin/login.php'</script>";
        }
    } elseif ($command == "AddStaff") {
        $name = $_POST['name'];
        $Contact = $_POST['Contact'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $password = $_POST['password'];
        $file = $_FILES['image'];

        $randomNumber = rand(9999, 100000000);
        $filename = "Staff-" . $randomNumber . $file["name"];
        $targetFilePath = "../media/Staff/" . "Staff-" . $randomNumber . $file["name"];
        $tempFilePath = $file["tmp_name"];

        $sql1 = "SELECT * FROM staff WHERE contact='$Contact'";
        $sql2 = "SELECT * FROM staff WHERE email='$email'";
        $result1 = $db->executeSelect($sql1);
        $result2 = $db->executeSelect($sql2);

        if (count($result1) > 0) {
            echo "<script>alert('Phone Number Already Exist'); window.location.href='../Admin/staff.php'</script>";
        } elseif (count($result2) > 0) {
            echo "<script>alert('Email Id Already Exist'); window.location.href='../Admin/staff.php'</script>";
        } else {
            $insert = "INSERT INTO staff(name,contact,email,address,image,password)";
            $values = " VALUES('$name','$Contact','$email','$address','$filename','$password')";
            $sql = $insert . $values;
            $res = $db->executeInsertAndGetId($sql);

            $mailBody = "Your login Credentials for madarasa management system is: \nEmail->" . $email . "\nPassword->" . $password;

            if ($res > 0) {
                move_uploaded_file($tempFilePath, $targetFilePath);

                sendMail("Login Credentials", $mailBody, $email);

                echo "<script>alert('Successfully Added'); window.location.href='../Admin/staff.php'</script>";
            } else {
                // echo 'Something went wrong. Try again';
                echo "<script>alert('Something went wrong. Try again'); window.location.href='../Admin/staff.php'</script>";
            }
        }
    } elseif ($command == "updateStaffStatus") {
        $id = $_POST['id'];
        $flag = $_POST['flag'];
        $query = "UPDATE staff SET flag = '$flag' WHERE id = '$id'";
        $res = $db->executeUpdate($query);
    } elseif ($command == "saveClass") {
        $dataArray = $_POST['datalist'];
        try {
            $sql = "INSERT INTO time_table (subject_id, sloat_id, day,class,satff_id) VALUES (?, ?, ?, ?, ?)";
            $stmt = $db->con->prepare($sql);
            // Loop through the data array and execute the statement for each row
            foreach ($dataArray as $Data) {
                $stmt->bind_param(
                    "sssss",
                    $Data['subject'],
                    $Data['sloat'],
                    $Data['day'],
                    $Data['Class'],
                    $Data['staff']
                );
                $stmt->execute();
            }

            $stmt->close();
        } catch (Exception $ex) {
            throw $ex;
        }
    } elseif ($command == "AddEvent") {
        $title = $_POST['title'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $Venue = $_POST['Venue'];
        $description = $_POST['description'];
        $file = $_FILES['image'];


        $randomNumber = rand(9999, 100000000);
        $filename = "Event-" . $randomNumber . $file["name"];
        $targetFilePath = "../media/Event/" . $filename;
        $tempFilePath = $file["tmp_name"];

        $select = "SELECT email FROM admission_form";
        $emailData = $db->executeSelect($select);

        $insert = "INSERT INTO event(evt_title,evt_date,evt_time,evt_venue,evt_discription,evt_image)";
        $values = " VALUES('$title','$date','$time','$Venue','$description','$filename')";
        $sql = $insert . $values;
        $res = $db->executeInsertAndGetId($sql);
        if ($res > 0) {
            move_uploaded_file($tempFilePath, $targetFilePath);
            $is_send = SendEventMail($title, $date, $time, $Venue, $description, $targetFilePath, $emailData, $filename);
            if ($is_send) {
                echo "<script>alert('Successfully Completed'); window.location.href='../Admin/Event.php'</script>";
            } else {
                echo "<script>alert('Error in send a mail'); window.location.href='../Admin/Event.php'</script>";
            }
        } else {
            // echo 'Something went wrong. Try again';
            echo "<script>alert('Something went wrong. Try again'); window.location.href='../Admin/Event.php'</script>";
        }
    } elseif ($command == "updateEventStatus") {
        $id = $_POST['id'];
        $flag = $_POST['flag'];
        $query = "UPDATE event SET evt_enabled = '$flag' WHERE event_id = '$id'";
        $res = $db->executeUpdate($query);
    } elseif ($command == "UpdateAdmissionStatus") {
        $id = $_POST['id'];
        $flag = $_POST['flag'];
        $query = "UPDATE admission_form SET status = '$flag' WHERE add_id = '$id'";
        $res = $db->executeUpdate($query);
    } elseif ($command == "SaveResult") {
        $class = $_POST['class'];
        $year = $_POST['year'];
        $file = $_FILES['document'];

        $randomNumber = rand(9999, 100000000);
        $filename = "Result-" . $randomNumber . $file["name"];
        $targetFilePath = "../media/Result/" . $filename;
        $tempFilePath = $file["tmp_name"];

        $select = "SELECT email FROM admission_form WHERE student_class=$class";
        $emailData = $db->executeSelect($select);


        $insert = "INSERT INTO result(class,year,filename)";
        $values = " VALUES('$class','$year','$filename')";
        $sql = $insert . $values;
        $res = $db->executeInsertAndGetId($sql);
        if ($res > 0) {
            move_uploaded_file($tempFilePath, $targetFilePath);
            $is_send = SendResultMail($emailData, $filename, $targetFilePath);
            if ($is_send) {
                echo "<script>alert('Successfully Completed'); window.location.href='../Admin/result.php'</script>";
            } else {
                echo "<script>alert('Error in send a mail'); window.location.href='../Admin/result.php'</script>";
            }
        } else {
            // echo 'Something went wrong. Try again';
            echo "<script>alert('Something went wrong. Try again'); window.location.href='../Admin/result.php'</script>";
        }
    } elseif ($command == "newAdmission") {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $hname = $_POST['hname'];
        $p_add_contatc = $_POST['p_add_contatc'];
        $body_mark = $_POST['body_mark'];
        $acc_date = $_POST['acc_date'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $mname = $_POST['mname'];
        $f_or_mname = $_POST['f_or_mname'];
        $parent_rel = $_POST['parent_rel'];
        $parent_job = $_POST['parent_job'];
        $prev_name = $_POST['prev_name'];
        $tc_date = $_POST['tc_date'];
        $adm_class = $_POST['adm_class'];
        $Email = $_POST['email'];
        $Contact = $_POST['contct'];
        $file = $_FILES['image'];

        $randomNumber = rand(9999, 100000000);
        $filename = "Admission-" . $randomNumber . $file["name"];
        $targetFilePath = "../media/Admission/" . $filename;
        $tempFilePath = $file["tmp_name"];


        $insert = "INSERT INTO admission_form (fname, mname, lname, gender, father_mother_name, home_name, pname_add_contact, prnt_relation_w_stud, parent_job, stud_dob, stud_admn_class, body_mark, prev_madras_name, acceptance_no_date, tc_date, image_name,student_class,email,contact)";
        $values = " VALUES ('$fname', '$mname', '$lname', '$gender', '$f_or_mname', '$hname', '$p_add_contatc', '$parent_rel', '$parent_job', '$dob', '$adm_class', '$body_mark', '$prev_name', '$acc_date', '$tc_date', '$filename','$adm_class','$Email','$Contact')";


        $sql = $insert . $values;
        // echo $sql;
        $res = $db->executeInsertAndGetId($sql);
        if ($res > 0) {
            move_uploaded_file($tempFilePath, $targetFilePath);
            echo "<script>alert('Successfully Saved'); window.location.href='../Admin/Admission.php'</script>";
        } else {
            // echo 'Something went wrong. Try again';
            echo "<script>alert('Something went wrong. Try again'); window.location.href='../Admin/Admission.php'</script>";
        }
    } elseif ($command == "AssignClass") {
        $checkedValues = $_POST["checkbox"];
        $staffid = $_POST["staffid"];
        $year = $_POST["year"];

        try {
            $sql = "INSERT INTO asign_class (classid,staff_id,year) VALUES (?, ?, ?)";
            $stmt = $db->con->prepare($sql);
            // Loop through the data array and execute the statement for each row
            foreach ($checkedValues as $CLass) {
                $stmt->bind_param(
                    "sss",
                    $CLass,
                    $staffid,
                    $year
                );
                $stmt->execute();
                echo "<script>alert('Successfully Assigned'); window.location.href='../Admin/staff.php'</script>";
            }

            $stmt->close();
        } catch (Exception $ex) {
            throw $ex;
        }
    } elseif ($command == "AssignLeave") {
        $staffid = $_POST['staff'];
        $totalEL = $_POST['total_el'];
        $totalCL = $_POST['total_cl'];
        $currentYear = date('Y');
        $insert = "INSERT INTO leave_manage(staff_id,year,total_EL,total_CL)";
        $values = " VALUES($staffid,'$currentYear',$totalEL,$totalCL)";
        $sql = $insert . $values;
        $res = $db->executeInsertAndGetId($sql);
        if ($res > 0) {
            echo "<script>alert('Successfully Saved'); window.location.href='../Admin/assignLeaves.php'</script>";
        } else {
            // echo 'Something went wrong. Try again';
            echo "<script>alert('Something went wrong. Try again'); window.location.href='../Admin/assignLeaves.php'</script>";
        }
    } elseif ($command == "UpdateLeaveStatus") {
        $id = $_POST['id'];
        $flag = $_POST['flag'];
        $leaveType = $_POST['leaveType'];
        $days = $_POST['days'];
        $staffId = $_POST['staffId'];

        $query = "UPDATE staff_leave SET status = '$flag' WHERE l_id = '$id'";
        if ($flag == "1") {
            $sql = "SELECT * FROM leave_manage WHERE staff_id=$staffId AND year='$currentYear'";
            $ResultData = $db->executeSelect($sql);
            if (count($ResultData) > 0) {
                $EL = $ResultData[0]['total_EL'];
                $CL = $ResultData[0]['total_CL'];
                $leaveId = $ResultData[0]['leave_id'];
                if ($leaveType == "1") {
                    if ($EL >= $days) {
                        $leavedays = $EL - $days;
                        $update = "UPDATE leave_manage SET total_EL=$leavedays WHERE leave_id=$leaveId";
                        $db->executeUpdate($update);
                        $res = $db->executeUpdate($query);
                        if ($res > 0) {
                            echo "Successfully Completed";
                        } else {
                            echo "Something went wrong. Try again";
                        }
                    } else {
                        echo "Staff not have enough Earned Leaves";
                    }
                } elseif ($leaveType == '2') {
                    if ($CL >= $days) {
                        $leavedays = $CL - $days;
                        $update = "UPDATE leave_manage SET total_CL=$leavedays WHERE leave_id=$leaveId";
                        $db->executeUpdate($update);
                        $res = $db->executeUpdate($query);
                        if ($res > 0) {
                            echo "Successfully Completed";
                        } else {
                            echo "Something went wrong. Try again";
                        }
                    } else {
                        echo "Staff not have enough Casual Leaves";
                    }
                } elseif ($leaveType == "3") {
                    $res = $db->executeUpdate($query);
                    if ($res > 0) {
                        echo "Successfully Completed";
                    } else {
                        echo "Something went wrong. Try again";
                    }
                }
            } else {
                echo "Please Assign the leave for staff";
            }
        } else {
            $res = $db->executeUpdate($query);
            if ($res > 0) {
                echo "Successfully Completed";
            } else {
                echo "Something went wrong. Try again";
            }
        }
    } elseif ($command == "deleteStudent") {
        $id = $_POST['id'];
        $db->executeUpdate("DELETE FROM attendance WHERE student_id=$id");
        $delete = "DELETE FROM admission_form WHERE add_id=$id";
        $res = $db->executeUpdate($delete);
        echo json_encode($res);
    }
} elseif (isset($_GET['command'])) {
    $command = $_GET['command'];
    if ($command == "getSubject") {
        $Classname = $_GET['class'];
        $sql = "SELECT * FROM subject WHERE class='$Classname'";
        $result = $db->executeSelect($sql);

        $Query = "SELECT * FROM time_table WHERE class='$Classname'";
        $result2 = $db->executeSelect($Query);

        $ResultData = array($result, $result2);

        echo json_encode($ResultData);
    } elseif ($command == "getAssignedClass") {
        $year = $_GET['year'];
        $sql = "SELECT * FROM asign_class WHERE year='$year'";
        $result = $db->executeSelect($sql);
        echo json_encode($result);
    }
}
