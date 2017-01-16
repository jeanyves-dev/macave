
<?php

require '../index/header.php';

require '../dao/four.dao.php';
require '../classe/four.class.php';

require '../index/conn_db.php';

$refour = "";
$defour = "";
$adresa = "";
$adresb = "";
$codpos = "";
$villef = "";
$numtel = "";
$numfax = "";
$admail = "";
$sitweb = "";

echo '<form action="../gest/four.gest.php"  method="post">';

echo '<table>';

IF ($_GET["refour"] <> 0)
{
	$four_dao = new four_dao($db);
	$four = $four_dao->get($_GET["refour"]);
	
	$refour = $four->Refour();
	$defour = $four->defour();
	$adresa = $four->adresa();
	$adresb = $four->adresb();
	$codpos = $four->codpos();
	$villef = $four->villef();
	$numtel = $four->numtel();
	$numfax = $four->numfax();
	$admail = $four->admail();
	$sitweb = $four->sitweb();
	
	echo '<tr><td>Référence : </td><td><input type="text" name="refour" maxlength="50" value="'.$four->refour().'" /></td></tr>';
}

echo '<tr><td>Nom : </td><td><input type="text" name="defour" value="'.$defour.'" maxlength="50" /></td></tr>';
echo '<tr><td>Adresse 1 : </td><td><input type="text" name="adresa" value="'.$adresa.'" maxlength="100" /></td></tr>';
echo '<tr><td>Adresse 2 : </td><td><input type="text" name="adresb" value="'.$adresb.'" maxlength="100" /></td></tr>';
echo '<tr><td>Code postal : </td><td><input type="text" name="codpos" value="'.$codpos.'" maxlength="10" /></td></tr>';
echo '<tr><td>Ville : </td><td><input type="text" name="villef" value="'.$villef.'" maxlength="50" /></td></tr>';
echo '<tr><td>Téléphone : </td><td><input type="text" name="numtel" value="'.$numtel.'" maxlength="50" /></td></tr>';
echo '<tr><td>Fax : </td><td><input type="text" name="numfax" value="'.$numfax.'" maxlength="50" /></td></tr>';
echo '<tr><td>Mail : </td><td><input type="text" name="admail" value="'.$admail.'" maxlength="50" /></td></tr>';
echo '<tr><td>Site web : </td><td><input type="text" name="sitweb" value="'.$sitweb.'" maxlength="50" /></td></tr>';
echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';

echo '</table>';

echo '</form>';

require '../index/Footer.php';

?>
