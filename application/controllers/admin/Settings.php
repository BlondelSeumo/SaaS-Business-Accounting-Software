<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends Home_Controller {

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
        $data['page_title'] = 'Settings';
        $data['main_page'] = 'Settings';
        $data['time_zones'] = $this->admin_model->select_asc('time_zone');
        $data['settings'] = $this->admin_model->get('settings');
        $data['currencies'] = $this->admin_model->select_asc('country');
        $data['main_content'] = $this->load->view('admin/settings', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function preferences()
    {
        $data = array();
        $data['page_title'] = 'Preferences';
        $data['main_page'] = 'Settings';
        $data['settings'] = $this->admin_model->get('settings');
        $data['main_content'] = $this->load->view('admin/preferences', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function appearance()
    {
        $data = array();
        $data['page_title'] = 'Appearance';
        $data['main_page'] = 'Settings';
        $data['main_content'] = $this->load->view('admin/appearance', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    //update appearance
    public function update_appearance()
    {
        if ($_POST) {
            $data = array(
                'theme' => $this->input->post('theme', true)
            );
            $data = $this->security->xss_clean($data);
            $this->admin_model->edit_option($data, 1, 'settings');
            $this->session->set_flashdata('msg', trans('msg-updated')); 
            redirect(base_url('admin/settings/appearance'));
        }
    }

    //set default language
    public function set_language()
    {
        if ($_POST) {
            $data = array(
                'lang' => $this->input->post('language', true)
            );
            $data = $this->security->xss_clean($data);
            $this->admin_model->edit_option($data, 1, 'settings');
            $this->session->set_flashdata('msg', trans('msg-updated')); 
            redirect(base_url('admin/language'));
        }
    }

    
    //update settings
    public function update_preferences(){

        if ($_POST) {

            if(!empty($this->input->post('enable_registration'))){$enable_registration = $this->input->post('enable_registration', true);}
            else{$enable_registration = 0;}

            if(!empty($this->input->post('enable_email_verify'))){$enable_email_verify = $this->input->post('enable_email_verify', true);}
            else{$enable_email_verify = 0;}

            if(!empty($this->input->post('enable_captcha'))){$enable_captcha = $this->input->post('enable_captcha', true);}
            else{$enable_captcha = 0;}

            if(!empty($this->input->post('enable_paypal'))){$enable_paypal = $this->input->post('enable_paypal', true);}
            else{$enable_paypal = 0;}

            if(!empty($this->input->post('enable_delete_invoice'))){$enable_delete_invoice = $this->input->post('enable_delete_invoice', true);}
            else{$enable_delete_invoice = 0;}

            if(!empty($this->input->post('enable_multilingual'))){$enable_multilingual = $this->input->post('enable_multilingual', true);}
            else{$enable_multilingual = 0;}

            if(!empty($this->input->post('enable_discount'))){$enable_discount = $this->input->post('enable_discount', true);}
            else{$enable_discount = 0;}

            if(!empty($this->input->post('enable_blog'))){$enable_blog = $this->input->post('enable_blog', true);}
            else{$enable_blog = 0;}

            if(!empty($this->input->post('enable_faq'))){$enable_faq = $this->input->post('enable_faq', true);}
            else{$enable_faq = 0;}

            if(!empty($this->input->post('enable_frontend'))){$enable_frontend = $this->input->post('enable_frontend', true);}
            else{$enable_frontend = 0;}
            
            $data = array(
                'enable_registration' => $enable_registration,
                'enable_email_verify' => $enable_email_verify,
                'enable_captcha' => $enable_captcha,
                'enable_paypal' => $enable_paypal,
                'enable_multilingual' => $enable_multilingual,
                'enable_delete_invoice' => $enable_delete_invoice,
                'enable_discount' => $enable_discount,
                'enable_blog' => $enable_blog,
                'enable_faq' => $enable_faq,
                'enable_frontend' => $enable_frontend 
            );

            $data = $this->security->xss_clean($data);
            $this->admin_model->edit_option($data, 1, 'settings');
            $this->session->set_flashdata('msg', trans('msg-updated')); 
            redirect($_SERVER['HTTP_REFERER']);
        }
    }


    //update settings
    public function update(){

        if ($_POST) {

            $data = array(
                'site_name' => $this->input->post('site_name', true),
                'site_title' => $this->input->post('site_title', true),
                'keywords' => $this->input->post('keywords', true),
                'description' => $this->input->post('description', true),
                'terms_service' => $this->input->post('terms_service', true),
                'footer_about' => $this->input->post('footer_about', true),
                'copyright' => $this->input->post('copyright', true),
                'pagination_limit' => 0,
                'trial_days' => $this->input->post('trial_days', true),
                'facebook' => $this->input->post('facebook', true),
                'twitter' => $this->input->post('twitter', true),
                'instagram' => $this->input->post('instagram', true),
                'linkedin' => $this->input->post('linkedin', true),
                'google_analytics' => base64_encode($this->input->post('google_analytics')),
                'site_color' => $this->input->post('site_color', true),
                'site_font' => $this->input->post('site_font', true),
                'time_zone' => $this->input->post('time_zone', true),
                'captcha_site_key' => $this->input->post('captcha_site_key', true),
                'captcha_secret_key' => $this->input->post('captcha_secret_key', true),
                'admin_email' => $this->input->post('admin_email', true),
                'mail_protocol' => $this->input->post('mail_protocol', true),
                'mail_title' => $this->input->post('mail_title', true),
                'mail_host' => $this->input->post('mail_host', true),
                'mail_port' => $this->input->post('mail_port', true),
                'mail_encryption' => $this->input->post('mail_encryption'), 
                'mail_username' => $this->input->post('mail_username', true),
                'mail_password' => base64_encode($this->input->post('mail_password', true))    
            );

            // upload favicon image
            $data_img = $this->admin_model->do_upload('photo1');
            if($data_img){

                $data_img = array(
                    'favicon' => $data_img['thumb']
                );
                $this->admin_model->edit_option($data_img, 1, 'settings'); 
             }

            // upload logo
            $data_img2 = $this->admin_model->do_upload('photo2');
            if($data_img2){
                $data_img = array(
                    'logo' => $data_img2['medium']
                );            
                $this->admin_model->edit_option($data_img, 1, 'settings');
            }

            // upload logo
            $data_img3 = $this->admin_model->do_upload('photo3');
            if($data_img3){
                $data_img = array(
                    'hero_img' => $data_img3['big']
                );            
                $this->admin_model->edit_option($data_img, 1, 'settings');
            }

            $data = $this->security->xss_clean($data);
            $this->admin_model->edit_option($data, 1, 'settings');

            $user_data = array(
                'email' => $this->input->post('admin_email', true)        
            );
            
            $user_data = $this->security->xss_clean($user_data);
            $this->admin_model->edit_option($user_data, user()->id, 'users');


            $this->session->set_flashdata('msg', trans('msg-updated')); 
            redirect($_SERVER['HTTP_REFERER']);
        }
    }


}