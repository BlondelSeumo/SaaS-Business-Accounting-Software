<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role_management extends Home_Controller {

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
        $data['page_title'] = 'Role Management';
        $data['page'] = 'Roles';
        $data['user'] = FALSE;
        $data['users'] = $this->admin_model->get_business_users();
        $data['features'] = $this->admin_model->select_asc('users_role_feature');
        $data['main_content'] = $this->load->view('admin/user/roles/role_management',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function add()
    {   
        if($_POST)
        {   
            $id = $this->input->post('id', true);

            //validate inputs
            $this->form_validation->set_rules('name', "User Name", 'required');
            $this->form_validation->set_rules('email', "Email", 'required');

            $mail =  strtolower(trim($this->input->post('email', true)));
            $email = $this->auth_model->check_roles_email($mail);

            if ($id == '' && $email){
                $this->session->set_flashdata('error', 'Email already exist ! Try another one');
                redirect(base_url('admin/role_management')); 
                exit();
            }

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('error', validation_errors());
                redirect(base_url('admin/role_management'));
            } else {

                $data=array(
                    'parent_id' => user()->id,
                    'business_id' => $this->business->uid,
                    'name' => $this->input->post('name', true),
                    'email' => $this->input->post('email', true),
                    'password' => hash_password('1234'),
                    'position' => $this->input->post('position', true),
                    'role' => $this->input->post('role', true),
                    'status' => 1,
                    'approve' => 0,
                    'created_at' => my_date_now()
                );
                $data = $this->security->xss_clean($data);

                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'users_role');
                    $this->session->set_flashdata('msg', trans('msg-updated')); 
                } else {

                    if (check_package_limit('user-roles') != -2) {
                        $total = get_total_value_by_parent('users_role', 0);
                        if ($total >= check_package_limit('user-roles')):
                            $msg = trans('reached-limit').', '.trans('package-limit-msg');
                            $this->session->set_flashdata('error', $msg);
                            redirect(base_url('admin/role_management'));
                            exit();
                        endif;
                    }

                    $id = $this->admin_model->insert($data, 'users_role');
                    $this->send_invitation($data, $id);
                    $this->session->set_flashdata('msg', trans('msg-inserted')); 
                }

                redirect(base_url('admin/role_management'));
            }
        }      
        
    }


    //send email
    public function send_invitation($data, $id)
    {   
       
        $business = $this->admin_model->get_by_id($this->business->id, 'business');
        $user = $this->admin_model->get_by_id($data['parent_id'], 'users');
       
        $data['email_to'] = $data['email'];
        $data['subject'] = 'Invited by '.$business->name.' to collaborate at '.settings()->site_name;

        $data['user_id'] = md5($id);
        $data['logo'] = base_url(settings()->logo);
        $data['info_logo'] = base_url('assets/images/add-user.png');
        $data['owner_email'] = $user->email;
        $data['business_name'] = $business->name;
        $data['html_content'] = $this->load->view('email_template/invitation', $data, true);
        $this->email_model->send_email($data['email_to'], $data['subject'], $data['html_content']);
        
    }


    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';
        $data['page'] = 'Roles';
        $data['user'] = $this->admin_model->select_option($id, 'users_role');
        $data['users'] = $this->admin_model->get_business_users();
        $data['features'] = $this->admin_model->select_asc('users_role_feature');
        $data['main_content'] = $this->load->view('admin/user/roles/role_management',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function permissions()
    {
        $data = array();
        $data['page_title'] = 'Role Permissions';
        $data['page'] = 'Roles';
        $data['user'] = FALSE;
        //$data['users'] = $this->admin_model->get_role_permissions();
        $data['features'] = $this->admin_model->select_asc('users_role_feature');
        $data['main_content'] = $this->load->view('admin/user/roles/role_permissions',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function update_permissions() 
    {
        
        
        $this->admin_model->delete_by_business($this->business->uid, 'users_role_feature_assign');

        $features1 = $this->input->post('features_1');
        foreach ($features1 as $feature) {
            $data1 = array(
                'role' => 'subadmin',
                'business_id' => $this->business->uid,
                'feature_id' => $feature,
                'feature_slug' => get_feature_slug($feature, 'users_role_feature'),
                'view_only' => 0

            );
            $this->admin_model->insert($data1, 'users_role_feature_assign');
        }
        


        // features 2
        $features2 = $this->input->post('features_2');
        foreach ($features2 as $feature) {
            $data2 = array(
                'role' => 'editor',
                'business_id' => $this->business->uid,
                'feature_id' => $feature,
                'feature_slug' => get_feature_slug($feature, 'users_role_feature'),
                'view_only' => 0

            );
            $this->admin_model->insert($data2, 'users_role_feature_assign');
        }
        


        // features 3
        $features3 = $this->input->post('features_3');
        foreach ($features3 as $feature) {
            $data3 = array(
                'role' => 'viewer',
                'business_id' => $this->business->uid,
                'feature_id' => 0,
                'feature_slug' => '',
                'view_only' => 1

            );
            $this->admin_model->insert($data3, 'users_role_feature_assign');
        }
        

        $this->session->set_flashdata('msg', trans('msg-updated'));
        redirect(base_url('admin/role_management/permissions'));
        
    }


    public function delete($id)
    {
        $this->admin_model->delete($id,'users_role'); 
        echo json_encode(array('st' => 1));
    }


}