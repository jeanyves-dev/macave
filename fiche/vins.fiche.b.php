<?php

require '../index/header.php';

require '../classe/vins.class.php';
require '../classe/pays.class.php';
require '../classe/regi.class.php';
require '../classe/appe.class.php';
require '../classe/prod.class.php';
require '../classe/coul.class.php';
require '../classe/gaba.class.php';
require '../classe/bout.class.php';
require '../classe/mvel.class.php';
require '../classe/mvsl.class.php';
require '../classe/cepv.class.php';
require '../classe/four.class.php';
require '../classe/appr.class.php';
require '../classe/cepa.class.php';
require '../classe/typv.class.php';
require '../classe/clas.class.php';
require '../classe/rang.class.php';
require '../classe/tbsd.class.php';
require '../dao/vins.dao.php';
require '../dao/pays.dao.php';
require '../dao/regi.dao.php';
require '../dao/appe.dao.php';
require '../dao/prod.dao.php';
require '../dao/coul.dao.php';
require '../dao/gaba.dao.php';
require '../dao/bout.dao.php';
require '../dao/mvel.dao.php';
require '../dao/mvsl.dao.php';
require '../dao/cepv.dao.php';
require '../dao/four.dao.php';
require '../dao/appr.dao.php';
require '../dao/cepa.dao.php';
require '../dao/typv.dao.php';
require '../dao/clas.dao.php';
require '../dao/rang.dao.php';
require '../dao/tbsd.dao.php';


require '../index/conn_db.php';


