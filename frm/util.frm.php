<?php

require '../index/header.php';

require '../dao/util.dao.php';
require '../classe/util.class.php';
require '../index/conn_db.php';

$inutil = "";
$mputil = "";
$noutil = "";
$prutil = "";

echo $_GET["inutil"];

IF ($_GET["inutil"] <> "")
{
	$util_dao = new util_dao($db);
	$util = $util_dao->get($_GET["inutil"]);
	$inutil = $util->inutil();
	$mputil = $util->mputil();
	$noutil = $util->noutil();
	$prutil = $util->prutil();
	
	echo "salut";
}

echo '<form action="../gest/util.gest.php?inutil='.$_GET["inutil"].'"  method="post">';

echo '<table>';
echo '<tr><td>Initiales : </td><td><input type="text" name="inutil" maxlength="50" value="'.$inutil.'" /></td></tr>';

echo '<tr><td>Mot de passe  : </td><td><input type="text" name="mputil" maxlength="50" value="'.$mputil.'" /></td></tr>';
echo '<tr><td>Nom : </td><td><input type="text" name="noutil" maxlength="50" value="'.$noutil.'" /></td></tr>';
echo '<tr><td>Prénom : </td><td><input type="text" name="prutil" maxlength="50" value="'.$prutil.'" /></td></tr>';

echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';
echo '</table>';

echo '</form>';

require '../index/footer.php';

?>

