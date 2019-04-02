<?php
//http://mfikri.com/en/blog/crud-codeigniter-ajax
class Main extends CI_Controller{

	function __construct(){

		parent::__construct();
		$this->load->model('student_model');
		$this->load->model('enrollment_model');
	}

	function index(){

		$this->load->view('main_view');
	}

	function save(){

		$data=$this->student_model->save_student();
		$data=$this->enrollment_model->save_pm_for_student();
		echo json_encode($data);
	}

	function search(){

		$data=$this->enrollment_model->load_pm_for_student();
		echo json_encode($data);
	}

	function update(){

        $data=$this->enrollment_model->edit_pm_for_student();
        echo json_encode($data);
    }


}
