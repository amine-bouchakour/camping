<!DOCTYPE html>
<html>
	<head>
		<title>Header</title>
	</head>
	<body>
		<main>
			<div id="titreIndex"><h1>Le Camping des Happy Sardines</h1></div>
		</main>

	</body>
</html>

<?php

	session_start();

	if(isset($_SESSION['login']))
	{ ?>
		<div class="statutUser">
			<!-- <a href="reservations.php">Réservations</a><br> -->
			<a href="index.php?pg=1">Page principale</a><br>
			<a href="planning.php">Planning</a><br>
			<a href="profil.php">Profil</a><br>
			<a href="deconnexion">Déconnexion</a><br>

		<?php

		if($_SESSION['login'] == 'admin')
		{ ?>
				<a href="admin.php">Page admin</a><br><?php }
		}
		else
		{ ?>
			<div class="statutUser">
				<a href="connexion.php">Connexion</a><br>
				<a href="inscription.php">Inscription</a><br>
			</div>
			
		<?php 
		}
?>

		</div><?php

?>

