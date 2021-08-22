<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        //check auth
        if (!is_admin()) {
            redirect(base_url());
        }

        $data = array();
        $data['page_title'] = 'Payment Settings';      
        $data['page'] = 'Payment';   
        $data['main_page'] = 'Settings';
        $data['settings'] = $this->admin_model->get('settings');
        $data['currencies'] = $this->admin_model->select_asc('country');
        $data['packages'] = $this->admin_model->select_asc('package');
        $data['users'] = $this->admin_model->get_users();
        $data['main_content'] = $this->load->view('admin/payment_settings',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function user()
    {
        //check auth
        if (!is_user()) {
            redirect(base_url());
        }
        
        $data = array();
        $data['page_title'] = 'Payment Settings';      
        $data['page'] = 'Payment';   
        $data['settings'] = $this->admin_model->get('settings');
        $data['currencies'] = $this->admin_model->select_asc('country');
        $data['packages'] = $this->admin_model->select_asc('package');
        $data['users'] = $this->admin_model->get_users();
        $data['main_content'] = $this->load->view('admin/user_payment_settings',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function convert_currency($amount='', $from_currency='', $invoice_id)
    {

        $invoice = $this->admin_model->get_invoice_details($invoice_id);

        if ($from_currency == $invoice->currency_code) {
            $conversion = '';
            $convert_total = $amount;
        } else {
            $amount = str_replace(",", "", $amount);
            $result = ($amount / get_rate($from_currency)) * get_rate($invoice->currency_code);
            $convert_total = number_format($result, 2);
        }
        
        return $convert_total;
    }



    public function online($type, $invoice_id)
    {
        $data = array();
        if ($_POST) {
            $convert_amount = $this->convert_currency($this->input->post('amount'), $this->input->post('currency_code'), $invoice_id);
            $data['final_amount'] = $convert_amount;
            $data['amount'] = $this->input->post('amount');
        }
  
        $data['page_title'] = 'Online Payment';   
        $data['type'] = $type;   
        $data['page'] = 'Invoice';   
        $data['invoice'] = $this->admin_model->get_invoice_details($invoice_id);
        $data['user'] = $this->admin_model->get_by_id($data['invoice']->user_id, 'users');
        $data['main_content'] = $this->load->view('admin/user/online_payment',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    //update settings
    public function update(){
        //check auth
        if (!is_admin()) {
            redirect(base_url());
        }
        

        if ($_POST) {
            
            if(!empty($this->input->post('paypal_payment'))){$paypal_payment = $this->input->post('paypal_payment', true);}
            else{$paypal_payment = 0;}

            if(!empty($this->input->post('stripe_payment'))){$stripe_payment = $this->input->post('stripe_payment', true);}
            else{$stripe_payment = 0;}

            if(!empty($this->input->post('razorpay_payment'))){$razorpay_payment = $this->input->post('razorpay_payment', true);}
            else{$razorpay_payment = 0;}
            
            $country = $this->admin_model->get_by_id($this->input->post('currency'), 'country');
            $data = array(
                'country' => $this->input->post('currency', true),
                'currency' => $country->currency_code,
                'paypal_mode' => $this->input->post('paypal_mode', true),
                'paypal_email' => $this->input->post('paypal_email', true),
                'publish_key' => $this->input->post('publish_key', true),
                'secret_key' => $this->input->post('secret_key', true),
                'razorpay_key_id' => $this->input->post('razorpay_key_id', true),
                'razorpay_key_secret' => $this->input->post('razorpay_key_secret', true),
                'paypal_payment' => $paypal_payment,
                'stripe_payment' => $stripe_payment,
                'razorpay_payment' => $razorpay_payment 
            );
            $data = $this->security->xss_clean($data);
            $this->admin_model->edit_option($data, 1, 'settings');
            redirect($_SERVER['HTTP_REFERER']);

        }
    }



    //update settings
    public function user_update(){
        //check auth
        if (!is_user()) {
            redirect(base_url());
        }

        if ($_POST) {
            
            if(!empty($this->input->post('paypal_payment'))){$paypal_payment = $this->input->post('paypal_payment', true);}
            else{$paypal_payment = 0;}

            if(!empty($this->input->post('stripe_payment'))){$stripe_payment = $this->input->post('stripe_payment', true);}
            else{$stripe_payment = 0;}

            if(!empty($this->input->post('razorpay_payment'))){$razorpay_payment = $this->input->post('razorpay_payment', true);}
            else{$razorpay_payment = 0;}
            
            $data = array(
                'paypal_email' => $this->input->post('paypal_email', true),
                'publish_key' => $this->input->post('publish_key', true),
                'secret_key' => $this->input->post('secret_key', true),
                'razorpay_key_id' => $this->input->post('razorpay_key_id', true),
                'razorpay_key_secret' => $this->input->post('razorpay_key_secret', true),
                'paypal_payment' => $paypal_payment,
                'stripe_payment' => $stripe_payment,
                'razorpay_payment' => $razorpay_payment 
            );
            $data = $this->security->xss_clean($data);
            $this->admin_model->edit_option($data, user()->id, 'users');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }


    public function offline_payment()
    {	
        //check auth
        if (!is_admin()) {
            redirect(base_url());
        }
        
        if($_POST)
        {   
            $package = $this->common_model->get_by_id($this->input->post('package'), 'package');
            $payment = $this->common_model->check_user_payment($this->input->post('user'));


            if($this->input->post('billing_type') =='monthly'):
                if (settings()->enable_discount == 1){
                    $amount = get_discount($package->monthly_price, $package->dis_month); 
                }else{
                    $amount = $package->monthly_price; 
                }
                $expire_on = date('Y-m-d', strtotime('+1 month'));
            else:
                if (settings()->enable_discount == 1){
                    $amount = get_discount($package->price, $package->dis_year); 
                }else{
                    $amount = $package->price; 
                }
                $expire_on = date('Y-m-d', strtotime('+12 month'));
            endif;

            //validate inputs
            $this->form_validation->set_rules('user', "User", 'required');
            $this->form_validation->set_rules('package', "Package", 'required');
            $this->form_validation->set_rules('status', "Payment status", 'required');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('errors', validation_errors());
                redirect(base_url('admin/payment'));
            } else {
                
                $data=array(
                    'user_id' => $this->input->post('user', true),
                    'puid' => random_string('numeric',5),
                    'package' => $this->input->post('package', true),
                    'billing_type' => $this->input->post('billing_type', true),
                    'amount' => $amount,
                    'status' => $this->input->post('status', true),
                    'created_at' => my_date_now(),
                    'expire_on' => $expire_on
                );
                $data = $this->security->xss_clean($data);

                if (empty($payment)) {
                    $this->admin_model->insert($data, 'payment');

                    $user_data = array(
                        'user_type' => 'registered'      
                    );
                    $user_data = $this->security->xss_clean($user_data);
                    $this->admin_model->edit_option($user_data, $this->input->post('user'), 'users');

                } else {
                    $this->admin_model->update_payment($data, $this->input->post('user'), 'payment');
                }

                $this->session->set_flashdata('msg', trans('payment-added-successfully')); 
                redirect(base_url('admin/Payment'));

            }
        }      
        
    }


    public function convert_payment($amount='', $from_currency='', $biz_curr='')
    {
        if (empty($from_currency)) {
            return $amount;
        } else {
            $result = ($amount / get_rate($from_currency)) * get_rate($biz_curr);
            $rate = (1 / get_rate($from_currency)) * get_rate($biz_curr);
            $convert_total = str_replace(",", "", $result);
            return $convert_total;
        }
    }


    //payment success
    public function payment_success($invoice_id, $amount='')
    {   

        $invoice = $this->admin_model->get_invoice_details(md5($invoice_id));
        $customer = $this->admin_model->get_customer_info($invoice->customer, 'customers');

        if ($invoice->parent_id == 0) {
            $invoice_id = $invoice->id;
        } else {
            $invoice_id = $invoice->parent_id;
        }


        if(get_total_invoice_payments($invoice->id, $invoice->parent_id) == $invoice->grand_total){
            $status = 2;
        } else {
            $status = 1;
        }  

        if (!empty($this->input->post('payment_method'))) {
            $payment_method = $this->input->post('payment_method', true);
        } else {
            $payment_method = '0';
        }

        $paydata=array(
            'amount' => $amount,
            'convert_amount' => $this->convert_payment($amount, $customer->currency_code, $invoice->currency_code),
            'customer_id' => $invoice->customer,
            'invoice_id' => $invoice_id,
            'business_id' => $invoice->uid,
            'payment_date' => date('Y-m-d'),
            'payment_method' => $payment_method,
            'type' => 'income'
        );
        $paydata = $this->security->xss_clean($paydata);
        $this->admin_model->insert($paydata, 'payment_records');


        $total_payment = get_total_invoice_payments($invoice->id, $invoice->parent_id);

        if($amount == $invoice->grand_total){
            $status = 2;
        } else {
            if ($total_payment == $invoice->grand_total) {
                $status = 2;
            } else {
                $status = 1;
            }
        }  

        $invoice_data=array(
            'status' => $status
        );
        $this->admin_model->edit_option($invoice_data, $invoice->id, 'invoice');

        redirect(base_url('admin/payment/success'));

    }

    public function success(){
        $data = array();
        $data['success_msg'] = 'Success';
        $data['main_content'] = $this->load->view('admin/user/online_payment_msg', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    //payment cancel
    public function payment_cancel($invoice_id)
    {   
        $data = array();
        $data['error_msg'] = 'Error';
        $data['main_content'] = $this->load->view('admin/user/online_payment_msg', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    //stripe payment
    public function stripe_payment($invoice_id, $amount, $cus_amount='')
    {
        
        $invoice = $this->admin_model->get_invoice_details(md5($invoice_id));
        $user = $this->common_model->get_by_id($invoice->user_id, 'users');
        $amount = $amount; 
        
        require_once('application/libraries/stripe-php/init.php');
        \Stripe\Stripe::setApiKey($user->secret_key);
        
        try {
            $charge = \Stripe\Charge::create ([
                "amount" => $amount*100,
                "currency" => $invoice->currency_code,
                "source" => $this->input->post('stripeToken'),
                "description" => "Payment from ".get_settings()->site_name 
            ]);
            $chargeJson = $charge->jsonSerialize();
            
            $amount                  = $chargeJson['amount']/100;
            $balance_transaction     = $chargeJson['balance_transaction'];
            $currency                = $chargeJson['currency'];
            $status                  = $chargeJson['status'];
            $payment = 'success';
        }catch(Exception $e) { 
            $error = $e->getMessage(); 
            $this->session->set_flashdata('error', $error);
            $payment = 'failed';
        }

        if($payment == 'success'):  
            redirect(base_url('admin/payment/payment_success/'.$invoice_id.'/'.$cus_amount));
        else:
            redirect(base_url('admin/payment/payment_cancel/'.$invoice_id));
        endif;
    }


    public function receipt($puid)
    {
        $data = array();
        $data['page_title'] = 'Payment Receipt'; 
        $data['user'] = $this->admin_model->get_user_payment_details($puid);
        $data['main_content'] = $this->load->view('admin/payment_invoice_receipt',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    public function lists()
    {
        $data = array();
        $data['page_title'] = 'Payment list';
        $data['payments'] = $this->admin_model->get_users_payment_lists(user()->id);
        $data['main_content'] = $this->load->view('admin/payment_invoice_lists',$data,TRUE);
        $this->load->view('admin/index',$data);
    }



    public function razorpay() {
        $data = array();
        $data['page_title'] = 'Payment';
        $data['return_url'] = base_url().'admin/payment/callback';
        $data['surl'] = base_url().'admin/payment/success';;
        $data['furl'] = base_url().'admin/payment/failed';;
        $data['currency_code'] = 'INR';
        $data['main_content'] = $this->load->view('admin/razorpay',$data,TRUE);
        $this->load->view('admin/index',$data);
    }




}
	

