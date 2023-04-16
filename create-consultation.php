<?php
$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "db_connect";

$responseData = array();
$status = 200;


if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  //create connection
$conn = mysqli_connect('localhost','root','','db_connect');
//check connection
if ($conn === false){
    die("ERROR: could not connect. ". mysqli_connect_error());
    $responseData = array("message" => "Cannot connect to database");
    $status = 500;

}

 // Taking all 5 values from the form data(input)
 $firstname = isset($_POST['firstName']) ? $_POST['firstName'] : null;
 $lastname = isset($_POST['lastName']) ? $_POST['lastName'] :null;
 $eMail = isset($_POST['eMail']) ? $_POST['eMail']:null;
 $phone = isset($_POST['phone']) ? $_POST['phone']:null;
 $comment = isset($_POST['comment']) ? $_POST['comment']:null;

 $date = date('Y-m-d h:i:sa');

      //Insert the data into our db_connect table 
      $sql = "INSERT INTO tbl_contact(firstName, lastName, eMail, phone, comment, DateAdded) VALUES ('$firstname', '$lastname',' $eMail','$phone', '$comment', '$date')";

      // Check if the query is successful   
      if (mysqli_query($conn, $sql)){
       // echo "data stored in database successfully."; 
        $contactQuery = "SELECT * FROM `tbl_contact` ORDER BY id DESC LIMIT 1";

        $result = mysqli_query($conn, $contactQuery);
        $contact = [];
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              $responseData = array("contact" => $row, 'firstname' => $firstname, 'lastname' => $lastname);
              $status = 200;
            }
        }

       
      }else{
        /*echo "ERROR: sorry $sql."
        . mysqli_error($conn);*/
        $responseData = array("message" => "Error creating contact");
        $status = 500;
      }

      header("Content-Type", "application/json");
      header("Access-Control-Allow-Origin", "*");

    

      //close connection
      mysqli_close($conn);
}
else {
  $responseData = array("error" => "Method not allowed");
  $status = 405;
}
http_response_code($status);
echo json_encode($responseData);

?>