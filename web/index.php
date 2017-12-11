<html>
	<head>
		<title>Pizzerie di Bergamo</title>
		<link rel="stylesheet" type="text/css" href="pizzastyle.css">
	</head>
	<body>
	<?php
		$n=20;
		$citta="bergamo";
		$richiesta="pizzeria";
		$indirizzo_pagina="https://api.foursquare.com/v2/venues/search?v=20161016&query=$richiesta&nit=$n&intent=checkin&client_id=XTT32MSNDEPOVNS4SCCQEEHT4JJXB3P12AXWR50GNM4KUN1Q&client_secret=FIWH4MQRDDMZH4ZDWFD2XXAEXXTJXMN1SMMFRARQAKBX2L5N&near=$citta";
		$chiamata = curl_init() or die(curl_error());
		curl_setopt($chiamata, CURLOPT_URL,$indirizzo_pagina);
		curl_setopt($chiamata, CURLOPT_RETURNTRANSFER, 1);
		$json=curl_exec($chiamata) or die(curl_error());
		$data = json_decode($json);
		echo("<h1>PIZZERIE A BERGAMO</h1>");
		echo("<table>");
		echo("<tr>");
		echo("<th>PIZZERIA</th>");
		echo("<th>LATITUDINE</th>");
		echo("<th>LONGITUDINE</th>");
		echo("</tr>");
		for($i=0; $i<$n; $i++){	
			echo("<tr>");
			echo("<td>");
			echo $data->response->venues[$i]->name;
			echo("</td>");
			echo("<td>");
			echo $data->response->venues[$i]->location->lat;
			echo("</td>");
			echo("<td>");
			echo $data->response->venues[$i]->location->lng;
			echo("</td>");
			echo("</tr>");
		}
		echo("</table>");
		echo curl_error($chiamata);
		curl_close($chiamata);
	?>
	</body>
</html>
