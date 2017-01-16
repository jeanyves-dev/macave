<?php

require '../index/header.php';

require '../classe/four.class.php';
require '../dao/four.dao.php';



require '../index/conn_db.php';

$four_dao = new four_dao($db);
$mesfour = $four_dao->getList();

echo '<p><a href="../frm/four.frm.php?refour=0">Ajouter un fournisseur</a></p>';

echo '<table border = 1>';
echo '<tr>';
echo '<td class="TitreListe">Référence</td>';
echo '<td class="TitreListe">Désignation</td>';
echo '<td class="TitreListe">Adresse 1</td>';
echo '<td class="TitreListe">Adresse 2</td>';
echo '<td class="TitreListe">Code postal</td>';
echo '<td class="TitreListe">Ville</td>';
echo '<td class="TitreListe">Téléphone</td>';
echo '<td class="TitreListe">Fax</td>';
echo '<td class="TitreListe">Mail</td>';
echo '<td class="TitreListe">Site web</td>';
echo '</tr>';

if (empty($mesfour))
{
  echo 'pas de fournisseur !';
}
else
{
	foreach ($mesfour as $unfour)
	{
		echo '<tr>';
		echo '<td class="CelluleListe">', $unfour->Refour(), '</td>';
		echo '<td class="CelluleListe">', $unfour->Defour(), '</td>';
		echo '<td class="CelluleListe">', $unfour->Adresa(), '</td>';
		echo '<td class="CelluleListe">', $unfour->Adresb(), '</td>';
		echo '<td class="CelluleListe">', $unfour->Codpos(), '</td>';
		echo '<td class="CelluleListe">', $unfour->Villef(), '</td>';
		echo '<td class="CelluleListe">', $unfour->Numtel(), '</td>';
		echo '<td class="CelluleListe">', $unfour->Numfax(), '</td>';
		echo '<td class="CelluleListe">', $unfour->Admail(), '</td>';
		echo '<td class="CelluleListe">', $unfour->Sitweb(), '</td>';
		
		echo '<td class="CelluleListe"><a href=../frm/four.frm.php?refour=',$unfour->Refour(),'>Modifier</a></td>';
		echo '<td class="CelluleListe"><a href=../gest/four.gest.php?refour=',$unfour->Refour(),'&mode=del>Supprimer</a></td>';
		echo '</tr>';
	}
}
echo '</table>';

require '../index/footer.php';

?>
