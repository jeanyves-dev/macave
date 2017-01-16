<?php

// Récupération de la liste
$vins_dao = new vins_dao($db);
$mesvins = $vins_dao->getListFavori();

/* Entête du tableau */
echo '<table class="tableDetailAccueil" cellspacing=0>';
echo '<tr><td class="tdTitreDetailAccueil" colspan=5>Mes vins favoris (5)</td></tr>';
echo '<tr>';
echo '<td>';

echo '<table>';
echo '<tr>';
echo '<td>Désignation</td>';
echo '<td>Pays</td>';
echo '<td>Région</td>';
echo '<td>Appellation</td>';
echo '<td>Couleur</td>';
echo '</tr>';

/* Lignes du tableau */
foreach ($mesvins as $unvins)
{
	echo '<tr>';
	echo '<td class="CelluleListe">', $unvins->Devins(), '</td>';
	echo '<td class="CelluleListe">', $unvins->Depays($db), '</td>';
	echo '<td class="CelluleListe">', $unvins->Deregi($db), '</td>';
	echo '<td class="CelluleListe">', $unvins->Deappe($db), '</td>';
	echo '<td class="CelluleListe">', $unvins->Decoul($db), '</td>';
	echo '</tr>';
}
echo '</table>';

echo '</td>';
echo '</tr>';
echo '</table>';

?>
