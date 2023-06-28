
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="Library/css/bootstrap.min.css">
	<script type="text/javascript" src="Library/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="Library/js/jquery-3.6.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Voting System</title>
</head>
<body class="bg-secondary text-light" >
	<div class="container my-5 text-light">
	      <a href="index.php"><button class="btn btn-dark text-light px-3">Back</button></a>
	       <a href="logout.php"><button class="btn btn-dark text-light px-3">Logout</button></a>
	       <h1 class="my-3">Voting System</h1>
	       <div class="row my-5">
	       	  <div class="col-md-7">
	       	  	  <!-- Groups -->
	       	  	  <?php 
                     session_start();
                  
                     if (isset($_SESSION['groups'])) {
                       $groups=$_SESSION['groups'];
                       for ($i=0; $i <count($groups) ; $i++) { 
                         

	       	  	  	 
	       	  	  ?>
                    <div class="row">
	       	  	   	    <div class="col-md-4">
	       	  	   	    	<img src="img/<?php echo $groups[$i]['image']?>" alt="imag1">
	       	  	   	    </div>
	       	  	   	     <div class="col-md-8">
	       	  	   	    	 <strong class="text-dark h5">Group Name:</strong> 
                                     <?php echo $groups[$i]['Name']?>
	       	  	   	    	 <br>
	       	  	   	    	  <strong class="text-dark h5">Votes:</strong>
	       	  	   	    	     <?php echo $groups[$i]['votes']?> <br>
	       	  	   	    </div>
	       	  	   </div>
	       	  	 
	       	  	  	  <form method="POST">
	       	  	 	<input type="hidden" name="Groupvotes" value="<?php  echo $groups[$i]['votes']?>" >
	       	  	 	<input type="hidden" name="Groupid" value="<?php  echo $groups[$i]['id']?>" >
	       	  	 	<?php  

 	                       if (isset($_SESSION['user'])) {
 	                       	   if ($_SESSION['user']->stutus==1) {
 	                       	   	 echo  '<button class="bg-success text-white my-5 px-3 ">voted</button>';
 	                       	   }
 	                       	   else{
 	                       	         echo '<button class="bg-danger text-white my-5 px-3 " type="submit" Name="voteedd">Voted</button>';
 	                       	   }}
	       	  	 	?>
	       	  	 	  	 <hr class="text-light">   
	       	  	 </form>
	       	  	 <?php 
                       }
                     }?>
	       	  </div>
	       	  <div class="col-md-5">
	                  <?php 
                         
 	                       if (isset($_SESSION['user'])) {
 	                       	   if ($_SESSION['user']->stutus==1) {
 	                       	   	 $stu ='<b class="text-success">voted</b>';
 	                       	   }
 	                       	   else{
 	                       	   	$stu ='<b class="text-danger">Not Voted</b>';
 	                       	   }
 	                       	echo ' 	<img src="img/'.$_SESSION['user']->image.'" alt="imag1"><br><br>
	       	  	                 <strong class="text-dark h5">Name</strong> 
	       	  	                  '.$_SESSION['user']->Name.'<br><br>
	       	  	                  <strong class="text-dark h5">Mobile:</strong>
	       	  	                   '.$_SESSION['user']->Email.' <br><br>
	       	  	                <strong class="text-dark h5">Stutus:</strong> 
	       	  	                 '.$stu.'<br><br>';
 	                       }
 
	       	  	   	  ?>
	       	  </div>
	       
	       </div>
	</div>
	
               	 

</body>
</html>
<?php  
require 'DB.php';
     if (isset($_POST['voteedd'])) {
      $totalVote=$_POST['Groupvotes']+1;
      $gid=$_POST['Groupid'];
      $uid=$_SESSION['user']->id;
      $updateVote=$db->prepare("UPDATE user SET votes=:vote WHERE id =:id");
      $updateVote->bindparam("vote",$totalVote);
      $updateVote->bindparam("id",$gid);
      $updateStut=$db->prepare("UPDATE user SET stutus =1  WHERE id=:ids ");
      $updateStut->bindparam("ids",$uid);
      if ($updateVote->execute()&&$updateStut->execute()) {
                $groups=$db->prepare("SELECT Name,Email,image,id,votes  FROM user WHERE standerd='Group'");
                  $groups->execute();
     			 $groups=$groups->fetchAll(PDO::FETCH_ASSOC);
    		     $_SESSION['groups']=$groups;
    		     $_SESSION['user']->stutus=1;
    		  	echo "<script> alert('Voting Sucess');</script>";
      }
      else{
      	echo "<script> alert('Technical error');</script>";
      }
     }


?>