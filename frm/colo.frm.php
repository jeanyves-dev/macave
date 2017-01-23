
<?php

require '../index/header.php';

require '../dao/colo.dao.php';
require '../classe/colo.class.php';
require '../dao/empl.dao.php';
require '../classe/empl.class.php';

require '../index/conn_db.php';

IF ($_GET["recolo"] <> 0)
{
	$colo_dao = new colo_dao($db);
	$colo = $colo_dao->get($_GET["recolo"]);
}

$empl_dao = new empl_dao($db);
$mesempl = $empl_dao->getList();

echo '<form action="../gest/colo.gest.php"  method="post">';

echo '<table>';

IF ($_GET["recolo"] <> 0)
{
	echo '<tr><td>Référence : </td><td><input type="text" name="recolo" maxlength="50" value="'.$colo->recolo().'" /></td></tr>';
	echo '<tr><td>Nom : </td><td><input type="text" name="decolo" maxlength="50" value="'.$colo->Decolo().'" /></td></tr>';
	
	echo '<tr><td>empl : </td><td><select id="reempl" name="reempl">';
	
	foreach ($mesempl as $unempl)
	{
		if ($unempl->reempl() == $colo->Reempl())
		{
			echo '<option value=',$unempl->reempl(),' SELECTED>',$unempl->deempl(),'</option>';
		}
		else
		{
			echo '<option value=',$unempl->reempl(),'>',$unempl->deempl(),'</option>';
		}
	}
	echo '</select></td></tr>';
}
else
{
	echo '<tr><td>Nom : </td><td><input type="text" name="decolo" maxlength="50" /></td></tr>';
	echo '<tr><td>empl : </td><td><select id="reempl" name="reempl">';
	foreach ($mesempl as $unempl)
	{
		echo '<option value=',$unempl->reempl(),'>',$unempl->deempl(),'</option>';		
	}
	echo '</select></td></tr>';
}
echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';
echo '</table>';

echo '</form>';

require '../index/footer.php';

?>
