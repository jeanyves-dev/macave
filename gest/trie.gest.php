<?php

require '../classe/trie.class.php';
require '../dao/trie.dao.php';

require '../index/conn_db.php';

$trie_dao = new trie_dao($db);

if ($_GET['mode'] == "del")
{
	$trie_dao->delete($_GET['retabl']);
}
else
{
	if (isset($_GET['retabl']) AND $_GET['retabl'] <> "")
	{
		$trie = $trie_dao->getTabl($_GET['retabl']);
		if ($trie->Retabl() == '')
		{
			$donnees  = array('retabl'=>$_GET['retabl'],'champs'=>$_GET['champs'],'senstr'=>$_GET['senstr']);
			$trie     = new trie($donnees);
			$trie_dao->add($trie);
		}
		else
		{
			$donnees  = array('retabl'=>$_GET['retabl'],'champs'=>$_GET['champs'],'senstr'=>$_GET['senstr']);
			$trie     = new trie($donnees);
			$trie_dao->update($trie);
		}

	}
}

header('Location: ../liste/'.$_GET['origin'].'.php');

require '../index/footer.php';

?>