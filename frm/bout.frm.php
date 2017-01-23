<?php

require '../index/header.php';

require '../classe/bout.class.php';
require '../classe/vins.class.php';
require '../classe/gaba.class.php';
require '../classe/coul.class.php';
require '../dao/bout.dao.php';
require '../dao/vins.dao.php';
require '../dao/gaba.dao.php';
require '../dao/coul.dao.php';

require '../index/conn_db.php';

$vins_dao = new vins_dao($db);
$mesvins = $vins_dao->getList("","",0,0);
$gaba_dao = new gaba_dao($db);
$mesgaba = $gaba_dao->getList();

$revins = 0;
$devins = "";
$regaba = 0;
$degaba = "";
$anmile = 0;
$anapog = 0;
$anaboi = 0;
$bonote = 0;
$degres = 0;

$origin = "";
if (isset($_GET['ori']) and ($_GET['ori'] <> ''))
	{$origin = $_GET['ori'];}

echo '<form action="../gest/bout.gest.php?ori='.$origin.'" method="post">';

echo '<table>';

IF (isset($_GET["rebout"]) AND ($_GET["rebout"] <> 0))
{
	$bout_dao = new bout_dao($db);
	$bout = $bout_dao->get($_GET["rebout"]);
	
	$rebout = $bout->Rebout();
	$revins = $bout->Revins();
	$devins = $bout->Devins($db);
	$regaba = $bout->Regaba();
	$degaba = $bout->Degaba($db);
	$anmile = $bout->Anmile();
	$anapog = $bout->Anapog();
	$anaboi = $bout->Anaboi();
	$bonote = $bout->Bonote();
	$degres = $bout->Degres();
	
	echo '<tr><td>Référence : </td><td><input type="text" name="rebout" maxlength="50" value="'.$bout->rebout().'" /></td></tr>';
}
else
{
	if (isset($_GET["revins"]) AND $_GET["revins"] <> 0)
	{
		$revins = $_GET["revins"] ;
	}
}

echo '<tr>';
echo '<td>vins</td>';
echo '<td>';
echo '<select id="revins"  name="revins">';
foreach ($mesvins as $unvins)
{
	$coul_dao = new coul_dao($db);
	$uncoul = $coul_dao->get($unvins->recoul());
	if ($unvins->revins() == $revins)
	{echo '<option value=',$unvins->revins(),' SELECTED>',$unvins->devins(),' - ',$uncoul->Decoul(),'</option>';}
	else
	{echo '<option value=',$unvins->revins(),'>',$unvins->devins(),' - ',$uncoul->Decoul(),'</option>';}
}
echo '</select>';
echo '</td>';
echo '</tr>';

echo '<tr>';
echo '<td>Gabarit</td>';
echo '<td>';
echo '<select id="regaba" name="regaba">';

foreach ($mesgaba as $ungaba)
{
	if ($ungaba->regaba() == $regaba)
	{echo '<option value=',$ungaba->regaba(),' SELECTED>',$ungaba->degaba(),'</option>';}
	else
	{echo '<option value=',$ungaba->regaba(),'>',$ungaba->degaba(),'</option>';}
}
echo '</select>';
echo '</td>';
echo '</tr>';

echo '<tr><td>Millfsime : </td><td><input type="text" name="anmile" value="'.$anmile.'" maxlength="10" /></td></tr>';
echo '<tr><td>Apogé : </td><td><input type="text" name="anapog" value="'.$anapog.'" maxlength="10" /></td></tr>';
echo '<tr><td>A boire avant : </td><td><input type="text" name="anaboi" value="'.$anaboi.'" maxlength="10" /></td></tr>';
echo '<tr><td>Note (/20) : </td><td><input type="text" name="bonote" value="'.$bonote.'" maxlength="10" /></td></tr>';
echo '<tr><td>Degrés alcool : </td><td><input type="text" name="degres" value="'.$degres.'" maxlength="10" /></td></tr>';
echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';
			
echo '</table>';

echo '</form>';

require '../index/footer.php';
?>

