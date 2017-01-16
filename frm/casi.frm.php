
<?php

require '../index/header.php';

require '../dao/casi.dao.php';
require '../classe/casi.class.php';
require '../dao/colo.dao.php';
require '../classe/colo.class.php';

require '../index/conn_db.php';

IF ($_GET["recasi"] <> 0)
{
	$casi_dao = new casi_dao($db);
	$casi = $casi_dao->get($_GET["recasi"]);
}

$colo_dao = new colo_dao($db);
$mescolo = $colo_dao->getList();

echo '<form action="../gest/casi.gest.php"  method="post">';

echo '<table>';

IF ($_GET["recasi"] <> 0)
{
	echo '<tr><td>Référence : </td><td><input type="text" name="recasi" maxlength="50" value="'.$casi->recasi().'" /></td></tr>';
	echo '<tr><td>Nom : </td><td><input type="text" name="decasi" maxlength="50" value="'.$casi->Decasi().'" /></td></tr>';
	
	echo '<tr><td>colo : </td><td><select id="recolo" name="recolo">';
	
	foreach ($mescolo as $uncolo)
	{
		if ($uncolo->recolo() == $casi->Recolo())
		{
			echo '<option value=',$uncolo->recolo(),' SELECTED>',$uncolo->decolo(),'</option>';
		}
		else
		{
			echo '<option value=',$uncolo->recolo(),'>',$uncolo->decolo(),'</option>';
		}
	}
	echo '</select></td></tr>';
	echo '<tr><td>Nombre de ligne : </td><td><input type="text" name="nbrlig" maxlength="50" value="'.$casi->nbrlig().'"/></td></tr>';
	echo '<tr><td>Nombre de colonne : </td><td><input type="text" name="nbrcol" maxlength="50" value="'.$casi->nbrcol().'"/></td></tr>';
}
else
{
	echo '<tr><td>Nom : </td><td><input type="text" name="decasi" maxlength="50" /></td></tr>';
	echo '<tr><td>colo : </td><td><select id="recolo" name="recolo">';
	foreach ($mescolo as $uncolo)
	{
		echo '<option value=',$uncolo->recolo(),'>',$uncolo->decolo(),'</option>';		
	}
	echo '</select></td></tr>';
	echo '<tr><td>Nombre de ligne : </td><td><input type="text" name="nbrlig" maxlength="50" /></td></tr>';
	echo '<tr><td>Nombre de colonne : </td><td><input type="text" name="nbrcol" maxlength="50" /></td></tr>';

}
echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';
echo '</table>';

echo '</form>';

require '../index/Footer.php';

?>
