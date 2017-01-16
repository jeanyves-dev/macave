<html>

<head>
	<LINK rel="stylesheet" type="text/css" href="../index/style.css">

	<title>Untitled Document</title>

	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.0/css/jquery.dataTables.css">
	<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.0/js/jquery.dataTables.js"></script>
	
	<script type="text/javascript" class="init">
		$(document).ready(function() {
			$('#tableListe').dataTable({
				"paging":   false,
				"searching": false,        
				"info":     false,
				"order": [ 1, 'desc' ]
			});
		} );
	</script>


</head>

<body>

<table border=1 class="TablePrincipal" cellpadding=0 cellspacing=0 >

	<tr>
		<td class="tdPrincipalHaut" colspan=2>
			<table class="tableEntete">
				<tr>
					<td class="tdPrincipalTitre">Ma cave à vin</td>
					<td class="tdBanniere"><img class="banner" src="../img/banniere.png"></td>
					<td class="tdAdmin">&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="tdPrincipalMenuGauche">
		
<?php

require '../classe/menu.class.php';
require '../dao/menu.dao.php';
require '../classe/mens.class.php';
require '../dao/mens.dao.php';

require '../index/conn_db.php';

$menu_dao = new menu_dao($db);
$mesmenu = $menu_dao->getList();

session_start();

$remenu = 0;
IF (isset($_GET['remenu']) AND $_GET['remenu'] > 0)
	{$remenu = $_GET['remenu'];}
elseif (isset($_SESSION['remenu']) AND $_SESSION['remenu'] > 0)
	{$remenu = $_SESSION['remenu'];}
$_SESSION['remenu'] = $remenu;
$mens_dao = new mens_dao($db);
$mesmens = $mens_dao->getListMenu($remenu);

echo '<table cellpadding=0 cellspacing=0>';

if (empty($mesmenu) == FALSE)
{
	foreach ($mesmenu as $unmenu)
	{
		echo '<tr><td class="tdMenuTitreGauche"><a class="aMenuTitreGauche" href="'.$unmenu->Limenu().'?remenu='.$unmenu->remenu().'">',$unmenu->Demenu(), '</a></td></tr>';
		
		IF ($unmenu->Remenu() == $remenu)
		{
			foreach ($mesmens as $unmens)
				{echo '<tr><td class="tdSousMenuTitreGauche"><a class="aSousMenuTitreGauche" href="'.$unmens->Limenu().'?remenu='.$unmens->Remenu().'">&nbsp;&nbsp;&nbsp;&nbsp;'.$unmens->Demens(), '</a></td></tr>';}
		}
			
	}
}
echo '</table>';

?>

		</td>

		<td class="tdPrincipalContenu">