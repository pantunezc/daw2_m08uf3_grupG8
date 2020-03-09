<?php

if(isset($_POST['uid']) && ($_POST['ou'])){
	$ldaphost = "ldap://172.20.19.55";
	$ldappass = "fjeclot";
	$ldapadmin= "cn=admin,dc=fjeclot,dc=net"; 

	$ldapconn = ldap_connect($ldaphost) or die(header('errorEliminarUsuari.html'));

	ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

	if ($ldapconn) {

		$ldapbind = ldap_bind($ldapconn, $ldapadmin, $ldappass);

		if($ldapbind) {
			
			 //S'esborra l'usuari amb l'identficador i l'unitat organitzativa passades per parametre al formulari.
			 $data = ldap_delete($ldapconn, "uid=".trim($_POST['uid']).",ou=".trim($_POST['ou']).", dc=fjeclot, dc=net");
			
				if($data) {
					
					header('Location: usuariEsborrat.html');
					
				} else {
					
					header('Location: errorEliminarUsuari.html'); 
				}
				
			 ldap_close($ldapconn);
			 
		} else {
			
			header('Location: errorEliminarUsuari.html'); 
			
		}

	}

}
?>
