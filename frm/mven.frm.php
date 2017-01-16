
<?php

require '../index/header.php';

require '../dao/mven.dao.php';
require '../classe/mven.class.php';
require '../dao/four.dao.php';
require '../classe/four.class.php';
require '../dao/tbsd.dao.php';
require '../classe/tbsd.class.php';

require '../index/conn_db.php';

IF ($_GET["remven"] <> 0)
{
	$mven_dao = new mven_dao($db);
	$mven = $mven_dao->get($_GET["remven"]);
}

$four_dao = new four_dao($db);
$mesfour = $four_dao->getList();

$tbsd_dao = new tbsd_dao($db);
$mestbsd = $tbsd_dao->getList("canapp");

echo '<form action="../gest/mven.gest.php"  method="post">';

echo '<table>';

if ($_GET["remven"] <> 0)
{
	echo '<tr><td>Référence : </td><td><input type="text" name="remven" maxlength="50" value="'.$mven->remven().'" /></td></tr>';
	echo '<tr><td>Date : </td><td><input type="date" name="damven" maxlength="50" value='.$mven->damve2().' /></td></tr>';
	
	echo "<tr><td>Canal d'achat : </td><td><select id='canapp' name='canapp'>";
	foreach ($mestbsd as $untbsd)
	{
		if ($untbsd->retbsd() == $mven->canapp())
			{echo '<option value=',$untbsd->retbsd(),' SELECTED>',$untbsd->detbsd(),'</option>';}
		else
			{echo '<option value=',$untbsd->retbsd(),'>',$untbsd->detbsd(),'</option>';}
	}
	echo '</select></td></tr>';

	
	echo '<tr><td>note : </td><td><input type="text" name="nomven" maxlength="50" value="'.$mven->nomven().'" /></td></tr>';
	
	echo '<tr><td>Fournisseur : </td><td><select id="refour" name="refour">';
	foreach ($mesfour as $unfour)
	{
		if ($unfour->refour() == $mven->Refour())
			{echo '<option value=',$unfour->refour(),' SELECTED>',$unfour->defour(),'</option>';}
		else
			{echo '<option value=',$unfour->refour(),'>',$unfour->defour(),'</option>';}
	}
	echo '</select></td></tr>';
}
else
{
	echo '<tr><td>Date : </td><td><input type="date" name="damven" maxlength="50" /></td></tr>';
	echo "<tr><td>Canal d'achat : </td><td><select id='canapp' name='canapp'>";
	foreach ($mestbsd as $untbsd)
		{echo '<option value=',$untbsd->retbsd(),'>',$untbsd->detbsd(),'</option>';}
	echo '</select></td></tr>';
	echo '<tr><td>note : </td><td><input type="text" name="nomven" maxlength="50" /></td></tr>';
	echo '<tr><td>fournisseur : </td><td><select id="refour" name="refour">';
	foreach ($mesfour as $unfour)
		{echo '<option value=',$unfour->refour(),'>',$unfour->defour(),'</option>';}
	echo '</select>';
	echo '<td><input type="text" name="defour" maxlength="50" /></td>';
	echo '</td></tr>';
	
}
echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';
echo '</table>';

echo '</form>';


require '../index/Footer.php';

?>
