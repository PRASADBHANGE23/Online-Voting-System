<?php
session_start();
if (!isset($_SESSION['userdata'])) {
	header("location: ../");
}

$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupsdata'];

if ($_SESSION['userdata']['status'] == 0) {
	$status = '<b style="color:red">Not Voted</b>';
}
else {
	$status = '<b style="color:green">Voted</b>';
}
?>
<html>
<head>
	<title>Dashboard | Online Voting System</title>
	<!--<link rel="stylesheet" href="../css/stylesheet.css">-->
</head>
<body style="background-image: url('loginbg.jpg'); background-size: cover; background-repeat: no-repeat;background-attachment: fixed;">
	<style type="text/css">
	@import url('https://fonts.googleapis.com/css2?family=Lobster&family=MonteCarlo&family=Playfair+Display&family=Style+Script&display=swap');
	@import url('https://fonts.googleapis.com/css2?family=BioRhyme:wght@300&family=Cormorant+Garamond&family=Cormorant+Upright&display=swap');

	#backbtn{
	padding: 5px;
	border-radius: 5px;
	font-size: 15px;
	float: left;
	margin: 10px;
	font-family: "Playfair Display";
  background-color: #80007F;
  color: white;
  width: 80px;
  height: 40px;
  font-weight:bold;
	border: solid black;
	}

	#head{
	  color: white;
	  text-align: center;
	  text-shadow: 2px 2px 5px red;
	  font-family: "Lobster";
	  font-size: 35px;
	}

	#head:hover{
	  color: #FF00FF;
	}

	#logoutbtn{
	font-family: "Playfair Display";
  background-color: #80007F;
	padding: 5px;
	border-radius: 5px;
	color: white;
	width: 80px;
	height: 40px;
	font-size: 15px;
	float: right;
	margin: 10px;
	border: solid black;
	font-weight:bold;
 }

 #logoutbtn:hover, #backbtn:hover{
   /*background-color: #990099;*/
	 background-color: rgb(128,0,127, 0.8);
 }

  #Profile{
  font-family: "Playfair Display";
	background-color: rgba(255,255,255, 0.7);
	width:30%;
	padding: 20px;
	font-weight:bold;
	border-radius: 10px;
	text-align: center;
	float: left;
	color:#8B008B;
	margin-top: 60px;
	position: fixed;
 }

 #Group{
 background-color: rgba(255,255,255, 0.7);
 width:60%;
 font-family: "Playfair Display";
 color: #8B008B;
 font-weight:bold;
 padding: 20px;
 float:right;
 border-radius: 10px;
 }

 #votebtn{
	 font-family: "Playfair Display";
  padding: 5px;
  border-radius: 5px;
  background-color: red;
  color: white;
  width: 70px;
  height: 35px;
  font-size: 15px;
	font-weight:bold;
 }

 #votebtn:hover{
 	background-color: rgb(255, 0, 0, 0.5);
 }

 #mainpanel{
 padding: 10px;
 }

 #voted{
 	font-family: "Playfair Display";
 padding: 5px;
 border-radius: 5px;
 /*box-shadow:5px 0.5px;*/
 background-color: green;
 color: white;
 width: 70px;
 height: 35px;
 font-size: 15px;
 font-weight:bold;
 }

 #voted:hover{
 	background-color: rgb(0, 128, 0, 0.5)
 }

</style>
	<div id="mainSection">
		<center>
		<div id="headerSection">
			<a href="../"><button id="backbtn">Back</button></a>
			<a href="logout.php"><button id="logoutbtn">Logout</button></a>
			<h1 id="head">Online Voting System</h1>
    	</div>
    	</center>
		<hr>
	<div id="mainpanel">
		<div id="Profile">
			<center><img src="../uploads/<?php echo $userdata['photo'] ?>" height="100" width="100"></center> <br><br>
				<b>Name: </b><?php echo $userdata['name'] ?><br><br>
				<b>Mobile: </b><?php echo $userdata['mobile'] ?><br><br>
				<b>Address: </b><?php echo $userdata['address'] ?><br><br>
				<b>Status: </b><?php echo $userdata['status'] ?><br><br>
		</div>
		<div id="Group">
			<?php
				if ($_SESSION['groupsdata']) {
					for ($i = 0; $i < count($groupsdata); $i++) {
				?>
						<div>
							<img style="float:right" src="../uploads/<?php echo $groupsdata[$i]['photo'] ?>"height="100" width="100">
							 <br><br>
							<b>Group Name: </b><?php echo $groupsdata[$i]['name'] ?><br><br>
							<b>Votes: </b><?php echo $groupsdata[$i]['votes']?><br><br>
							<form action="../api/vote.php" method="POST">
								<input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes'] ?>">
								<input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id'] ?>">
								<?php
									if ($_SESSION['userdata']['status']==0) {
										?>
										<input type="submit" name="votebtn" value="Vote" id="votebtn">
										<?php
									}else {
										?>
										<button disabled type="button" name="votebtn" value="Vote" id="voted">Voted</button>
										<?php
									}
								 ?>
							</form>
						</div>
					<hr>
					<?php
				}
			}
					else{
				}
				?>
			</div>
	</div>
	</div>
</body>
</html>
