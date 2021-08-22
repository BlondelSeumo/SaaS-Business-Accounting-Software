<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stripe extends Home_Controller {
	public function __construct(){
		parent::__construct();
        //$this->config->load('stripe_config');
	}
	

	public function index($slug='')
	{
		$data = array();
		$data['page_title'] = "Stripe Payment";
		$data['slug'] = $slug;
		
		// $data['package'] = $this->admin_m->get_id_by_package_slug($account_slug);
		// $data['u_info'] = get_all_user_info_slug($slug);
		//$data['main_content'] = $this->load->view('stripe_payment_form', $data, TRUE);
		$this->load->view('stripe_payment_form', $data);
		
	}


	public function stripe_success($slug)
	{
		$data = array();
		$data['page_title'] = "Stripe Payment";
		$data['slug'] = $slug;
		$data['status'] = 1;
		$data['msg'] = 'Stripe Payment Successfull';
		$data['u_info'] = get_all_user_info_slug($slug);
		$data['main_content'] = $this->load->view('payment/payment_success', $data, TRUE);
		$this->load->view('payment_index',$data);
		
	}


	public function payment()
    {
        require_once('application/libraries/stripe-php/init.php');
    
        \Stripe\Stripe::setApiKey('sk_test_zHkX8tpxqezUjxwKKrOENoKH00i4EnkxdN');
     
        \Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $this->input->post('stripeToken'),
                "description" => "Test payment from itsolutionstuff.com." 
        ]);
            
        $this->session->set_flashdata('success', 'Payment made successfully.');
             
        redirect('/my-stripe', 'refresh');
    }



	public function payment__()
	{
		
		require_once('application/libraries/stripe-php/init.php');
		// $slug = $this->input->post('slug');
		// $account_type = $this->input->post('account_type');
		// $settings = get_setting();
		// $u_info = get_all_user_info_slug($slug);
		// $package_info = get_package_info_by_id($account_type);

       \Stripe\Stripe::setApiKey('sk_test_oVpOg0GTfktOl7HNdud0Heq800GZwIz1R5');

        
        $charge = \Stripe\Charge::create ([

                "amount" => 20*100,
                "currency" => "usd",
                "source" => $this->input->post('stripeToken'),
                "description" => "Test payment from itsolutionstuff.com." 
        ]);
       $chargeJson = $charge->jsonSerialize();
       $amount                  = $chargeJson['amount']/100;
	   $balance_transaction     = $chargeJson['balance_transaction'];
	   $currency                = $chargeJson['currency'];
	   $status                  = $chargeJson['status'];

	   $data = array(
	   		'user_id' => 2,
	   		'account_type' => 1,
	   		'price' => 20,
	   		'currency_code' => $currency,
	   		'txn_id' => $balance_transaction,
	   		'status' => $status,
	   		'payment_type' => 2,
	   		'created_at' => d_time(),
	   );
	   echo "<pre>"; print_r($data); exit();
	   $insert = $this->common_m->insert($data,'payment_info');
	   if($insert):  
	   		$this->common_m->update(array('is_payment'=>1,'is_expired'=>0,'start_date'=>d_time(),'end_date'=>add_year($package_info['type']),'account_type'=>$account_type),$u_info['user_id'],'users');

	        $this->email_m->send_payment_paid_email($data,'Credit Card'); // send payment transaction succesfull mail with transaction id

		    if(isset($settings['admin_invoice']) && $settings['admin_invoice']==1):
	        	$this->email_m->get_paid_invoice_to_admin($data,'Credit Card');
	        endif;
            redirect(base_url('stripe-payment-success/'.$u_info['username']));
    	endif;
	}

	public function offline_payment($slug,$account_slug)
	{
		$data = array();
		$data['page_title'] = "Offline Payment";
		$data['slug'] = $slug;
		
		$send = $this->email_m->offline_payment_request_mail($slug,$account_slug);
		if($send==TRUE){
			$data['status'] = 1;
			$data['msg'] = 'Offline payment request send successfully';
		}else{
			$data['status'] = 0;
			$data['msg'] = 'Somethings Were Wrong!! Try again ';
		}
		$data['u_info'] = get_all_user_info_slug($slug);
		$data['main_content'] = $this->load->view('payment/payment_success', $data, TRUE);
		$this->load->view('payment_index',$data);
	}

}

