
<?php

require '../index/header.php';

require '../dao/coul.dao.php';
require '../classe/coul.class.php';

require '../index/conn_db.php';

$recoul = 0;
$decoul = "";
$cocoul = "";

echo '<form action="../gest/coul.gest.php"  method="post">';

echo '<table>';

IF ($_GET["recoul"] <> 0)
{
	$coul_dao = new coul_dao($db);
	$coul = $coul_dao->get($_GET["recoul"]);
	
	$recoul = $coul->Recoul();
	$decoul = $coul->decoul();
	$cocoul = $coul->cocoul();
	
	echo '<tr><td>Référence : </td><td><input type="text" name="recoul" maxlength="50" value="'.$coul->recoul().'" /></td></tr>';
}

echo '<tr><td>Nom : </td><td><input type="text" name="decoul" value="'.$decoul.'" maxlength="50" /></td></tr>';
echo '<tr><td>Code couleur : </td><td><input type="text" name="cocoul" value="'.$cocoul.'" maxlength="50" /></td></tr>';
echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';

echo '</table>';

echo '</form>';

require '../index/footer.php';

?>
