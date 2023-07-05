<html>
<body>
<?php 
$username = "root"; 
$password = ""; 
$database = "admitdetails"; 
$mysqli = new mysqli("localhost", $username, $password, $database); 
$query = "SELECT * FROM personaldetails";


echo '
    <style>
        body {
            font-family:sans-serif;
            height:max-content;
            display : flex;
            align-item:center;
            justify-content:center;
        }
        table {
            width:100%;
            height:max-content;
        }
        .head{
            color:black;
            font-weight :bold;
        }
        table , tr , td {
            text-align:center;
            border: 2px solid;
        }
    </style>
<table border="0" cellspacing="2" cellpadding="2"> 
      <tr class="head"> 
          <td> <font face="Arial">Registration No</font> </td> 
          <td> <font face="Arial">Name</font> </td> 
          <td> <font face="Arial">Gardian Name</font> </td> 
          <td> <font face="Arial">Year</font> </td> 
          <td> <font face="Arial">Date Of Birth</font> </td> 
          <td> <font face="Arial">Course</font> </td> 
          <td> <font face="Arial">Gender</font> </td> 
          <td> <font face="Arial">Address</font> </td> 
          <td> <font face="Arial">Image</font> </td> 
      </tr>';

if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $field0name = $row["registration"];
        $field1name = $row["fName"] . " " .  $row['lName'];
        $field3name = $row["gName"];
        $field4name = $row["year"];
        $field5name = $row["dob"]; 
        $field6name = $row["course"]; 
        $field7name = $row["gen"]; 
        $field8name = $row["address"]; 
        $field9name = $row["img"]; 

        echo '<tr> 
                  <td>'.$field0name.'</td> 
                  <td>'.$field1name.'</td> 
                  <td>'.$field3name.'</td> 
                  <td>'.$field4name.'</td> 
                  <td>'.$field5name.'</td> 
                  <td>'.$field6name.'</td> 
                  <td>'.$field7name.'</td> 
                  <td>'.$field8name.'</td> 
                  <td>'.$field9name.'</td> 
              </tr>';
    }
    $result->free();
} 
?>
</body>
</html>