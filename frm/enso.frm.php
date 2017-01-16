<?php

require '../index/header.php';

require '../classe/enso.class.php';
require '../classe/bout.class.php';
require '../classe/vins.class.php';
require '../classe/four.class.php';
require '../classe/coul.class.php';
require '../classe/appr.class.php';
require '../dao/enso.dao.php';
require '../dao/bout.dao.php';
require '../dao/vins.dao.php';
require '../dao/four.dao.php';
require '../dao/coul.dao.php';
require '../dao/appr.dao.php';

require '../index/conn_db.php';

$four_dao = new four_dao($db);
$mesfour = $four_dao->getList();
$appr_dao = new appr_dao($db);
$mesappr = $appr_dao->getList();

$reenso = 0;
$rebout = 0;
$devins = "";
$refour = 0;
$defour = "";
$daenso = "";
$qtenso = 0;
$seenso = 0;
$reappr = 0;
$deappr = "";

IF (isset($_GET["reenso"]) AND ($_GET["reenso"] <> 0))
{
	$enso_dao = new enso_dao($db);
	$enso = $enso_dao->get($_GET["reenso"]);
	$bout_dao = new bout_dao($db);
	$mesbout = $bout_dao->getList();
	
	$reenso = $enso->Reenso();
	$rebout = $enso->Rebout();
	$devins = $enso->Devins($db);
	$refour = $enso->Refour();
	$defour = $enso->Defour($db);
	$daenso = $enso->Daenso();
	$qtenso = $enso->Qtenso();
	$seenso = $enso->Seenso();
	$reappr = $enso->Reappr();
	$deappr = $enso->Deappr($db);
	
	echo '<tr><td>Rérence : </td><td><input type="text" name="reenso" maxlength="50" value="'.$enso->reenso().'" /></td></tr>';
}
elseif (isset($_GET["rebout"]) AND $_GET["rebout"] <> 0)
{
	$rebout = $_GET["rebout"];
	if (isset($_GET["seenso"]))
	{$seenso = $_GET["seenso"];}
	$bout_dao = new bout_dao($db);
	$mesbout = $bout_dao->getList();
}
elseif (isset($_GET["revins"]) AND $_GET["revins"] <> 0)
{
	$bout_dao = new bout_dao($db);
	$mesbout = $bout_dao->getListeVins($_GET["revins"]);
	if (isset($_GET["seenso"]))
	{$seenso = $_GET["seenso"];}
}

echo '<form action="../gest/enso.gest.php?ori='.$_GET['ori'].'" method="post">';
echo '<table>';
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

echo '<tr>';
echo '<td>Fournisseur</td>';
echo '<td>';
echo '<select id="refour" name="refour">';

foreach ($mesfour as $unfour)
{
	if ($unfour->refour() == $refour)
	{echo '<option value=',$unfour->refour(),' SELECTED>',$unfour->defour(),'</option>';}
	else
	{echo '<option value=',$unfour->refour(),'>',$unfour->defour(),'</option>';}
}
echo '</select>';
echo '<input type="text" name="defour" maxlength="50" />';
echo '</td>';
echo '</tr>';

echo '<tr><td>Date</td><td><input type="date" name="daenso" value="'.$daenso.'" /></td></tr>';
echo '<tr><td>Quantité</td><td><input type="text" name="qtenso" maxlength="50" value="'.$qtenso.'" /></td></tr>';

if ($seenso == 2)
{
echo '<tr><td>Sens</td><td><INPUT type= "radio" name="seenso" value=1>Entrée';
echo '<INPUT type= "radio" name="seenso" value=2 checked>Sortie</td></tr>';
}
else
{
echo '<tr><td>Sens</td><td><INPUT type= "radio" name="seenso" value=1 checked>Entrée';
echo '<INPUT type= "radio" name="seenso" value=2>Sortie</td></tr>';
}

echo '<tr>';
echo '<td>Appréciation</td>';
echo '<td>';
echo '<select id="reappr" name="reappr">';

foreach ($mesappr as $unappr)
{
	if ($unappr->reappr() == $reappr)
	{echo '<option value=',$unappr->reappr(),' SELECTED>',$unappr->deappr(),'</option>';}
	else
	{echo '<option value=',$unappr->reappr(),'>',$unappr->deappr(),'</option>';}
}
echo '</select>';
echo '<input type="text" name="appr" maxlength="50" />';
echo '</td>';
echo '</tr>';

?>
			
			<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>
			
	</table>

</form>

<?php
require '../index/footer.php';
?>

