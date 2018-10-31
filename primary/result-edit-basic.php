<?php
include '../connect.php';
include '../function.php';
session_start();
if($_SESSION['sbttc_basic_uid']!='')
{
date_default_timezone_set("Asia/Dhaka");
$current_date=date("YmdHis");
$id=$_GET['id'];
if(isset($_POST['first']))
{
    $basicCourse = $_POST['basicCourse'];
    $course_duration = $_POST['course_duration'];
    $dateOfExamination = $_POST['dateOfExamination'];    
	$centreName = $_POST['centreName'];    
	$traineeName = $_POST['traineeName'];
    $fatherName = $_POST['fatherName'];
    $motherName = $_POST['motherName'];
    $idNo = $_POST['idNo'];
    $registrationNo = $_POST['registrationNo'];	
    $passportNo = $_POST['passportNo'];	
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
    $POSTDATA['targetPath'] = $_SERVER["DOCUMENT_ROOT"] . "/SBTTC/primary/img/basic/" . $current_date . $_FILES['file']['name'];
    //$POSTDATA['targetPath']= $_SERVER["DOCUMENT_ROOT"]."/img/basic/".$current_date.$_FILES['file']['name'];
    $id_exist = id_exist_edit($id,$idNo);
    $reg_exist = reg_exist_edit($id,$registrationNo);
    if ($id_exist == true) {
        if ($reg_exist == true) {


            $errors = array();

            $file_name = $POSTDATA['currentD'] . $POSTDATA['name'];
            echo '<script>alert("' . $currentD . $POSTDATA['name'] . '");</script>';
            if ($file_name != $POSTDATA['currentD']) {

                $file_size = $POSTDATA['size'];

                $file_type = $POSTDATA['type'];
                $file_ext = strtolower(end(explode('.', $file_name)));

                $expensions = array("jpeg", "jpg", "png");
                $POSTDATA['targetPath'] = $_SERVER["DOCUMENT_ROOT"] . "/primary/img/basic/" . $id.'.'.$file_ext;
                $img_final=$id.'.'.$file_ext;
                if (in_array($file_ext, $expensions) === false) {

                    $errors[0] = "Extension not allowed.";
                }

                if ($file_size > 52428800) {
                    $errors[1] = 'File size must be less then 50 MB';
                }
            } else {
                $file_name = $past_img;
                $img_final=$past_img;
            }
            if (empty($errors) == true) {
                move_uploaded_file($POSTDATA['sourcePath'], $POSTDATA['targetPath']);
                $result = mysql_query("update basic set basicCourse='$basicCourse',course_duration='$course_duration',dateOfExamination='$dateOfExamination',
                    centreName='$centreName',traineeName='$traineeName',fatherName='$fatherName',motherName='$motherName',idNo='$idNo',registrationNo='$registrationNo',traineeAddress='$traineeAddress',
                    img='$img_final',issueDate='$issueDate' where id='$id';") or die(mysql_error());

                $result1 = mysql_query("update mark set firstTerm='$firstTerm',midTerm='$midTerm',theoretical='$theoretical',
                    practical='$practical',generalFittings='$generalFittings',technicalArt='$technicalArt',basicEnglish='$basicEnglish',vivaVoce='$vivaVoce',GP='$gradePointAverage',grade='$obtainGrade'
                    where u_id='$id';") or die(mysql_error());
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
if(isset($_GET['id']))
{

    $result=mysql_query("select * from basic where id='$id';") or die(mysql_error());
    $result1=mysql_query("select * from mark where u_id='$id';") or die(mysql_error());
    $rows1=mysql_num_rows($result);
    if($rows1>0) {
        $engdata=mysql_fetch_array($result);
        $engdata1=mysql_fetch_array($result1);
        $basicCourse = $_POST['basicCourse'];
        $course_duration = $_POST['course_duration'];
        $dateOfExamination = $_POST['dateOfExamination'];    
        $centreName = $_POST['centreName'];    
        $traineeName = $_POST['traineeName'];
        $fatherName = $_POST['fatherName'];
        $motherName = $_POST['motherName'];
        $idNo = $_POST['idNo'];
        $registrationNo = $_POST['registrationNo'];	
        $passportNo = $_POST['passportNo'];	
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

    }
    else{

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
                                if($basicCourse==$eng['id'])
                                {
                                    print '<option value="'.$eng['id'].'" selected>'.$eng['name'].'</option>';
                                }
                                else{
                                    print '<option value="'.$eng['id'].'">'.$eng['name'].'</option>';
                                }

                            }
                            ?>

                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="dateOfExamination">Date of Examination </label>
                    <input type="text" class="form-control datepicker" id="dateOfExamination" name="dateOfExamination" value="<?php echo $dateOfExamination;?>" placeholder="DD/MM/YYYY">
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
                            if($course_duration==$eng['id'])
                            {
                                print '<option value="'.$eng['id'].'" selected>'.$eng['name'].'</option>';
                            }
                            else{
                                print '<option value="'.$eng['id'].'">'.$eng['name'].'</option>';
                            }

                        }
                        ?>
                    </select>
                </div>
            </div>

        </fieldset>

        <fieldset>
            <p>Trainee's Information</p>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="traineeName">Name of Trainee</label>
                    <input type="text" class="form-control" name="traineeName" value="<?php echo $traineeName;?>" id="traineeName" placeholder="Trainee Name">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="fatherName">Father's Name</label>
                    <input type="text" class="form-control" name="fatherName" value="<?php echo $fatherName;?>" id="fatherName" placeholder="Father's Name">
                </div>
                <div class="form-group col-md-6">
                    <label for="motherName">Mother's Name</label>
                    <input type="text" class="form-control" name="motherName" value="<?php echo $motherName;?>" id="motherName" placeholder="Mohter's Name">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
				    <label for="traineeAddress">Passport No</label>
				    <input type="text" class="form-control" name="passportNo" id="passportNo" value="<?php echo $passportNo;?>" placeholder="Trainee Address">
                    <?php if($error!=''){ echo '<label for="passportNo" style="background-color: red">'.$error.'</label>';} ?>
                </div>
                <div class="form-group col-md-4">
                    <label for="idNo">ID No</label>

                    <input type="text" class="form-control" name="idNo" value="<?php echo $idNo;?>" id="idNo" placeholder="ID No">
                    <?php if($error!=''){ echo '<label for="idNo" style="background-color: red">'.$error.'</label>';} ?>
                </div>
                <div class="form-group col-md-4">
                    <label for="registrationNo">Registration No</label>
                    <input type="text" class="form-control" name="registrationNo" value="<?php echo $registrationNo;?>" id="registrationNo" placeholder="Registration No">
                    <?php if($error1!=''){ echo '<label for="idNo" style="background-color: red">'.$error1.'</label>';} ?>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="traineeAddress">Address</label>
                    <input type="text" class="form-control" name="traineeAddress" value="<?php echo $traineeAddress;?>" id="traineeAddress" placeholder="Trainee Address">
                </div>
            </div>
        </fieldset>

        <fieldset>
            <p>Mark Distribution</p>
            <div class="row">
                <div class="form-group col-md-4">
                                        <label for="exam_basic">Exam No</label>
										<label for="theoretical">Theoretical</label>
										<label for="practical">Practical</label>
										<label for="generalFittings">General Fittings/Mesurement</label>
										<label for="technicalArt">Technical Art/Drawing</label>
										<label for="basicEnglish">Basic English</label>
										<label for="vivaVoce">Viva Voce</label>

									</div>
                <div class="form-group col-md-8">
                                        <select  class="form-control resultjob" name="exam_basic" id="exam_basic">
                                         
                                            <option value="1" >1</option>
                                            <option value="2" >2</option>
                                            <option value="3" >3</option>
											  <option value="4" >4</option>
											    <option value="5" >5</option>
												  <option value="6" selected >6</option>

                                        </select>
                                    </div>
                
                <div class="form-group col-md-2">
										<input type="text" class="form-control result" name="theoretical" id="theoretical" placeholder="Acquired Point" value="<?php echo $theoretical;?>">
										<input type="text" class="form-control result" name="practical" id="practical" placeholder="Acquired Point" value="<?php echo $practical;?>">
										<input type="text" class="form-control result" name="generalFittings" id="generalFittings" placeholder="Acquired Point" value="<?php echo $generalFittings;?>">
										<input type="text" class="form-control result" name="technicalArt" id="technicalArt" placeholder="Acquired Point" value="<?php echo $technicalArt;?>">
										<input type="text" class="form-control result" name="basicEnglish" id="basicEnglish" placeholder="Acquired Point" value="<?php echo $basicEnglish;?>">
										<input type="text" class="form-control result" name="vivaVoce" id="vivaVoce" placeholder="Acquired Point" value="<?php echo $vivaVoce;?>">
									</div>
									
									<div class="form-group col-md-1">
										<input type="text" class="form-control" id="theoreticalLG" placeholder="LG" disabled>
										<input type="text" class="form-control" id="practicalLG" placeholder="LG" disabled>
										<input type="text" class="form-control" id="generalFittingsLG" placeholder="LG" disabled>
										<input type="text" class="form-control" id="technicalArtLG" placeholder="LG" disabled>
										<input type="text" class="form-control" id="basicEnglishLG" placeholder="LG" disabled>
										<input type="text" class="form-control" id="vivaVoceLG" placeholder="LG" disabled>
									</div>
									<div class="form-group col-md-1">
										<input type="text" class="form-control" id="theoreticalGP" placeholder="GP" disabled>
										<input type="text" class="form-control" id="practicalGP" placeholder="GP" disabled>
										<input type="text" class="form-control" id="generalFittingsGP" placeholder="GP" disabled>
										<input type="text" class="form-control" id="technicalArtGP" placeholder="GP" disabled>
										<input type="text" class="form-control" id="basicEnglishGP" placeholder="GP" disabled>
										<input type="text" class="form-control" id="vivaVoceGP" placeholder="GP" disabled>
									</div>
                <div class="form-group col-md-2">
                    <textarea class="form-control text-center textareaBasic" rows="1" id="gradePointAverage"  name="gradePointAverage" value="" placeholder="GP Average" readonly><?php echo $gradePointAverage;?></textarea>
                </div>
                <div class="form-group col-md-2">
                    <textarea class="form-control text-center textareaBasic" rows="1" id="obtainGrade"  name="obtainGrade" value="" placeholder="Obtain Grade" readonly><?php echo $obtainGrade;?></textarea>
                </div>
            </div>

        </fieldset>

        <fieldset>
            <p>More Inforamtion</p>
            <div class="row">
                <div class="form-group col-md-6">
                    <img src="img/basic/<?php echo $img; ?>" alt="Trainees Picture" width="110">
                    <label for="uploadPicture">Upload Picture</label>

                    <input type="file" name="file" id="uploadPicture">Please upload .jpg, .png, .gif formated image.
                    <input type="hidden" name="past_img" value="<?php echo $img; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="issueDate">Date of Issue</label>
                    <input type="text" class="form-control datepicker" name="issueDate" value="<?php echo $issueDate;?>" id="issueDate" placeholder="DD/MM/YYYY">
                </div>
            </div>
        </fieldset>
        <button type="submit" name="first" class="btn btn-default">Submit</button>
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
            dateFormat: 'dd-mm-yy'
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
			 var id_val=$(this).val();
               /* if(id=='vivaVoce')
                {
                    var viva_val=$(this).val();
                    var id_val=(viva_val/50)*100;
                }
                else
                {
                    var id_val=$(this).val();
                }  */

                if(id_val>=5)
                    {
                        var LG='A+';
                        var GP=5;
                    }
                    else if(id_val<=4.99&&id_val>=4)
                    {
                        var LG='A';
                        var GP=4;
                    }
                    else if(id_val<=3.99&&id_val>=3.5)
                    {
                        var LG='B+';
                        var GP=3.5;
                    }
                    else if(id_val<=3.49&&id_val>=3)
                    {
                        var LG='B';
                        var GP=3;
                    }
                    else if(id_val<=2.99&&id_val>=2.5)
                    {
                        var LG='C+';
                        var GP=2.5;
                    }
                    else if(id_val<=2.49&&id_val>=2)
                    {
                        var LG='C';
                        var GP=2;
                    }
                    else if(id_val<=1.99&&id_val>=0)
                    {
                        var LG='D';
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
                    var total_final_GP=(total_GP/exam_basic);
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
                        var LG='D';
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


</body>
</html>
<?php
}
else
{
    echo '<script>location.replace("index.php")</script>';
}
?>