<?php

/**
 * Pagination Helper
 *
 * @author Popsana Barida
 * @link https://yeastycode.com YeastyCode
 */
class yclPagination {
	/**
	 * @var type int Number of pages.
	 */
	public $no_pages;
	
	/**
	 * @var type int Next Page
	 */
	public $next_page;
	
	/**
	 * @var int Previous page
	 */
	public $prev_page;
	
	/**
	 *
	 * @var int Current Page
	 */
	public $current_page;
	
	private $db_start_point;
	private $total_no_items;
	private $max_no_rows;

	/**
	 * 
	 * @param type $max_no_rows The number of rows you want to display at a time.
	 * @param type $current_page
	 */
	function __construct($max_no_rows, $current_page = 1) {
		$this->current_page = floor($current_page) <= 0 ? 1 : floor($current_page);
		$this->max_no_rows = $max_no_rows;
	}

	/**
	 * 
	 * @param type $total_no_items The total number of items in the database
	 */
	function setItemCount($total_no_items) {
		$this->total_no_items = $total_no_items;

		$this->setNoPages();
	}

	/**
	 * Set the number of pages available..
	 */
	private function setNoPages() {
		$div_raw = $this->total_no_items / $this->max_no_rows;
		$floored = ceil($div_raw);
		$difference = $div_raw - $floored;

		$this->no_pages = ($difference > 0) ? $floored++ : $floored;
		
		$this->setNav();
	}

	/**
	 * Compute Nagivation
	 */
	private function setNav() {
		$this->next_page = ($this->current_page >= $this->no_pages) ? $this->no_pages : ($this->current_page + 1);
		$this->prev_page = ($this->current_page > 1) ? ($this->current_page - 1) : 1;
		
		$this->setDBStart();
	}

	/**
	 * Set the database's start point (for LIMIT)
	 */
	private function setDBStart() {
		$this->db_start_point = ($this->current_page * $this->max_no_rows) - $this->max_no_rows;
	}

	/**
	 * 
	 * @return int DB Start Point
	 */
	public function getDBStartPoint() {
		return floor($this->db_start_point);
	}

	private $query = "";

	/**
	 * 
	 * @param type $query
	 * @return string Your original sql query
	 */
	function setFullQuery($query) {
		$this->query = $query;
		
		return $query;
	}

	private $select_query = "";
	
	/**
	 * 
	 * @param type $total_no_items total number of for this query
	 * @return string Your sql query with limit
	 */
	function getSelectQuery($total_no_items) {
		$this->setItemCount($total_no_items);
		$f1 = str_replace(";", "", $this->query);
		$f2 = preg_replace("/^LIMIT.+/", "", $f1);
		$f3 = $f2 . " LIMIT {$this->getDBStartPoint()},{$this->max_no_rows};";
		$this->select_query = $f3;

		return $f3;
	}

}
