<?php

require '../index/header.php';

require '../classe/gaba.class.php';
require '../dao/gaba.dao.php';

require '../index/conn_db.php';

$gaba_dao = new gaba_dao($db);
$mesgaba = $gaba_dao->getList();

echo '<p><a href="../frm/gaba.frm.php?regaba=0">Ajouter un gaba</a></p>';

echo '<table border = 1>';
echo '<tr><td class="TitreListe">Référence</td><td class="TitreListe">Désignation</td><td class="TitreListe">Contenance</td><td colspan=2 class="TitreListe">Options</td></tr>';

if (empty($mesgaba))
{
  echo 'pas de gabarit !';
}
else
{
	foreach ($mesgaba as $ungaba)
	{
		echo '<tr>';
		echo '<td class="CelluleListe">', $ungaba->Regaba(), '</td>';
		echo '<td class="CelluleListe">', $ungaba->Degaba(), '</td>';
		echo '<td class="CelluleListe">', $ungaba->Conten(), '</td>';
		
		echo '<td class="CelluleListe"><a href=../frm/gaba.frm.php?regaba=',$ungaba->Regaba(),'>Modifier</a></td>';
		echo '<td class="CelluleListe"><a href=../gest/gaba.gest.php?regaba=',$ungaba->Regaba(),'&mode=del>Supprimer</a></td>';
		echo '</tr>';
	}
}
echo '</table>';

require '../index/footer.php';

?>
