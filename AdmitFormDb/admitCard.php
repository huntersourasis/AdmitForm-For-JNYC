<?php
$conn = mysqli_connect("localhost","root","","admitdetails");

$regno = $_POST['regNo'];

$getQuery = "SELECT * FROM personaldetails AS p INNER JOIN tabledetails AS t ON p.registration=t.registration WHERE p.registration = '$regno'";

$result = mysqli_query($conn,$getQuery);

$checkRow = mysqli_num_rows($result);

if($checkRow)
{
	$values = mysqli_fetch_array($result);
}
else
{
	header("location:existError.html");
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/admitCard.css">
    <title>Admit Card</title>


  </head>
  <body>

    <!-- Image and text -->
<nav class="navbar navbar-light bg-dark sticky-top">
  <a class="navbar-brand" href="https://jnyc.co.in">
    <img src="./Logo1.png" width="120" class="d-inline-block align-top" alt="">
  </a>
  <form class="form-inline center navL">Admit Card</form>
  <div class="d-flex">
    <button class="btn btn-outline-success my-2 my-sm-0 printForm mr-3" type="submit">
      <i class="fa fa-print" style="font-size:25px"></i> Print
    </button>
    <a href="getAdmit.html"><button class="btn btn-outline-success my-2 my-sm-0" type="button">Back</button></a>
  </div>
</nav>


    
<section>
	<div class="container">
		<div class="admit-card">
			<div class="BoxA border- padding mar-bot"> 
				<div class="row">
					<div class="col-sm-4">
						<h5>JNYC</h5>
						<p>North 24 PGS (BODAI) - 700126 <br> WEST BENGAL, INDIA</p>
					</div>
					<div class="col-sm-4 txt-center">
						<img src="./Logo1.png" width="180px;" />
					</div>
					<div class="col-sm-4">
						<h5>Admit Card</h5>
						<p>Exam - <input type="text" class='year' readonly value="<?php echo $values['year'] ?>"></p>
					</div>
				</div>
			</div>
			<div class="BoxD border- padding mar-bot">
				<div class="row">
					<div class="col-sm-10">
						<table class="table table-bordered o">
						  <tbody>
							<tr>
							  <td><b>Registration No: <input type="text" readonly class="roll" value="<?php echo "JNYC/18B/" . $values['registration'] ?>"></b></td>
							  <td><b>Course: </b> <input type="text" class="course" readonly value="<?php echo $values['course'] ?>"></td>
							</tr>
							<tr>
							  <td><b>Student Name: </b><input type="text" readonly class="name" value="<?php echo $values['fName'] . " " .  $values['lName'] ?>"></td>
							  <td><b>Gender: </b><input type="text" readonly class="gen" value="<?php echo $values['gen'] ?>"></td>
							</tr>
							<tr>
							  <td><b>Guardian's Name: </b><input type="text" readonly class="fName" value="<?php echo $values['gName'] ?>"></td>
							  <td><b>DOB: </b><input type="text" readonly class="dob" value="<?php echo $values['dob'] ?>"></td>
							</tr>
							<tr>
							  <td colspan="2" style="height: 125px;"><b>Address: </b><input type="text" class="add" readonly value="<?php echo $values['address'] ?>"></td>
							</tr>
						  </tbody>
						</table>
					</div>


          <!-- photo -->
					<div class="col-sm-2 txt-center">
						<table class="table table-bordered">
						  <tbody>
							<tr>
							  <th scope="row txt-center"><img src="Images/<?=$values['img']?>" id="showImage" width="100%" height="125px"/></th>
							</tr>
							<tr>
							  <th scope="row txt-center" class="p-2"><p2>PHOTO</p2></th>
							</tr>
						  </tbody>
						</table>
					</div>
          <!-- photo -->


				</div>
			</div>
			<div class="BoxE border- padding mar-bot txt-center">
				<div class="row">
					<div class="col-sm-12">
						<h5>EXAMINATION VENUE</h5>
						<p>North 24 PGS (BODAI) - 700126 <br> WEST BENGAL, INDIA</p>
					</div>
				</div>
			</div>
			<div class="BoxF border- padding mar-bot txt-center">
				<div class="row">
					<div class="col-sm-12">
						<table class="table-wrap table-bordered t">
							<thead>
								<tr>
									<th class="txt-center">Subject/Paper</th>
									<th class="txt-center">Exam Date</th>
                  					<th class="txt-center">Day</th>
                  					<th class="txt-center">Timing</th>
								</tr>
							</thead>
						  <tbody>
							<tr>
							  <td class="txt-center">Theory</td>
							  <td><input type="text" class="date1 form-control" readonly value="<?php echo $values['tD'] ?>"></td>
                			  <td><input type="text" class="day1 form-control" readonly></td>
                			  <td><input type="text" class="duretion1 form-control" readonly value="<?php echo $values['tF']  . " - " .  $values['tTo'] ?>"></td>
							</tr>
							<tr>
							  	<td class="txt-center">Practical</td>
							  	<td><input type="text" class="date2 form-control" readonly value="<?php echo $values['ptD'] ?>"></td>
                				<td><input type="text" class="day2 form-control" readonly></td>
                				<td><input type="text" class="duretion2 form-control" readonly value="<?php echo $values['ptF']  . " - " .  $values['ptTo'] ?>"></td>
							</tr>
							<tr>
							  	<td class="txt-center">Viva</td>
							  	<td><input type="text" class="date3 form-control" readonly value="<?php echo $values['vD'] ?>"></td>
                				<td><input type="text" class="day3 form-control" readonly></td>
                				<td><input type="text" class="duretion3 form-control" readonly value="<?php echo $values['vF']  . " - " .  $values['vTo'] ?>"></td>
							</tr>
              <tr>
							  	<td class="txt-center">Project</td>
							  	<td><input type="text" class="date4 form-control" readonly value="<?php echo $values['pjD'] ?>"></td>
                				<td><input type="text" class="day4 form-control" readonly></td>
                				<td><input type="text" class="duretion4 form-control" readonly value="<?php echo $values['pjF']  . " - " .  $values['pjTo'] ?>"></td>
							</tr>
						  </tbody>
						</table>
					</div>
				</div>
			</div>
      <div class="container-wrap att">
        <div class="row">1.Check the exam time table cearfully</div>
        <div class="row">2.The admit card serves as your official identification for the upcoming examination. Carry it with you at all times</div>
        <div class="row">
          3.He/she will not be allowed to take the exam without their admit card.
        </div>
        <div class="row">4.Ensure that your admit card contains accurate personal information, including your name, photograph, and signature. Report any discrepancies immediately</div>
        <div class="row">4.Read the instructions on the admit card carefully and follow them accordingly.</div>
        <div class="row">6.Reach the examination center well in advance to avoid any last-minute rush. Latecomers may not be permitted to enter the exam hall.</div>
        <div class="row">7.In conclusion, it is crucial to ensure fee clearance for obtaining the admit card. Without fee clearance, the issuance of the admit card may be delayed or even denied.</div>
        <div class="row">8.Exam date will not be changed.</div>
      </div>
      <div class="container-wrap soi">
        <div class="row">
          <div class="col-sm sign txt-center adi">
            <div><b>Signature of the Student</b></div>
            <div><input type="text"  class="border-top-0  border-left-0 border-right-0 in"></div>
          </div>
          <div class="col-sm sign txt-center adi">
            <div><b>Class Teacher</b></div>
            <div><input type="text" class="border-top-0 border-left-0 border-right-0 in"></div>
          </div>
          <div class="col-sm sign txt-center adi">
            <div><b>Rechecked By</b></div>
            <div><input type="text" class="border-top-0 border-left-0 border-right-0 in"></div>
          </div>
          <div class="col-sm sign txt-center adi">
            <div><b>Chairman</b></div>
            <div><input type="text" class="border-top-0 border-left-0 border-right-0 in"></div><br>
          </div>
        </div>
      </div>
			<footer class="txt-center">
				<p>Jawaharlal Nehru Youth Computer Center</p>
			</footer>
			

	</div>
	
</section>
    

<script>
  const printFormBtn = document.querySelector('.printForm');

  printFormBtn.addEventListener('click', () => {
    window.print();
  });

  const dayDeBug = (inputDate) => {
    const date = new Date(inputDate);
    const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const dayNum = date.getDay();
    return days[dayNum];
  };

  document.querySelector('.day1').value = dayDeBug('<?php echo $values["tD"]; ?>');
  document.querySelector('.day2').value = dayDeBug('<?php echo $values["ptD"]; ?>');
  document.querySelector('.day3').value = dayDeBug('<?php echo $values["vD"]; ?>');
  document.querySelector('.day4').value = dayDeBug('<?php echo $values["pjD"]; ?>');
</script>

  </body>
</html>