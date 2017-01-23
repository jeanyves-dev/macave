<?php

require '../index/header.php';

require '../dao/plat.dao.php';
require '../classe/plat.class.php';

require '../index/conn_db.php';

$deplat = "";

IF ($_GET["replat"] <> 0)
{
	$plat_dao = new plat_dao($db);
	$plat = $plat_dao->get($_GET["replat"]);
	$deplat = $plat->Deplat();
}

echo '<form action="../gest/plat.gest.php"  method="post">';

echo '<table>';
if ($_GET["replat"] <> 0)
	{echo '<tr><td>Référence : </td><td><input type="text" name="replat" maxlength="50" value="'.$plat->replat().'" /></td></tr>';}

echo '<tr><td>Nom : </td><td><input type="text" name="deplat" maxlength="50" value="'.$deplat.'" /></td></tr>';

echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';
echo '</table>';

echo '</form>';

require '../index/footer.php';

?>

