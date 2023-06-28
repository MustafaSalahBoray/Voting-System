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
		<h5 class="text-center ">Login</h5>
		<div class="container text-center">
			<form method="POST">
				<div class="mb-3">
					<input type="text" placeholder="Enter Your Name.........."name="Name" class="form-control w-50 m-auto">
				</div>
				<div class="mb-3">
					<input type="text" placeholder="Enter Your Mobile.........."name="mobile" class="form-control w-50 m-auto" maxlength="11" minlength="11">
				</div>
				<div class="mb-3">
					<input type="password" placeholder="Enter Your Password.........."name="password" class="form-control w-50 m-auto">
				</div>
				<div class="mb-3">
					<select name="std" class="form-select w-50 m-auto">
						 <option value="Group">Group</option>
						 <option value="Voter"> Voter</option>
					</select>
				</div>
				<button type="submit" class="btn btn-dark text-center my-4 "name="submit">Login</button>
				<p>Dont Have An Account <a href="regestraion.php"class="text-white">Rigester Here</a></p>
			</form>
		</div>
	</div>

</body>
</html>
<?php 
	session_start();
  require 'DB.php';
if (isset($_POST['submit'])) {
    $Name=$_POST['Name'];
     $mobile=$_POST['mobile'];
        $password=$_POST['password'];
      //  $std=$_POST['std'];
         $show=$db->prepare("SELECT * FROM user WHERE Name=:Name AND Email=:mobile And password=:password");
         $show->bindparam("Name",$Name);
         $show->bindparam("mobile",$mobile);
         $show->bindparam("password",$_POST['password']);
        
         $show->execute();
         if ($show->rowcount()==1) {
           $user=$show->fetchObject();
         
           if ($user->stutus==="0") {
           

           	$_SESSION['user']=$user;
           	header("location:http://localhost/Voting%20System/Dashboard.php");
           }
           
         }
       $groups=$db->prepare("SELECT Name,Email,password,image,id,votes  FROM user WHERE standerd='Group'");
       $groups->execute();
       $groups=$groups->fetchAll(PDO::FETCH_ASSOC);
       $_SESSION['groups']=$groups;
 }

?>
