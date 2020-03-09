<?php

if(isset($_POST['uid']) && ($_POST['ou']) && ($_POST['option'])){
	$ldaphost = "ldap://172.20.19.55";
	$ldappass = "fjeclot";
	$ldapadmin= "cn=admin,dc=fjeclot,dc=net"; 

	$ldapconn = ldap_connect($ldaphost) or die(header('Location: errorModificarUsuari.html'));

	ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

	if ($ldapconn) {

		$ldapbind = ldap_bind($ldapconn, $ldapadmin, $ldappass);

		if($ldapbind) {
			//Es guarda a $values si s'ha escollit cambiar el uid o el gid
			$value = trim($_POST['option']);
			
			//S'ha escollit uid
			if ($value == "uidOption"){
				//es guarda el valor introduit al formulari
				$uid=trim($_POST['valor']);
				$info["uidnumber"] = $uid;
				$dn = "uid=".trim($_POST['uid']).",ou=".trim($_POST['ou']).",dc=fjeclot,dc=net";
				//es modifiquen les dades
				$newData = ldap_modify($ldapconn, "$dn", $info);
			} else {
				//S'ha escollit gid
				if ($value == "gidOption"){
				//es guarda el valor introduit al formulari
				$gid=trim($_POST['valor']);
				$info["gidnumber"] = $gid;
				$dn = "uid=".trim($_POST['uid']).",ou=".trim($_POST['ou']).",dc=fjeclot,dc=net";
				//es modifiquen les dades
				$newData = ldap_modify($ldapconn, "$dn", $info);
				}
			}
			
			if($newData) {
				
					header('Location: usuariModificat.html'); 
					
					}
				
				else {
					
					header('Location: errorModificarUsuari.html'); 
				}
				
			 ldap_close($ldapconn);
			 
		} else {
			
			header('Location: errorModificarUsuari.html'); 
			
		}

	}

}
?>
