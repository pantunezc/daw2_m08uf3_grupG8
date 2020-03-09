
<?php

if(isset($_POST['uid'])){
	$ldaphost = "ldap://172.20.19.55";
	$ldappass = "fjeclot";
	$ldapadmin= "cn=admin,dc=fjeclot,dc=net"; 

	$ldapconn = ldap_connect($ldaphost) or die(header('Location: errorMostrarDades.html'));

	ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

	if ($ldapconn) {

		$ldapbind = ldap_bind($ldapconn, $ldapadmin, $ldappass);

		if($ldapbind) {
			
			//Es guarda l'identificador d'usuari passat pel formulari a la variable user.
			$user=trim($_POST['uid']);
			//Es busca l'usuari amb aquest uid. 
			$search = ldap_search($ldapconn, "dc=fjeclot, dc=net","uid=".$user);
			
				if($search) {
					
					//s'obtenen els resultats de la búsqueda.
					$info = ldap_get_entries($ldapconn, $search);
					
					//Si no hi ha, redirecciona cap a la pàgina d'error.
					if($info['count']==0){
						
					header('Location: errorMostrarDades.html'); 
					
					//Si si hi ha, es mostren
					}else{
						
						for ($j=0; $j<$info["count"]; $j++){
							echo "<div class='ml-3 pt-4'>";
							echo "<b>Dades de l'usuari dn: ".$info[$j]["dn"]. "</b><br>";
							echo "Identificador de l'usuari: ".$info[$j]["uid"][0]. "<br>";
							echo "Nom complet: ".$info[$j]["cn"][0]. "<br>";
							echo "Cognom: ".$info[$j]["sn"][0]. "<br>";
							echo "Nom de l'usuari: ".$info[$j]["givenname"][0]. "<br>";
							echo "Títol: ".$info[$j]["title"][0]. "<br>";
							echo "Número de telèfon: ".$info[$j]["telephonenumber"][0]. "<br>";
							echo "Mòvil: ".$info[$j]["mobile"][0]. "<br>";
							echo "Adreça postal: ".$info[$j]["postaladdress"][0]. "<br>";
							echo "Descripició: ".$info[$j]["description"][0]. "<br>";
							echo "GidNumber: ".$info[$j]["gidnumber"][0]. "<br>";
							echo "UidNumber: ".$info[$j]["uidnumber"][0]. "<br>";
							echo "Home Directory: ".$info[$j]["homedirectory"][0]. "<br>";
							echo "Shell de l'usuari: ".$info[$j]["loginshell"][0]. "<br><br>";
							echo "</div>";
						} 
					
				}	
				
			}
				
		} else {
			
		header('Location: errorMostrarDades.html'); 	
		
		}
		
	}	
}
?>

<html>
	<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Mostrar usuari</title>
	</head>
 <body>
		<a class="ml-3" href='opcionsAdmin.html'><button class="btn btn-danger">Tornar a les opcions d'administració</button></a>
  </body>
</html>










