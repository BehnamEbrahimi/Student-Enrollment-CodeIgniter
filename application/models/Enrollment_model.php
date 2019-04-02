<?php
class Enrollment_model extends CI_Model{

	function __construct() {

		parent::__construct();
		$this->load->model('unit_model');
	  }

	function save_pm_for_student(){

		$pm = $this->unit_model->load_pm();	
		$data = array();

		foreach ($pm as $row) {
			$dummy = array(
				'student_id' 	=> $this->input->post('student_id'), 
				'unit_id' 	=> $row['unit_id'], 
				'status' 	=> 'not enrolled',
				'grade' 	=> '',
				'period' 	=> '',
				'institution' 	=> '',
				'is_pickable' 	=> '',
				'is_freezed' => 0,
				
			);
			array_push($data, $dummy);
		}
		
		$result = $this->db->insert_batch('enrollment', $data);
		return $result;
	}

	function load_pm_for_student(){

	$student_id = $this->input->post('student_id');
	$this->db->select('enrollment.*,unit.*');
    $this->db->from('enrollment');
    $this->db->join('unit', 'enrollment.unit_id = unit.unit_id', 'left');
    $this->db->where('enrollment.student_id',$student_id);
	$result1=$this->db->get()->result_array();

	for ($i = 0; $i < sizeof($result1); $i++) {
		$result1[$i]['is_pickable'] = 0;
		if ($result1[$i]['status'] == 'enrolled' || $result1[$i]['status'] == 'not enrolled'){
			if ($result1[$i]['unit_prerequisite'] == null) {
				$result1[$i]['is_pickable'] = 1;
			} else {
				for ($j = 0; $j < sizeof($result1); $j++) {
					if (($result1[$j]['unit_id'] == $result1[$i]['unit_prerequisite']) && ($result1[$j]['status'] =='passed')) {
						$result1[$i]['is_pickable'] = 1;
					}
				}
			}
	}}
	

	$this->db->where('student_id', $student_id);
	$result2=$this->db->get('student')->result_array();

	$result = array_merge($result2, $result1);
	return $result;
	}

	function edit_pm_for_student(){
		$student_id=$this->input->post('student_id');
		$unit_id=$this->input->post('unit_id');
		$status=$this->input->post('status');
		$grade=$this->input->post('grade');
		$period=$this->input->post('period');
		$institution=$this->input->post('institution');

		$this->db->set('status', $status);
		$this->db->set('grade', $grade);
		$this->db->set('period', $period);
		$this->db->set('institution', $institution);
		$this->db->where('student_id', $student_id);
		$this->db->where('unit_id', $unit_id);
		$this->db->where('is_freezed', 0);
		$result=$this->db->update('enrollment');

		if ($status == 'failed' || $status == 'deferred' || $status =='un enrolled') {

			$this->db->set('is_freezed', 1);
			$this->db->where('student_id', $student_id);
			$this->db->where('unit_id', $unit_id);
			$result=$this->db->update('enrollment');

			$data = array(
				'student_id' 	=> $student_id, 
				'unit_id' 	=> $unit_id, 
				'status' 	=> 'not enrolled',
				'grade' 	=> '',
				'period' 	=> '',
				'institution' 	=> '',
				'is_pickable' 	=> '',
				'is_freezed' => 0,
				
			);
			$result = $this->db->insert('enrollment', $data);
		}
		return $result;

	}
}