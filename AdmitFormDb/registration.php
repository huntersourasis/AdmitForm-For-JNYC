<?php
if(isset($_POST['submit'])) {

  $connection = mysqli_connect("localhost", "root", "", "admitdetails");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$registration = $_POST['reg'];
$fName = $_POST['fName'];
$lName = $_POST['lName'];
$year = $_POST['year'];
$dob = $_POST['dob'];
$course = $_POST['course']; 
$add = $_POST['add'];
$gName = $_POST['fhName'];
$gen = $_POST['gen'];


function deBugTime($time) {
  $split = explode(":", $time);

  $twelveTime = "0";

  if ($split[0] > 12) {
      $twelveTime .= ($split[0] - 12) . " : " . $split[1] . " PM ";
  } else {
      $twelveTime = $split[0] . " : " . $split[1] . " AM ";
  }

  $pTime = $twelveTime;

  return $pTime;
}


    $date1 = $_POST['date1'];
    $fTime1= deBugTime($_POST['fTime1']);
    $tTime1 = deBugTime($_POST['tTime1']);
    $date2 = $_POST['date2'];
    $fTime2= deBugTime($_POST['fTime2']);
    $tTime2 =deBugTime( $_POST['tTime2']);
    $date3 = $_POST['date3'];
    $fTime3= deBugTime($_POST['fTime3']);
    $tTime3 = deBugTime($_POST['tTime3']);
    $date4 = $_POST['date4'];
    $fTime4= deBugTime($_POST['fTime4']);
    $tTime4 = deBugTime($_POST['tTime4']);

    


if(isset($_POST['submit']) && isset($_FILES['uploadedImage'])) {
    $imgName = $_FILES['uploadedImage']['name'];
    $imgSize = $_FILES['uploadedImage']['size'];
    $imgTemp = $_FILES['uploadedImage']['tmp_name'];
    $imgError = $_FILES['uploadedImage']['error'];

    if($imgError === 0) {
        if($imgSize >= 512000) {
            echo "<script>
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Image Size is Too Large!',
            })
            </script>";
        } else {
            $imgExt = pathinfo($imgName, PATHINFO_EXTENSION);
            $imgEXLc = strtolower($imgExt);

            $allowExt = array('jpg', 'jpeg', 'png');

            if(in_array($imgEXLc, $allowExt)) {
                $newImgName = uniqid("IMG-", true). '.' . $imgEXLc;
                $imgUploadPath = 'Images/' . $newImgName;
                move_uploaded_file($imgTemp , $imgUploadPath);
            } else {
                echo "";
            }
        }
    } else {
        echo "Error in file upload.";
    }
} else {
    echo "Error";
}

$img = isset($newImgName) ? $newImgName : "";

$insertQuery = "INSERT INTO `personaldetails` (`registration`, `fName`, `lName`, `gName`, `year`, `dob`, `course`, `gen`, `address`, `img`) VALUES ('$registration', '$fName', '$lName', '$gName', '$year', '$dob', '$course', '$gen', '$add', '$img')";

$insert = mysqli_query($connection, $insertQuery);

if ($insert) {
    echo "";
} else {
    die("Error in query: " . mysqli_error($connection)); 
}

$insertQueryTable = "INSERT INTO `tabledetails` (`registration`, `tD`, `tF`, `tTo`, `ptD`, `ptF`, `ptTo`, `vD`, `vF`, `vTo`, `pjD`, `pjF`, `pjTo`) VALUES ('$registration', '$date1', '$fTime1', '$tTime1', '$date2', '$fTime2', '$tTime2', '$date3', '$fTime3', '$tTime3', '$date4', '$fTime4', '$tTime4');";


$insertTable = mysqli_query($connection , $insertQueryTable);

if($insertTable) {
    echo "<script>
    window.addEventListener('load', () => {
      Swal.fire(
        'Value Inserted',
        'You clicked the button!',
        'success'
      )
    });
</script>";
}
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admit Form</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/registration.css">
</head>
<body>
  <nav class="navbar navbar-light bg-dark sticky-top">
    <a class="navbar-brand" href="https://jnyc.co.in">
      <img src="./Logo1.png" width="120"class="d-inline-block align-top" alt="">
    </a>
    <lable class="form-inline center navL">Admit Card Registration</lable>
  </nav>
