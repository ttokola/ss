<?php
include("inc/vakio.php");


if (!AdminYhteys()) 
	{
	echo "Tietokantaa ei ole olemassa tai siihen ei saa yhteytt�. Luo tietokanta j�rjestelm�� varten";
	exit(0);
	}

//
// Tietokanta olemassa ja yhteys luotu
//

//

$tulos = TK_query("SHOW TABLES");
if ($tulos->num_rows == 0)
	{
	//Ei tauluja, voidaan luoda kokonaan alusta
	$command = 'mysql'
        . ' --host=' . $SQLSERVER
        . ' --user=' . $SQLADMIN
        . ' --password=' . $SQLAPWD
        . ' --database=' . $SQLDB
        . ' --execute="SOURCE ' . $INSTDIR . 'createdb.sql"'
	;
	$output1 = shell_exec($command);
	}
else
	{
	// Lasketaan nykyisen tietokannan HASH-arvo
	$DBHASH = "";
	while($t = $tulos::fetch_row())
		{
		$kuvaus = TK_query("DESCRIBE $t[0]");
		while($k = $kuvaus::fetch_row())
			{
			$DBHASH .= implode($k);
			}
		}
	$hashnyt = md5($DBHASH);

	//
	// T�h�n sitten tietokantaversiot jonoon, niin ett� vanhin ensin, ja vertaillaan hash-arvo vanhimmasta uusimpaan.
	// Tai ehk� uusinta voisi k�yd� kurkkaamassa ensin, ja sitten jos ei t�sm��, niin aloitetaan vanhimmasta, ja siit� kohdasta mist� t�sm��, l�hdet��n 
	// tekem��n kaikki tarvittavat SQL-k�skyt tietokannan p�ivitt�miseksi.

	}




?>
