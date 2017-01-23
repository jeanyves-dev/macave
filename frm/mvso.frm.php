
<?php

require '../index/header.php';

require '../dao/mvso.dao.php';
require '../classe/mvso.class.php';

require '../index/conn_db.php';

IF ($_GET["remvso"] <> 0)
{
	$mvso_dao = new mvso_dao($db);
	$mvso = $mvso_dao->get($_GET["remvso"]);
}

echo '<form action="../gest/mvso.gest.php"  method="post">';

echo '<table>';

if ($_GET["remvso"] <> 0)
{
	echo '<tr><td>Référence : </td><td><input type="text" name="remvso" maxlength="50" value="'.$mvso->remvso().'" /></td></tr>';
	echo '<tr><td>Date : </td><td><input type="date" name="damvso" maxlength="50" value="'.$mvso->damvs2().'" /></td></tr>';
	echo '<tr><td>Commentaires : </td><td><input type="text" name="nomvso" maxlength="50" value="'.$mvso->nomvso().'" /></td></tr>';
}
else
{
	echo '<tr><td>Date : </td><td><input type="date" name="damvso" maxlength="50" /></td></tr>';
	echo '<tr><td>Commentaires : </td><td><input type="text" name="nomvso" maxlength="50" /></td></tr>';
}
echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';
echo '</table>';

echo '</form>';


require '../index/footer.php';

?>
