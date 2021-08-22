<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Package extends Home_Controller {

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
        $data['page_title'] = 'Package';      
        $data['page'] = 'Package';   
        $data['package'] = FALSE;
        $data['packages'] = $this->admin_model->select_asc('package');
        $data['features'] = $this->admin_model->select_asc('package_features');
        $data['main_content'] = $this->load->view('admin/package',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function update($id)
    {   
        if($_POST)
        {   
            if(!empty($this->input->post('is_special', true))){$special = 1;}else{$special = 0;};
            $data=array(
                'name' => $this->input->post('name', true),
                'price' => $this->input->post('price', true),
                'monthly_price' => $this->input->post('monthly_price', true),
                'is_special' => $special
            );
            $data = $this->security->xss_clean($data);
            $this->admin_model->edit_option($data, $id, 'package');
            $this->session->set_flashdata('msg', trans('msg-updated'));
            redirect($_SERVER['HTTP_REFERER']);
        }  
    }


    public function update_status($id, $status)
    {   
        $data=array(
            'is_active' => $status
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->edit_option($data, $id, 'package');
        $this->session->set_flashdata('msg', trans('msg-updated'));
        redirect($_SERVER['HTTP_REFERER']);
        
    }

    public function update_features($id)
    {   
        if($_POST)
        {   
            $data=array(
                'name' => $this->input->post('name', true),
                'basic' => $this->input->post('basic', true),
                'standared' => $this->input->post('standared', true),
                'premium' => $this->input->post('premium', true),
                'year_basic' => $this->input->post('year_basic', true),
                'year_standared' => $this->input->post('year_standared', true),
                'year_premium' => $this->input->post('year_premium', true)
            );
            $data = $this->security->xss_clean($data);
            $this->admin_model->edit_option($data, $id, 'package_features');
            $this->session->set_flashdata('msg', trans('msg-updated'));
            redirect($_SERVER['HTTP_REFERER']);
        }  
    }


    public function add()
    {	
        if($_POST)
        {   
            $id = $this->input->post('id', true);

            //validate inputs
            $this->form_validation->set_rules('name', "packages Name", 'required|max_length[100]');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('error', validation_errors());
                redirect(base_url('admin/package'));
            } else {

                if(!empty($this->input->post('is_special', true))){$special = 1;}else{$special = 0;};

                $data=array(
                    'name' => $this->input->post('name', true),
                    'price' => $this->input->post('price', true),
                    'is_special' => $special
                );
                $data = $this->security->xss_clean($data);
                
                //if id available info will be edited
                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'package');
                    $this->session->set_flashdata('msg', trans('msg-updated')); 
                } else {
                    $id = $this->admin_model->insert($data, 'package');
                    $this->session->set_flashdata('msg', trans('msg-inserted')); 
                }

                // insert photos
                if($_FILES['photo']['name'] != ''){
                    $up_load = $this->admin_model->upload_image('600');
                    $data_img = array(
                        'image' => $up_load['images'],
                        'thumb' => $up_load['thumb']
                    );
                    $this->admin_model->edit_option($data_img, $id, 'package');   
                }
                redirect(base_url('admin/package'));

            }
        }  
    }


    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['package'] = $this->admin_model->select_option($id, 'package');
        $data['main_content'] = $this->load->view('admin/package',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    

    public function delete($id)
    {
        $this->admin_model->delete($id,'package'); 
        echo json_encode(array('st' => 1));
    }

}
	

