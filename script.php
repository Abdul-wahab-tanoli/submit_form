<?php
$conn=mysqli_connect("localhost","root","");
if(!$conn){
    echo "connection error";
}

$organization_name=$_POST['name'];
$Parent_name="qualven_";
$organization_Theme=$_POST['theme'];
$organization_Logo=$_POST['file'];
$Submission_ETD=$_POST['date'];
// $backup_file=$_POST['backup'];


$dbname1="$organization_name";
$dbname2="$Parent_name";
// $dbname3="$date";
// echo date('Y', $Submission_ETD); 
// echo $dbname3=strval($Submission_ETD);
$dbname=$dbname2.$dbname1;




// echo $dbname;
// exit();

$query="CREATE DATABASE " .$dbname;

$result1=mysqli_query($conn,$query) or die("error creating database");


if(! $result1 ) {
    die('Could not create database: ');
}
// mysqli_query($conn," USE $dbname");//use new created database")


// Name of the data file
$filename = 'qualven.sql';

// Connect to MySQL server
$link = mysqli_connect("localhost", "root", "", $dbname) or die('Error connecting to MySQL Database: ');


$tempLine = '';
// Read in the full file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line) {

    // Skip it if it's a comment
    if (substr($line, 0, 2) == '--' || $line == '')
        continue;

    // Add this line to the current segment
    $tempLine .= $line;
    // If its semicolon at the end, so that is the end of one query
    if (substr(trim($line), -1, 1) == ';')  {
        // Perform the query
        mysqli_query($link, $tempLine) or print("Error in " . $tempLine .":");
        // Reset temp variable to empty
        $tempLine = '';
    }
}


//_----- image function ------___

echo "<h2> data imported sucessfully in new tables <br> </h2>";

$_POST['file'];
$filepath = "images/" . $_FILES["file"]["name"];

if(move_uploaded_file($_FILES["file"]["tmp_name"], $filepath)) 
{
    echo "<img src=".$filepath." height=200 width=300 /> <br> ";
    echo "<h3> image also uploaded successfully</h3>";
} 
else 
{
    echo "Error !!";
}
//insert data into wanting table

$USE=mysqli_query($conn," USE $dbname");//use new created database
$sql3="INSERT INTO config(Logo,Theme) values ('$filepath','$organization_Theme')"or die("querry errorrrr....!"); 
$resu=mysqli_query($conn,$sql3);
 mysqli_close($conn);
?>