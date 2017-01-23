<?php

require '../index/header.php';

require '../dao/tbse.dao.php';
require '../classe/tbse.class.php';
require '../index/conn_db.php';

$codtab = "";
$detbse = 0;

IF ($_GET["retbse"] <> 0)
{
	$tbse_dao = new tbse_dao($db);
	$tbse = $tbse_dao->get($_GET["retbse"]);
	$codtab = $tbse->Codtab();
	$detbse = $tbse->Detbse();
}

echo '<form action="../gest/tbse.gest.php"  method="post">';

echo '<table>';

if (isset($_GET["retbse"]) AND $_GET["retbse"] <> 0)
	{echo '<tr><td>Référence : </td><td><input type="text" name="retbse" maxlength="50" value="'.$tbse->Retbse().'" /></td></tr>';}

echo '<tr><td>Code : </td><td><input type="text" name="codtab" maxlength="50" value="'.$codtab.'" /></td></tr>';
echo '<tr><td>Designation : </td><td><input type="text" name="detbse" maxlength="50" value="'.$detbse.'" /></td></tr>';

echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';
echo '</table>';

echo '</form>';

require '../index/footer.php';

?>

