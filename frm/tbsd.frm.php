<?php

require '../index/header.php';

require '../dao/tbsd.dao.php';
require '../classe/tbsd.class.php';
require '../dao/tbse.dao.php';
require '../classe/tbse.class.php';

require '../index/conn_db.php';

$codtab = "";
$retbsd = "";
$detbsd = "";

IF (isset($_GET["codtab"]) AND $_GET["codtab"] <> "")
	{$codtab = $_GET["codtab"];}

IF (isset($_GET["retbsd"]) AND $_GET["retbsd"] <> "" AND isset($_GET["codtab"]) AND $_GET["codtab"] <> "")
{
	$tbsd_dao = new tbsd_dao($db);
	$tbsd = $tbsd_dao->get($_GET["codtab"], $_GET["retbsd"]);
	$codtab = $tbsd->Codtab();
	$retbsd = $tbsd->Retbsd();
	$detbsd = $tbsd->Detbsd();
}

IF (isset($_GET["mode"]) AND $_GET["mode"] == "upd")
	{echo '<form action="../gest/tbsd.gest.php?mode=upd"  method="post">';}
else
	{echo '<form action="../gest/tbsd.gest.php?mode=add"  method="post">';}
	
echo '<table>';

$tbse_dao = new tbse_dao($db);
$mestbse = $tbse_dao->getList();
echo '<tr><td>Code tabelle : </td><td><select id="codtab" name="codtab">';
foreach ($mestbse as $untbse)
{
	if ($untbse->codtab() == $codtab)
		{echo '<option value=',$untbse->Codtab(),' SELECTED>',$untbse->Codtab(),'</option>';}
	else
		{echo '<option value=',$untbse->Codtab(),'>',$untbse->Codtab(),'</option>';}
}
echo '</select></td></tr>';


echo '<tr><td>Référence : </td><td><input type="text" name="retbsd" maxlength="50" value="'.$retbsd.'" /></td></tr>';
echo '<tr><td>Designation : </td><td><input type="text" name="detbsd" maxlength="50" value="'.$detbsd.'" /></td></tr>';

echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';
echo '</table>';

echo '</form>';

require '../index/footer.php';

?>

