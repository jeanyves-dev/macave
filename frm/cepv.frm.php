<?php

require '../index/header.php';

require '../classe/cepv.class.php';
require '../classe/cepa.class.php';
require '../dao/cepv.dao.php';
require '../dao/cepa.dao.php';

require '../index/conn_db.php';

$revins = 0;
$recepa = 0;
$qtcepv = 0;

IF ((isset($_GET["revins"])) and (isset($_GET["recepa"])) and ($_GET["revins"] <> 0) and ($_GET["recepa"] <> 0))
{
	$cepv_dao = new cepv_dao($db);
	$cepv = $cepv_dao->get($_GET["revins"],$_GET["recepa"]);
	$revins = $cepv->Revins();
	$recepa = $cepv->Recepa();
	$qtcepv = $cepv->Qtcepv();
}

$cepa_dao = new cepa_dao($db);
$mescepa = $cepa_dao->getList();

echo '<form action="../gest/cepv.gest.php?ori='.$_GET["ori"].'&mode='.$_GET["mode"].'&revins='.$_GET["revins"].'"  method="post">';

echo '<table>';
echo '<tr>';
echo '<td>Cépage</td>';
echo '<td>';
echo '<select id="recepa" name="recepa">';
foreach ($mescepa as $uncepa)
{
	if ($uncepa->recepa() == $recepa)
	{echo '<option value=',$uncepa->recepa(),' SELECTED>',$uncepa->Decepa(),'</option>';}
	else
	{echo '<option value=',$uncepa->recepa(),'>',$uncepa->Decepa(),'</option>';}
}
echo '</select>';
echo '</td>';
echo '</tr>';
echo '<tr><td>Quantite : </td><td><input type="text" name="qtcepv" maxlength="50" value="'.$qtcepv.'" /></td></tr>';
echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';
echo '</table>';

echo '</form>';

require '../index/footer.php';

?>

