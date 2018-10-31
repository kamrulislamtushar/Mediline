<?php include '../connect.php';
session_start();
if($_SESSION['sbttc_basic_uid']!='')
{
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $res=mysql_query("SELECT img FROM basic WHERE id='$id'");
    $row=mysql_fetch_array($res);
    $result=mysql_query("delete from mark where u_id='$id';") or die(mysql_error());
    $result1=mysql_query("delete from basic where basic.id='$id';") or die(mysql_error());
    unlink("img/basic/".$row['img']);

}
if(isset($_GET['jid']))
{
    $id=$_GET['jid'];
    $res=mysql_query("SELECT img FROM job_test WHERE id='$id'");
    $row=mysql_fetch_array($res);
    $result=mysql_query("delete from mark_job where u_id='$id';") or die(mysql_error());
    $result1=mysql_query("delete from job_test where job_test.id='$id';") or die(mysql_error());
    unlink("img/job/".$row['img']);

}




?>

<?php include 'header.php';?>
		
		<!-- Result start here -->
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
		
		<section id="viewTradeResult">
			<div class="container">
				<div class="rows">
					<div id="tabs">
						<ul>
							<li><a href="#tabs-1">Basic Certificate</a></li>
							<li><a href="#tabs-2">Job Test Certificate</a></li>
						</ul>
						<div id="tabs-1">
							<table class="table">
								<thead>
									<tr>
										<td>SL No</td>
										<td>ID No</td>
										<td>Name</td>
										<td>GPA</td>
										<td>Obtain Grade</td>
										<td>View</td>
										<td>Edit</td>
										<td>Delete</td>
									</tr>
								</thead>
								<tbody>
                                <?php
                                $result=mysql_query("select *  from mark,basic where basic.id=mark.u_id  order by basic.id desc") or die(mysql_error());
                                $rows1=mysql_num_rows($result);
                                if($rows1>0) {
                                    while ($engData = mysql_fetch_array($result)) {
                                        print '<tr>
                                                        <td>'.$engData['id'].'</td>
                                                        <td>'.$engData['idNo'].'</td>
                                                        <td>'.$engData['traineeName'].'</td>
                                                        <td>'.$engData['GP'].'</td>
                                                        <td>'.$engData['grade'].'</td>
                                                        <td><a href="show-result-basic.php?id='.$engData['id'].'"><i class="fa fa-eye"></i></a></td>
                                                        <td><a href="result-edit-basic.php?id='.$engData['id'].'"><i class="fa fa-pencil-square-o"></i></a></td>
                                                        <td><a href="view-results.php?id='.$engData['id'].'""><i class="fa fa-trash"></i></a></td>
                                                    </tr>';
                                    }
                                }

                                ?>

								</tbody>
							</table>
							<nav>
								<ul class="pager">
									<li><a href="#">Previous</a></li>
									<li><a href="#">Next</a></li>
								</ul>
							</nav>
						</div>
						<div id="tabs-2">
							<table class="table">
								<thead>

									<tr>
										<td>SL No</td>
										<td>Reference No</td>
										<td>Passport No</td>
										<td>Name</td>
										<td>Obtain Grade</td>
										<td>Comments</td>
										<td>View</td>
										<td>Edit</td>
										<td>Delete</td>
									</tr>
								</thead>
								<tbody>
                                <?php
                                $result=mysql_query("select job_test.id,regerenceNoJob,passportNoJob,traineeNameJob,eaverageJob,ecommentsJob from job_test,mark_job where job_test.id=mark_job.u_id  order by job_test.id desc") or die(mysql_error());
                                $rows1=mysql_num_rows($result);
                                if($rows1>0) {
                                    while ($engData = mysql_fetch_array($result)) {
                                        print '<tr>
                                                        <td>'.$engData['id'].'</td>
                                                        <td>'.$engData['regerenceNoJob'].'</td>
                                                        <td>'.$engData['passportNoJob'].'</td>
                                                        <td>'.$engData['traineeNameJob'].'</td>
                                                        <td>'.$engData['eaverageJob'].'</td>
                                                        <td>'.$engData['ecommentsJob'].'</td>
                                                        <td><a href="show-result-job.php?id='.$engData['id'].'"><i class="fa fa-eye"></i></a></td>
                                                        <td><a href="result-edit-job.php?jid='.$engData['id'].'"><i class="fa fa-pencil-square-o"></i></a></td>
                                                        <td><a href="view-results.php?jid='.$engData['id'].'"><i class="fa fa-trash"></i></a></td>
                                                    </tr>';
                                    }
                                }

                                ?>

								</tbody>
							</table>
							<nav>
								<ul class="pager">
									<li><a href="#">Previous</a></li>
									<li><a href="#">Next</a></li>
								</ul>
							</nav>
						</div>
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
				$( ".datepicker" ).datepicker();
			});
			
			//tab menus
			$(function() {
				$( "#tabs" ).tabs();
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