<?php

require '../index/header.php';

require '../dao/pays.dao.php';
require '../classe/pays.class.php';

require '../index/conn_db.php';

IF ($_GET["repays"] <> 0)
{
	$pays_dao = new pays_dao($db);
	$pays = $pays_dao->get($_GET["repays"]);
}

echo '<form action="../gest/pays.gest.php"  method="post">';

echo '<table>';
if ($_GET["repays"] <> 0)
{
	echo '<tr><td>Référence : </td><td><input type="text" name="repays" maxlength="50" value="'.$pays->repays().'" /></td></tr>';
	echo '<tr><td>Nom : </td><td><input type="text" name="depays" maxlength="50" value="'.$pays->Depays().'" /></td></tr>';
}
else
{
	echo '<tr><td>Nom : </td><td><input type="text" name="depays" maxlength="50" /></td></tr>';
}
echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';
echo '</table>';

echo '</form>';

require '../index/Footer.php';

?>

