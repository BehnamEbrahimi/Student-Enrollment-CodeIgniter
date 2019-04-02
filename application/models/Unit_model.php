<?php
class Unit_model extends CI_Model{

    function load_pm(){
			
			$result = $this->db->get('unit');
			return $result->result_array();
	}	
}