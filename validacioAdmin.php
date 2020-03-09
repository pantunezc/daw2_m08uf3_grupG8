<?php
session_start();
if(isset($_POST['password'])){

	$ldaphost = "ldap://172.20.19.55";
	$ldappass = trim($_POST['password']); 
	$ldapadmin= "cn=admin,dc=fjeclot,dc=net";
	
	//Es comproba si es pot establir la connexió
	$ldapconn = ldap_connect($ldaphost) or die(header('Location: errorValidacioAdmin.php'));
	
	//Especifica la versió del protocol ldap amb la qual es vol treballar
	ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
	
	if ($ldapconn) {
		
		//autentifica el directori ldap amb l'usuari i la password.
		$ldapbind = ldap_bind($ldapconn, $ldapadmin, $ldappass);
		
		if ($ldapbind) {
			
			echo header('Location: opcionsAdmin.html');
		
		} else {
		
			header('Location: errorValidacioAdmin.php'); 
		
		}	
	
	}

}
?>
