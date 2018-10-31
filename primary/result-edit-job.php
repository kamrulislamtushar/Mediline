<?php
include '../connect.php';
include '../function.php';
session_start();
if($_SESSION['sbttc_basic_uid']!='')
{
date_default_timezone_set("Asia/Dhaka");
$current_date=date("YmdHis");
$id=$_GET['jid'];
if(isset($_POST['job_test'])) {
    $jobTest = $_POST['jobTest'];

    $dateOfExaminationJob = $_POST['dateOfExaminationJob'];
    $regerenceNoJob = $_POST['regerenceNoJob'];
    $traineeNameJob = $_POST['traineeNameJob'];
    $fatherNameJob = $_POST['fatherNameJob'];
    $passportNoJob = $_POST['passportNoJob'];

    $past_img = $_POST['past_img'];
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
    $POSTDATA['targetPath'] = $_SERVER["DOCUMENT_ROOT"] . "/SBTTC/primary/img/job/" . $current_date . $_FILES['filejob']['name'];
    //$POSTDATA['targetPath']= $_SERVER["DOCUMENT_ROOT"]."/img/basic/".$current_date.$_FILES['file']['name'];
    $passPort_exist = passport_exist_edit($id,$passportNoJob);
    $refer_exist = refer_exist_edit($id,$regerenceNoJob);
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
                $POSTDATA['targetPath'] = $_SERVER["DOCUMENT_ROOT"] . "/primary/img/job/" .$id.'.'.$file_ext;
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
                $result = mysql_query("update job_test set jobTest='$jobTest',dateOfExaminationJob='$dateOfExaminationJob',regerenceNoJob='$regerenceNoJob',
                traineeNameJob='$traineeNameJob',fatherNameJob='$fatherNameJob',passportNoJob='$passportNoJob',traineeAddressJob='$traineeAddressJob',issueDatejob='$issueDatejob',img='$img_final'
                where id='$id';") or die(mysql_error());

                $result1 = mysql_query("update mark_job set theoreticalJob='$theoreticalJob',practicalJob='$practicalJob',measurementJob='$measurementJob',
                drawingJob='$drawingJob',eaverageJob='$eaverageJob',ecommentsJob='$ecommentsJob'
                where u_id='$id';") or die(mysql_error());
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
if(isset($_GET['jid']))
{
    $id=$_GET['jid'];
    $result=mysql_query("select * from job_test where id='$id';") or die(mysql_error());
    $result1=mysql_query("select * from mark_job where u_id='$id';") or die(mysql_error());
    $rows1=mysql_num_rows($result);
    if($rows1>0) {

        $engdata=mysql_fetch_array($result);
        $engdata1=mysql_fetch_array($result1);
        $jobTest = $engdata['jobTest'];
        $img=$engdata['img'];
        echo '<script>alert("'.$engdata['img'].'");</script>';
        $dateOfExaminationJob = $engdata['dateOfExaminationJob'];
        $regerenceNoJob = $engdata['regerenceNoJob'];
        $traineeNameJob = $engdata['traineeNameJob'];
        $fatherNameJob = $engdata['fatherNameJob'];
        $passportNoJob = $engdata['passportNoJob'];
        $traineeAddressJob = $engdata['traineeAddressJob'];
        $issueDatejob = $engdata['issueDatejob'];
        $theoreticalJob = $engdata1['theoreticalJob'];
        $practicalJob = $engdata1['practicalJob'];
        $measurementJob = $engdata1['measurementJob'];
        $drawingJob = $engdata1['drawingJob'];
        $eaverageJob = $engdata1['eaverageJob'];
        $ecommentsJob = $engdata1['ecommentsJob'];

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

    <li><a href="#tabs-2">Job Test Certificate</a></li>
</ul>

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
                            if($jobTest==$eng['id'])
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
                <div class="form-group col-md-4">
                    <label for="dateOfExaminationJob">Date of Examination </label>
                    <input type="text" class="form-control datepicker" name="dateOfExaminationJob" value="<?php echo $dateOfExaminationJob;?>" id="dateOfExaminationJob" placeholder="MM/DD/YYYY">
                </div>
                <div class="form-group col-md-3">
                    <label for="regerenceNoJob">Reference No</label>
                    <input type="text" class="form-control" name="regerenceNoJob" value="<?php echo $regerenceNoJob;?>" id="regerenceNoJob" placeholder="Reference No">
                </div>
            </div>
        </fieldset>

        <fieldset>
            <p>Trainee's Information</p>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="traineeNameJob">Name of Trainee</label>
                    <input type="text" class="form-control" name="traineeNameJob" value="<?php echo $traineeNameJob;?>" id="traineeNameJob" placeholder="Trainee Name">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="fatherNameJob">Father's Name</label>
                    <input type="text" class="form-control" name="fatherNameJob" value="<?php echo $fatherNameJob;?>" id="fatherNameJob" placeholder="Father's Name">
                </div>
                <div class="form-group col-md-6">
                    <label for="passportNoJob">Passport No</label>
                    <input type="text" class="form-control" name="passportNoJob" value="<?php echo $passportNoJob;?>" id="passportNoJob" placeholder="Passport No">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="traineeAddressJob">Address</label>
                    <input type="text" class="form-control" name="traineeAddressJob" value="<?php echo $traineeAddressJob;?>" id="traineeAddressJob" placeholder="Trainee Address">
                </div>
            </div>
        </fieldset>

        <fieldset>
            <p>Mark Distribution</p>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="etheoreticalJob">Theoretical</label>
                    <label for="epracticalJob">Practical</label>
                    <label for="emeasurementJob">Measurement</label>
                    <label for="edrawingJob">Drawing</label>
                </div>
                <div class="form-group col-md-2">
                    <input type="text" class="form-control resultjob" name="theoreticalJob" value="<?php echo $theoreticalJob;?>" id="etheoreticalJob" placeholder="Acquired Number">
                    <input type="text" class="form-control resultjob" name="practicalJob" value="<?php echo $practicalJob;?>" id="epracticalJob" placeholder="Acquired Number">
                    <input type="text" class="form-control resultjob" name="measurementJob" value="<?php echo $measurementJob;?>" id="emeasurementJob" placeholder="Acquired Number">
                    <input type="text" class="form-control resultjob" name="drawingJob" value="<?php echo $drawingJob;?>" id="edrawingJob" placeholder="Acquired Number">
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
                    <textarea class="form-control text-center textareaJob" rows="1" name="eaverageJob" value="" id="eaverageJob" placeholder="Obtain Grade" readonly><?php echo $eaverageJob;?></textarea>
                </div>
                <div class="form-group col-md-2">
                    <textarea class="form-control text-center textareaJob" rows="1" name="ecommentsJob" value="" id="ecommentsJob" placeholder="Comments" readonly><?php echo $ecommentsJob;?></textarea>
                </div>
            </div>

        </fieldset>

        <fieldset>
            <p>More Inforamtion</p>
            <div class="row">
                <div class="form-group col-md-6">
                    <img src="img/job/<?php echo $img; ?>" alt="Trainees Picture" width="110">
                    <label for="uploadPictureJob">Upload Picture</label>
                    <input type="file" name="filejob" id="uploadPictureJob">Please upload .jpg, .png, .gif formated image.
                    <input type="hidden" name="past_img" value="<?php echo $img; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="issueDateJob">Date of Issue</label>
                    <input type="text" class="form-control datepicker" name="issueDatejob" value="<?php echo $issueDatejob;?>" id="issueDatejob" placeholder="MM/DD/YYYY">
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
    $('.resultjob').change(function()
    {
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


            total_GP=etheoreticalJobGP+epracticalJobGP+emeasurementJobGP+edrawingJobGP;
            var total_final_GP=(total_GP/4);
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