<?php
	
	/**
	* 
	*/
	class Rondas extends CI_Controller{
		
		public function index(){
			$this->load->view('templates/header');
			$this->load->view('sidebar');
			$this->load->view('rondas');
			$this->load->view('templates/footer');
		}
	}
?>