
<?php

require '../index/header.php';

require '../dao/degu.dao.php';
require '../classe/degu.class.php';

require '../index/conn_db.php';

IF ($_GET["redegu"] <> 0)
{
	$degu_dao = new degu_dao($db);
	$degu = $degu_dao->get($_GET["redegu"]);
}

echo '<form action="../gest/degu.gest.php"  method="post">';

echo '<table>';

if ($_GET["redegu"] <> 0)
{
	echo '<tr><td>Référence : </td><td><input type="text" name="redegu" maxlength="50" value="'.$degu->redegu().'" /></td></tr>';
	echo '<tr><td>Date : </td><td><input type="date" name="dadegu" maxlength="50" value="'.$degu->dadeg2().'" /></td></tr>';
	echo '<tr><td>note : </td><td><input type="text" name="nodegu" maxlength="200" value="'.$degu->nodegu().'" /></td></tr>';
}
else
{
	echo '<tr><td>Date : </td><td><input type="date" name="dadegu" maxlength="50" /></td></tr>';
	echo '<tr><td>note : </td><td><input type="text" name="nodegu" maxlength="200" /></td></tr>';
}
echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';
echo '</table>';

echo '</form>';


require '../index/Footer.php';

?>
