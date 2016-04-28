<?php
	
	/**
	* 
	*/
	class Jugador extends CI_Controller{

		public function __construct(){
			parent::__construct();
			$this->load->model('jugador_model');
		}
		
		public function index(){
			$this->load->view('templates/header');
			$this->load->view('sidebar');
			$this->load->view('jugador');
			$this->load->view('templates/footer');
		}

		public function listarJugadores(){
			$this->datatables->select("jug_tor, jug_nombre, jug_apellidos");
			$this->datatables->unset_column("jug_tor");
			$this->datatables->from("jugador");
			echo $this->datatables->generate();
		}
		
		public function guardarJugador(){
			$data = array(
				'jug_tor' 		=> $this->input->post('sTor'),
				'jug_nombre' 	=> $this->input->post('sNombre'),
				'jug_apellidos' => $this->input->post('sApellidos'),
				'jug_indactivo' => 'S'
			);

			$response = $this->jugador_model->guardarJugador($data);
			echo json_encode($response);
		}

		public function eliminarJugador(){
			$data = array(
				'jug_tor'	=> $this->input->post('sTor')
			);

			$response = $this->jugador_model->eliminarJugador($data);
			echo json_encode($response);
		}
	}
?>