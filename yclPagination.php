<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of yclPagination
 *
 * @author popsa
 */
class yclPagination {
   public $no_pages, $next_page, $prev_page, $current_page;
   private $db_start_point, $total_no_items, $rows_per_page;
   
   function __construct($total_no_items, $rows_per_page, $current_page=1) {
      $this->current_page = floor($current_page) <= 0 ? 1 : floor($current_page);
      $this->rows_per_page = $rows_per_page;
      $this->total_no_items = $total_no_items;
      
      $this->setNoPages();
      $this->setNav($current_page);
      $this->setDBStart();
   }
   
   private function setNav() {
      $this->next_page = ($this->current_page >= $this->no_pages) ? $this->no_pages : ($this->current_page+1);
      $this->prev_page = ($this->current_page > 1) ? ($this->current_page-1) : 1;
   }

   private function setNoPages() {
      $div_raw = $this->total_no_items / $this->rows_per_page;
      $floored = ceil($div_raw);
      $difference = $div_raw - $floored;
      
      $this->no_pages = ($difference > 0) ? $floored++ : $floored;
   }

   private function setDBStart() {
      $this->db_start_point = ($this->current_page * $this->rows_per_page) - $this->rows_per_page;
   }
   
   public function getDBStartPoint() {
      return floor($this->db_start_point);
   }

}
