<?php

/*
 * Auteur : Yves DIBY
 * 
 * Date : 08/04/2015
 * 
 * Page Role : Manager Data
 * 
 */

class Manager{
	
	public function __construct(){
	// connexion a une base de données MySQL
	/*$dsn = "mysql:host=localhost;dbname=3devnewsletter";
        $login = "root";
	$pass = "";*/
    $dsn = "mysql:host=bd01.cloud4africa.net;dbname=c664_yvesdiby";
    $login = "c664_yvesdiby";
	$pass = "yvesdiby";
    //#mysql -u c664_yvesdiby -p -h bd01.cloud4africa.net  
	/*$dsn = "mysql:host=96.45.176.75;dbname=3devnewsletter";
	$login = "3devnewsletter";
	$pass = "3devnewsletter";*/
    
	try {
                ///echo "ok";
		return new PDO($dsn,$login,$pass);
                
                
	} catch (Exception $e) {
              echo $e->getMessage();
		return FALSE;
	}
	
	}
}
 $man = new Manager();

         