
<?php

require '../index/header.php';

require '../dao/appe.dao.php';
require '../classe/appe.class.php';
require '../dao/regi.dao.php';
require '../classe/regi.class.php';

require '../index/conn_db.php';

IF ($_GET["reappe"] <> 0)
{
	$appe_dao = new appe_dao($db);
	$appe = $appe_dao->get($_GET["reappe"]);
}

$regi_dao = new regi_dao($db);
$mesregi = $regi_dao->getList();

echo '<form action="../gest/appe.gest.php"  method="post">';

echo '<table>';

if ($_GET["reappe"] <> 0)
{
	echo '<tr><td>Référence : </td><td><input type="text" name="reappe" maxlength="50" value="'.$appe->reappe().'" /></td></tr>';
	echo '<tr><td>Nom : </td><td><input type="text" name="deappe" maxlength="50" value="'.$appe->Deappe().'" /></td></tr>';
	
	echo '<tr><td>Région : </td><td><select id="reregi" name="reregi">';
	
	foreach ($mesregi as $unregi)
	{
		if ($unregi->reregi() == $appe->Reregi())
		{
			echo '<option value=',$unregi->reregi(),' SELECTED>',$unregi->deregi(),'</option>';
		}
		else
		{
			echo '<option value=',$unregi->reregi(),'>',$unregi->deregi(),'</option>';
		}
	}
	echo '</select></td></tr>';
}
else
{
	echo '<tr><td>Nom : </td><td><input type="text" name="deappe" maxlength="50" /></td></tr>';
	echo '<tr><td>Région : </td><td><select id="reregi" name="reregi">';
	foreach ($mesregi as $unregi)
	{
		echo '<option value=',$unregi->reregi(),'>',$unregi->deregi(),'</option>';		
	}
	echo '</select></td></tr>';
}
echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';
echo '</table>';

echo '</form>';

require '../index/footer.php';

?>
