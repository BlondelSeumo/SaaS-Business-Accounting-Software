<?php
class Auth_model extends CI_Model {

    public function edit_option_md5($action, $id, $table)
    {
        $this->db->where('md5(id)',$id);
        $this->db->update($table,$action);
        return;
    }


    //is logged in
    public function is_logged_in()
    {
        //check if user logged in
        if ($this->session->userdata('logged_in') == TRUE && !empty($this->get_user($this->session->userdata('id')))) {
            return true;
        } else {
            return false;
        }
    }


    //function get user
    public function get_logged_user()
    {
        if ($this->is_logged_in()) {
            $this->db->select('u.*, c.name as country, c.currency_name, c.currency_code, c.currency_symbol');
            $this->db->from('users as u');
            $this->db->join('country as c', 'c.id = u.country', 'LEFT');
            $this->db->where('u.id', $this->session->userdata('id'));
            $query = $this->db->get();
            return $query->row();
        }
    }

    //get user by id
    public function get_user($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->row();
    }

    //is admin
    public function is_admin()
    {
        get_header_info();
        //check logged in
        if (!$this->is_logged_in()) {
            return false;
        }

        //check role
        if (user()->role == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    //is user
    public function is_user()
    {   
        get_header_info();
        //check logged in
        if (!$this->is_logged_in()) {
            return false;
        }

        //check role
        if (user()->role == 'user') {
            return true;
        } else {
            return false;
        }
    }


    //is pro user
    public function is_pro_user()
    {
        //check logged in
        if (!$this->is_logged_in()) {
            return false;
        }

        //check role
        if (user()->role == 'user' && user()->account_type == 'pro') {
            return true;
        } else {
            return false;
        }
    }



    //logout
    public function logout()
    {
        //unset user data
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('admin_logged_in');
        $this->session->unset_userdata('app_key');
    }


    // check post email
    public function check_roles_email($email)
    {
        $this->db->select('*');
        $this->db->from('users_role');
        $this->db->where('email', $email); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->result();
        }else{
            $result = $this->check_email($email);
            return $result;
        }
    }


    // check post email
    public function check_email($email)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $email); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->result();
        }else{
            return false;
        }
    }


    // check valid user by id
    public function validate_id($id)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('md5(id)', $id); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query -> num_rows() == 1)
        {                 
            return $query->row();
        }
        else{
            return false;
        }
    }

    // check post email
    public function validate_code($code)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('verify_code', $code); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return true;
        }else{
            return false;
        }
    }



    // check valid user
    function validate_user()
    {            
        
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $this->input->post('user_name'));
        $this->db->or_where('user_name', $this->input->post('user_name'));
        $this->db->limit(1);
        $query = $this->db->get();   
        if($query->num_rows() == 1){                 
           return $query->row();
        }else{
            $result = $this->validate_role();
            return $result;
        }
    }


    // check valid staff
    function validate_role()
    {   
        $this->db->select('*');
        $this->db->from('users_role');
        $this->db->where('email', $this->input->post('user_name'));
        $this->db->limit(1);
        $query = $this->db->get();   
        if($query->num_rows() > 0)
        {                 
           return $query->row();
        }
        else{
            return FALSE;
        }
    }


    public function send_email($to, $subject, $message)
    {
        $this->load->library('email');

        $settings = get_settings();

        if ($settings->mail_protocol == "mail") {
            $config = Array(
                'protocol' => 'mail',
                'smtp_host' => $settings->mail_host,
                'smtp_port' => $settings->mail_port,
                'smtp_user' => $settings->mail_username,
                'smtp_pass' => $settings->mail_password,
                'smtp_timeout' => 100,
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'wordwrap' => TRUE
            );
        } else {
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => $settings->mail_host,
                'smtp_port' => $settings->mail_port,
                'smtp_user' => $settings->mail_username,
                'smtp_pass' => $settings->mail_password,
                'smtp_timeout' => 100,
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'wordwrap' => TRUE
            );
        }


        //initialize
        $this->email->initialize($config);

        //send email
        $this->email->from($settings->mail_username, $settings->application_name);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        $this->email->set_newline("\r\n");

        return $this->email->send();
    }



}