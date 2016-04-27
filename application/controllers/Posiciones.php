<?php

	/**
	* 
	*/
	class Posiciones extends CI_Controller{
		
		public function index(){
			$this->load->view('templates/header');
			$this->load->view('sidebar');
			$this->load->view('posiciones');
			$this->load->view('templates/footer');
		}
	}

?>