﻿<?php

require '../index/header.php';

/*require '../dao/menu.dao.php';
require '../classe/menu.class.php';
require '../index/conn_db.php';*/

$demenu = "";
$limenu = "";
$norang = 0;

IF ($_GET["remenu"] <> 0)
{
	$menu_dao = new menu_dao($db);
	$menu = $menu_dao->get($_GET["remenu"]);
	$demenu = $menu->Demenu();
	$limenu = $menu->Limenu();
	$norang = $menu->Norang();
}

echo '<form action="../gest/menu.gest.php"  method="post">';

echo '<table>';
if ($_GET["remenu"] <> 0)
	{echo '<tr><td>Référence : </td><td><input type="text" name="remenu" maxlength="50" value="'.$menu->remenu().'" /></td></tr>';}

echo '<tr><td>Nom : </td><td><input type="text" name="demenu" maxlength="50" value="'.$demenu.'" /></td></tr>';
echo '<tr><td>Lien : </td><td><input type="text" name="limenu" maxlength="50" value="'.$limenu.'" /></td></tr>';
echo '<tr><td>Rang : </td><td><input type="text" name="norang" maxlength="50" value="'.$norang.'" /></td></tr>';

echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';
echo '</table>';

echo '</form>';

require '../index/footer.php';

?>

