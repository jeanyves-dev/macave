<?php

require '../index/header.php';

require '../dao/clas.dao.php';
require '../classe/clas.class.php';

require '../index/conn_db.php';

$declas = "";

IF ($_GET["reclas"] <> 0)
{
	$clas_dao = new clas_dao($db);
	$clas = $clas_dao->get($_GET["reclas"]);
	$declas = $clas->Declas();
}

echo '<form action="../gest/clas.gest.php"  method="post">';

echo '<table>';
if ($_GET["reclas"] <> 0)
	{echo '<tr><td>Référence : </td><td><input type="text" name="reclas" maxlength="50" value="'.$clas->reclas().'" /></td></tr>';}

echo '<tr><td>Nom : </td><td><input type="text" name="declas" maxlength="50" value="'.$declas.'" /></td></tr>';

echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';
echo '</table>';

echo '</form>';

require '../index/footer.php';

?>

