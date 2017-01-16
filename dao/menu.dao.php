<?php
class menu_dao
{
private $_db;

public function __construct($db)
{
	$this->setDb($db);
}

public function add(menu $menu)
{
	$req = 'INSERT INTO menu (demenu,limenu,norang) VALUES ("'. $menu->demenu(). '","'. $menu->limenu(). '",'.$menu->norang().')';
	$q   = $this->_db->prepare($req);
	$q->execute();
}

public function delete($remenu)
{
	$this->_db->exec('DELETE FROM menu WHERE remenu = '.$remenu);
}

public function get($remenu)
{
	$unremenu = (int) $remenu;
	$q = $this->_db->query('SELECT * FROM menu WHERE remenu = '.$unremenu);
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new menu($donnees);
}

public function getLast()
{
	$q = $this->_db->query('SELECT * FROM menu WHERE remenu = (SELECT MAX(remenu) FROM menu);');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new menu($donnees);
}

public function getList()
{
	$menu_liste = array();

	$q = $this->_db->query('SELECT * FROM menu ORDER BY norang, remenu');

	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	{
		$menu_liste[] = new menu($donnees);
	}

	return $menu_liste;
}

public function update(menu $menu)
{
	$req = 'UPDATE menu SET demenu = "'.$menu->demenu().'", limenu = "'.$menu->limenu().'", norang = '.$menu->Norang().' WHERE remenu = '.$menu->remenu();
	$q = $this->_db->prepare($req);
	$q->execute();
}

public function setDb(PDO $db)
{
	$this->_db = $db;
}

}
?>