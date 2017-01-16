
<?php

require '../index/header.php';

require '../dao/acco.dao.php';
require '../classe/acco.class.php';
require '../dao/vins.dao.php';
require '../classe/vins.class.php';
require '../dao/plat.dao.php';
require '../classe/plat.class.php';

require '../index/conn_db.php';

IF ($_GET["reacco"] <> 0)
{
	$acco_dao = new acco_dao($db);
	$acco = $acco_dao->get($_GET["reacco"]);
}

$vins_dao = new vins_dao($db);
$mesvins = $vins_dao->getList("","");
$plat_dao = new plat_dao($db);
$mesplat = $plat_dao->getList();

$reacco = 0;
$revins = 0;
$replat = 0;

echo '<form action="../gest/acco.gest.php"  method="post">';

echo '<table>';

if ($_GET["reacco"] <> 0)
{

	$reacco = $acco->Reacco();
	$revins = $acco->Revins();
	$replat = $acco->Replat();
	
	echo '<tr><td>Référence : </td><td><input type="text" name="reacco" maxlength="50" value="'.$acco->reacco().'" /></td></tr>';
}

echo '<tr><td>Vins : </td><td><select id="revins" name="revins">';
foreach ($mesvins as $unvins)
{
	if ($unvins->revins() == $revins)
		{echo '<option value=',$unvins->revins(),' SELECTED>',$unvins->devins(),'</option>';}
	else
		{echo '<option value=',$unvins->revins(),'>',$unvins->devins(),'</option>';}
}
echo '</select></td></tr>';

echo '<tr><td>Plat : </td><td><select id="replat" name="replat">';
foreach ($mesplat as $unplat)
{
	if ($unplat->replat() == $replat)
		{echo '<option value=',$unplat->replat(),' SELECTED>',$unplat->deplat(),'</option>';}
	else
		{echo '<option value=',$unplat->replat(),'>',$unplat->deplat(),'</option>';}
}
echo '</select></td></tr>';

echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';
echo '</table>';

echo '</form>';

require '../index/Footer.php';

?>
