<!DOCTYPE html>
<html>

<head>
  <title>Submit Form</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" 
  integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" 
  crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="main-block">
    <div class="left-part">
      <i class="fas fa-graduation-cap"></i>

    </div>
    <form action="script.php" method="POST" enctype="multipart/form-data" >
    
      <div class="title">
        <i class="fas fa-pencil-alt"></i>
        <h2>submit form</h2>
      </div>
      <div class="info">
        <input class="fname" type="text" name="name" placeholder="Organization Name" required>
        <!-- <label >Parent Name: </label>
        <label style="color: wheat;" >Qualven </label> -->
        <div>

          <label for="head">choose a color : </label>
          <input  style="height: 40px;" type="color" name="theme" value="#ff0000" required><br><br>
          
        </div>
        <label for="head">choose an image : </label>
        <input  type="file" name="file"  accept="image/*" required>
        <!-- <label for="head">choose a backup file : </label>
        <input  type="file" id="img" name="backup" accept=".sql"> -->
        <input type="date" name="date">

      </div>
      <div class="checkbox">
        <input type="checkbox" name="checkbox"><span>agree</span>
      </div>
      <button type="submit" name="submit">Submit</button>
    </form>
  </div>
</body>
<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "../ewcfg10.php" ?>
<?php include_once "../ewmysql10.php" ?>
<?php include_once "../phpfn10.php" ?>
<?php include_once "../usersinfo.php" ?>
<?php include_once "../userfn10.php" ?>
<?php include_once "connection_func.php"; ?>
<?php //include_once "rpt_checkfile.php" 
?>
<?php
$KoolControlsFolder = "../KoolPHPSuite/KoolControls"; //Relative path to "KoolPHPSuite/KoolControls" folder
require $KoolControlsFolder . "/KoolChart/koolchart.php";
if (!empty($_SERVER['HTTP_USER_AGENT'])) {
  $getsome  = $_SERVER['HTTP_USER_AGENT'];
} else {
  $getsome  = '';
}
function Page_Init()
{
  global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

  // Security
  $Security = new cAdvancedSecurity();
  //if (!$Security->IsLoggedIn()) $Security->AutoLogin();
  if (!$Security->IsLoggedIn()) {
    //$Security->SaveLastUrl();
    Page_Terminate("../login.php");
  }
}

function Page_Terminate($url = "")
{

  // Go to URL if specified
  if ($url <> "") {
    header("Location: " . $url);
  }
  exit();
}

//Execute the Page_Initialization code...
if ($getsome != '') {
  Page_Init();
}

