
<?php

require '../index/header.php';

require '../dao/prod.dao.php';
require '../classe/prod.class.php';
require '../dao/tbsd.dao.php';
require '../classe/tbsd.class.php';

require '../index/conn_db.php';

$reprod = "";
$deprod = "";
$adresa = "";
$adresb = "";
$codpos = "";
$villep = "";
$typrop = "";
$admail = "";
$adrweb = "";

echo '<form action="../gest/prod.gest.php"  method="post">';

echo '<table>';

$tbsd_dao = new tbsd_dao($db);
$mestbsd = $tbsd_dao->getList("typrop");

IF ($_GET["reprod"] <> 0)
{
	$prod_dao = new prod_dao($db);
	$prod = $prod_dao->get($_GET["reprod"]);
	
	$reprod = $prod->Reprod();
	$deprod = $prod->deprod();
	$adresa = $prod->adresa();
	$adresb = $prod->adresb();
	$codpos = $prod->codpos();
	$villep = $prod->villep();
	$typrop = $prod->typrop();
	$admail = $prod->admail();
	$adrweb = $prod->adrweb();
	
	echo '<tr><td>Référence : </td><td><input type="text" name="reprod" maxlength="50" value="'.$prod->reprod().'"/></td></tr>';
}

echo "<tr><td>Propriété : </td><td><select id='typrop' name='typrop'>";
foreach ($mestbsd as $untbsd)
{
	if ($untbsd->retbsd() == $prod->typrop())
		{echo '<option value=',$untbsd->retbsd(),' SELECTED>',$untbsd->detbsd(),'</option>';}
	else
		{echo '<option value=',$untbsd->retbsd(),'>',$untbsd->detbsd(),'</option>';}
}
echo '</select></td></tr>';

echo '<tr><td>Nom : </td><td><input type="text" name="deprod" value="'.$deprod.'" maxlength="50" /></td></tr>';
echo '<tr><td>Adresse 1 : </td><td><input type="text" name="adresa" value="'.$adresa.'" maxlength="100" /></td></tr>';
echo '<tr><td>Adresse 2 : </td><td><input type="text" name="adresb" value="'.$adresb.'" maxlength="100" /></td></tr>';
echo '<tr><td>Code postal : </td><td><input type="text" name="codpos" value="'.$codpos.'" maxlength="10" /></td></tr>';
echo '<tr><td>Ville : </td><td><input type="text" name="villep" value="'.$villep.'" maxlength="50" /></td></tr>';
echo '<tr><td>Mail : </td><td><input type="text" name="admail" value="'.$admail.'" maxlength="50" /></td></tr>';
echo '<tr><td>Web : </td><td><input type="text" name="adrweb" value="'.$adrweb.'" maxlength="50" /></td></tr>';
echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';

echo '</table>';

echo '</form>';

require '../index/Footer.php';

?>
