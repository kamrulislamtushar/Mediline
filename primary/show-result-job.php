<?php
include '../connect.php';
session_start();
if($_SESSION['sbttc_basic_uid']!='')
{
if(isset($_GET['id'])&&!empty($_GET['id']))
{
    $id=$_GET['id'];
    $result=mysql_query("select * from job_test,mark_job,course,course_duration where  job_test.jobTest=course.id and job_test.id=mark_job.u_id and job_test.id='$id';") or die(mysql_error());
    $rows1=mysql_num_rows($result);
    if($rows1>0) {
        while ($engData = mysql_fetch_array($result)) {
            $data[0]=$engData['traineeNameJob'];
            $data[1]=$engData['fatherNameJob'];
            $data[2]=$engData['passportNoJob'];
            $data[3]=$engData['regerenceNoJob'];
            $data[4]=$engData['jobTest'];
            $data[5]=$engData['dateOfExaminationJob'];
            $data[6]=$engData['eaverageJob'];
            $data[7]=$engData['ecommentsJob'];
            $data[8]=$engData['issueDatejob'];
            $data[9]=$engData['img'];
            $data[10]=$engData['course_name'];
            $data[11]=$engData['duration_name'];
            $data[12]=$engData['traineeAddressJob'];


        }
    }
    else{
        echo '<script>alert("Sorry No Result Found....");</script>';
        header("Location: view-resuts.php");
    }
}
else{
    echo '<script>alert("Sorry No Result Found....");</script>';
    header("Location: view-results.php");
}



?>

<?php include 'header.php';?>
		
		<!-- View Result Button start here -->
		<section id="viewResult">
			<div class="container">
				<div class="rows">
					<div class="col-md-12">
						<div>
							<a href="submit-result.php" class="btn btn-success">Submit Result</a>
							<a href="view-results.php" class="btn btn-success">View Results</a>
							<a href="logout.php" class="btn btn-danger">Logout</a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- View Result Button end here -->
		
		<!-- Show Result All start here -->
		<section id="showResultAll">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<img src="img/job/<?php echo $data[9];?>" style="float:right;" alt="Trainees Picture" width="150">
					</div>
					<div class="col-md-8">
						<table style="line-height: 35px;">
							<tr style="border-bottom:1px dotted #888;">
								<td><strong>Name of Trainee: </strong></td>
								<td style="padding-left:20px;"><?php echo $data[0];?></td>
							</tr>
							
							<tr style="border-bottom:1px dotted #888;">
								<td><strong>Father Name: </strong></td>
								<td style="padding-left:20px;"><?php echo $data[1];?></td>
							</tr>
							
							<tr style="border-bottom:1px dotted #888;">
								<td><strong>Passport No:</strong></td>
								<td style="padding-left:20px;"><?php echo $data[2];?></td>
							</tr>
							
							<tr style="border-bottom:1px dotted #888;">
								<td><strong>Reference No: </strong></td>
								<td style="padding-left:20px;"><?php echo $data[3];?></td>
							</tr>
							
							<tr style="border-bottom:1px dotted #888;">
								<td><strong>Refer Form: </strong></td>
								<td style="padding-left:20px;"><?php echo $data[12];?></td>
							</tr>
							
							<tr style="border-bottom:1px dotted #888;">
								<td><strong>Name of Course: </strong></td>
								<td style="padding-left:20px;"><?php echo $data[10];?></td>
							</tr>
							
							<tr style="border-bottom:1px dotted #888;">
								<td><strong>Date of Examination: </strong></td>
								<td style="padding-left:20px;"><?php echo $data[5];?></td>
							</tr>
							
							<tr style="border-bottom:1px dotted #888;">
								<td><strong>Obtain Grade: </strong></td>
								<td style="padding-left:20px;"><?php echo $data[6];?></td>
							</tr>
							
							<tr style="border-bottom:1px dotted #888;">
								<td><strong>Comments:</strong></td>
								<td style="padding-left:20px;"><?php echo $data[7];?></td>
							</tr>
							
							<tr>
								<td><strong>Date of Issue: </strong></td>
								<td style="padding-left:20px;"><?php echo $data[8];?></td>
							</tr>
						
						
						</table>
						
						
					</div>
				</div>
				<p><a class="btn btn-default" href="javascript:history.back();">Return Back</a></p>
			</div>
		</section>
		<!-- Show Result All end here -->
		
		<!-- Footer start here -->
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<!-- <p><a href="">home</a> | <a href="">results</a> | <a href="">photo gallery</a> | <a href="">contact</a></p> -->
					</div>
					
					<div class="col-md-6 text-right">
						<p>&copy; 2016 &amp; all rights reserved to the company.</p>
					</div>
				</div>
			</div>
		</footer>
		<!-- Footer end here -->

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="js/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>

<?php
}
else
{
    echo '<script>location.replace("index.php")</script>';
}
?>