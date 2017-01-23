<?php

/* Calendrier de consommation */

require '../index/header.php';

require '../classe/bout.class.php';
require '../classe/vins.class.php';
require '../classe/gaba.class.php';
require '../classe/coul.class.php';
require '../classe/mvel.class.php';
require '../classe/mvsl.class.php';
require '../dao/bout.dao.php';
require '../dao/vins.dao.php';
require '../dao/gaba.dao.php';
require '../dao/coul.dao.php';
require '../dao/mvel.dao.php';
require '../dao/mvsl.dao.php';

require '../index/conn_db.php';

$bout_dao = new bout_dao($db);

$mesanaboi = $bout_dao->getListeDistAnaboi();

foreach ($mesanaboi as $unanaboi)
{

	IF ($unanaboi != 0)
	{
	
		$mesbout = $bout_dao->getListeABoire($unanaboi);
		echo '<p>', $unanaboi, '</p>';
		echo '<table border = 1>';
		echo '<tr>';
		echo '<td class="TitreListe">Référence</td>';
		echo '<td class="TitreListe">Vin</td>';
		echo '<td class="TitreListe">Couleur</td>';
		echo '<td class="TitreListe">Gabarit</td>';
		echo '<td class="TitreListe">Milésime</td>';
		echo '<td class="TitreListe">Apogé</td>';
		echo '<td class="TitreListe">A boire avant</td>';
		echo '<td class="TitreListe">Note (/20)</td>';
		echo '<td class="TitreListe">Stock</td>';
		echo '</tr>';

		if (empty($mesbout))
		{
		  echo 'pas de bouteille !';
		}
		else
		{
			foreach ($mesbout as $unbout)
			{
				$qte = $unbout->QtStock($db);
				if ($qte <> 0)
				{
					echo '<tr>';
					echo '<td>', $unbout->Rebout(), '</td>';
					echo '<td>', $unbout->Devins($db), '</td>';
					echo '<td>', $unbout->Decoul($db), '</td>';
					echo '<td>', $unbout->Degaba($db), '</td>';
					echo '<td>', $unbout->Anmile(), '</td>';
					echo '<td>', $unbout->Anapog(), '</td>';
					echo '<td>', $unbout->Anaboi(), '</td>';
					echo '<td>', $unbout->Bonote(), '</td>';
					echo '<td>', $unbout->QtStock($db), '</td>';
					echo '<td><a href=../gest/bout.gest.php?rebout=',$unbout->Rebout(),'&mode=del>Supprimer</a></td>';
					echo '</tr>';
				}
			}
		}
		echo '</table>';
	}
}

require '../index/footer.php';

?>
