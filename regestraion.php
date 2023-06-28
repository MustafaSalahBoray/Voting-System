


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="Library/css/bootstrap.min.css">
	<script type="text/javascript" src="Library/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="Library/js/jquery-3.6.1.min.js"></script>
	<title>Voting System</title>
</head>
<body class="bg-dark" >
	<h1 class="text-center text-info">Voting Syetem </h1>
	<div class="bg-info by-4">
		<h5 class="text-center ">Rigester Account </h5>
		<div class="container text-center">
			<form method="POST" enctype="multipart/form-data">
				<div class="mb-3">
					<input type="text" placeholder="Enter Your Name.........."name="Name" class="form-control w-50 m-auto">
				</div>
				<div class="mb-3">
					<input type="text" placeholder="Enter Your Mobile.........."name="mobile" class="form-control w-50 m-auto" maxlength="11" minlength="11">
				</div>
				<div class="mb-3">
					<input type="file" name="file" class="form-control w-50 m-auto">
				</div>
				<div class="mb-3">
					<input type="password" placeholder="Enter Your Password.........."name="password" class="form-control w-50 m-auto">
				</div>
				<div class="mb-3">
					<input type="password" placeholder="Confirm Your Password.........."name="cpassword" class="form-control w-50 m-auto">
				</div>
				<div class="mb-3">
					<select name="std" class="form-select w-50 m-auto">
						 <option value="group">Group</option>
						 <option value="Voter"> Voter</option>
					</select>
				</div>
				<button type="submit" class="btn btn-dark text-center my-4 " name="submit">register</button>
				<p>Arleady has accout <a href="index.php"class="text-white">Login Here</a></p>
			</form>
		</div>
	</div>

</body>
</html>
<?php 
  require 'DB.php';
if (isset($_POST['submit'])) {
    $Name=$_POST['Name'];
     $mobile=$_POST['mobile'];
        $password=$_POST['password'];
         $cpassword=$_POST['cpassword'];
     $file=$_FILES['file']['name'];
     $tmp_file=$_FILES['file']['tmp_name'];
        $std=$_POST['std'];
      move_uploaded_file($tmp_file, "img/$file"); 
      
      $insert=$db->prepare("INSERT INTO user (Name,Email,password,image,stutus,standerd,votes) VALUES(:name,:mobile,:password,:image,0,:std,0)");
      $insert->bindparam("name",$Name);
      $insert->bindparam("mobile",$mobile);
      $insert->bindparam("password",$password);
      $insert->bindparam("image", $file);
      $insert->bindparam("std",$std);
      if ($insert->execute()) {
      	echo "<script> alert('Success');</script>";
         }
      
}

?>











