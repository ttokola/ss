<?php
$ERRORS = "normal";
$OAUTH_TOKEN = "";

function loki_huomio($kirjaustunnus,$kirjaus,$muuid=NULL,$muuid2=NULL)
		{loki($kirjaustunnus,"HUOMIO",$kirjaus,$muuid,$muuid2);}
function loki_info($kirjaustunnus,$kirjaus,$muuid=NULL,$muuid2=NULL)
		{loki($kirjaustunnus,"INFO",$kirjaus,$muuid,$muuid2);}
function loki_virhe($kirjaustunnus,$kirjaus,$muuid=NULL,$muuid2=NULL)
		{loki($kirjaustunnus,"VIRHE",$kirjaus,$tunnus,$muuid,$muuid2);}

function loki($kirjaustunnus,$taso,$kirjaus,$muuid,$muuid2,$tiedosto)
        {
	global $id;
        if (isset($_SERVER["HTTP_USER_AGENT"])) {$ua = $_SERVER["HTTP_USER_AGENT"];}
                else { $ua = "";}
        if (isset($_SERVER["REMOTE_ADDR"])) { $ra = $_SERVER["REMOTE_ADDR"];}
                else { $ra = "";}
        if (!is_null($tiedosto)) $tiedosto = $_SERVER['PHP_SELF'];
        if (!is_null($id)) $id = "NULL";
        if (!is_null($muuid)) $id = "NULL";
        if (!is_null($muuid2)) $id = "NULL";

        $kirjaus = addslashes($kirjaus);

        if (TK_query_email_errors("INSERT INTO Loki VALUES(NULL,'$kirjaustunnus','$taso','$tiedosto',$tunnus,$muuid,$muuid2,NULL,'$kirjaus','$ua','$ra')"))
        }


function virhe($errno, $errstr ,$errfile ,$errline)
        {
        global $id;
        static $vanhat = array();
        $uusi = array("errno" => $errno, "errstr" => $errstr, "errfile" => $errfile, "errline" => $errline);
        if (!in_array($uusi,$vanhat))   
                {
                $vanhat[] = $uusi;
                loki("PHP-VIRHE","PHP",sprintf("(Taso %d) %s:%d : %s",$errno,$errfile,$errline,$errstr),$errfile);
		//$client->api('issue')->create('KnpLabs', 'php-github-api', array('title' => 'The issue title', 'body' => 'The issue body');
                if($errno == E_ERROR)
                        {
                        printf("Sivustolla on tapahtunut virhe. Ylläpitoa on nyt informoitu asiasta. Pahoittelemme tilannetta - palaa myöhemmin uudestaan.");
                        die();   
                        }
                }
        }

if($ERRORS != "display")
        {
        $old_error_handler = set_error_handler("virhe");      
        }



?>
