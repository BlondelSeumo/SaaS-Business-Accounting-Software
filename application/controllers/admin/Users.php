<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends Home_Controller {

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
        $this->all_users('all');
    }


    //all users list
    public function all_users($type)
    {
        $data = array();

        //initialize pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url('admin/users/all_users/'.$type);
        $total_row = $this->admin_model->get_all_users(1 , 0, 0, $type);
        $config['total_rows'] = $total_row;
        $config['per_page'] = 10;
        $this->pagination->initialize($config);
        
        $page = $this->security->xss_clean($this->input->get('page'));
        if (empty($page)) {
            $page = 0;
        }
        if ($page != 0) {
            $page = $page - 1;
        }

        $data['page_title'] = 'Users';
        $data['packages'] = $this->admin_model->select_asc('package');
        $data['users'] = $this->admin_model->get_all_users(0 , $config['per_page'], $page * $config['per_page'], $type);
        $data['main_content'] = $this->load->view('admin/users', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    //all pro users list
    public function pro($type = 'pro')
    {
        $data = array();
        $data['page_title'] = 'Users';
        $data['users'] = $this->admin_model->get_all_users($type);
        $data['main_content'] = $this->load->view('admin/users', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    //active or deactive post
    public function status_action($type, $id) 
    {
        $data = array(
            'status' => $type
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'users');

        if($type ==1):
            $this->session->set_flashdata('msg', trans('msg-activated')); 
        else:
            $this->session->set_flashdata('msg', trans('msg-deactivated')); 
        endif;
        redirect(base_url('admin/users'));
    }

    //change user role
    public function change_account($id) 
    {
        $data = array(
            'account_type' => $this->input->post('type', false)
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->edit_option($data, $id, 'users');
        $this->session->set_flashdata('msg', trans('msg-updated'));
        redirect(base_url('admin/users'));
    }

    public function edit($id)
    {  
        if($_POST)
        {   
            $id = $this->input->post('id', true);
            $data=array(
                'name' => $this->input->post('name', true),
                'slug' => str_slug(trim($this->input->post('name', true))),
                'email' => $this->input->post('email', true),
                'phone' => $this->input->post('phone', true),
                'designation' => $this->input->post('designation', true),
                'address' => $this->input->post('address', true),
                'account_type' => $this->input->post('type', false)
            );
            $data = $this->security->xss_clean($data);
            $this->admin_model->edit_option($data, $id, 'users');
            $this->session->set_flashdata('msg', trans('msg-updated'));
            redirect(base_url('admin/users'));
        }

        $data = array();
        $data['page_title'] = 'Edit';   
        $data['user'] = $this->admin_model->get_by_id($id, 'users');
        $data['main_content'] = $this->load->view('admin/user_edit',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'users');
        $this->session->set_flashdata('msg', trans('msg-activated')); 
        redirect(base_url('admin/users'));
    }


    public function delete($user_id)
    {
        $business = $this->admin_model->get_business_by_user($user_id);
        foreach ($business as $biz) {
            $this->admin_model->delete_payment_records($biz->uid,'payment_records'); 
        }
        $this->admin_model->delete_by_user($user_id,'payment'); 
        $this->admin_model->delete_by_user($user_id,'business');
        $this->admin_model->delete($user_id,'users'); 
        echo json_encode(array('st' => 1));
    }


}