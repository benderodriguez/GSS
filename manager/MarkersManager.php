<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class MarkersManager extends Manager
{
 

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

        private $_db;
	function __construct(){
		$this->_db = parent::__construct();
	}
    
    function get($direction,$idClient,$idactivite){
        $result =  Array();
            
        //$sql = "CALL    sp_get_mail_400_desc()";
        if($direction=="haut")
        {
            $sql = "CALL sp_get_mail_400($idClient,$idactivite)";
        }
       else {
            $sql = "CALL sp_get_mail_400_desc($idClient,$idactivite)";
       }
        $requete= $this->_db->prepare($sql);
        
        $requete->execute();
        $requete->setFetchMode(PDO::FETCH_ASSOC);

        while( $ligne = $requete->fetch()) // on r�cup�re la liste 
        {
            $result[]=$ligne; //
        }
        return $result;
    }
    
      function getUserMail(){
        $result =  Array();
        
        //$sql = "CALL    sp_get_mail_400_desc()";
        $sql = "CALL sp_get_userMails()";
        $requete= $this->_db->prepare($sql);
        
        $requete->execute();
        $requete->setFetchMode(PDO::FETCH_ASSOC);

        while( $ligne = $requete->fetch()) // on r�cup�re la liste 
        {
            $result[]=$ligne; //
        }
        //var_dump($result);
        return $result;
    }
    function getClient3(){
        $result =  Array();
            
        //$sql = "CALL    sp_get_mail_400_desc()";
        $sql = "CALL sp_get_clients_all()";
        $requete= $this->_db->prepare($sql);
        
        $requete->execute();
        $requete->setFetchMode(PDO::FETCH_ASSOC);

        while( $ligne = $requete->fetch()) // on r�cup�re la liste 
        {
            $result[]=$ligne; //
        }
        return $result;
    }
    
    function getLastActivity(){
        $result =  Array();
            
        //$sql = "CALL    sp_get_mail_400_desc()";
        $sql = "CALL sp_get_last_activite()";
        $requete= $this->_db->prepare($sql);
        
        $requete->execute();
        $requete->setFetchMode(PDO::FETCH_ASSOC);

        while( $ligne = $requete->fetch()) // on r�cup�re la liste 
        {
            $result[]=$ligne; //
        }
        return $result;
    }
    
   function getActivityByDate($date){
        $result =  Array();
            
        //$sql = "CALL    sp_get_mail_400_desc()";
        $date = date_format(date_create_from_format('j/m/Y',$date),'Y-m-d');
        
        $sql = "CALL sp_activite_interval('$date','$date')";
        $requete= $this->_db->prepare($sql);
        
        $requete->execute();
        $requete->setFetchMode(PDO::FETCH_ASSOC);

        while( $ligne = $requete->fetch()) // on r�cup�re la liste 
        {
            $result[]=$ligne; //
        }
        return $result;
    }
    function set($mail){
            
        $sql = "CALL   sp_set_mail(:mail)";
        $requete=  $this->_db->prepare($sql);
        $requete->bindValue(':mail',$mail);
        return $requete->execute();
        
    }
    
     function setRelActivite($idmail,$idactivite,$status){
         //echo $idmail." ".$idactivite." ".$status ;
            
        $sql = "CALL   sp_setMail_activite(:idmail,:idactivite,:statut)";
        $requete=  $this->_db->prepare($sql);
        $requete->bindValue(':idmail',$idmail);
        $requete->bindValue(':idactivite',$idactivite);
        $requete->bindValue(':statut',$status);
        return $requete->execute();
        
    }
    
     function ajouterMailClient($libmail,$idcient,$typmail="confidentiel"){
            
        $sql = "CALL   sp_ajouter_mail_client(:libmail,:typmail,:idcient)";
        $requete=  $this->_db->prepare($sql);
        $requete->bindValue(':idcient',$idcient);
        $requete->bindValue(':libmail',$libmail);
        $requete->bindValue(':typmail',$typmail);
        return $requete->execute();
        
    }
    
    function createActivite($libclient){
         
        $date = gmdate("d/m/Y") ;
        $libactivite =  "Envoi de mails du ".$date." pour ".$libclient;
       // echo $libactivite ;
        $sql = "CALL   sp_ajouter_activite(:libAct)";
        $requete=  $this->_db->prepare($sql);
        $requete->bindValue(':libAct',$libactivite);
        $requete->execute();
        
        $retour = $requete->fetch(PDO::FETCH_ASSOC);
        $retour["libactivite"]=$libactivite;
        $retour["idactivite"]=$retour["id"];
        $retour["datactivite"]=$date;
       // var_dump($retour);
        return array($retour);
        
    }
    
     function setValide($mail){
        echo htmlentities($mail)."<br>";  
        $sql = "CALL   sp_set_mail_valide(:mail)";
        $requete=  $this->_db->prepare($sql);
        $requete->bindValue(':mail',$mail);
        return $requete->execute();
        
    }
    
    
  function getMailInFile($fichier){
	
    $tabfich=file($fichier); 
    for( $i = 2 ; $i < count($tabfich) ; $i++ )
    {
    $str = $tabfich[$i];
    
    $rest = substr($str, 2, -25);
    //echo $str."<br>";
    //echo $rest ;
    $chars = array(";", ",","\t");
    $chaineFinale = explode("\t", $str);
  //  echo (@$chaineFinale[3])."<br>";
    //var_dump($str);
    $result[] = array("idmail"=>$chaineFinale[0],"libmail"=>$chaineFinale[1],"statut"=>  trim($chaineFinale[3]));
    
      if(trim($chaineFinale[3])=="ECHEC")
      {
          // unset($tabfich[$i]);
         
         $tabfich[$i]="";
          //echo $tabfich[$i]."<br>" ;
      }
    
    
    //$result[]["statut"] = $chaineFinale[3];
   
    }
    
    $this->deleteLine($tabfich, $fichier);
    //var_dump($tabfich);  
    
    return $result;
}

function  deleteLine($content,$fichier)
{
       
      

      //$array = file($file);
      //unset($array[$line]);
    
     // var_dump($content);
      
      $fp = fopen($fichier, 'w+');

      foreach($content as $line) 
      {
            fwrite($fp,$line); 
      }
        

      fclose($fp);  
}


public function getFileData($fileName)
{
    return file($fileName);
}


public function getRepportFromFile($fileName)
{
      $result =  Array();
      
      $tabfich  = $this->getFileData($fileName);
      
      for( $i = 2 ; $i < count($tabfich) ; $i++ )
     {
       $str = $tabfich[$i];
    
       $rest = substr($str, 2, -25);
  
        $chars = array(";", ",","\t");
        $chaineFinale = explode("\t", $str);
  
       $result[] = array("idmail"=>$chaineFinale[0],"libmail"=>$chaineFinale[1],"statut"=>  trim($chaineFinale[3]));
    }
    
    return $result;
}
public function setMailValide($fileName)
{
    $data = $this->getFileData($fileName);
    echo count($data);
    foreach ($data as $unMail)
    {
        set_time_limit(0);
        $this->setValide(trim($unMail));
    }
     
      
}

public  function getRapportFromDB($type,$date,$idactivity)
{
    $result =  Array();
    
       if($date!='last')
       {
        
            $idactivite = $idactivity;

            switch ($type)
            {
                case "all":
                {
                     $sql = "call sp_getMails_envoye(:idactiv);";
                }
                 break;
                 case "succes":
                 {
                     $sql ="call sp_getMails_success(:idactiv); ";

                 }
                 break;
                 case "error":
                 {
                     $sql = "call sp_getMails_echec(:idactiv);";
                 }
            }
        }
       else {
             $activite = $this->getLastActivity();
            // var_dump($activite);
             $idactivite = $activite[0]["idactivite"];
             $sql = " sp_getMails_envoye(:idactiv);";
       }

       //  echo $sql;
        $requete= $this->_db->prepare($sql);
        $requete->bindValue(':idactiv',$idactivite);
        $requete->execute();
        $requete->setFetchMode(PDO::FETCH_ASSOC);

        while( $ligne = $requete->fetch()) // on r�cup�re la liste 
        {
            $result[]=$ligne; //
        }
        return $result;
}

function getMailsAll(){
        $result =  Array();
            
        //$sql = "CALL    sp_get_mail_400_desc()";
        $sql = "CALL sp_get_mail_all()";
        $requete= $this->_db->prepare($sql);
        
        $requete->execute();
        $requete->setFetchMode(PDO::FETCH_ASSOC);

        while( $ligne = $requete->fetch()) // on r�cup�re la liste 
        {
            $result[]=$ligne; //
        }
        return $result;
    }
    
function modifierMail($id, $mail){
         $sql = "CALL   sp_modifier_mail(:id,:mail)";
        $requete=  $this->_db->prepare($sql);
        $requete->bindValue(':id',$id);
        $requete->bindValue(':mail',$mail);
        return $requete->execute();
}

}

