<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Razorpay extends Home_Controller 
{

    public function __construct()
    {
        parent::__construct();
    }


    // initialized cURL Request
    private function get_curl_handle($payment_id, $amount)  {
        $url = 'https://api.razorpay.com/v1/payments/'.$payment_id.'/capture';
        $key_id = settings()->razorpay_key_id;
        $key_secret = settings()->razorpay_key_secret;
        $fields_string = "amount=$amount";
        //cURL Request
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $key_id.':'.$key_secret);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__).'/ca-bundle.crt');
        return $ch;
    }   
        
    // callback method
    public function payment() {        
        
        if (!empty($this->input->post('razorpay_payment_id')) && !empty($this->input->post('merchant_order_id'))) {
            
            $razorpay_payment_id = $this->input->post('razorpay_payment_id');
            $package_id = $this->input->post('merchant_order_id');
            $currency_code = settings()->currency;
            //$amount = $this->input->post('merchant_total');
            $success = false;
            $error = '';

            $package = $this->common_model->get_by_id($package_id, 'package');
            $puid = random_string('numeric',5);
            $billing_type = $this->input->post('billing_type');
            
            if($billing_type =='monthly'):
                if (settings()->enable_discount == 1){
                    $amount = get_discount($package->monthly_price, $package->dis_month); 
                }else{
                    $amount = round($package->monthly_price); 
                }
                $expire_on = date('Y-m-d', strtotime('+1 month'));
            else:
                if (settings()->enable_discount == 1){
                    $amount = get_discount($package->price, $package->dis_year); 
                }else{
                    $amount = round($package->price); 
                }
                $expire_on = date('Y-m-d', strtotime('+12 month'));
            endif;



            try {                

                $ch = $this->get_curl_handle($razorpay_payment_id, $amount);
                //execute post
                $result = curl_exec($ch);
                $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                if ($result === false) {
                    $success = false;
                    $error = 'Curl error: '.curl_error($ch);
                } else {
                    $response_array = json_decode($result, true);
                    //echo "<pre>"; print_r($response_array); exit();

                        //Check success response
                        if ($http_status === 200 and isset($response_array['error']) === false) {
                            $success = true;
                        } else {
                            $success = false;
                            if (!empty($response_array['error']['code'])) {
                                $error = $response_array['error']['code'].':'.$response_array['error']['description'];
                            } else {
                                $error = 'RAZORPAY_ERROR:Invalid Response <br/>'.$result;
                            }
                        }
                }
                //close connection
                curl_close($ch);
            } catch (Exception $e) {
                $success = false;
                $error = 'OPENCART_ERROR:Request to Razorpay Failed';
            }
            
            if ($success === false) {

                $payments = $this->admin_model->get_previous_payments(user()->id);
                foreach ($payments as $pay) {
                    $pays_data=array(
                        'status' => 'expired'
                    );
                    $this->common_model->edit_option($pays_data, $pay->id, 'payment');
                }

                $pay_data=array(
                    'user_id' => user()->id,
                    'puid' => $puid,
                    'package' => $package_id,
                    'amount' => $amount,
                    'billing_type' => $billing_type,
                    'payment_type' => 'razorpay',
                    'status' => $status,
                    'created_at' => my_date_now(),
                    'expire_on' => $expire_on
                );
                $pay_data = $this->security->xss_clean($pay_data);
                $result = $this->common_model->insert($pay_data, 'payment');

                if (user()->user_type == 'trial') {
                    $user_data=array(
                        'user_type' => 'registered',
                        'trial_expire' => '0000-00-00'
                    );
                    $this->common_model->edit_option($user_data, user()->id, 'users');
                }



                if(!empty($this->session->userdata('ci_subscription_keys'))) {
                    $this->session->unset_userdata('ci_subscription_keys');
                }
                
                redirect(base_url('payment-success/'.$puid));
                
 
            } else {
                redirect(base_url('payment-cancel/'.$puid));
            }
        } else {
            redirect(base_url('payment-cancel/'.$puid));
        }
    } 


    // user payment

    // initialized cURL Request
    private function get_user_curl_handle($payment_id, $amount, $user_id)  {
    	$user = $this->common_model->get_by_id($user_id, 'users');
        $url = 'https://api.razorpay.com/v1/payments/'.$payment_id.'/capture';
        $key_id = $user->razorpay_key_id;
        $key_secret = $user->razorpay_key_secret;
        $fields_string = "amount=$amount";
        //cURL Request
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $key_id.':'.$key_secret);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__).'/ca-bundle.crt');
        return $ch;
    }   
        
    // callback method
    public function user_payment($invoice_id, $amount, $cus_amount='') {        
        
        if (!empty($this->input->post('razorpay_payment_id')) && !empty($this->input->post('merchant_order_id'))) {

            $razorpay_payment_id = $this->input->post('razorpay_payment_id');
            $currency_code = $invoice->currency_code;
            $success = false;
            $error = '';

            $invoice = $this->admin_model->get_invoice_details(md5($invoice_id));
	        $user = $this->common_model->get_by_id($invoice->user_id, 'users'); 
          
            try {                

                $ch = $this->get_user_curl_handle($razorpay_payment_id, $amount, $invoice->user_id);
                //execute post
                $result = curl_exec($ch);
                $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                if ($result === false) {
                    $success = false;
                    $error = 'Curl error: '.curl_error($ch);
                } else {
                    $response_array = json_decode($result, true);
                    //echo "<pre>"; print_r($response_array); exit();

                        //Check success response
                        if ($http_status === 200 and isset($response_array['error']) === false) {
                            $success = true;
                        } else {
                            $success = false;
                            if (!empty($response_array['error']['code'])) {
                                $error = $response_array['error']['code'].':'.$response_array['error']['description'];
                            } else {
                                $error = 'RAZORPAY_ERROR:Invalid Response <br/>'.$result;
                            }
                        }
                }
                //close connection
                curl_close($ch);
            } catch (Exception $e) {
                $success = false;
                $error = 'OPENCART_ERROR:Request to Razorpay Failed';
            }
            
            if ($success === false) {

                if(!empty($this->session->userdata('ci_subscription_keys'))) {
                    $this->session->unset_userdata('ci_subscription_keys');
                }
                
                redirect(base_url('admin/payment/payment_success/'.$invoice_id.'/'.$cus_amount));
                
 
            } else {
                redirect(base_url('admin/payment/payment_cancel/'.$invoice_id));
            }
        } else {
            redirect(base_url('admin/payment/payment_cancel/'.$invoice_id));
        }
    } 


}