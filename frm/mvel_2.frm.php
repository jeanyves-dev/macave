
<?php

require '../index/header.php';

require '../dao/mvel.dao.php';
require '../classe/mvel.class.php';
require '../dao/mven.dao.php';
require '../classe/mven.class.php';
require '../dao/bout.dao.php';
require '../classe/bout.class.php';
require '../dao/vins.dao.php';
require '../classe/vins.class.php';
require '../dao/coul.dao.php';
require '../classe/coul.class.php';
require '../dao/appr.dao.php';
require '../classe/appr.class.php';

require '../index/conn_db.php';

$remvel = 0;
$remven = 0;
$nomvel = "";
$qtmvel = 1;
$mtbout = "";

$rebout = $_POST['rebout'];

echo '<form action="../gest/mvel.gest.php?remven='.$_GET["remven"].'"  method="post">';

echo '<table>';

if (isset($_GET["remvel"]) AND $_GET["remvel"] <> 0)
{
	$mvel_dao = new mvel_dao($db);
	$mvel = $mvel_dao->get($_GET["remvel"]);
	$remvel = $mvel->remvel();
	$remven = $mvel->remven();
	$rebout = $mvel->rebout();
	$nomvel = $mvel->nomvel();
	$qtmvel = $mvel->qtmvel();
	echo '<tr><td>Référence : </td><td><input type="text" name="remvel" maxlength="50" value="'.$remvel.'" /></td></tr>';
	$mtbout = "";
}
else
{
	$mtbout = '<tr><td>Tarif : </td><td><input type="text" name="mtbout" maxlength="50" value="'.$mtbout.'" /></td></tr>';
}

echo '<tr>';
echo '<td>Ref bouteille : </td>';
echo '<td><input type="text" name="rebout" maxlength="50" value="'.$rebout.'" /></td>';
echo '</tr>';

echo '<tr><td>Commentaire : </td><td><input type="text" name="nomvel" maxlength="50" value="'.$nomvel.'" /></td></tr>';
echo '<tr><td>Quantité : </td><td><input type="text" name="qtmvel" maxlength="50" value="'.$qtmvel.'" /></td></tr>';
echo $mtbout;
echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';

echo '</table>';

echo '</form>';

require '../index/footer.php';

?>
