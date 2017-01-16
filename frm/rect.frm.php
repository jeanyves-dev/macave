<?php

require '../index/header.php';

require '../dao/rect.dao.php';
require '../classe/rect.class.php';

require '../index/conn_db.php';

$derect = "";

IF ($_GET["rerect"] <> 0)
{
	$rect_dao = new rect_dao($db);
	$rect = $rect_dao->get($_GET["rerect"]);
	$derect = $rect->Derect();
}

echo '<form action="../gest/rect.gest.php"  method="post">';

echo '<table>';
if ($_GET["rerect"] <> 0)
	{echo '<tr><td>Référence : </td><td><input type="text" name="rerect" maxlength="50" value="'.$rect->rerect().'" /></td></tr>';}

echo '<tr><td>Nom : </td><td><input type="text" name="derect" maxlength="50" value="'.$derect.'" /></td></tr>';

echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';
echo '</table>';

echo '</form>';

require '../index/Footer.php';

?>

