<?php
$search = $_POST['search'];


$dsn = "mysql:host=localhost;dbname=mcphesto_iloveyou;charset=utf8mb4";
$dbusername = "mcphesto_imm";
$dbpassword = "nhXZ9reEzWuQ";

$pdo = new PDO($dsn, $dbusername, $dbpassword);


//	$stmt1 = $pdo->prepare("SELECT * FROM `chefs` WHERE `userID` = $id");
	$stmt = $pdo->prepare("SELECT * FROM `letters` WHERE `name` LIKE '%$search%'");
  $stmt2 = $pdo->prepare("SELECT COUNT(`name`) FROM `letters` WHERE `name` LIKE '%$search%'");
  $stmt3 = $pdo->prepare("SELECT * FROM `letters` WHERE `name` LIKE '%$search%'");

  $stmt->execute();
  $stmt2->execute();
  $stmt3->execute();

	$stmt4 = $pdo->prepare("SELECT COUNT(`name`) FROM `letters` WHERE `name` LIKE '%$search%'");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>search page</title>
	<link rel="icon" href="image/favicon.ico" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" media="screen and (max-width: 640px)" href="css/small.css" />
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>

<body>
	<header>
		<nav  class="navbar navbar-light ">
  		<a class="navbar-brand" href="write.php">
  			<img src="image/titlewithe.png" width="70" height="40" alt="I really love you">
  		</a>
		<ul class="nav justify-content-end">
			<li  class="nav-item"><a class="nav-link btn btn-outline-primary" href="write.php">Write</a></li>
			<li  class="nav-item"><a class="nav-link btn btn-outline-primary" href="wonder.php">I Wonder</a></li>
			<li  class="nav-item"><a class="nav-link btn btn-outline-primary" href="index.php">Fun Stuff</a></li>
		</ul>
		</nav>
		<img class="header-image"src="image/header.svg"  alt="header">
		<img class="love-image"src="image/titledark.png" width="50%" alt="love you">
	</header>

<div id="yearesult">


		<section>
		  <?php $count=$stmt2->fetch();
		   $name=$stmt->fetch(); ?>
			 <?php
			 if ($count[0]==0) {
			 	?><img class="yea" src="image/nah.svg" alt="nah" ><?php
			} else {
			 ?>
			 <img class="yea" src="image/yea.svg" alt="yes" >
		  <div id="textresult">There is/are <h3><?php echo($count[0]) ?></h3> love letter(s) for <h3><?php echo($name["name"]) ?></h3></div>
		</section>
	<?php } ?>

		<div id="letters">
		  <?php
		  while($row=$stmt3->fetch()) {
		  ?>
			<div class="letter">
				<p>Dear, <?php echo($row["name"]) ?></p>
			  <p><?php echo($row["content"]) ?></p>
				<p>From, <?php echo($row["fromName"]) ?></p>
				<div class="letter-stats">
					<input id="letterID" type="number" name="letterID" value="<?php echo($row["id"]) ?>" hidden=true>
					<input id="likes" type="number" name="likes" value="<?php echo($row["likes"]) ?>" hidden=true>
					<input id="poops" type="number" name="poops" value="<?php echo($row["poop"]) ?>" hidden=true>
					<p><img id="like"src="image/like1.svg" alt="like"> <?php echo($row["likes"]) ?></p>
					<p><img id="poop"src="image/poop1.svg" alt="poop"> <?php echo($row["poop"]) ?></p>
				</div>
			<?php } ?>
			</div>
		</div>
</div>
<script src="js/like.js" charset="utf-8"></script>
</body>
</html>
