<?php
//Establish a connection to the MYSQL database
$servername = "localhost";
$uname = "root";
$upass = "";
$dbname ="contact";

$conn = new mysqli($servername, $uname, $upass, $dbname);

//check the connection
if ($conn->connect_error){
    die("Connection failed:" . $conn->connect_error);
}

//Process applicaton form

if($_SERVER["REQUEST_METHOD"]=="POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message']; 

//Protect against SQL injection

$name = mysqli_real_escape_string($conn, $name);
$email = mysqli_real_escape_string($conn, $email);
$message = mysqli_real_escape_string($conn, $message);

// Insert application data into the database

//$sql = "INSERT INTO enquiry_details(name, dob, gender, phone, email, enquiry) VALUES ('$fullName','$dob','$gender','$phone','$email','$enquiry')";
$sql = "INSERT INTO `contact_tb`(`name`, `email`, `message`) VALUES ('$name','$email','$message')";
if ($conn->query($sql) == TRUE) {
    echo "Application submitted successfully!";
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}

//close the connection
$conn->close();

?>