<?php

$conn = mysqli_connect("localhost", "root", "", "emis_v19_9") or die("connection failed");
?>
<?php
$filename = $_POST['filename'];
$url = $_POST['url'];
$student_id = $_POST['student_id'];
$rpt_date = $_POST['rpt_date'];

// $sql = "INSERT INTO `save_URL`( `url`, `label`) VALUES ('$url','$filename')";
$sql = "INSERT INTO `lock_edu_exams`( `url`,`label`, `student_id`, `report_date`) VALUES ('$url','$filename','$student_id','$rpt_date')";
if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
}

$subjects = $_POST['arra'];

foreach ($subjects as $array) {
        foreach ($array as $key => $jsons) { // This will search in the 2 jsons
                foreach ($jsons as $key => $value) {
                        //  echo json_encode($value);
                        //  echo  json_encode($key);
                        // mysqli_query($conn, "INSERT INTO `save_URL_data` (`feild`, `value`,`save_URL_id`) VALUES('$key','$value','$last_id')");   , `parent_key`
                        mysqli_query($conn, "INSERT INTO  `lock_edu_exams_details`(`lock_edu_exam_id`, `feild`, `value`)  VALUES('$last_id','$key','$value')");
                }
        }
}


?>
