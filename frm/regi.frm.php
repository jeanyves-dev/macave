
<?php

require '../index/header.php';

require '../dao/regi.dao.php';
require '../classe/regi.class.php';
require '../dao/pays.dao.php';
require '../classe/pays.class.php';

require '../index/conn_db.php';

IF ($_GET["reregi"] <> 0)
{
	$regi_dao = new regi_dao($db);
	$regi = $regi_dao->get($_GET["reregi"]);
}

$pays_dao = new pays_dao($db);
$mespays = $pays_dao->getList();

echo '<form action="../gest/regi.gest.php"  method="post">';

echo '<table>';

IF ($_GET["reregi"] <> 0)
{
	echo '<tr><td>Référence : </td><td><input type="text" name="reregi" maxlength="50" value="'.$regi->reregi().'" /></td></tr>';
	echo '<tr><td>Nom : </td><td><input type="text" name="deregi" maxlength="50" value="'.$regi->Deregi().'" /></td></tr>';
	
	echo '<tr><td>Pays : </td><td><select id="repays" name="repays">';
	
	foreach ($mespays as $unpays)
	{
		if ($unpays->repays() == $regi->Repays())
		{
			echo '<option value=',$unpays->repays(),' SELECTED>',$unpays->depays(),'</option>';
		}
		else
		{
			echo '<option value=',$unpays->repays(),'>',$unpays->depays(),'</option>';
		}
	}
	echo '</select></td></tr>';
}
else
{
	echo '<tr><td>Nom : </td><td><input type="text" name="deregi" maxlength="50" /></td></tr>';
	echo '<tr><td>Pays : </td><td><select id="repays" name="repays">';
	foreach ($mespays as $unpays)
	{
		echo '<option value=',$unpays->repays(),'>',$unpays->depays(),'</option>';		
	}
	echo '</select></td></tr>';
}
echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';
echo '</table>';

echo '</form>';

require '../index/footer.php';

?>
