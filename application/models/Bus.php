<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Bus extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function save_Bus($data)
		{
			$this->db->insert('buses', $data);
			return TRUE;
		}

		public function update_Bus_Data($data)
		{
			$this->db->where(array('bus_id'=>$data['bus_id']));
			$this->db->update('buses', $data);
			return TRUE;
		}

		public function show_Bus()
		{
			$this->db->select("*");
			$this->db->from('buses');
			$query=$this->db->get();
			return $query->result_array();
		}

		public function edit_Bus_Data($bus_id)
		{
			$this->db->select("*");
			$this->db->from('buses');
			$this->db->where('bus_id', $bus_id);
			$query = $this->db->get();
			return $query->row_array();
		}

		public function delete_Bus_Data($data)
		{
			$this->db->where(array('bus_id'=>$data['bus_id']));
			$this->db->delete('buses');
			return TRUE;
		}
	}

// END OF BUS MODEL