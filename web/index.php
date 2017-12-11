<html>
	<head>
		<title>Pizzerie di Bergamo</title>
		<link rel="stylesheet" type="text/css" href="toptenstyle.css">
	</head>
	<body>
	<?php
		$n=20;
		$citta="bergamo";
		$richiesta="pizzeria";
		# questo script chiama un'API e la inserisce in una tabella 
		# Indirizzo dell'API da richiedere
		$indirizzo_pagina="https://api.foursquare.com/v2/venues/search?v=20161016&query=$richiesta&nit=$n&intent=checkin&client_id=XTT32MSNDEPOVNS4SCCQEEHT4JJXB3P12AXWR50GNM4KUN1Q&client_secret=FIWH4MQRDDMZH4ZDWFD2XXAEXXTJXMN1SMMFRARQAKBX2L5N&near=$citta";
		# Codice di utilizzo di cURL
		# chiamataiama l'API e la immagazzina in $json
		$chiamata = curl_init() or die(curl_error());
		curl_setopt($chiamata, CURLOPT_URL,$indirizzo_pagina);
		curl_setopt($chiamata, CURLOPT_RETURNTRANSFER, 1);
		$json=curl_exec($chiamata) or die(curl_error());
		# Decodifico la stringa json e la salvo nella variabile $data
		$data = json_decode($json);
		# Stampa della tabella delle pizzerie.
		echo "<table>";
			echo "<tr>";
				echo "<th>PIZZERIA</th>";
				echo "<th>LATITUDINE</th>";
				echo "<th>LONGITUDINE</th>";
			echo "</tr>";
			for($i=0; $i<$n; $i++)
			{	
				echo "<tr>";
					echo "<td>";
					echo $data->response->venues[$i]->name;
					echo "</td>";
					echo "<td>";
					echo $data->response->venues[$i]->location->lat;
					echo "</td>";
					echo "<td>";
					echo $data->response->venues[$i]->location->lng;
					echo "</td>";
				echo "</tr>";
			}
		echo "</table>";
		# Stampa di eventuali errori
		echo curl_error($chiamata);
		curl_close($chiamata);

	/*	echo "<form id='forma' method='post' onsubmit='return controllo_campi();'><br/>";
		echo "<table>";
		echo "<tr>";
		echo " <td>Numero elementi (1-50): </td><td><input type='text' value='$n' name='n' id='n' /></td>";
		echo "</tr>";
		echo "<tr>";
		echo " <td>citta: </td><td><input type='text' value='$citta' name='citta' id='citta' /></td>";
		echo "</tr>";
		echo "<tr>";
		echo " <td>Cosa stai cercando?: </td><td><input type='text' value='$richiamataiesta' name='richiamataiesta' id='richiamataiesta' /></td><br/>";
		echo "</tr>";
		echo "</table>";
		echo " <input type='submit' value='Aggiorna tabella' class='btn'/>";
		echo "</form>";*/
	?>
	</body>
</html>