<div class="container con">
  <div class="row logo">
    <h2>Admit Card Registration</h2>
  </div>
  <form method="post" class="form" enctype="multipart/form-data">
    <div class="form-group mar">
      <div class="row">
        <div class="col">
          <label for="name">First name:</label>
          <input type="text" class="form-control" id="fName" name="fName" required>
        </div>
        <div class="col">
          <label for="name">Last Name:</label>
          <input type="text" class="form-control" id="lName" name="lName" required>
        </div>
      </div>
    </div>
    <div class="form-group mar">
      <label for="email">Guardian name:</label>
      <input type="text" class="form-control" id="fhName" name="fhName" required>
    </div>
      <div class="row">
        <div class="col">
          <div class="form-group mar">
            <label for="city">Registration No:</label>
            <input type="number" class="form-control" id="roll" placeholder="Example-0398" name="reg" required>
          </div>
        </div>
        <div class="col">
          <div class="form-group mar">
            <label for="city">Examination Year:</label>
            <input type="number" class="form-control valid-2" id="year" placeholder="Example-2023" name="year" required>
          </div>
        </div>
      </div>
    <div class="form-group mar">
      <label for="phone">DOB:</label>
      <input type="date" class="form-control" id="dob" placeholder="Enter your phone number" name="dob" required>
    </div>
    <div class="form-group mar">
      <label for="address">Course:</label>
<div>
  <select id="course" class="form-control" name="course" required>
    <option value="" selected>Select Course</option>
    <option value="Certificate in Computer Application(CCA)">Certificate in Computer Application</option>
    <option value="Diploma in Computer Application(DCA)">Diploma in Computer Application</option>
    <option value="School Course(SC)">School Course</option>
  </select>
</div>
    </div>
    <div class="form-group mar">
        <div class="row">
          <div class="col gen">
            <label for="country">Male:</label>
            <input type="radio" name="gen" value="Male" id="male" >
          </div>
          <div class="col gen">
            <label for="country">Female:</label>
            <input type="radio" name="gen" value="Female" id="female">
          </div>
        </div>
    </div>
    <div class="form-group mar">
      <label for="message">Address:</label>
      <input class="form-control" id="address" rows="5" name="add" required>
    </div>
    <div class="row-wrap picUp">
      <div class="col-sm-2 txt-center">
        <table class="table table-bordered">
          <tbody>
          <tr>
            <th scope="row txt-center"><img class="displayImage" id="displayImage"  width="123px" height="165px" /></th>
          </tr>
          <tr style="text-align: center">
            <th scope="row" class="p-2"><p2>PHOTO</p2></th>
          </tr>
          </tbody>
        </table>
        <div class="row">
          <!-- <form> -->
            <div class="custom-file">
                <input type="file" accept="image/png, image/jpg, image/jpeg" class="custom-file-input" id="imageInput" name="uploadedImage" required>
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
        <!-- </form> -->
        </div>
      </div>
    </div>
    <div class="form-group mar">
        <table class = "table-wrap table-bordered t">
          <thead>
            <tr>
              <th colspan="4" class="th">Manage Exam Details</th>
            </tr>
            <tr>
              <th>Exam</th>
              <th>Date</th>
              <th>Time Form</th>
              <th>Time To</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Theory</td>
              <td><input type="date" class="date1" name="date1" required></td>
              <td><input type="time" class="fTime1" name="fTime1" required></td>
              <td><input type="time" class="tTime1" name="tTime1" required></td>
            </tr>
            <tr>
              <td>Practical</td>
              <td><input type="date" class="date2" name="date2" required></td>
              <td><input type="time" class="fTime2" name="fTime2" required></td>
              <td><input type="time" class="tTime2" name="tTime2" required></td>
            </tr>
            <tr>
              <td>Viva</td>
              <td><input type="date" class="date3" name="date3" required></td>
              <td><input type="time" class="fTime3" name="fTime3" required></td>
              <td><input type="time" class="tTime3" name="tTime3" required></td>
            </tr>
            <tr>
              <td>Project</td>
              <td><input type="date" class="date4" name="date4" required></td>
              <td><input type="time" class="fTime4" name="fTime4" required></td>
              <td><input type="time" class="tTime4" name="tTime4" required></td>
            </tr>
          </tbody>
        </table>
    </div>
    <div class="row">
      <div class="col"> <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn" name="submit">Submit</button></div>
      <div class="col"> <div type="button" class="btn btn-primary btn-lg btn-block showAdmit" id="btn">Get Admit Card</div></div>
    </div>
    <div class="row">
      <span style="height: 50px;"></span>
    </div>
  </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
        const image_input = document.querySelector("#imageInput");
        var uploaded_image = "";

        image_input.addEventListener("change",function(){
            const reader = new FileReader();
            reader.addEventListener("load", () =>{
                uploaded_image = reader.result;
                document.querySelector("#displayImage").style.backgroundImage = `url(${uploaded_image})`;
            });
            reader.readAsDataURL(this.files[0]);
        })
        const showAdmitBtn = document.querySelector('.showAdmit');

        showAdmitBtn.addEventListener('click', ()=>{
          window.location.href = "getAdmit.html";
        })

  </script>
</body>
</html>