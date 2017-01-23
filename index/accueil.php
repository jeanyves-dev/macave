
<?php

	require '../index/header.php';
	
	require '../classe/vins.class.php';
	require '../classe/pays.class.php';
	require '../classe/regi.class.php';
	require '../classe/appe.class.php';
	require '../classe/coul.class.php';
	require '../dao/vins.dao.php';
	require '../dao/pays.dao.php';
	require '../dao/regi.dao.php';
	require '../dao/appe.dao.php';
	require '../dao/coul.dao.php';
	require '../dao/mvel.dao.php';
	require '../dao/mvsl.dao.php';
	
	require '../index/conn_db.php';
	
	echo '<table class="TableAccueil">';
	
	echo '<tr>';
	
	/* Favoris */
	echo '<td class="tdAccueil">';
	require '../tablebord/favoris.php';
	echo '</td>';
	/* Options */
	echo '<td class="tdAccueil">';
	require '../tablebord/option.php';
	echo '</td>';
	
	echo '</tr>';
	echo '<tr>';
	
	/* Alertes */
	echo '<td class="tdAccueil">Alertes</td>';
	/* Inventaire */
	echo '<td class="tdAccueil">';
	require '../tablebord/inventaire.php';
	echo '</td>';
	
	echo '</tr>';
	echo '<tr>';
	
	/* Echéancier */
	echo '<td class="tdAccueil">Echéancier</td>';
	/* Prochaine RDV */
	echo '<td class="tdAccueil">Les prochains Rendez vous</td>';
	
	echo '</tr>';
	
	echo '</table>';
	
	
	require '../index/footer.php';
?>




