<?php
	/**
	*
	*/
	class Jugador_model extends CI_Model{

		public function guardarJugador($aEntData){

			//Valida si jugador existe
			$this->db->select('*');
			$this->db->from('jugador');
			$this->db->where('jug_tor', $aEntData['jug_tor']);
			$query = $this->db->get();
			
			if($query->num_rows() > 0){
				return false;
			}else{
				$this->db->insert('jugador', $aEntData);
			}
		}

	}
?>