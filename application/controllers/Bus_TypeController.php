<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bus_TypeController extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Bus_type');
	}

	public function index()
	{
		$data['title']='BUS TYPE CRUD';

		$this->load->view('bus_type_crud', $data);
	}

	public function saveBusType()
	{
		$validate = array (
			array('field'=>'bus_type_name','label'=>'Bus Type Name','rules'=>'required|is_unique[bus_type.bus_type_name]'),
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
				'bus_type_name'=>$this->input->post('bus_type_name'),
			);
			$this->Bus_type->save_Bus_Type($data);
			$info['message']="You have successfully saved your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	public function show_Bus_Type()
	{
		$bus_type_table = $this->Bus_type->show_Bus_Type();
		$data = array();
		foreach ($bus_type_table as $rows) {
			array_push($data,
				array(
					$rows['bus_type_id'],
					$rows['bus_type_name'],
					'<a href="javascript:void(0)" class="btn btn-info btn-sm" onclick="edit_bus_type('."'".$rows['bus_type_id']."'".')">Edit</a>'.
					'&nbsp;<a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="delete_bus_type('."'".$rows['bus_type_id']."'".')">Delete</a>'
				)
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}

	public function edit_Bus_Type()
	{
		$bus_type_id=$this->input->post('bus_type_id');
		$data=$this->Bus_type->edit_Bus_Type_Data($bus_type_id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function updateBusType()
	{

		$validate = array (
			array('field'=>'bus_type_name','label'=>'Bus Type Name','rules'=>'required'),
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
				'bus_type_id'=>$this->input->post('bus_type_id'),
				'bus_type_name'=>$this->input->post('bus_type_name'),
			);
			$this->Bus_type->update_Bus_Type_Data($data);
			$info['message']="You have successfully updated your data!";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

	public function delete_Bus_Type()
	{
		$validate=array(
			array('field'=>'bus_type_id','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$info['success']=TRUE;
			$data=array(
				'bus_type_id'=>$this->input->post('bus_type_id')
			);
			$this->Bus_type->delete_Bus_Type_Data($data);
			$info['message']='Data Successfully Deleted';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

}
