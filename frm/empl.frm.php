<?php

require '../index/header.php';

require '../dao/empl.dao.php';
require '../classe/empl.class.php';

require '../index/conn_db.php';

IF ($_GET["reempl"] <> 0)
{
	$empl_dao = new empl_dao($db);
	$empl = $empl_dao->get($_GET["reempl"]);
}

echo '<form action="../gest/empl.gest.php"  method="post">';

echo '<table>';
if ($_GET["reempl"] <> 0)
{
	echo '<tr><td>Référence : </td><td><input type="text" name="reempl" maxlength="50" value="'.$empl->reempl().'" /></td></tr>';
	echo '<tr><td>Nom : </td><td><input type="text" name="deempl" maxlength="50" value="'.$empl->Deempl().'" /></td></tr>';
}
else
{
	echo '<tr><td>Nom : </td><td><input type="text" name="deempl" maxlength="50" /></td></tr>';
}
echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';
echo '</table>';

echo '</form>';

require '../index/Footer.php';

?>

