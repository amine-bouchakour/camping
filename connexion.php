<html>

	<head>
		<title>Connexion</title>
		<link rel="stylesheet" type="text/css" href="camping.css">

	</head>
	<body>
		<main>
			<div>
	 			<?php include('header.php'); ?>
	 		</div>
	 		<div id="fullFormConnexion">
	 			<div id="titreConnexion">CONNEXION</div>
	 			<div id="formConnexion">
	 				<form action="" method="post"><br />

		 				Login : <br /><input type="text" name="login"><br />
		 				Password : <br /><input type="password" name="password"><br />
	 				
	 				</form>
	 			</div>
	 			<div id="buttonConnexion">
	 				<input type="submit" name="valider">
	 			</div>
	 			
	 		</div>
			


			<?php

			include('fonctions.php');
			connexion();
			?>
		</main>
		
	</body>


	

 









</html>