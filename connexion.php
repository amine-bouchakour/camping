<html>

	<head>
		<title>Connexion</title>
		<link rel="stylesheet" type="text/css" href="camping.css">

	</head>
	<body = id="bodyconnexion">
		<?php include('header.php'); ?>
		<main>
			
	 		<div id="fullFormConnexion">
	 			<div id="titreConnexion">CONNEXION</div><br />
	 			<div id="formConnexion">
	 				<form action="" method="post"><br />

		 				Login : <br /><input type="text" name="login"><br />
		 				Password : <br /><input type="password" name="password"><br />
	 				
                    </div>
                    <div id="buttonConnexion">
                        <input type="submit" name="valider">
                    </div>
                </form>
	 			
	 		</div>
			


			<?php

			include('fonctions.php');
			connexion();
			?>
		</main>
		
	</body>


	

 









</html>