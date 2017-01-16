<?php

require '../index/header.php';

require '../classe/tbsd.class.php';
require '../dao/tbsd.dao.php';
require '../classe/tbse.class.php';
require '../dao/tbse.dao.php';

require '../index/conn_db.php';

$tbse_dao = new tbse_dao($db);
$mestbse = $tbse_dao->getList();

$codtab = "";
IF (isset($_POST['codtab']) AND $_POST['codtab'] <> "")
	{$codtab = $_POST['codtab'];}
	
IF (isset($_GET['codtab']) AND $_GET['codtab'] <> "")
	{$codtab = $_GET['codtab'];}


echo '<form action="../liste/tbsd.liste.php"  method="post">';
echo '<p>Tabelle <select id="codtab" name="codtab">';
foreach ($mestbse as $untbse)
{
	if ($untbse->Codtab() == $codtab)
		{echo '<option value=',$untbse->codtab(),' SELECTED>',$untbse->codtab(),' - ',$untbse->detbse(),'</option>';}
	else
		{echo '<option value=',$untbse->codtab(),'>',$untbse->codtab(),' - ',$untbse->detbse(),'</option>';}
}
echo '</select><input type="submit" value="Valider" name="Valider" /></p>';

IF ($codtab <> "")
{
	$tbsd_dao = new tbsd_dao($db);
	$mestbsd = $tbsd_dao->getList($codtab);
}
else
{
	$tbsd_dao = new tbsd_dao($db);
	$mestbsd = $tbsd_dao->getListEntiere();
}

echo '<p><a href="../frm/tbsd.frm.php?mode=add&codtab='.$codtab.'">Ajouter un entrée dans une tabelle</a></p>';

echo '<table border = 1>';
echo '<tr><td class="TitreListe">Référence</td><td class="TitreListe">Code tabelle</td><td class="TitreListe">Désignation</td><td colspan=2 class="TitreListe">Options</td></tr>';

if (empty($mestbsd))
{
  echo "pas d'entete de tabelle !";
}
else
{
	foreach ($mestbsd as $untbsd)
	{
		echo '<tr>';
		echo '<td class="CelluleListe">', $untbsd->Retbsd(), '</td>';
		echo '<td class="CelluleListe">', $untbsd->Codtab(), '</td>';
		echo '<td class="CelluleListe">', $untbsd->Detbsd(), '</td>';
		echo '<td class="CelluleListe"><a href=../frm/tbsd.frm.php?mode=upd&codtab='.$untbsd->Codtab().'&retbsd='.$untbsd->Retbsd().'>Modifier</a></td>';
		echo '<td class="CelluleListe"><a href=../gest/tbsd.gest.php?mode=del&codtab='.$untbsd->Codtab().'&retbsd='.$untbsd->Retbsd().'>Supprimer</a></td>';
		echo '</tr>';
	}
}
echo '</table>';

require '../index/Footer.php';

?>
