<?php

require '../index/header.php';

require '../classe/prod.class.php';
require '../dao/prod.dao.php';
require '../classe/tbsd.class.php';
require '../dao/tbsd.dao.php';

require '../index/conn_db.php';

$prod_dao = new prod_dao($db);
$mesprod = $prod_dao->getList();

echo '<p><a href="../frm/prod.frm.php?reprod=0">Ajouter un producteur</a></p>';

echo '<table border = 1>';
echo '<tr>';
echo '<td class="TitreListe">Référence</td>';
echo '<td class="TitreListe">Propriété</td>';
echo '<td class="TitreListe">Désignation</td>';
echo '<td class="TitreListe">Adresse 1</td>';
echo '<td class="TitreListe">Adresse 2</td>';
echo '<td class="TitreListe">Code postal</td>';
echo '<td class="TitreListe">Ville</td>';
echo '<td class="TitreListe">Mail</td>';
echo '<td class="TitreListe">Web</td>';
echo '</tr>';

if (empty($mesprod))
{
  echo 'pas de producteur !';
}
else
{
	foreach ($mesprod as $unprod)
	{
		echo '<tr>';
		echo '<td class="CelluleListe">', $unprod->Reprod(), '</td>';
		echo '<td class="CelluleListe">', $unprod->Detyprop($db), '</td>';
		echo '<td class="CelluleListe">', $unprod->Deprod(), '</td>';
		echo '<td class="CelluleListe">', $unprod->Adresa(), '</td>';
		echo '<td class="CelluleListe">', $unprod->Adresb(), '</td>';
		echo '<td class="CelluleListe">', $unprod->Codpos(), '</td>';
		echo '<td class="CelluleListe">', $unprod->Villep(), '</td>';
		echo '<td class="CelluleListe">', $unprod->Admail(), '</td>';
		echo '<td class="CelluleListe">', $unprod->Adrweb(), '</td>';

		echo '<td class="CelluleListe"><a href=../frm/prod.frm.php?reprod=',$unprod->Reprod(),'>Modifier</a></td>';
		echo '<td class="CelluleListe"><a href=../gest/prod.gest.php?reprod=',$unprod->Reprod(),'&mode=del>Supprimer</a></td>';
		echo '</tr>';
	}
}
echo '</table>';

require '../index/footer.php';

?>
