<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BusController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Bus');
		$this->load->model('Bus_type');
	}

	public function index()
	{
		$data['title']='BUS CRUD';

		$bus_type_data = $this->Bus_type->show_Bus_Type();
		$data['bustype'] = array();
		foreach ($bus_type_data as $rows) {
			array_push($data['bustype'],
				array(
					$rows['bus_type_id'],
					$rows['bus_type_name'],
				)
			);
		}

		$this->load->view('bus_crud', $data);
	}

	public function saveBus()
	{
		$validate = array (
			array('field'=>'bus_name','label'=>'Bus Name','rules'=>'required|is_unique[buses.bus_name]'),
			array('field'=>'plate_number','label'=>'Plate Number','rules'=>'required|is_unique[buses.plate_number]'),
			array('field'=>'bus_desc','label'=>'Bus Description','rules'=>'required'),
		);

		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) 
		{
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}
		else
		{
			$info['success']=TRUE;

			$data=array(
				'bus_name'=>$this->input->post('bus_name'),
				'plate_number'=>$this->input->post('plate_number'),
				'bus_desc'=>$this->input->post('bus_desc'),
				'bus_type'=>$this->input->post('bus_type'),
			);
			$this->Bus->save_Bus($data);
			$info['message']="You have successfully saved your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	public function updateBus()
	{

		$validate = array (
			array('field'=>'bus_name','label'=>'Bus Name','rules'=>'required'),
			array('field'=>'plate_number','label'=>'Plate Number','rules'=>'required'),
			array('field'=>'bus_desc','label'=>'Bus Description','rules'=>'required'),
		);

		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) 
		{
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}
		else
		{
			$info['success']=TRUE;

			$data=array(
				'bus_id'=>$this->input->post('bus_id'),
				'bus_name'=>$this->input->post('bus_name'),
				'plate_number'=>$this->input->post('plate_number'),
				'bus_desc'=>$this->input->post('bus_desc'),
				'bus_type'=>$this->input->post('bus_type')
			);
			$this->Bus->update_Bus_Data($data);
			$info['message']="You have successfully updated your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	public function show_Bus()
	{
		$bus_table = $this->Bus->show_Bus();
		$data = array();
		foreach ($bus_table as $rows) {
			array_push($data,
				array(
					$rows['bus_id'],
					$rows['bus_name'],
					$rows['plate_number'],
					$rows['bus_desc'],
					$rows['bus_type'],
					'<a href="javascript:void(0)" class="btn btn-info btn-sm" onclick="edit_bus('."'".$rows['bus_id']."'".')">Edit</a>'.
					'&nbsp;<a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="delete_bus('."'".$rows['bus_id']."'".')">Delete</a>'
				)
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}

	public function edit_Bus()
	{
		$bus_id=$this->input->post('bus_id');
		$data=$this->Bus->edit_Bus_Data($bus_id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function delete_Bus()
	{
		$validate=array(
			array('field'=>'bus_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$info['success']=TRUE;
			$data=array(
				'bus_id'=>$this->input->post('bus_id')
			);
			$this->Bus->delete_Bus_Data($data);
			$info['message']='Data Successfully Deleted';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

}
