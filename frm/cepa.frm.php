<?php

require '../index/header.php';

require '../dao/cepa.dao.php';
require '../classe/cepa.class.php';

require '../index/conn_db.php';

IF ($_GET["recepa"] <> 0)
{
	$cepa_dao = new cepa_dao($db);
	$cepa = $cepa_dao->get($_GET["recepa"]);
}

echo '<form action="../gest/cepa.gest.php"  method="post">';

echo '<table>';
if ($_GET["recepa"] <> 0)
{
	echo '<tr><td>Référence : </td><td><input type="text" name="recepa" maxlength="50" value="'.$cepa->recepa().'" /></td></tr>';
	echo '<tr><td>Nom : </td><td><input type="text" name="decepa" maxlength="50" value="'.$cepa->Decepa().'" /></td></tr>';
}
else
{
	echo '<tr><td>Nom : </td><td><input type="text" name="decepa" maxlength="50" /></td></tr>';
}
echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';
echo '</table>';

echo '</form>';

require '../index/Footer.php';

?>

