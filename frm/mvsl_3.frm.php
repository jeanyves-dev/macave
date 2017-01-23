
<?php

require '../index/header.php';

require '../dao/mvsl.dao.php';
require '../classe/mvsl.class.php';
require '../dao/mvso.dao.php';
require '../classe/mvso.class.php';
require '../dao/bout.dao.php';
require '../classe/bout.class.php';
require '../dao/vins.dao.php';
require '../classe/vins.class.php';
require '../dao/coul.dao.php';
require '../classe/coul.class.php';
require '../dao/appr.dao.php';
require '../classe/appr.class.php';

require '../index/conn_db.php';

$remvsl = 0;
$remvso = 0;
$rebout = 0;
$nomvsl = "";
$qtmvsl = 0;
$reappr = 0;

$bout_dao = new bout_dao($db);
$mesbout = $bout_dao->getList();

$appr_dao = new appr_dao($db);
$mesappr = $appr_dao->getList();

echo '<form action="../gest/mvsl.gest.php?remvso='.$_GET["remvso"].'"  method="post">';

echo '<table>';

if (isset($_GET["remvsl"]) AND $_GET["remvsl"] <> 0)
{
	$mvsl_dao = new mvsl_dao($db);
	$mvsl = $mvsl_dao->get($_GET["remvsl"]);
	
	$remvsl = $mvsl->remvsl();
	$remvso = $mvsl->remvso();
	$rebout = $mvsl->rebout();
	$nomvsl = $mvsl->nomvsl();
	$qtmvsl = $mvsl->qtmvsl();
	$reappr = $mvsl->reappr();

	echo '<tr><td>Référence : </td><td><input type="text" name="remvsl" maxlength="50" value="'.$remvsl.'" /></td></tr>';
	
}

echo '<tr>';
echo '<td>Bouteille</td>';
echo '<td>';
echo '<select id="rebout"  name="rebout">';
foreach ($mesbout as $unbout)
{
	$vins_dao = new vins_dao($db);
	$unvins = $vins_dao->get($unbout->revins());
	$coul_dao = new coul_dao($db);
	$uncoul = $coul_dao->get($unvins->recoul());
	if ($unbout->rebout() == $rebout)
	{echo '<option value=',$unbout->rebout(),' SELECTED>',$unvins->devins(),' - ',$uncoul->Decoul(),' - ',$unbout->Anmile(),'</option>';}
	else
	{echo '<option value=',$unbout->rebout(),'>',$unvins->devins(),' - ',$uncoul->Decoul(),' - ',$unbout->Anmile(),'</option>';}
}
echo '</select>';
echo '</td>';
echo '</tr>';

echo '<tr><td>Note : </td><td><input type="text" name="nomvsl" maxlength="50" value="'.$nomvsl.'" /></td></tr>';
echo '<tr><td>Quantité : </td><td><input type="text" name="qtmvsl" maxlength="50" value="'.$qtmvsl.'" /></td></tr>';

echo '<tr>';
echo '<td>Appréciation</td>';
echo '<td>';
echo '<select id="reappr"  name="reappr">';
foreach ($mesappr as $unappr)
{
	if ($unappr->reappr() == $reappr)
	{echo '<option value=',$unappr->reappr(),' SELECTED>',$unappr->deappr(),'</option>';}
	else
	{echo '<option value=',$unappr->reappr(),'>',$unappr->deappr(),'</option>';}
}
echo '</select>';
echo '</td>';
echo '</tr>';


echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';

echo '</table>';

echo '</form>';

require '../index/footer.php';

?>
