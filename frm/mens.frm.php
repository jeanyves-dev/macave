
<?php

require '../index/header.php';

/*require '../dao/mens.dao.php';
require '../classe/mens.class.php';
require '../dao/menu.dao.php';
require '../classe/menu.class.php';*/

require '../index/conn_db.php';

IF ($_GET["remens"] <> 0)
{
	$mens_dao = new mens_dao($db);
	$mens = $mens_dao->get($_GET["remens"]);
}

$menu_dao = new menu_dao($db);
$mesmenu = $menu_dao->getList();

echo '<form action="../gest/mens.gest.php"  method="post">';

echo '<table>';

if ($_GET["remens"] <> 0)
{
	echo '<tr><td>Référence : </td><td><input type="text" name="remens" maxlength="50" value="'.$mens->remens().'" /></td></tr>';
	echo '<tr><td>Nom : </td><td><input type="text" name="demens" maxlength="50" value="'.$mens->Demens().'" /></td></tr>';
	echo '<tr><td>Lien : </td><td><input type="text" name="limenu" maxlength="50" value="'.$mens->Limenu().'" /></td></tr>';
	echo '<tr><td>Rang : </td><td><input type="text" name="norang" maxlength="50" value="'.$mens->Norang().'" /></td></tr>';

	echo '<tr><td>Menu : </td><td><select id="remenu" name="remenu">';
	
	foreach ($mesmenu as $unmenu)
	{
		if ($unmenu->remenu() == $mens->Remenu())
		{
			echo '<option value=',$unmenu->remenu(),' SELECTED>',$unmenu->demenu(),'</option>';
		}
		else
		{
			echo '<option value=',$unmenu->remenu(),'>',$unmenu->demenu(),'</option>';
		}
	}
	echo '</select></td></tr>';
}
else
{
	echo '<tr><td>Nom : </td><td><input type="text" name="demens" maxlength="50" /></td></tr>';
	echo '<tr><td>Lien : </td><td><input type="text" name="limenu" maxlength="50" /></td></tr>';
	echo '<tr><td>Rang : </td><td><input type="text" name="norang" maxlength="50" /></td></tr>';
	echo '<tr><td>Menu : </td><td><select id="remenu" name="remenu">';
	
	foreach ($mesmenu as $unmenu)
	{
		echo '<option value=',$unmenu->remenu(),'>',$unmenu->demenu(),'</option>';		
	}
	echo '</select></td></tr>';
}
echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';
echo '</table>';

echo '</form>';

require '../index/footer.php';

?>
