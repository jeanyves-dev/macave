
<?php

require '../index/header.php';

require '../dao/degl.dao.php';
require '../classe/degl.class.php';
require '../dao/degu.dao.php';
require '../classe/degu.class.php';
require '../dao/bout.dao.php';
require '../classe/bout.class.php';
require '../dao/vins.dao.php';
require '../classe/vins.class.php';
require '../dao/coul.dao.php';
require '../classe/coul.class.php';
require '../dao/appr.dao.php';
require '../classe/appr.class.php';

require '../index/conn_db.php';

$redegl = 0;
$redegu = 0;
$odorat = "";
$visuel = "";
$bouche = "";
$codegl = "";

$rebout = $_POST['rebout'];

echo '<form action="../gest/degl.gest.php?redegu='.$_GET["redegu"].'"  method="post">';

echo '<table>';

if (isset($_GET["redegl"]) AND $_GET["redegl"] <> 0)
{
	$degl_dao = new degl_dao($db);
	$degl = $degl_dao->get($_GET["redegl"]);
	
	$redegl = $degl->redegl();
	$redegu = $degl->redegu();
	$rebout = $degl->rebout();
	$odorat = $degl->odorat();
	$visuel = $degl->visuel();
	$bouche = $degl->bouche();
	$codegl = $degl->codegl();

	echo '<tr><td>Référence : </td><td><input type="text" name="redegl" maxlength="50" value="'.$redegl.'" /></td></tr>';
	
}

echo '<tr>';
echo '<td>Ref bouteille : </td>';
echo '<td><input type="text" name="rebout" maxlength="50" value="'.$rebout.'" /></td>';
echo '</tr>';

echo '<tr><td>visuel : </td><td><input type="text" name="visuel" maxlength="50" value="'.$visuel.'" /></td></tr>';
echo '<tr><td>Nez : </td><td><input type="text" name="odorat" maxlength="50" value="'.$odorat.'" /></td></tr>';
echo '<tr><td>bouche : </td><td><input type="text" name="bouche" maxlength="50" value="'.$bouche.'" /></td></tr>';
echo '<tr><td>Commentaire : </td><td><input type="text" name="codegl" maxlength="50" value="'.$codegl.'" /></td></tr>';
echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';

echo '</table>';

echo '</form>';

require '../index/Footer.php';

?>