function calculateAge($birthday)
{
  $date = new DateTime($birthday);
  $now = new DateTime();
  $interval = $now->diff($date);

  return $interval->y . (($interval->m > 0) ? "." . $interval->m : "");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
  <script type="text/javascript" src="../jquery/jquery-1.10.2.min.js"></script>
  <script type="text/javascript">
    var str = window.location.pathname;
    var result = str.search(".html");
    if (result > 0) {
      $.post('../reports/rpt_checksession.php', function(data) {
        if (data != '') {
          window.location.href = "../login.php";
        }
      });
    }
  </script>
  <title>Student Assessment Report</title>
  <style type="text/css">
    @media all {
      .page-break {
        display: none;
      }

      .noPrint {
        display: block;
      }
    }

    @media print {

      html,
      body {
        height: 99%;
      }

      .page-break {
        display: block;
        page-break-before: always;
      }

      .noPrint {
        display: none;
      }
    }

    @page {
      size: auto;
      /* auto is the initial value */

      /* this affects the margin in the printer settings */
      margin: 10mm 10mm 10mm 10mm;
    }

    body {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 13px;
      font-weight: normal;
    }

    table {
      border-collapse: collapse;
    }

    table.dottted {
      border-collapse: collapse;
    }

    table.dottted tr td {
      border: 1px solid #000;
    }

    table.bold {
      border-collapse: collapse;
    }

    table.bold tr td {
      border: 4px solid #000;
    }

    table tr td.no-padding {
      padding: 0px !important;
    }

    h1 {
      font-size: 26px;
      font-weight: bold;
      margin: 0px;
      padding: 0px;
    }

    h2 {
      font-size: 18px;
      font-weight: bold;
      margin: 0px;
      padding: 0px;
    }

    .subject {
      /*padding:3px 0 ;*/
      border-bottom: 1px solid;
    }

    .subject tr {
      border-bottom: none;
    }

    .subject tr td {
      padding: 8px;
      border-left: none;
      background-clip: padding-box;
      position: static;
    }

    .achevement-heading {
      padding: .5% 0;
      text-align: center;
      width: 100%;
      font-weight: bold;
      font-size: 15px;
      float: left;
    }

    .dotted-space {
      /*padding:1%;*/
    }

    .subject-space {
      padding: 6px 0;
      border-bottom: 3px solid #000;
    }

    .main-subject-heading {
      font-size: 16px;
      font-weight: bold;
    }

    .gray-heading {
      background: hsla(0, 0%, 80%, 1);

    }

    .gray-small-heading {
      background: hsla(0, 0%, 80%, 1);
      font-size: 10px;
    }

    .rollno {
      color: #999999;
      font-size: 10px;
    }

    .new_header tr td {
      border: 1px solid;
      padding: 5px;
      text-align: center;

    }

    .new_header tr {
      padding: 0;
      margin: 0;
    }

    .new_header {
      border-collapse: collapse;



    }

    .new_header .bold {
      font-weight: bold;
      font-size: 11px;
    }

    .new_header {
      font-size: 11px !important;
    }

    /*.gr_bot tr td
{
      border-top: none;
    border-bottom: none;
  border-left: none;
  border-right: none;
}*/
    /*.dbl_grading  tr td
{
  border-top: none;
  border-bottom: none;
  border-left: none;
  border-right: none;
  height:25px;

}*/
    /*.dbl_grading  tr td
{
  border-top: none;
  border-bottom: none;
  border-left: none;
  border-right: none;

}*/
    /*.this_sess tr td
{
  border:none;

}

.this_sess tr:first-child
{
  border-bottom:1px solid;
}*/
    /*.dbl_grading  tr td:first-child
{
  border-right: 1px solid !important;
}*/
    /*.cen_grade
{
  text-align: center;
  font-weight: bold;
}
*/
    /*.ttl_marks_hide ,.high_marks_hide, .average-marks_hide
{
  display: none;
  border:none;
  border-top: none;
  border-color: transparent;
}*/
    /*.class_line td:first-child
{
  border-right: 1px solid;
}*/
    /*.sub_area_st
{
  margin:1% 1%;
}*/
    .start_change {
      /*border-bottom: 4px solid;*/
    }

    .new_table {
      margin: 1% 0;
      margin-bottom: 0;
      text-align: center;
    }

    .new_table tr td {
      padding: 5px;
      border: 1px solid;
      border-collapse: collapse;
    }

    .sub_title {
      text-align: left;
    }

    .footer_td {
      border: none !important;
    }

    .footer_td table tr td {
      border: none !important;
    }

    .no_border_table table tr td {
      border: none;
      padding: 0;
    }

    /*.no_border_table
{
  background-color: hsla(0,0%,80%,1);
}*/
    .grade_key {
      text-align: left;
    }

    .logo {
      height: 85px;
      width: auto;
    }

    .gap_col {
      border: none !important;
    }

    .class_sec {
      background-color: #CCCCCC;
      border: none !important;
      font-size: 20px;
      font-weight: bold;
      text-align: center;
    }

    .achiev {
      float: left;
      width: 100%;
      margin: 2% 0;
      background-color: hsla(0, 0%, 80%, 1);
      border: 1px solid;
      text-align: center;
    }

    .long_div_right {
      border: 1px solid;

      line-height: 34px;
      padding-top: 0;
      text-align: center;
    }

    .graph_cover {
      margin: 1%;

      width: 100%;
    }
  </style>
</head>

<body>
  <?php

  include_once "connection_func.php";
  include_once "grade_fun.php";


  function getattendancestatus($Student_ID, $Date_of_Commencement)
  {
    global  $db;
    $studentattendanceqry = "SELECT edu_attendance_details.`Status` FROM `edu_attendance`,`edu_attendance_details` WHERE `edu_attendance`.ID = `edu_attendance_details`.edu_attendance_id AND `Student_ID` = '$Student_ID' AND `edu_attendance`.`Date` = '$Date_of_Commencement' ";
    $attendancstatuses = $db->get_results($studentattendanceqry);
    return $attendancstatus = @$attendancstatuses[0]->Status;
  }

  //array for graph
  $subjects_array = array();
  $subjects_marks = array();


  $grade_key = 0;
  /*_______________________________------------_________---------________________________________________------------------------_________________________________________________________*/
  $curStudentID = $_REQUEST['studentID'];
  $curSessionID = $_REQUEST['sessionID'];
  $curExamTypeID  = $_REQUEST['eduExamTypeID'];
  $curExamMonth = $_REQUEST['examMonth'];
  $curExamYear  = $_REQUEST['examYear'];

  $avail_atten = $_REQUEST['avail_atten'];
  $total_atten = $_REQUEST['total_atten'];


  $anddate = "AND `Date` BETWEEN '$avail_atten' AND '$total_atten'";
  $attandanceqry = "SELECT COUNT(ID) Totalclassattendance FROM `edu_attendance` WHERE `Edu_Session_ID` = '$curSessionID' $anddate ";
  $totalattandance = $db->get_results($attandanceqry);
  $totalclassattandance = $totalattandance[0]->Totalclassattendance;

  //Query to retrieve the current edu_session with student's basic info...
  $qry  = "SELECT edu_sessions.ID,
  edu_sessions.Title AS SessionTitle,
  edu_sessions_students.Comments,
  edu_sessions_students.Attendance_Count,
  cfg_classes.Class_Name,
  cfg_academic_years.Year,
  cfg_sections.Title AS SectionTitle,
  cfg_sections.Short_Name,
  cfg_classes.Level,
  students.Registration_Nr,
  students.ID as std_id,
  students.Name_of_Student,
  students.Date_of_Birth
FROM edu_sessions
  INNER JOIN cfg_academic_years ON cfg_academic_years.ID =  edu_sessions.Academic_Year_ID
  INNER JOIN cfg_classes ON edu_sessions.Class_ID = cfg_classes.ID
  INNER JOIN cfg_sections ON edu_sessions.Section_ID = cfg_sections.ID
  INNER JOIN edu_sessions_students  ON edu_sessions.ID = edu_sessions_students.edu_sessions_id
  INNER JOIN students ON students.ID = edu_sessions_students.Student_ID
WHERE
  edu_sessions.status = 'Active'
  AND students.Current_Status = 'Enrolled'
  AND edu_sessions.Class_ID = cfg_classes.ID 
  AND edu_sessions.ID = " . $curSessionID . "
  AND students.ID= " . $curStudentID . " 
    
  ORDER BY edu_sessions.ID DESC"; //sort in DESC of sessions, to show the result of latest session (in case of Error/incorrect data...)

  $studentsAges = array();
  $comulativeAge  = 0;
  $studentsCount  = 0;
  $loop_pros = $db->get_results($qry);
  foreach ($loop_pros as $row) {
    //retrieve a single row of Active Session available for a student
    // print_r($row); exit;
    $curStudentID = $row->std_id;
    $studentsAges[$curStudentID]  = calculateAge($row->Date_of_Birth);
    $comulativeAge  = round($comulativeAge) + $studentsAges[$curStudentID];
    $studentsCount++;

    if (!empty($_REQUEST['studentID']) && $curStudentID != $_REQUEST['studentID']) {
      continue;
    }
    $maxAttendance  = 0;
    $presentAttend  = 0;
    //Retrieve the commulative of each Attendance_Status for a Selected Student of selected Session...
    $attendanceQry  = "SELECT COUNT(edu_attendance_details.Status) as ctr, edu_attendance_details.Status
            FROM edu_attendance
              INNER JOIN edu_attendance_details ON edu_attendance.ID =
              edu_attendance_details.edu_attendance_id
            WHERE edu_attendance.Edu_Session_ID = " . $curSessionID . " 
              AND edu_attendance_details.Student_ID = " . $curStudentID . "  
            GROUP BY edu_attendance_details.Status";


    if ($attenRS = $db->get_results($attendanceQry)) { //if any attendance marked for this student in this Session...
      foreach ($attenRS as $atten) { //iterate for all available statuses of student
        $maxAttendance  +=  $atten->ctr;

        if ('Present' == $atten->Status) //mark it as present attendance
          $presentAttend  = $atten->ctr;
      }
    }
  ?>

    <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="17%" height="127px" valign="middle" class="logo"><img src="images/logo.jpg" class="logo" width="90" height="100" /></td>
        <td width="83%" valign="middle">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="81%" align="center" valign="bottom">
                <h1>THE SCIENCE SCHOOL <br></h1>
              </td>
              <td width="19%" align="left" valign="bottom">&nbsp;</td>
            </tr>
            <tr>
              <td align="center" valign="top">
                <h2><u><br><?php
                            $examType = array();
                            $examTypeQry  = "SELECT Title,Weightage from cfg_exam_types where ID=" . $curExamTypeID;
                            $examType  = $db->get_row($examTypeQry);
                            // echo json_encode($examType);
                            if (!empty($examType)) {
                              echo $examType->Title;
                            } else {
                              echo "Exams";
                            }
                            if ($curExamTypeID != 103) {
                              echo ' Assessment Report';
                            } ?></u>
                  <br />
                  <?php
                  /*   $setmonth = round((intval($curExamMonth)-1)%12);
          if($setmonth==-1)
          {
            $setmonth = 11;
          } 
          
          $month1=date_create($curExamYear."-".$setmonth."-01");
            $month2=date_create($curExamYear."-".round((intval($curExamMonth)-0)%12)."-01"); ?>
            <?=(($examType->Title=="Bimonthly")?date_format($month1, "M")." - ":"").date_format($month2, "M Y");*/ ?> <?php $dateObj   = DateTime::createFromFormat('!m', $curExamMonth);
                                                                                                                      echo $monthName = $dateObj->format('F') . " " . $curExamYear; ?>
                </h2>
              </td>
              <td align="left" valign="top">&nbsp;</td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="2" valign="top">
          <table width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="dotted-space">

                      <table width="100%" border="0" cellspacing="0" cellpadding="5" class="dottted">
                        <tr>
                          <td width="10%">Name</td>
                          <td width="35%" colspan="3"><strong><?= $row->Name_of_Student ?></strong></td>
                          <td width="17%">Reg No.</td>
                          <td width="16%"><strong><?php echo $row->Registration_Nr ?></strong></td>
                          <td width="2%" class="gap_col"></td>
                          <td width="20%" rowspan="2" class="class_sec"><?= $row->Class_Name . '-' . $row->SectionTitle ?></td>
                        </tr>

                        <!--<tr>
                <td>Attendance</td>
                 <?php
                  /*$attandancestudentqry = "SELECT COUNT(edu_attendance.ID) Totalstudentattendance FROM `edu_attendance`,`edu_attendance_details` WHERE `edu_attendance`.ID = `edu_attendance_details`.edu_attendance_id AND `Edu_Session_ID` = $curSessionID AND `Student_ID` = '$curStudentID'  AND `edu_attendance_details`.`Status`='Present' $anddate ";
                $totalattandancestudent = $db->get_results($attandancestudentqry);
                $Totalstudentattendance = $totalattandancestudent[0]->Totalstudentattendance;*/
                  ?>
                <td><strong><? //=$Totalstudentattendance 
                            ?></strong></td>
                <td>Days out of</td>
                <td><strong><? //=$totalclassattandance 
                            ?></strong></td>
                <td>Pupil’s Age </td>
                <td><strong><div name="avgAges"><? //=$studentsAges[$curStudentID] 
                                                ?></div></strong></td>
                <td class="gap_col"></td>
                
              </tr>-->
                      </table>

                    </td>
                  </tr>
                  <tr class="achiev">
                    <td align="center" class="achevement-heading">Achievement</td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr width="100%">
              <td>
                <table width="100%">
                  <!-- custom starts by rehan -->

                  <tr>
                    <!-- custom changes by rehan -->
                    <td class="start_change" width="78%">
                      <table width="100%" border="0" cellspacing="0" cellpadding="4px" class="new_header">
                        <tr>
                          <td class="bold" width="30%" rowspan="2" colspan="3">Subjects / Remarks</td>
                          <td class="bold" width="35%">Marks Obtained</td>
                          <!-- <td class="bold" width="18%" rowspan="2">Grade</td> -->
                          <td class="bold" width="35%">Highest Total</td>
                          <!--<td style="width:18%;">Average Total</td>-->
                        </tr>
                        <tr>
                          <td><strong><?php /*if($row->Class_Name=='A-I'){ echo 40; }else{*/ echo $examType->Weightage;
                                      // echo $examType;
                                      // exit(); /*}*/ 
                                      ?></strong></td>
                          <td><strong><?php /*if($row->Class_Name=='A-I'){ echo 40; }else{*/ echo $examType->Weightage; /*}*/ ?></strong></td>
                          <!--<td >100</td> -->
                        </tr>

                      </table>
                    </td>
                    <td width="2%" rowspan="2">

                    </td>
                    <td width="20%" rowspan="2" class="long_div_right">

                      <strong>Grade Key</strong> <br></br>
                      <?php
                      gradekeys($gradesarray);
                      ?>



                    </td>

                  </tr>

                  <tr width="100%">
                    <td width="78%">
                      <table class="new_table" width="100%" border="0">

                        <?php
                        //Query to get all the registered Subjects of student (in current edu_session)
                        //first get all the mendetory subjects with union of selected optional subjects
                        $subjectsQry = "SELECT cfg_subjects.ID,
                                          cfg_subjects.Subject,
                                          concat(cfg_subjects.Short_Name,'.') as Short_Name,
                                          cfg_subjects.Assessment_Policy,
                                          cfg_subjects.Level
                                        FROM edu_sessions_subjects
                                          INNER JOIN cfg_subjects ON edu_sessions_subjects.Subject_ID = cfg_subjects.ID
                                        WHERE edu_sessions_subjects.edu_sessions_id = " . $row->ID . "
                                        AND edu_sessions_subjects.subject_status = 1
                                        
                                        UNION
                                        SELECT cfg_subjects.ID, cfg_subjects.Subject, concat(cfg_subjects.Short_Name,'.') as Short_Name, cfg_subjects.Assessment_Policy, cfg_subjects.Level FROM
                                        cfg_subjects,`edu_sessions_students_subjects`, edu_sessions_students,edu_sessions_subjects WHERE 
                                        edu_sessions_students.ID = edu_sessions_students_subjects.edu_sessions_students_id and 
                                        edu_sessions_subjects.ID = edu_sessions_students_subjects.edu_sessions_subjects_id and
                                        edu_sessions_students.Student_ID = " . $row->std_id . " and `edu_sessions_subjects`.`Subject_ID` = cfg_subjects.ID AND edu_sessions_students.edu_sessions_id='" . $row->ID . "'
                                        ORDER BY `Level` ASC";
                        //===========================================================================================================================================================================

                        //query to select only optional subjects
                        //SELECT cfg_subjects.ID, cfg_subjects.Subject, cfg_subjects.Assessment_Policy, cfg_subjects.Level FROM cfg_subjects,`edu_sessions_students_subjects`, edu_sessions_students,edu_sessions_subjects WHERE edu_sessions_students.ID = edu_sessions_students_subjects.edu_sessions_students_id and edu_sessions_subjects.ID = edu_sessions_students_subjects.edu_sessions_subjects_id and edu_sessions_students.Student_ID = 1086 and `edu_sessions_subjects`.`Subject_ID` = cfg_subjects.ID
                        //  var_dump($subjectsQry);
                        $graphmarks = array();
                        $graphsubject = array();
                        //   echo json_encode($graphmarks);
                        // //  var_dump( $graphsubject = array());
                        //  echo implode(",",$graphsubject);


                        if ($subjectsOfSession = $db->get_results($subjectsQry)) { //get the list of all subjects in this session
                          // echo json_encode($subjectsOfSession);
                          // var_dump($subjectsOfSession);
                          // echo implode($subjectsOfSession);

                          foreach ($subjectsOfSession as $subj) { //iterate for all subjects offered in current session

                            //default values for result
                            // echo implode($subj);
                            // var_dump($subj);
                            // var_dump($subjectsOfSession);

                            if ($subj->Short_Name == 'Pak Std(Geo).') {
                              $graphsubject[] = 'PS(Geo)';
                            } elseif ($subj->Short_Name == 'Pak Std(Hist).') {
                              $graphsubject[] = 'PS(Hist)';
                            } else {
                              $graphsubject[] = $subj->Short_Name;
                              // var_dump($subj);
                            }

                            // echo implode(",",$graphsubject);
                            $maxAggregateResult   = array();
                            $aggregateResult    = array();

                            $idsOfStudents    = array();
                            $attendancearray      = array();

                            $premaxAggregateResult   = array();
                            $preaggregateResult     = array();
                            $preidsOfStudents    =   array();
                            //get the list of all exams (for Subject=CURRENT, Session=CURRENT, Student=CURRENT, examType=CURRENT, examMonth=CURRENT)
                            $resultQry  = "SELECT Sum(edu_exams_details.Marks_Obtained) AS Marks_Obtained_Sum,
                                            Sum(edu_exams.Max_Marks) AS Max_Marks_Sum,
                                            cfg_exam_types.Weightage AS Weightage,
                                            edu_exams_details.Student_ID,
                                            edu_exams.Result_Type_ID,
                                            edu_exams.Exam_Type_ID,
                                            edu_exams_details.Remarks,
                                            Date_of_Commencement
                                          FROM edu_exams
                                            INNER JOIN edu_exams_details ON edu_exams.ID = edu_exams_details.Edu_Exams_ID
                                            INNER JOIN cfg_exam_types ON edu_exams.Exam_Type_ID = cfg_exam_types.ID
                                          WHERE edu_exams.Edu_Session_ID = " . $curSessionID . " 
                                            AND edu_exams.Subject_ID = " . $subj->ID . "
                                            AND edu_exams.Exam_Type_ID = '" . $curExamTypeID . "'
                                            AND (edu_exams.Status = 'Marked' OR edu_exams.Status = 'Locked')
                                            AND edu_exams.Exam_Month = " . $curExamMonth . "
                                            
                                            GROUP BY 
                                            edu_exams_details.Student_ID, 
                                            edu_exams.Exam_Type_ID";
                            // AND edu_exams_details.Student_ID = ".$curStudentID."

                            //echo $resultQry."<br/>"; 


                            if ($results = $db->get_results($resultQry)) { //retrieve the commulative marks for the CURRENT ExamTypes

                              // echo json_encode($results);
                              foreach ($results as $eoyR) {

                                if (array_search($eoyR->Student_ID, $idsOfStudents) === FALSE) {
                                  //initialize the array indexes for each Student of the sesssion
                                  $maxAggregateResult[$eoyR->Student_ID]    = 0;
                                  $aggregateResult[$eoyR->Student_ID]     = 0;
                                  $idsOfStudents[]  = $eoyR->Student_ID;
                                }
                                // echo json_encode($eoyR);


                                $maxAggregateResult[$eoyR->Student_ID]  = $maxAggregateResult[$eoyR->Student_ID] + $eoyR->Weightage + 0;
                                $aggregateResult[$eoyR->Student_ID]   +=  ($eoyR->Marks_Obtained_Sum / $eoyR->Max_Marks_Sum) * $eoyR->Weightage;
                                //get student attendance on exam day// if absent than absent if present then marks
                                $attendancstatus = getattendancestatus($eoyR->Student_ID, $eoyR->Date_of_Commencement);

                                $attendancearray[$eoyR->Student_ID]   = 'Present'; //$attendancstatus;
                              }
                              //echo "<br/>DONE ".$subj->ID;
                            }

                            $sectionAvg   = 0;
                            $avgCount = 0;
                            $sectionHighest = 0;
                            foreach ($idsOfStudents as $stdID) { //traverse for the result of all students (taking this subject of the session)

                              //Round all the floating point values (by consider a fact that the Array will be empty for UnMarked Subjects of the session
                              $maxAggregateResult[$stdID]   = (isset($maxAggregateResult[$stdID])) ? $maxAggregateResult[$stdID] : 0;
                              $aggregateResult[$stdID]    = (isset($aggregateResult[$stdID])) ?    $aggregateResult[$stdID] : 0;

                              if ($aggregateResult[$stdID] > $sectionHighest) {
                                $sectionHighest = $aggregateResult[$stdID]; //mark as Highest
                              }

                              if ($aggregateResult[$stdID] > 0) { //Calculate AVG only if the result of current student is NOT 0 (means NOT Absent)
                                $sectionAvg = $sectionAvg + $aggregateResult[$stdID]; //Commute the values
                                $avgCount++;
                              }
                            }

                            if ($avgCount > 0) {
                              $sectionAvg = ($sectionAvg / $avgCount); //Get Avg value
                            }
                            //echo "<br/>Avg is: ".($sectionAvg/$avgCount);//devide by Total number to get Avg
                            // current exam id 
                            $asessmentsqry    = "SELECT ID,Result_Type_ID FROM `edu_exams` WHERE `Edu_Session_ID` = " . $curSessionID . " AND `Subject_ID` = " . $subj->ID . " AND `Exam_Type_ID` IN (107,108) AND `Exam_Month` = " . $curExamMonth . " AND `Status` IN ('Marked', 'Locked')";
                            $asessmentsresult = $db->get_results($asessmentsqry);
                            // var_dump($asessmentsresult);
                            $current_exam_ID  =  @$asessmentsresult[0]->ID;
                            $Result_Type_IDc  =  @$asessmentsresult[0]->Result_Type_ID;

                            $previousquery      = "SELECT Exam_Type_ID,Exam_Month FROM `edu_exams` WHERE ID < '" . $current_exam_ID . "' AND `Edu_Session_ID` = " . $curSessionID . " AND `Subject_ID` = " . $subj->ID . " AND `Exam_Type_ID` IN (107,108) AND `Status` IN ('Marked', 'Locked') AND Result_Type_ID = '" . $Result_Type_IDc . "' ORDER BY ID DESC LIMIT 0,1";
                            $previousresults    = $db->get_results($previousquery);
                            if (sizeof($previousresults) > 0) {
                              $precurExamMonth    = $previousresults[0]->Exam_Month;
                              $precurExamTypeID   = $previousresults[0]->Exam_Type_ID;
                              $preresultQry  = "SELECT Sum(edu_exams_details.Marks_Obtained) AS Marks_Obtained_Sum,
                    Sum(edu_exams.Max_Marks) AS Max_Marks_Sum,
                    cfg_exam_types.Weightage AS Weightage,
                    edu_exams_details.Student_ID,
                    edu_exams.Result_Type_ID,
                    edu_exams.Exam_Type_ID,
                    edu_exams_details.Remarks
                  FROM edu_exams
                    INNER JOIN edu_exams_details ON edu_exams.ID = edu_exams_details.Edu_Exams_ID
                    INNER JOIN cfg_exam_types ON edu_exams.Exam_Type_ID = cfg_exam_types.ID
                  WHERE edu_exams.Edu_Session_ID = " . $curSessionID . " 
                    AND edu_exams.Subject_ID = " . $subj->ID . "
                    AND edu_exams.Exam_Type_ID = '" . $precurExamTypeID . "'
                    AND (edu_exams.Status = 'Marked' OR edu_exams.Status = 'Locked')
                    AND edu_exams.Exam_Month = " . $precurExamMonth . "                        
                    GROUP BY 
                    edu_exams_details.Student_ID, 
                    edu_exams.Exam_Type_ID";

                              //AND edu_exams_details.Student_ID = ".$curStudentID."
                              //echo $resultQry."<br/>";       

                              if ($preresults = $db->get_results($preresultQry)) {

                                foreach ($preresults as $preresult) {
                                  if (array_search($preresult->Student_ID, $preidsOfStudents) === FALSE) {
                                    //initialize the array indexes for each Student of the sesssion
                                    $premaxAggregateResult[$preresult->Student_ID]    = 0;
                                    $preaggregateResult[$preresult->Student_ID]     = 0;
                                    $preidsOfStudents[]  = $preresult->Student_ID;
                                  }


                                  //echo "->weightage: ".$preresult->Student_ID." ".$maxAggregateResult[$preresult->Student_ID];

                                  /*if($row->Class_Name=='A-I')
              {
                $premaxAggregateResult[$preresult->Student_ID]  = $premaxAggregateResult[$preresult->Student_ID]+$eoyR->Max_Marks_Sum;
              $preaggregateResult[$preresult->Student_ID]   +=  $preresult->Marks_Obtained_Sum;
              }
              else
              {*/
                                  $premaxAggregateResult[$preresult->Student_ID]  = $premaxAggregateResult[$preresult->Student_ID] + $preresult->Weightage + 0;
                                  $preaggregateResult[$preresult->Student_ID]   +=  ($preresult->Marks_Obtained_Sum / $preresult->Max_Marks_Sum) * $preresult->Weightage;
                                  /*}*/
                                }
                              }
                            }
                            //end previous exam
                            if ($subj->Assessment_Policy == "Grades" && $grade_key == 0) {
                              $grade_key = 1;
                            }
                            if (array_search($curStudentID, $idsOfStudents) !== FALSE) {
                        ?>
                              <!-- start new table -->

                              <?php
                              if ($subj->Assessment_Policy == "Grades") { //if its a Grading type subject 
                              ?>

                                <?php


                                //find grade otherwise absent

                                if ($aggregateResult[$curStudentID] > 0) {
                                  $percent  = ($aggregateResult[$curStudentID] / $maxAggregateResult[$curStudentID]) * 100;
                                  $percent_marks = $percent;
                                  $percent  = generateGradeByPercent($percent, $gradesarray);
                                } else {
                                  $percent  = "Absent";
                                }
                                if ($percent != "Absent") {
                                  array_push($subjects_array, $subj->Short_Name);
                                  array_push($subjects_marks, (int)$percent_marks);

                                  ?>
                                
                                  <tr>
                                    <td width="30%" class="sub_title main-subject-heading"><?php echo $subj->Subject; ?>
                                     </td>
                                    <!-- <td><strong><?= $percent_marks ?></strong></td> -->
                                    <td colspan="2"><strong>
                                        <?php
                                        if (trim($percent) == "A*") {
                                          echo $percent;
                                        } else if (trim($percent) == "A") {
                                          echo $percent;
                                        } else if (trim($percent) == "B") {
                                          echo $percent;
                                        } else if (trim($percent) == "C") {
                                          echo $percent;
                                        } else if (trim($percent) == "D") {
                                          echo $percent;
                                        } else if (trim($percent) == "U") {
                                          echo $percent;
                                        } else {
                                          echo '-';
                                        }
                                        ?>
                                      </strong></td>

                                  </tr>
                                <?php
                                } else {
                                  array_push($subjects_array, $subj->Short_Name);
                                  array_push($subjects_marks, 0);
                                ?>
                                  <tr>
                                    <td width="30%" class="main-subject-heading sub_title"><?= $subj->Subject ?></td>

                                    <td colspan="4"><strong><?= $percent ?>&nbsp;</strong></td>
                                  </tr>
                                <?php } ?>
                              <?php

                              } else {

                                $var_graphmarks = (int)round($aggregateResult[$curStudentID]);
                                $presubid = (int)$subj->ID;
                                $graphmarks[$curExamMonth][$presubid] = $var_graphmarks;
                                @$graphmarks[$precurExamMonth][$presubid] = (int)round($preaggregateResult[$curStudentID]);

                                array_push($subjects_array, $subj->Short_Name);
                                array_push($subjects_marks, (int)round($aggregateResult[$curStudentID]));
                                // echo implode($subjects_marks);
                              ?>

                                <tr>
                                  <?php
                                  // var_dump(strlen($subj->Subject)); 
                                  ?>
                                  <td width="30%" class="sub_title main-subject-heading"><?php if (strlen($subj->Subject) < 17) {
                                             echo $subj->Subject;
                                                } else {
                                                    echo  substr($subj->Short_Name, 0, -1);
                                    } ?></td>

                                  <?php
                                  if (($attendancearray[$curStudentID] == 'Absent') ||
                                    (sprintf("%02d", round($aggregateResult[$curStudentID])) < 1)
                                  ) { ?>

                                    <td colspan="4" width="60%"><strong> Absent&nbsp; </strong></td>
                                  <?php
                                  } else { ?>
                                    <td width="35%" colspan="2"><strong><?= sprintf("%02d", round($aggregateResult[$curStudentID])) ?></strong></td><!-- this puts current student marks-->
                                    <td width="35%" colspan="2"><strong><?= sprintf("%02d", round($sectionHighest)) ?></strong></td>
                                    <!--var_dump( sprintf("%02d", round($sectionHighest)) ) this function put highest marks taken from class in table -->
                                  <?php
                                  } ?>


                                </tr>
                              <?php
                              }
                            } else {
                              $var_graphmarks = 0;
                              $presubid = (int)$subj->ID;
                              $graphmarks[$curExamMonth][$presubid] = (int)$var_graphmarks;
                              @$graphmarks[$precurExamMonth][$presubid] = 0;

                              array_push($subjects_array, $subj->Short_Name);
                              array_push($subjects_marks, 0);
                              // var_dump($subjects_array); // array of subjects
                              // echo json_encode($subjects_array); // array of subjects----------------------------_______________________________________________________________________________________________
                              // echo json_encode($subjects_marks); // array of subjects
                              ?>
                              <tr>
                                <td width="30%" class="sub_title main-subject-heading"><?= $subj->Subject; //var_dump($subj->Subject)---->this function putt subjects name in report

                                                                      global $only_subjects; 
                                                                          $only_subjects= $subj->Subject;
                                                                          //  echo json_encode($only_subjects);
                                                                          // echo json_encode($subj->Subject);

                                                               ?></td>
                                <td width="70%" colspan="4">-</td>

                              </tr>
                        <?php
                            } //ending loop
                          }
                        } //ending the if of subjects.. 
                        ?>
                    </td>

                  </tr>
                </table>
              </td>
            </tr>
          </table>
          <!-- custom ends by rehan -->
    </table>
    </td>

    </tr>
    <tr class="graph_cover">


      <td colspan="5">
        <table width="100%;">
          <tr style="margin-top: 3%;float: left;border: 1px solid;width: 100%;">
            <td>

              <div class="boxRow">
                <center>
                  <?php
                  $pregraphmarks = array();
                  if (isset($precurExamMonth) > 0) {
                    if (sizeof($graphmarks[$precurExamMonth]) > 0) {
                      // foreach ($graphmarks[''] as $value) 
                      // {
                      //   $pregraphmarks[] = $value;
                      // }
                      foreach ($graphmarks[$precurExamMonth] as $value) {
                        $pregraphmarks[] = $value;
                      }
                    }
                  }
                  //echo '<pre>';
                  //  var_dump($graphmarks);
                  //  echo json_encode($graphmarks);
                  //  var_dump($subjects_marks);
                  $chart[$curStudentID] = new KoolChart("chart" . $curStudentID);
                  $chart[$curStudentID]->scriptFolder = $KoolControlsFolder . "/KoolChart";
                  $chart[$curStudentID]->Title->Text = "Comparison with last Exam";
                  $chart[$curStudentID]->Width = 650;
                  $chart[$curStudentID]->Height = 190;
                  //$chart->BackgroundColor = "#ffffee";

                  //$chart[$curStudentID]->PlotArea->XAxis->Title = "Subjects";

                  $chart[$curStudentID]->PlotArea->XAxis->Set($graphsubject);

                  //$chart2->PlotArea->YAxis->Title = "Amount";
                  $chart[$curStudentID]->PlotArea->YAxis->LabelsAppearance->DataFormatString = "";
                  $chart[$curStudentID]->Legend->Appearance->Visible = false; // right side mid year

                  $series1 = new ColumnSeries();
                  $series1->Name = 'Previous Exam';
                  $series1->TooltipsAppearance->DataFormatString = "{0} Previous";
                  $series1->Appearance->BackgroundColor = "lightgrey";
                  $series1->ArrayData($pregraphmarks);
                  $chart[$curStudentID]->PlotArea->AddSeries($series1);

                  $series2 = new ColumnSeries();
                  $series2->Name = 'Current Exam';
                  $series2->TooltipsAppearance->DataFormatString = "{0}";
                  $series2->Appearance->BackgroundColor = "#5a5a5a";
                  $series2->ArrayData($subjects_marks);
                  //      _______________________only subjects marks__________________
                  // echo json_encode( $subjects_marks);
                  // echo json_encode( $series2);

                  $chart[$curStudentID]->PlotArea->AddSeries($series2);
                  ?>
                  <form id="form<?= $curStudentID ?>" method="post">
                    <?php
                    echo $chart[$curStudentID]->Render();
                    $subjects_marks = array();
                    $subjects_array = array();
                    // echo implode(",",$subjects_array);
                    // var_dump($subjects_array);
                    ?>
                  </form>
                </center>
              </div>


            </td>
          </tr>
        </table>

      </td>

    </tr>

    <tr>
      <td align="right" valign="top" class="dotted-space footer_td" colspan="4">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td style="padding: 10px 0px;" width="83%">Dated: <strong>
                <script>
                  var monthNames = [
                    "January", "February", "March",
                    "April", "May", "June", "July",
                    "August", "September", "October",
                    "November", "December"
                  ];

                  var date = new Date();
                  var day = date.getDate();
                  var monthIndex = date.getMonth();
                  var year = date.getFullYear();

                  //console.log(day, monthNames[monthIndex], year);
                  document.write(monthNames[monthIndex] + ' ' + day + ', ' + year);
                  //document.write(dateStr);//trim the Day, Hr and Minutes etc
                </script>
              </strong>

            </td>
           <!-- <.?php echo json_encode($only_subjects); ?> -->

            <td width="17%" align="right" class="rollno">Reg No.<?php echo $row->Registration_Nr ?> </td>
          </tr>
          <tr>
            <td colspan="2" style="text-align: center;padding: 10px 0px;padding-left: 48px !important;">Disclaimer: Computer generated report, does not require signatures.</td>
          </tr>
        </table>
      </td>
    </tr>
    </table>
    </td>
    </tr>
    </table>
    </td>
    </tr>
    </table>


    <div id="demo"><?php
                    // echo json_encode($preresults);
                    // echo json_encode($subjectsOfSession);




                    //___________________==============+++++++++++++++++__VARIABLES/ARRAYS FETCHING DATA FROM DATABASE__++++++++++++++++++==============_________________________



                    // $examType $attenRS $totalattandance $subjectsOfSession $results $asessmentsresult  $previousresults $preresults

                    // echo implode(",",$graphsubject) 
                    // echo json_encode($graphmarks);
                    // print_r($asessmentsresult);


                    ?><br>

    <?php
    $save_rows = array();
    $push_array = array();
    $Push_array = array_push($loop_pros, $examType);
    // $Push_array1=array_push($loop_pros,$results);
    // $Push_array=array_push($loop_pros,$results);
    // $subjectsOfSessions=json_encode($subjectsOfSession[1]);
    $save_rows = [$loop_pros, $attenRS, $totalattandance, $subjectsOfSession, $graphmarks];
    // echo json_encode($subj->Subject);
  }
  // var_dump($loop_pros);
  // echo "Average = ", average($loop_pros);
  // $push_array= average($loop_pros);
  // echo "subjects = ", average($graphsubject);
  // foreach ($loop_pros as $key => $jsons) { // This will search in the 2 jsons
  //   foreach ($jsons as $key => $value) {
  //       echo $key ;
  //       echo $value;
  //     }
  //   }
  //_________________________________________________________________________________________________________________________________________________________________________



    ?> </div>
    <div class="page-break"></div>
    <?php


    ?>
    <script language="javascript">
      function setAvgAgeValues() {
        var x = document.getElementsByName("avgAges");
        var i;
        //alert(<?= $comulativeAge ?>+" "+<?= $studentsCount ?>);
        for (i = 0; i < x.length; i++) {
          x[i].innerHTML = <?= round($comulativeAge / $studentsCount, 1) ?>;
        }
      }
      //setAvgAgeValues();//call the function on loading completion

      function lockpage() {
        $('#messageid').html('loading....');
        <?php

        if (!empty($_REQUEST['studentID'])) { ?>
          $.post('../rpt_create_html.php?link=<?php echo rawurlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>', function(data) {
            $('#messageid').html('Locked successfully.');
            return true;
          });
        <?php } else { ?>
          $.post('../rpt_create_html_all.php?link=<?php echo rawurlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>', function(data) {
            $('#messageid').html('Locked successfully.');
          });
        <?php } ?>

      }

      function printPage() {

        window.print();
      }

      function openAllStudents() {
        var curURL = window.location.href;
        <?php
        if (!empty($_REQUEST['studentID'])) { ?>
          window.location = curURL.replace("studentID=" + <?= $_REQUEST['studentID'] ?> + "&", ""); //dont specify studentID, to view all results of current batch
        <?php } else { ?>
          alert("Already opened");
        <?php } ?>
      }

      function sendpdfemail(current_page_url, studentID, sessionID, eduExamTypeID, examMonth, examYear) {
        $("#messageid").html('Please wait.....');
        $.post("reports_pdf.php", {
          current_page_url: current_page_url,
          studentID: studentID,
          sessionID: sessionID,
          eduExamTypeID: eduExamTypeID,
          examMonth: examMonth,
          examYear: examYear
        }, function(data) {
          $("#messageid").html(data);
        });
      }

      function sendallpdfemail(current_page_url, sessionID, eduExamTypeID, examMonth, examYear) {
        $("#messageid").html('Please wait.....');
        $.post("reports_pdf.php", {
          current_page_url: current_page_url,
          sessionID: sessionID,
          eduExamTypeID: eduExamTypeID,
          examMonth: examMonth,
          examYear: examYear
        }, function(data) {
          $("#messageid").html(data);
        });
      }

      function SaveURL() {
        // current date on which report will open
        var monthNames = [
                    "January", "February", "March",
                    "April", "May", "June", "July",
                    "August", "September", "October",
                    "November", "December"
                  ];
        var date = new Date();
        var day = date.getDate();
        var monthIndex = date.getMonth();
        var year = date.getFullYear();
        var rpt_date=monthNames[monthIndex] + ' ' + day + ', ' + year;

        var student_id=<?php echo $curStudentID?>;//surrent stuent id to store into db
        var url = window.location.href;//url to store in db
        var half_url = window.location.pathname;
        var file_to_end = window.location.search;
        var concat = half_url + file_to_end;
        $("#messageid").html('Please wait.....');
        var filename = url.split('/').pop().split('#')[0].split('?')[0];
        // var filename = url.pathname.replace(/[\D]/g, "");
        $.ajax({
          type: "POST",
          url: 'saveurl.php', //path of file to which post the variable
          data: {
            filename: filename,
            student_id: student_id,
            rpt_date: rpt_date,
            arra: <?php echo json_encode($save_rows) ?>,
            url: concat
          },
          success: function(data) {
            alert(data);
            // console.log("success!");
            $("#messageid").html("URL  Saved...! successfully");

          }
        });
        // $( "#messageid" ).html(data);


      }
    </script>

    <?php
    //  $current_page_url = "'".$_SERVER['REQUEST_URI']."'";
    //  $split = explode("?",$current_page_url);
    //  $link = explode("reports",$split[0]);
    //  $filename_extract = explode(".php",$link[1]);
    //  $filename = "'".$filename_extract[0]."'";

    //  echo $filename;
    ?>

    <div class="noPrint" style="text-align: center">
      <input type="button" onclick="javascript: printPage()" value="Print" />
      <input type="button" onclick="javascript: openAllStudents()" value="Open All" style="<?= ((empty($_REQUEST['studentID'])) ? "display:none" : "") ?>" />
      <input type="button" onclick="javascript: lockpage()" value="Lock" style="<?= ((empty($_REQUEST['studentID'])) ? "display:none" : "") ?>" />
      <input type="button" onclick="javascript: lockpage()" value="Lock All" style="<?= ((!empty($_REQUEST['studentID'])) ? "display:none" : "") ?>" />

      <input type="button" onclick="sendpdfemail(<?= $current_page_url ?>,<?= $_REQUEST['studentID']; ?>,<?= $_REQUEST['sessionID']; ?>,<?= $_REQUEST['eduExamTypeID']; ?>,<?= $_REQUEST['examMonth']; ?>,<?= $_REQUEST['examYear']; ?>)" value="Send PDF Email" style="<?= ((empty($_REQUEST['studentID'])) ? "display:none" : "") ?>" />
      <input type="button" onclick="sendallpdfemail(<?= $current_page_url ?>,<?= $_REQUEST['sessionID']; ?>,<?= $_REQUEST['eduExamTypeID']; ?>,<?= $_REQUEST['examMonth']; ?>,<?= $_REQUEST['examYear']; ?>)" value="Send All PDF Emails" style="<?= ((!empty($_REQUEST['studentID'])) ? "display:none" : "") ?>" />

      <!-- getting url in button and saving it in database table -->
      <input type="button" onclick="SaveURL()" value="SaveURL" />

      <div id="messageid" style="color:green;"></div>
    </div>
</body>

</html>
</html>