IF ($_GET["revins"] <> 0)
{
	$vins_dao = new vins_dao($db);
	$bout_dao = new bout_dao($db);
	
	$vins = $vins_dao->get($_GET["revins"]);
	
	echo '<table cellpadding=0 cellspacing=0 class="tableFiche" width=100%>';
	
	echo '<tr>';
	echo '<th class="thFiche1"><a href=../fiche/vins.fiche.a.php?revins=',$vins->Revins(),'&rebout=0>La reserve</a></th>';
	echo '<th class="thFicheEnCours">Fiche du vin</th>';
	echo '<th class="thFiche1"><a href=../fiche/vins.fiche.c.php?revins=',$vins->Revins(),'>Cépage</a></th>';
	echo '<th class="thFiche1"><a href=../fiche/vins.fiche.d.php?revins=',$vins->Revins(),'>Accord mets / vins</a></th>';
	echo '<th class="thFiche1"><a href=../fiche/vins.fiche.e.php?revins=',$vins->Revins(),'>Dégustation</a></th>';
	echo '<th class="thFiche1"><a href=../fiche/vins.fiche.f.php?revins=',$vins->Revins(),'>Récompense</a></th>';
	echo '</tr>';

	
	echo '<tr>';
	
	echo '<td colspan=6 class="tdFiche1">';
	
	echo '<table cellpadding=0 cellspacing=0>';
	echo '<tr><th class="thFiche3">Options</th><th>&nbsp;</th><th class="thFiche3">Identification</th><th>&nbsp;</th><th class="thFiche3">Producteur</th><th>&nbsp;</th><th class="thFiche3">Statistique</th></tr>';
	echo '<tr>';
	
	/* Affiche des options */
	echo '<td class="tdFiche3">';
	echo '<p><a href="../frm/vins.frm.php?revins='.$vins->Revins().'">Modifier ce vins</a></p>';
	echo '<p><a href="../frm/bout.frm.php?revins='.$vins->Revins().'&ori=vins.fiche">Ajouter une bouteille</a></p>';
	echo '<p><a href="../frm/cepv.frm.php?mode=ajt&ori=vins.fiche&revins='.$vins->Revins().'">Entrer des bouteilles</a></p>';
	echo '<p><a href="../frm/cepv.frm.php?mode=ajt&ori=vins.fiche&revins='.$vins->Revins().'">Sortir des bouteilles</a></p>';
	echo '<p><a href="../frm/cepv.frm.php?mode=ajt&ori=vins.fiche&revins='.$vins->Revins().'">Ajouter aux favoris</a></p>';
	echo '</td>';
	
	echo '<td class="tdSeparationFiche">&nbsp;</td>';
	
	/* Affichage du vin */
	echo '<td class="tdFiche3">';
	echo '<table>';
	echo '<tr><td><b>Référence</b></td><td>'.$vins->Revins().'</td></tr>';
	echo '<tr><td><b>Désignation</b></td><td>'.$vins->Devins().'</td></tr>';
	echo '<tr><td><b>Cuvée</b></td><td>'.$vins->Cuvins().'</td></tr>';
	echo '<tr><td><b>Autre libellé</b></td><td>'.$vins->Devinb().'</td></tr>';
	echo '<tr><td><b>Pays</b></td><td>'.$vins->Depays($db).'</td></tr>';
	echo '<tr><td><b>Région</b></td><td>'.$vins->Deregi($db).'</td></tr>';
	echo '<tr><td><b>Appellation</b></td><td>'.$vins->Deappe($db).'</td></tr>';
	echo '<tr><td><b>Producteur</b></td><td>'.$vins->Deprod($db).'</td></tr>';
	echo '<tr><td><b>Couleur</b></td><td>'.$vins->Decoul($db).'</td></tr>';
	echo '<tr><td><b>Type de vin</b></td><td>'.$vins->Detypv($db).'</td></tr>';
	echo '<tr><td><b>Classement</b></td><td>'.$vins->Declas($db).'</td></tr>';

	echo '</table>';
	echo '</td>';
	
	echo '<td class="tdSeparationFiche">&nbsp;</td>';
	
	/* Producteur */
	$prod_dao = new prod_dao($db);
	$prod = $prod_dao->get($vins->Reprod());
	echo '<td class="tdFiche3">';
	echo '<table>';
	echo '<tr><td><b>Référence</b></td><td>'.$prod->Reprod().'</td></tr>';
	echo '<tr><td><b>Propriété</b></td><td>'.$prod->Detyprop($db).'</td></tr>';
	echo '<tr><td><b>Nom</b></td><td>'.$prod->Deprod().'</td></tr>';
	echo '<tr><td><b>Adresse</b></td><td>'.$prod->Adresa().'</td></tr>';
	echo '<tr><td><b>Complément</b></td><td>'.$prod->Adresb().'</td></tr>';
	echo '<tr><td><b>Code postale</b></td><td>'.$prod->Codpos().'</td></tr>';
	echo '<tr><td><b>Ville</b></td><td>'.$prod->Villep($db).'</td></tr>';
	echo '<tr><td><b>Adresse mail</b></td><td><a href="mailto:'.$prod->Admail().'">'.$prod->Admail().'</a></td></tr>';
	echo '<tr><td><b>Site internet</b></td><td><a href="http://'.$prod->Adrweb().'">'.$prod->Adrweb().'</a></td></tr>';
	echo '</table>';
	echo '</td>';
	
	echo '<td class="tdSeparationFiche">&nbsp;</td>';
	
	/* Statistique */
	echo '<td class="tdFiche3">';
	echo '<table>';
	echo '<tr><td><b>Nombre de bouteille</b></td><td>'.$vins->NbrBout($db).'</td></tr>';
	echo '<tr><td><b>Quantité total en stock</b></td><td>'.$vins->QteStkTot($db).'</td></tr>';
	echo "<tr><td><b>Nombre d'entrée</b></td><td>".$vins->NbrEnt($db)."</td></tr>";
	echo "<tr><td><b>Nombre de sortie</b></td><td>".$vins->NbrSor($db)."</td></tr>";
	echo "<tr><td><b>Nombre de bouteille rangées</b></td><td>".$vins->NbrRan($db)."</td></tr>";
	echo '</table>';
	echo '</td>';
	
	echo '</tr>';
	
	echo '</table>';
	
	echo '</td>';
	
	echo '</tr>';
	echo '</table>';
	

}

require '../index/Footer.php';

?>