<?php
$SQLSERVER = "";
$SQLDB = "";
$SQLADMIN = "";
$SQLAPWD = "";
$SQLUSER = "";
$SQLUPWD = "";
$SQLLINK = NULL;

function TK_Yhteys() 
	{
	$SQLLINK = new mysqli($SQLSERVER,$SQLUSER,$SQLUPWD,$SQLDB);
	if ($SQLLINK->connect_errno) 
		{
		echo "Failed to connect to MySQL: " . $SQLLINK->connect_error;
		return false;
		}
	}
function TK_Admin_Yhteys() 
	{
	$SQLLINK = new mysqli($SQLSERVER,$SQLADMIN,$SQLAPWD,$SQLDB);
	if ($SQLLINK->connect_errno) 
		{
		echo "Failed to connect to MySQL: " . $SQLLINK->connect_error;
		return false;
		}
	}


function TK_query($qstring,$docstring = NULL,$email = False)
	{
        if (is_null($docstring)) $docstring = "Ei hakukuvausta annettu";
        $ret = $SQLLINK->query($qstring);
        if(!$ret)
                {
		if (!$email)
			{
	                loki_virhe("MYSQL-VIRHE","VIRHE",$mysqli->error . "\n(" . $docstring) . ")\n\nSQL-lause:\n" . $qstring . "\n\nBacktrace:\n" . getAsString('debug_print_backtrace'),$mysqli->errno);
			}
		else
			{
	                //Varajärjestelmänä sähköposti
                	$otsikot = "From: " . $SIVUSTOLYHENNE . " Virheraportti <noreply@" . $SPOSTILOPPU . ">\r\n";
                	$otsikot .= 'Content-type: text/plain; charset=iso-8859-15' . "\r\n";
                	if(!mail($ADMINEMAIL,"Tietokantavirhe sivustolla " . $SPOSTILOPPU,"Hei!\n\nYritin kirjoittaa tietokantaan, mutta epäonnistuin. Yrityksen tiedot ovat: \n\nKuvaus: " . $docstring . "\n\nVirhenumero: " . $mysqli->errno . "\n\nVirhekuvaus: " . $mysqli->error . "\n\nSQL-lause: " . $qstring . ");
				{echo "On tapahtunut virhe, eikä raportointi ja lokitoiminnot toimineet myöskään. Ole hyvä ja raportoi virhetilanne sähköpostitse osoitteeseen" . $ADMINEMAIL;}
                        }       
                return FALSE;
                }
        return($ret);
	}

function TK_query_email_errors($qstring,$docstring = NULL)
	{
	return(TK_query($qstring,$docstring,True));
	}
?>
