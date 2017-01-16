<?php

require '../index/header.php';

require '../dao/gaba.dao.php';
require '../classe/gaba.class.php';

require '../index/conn_db.php';

IF ($_GET["regaba"] <> 0)
{
	$gaba_dao = new gaba_dao($db);
	$gaba = $gaba_dao->get($_GET["regaba"]);
}

echo '<form action="../gest/gaba.gest.php"  method="post">';

echo '<table>';
if ($_GET["regaba"] <> 0)
{
	echo '<tr><td>Référence : </td><td><input type="text" name="regaba" maxlength="50" value="'.$gaba->Regaba().'" /></td></tr>';
	echo '<tr><td>Nom : </td><td><input type="text" name="degaba" maxlength="50" value="'.$gaba->Degaba().'" /></td></tr>';
	echo '<tr><td>Contenance : </td><td><input type="text" name="conten" maxlength="50" value="'.$gaba->Conten().'" /></td></tr>';
}
else
{
	echo '<tr><td>Nom : </td><td><input type="text" name="degaba" maxlength="50" /></td></tr>';
	echo '<tr><td>Contenance : </td><td><input type="text" name="conten" maxlength="50" /></td></tr>';
}
echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';
echo '</table>';

echo '</form>';

require '../index/Footer.php';

?>

