<html>

	<head>
		<title>Page principale</title>
		<link rel="stylesheet" type="text/css" href="camping.css">
	</head>
	<body id="bodyindex">
		<?php include('header.php'); ?>
		<main id="mainindex">
	 		
	 		


	 		<table class="tableindex">
	 			<tr >
	 				<td></td>
	 				<td >La Plage</td>
	 				<td>Les Pins</td>
	 				<td>Le Maquis</td>
	 			</tr>
	 			<tr>
	 				<td>Camping-car</td>
	 				<td class="tableindex"><a href="reservations.php?emplacement=plage&amp;habitat=cpgcar">Réserver</a></td>
	 				<td class="tableindex"><a href="reservations.php?emplacement=pins&amp;habitat=cpgcar">Réserver</a></td>
	 				<td class="tableindex"><a href="reservations.php?emplacement=maquis&amp;habitat=cpgcar">Réserver</a></td>

	 			</tr>
	 			<tr>
	 				<td>Tente</td>
	 				<td class="tableindex"><a href="reservations.php?emplacement=plage&amp;habitat=tente">Réserver</a></td>
	 				<td class="tableindex"><a href="reservations.php?emplacement=pins&amp;habitat=tente">Réserver</a></td>
	 				<td class="tableindex"><a href="reservations.php?emplacement=maquis&amp;habitat=tente">Réserver</a></td>
	 			</tr>
	 		</table>



			<?php include('footer.php'); ?>
		</main>
	</body>


</html>