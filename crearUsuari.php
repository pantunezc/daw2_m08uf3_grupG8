
<?php

if(isset($_POST['uid']) && ($_POST['cn']) && ($_POST['sn']) && ($_POST['givenName']) && ($_POST['shell']) && ($_POST['directory']) && ($_POST['title']) && ($_POST['telephoneNumber']) && ($_POST['mobile']) && ($_POST['postalAddress']) && ($_POST['gidNumber']) && ($_POST['uidNumber']) && ($_POST['description']) && ($_POST['ou'])){

	$ldaphost = "ldap://172.20.19.55";
	$ldappass = "fjeclot";
	$ldapadmin= "cn=admin,dc=fjeclot,dc=net"; 

	$ldapconn = ldap_connect($ldaphost) or die(header('Location: errorCreacioUsuari.html'));

	ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

	if ($ldapconn) {

		$ldapbind = ldap_bind($ldapconn, $ldapadmin, $ldappass);

		if($ldapbind) {
			//Es guarden els valors introduits per l'usuari.
			$dn = "uid=".trim($_POST['uid']).",ou=".trim($_POST['ou']).",dc=fjeclot,dc=net";
			$info["objectclass"][0] = 'top';
			$info["objectclass"][1] = 'person';
			$info["objectclass"][2] = 'organizationalPerson';
			$info["objectclass"][3] = 'inetOrgPerson';
			$info["objectclass"][4] = 'posixAccount';
			$info["objectclass"][5] = 'shadowAccount';
			$info["uid"] = trim($_POST['uid']);
			$info["cn"] = trim($_POST['cn']);
			$info["sn"] = trim($_POST['sn']);
			$info["ou"] = trim($_POST['ou']);
			$info["givenname"] = trim($_POST['givenName']);
			$info["title"] = trim($_POST['title']);
			$info["telephonenumber"] = trim($_POST['telephoneNumber']);
			$info["mobile"] = trim($_POST['mobile']);
			$info["postaladdress"] = trim($_POST['postalAddress']);
			$info["loginshell"]= trim($_POST['shell']);
			$info["gidnumber"] = trim($_POST['gidNumber']);
			$info["uidnumber"] = trim($_POST['uidNumber']);
			$info["homedirectory"] = trim($_POST['directory']);
			//$info["homedirectory"] = "/home/".trim($_POST['uid'])."/";
			$info["description"] = trim($_POST['description']);
			
			//S'afageix la informació al ldap. 
			$infoUsuari = ldap_add($ldapconn, "$dn", $info);
			
				if($infoUsuari) {
					
					header('Location: usuariCreat.html');
					
				}
				
				else {
					
					header('Location: errorCreacioUsuari.html'); 
					
				}
				
			 ldap_close($ldapconn);
			 
		} else {
			
			header('Location: errorCreacioUsuari.html'); 
				
		}

	}

}
?>


