<?php
include '../connect.php';
include '../function.php';
session_start();
if($_SESSION['sbttc_basic_uid']!='')
{
date_default_timezone_set("Asia/Dhaka");
$current_date=date("YmdHis");
if(isset($_POST['first'])) {
    $main=get_id();
    $basicCourse = $_POST['basicCourse'];
    $course_duration = $_POST['course_duration'];
    $dateOfExamination = $_POST['dateOfExamination'];
    $centreName = $_POST['centreName'];
    $traineeName = $_POST['traineeName'];
    $fatherName = $_POST['fatherName'];
    $motherName = $_POST['motherName'];
    $idNo = $_POST['idNo'];
    $registrationNo = $_POST['registrationNo'];
    $traineeAddress = $_POST['traineeAddress'];
    $firstTerm = $_POST['firstTerm'];
    $midTerm = $_POST['midTerm'];
    $theoretical = $_POST['theoretical'];
    $practical = $_POST['practical'];
    $generalFittings = $_POST['generalFittings'];
    $technicalArt = $_POST['technicalArt'];
    $basicEnglish = $_POST['basicEnglish'];
    $vivaVoce = $_POST['vivaVoce'];
    $gradePointAverage = $_POST['gradePointAverage'];
    $obtainGrade = $_POST['obtainGrade'];
    $issueDate = $_POST['issueDate'];
    $POSTDATA = array();
    $POSTDATA['currentD'] = $current_date;
    $POSTDATA['sourcePath'] = $_FILES['file']['tmp_name'];
    $POSTDATA['name'] = $_FILES['file']['name'];
    $POSTDATA['size'] = $_FILES['file']['size'];
    $POSTDATA['type'] = $_FILES['file']['type'];
    $POSTDATA['targetPath'] = $_SERVER["DOCUMENT_ROOT"] . "/SBTTC/primary/img/basic/" . $idNo;
    //$POSTDATA['targetPath']= $_SERVER["DOCUMENT_ROOT"]."/img/basic/".$current_date.$_FILES['file']['name'];
    $id_exist = id_exist($idNo);
    $reg_exist = reg_exist($registrationNo);
    if ($id_exist == true) {
        if ($reg_exist == true) {


        $errors = array();

        $file_name = $POSTDATA['currentD'] . $POSTDATA['name'];
        //echo '<script>alert("' . $currentD . $POSTDATA['name'] . '");</script>';
        if ($file_name != $POSTDATA['currentD']) {

            $file_size = $POSTDATA['size'];

            $file_type = $POSTDATA['type'];
            $file_ext = strtolower(end(explode('.', $file_name)));

            $expensions = array("jpeg", "jpg", "png");
            $POSTDATA['targetPath'] = $_SERVER["DOCUMENT_ROOT"] . "/primary/img/basic/" . $main.'.'.$file_ext;
            $img_final=$main.'.'.$file_ext;
            if (in_array($file_ext, $expensions) === false) {

                $errors[0] = "Extension not allowed.";
            }

            if ($file_size > 52428800) {
                $errors[1] = 'File size must be less then 50 MB';
            }
        } else {
            $file_name = '';
        }
        if (empty($errors) == true) {

            $result = mysql_query("insert into basic values('','$basicCourse','$course_duration','$dateOfExamination',
                    '$centreName','$traineeName','$fatherName','$motherName','$idNo','$registrationNo','$traineeAddress',
                    '$img_final','$issueDate');") or die(mysql_error());
            $id = mysql_insert_id();
            $POSTDATA['targetPath'] = $_SERVER["DOCUMENT_ROOT"] . "/primary/img/basic/" . $id.'.'.$file_ext;
            $img_final=$id.'.'.$file_ext;
            move_uploaded_file($POSTDATA['sourcePath'], $POSTDATA['targetPath']);
            $result2=mysql_query("update basic set img='$img_final' where id='$id'");
            $result1 = mysql_query("insert into mark values('','$id','$firstTerm','$midTerm','$theoretical',
                    '$practical','$generalFittings','$technicalArt','$basicEnglish','$vivaVoce','$gradePointAverage','$obtainGrade'
                    );") or die(mysql_error());
        } else {
            echo '<script>alert("' . $errors[0] . '\n' . $errors[1] . '\n")</script>';

        }
        $error = '';
        $error1 = '';
    }
        else{

            echo '<script>alert("Registration No Already Exist!!!!!!");</script>';


        }
        } else {

        echo '<script>alert("Id No Already Exist!!!!!!");</script>';

        }


}
else if(isset($_POST['job_test'])) {
    $jobTest = $_POST['jobTest'];
    $main_job=get_id_job();
    $dateOfExaminationJob = $_POST['dateOfExaminationJob'];
    $regerenceNoJob = $_POST['regerenceNoJob'];
    $traineeNameJob = $_POST['traineeNameJob'];
    $fatherNameJob = $_POST['fatherNameJob'];
    $passportNoJob = $_POST['passportNoJob'];
    $traineeAddressJob = $_POST['traineeAddressJob'];
    $issueDatejob = $_POST['issueDatejob'];
    $theoreticalJob = $_POST['theoreticalJob'];
    $practicalJob = $_POST['practicalJob'];
    $measurementJob = $_POST['measurementJob'];
    $drawingJob = $_POST['drawingJob'];
    $eaverageJob = $_POST['eaverageJob'];
    $ecommentsJob = $_POST['ecommentsJob'];
    $POSTDATA = array();
    $POSTDATA['currentD'] = $current_date;
    $POSTDATA['sourcePath'] = $_FILES['filejob']['tmp_name'];
    $POSTDATA['name'] = $_FILES['filejob']['name'];
    $POSTDATA['size'] = $_FILES['filejob']['size'];
    $POSTDATA['type'] = $_FILES['filejob']['type'];
    $POSTDATA['targetPath'] = $_SERVER["DOCUMENT_ROOT"] . "/primary/img/job/" . $current_date . $_FILES['filejob']['name'];
    //$POSTDATA['targetPath']= $_SERVER["DOCUMENT_ROOT"]."/img/basic/".$current_date.$_FILES['file']['name'];
    $passPort_exist = passport_exist($passportNoJob);
    $refer_exist = refer_exist($regerenceNoJob);
    if ($passPort_exist == true)
    {
        if ($refer_exist == true) {


            $errors = array();

            $file_name = $POSTDATA['currentD'] . $POSTDATA['name'];

            if ($file_name != $POSTDATA['currentD']) {

                $file_size = $POSTDATA['size'];

                $file_type = $POSTDATA['type'];
                $file_ext = strtolower(end(explode('.', $file_name)));

                $expensions = array("jpeg", "jpg", "png");
                $POSTDATA['targetPath'] = $_SERVER["DOCUMENT_ROOT"] . "/SBTTC/primary/img/job/" . $main_job.'.'.$file_ext;
                $img_final=$main_job.'.'.$file_ext;
                if (in_array($file_ext, $expensions) === false) {

                    $errors[0] = "Extension not allowed.";
                }

                if ($file_size > 52428800) {
                    $errors[1] = 'File size must be less then 50 MB';
                }
            } else {
                $file_name = '';
            }
            if (empty($errors) == true) {

                $result = mysql_query("insert into job_test values('','$jobTest','$dateOfExaminationJob','$regerenceNoJob',
                '$traineeNameJob','$fatherNameJob','$passportNoJob','$traineeAddressJob','$issueDatejob','$img_final'
                );") or die(mysql_error());
                $id = mysql_insert_id();
                $POSTDATA['targetPath'] = $_SERVER["DOCUMENT_ROOT"] . "/primary/img/job/" . $id.'.'.$file_ext;
                $img_final=$id.'.'.$file_ext;
                move_uploaded_file($POSTDATA['sourcePath'], $POSTDATA['targetPath']);
                $result2=mysql_query("update job_test set img='$img_final' where id='$id'");
                $result1 = mysql_query("insert into mark_job values('','$id','$theoreticalJob','$practicalJob','$measurementJob',
                '$drawingJob','$eaverageJob','$ecommentsJob'
                );") or die(mysql_error());
            } else {
                echo '<script>alert("' . $errors[0] . '\n' . $errors[1] . '\n")</script>';

            }
            $error = '';
        }
        else {
            echo '<script>alert("Reference No Already Exist!!!");</script>';
        }
        }
        else{
            echo '<script>alert("Passport No Already Exist!!!");</script>';
        }

}
?>

<?php include 'header.php';?>
		
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
		
		<!-- Result start here -->
		<section id="resultSubmit">
			<div class="container">
				<div id="tabs">
					<ul>
						<li><a href="#tabs-1">Basic Certificate</a></li>
						<li><a href="#tabs-2">Job Test Certificate</a></li>
					</ul>
					<div id="tabs-1">
						<form action="" method="post" enctype="multipart/form-data">
							<fieldset>
								<p>Information about Trade</p>
								<div class="row">
									<div class="form-group col-md-6">
										<label for="nameOfExamination">Name of Course</label>
										<select class="form-control" id="basicCourse" name="basicCourse">
											<?php
                                                $select=mysql_query("select * from course ;");
                                                    while($eng=mysql_fetch_array($select))
                                                    {
                                                        print '<option value="'.$eng['id'].'">'.$eng['course_name'].'</option>';
                                                    }
                                            ?>
										</select>
									</div>
									<div class="form-group col-md-6">
										<label for="dateOfExamination">Date of Examination </label>
										<input type="text" class="form-control datepicker" id="dateOfExamination" name="dateOfExamination" placeholder="MM/DD/YYYY">
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label for="courseDuration">Duration of Course</label>
										<select class="form-control" name="course_duration">
											<option>Select one</option>
                                            <?php
                                            $select=mysql_query("select * from course_duration ;");
                                            while($eng=mysql_fetch_array($select))
                                            {
                                                print '<option value="'.$eng['id'].'">'.$eng['duration_name'].'</option>';
                                            }
                                            ?>
										</select>
									</div>
									<div class="form-group col-md-6">
										<label for="centreName">Name of Centre</label>
										<input type="text" class="form-control" id="centreName" name="centreName" placeholder="Centre Name">
									</div>
								</div>
										
							</fieldset>
									
							<fieldset>
								<p>Trainee's Information</p>
								<div class="row">
									<div class="form-group col-md-12">
										<label for="traineeName">Name of Trainee</label>
										<input type="text" class="form-control" name="traineeName" id="traineeName" placeholder="Trainee Name">
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label for="fatherName">Father's Name</label>
										<input type="text" class="form-control" name="fatherName" id="fatherName" placeholder="Father's Name">
									</div>
									<div class="form-group col-md-6">
										<label for="motherName">Mother's Name</label>
										<input type="text" class="form-control" name="motherName" id="motherName" placeholder="Mohter's Name">
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label for="idNo">ID No</label>

										<input type="text" class="form-control" name="idNo" id="idNo" placeholder="ID No">
                                        <?php if($error!=''){ echo '<label for="idNo" style="background-color: red">'.$error.'</label>';} ?>
									</div>
									<div class="form-group col-md-6">
										<label for="registrationNo">Registration No</label>
										<input type="text" class="form-control" name="registrationNo" id="registrationNo" placeholder="Registration No">
                                        <?php if($error1!=''){ echo '<label for="idNo" style="background-color: red">'.$error1.'</label>';} ?>
                                    </div>
								</div>
								<div class="row">
									<div class="form-group col-md-12">
										<label for="traineeAddress">Address</label>
										<input type="text" class="form-control" name="traineeAddress" id="traineeAddress" placeholder="Trainee Address">
									</div>
								</div>
							</fieldset>
			
							<fieldset>
								<p>Mark Distribution</p>
								<div class="row">
									<div class="form-group col-md-4">
                                        <label for="exam_basic">Exam No</label>
										<label for="firstTerm">First Term (Theory &amp; Practical)</label>
										<label for="midTerm">Mid Term (Theory &amp; Practical)</label>
										<label for="midTerm">Final Examination</label>
										<label for="theoretical">Theoretical</label>
										<label for="practical">Practical</label>
										<label for="generalFittings">General Fittings/Mesurement</label>
										<label for="technicalArt">Technical Art/Drawing</label>
										<label for="basicEnglish">Basic English</label>
										<label for="vivaVoce">Viva Voce</label>

									</div>
                                    <div class="form-group col-md-8">
                                        <select  class="form-control resultjob" name="exam_basic" id="exam_basic">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3" selected>3</option>

                                        </select>
                                    </div>
									<div class="form-group col-md-2">
										<input type="text" class="form-control result" name="firstTerm" id="firstTerm" placeholder="Acquired Number">
										<input type="text" class="form-control result" name="midTerm" id="midTerm" placeholder="Acquired Number">
										<label></label>
										<input type="text" class="form-control result" name="theoretical" id="theoretical" placeholder="Acquired Number">
										<input type="text" class="form-control result" name="practical" id="practical" placeholder="Acquired Number">
										<input type="text" class="form-control result" name="generalFittings" id="generalFittings" placeholder="Acquired Number">
										<input type="text" class="form-control result" name="technicalArt" id="technicalArt" placeholder="Acquired Number">
										<input type="text" class="form-control result" name="basicEnglish" id="basicEnglish" placeholder="Acquired Number">
										<input type="text" class="form-control result" name="vivaVoce" id="vivaVoce" placeholder="Acquired Number">
									</div>
									
									<div class="form-group col-md-1">
										<input type="text" class="form-control" id="firstTermLG" placeholder="LG" disabled>
										<input type="text" class="form-control" id="midTermLG" placeholder="LG" disabled>
										<label></label>
										<input type="text" class="form-control" id="theoreticalLG" placeholder="LG" disabled>
										<input type="text" class="form-control" id="practicalLG" placeholder="LG" disabled>
										<input type="text" class="form-control" id="generalFittingsLG" placeholder="LG" disabled>
										<input type="text" class="form-control" id="technicalArtLG" placeholder="LG" disabled>
										<input type="text" class="form-control" id="basicEnglishLG" placeholder="LG" disabled>
										<input type="text" class="form-control" id="vivaVoceLG" placeholder="LG" disabled>
									</div>
									<div class="form-group col-md-1">
										<input type="text" class="form-control" id="firstTermGP" placeholder="GP" disabled>
										<input type="text" class="form-control" id="midTermGP" placeholder="GP" disabled>
										<label></label>
										<input type="text" class="form-control" id="theoreticalGP" placeholder="GP" disabled>
										<input type="text" class="form-control" id="practicalGP" placeholder="GP" disabled>
										<input type="text" class="form-control" id="generalFittingsGP" placeholder="GP" disabled>
										<input type="text" class="form-control" id="technicalArtGP" placeholder="GP" disabled>
										<input type="text" class="form-control" id="basicEnglishGP" placeholder="GP" disabled>
										<input type="text" class="form-control" id="vivaVoceGP" placeholder="GP" disabled>
									</div>
									<div class="form-group col-md-2">
										<textarea class="form-control text-center textareaBasic" rows="1" id="gradePointAverage" name="gradePointAverage" placeholder="GP Average" readonly></textarea>
									</div>
									<div class="form-group col-md-2">
										<textarea class="form-control text-center textareaBasic" rows="1" id="obtainGrade" name="obtainGrade" placeholder="Obtain Grade" readonly></textarea>
									</div>
								</div>
								
							</fieldset>

							<fieldset>
								<p>More Inforamtion</p>
								<div class="row">
									<div class="form-group col-md-6">
										<label for="uploadPicture">Upload Picture</label>
										<input type="file" name="file" id="uploadPicture">Please upload .jpg, .png, .gif formated image.
									</div>
									<div class="form-group col-md-6">
										<label for="issueDate">Date of Issue</label>
										<input type="text" class="form-control datepicker" name="issueDate" id="issueDate" placeholder="MM/DD/YYYY">
									</div>
								</div>
							</fieldset>
							<button type="submit" name="first" class="btn btn-default">Submit</button>
						</form>
					</div>
					<div id="tabs-2">
						<form action="" method="post" enctype="multipart/form-data">
							<fieldset>
								<p>Information about Trade</p>
								<div class="row">
									<div class="form-group col-md-5">
										<label for="nameOfExaminationJob">Name of Course</label>
										<select class="form-control" name="jobTest" id="jobTest">
                                            <?php
                                            $select=mysql_query("select * from course ;");
                                            while($eng=mysql_fetch_array($select))
                                            {
                                                print '<option value="'.$eng['id'].'">'.$eng['course_name'].'</option>';
                                            }
                                            ?>
										</select>
									</div>
									<div class="form-group col-md-4">
										<label for="dateOfExaminationJob">Date of Examination </label>
										<input type="text" class="form-control datepicker" name="dateOfExaminationJob" id="dateOfExaminationJob" placeholder="MM/DD/YYYY">
									</div>
									<div class="form-group col-md-3">
										<label for="regerenceNoJob">Reference No</label>
										<input type="text" class="form-control" name="regerenceNoJob" id="regerenceNoJob" placeholder="Reference No">
									</div>
								</div>									
							</fieldset>
									
							<fieldset>
								<p>Trainee's Information</p>
								<div class="row">
									<div class="form-group col-md-12">
										<label for="traineeNameJob">Name of Trainee</label>
										<input type="text" class="form-control" name="traineeNameJob" id="traineeNameJob" placeholder="Trainee Name">
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label for="fatherNameJob">Father's Name</label>
										<input type="text" class="form-control" name="fatherNameJob" id="fatherNameJob" placeholder="Father's Name">
									</div>
									<div class="form-group col-md-6">
										<label for="passportNoJob">Passport No</label>
										<input type="text" class="form-control" name="passportNoJob" id="passportNoJob" placeholder="Passport No">
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-12">
										<label for="traineeAddressJob">Address</label>
										<input type="text" class="form-control" name="traineeAddressJob" id="traineeAddressJob" placeholder="Trainee Address">
									</div>
								</div>
							</fieldset>
			
							<fieldset>
								<p>Mark Distribution</p>
								<div class="row">
									<div class="form-group col-md-4">
										<label for="etheoreticalJob">Exam No</label>
										<label for="etheoreticalJob">Theoretical</label>
										<label for="epracticalJob">Practical</label>
										<label for="emeasurementJob">Measurement</label>
										<label for="edrawingJob">Drawing</label>
									</div>
                                    <div class="form-group col-md-8">
                                        <select  class="form-control resultjob" name="exam_job" id="exam_job">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4" selected>4</option>
                                        </select>
                                    </div>
									<div class="form-group col-md-2">

										<input type="text" class="form-control resultjob" name="theoreticalJob" id="etheoreticalJob" placeholder="Acquired Number">
										<input type="text" class="form-control resultjob" name="practicalJob" id="epracticalJob" placeholder="Acquired Number">
										<input type="text" class="form-control resultjob" name="measurementJob" id="emeasurementJob" placeholder="Acquired Number">
										<input type="text" class="form-control resultjob" name="drawingJob" id="edrawingJob" placeholder="Acquired Number">
									</div>
									
									<div class="form-group col-md-1">

										<input type="text" class="form-control" id="etheoreticalJobLG" placeholder="LG" disabled>
										<input type="text" class="form-control" id="epracticalJobLG" placeholder="LG" disabled>
										<input type="text" class="form-control" id="emeasurementJobLG" placeholder="LG" disabled>
										<input type="text" class="form-control" id="edrawingJobLG" placeholder="LG" disabled>
									</div>
                                    <div class="form-group col-md-1">

                                        <input type="text" class="form-control" id="etheoreticalJobGP" placeholder="GP" disabled>
                                        <input type="text" class="form-control" id="epracticalJobGP" placeholder="GP" disabled>
                                        <input type="text" class="form-control" id="emeasurementJobGP" placeholder="GP" disabled>
                                        <input type="text" class="form-control" id="edrawingJobGP" placeholder="GP" disabled>
                                    </div>
									<div class="form-group col-md-2">
										<textarea class="form-control text-center textareaJob" rows="1" name="eaverageJob" id="eaverageJob" placeholder="Obtain Grade" readonly></textarea>
									</div>
									<div class="form-group col-md-2">
										<textarea class="form-control text-center textareaJob" rows="1" name="ecommentsJob" id="ecommentsJob" placeholder="Comments" readonly></textarea>
									</div>
								</div>
								
							</fieldset>

							<fieldset>
								<p>More Inforamtion</p>
								<div class="row">
									<div class="form-group col-md-6">
										<label for="uploadPictureJob">Upload Picture</label>
										<input type="file" name="filejob" id="uploadPictureJob">Please upload .jpg, .png, .gif formated image.
									</div>
									<div class="form-group col-md-6">
										<label for="issueDateJob">Date of Issue</label>
										<input type="text" class="form-control datepicker" name="issueDatejob" id="issueDatejob" placeholder="MM/DD/YYYY">
									</div>
								</div>
							</fieldset>
							<button type="submit" name="job_test" class="btn btn-default">Submit</button>
						</form>
					</div>
				</div>
				
			</div> 
		</section>
		<!-- Result end here -->
	
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
		<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script>
			$(function() {
				$( ".datepicker" ).datepicker({
                    dateFormat: 'yy-mm-dd'
                });
			});
			
			//tab menus
			$(function() {
				$( "#tabs" ).tabs();
			});
			
			//sorting basic 
			var my_options = $("#basicCourse option");
			var selected = $("#basicCourse").val(); /* preserving original selection, step 1 */

			my_options.sort(function(a,b) {
				if (a.text > b.text) return 1;
				else if (a.text < b.text) return -1;
				else return 0
			})

			$("#basicCourse").empty().append( my_options );
			$("#basicCourse").val(selected); /* preserving original selection, step 2 */
			
			var my_options = $("#jobTest option");
			var selected = $("#jobTest").val(); /* preserving original selection, step 1 */

			my_options.sort(function(a,b) {
				if (a.text > b.text) return 1;
				else if (a.text < b.text) return -1;
				else return 0
			})

			$("#jobTest").empty().append( my_options );
			$("#jobTest").val(selected); /* preserving original selection, step 2 */
		</script>
        <script>
            $('.result').change(function()
            {
             var exam_basic=parseFloat($('#exam_basic').val());
                console.log(exam_basic);
             var id=$(this).attr('id');
                if(id=='vivaVoce')
                {
                    var viva_val=$(this).val();
                    var id_val=(viva_val/50)*100;
                }
                else
                {
                    var id_val=$(this).val();
                }

                if(id_val<=100&&id_val>=90)
                {
                    var LG='A+';
                    var GP=5;
                }
                else if(id_val<=89&&id_val>=80)
                {
                    var LG='A';
                    var GP=4;
                }
                else if(id_val<=79&&id_val>=70)
                {
                    var LG='B+';
                    var GP=3.5;
                }
                else if(id_val<=69&&id_val>=60)
                {
                    var LG='B';
                    var GP=3;
                }
                else if(id_val<=59&&id_val>=50)
                {
                    var LG='C+';
                    var GP=2.5;
                }
                else if(id_val<=49&&id_val>=40)
                {
                    var LG='C';
                    var GP=2;
                }
                else if(id_val<=39&&id_val>=0)
                {
                    var LG='F';
                    var GP=0;
                }

                else
                {
                    var LG='';
                    var GP='';
                }
                $('#'+id+'LG').val(LG);
                $('#'+id+'GP').val(GP);
                var total_GP=0;
                var firstTermGP=parseFloat($('#firstTermGP').val());
                var midTermGP=parseFloat($('#midTermGP').val());
                var theoreticalGP=parseFloat($('#theoreticalGP').val());
                var practicalGP=parseFloat($('#practicalGP').val());
                var generalFittingsGP=parseFloat($('#generalFittingsGP').val());
                var technicalArtGP= parseFloat($('#technicalArtGP').val());
                var basicEnglishGP=parseFloat($('#basicEnglishGP').val());
                var vivaVoceGP=parseFloat($('#vivaVoceGP').val());
                if(vivaVoceGP!=NaN&&firstTermGP!=NaN&&midTermGP!=NaN&&theoreticalGP!=NaN&&practicalGP!=NaN&&generalFittingsGP!=NaN&&technicalArtGP!=NaN&&basicEnglishGP!=NaN)
                {

                    //console.log(theoreticalGP);
                    total_GP=vivaVoceGP+theoreticalGP+practicalGP+generalFittingsGP+technicalArtGP+basicEnglishGP
                    var total_final_GP=((total_GP/6)+firstTermGP+midTermGP)/exam_basic;
                    total_final_GP=total_final_GP.toFixed(2);
                    if(total_final_GP>=5)
                    {
                        var LG='A+';
                        var GP=5;
                    }
                    else if(total_final_GP<=4.99&&total_final_GP>=4)
                    {
                        var LG='A';
                        var GP=4;
                    }
                    else if(total_final_GP<=3.99&&total_final_GP>=3.5)
                    {
                        var LG='B+';
                        var GP=3.5;
                    }
                    else if(total_final_GP<=3.49&&total_final_GP>=3)
                    {
                        var LG='B';
                        var GP=3;
                    }
                    else if(total_final_GP<=2.99&&total_final_GP>=2.5)
                    {
                        var LG='C+';
                        var GP=2.5;
                    }
                    else if(total_final_GP<=2.49&&total_final_GP>=2)
                    {
                        var LG='C';
                        var GP=2;
                    }
                    else if(total_final_GP<=1.99&&total_final_GP>=0)
                    {
                        var LG='F';
                        var GP=0;
                    }

                    else
                    {
                        var LG='';
                        var GP='';
                    }
                    $('#gradePointAverage').val(total_final_GP);
                    $('#obtainGrade').val(LG);

                }


            });



        </script>

        <script>
            $('.resultjob').change(function()
            {
                var exam_basic=parseFloat($('#exam_job').val());
                var id=$(this).attr('id');
                var id_val=$(this).val();
                if(id_val<=100&&id_val>=90)
                {
                    var LG='A+';
                    var GP=5;
                }
                else if(id_val<=89&&id_val>=80)
                {
                    var LG='A';
                    var GP=4;
                }
                else if(id_val<=79&&id_val>=70)
                {
                    var LG='B+';
                    var GP=3.5;
                }
                else if(id_val<=69&&id_val>=60)
                {
                    var LG='B';
                    var GP=3;
                }
                else if(id_val<=59&&id_val>=50)
                {
                    var LG='C+';
                    var GP=2.5;
                }
                else if(id_val<=49&&id_val>=40)
                {
                    var LG='C';
                    var GP=2;
                }
                else if(id_val<=39&&id_val>=0)
                {
                    var LG='F';
                    var GP=0;
                }

                else
                {
                    var LG='';
                    var GP='';
                }
                $('#'+id+'LG').val(LG);
                $('#'+id+'GP').val(GP);
                var total_GP=0;
                var etheoreticalJobGP=parseFloat($('#etheoreticalJobGP').val());
                var epracticalJobGP=parseFloat($('#epracticalJobGP').val());
                var emeasurementJobGP=parseFloat($('#emeasurementJobGP').val());
                var edrawingJobGP=parseFloat($('#edrawingJobGP').val());

                if(etheoreticalJobGP!=NaN&&epracticalJobGP!=NaN&&emeasurementJobGP!=NaN&&edrawingJobGP!=NaN)
                {

                    //console.log(theoreticalGP);
                    total_GP=etheoreticalJobGP+epracticalJobGP+emeasurementJobGP+edrawingJobGP;
                    var total_final_GP=(total_GP/exam_basic);
                    total_final_GP=total_final_GP.toFixed(2);
                    if(total_final_GP>=5)
                    {
                        var LG='A+';
                        var GP='Qualified';
                    }
                    else if(total_final_GP<=4.99&&total_final_GP>=4)
                    {
                        var LG='A';
                        var GP='Qualified';
                    }
                    else if(total_final_GP<=3.99&&total_final_GP>=3.5)
                    {
                        var LG='B+';
                        var GP='Qualified';
                    }
                    else if(total_final_GP<=3.49&&total_final_GP>=3)
                    {
                        var LG='B';
                        var GP='Qualified';
                    }
                    else if(total_final_GP<=2.99&&total_final_GP>=2.5)
                    {
                        var LG='C+';
                        var GP='Unfit';
                    }
                    else if(total_final_GP<=2.49&&total_final_GP>=2)
                    {
                        var LG='C';
                        var GP='Unfit';
                    }
                    else if(total_final_GP<=1.99&&total_final_GP>=0)
                    {
                        var LG='F';
                        var GP='Unfit';
                    }

                    else
                    {
                        var LG='';
                        var GP='';
                    }

                    $('#eaverageJob').val(LG);
                    $('#ecommentsJob').val(GP);

                }


            });



        </script>
		  
	</body>
</html>
<?php
}
else
{
    echo '<script>location.replace("index.php")</script>';
}
?>