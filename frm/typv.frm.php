<?php

require '../index/header.php';

require '../dao/typv.dao.php';
require '../classe/typv.class.php';

require '../index/conn_db.php';

$detypv = "";

IF ($_GET["retypv"] <> 0)
{
	$typv_dao = new typv_dao($db);
	$typv = $typv_dao->get($_GET["retypv"]);
	$detypv = $typv->Detypv();
}

echo '<form action="../gest/typv.gest.php"  method="post">';

echo '<table>';
if ($_GET["retypv"] <> 0)
	{echo '<tr><td>Référence : </td><td><input type="text" name="retypv" maxlength="50" value="'.$typv->retypv().'" /></td></tr>';}

echo '<tr><td>Nom : </td><td><input type="text" name="detypv" maxlength="50" value="'.$detypv.'" /></td></tr>';

echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';
echo '</table>';

echo '</form>';

require '../index/footer.php';

?>

