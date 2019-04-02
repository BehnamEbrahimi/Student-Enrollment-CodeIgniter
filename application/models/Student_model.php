<?php
class Student_model extends CI_Model{

	function save_student(){
		
		$data = array(
				'student_id' 	=> $this->input->post('student_id'), 
				'student_first_name' 	=> $this->input->post('student_first_name'), 
				'student_last_name' => $this->input->post('student_last_name'), 
			);
		$result = $this->db->insert('student',$data);
		return $result;
	}
}