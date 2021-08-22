<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feature extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
        //check auth
        if (!is_admin()) {
            redirect(base_url());
        }
    }


    public function index()
    {
        $data = array();
        $data['page_title'] = 'Feature';      
        $data['page'] = 'Feature';   
        $data['feature'] = FALSE;
        $data['features'] = $this->admin_model->select('features');
        $data['main_content'] = $this->load->view('admin/feature',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function add()
    {	
        if($_POST)
        {   
            $id = $this->input->post('id', true);

            //validate inputs
            $this->form_validation->set_rules('name', "Features Name", 'required|max_length[200]');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('error', validation_errors());
                redirect(base_url('admin/feature'));
            } else {
               
                $data=array(
                    'name' => $this->input->post('name', true),
                    'orders' => $this->input->post('orders', true),
                    'details' => $this->input->post('details', true)
                );
                $data = $this->security->xss_clean($data);
                
                //if id available info will be edited
                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'features');
                    $this->session->set_flashdata('msg', trans('msg-updated')); 
                } else {
                    $id = $this->admin_model->insert($data, 'features');
                    $this->session->set_flashdata('msg', trans('msg-inserted')); 
                }

                // insert photos
                if($_FILES['photo']['name'] != ''){
                    $up_load = $this->admin_model->upload_image('600');
                    $data_img = array(
                        'image' => $up_load['images'],
                        'thumb' => $up_load['thumb']
                    );
                    $this->admin_model->edit_option($data_img, $id, 'features');   
                }
                redirect(base_url('admin/feature'));

            }
        }      
        
    }

    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['packages'] = $this->admin_model->select('package');
        $data['feature'] = $this->admin_model->select_option($id, 'features');
        $data['main_content'] = $this->load->view('admin/feature',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'features');
        $this->session->set_flashdata('msg', trans('msg-activated')); 
        redirect(base_url('admin/service'));
    }

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'features');
        $this->session->set_flashdata('msg', trans('msg-deactivated')); 
        redirect(base_url('admin/service'));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'features'); 
        echo json_encode(array('st' => 1));
    }

}
	

