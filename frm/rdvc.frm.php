<?php

require '../index/header.php';

require '../dao/rdvc.dao.php';
require '../classe/rdvc.class.php';

require '../index/conn_db.php';

IF ($_GET["rerdvc"] <> 0)
{
	$rdvc_dao = new rdvc_dao($db);
	$rdvc = $rdvc_dao->get($_GET["rerdvc"]);
}

echo '<form action="../gest/rdvc.gest.php"  method="post">';

echo '<table>';
if ($_GET["rerdvc"] <> 0)
{
	echo '<tr><td>Référence : </td><td><input type="text" name="rerdvc" maxlength="50" value="'.$rdvc->rerdvc().'" /></td></tr>';
	echo '<tr><td>Nom : </td><td><input type="text" name="derdvc" maxlength="50" value="'.$rdvc->Derdvc().'" /></td></tr>';
}
else
{
	echo '<tr><td>Nom : </td><td><input type="text" name="derdvc" maxlength="50" /></td></tr>';
}
echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';
echo '</table>';

echo '</form>';

require '../index/footer.php';

?>

