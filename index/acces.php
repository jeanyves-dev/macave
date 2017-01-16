<?php

switch ($_POST['option'])
{
	/* Ajouter une bouteille depuis la liste des vins */
	case 1: 
		$lien = '../frm/bout.frm.php?ori=vins.liste&revins='.$_POST["revins"];
		header("Location: $lien");
		break;
		
	/* Visu des bouteilles d'un vin */
	case 2:
		$lien = '../liste/bout.liste.php?revins='.$_POST["revins"];
		header("Location: $lien");
		break;
	
	/* Entrer des bouteilles dans le stock */
	case 100:
		$lien = '../frm/enso.frm.php?ori=bout.liste&seenso=1&rebout='.$_POST["rebout"];
		header("Location: $lien");
		break;
		
	/* Sortir des bouteilles du stock */
	case 101:
		$lien = '../frm/enso.frm.php?ori=bout.liste&seenso=2&rebout='.$_POST["rebout"];
		header("Location: $lien");
		break;
		
	/* Visu entrer et sortie pour une bouteille */
	case 102:
		$lien = '../liste/enso.liste.php?rebout='.$_POST["rebout"];
		header("Location: $lien");
		break;
}

?>