<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Country extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
        //check auth
        if (!is_user() && !is_admin()) {
            redirect(base_url());
        }
    }


    public function index()
    {
        $data = array();
        $data['page_title'] = 'Country';      
        $data['page'] = 'Country';   
        $data['country'] = FALSE;
        $data['countries'] = $this->admin_model->select('country');
        $data['main_content'] = $this->load->view('admin/user/country',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function add()
    {	
        if($_POST)
        {   
            $id = $this->input->post('id', true);
            if (empty($id)) {
                $check = $this->admin_model->check_duplicate_country($this->input->post('name'), $this->input->post('code'));
                if ($check == 1) {
                    $this->session->set_flashdata('error', 'Country already exist');
                    redirect(base_url('admin/country'));
                    exit();
                }
            }

            //validate inputs
            $this->form_validation->set_rules('name', "Name", 'required|max_length[100]');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('errors', validation_errors());
                redirect(base_url('admin/country'));
            } else {
               
                $data=array(
                    'user_id' => user()->id,
                    'name' => $this->input->post('name', true),
                    'code' => $this->input->post('code', true),
                    'currency_name' => $this->input->post('currency_name', true),
                    'currency_code' => $this->input->post('currency_code', true),
                    'currency_symbol' => $this->input->post('currency_symbol', true)
                );
                $data = $this->security->xss_clean($data);
                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'country');
                    $this->session->set_flashdata('msg', trans('msg-updated')); 
                } else {
                    $id = $this->admin_model->insert($data, 'country');
                    $this->session->set_flashdata('msg', trans('msg-inserted')); 
                }
                redirect(base_url('admin/country'));

            }
        }      
        
    }



    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['country'] = $this->admin_model->select_option($id, 'country');
        $data['main_content'] = $this->load->view('admin/user/country',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'country');
        $this->session->set_flashdata('msg', trans('msg-activated')); 
        redirect(base_url('admin/country'));
    }

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'country');
        $this->session->set_flashdata('msg', trans('msg-deactivated')); 
        redirect(base_url('admin/country'));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'country'); 
        echo json_encode(array('st' => 1));
    }

}
	

