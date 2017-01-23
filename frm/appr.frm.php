<?php

require '../index/header.php';

require '../dao/appr.dao.php';
require '../classe/appr.class.php';

require '../index/conn_db.php';

IF ($_GET["reappr"] <> 0)
{
	$appr_dao = new appr_dao($db);
	$appr = $appr_dao->get($_GET["reappr"]);
}

echo '<form action="../gest/appr.gest.php"  method="post">';

echo '<table>';
if ($_GET["reappr"] <> 0)
{
	echo '<tr><td>Référence : </td><td><input type="text" name="reappr" maxlength="50" value="'.$appr->reappr().'" /></td></tr>';
	echo '<tr><td>Nom : </td><td><input type="text" name="deappr" maxlength="50" value="'.$appr->Deappr().'" /></td></tr>';
}
else
{
	echo '<tr><td>Nom : </td><td><input type="text" name="deappr" maxlength="50" /></td></tr>';
}
echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';
echo '</table>';

echo '</form>';

require '../index/footer.php';

?>

