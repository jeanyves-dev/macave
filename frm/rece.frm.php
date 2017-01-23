
<?php

require '../index/header.php';

require '../dao/rece.dao.php';
require '../classe/rece.class.php';
require '../dao/plat.dao.php';
require '../classe/plat.class.php';
require '../dao/rect.dao.php';
require '../classe/rect.class.php';

require '../index/conn_db.php';

IF ($_GET["rerece"] <> 0)
{
	$rece_dao = new rece_dao($db);
	$rece = $rece_dao->get($_GET["rerece"]);
}

$plat_dao = new plat_dao($db);
$mesplat = $plat_dao->getList();
$rect_dao = new rect_dao($db);
$mesrect = $rect_dao->getList();

$rerece = 0;
$derece = "";
$replat = 0;
$rerect = 0;

echo '<form action="../gest/rece.gest.php"  method="post">';

echo '<table>';

if ($_GET["rerece"] <> 0)
{

	$rerece = $rece->Rerece();
	$derece = $rece->Derece();
	$replat = $rece->Replat();
	$rerect = $rece->Rerect();
	
	echo '<tr><td>Référence : </td><td><input type="text" name="rerece" maxlength="50" value="'.$rece->rerece().'" /></td></tr>';
}

echo '<tr><td>Nom : </td><td><input type="text" name="derece" maxlength="50" value="'.$derece.'" /></td></tr>';

echo '<tr><td>Plat : </td><td><select id="replat" name="replat">';
foreach ($mesplat as $unplat)
{
	if ($unplat->replat() == $replat)
		{echo '<option value=',$unplat->replat(),' SELECTED>',$unplat->deplat(),'</option>';}
	else
		{echo '<option value=',$unplat->replat(),'>',$unplat->deplat(),'</option>';}
}
echo '</select></td></tr>';

echo '<tr><td>Type : </td><td><select id="rerect" name="rerect">';
foreach ($mesrect as $unrect)
{
	if ($unrect->rerect() == $rerect)
		{echo '<option value=',$unrect->rerect(),' SELECTED>',$unrect->derect(),'</option>';}
	else
		{echo '<option value=',$unrect->rerect(),'>',$unrect->derect(),'</option>';}
}
echo '</select></td></tr>';

echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';
echo '</table>';

echo '</form>';

require '../index/footer.php';

?>
