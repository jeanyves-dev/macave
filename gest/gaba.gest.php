<?php

require '../classe/gaba.class.php';
require '../dao/gaba.dao.php';

require '../index/conn_db.php';

$gaba_dao = new gaba_dao($db);

if ($_GET['mode'] == "del")
{
	$gaba_dao->delete($_GET['regaba']);
}
else
{
	if (isset($_POST['degaba']) AND $_POST['degaba'] <>"")
	{
		
		if (isset($_POST["regaba"]) AND $_POST["regaba"] <> 0)
		{
			$donnees  = array('regaba'=>$_POST['regaba'],'degaba'=>$_POST['degaba'],'conten'=>$_POST['conten']);
			$gaba     = new gaba($donnees);
			$gaba_dao->update($gaba);
		}
		else
		{
			$donnees  = array('degaba'=>$_POST['degaba'],'conten'=>$_POST['conten']);
			$gaba     = new gaba($donnees);
			$gaba_dao->add($gaba);
		}

	}
}

header('Location: ../liste/gaba.liste.php');

require '../index/Footer.php';

?>