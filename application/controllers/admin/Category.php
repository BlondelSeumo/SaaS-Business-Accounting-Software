<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
        //check auth
        if (!is_user()) {
            redirect(base_url());
        }
    }


    public function index()
    {
        $data = array();
        $data['page_title'] = 'Category';      
        $data['page'] = 'Category';   
        $data['category'] = FALSE;
        $data['categories'] = $this->admin_model->get_categories();
        $data['main_content'] = $this->load->view('admin/user/category',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function add()
    {	
        if($_POST)
        {   
            $id = $this->input->post('id', true);

            //validate inputs
            $this->form_validation->set_rules('name', "Category Name", 'required|max_length[100]');
            $this->form_validation->set_rules('type', "Category type", 'required');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('errors', validation_errors());
                redirect(base_url('admin/category'));
            } else {
               
                $data=array(
                    'user_id' => user()->id,
                    'business_id' => $this->business->uid,
                    'name' => $this->input->post('name', true),
                    'slug' => str_slug(trim($this->input->post('name', true))),
                    'type' => $this->input->post('type', true)
                );
                $data = $this->security->xss_clean($data);
                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'categories');
                    $this->session->set_flashdata('msg', trans('msg-updated')); 
                } else {
                    $id = $this->admin_model->insert($data, 'categories');
                    $this->session->set_flashdata('msg', trans('msg-inserted')); 
                }
                redirect(base_url('admin/category'));

            }
        }      
        
    }

    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['category'] = $this->admin_model->select_option($id, 'categories');
        $data['main_content'] = $this->load->view('admin/user/category',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'categories');
        $this->session->set_flashdata('msg', trans('msg-activated')); 
        redirect(base_url('admin/category'));
    }

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'categories');
        $this->session->set_flashdata('msg', trans('msg-deactivated')); 
        redirect(base_url('admin/category'));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'categories'); 
        echo json_encode(array('st' => 1));
    }

}
	

