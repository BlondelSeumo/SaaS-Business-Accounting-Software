<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends Home_Controller {

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
        $data['page_title'] = 'Personal Information';
        $data['page'] = 'Profile';
        if (auth('role') == 'user') {
            $data['user'] = $this->admin_model->get_user_info();
        } else {
            $data['user'] = $this->admin_model->get_user_role_info();
        }
        $data['countries'] = $this->admin_model->select('country');
        $data['fonts'] = $this->admin_model->select('google_fonts');
        $data['main_content'] = $this->load->view('admin/user/profile', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    //switch business
    public function switch_business($business = "")
    {   
        $business = ($business != "") ? $business : $this->business->uid;
        $active_business = array('active_business' => $business);
        $this->session->set_userdata($active_business);
        redirect(base_url('admin/dashboard/business'));
    }


    //update user profile
    public function update(){
        
        if ($_POST) {

            $data = array(
                'name' => $this->input->post('name', true),
                'email' => $this->input->post('email', true),
                'country' => $this->input->post('country', true),
                'address' => $this->input->post('address', true),
                'city' => $this->input->post('city', true),
                'state' => $this->input->post('state', true),
                'phone' => $this->input->post('phone', true),
                'postcode' => $this->input->post('postcode', true)
            );
            
           // insert photos
            if($_FILES['photo']['name'] != ''){
                $up_load = $this->admin_model->upload_image('800');
                $data_img = array(
                    'image' => $up_load['images'],
                    'thumb' => $up_load['thumb']
                );
                $this->admin_model->edit_option($data_img, user()->id, 'users');   
            }

            $data = $this->security->xss_clean($data);
            $this->admin_model->edit_option($data, user()->id, 'users');
            $this->session->set_flashdata('msg', trans('msg-updated')); 
            redirect(base_url('admin/profile'));
        }
    }

    //update user profile
    public function update_role(){
        
        if ($_POST) {

            $data = array(
                'name' => $this->input->post('name', true),
                'email' => $this->input->post('email', true),
                'country' => $this->input->post('country', true),
                'address' => $this->input->post('address', true),
                'city' => $this->input->post('city', true)
            );
            
           // insert photos
            if($_FILES['photo']['name'] != ''){
                $up_load = $this->admin_model->upload_image('800');
                $data_img = array(
                    'image' => $up_load['images'],
                    'thumb' => $up_load['thumb']
                );
                $this->admin_model->edit_option($data_img, auth('parent'), 'users_role');   
            }

            $data = $this->security->xss_clean($data);
            $this->admin_model->edit_option($data, auth('parent'), 'users_role');
            $this->session->set_flashdata('msg', trans('msg-updated')); 
            redirect(base_url('admin/profile'));
        }
    }


    public function change_password()
    {
        $data = array();
        $data['page_title'] = 'Change Password';
        $data['page'] = 'Password';
        $data['main_content'] = $this->load->view('admin/user/change_password', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
    

    //change password
    public function change()
    {   
        if($_POST){

            if (auth('role') == 'user') {
                $id = user()->id;
                $user = $this->admin_model->get_by_id($id, 'users');
                $table = 'users';
            } else {
                $id = auth('parent');
                $user = $this->admin_model->get_by_id($id, 'users_role');
                $table = 'users_role';
            }
            

            if(password_verify($this->input->post('old_pass', true), $user->password)){
                if ($this->input->post('new_pass', true) == $this->input->post('confirm_pass', true)) {
                    $data=array(
                        'password' => hash_password($this->input->post('new_pass', true))
                    );
                    $data = $this->security->xss_clean($data);
                    $this->admin_model->edit_option($data, $id, $table);
                    echo json_encode(array('st'=>1));
                } else {
                    echo json_encode(array('st'=>2));
                }
            } else {
                echo json_encode(array('st'=>0));
            }
        }
    }


}