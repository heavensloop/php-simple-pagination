<?php
	require_once "yclPagination.php";
	
	try {
		$db = new mysqli('localhost', 'root', 'pass', 'sme-manager');
	} catch(Exception $e) {
		$db = null;
	}
	
	$pn = new yclPagination(2, filter_input(INPUT_GET, 'page'));
	$sql_query = "SELECT * FROM users WHERE true=true";
	$query = $pn->setFullQuery($sql_query, 'id');
	
	$db->query($query);
	$pn_query = $db->query($pn->getSelectQuery($db->affected_rows));
	
	$output = array();
	$no_rows = $pn_query->num_rows;
	
	while ($no_rows > 0) {
		$output[] = $pn_query->fetch_object();
		$no_rows--;
	}
	
	var_dump($pn);
	
	var_dump($output);
?>