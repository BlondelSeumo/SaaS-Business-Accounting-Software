<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 	
	//check admin
	if (!function_exists('is_admin')) 
	{
	    function is_admin()
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->auth_model->is_admin();
	    }
	}

	//check user
	if (!function_exists('is_user')) 
	{
	    function is_user()
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->auth_model->is_user();
	    }
	}

	
	//check auth
	if (!function_exists('check_auth')) 
	{
	    function check_auth()
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->auth_model->is_logged_in();
	    }
	}


	//check auth
	if (!function_exists('check_email_verify')) 
	{
	    function check_email_verify()
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();

	        $user = $ci->auth_model->get_logged_user();
	        if (!empty($user) && $user->email_verified == 1) 
			{
				return TRUE;
	        } else {
	            return FALSE;
	        }
	    }
	}



	//get logged user
	if (!function_exists('user')) 
	{
	    function user()
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        $user = $ci->auth_model->get_logged_user();
	        if (empty($user)) 
			{
	            $ci->auth_model->logout();
	        } else {
	            return $user;
	        }

	    }
	}


	

	if (!function_exists('update_version')) 
	{
	    function update_version()
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        $settings = $ci->admin_model->get('settings');
	        if ($settings->version == 'v1.3') {
	            $data = array(
	                'version' => 'v1.4'
	            );
	            //$ci->admin_model->edit_option($data, 1, 'settings');
	        }

	    }
	}



	if (!function_exists('hash_password')) {
	    function hash_password($password)
	    {	
	    	$ci =& get_instance();
	        return password_hash($password, PASSWORD_BCRYPT);
	    }
	}

	

	// current date time function
	if(!function_exists('my_date_now')){
	    function my_date_now(){        
	        $dt = new DateTime('now', new DateTimezone(get_time_zone()));
	        $date_time = $dt->format('Y-m-d H:i:s');      
	        return $date_time;
	    }
	}

	// show current date & time with custom format
	if(!function_exists('my_date_show_time')){
	    function my_date_show_time($date){       
	        if($date != ''){
	            $date2 = date_create($date);
	            $date_new = date_format($date2,"d M Y h:i A");
	            return $date_new;
	        }else{
	            return '';
	        }
	    }
	}

	// show current date with custom format
	if(!function_exists('my_date_show')){
	    function my_date_show($date){       
	        
	        if($date != ''){
	            $date2 = date_create($date);
	            $date_new = date_format($date2,"d M Y");
	            return $date_new;
	        }else{
	            return '';
	        }
	    }
	}

	// show current date with custom format
	if(!function_exists('month_show')){
	    function month_show($date){       
	        
	        if($date != ''){
	            $date2 = date_create($date);
	            $date_new = date_format($date2,"M Y");
	            return $date_new;
	        }else{
	            return '';
	        }
	    }
	}

	// show current date with custom format
	if(!function_exists('show_year')){
	    function show_year($date){       
	        
	        if($date != ''){
	            $date2 = date_create($date);
	            $date_new = date_format($date2,"Y");
	            return $date_new;
	        }else{
	            return '';
	        }
	    }
	}

	// get discount
	if(!function_exists('get_discount')){
	    function get_discount($total, $discount_amount){       
	        $total = $total - ($total * ($discount_amount/100));
	        return round($total);
	    }
	}


	if (!function_exists('get_user_payment')) 
	{
	    function get_user_payment($user_id)
	    {	
	    	$ci =& get_instance();
	        $response = $ci->common_model->check_user_payment($user_id);
	        if (isset($response)) {
	        	return $response->status;
	        } else {
	        	return false;
	        }
	    }
	}


	if (!function_exists('get_user_payment_details')) 
	{
	    function get_user_payment_details($user_id)
	    {	
	    	$ci =& get_instance();
	        $response = $ci->common_model->check_user_payment($user_id);
	        return $response;
	    }
	}


	if (!function_exists('get_total_user_by_package')) 
	{
	    function get_total_user_by_package($package_id)
	    {	
	    	$ci =& get_instance();
	        $response = $ci->admin_model->get_total_user_by_package($package_id);
	        return $response;
	    }
	}

	// get discount
	if(!function_exists('get_total_value')){
	    function get_total_value($table, $type){            
	        $ci = get_instance();
	        $user = $ci->common_model->get_user_payment();
	        $value = $ci->common_model->get_total_value($table, $user->created_at, $type);
	        return $value;
	    }
	}

	// get discount
	if(!function_exists('get_total_value_by_parent')){
	    function get_total_value_by_parent($table, $type){            
	        $ci = get_instance();
	        $user = $ci->common_model->get_user_payment();
	        $value = $ci->common_model->get_total_value_by_parent($table, $user->created_at, $type);
	        return $value;
	    }
	}


	if (!function_exists('check_package_status')) 
	{
	    function check_package_status($slug)
	    {	
	    	$ci =& get_instance();
	        $response = $ci->common_model->check_package_status($slug);
	        return $response;
	    }
	}

	// check package limit
    if(!function_exists('check_package_limit'))
    {
	    function check_package_limit($slug){        
	        $ci = get_instance();
	   
	        $user = $ci->common_model->get_user_payment();
	        if (!empty($user)) {
            	$package = $ci->common_model->get_package_by_id($user->package); 
	  
		        if ($user->billing_type == 'yearly') {
		        	$pkslug = 'year_'.$package->slug;
		        } else {
		        	$pkslug = $package->slug;
		        }
		        $feature = $ci->common_model->check_package_limit($slug);
		        return $feature->$pkslug; 
            } else {
            	return true;
            }
	    }
	}

	//get days
	if (!function_exists('get_days')) {
	    function get_days()
	    {
	        $days = array(
	        	'1'=>'Saturday',
	        	'2'=>'Sunday',
	        	'3'=>'Monday',
	        	'4'=>'Tuesday',
	        	'5'=>'Wednesday',
	        	'6'=>'Thursday',
	        	'7'=>'Friday'
	        );
	        return $days;
	    }
	}

	//get payment methods
	if (!function_exists('get_payment_methods')) {
	    function get_payment_methods()
	    {
	        $days = array(
	        	'1' => 'Bank payment',
                '2' => 'Cash',
                '3' => 'Cheque',
                '4' => 'Stripe',
                '5' => 'Paypal',
                '6' => 'Others'
	        );
	        return $days;
	    }
	}


	//get payment methods
	if (!function_exists('get_business_position')) {
	    function get_business_position($id='')
	    {
	        $positions = array(
	        	'1' => 'Business Partner/Co-owner',
				'2' => 'Accountant/Bookkeeper',
				'3' => 'Family Member',
				'4' => 'Salesperson',
				'5' => 'Assistant',
				'6' => 'Block Advisors Tax Pro',
				'7' => 'Other'
	        );
	        if (is_numeric($id)) {
	        	return $positions[$id];
	        } else {
	        	return $positions;
	        }
	    }
	}


	//get role name
	if (!function_exists('get_role_name')) {
	    function get_role_name($value)
	    {
	    	if ($value == 'subadmin') {
	    		return 'Admin';
	    	}else {
	    		return ucfirst($value);
	    	}
	    }
	}


	//get session user
	if (!function_exists('auth')) 
	{
	    function auth($value)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->session->userdata($value);

	    }
	}




	//get payment methods
	if (!function_exists('get_using_methods')) {
	    function get_using_methods($value)
	    {
	    	if ($value == 1) {
	    		return 'Bank payment';
	    	}elseif ($value == 2) {
	    		return 'Cash';
	    	}elseif ($value == 3) {
	    		return 'Cheque';
	    	}elseif ($value == 4) {
	    		return 'Stripe';
	    	}elseif ($value == 5) {
	    		return 'Paypal';
	    	} else {
	    		return 'Others';
	    	}
	    }
	}

	// format numbers 
	function money_formats($num) {
        $explrestunits = "" ;
        if(strlen($num)>3) {
            $lastthree = substr($num, strlen($num)-3, strlen($num));
            $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
            $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
            $expunit = str_split($restunits, 2);
            for($i=0; $i<sizeof($expunit); $i++) {
                // creates each of the 2's group and adds a comma to the end
                if($i==0) {
                    $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
                } else {
                    $explrestunits .= $expunit[$i].",";
                }
            }
            $thecash = $explrestunits.$lastthree;
        } else {
            $thecash = $num;
        }
        return $thecash; // final format
    }


	//transalate language
	if (!function_exists('trans')) 
	{
	    function trans($string)
	    {
	        $ci =& get_instance();
	        return $ci->lang->line($string);
	    }
	}


	//get language short form
	if (!function_exists('lang_short_form')) 
	{
	    function lang_short_form()
	    {
	        $ci =& get_instance();
	        if ($ci->session->userdata('site_lang') == '') {
	        	$lang = $ci->common_model->get_settings(); 
		        return $lang->short_name;
	        } else {
	        	$name = $ci->session->userdata('site_lang');
	        	$lang = $ci->common_model->get_slug_by_language($name, 'language');
	        	return $lang->short_name;
	        }
	        
	    }
	}


	//get language direction
	if (!function_exists('text_dir')) 
	{
	    function text_dir()
	    {
	        $ci =& get_instance();
	        if ($ci->session->userdata('site_lang') == '') {

		        $lang = $ci->common_model->get_settings(); 
		        return $lang->dir;
	        } else {
	        	$name = $ci->session->userdata('site_lang');
	        	$lang = $ci->common_model->get_slug_by_language($name, 'language');
	        	return $lang->text_direction;
	        }
	    }
	}


	//get language
	if (!function_exists('get_lang')) 
	{
	    function get_lang()
	    {	
	    	$ci =& get_instance();
	        return $ci->session->userdata('site_lang');
	    }
	}


	//get language values
	if (!function_exists('get_language_values')) 
	{
	    function get_language_values()
	    {	
	    	$ci =& get_instance();
	        $option = $ci->admin_model->get_language_values();
	        return $option;
	    }
	}


	//get language
	if (!function_exists('get_language')) 
	{
	    function get_language()
	    {	
	    	$ci =& get_instance();
	        $option = $ci->admin_model->get_language();
	        return $option;
	    }
	}


	// check my payment status
	if(!function_exists('check_payment_status')){
	    function check_payment_status(){        
	        $ci = get_instance();
	        $payment = $ci->common_model->get_user_payment();
	        if (!empty(user()) && user()->user_type == 'trial') {
	        	return TRUE;
	        }else{
		        if (isset($payment) && $payment->status == 'verified') {
		        	return TRUE;
		        } else {
		        	return FALSE;
		        }
		    }
	    }
    } 


    // check my payment status
	if(!function_exists('check_paid_status')){
	    function check_paid_status($id){        
	        $ci = get_instance();
	        $response = $ci->admin_model->check_paid_status($id);
	        return $response;
	    }
    } 


    //get language values
	if (!function_exists('check_recurring_payments')) 
	{
	    function check_recurring_payments()
	    {	
	    	$ci =& get_instance();
	        $ci->admin_model->check_recurring_payments();
	        return;
	    }
	}

	//get currency
	if (!function_exists('convert_currency')) {
		function convert_currency($amount, $from, $to) {
	        $string = $from . "_" . $to;
	        $url = 'http://free.currencyconverterapi.com/api/v5/convert?q=' . $from .'_' . $to . '&compact=ultra&apiKey=fd3e4ac06ed79c18aab8';
	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL, $url);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        $response = curl_exec($ch);
	        $response = json_decode($response, true);
	        curl_close($ch);
	        $rate = $response[$string];
	        return $rate;
	    }
    }


    if(!function_exists('get_update_logs')){
		function get_update_logs()
		{	
			$server = $_SERVER;
			$http = 'http';
		    if (isset($server['HTTPS'])) {
		        $http = 'https';
		    }
		    $host = $server['HTTP_HOST'];
		    $requestUri = $server['REQUEST_URI'];
		    $page_url = $http . '://' . htmlentities($host) . '/' . htmlentities($requestUri);

		    $ci =& get_instance();
	     	$ci->load->model('common_model');
	     	$curr = $ci->common_model->get_settings();
	        if (empty($curr->ind_code) || strlen($curr->ind_code) != 40 || strlen($curr->purchase_code) != 36) {
		        $url = "https://www.originlabsoft.com/api/verify?domain=" . $page_url;
		        $ch = curl_init();
		        curl_setopt($ch, CURLOPT_URL, $url);
		        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		        $response = curl_exec($ch);
		        curl_close($ch);
		        $data = json_decode($response);
		    }
		}
	}


    //get currency
	if (!function_exists('get_rate')) {
		function get_rate($code) {
	        $ci =& get_instance();
	        $result = $ci->admin_model->get_rates($code);
	        return $result;
	    }
    }

    //get currency
	if (!function_exists('get_customer_currency')) {
		function get_customer_currency($id) {
	        $ci =& get_instance();
	        $result = $ci->admin_model->get_customer_info($id);
	        return $result;
	    }
    }

	//count invoice
	if (!function_exists('helper_count_invoices')) {
	    function helper_count_invoices($status, $type)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->admin_model->count_invoices_by_type($status, $type);
	    }
	}


	//count invoice
	if (!function_exists('count_recurring_invoices')) {
	    function count_recurring_invoices()
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->admin_model->count_recurring_invoices();
	    }
	}



	//get customer
	if (!function_exists('get_expense_by_year')) {
	    function get_expense_by_year($year)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        $expens1 = $ci->admin_model->get_expense_by_year($year);
	        $expens2 = $ci->admin_model->get_expense_by_year2($year);
	        return $expens1 + $expens2;
	    }
	}


	//get customer income
	if (!function_exists('get_incomes_by_customer')) {
	    function get_incomes_by_customer($id, $type)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->admin_model->get_incomes_by_customer($id, $type);
	    }
	}


	//get paid income customer 
	if (!function_exists('get_paid_incomes_by_customer')) {
	    function get_paid_incomes_by_customer($id, $type)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->admin_model->get_paid_incomes_by_customer($id, $type);
	    }
	}

	
	//get customer
	if (!function_exists('helper_get_customer')) {
	    function helper_get_customer($id)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->admin_model->get_customer_info($id);
	    }
	}

	//get customer
	if (!function_exists('helper_get_vendor')) {
	    function helper_get_vendor($id)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->admin_model->get_vendor_info($id);
	    }
	}


	//get invoice tax
	if (!function_exists('get_invoice_tax')) {
	    function get_invoice_tax($id, $invoice_id)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        $tax = $ci->admin_model->get_invoice_tax($id, $invoice_id);
	        return $tax;
	    }
	}


	//get invoice tax
	if (!function_exists('get_invoice_payments')) {
	    function get_invoice_payments($id)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        $result = $ci->admin_model->get_invoice_payments($id);
	        return $result;
	    }
	}


	//get invoice tax
	if (!function_exists('get_tax_id')) {
	    function get_tax_id($id)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        $tax = $ci->admin_model->get_tax_id($id);
	        if (!empty($tax)) {
	        	return $tax;
	        } else {
	        	return FALSE;
	        }
	    }
	}

	//get invoice tax
	if (!function_exists('get_invoice_taxes')) {
	    function get_invoice_taxes($id)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        $taxes = $ci->admin_model->get_invoice_taxes($id);
	        if (!empty($taxes)) {
	        	foreach ($taxes as $tax) {
	        		$taxe[] =  $tax->tax_id;
	        	}
	        	//echo "<pre>"; print_r($taxe); exit();
	        	return $taxe;
	        } else {
	        	return FALSE;
	        }
	    }
	}

	//get invoice number
	if (!function_exists('get_invoice_number')) {
	    function get_invoice_number($type)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->admin_model->get_invoice_number(user()->id, $type);
	    }
	}


	//get invoice number
	if (!function_exists('get_auto_invoice_number')) {
	    function get_auto_invoice_number($type, $recurring)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->admin_model->get_auto_invoice_number(user()->id, $type, $recurring);
	    }
	}


	//get invoice items
	if (!function_exists('helper_get_invoice_items')) {
	    function helper_get_invoice_items($invoice_id)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->admin_model->get_invoice_items($invoice_id);
	    }
	}

	//get product
	if (!function_exists('helper_get_product')) {
	    function helper_get_product($product_id)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->admin_model->get_product($product_id);
	    }
	}


	//get category
	if (!function_exists('helper_get_category')) {
	    function helper_get_category($category_id)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->admin_model->get_category($category_id);
	    }
	}

	//get category
	if (!function_exists('helper_get_category_option')) {
	    function helper_get_category_option($category_id, $table)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->admin_model->get_category_option($category_id, $table);
	    }
	}


	//get payments
	if (!function_exists('get_total_invoice_payments')) {
	    function get_total_invoice_payments($invoice_id, $parent_id)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        $payment = $ci->admin_model->check_invoice_payment_records($invoice_id, $parent_id);
	        if (empty($payment)) {
	        	return 0;
	        }else{
	        	return $payment->total;
	        }
	    }
	}


	//get records
	if (!function_exists('get_customer_advanced_record')) {
	    function get_customer_advanced_record($cus_id)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        $record = $ci->admin_model->get_customer_advanced_record($cus_id);
	        return $record;
	    }
	}

	//delete image from server
	if (!function_exists('delete_image_from_server')) {
	    function delete_image_from_server($path)
	    {
	        $full_path = FCPATH . $path;
	        if (strlen($path) > 15 && file_exists($full_path)) {
	            unlink($full_path);
	        }
	    }
	}


	// get settings
  	if(!function_exists('get_settings')){
	    function get_settings(){        
	        $ci = get_instance();
	        
	        $ci->load->model('admin_model');
	        $option = $ci->admin_model->get_settings();   
	        return $option;
	    }
    } 


    //get logged user
	if (!function_exists('settings')) 
	{
	    function settings()
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        $settings = $ci->admin_model->get_settings();
	        return $settings;
	    }
	}

	//get logged user
	if (!function_exists('currency_to_symbol')) 
	{
	    function currency_to_symbol($currency)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        $response = $ci->common_model->currency_to_symbol($currency);
	        return $response->currency_symbol;

	    }
	}

    //get currency
	if (!function_exists('get_my_business')) {
		function get_my_business() {
	        $ci =& get_instance();
	        if(auth('role') == 'user'){
	        	$result = $ci->common_model->get_my_all_business();
	        }else{
	        	$user = $ci->common_model->get_by_id(auth('parent'), 'users_role');
	        	$result = $ci->common_model->get_user_all_business($user->business_id);
	        }
	        return $result;
	    }
    }



    // get pages
  	if(!function_exists('get_pages')){
	    function get_pages(){        
	        $ci = get_instance();
	        $option = $ci->common_model->select_asc('pages');
	        return $option;
	    }
    } 


    // get author info
	if(!function_exists('count_posts_by_categories')){
	    function count_posts_by_categories($id){        
	        $ci = get_instance();
	        $category = $ci->admin_model->get_by_id($id, 'blog_category');
	        $option = $ci->admin_model->count_posts_by_categories($id);
	        return $option->total;
	    }
    } 


    if(!function_exists('get_time_zone')){
	    function get_time_zone(){        
	        $ci = get_instance();
	    	$time_zone = $ci->admin_model->get_by_id(settings()->time_zone, 'time_zone');
	    	return $time_zone->name;
	    }
	}


    // get author info
	if(!function_exists('get_logged_user')){
	    function get_logged_user($id){        
	        $ci = get_instance();
	        
	        $ci->load->model('admin_model');
	        $option = $ci->admin_model->get_by_id($id, 'users');
	        return $option;
	    }
    } 

    if(!function_exists('date_difference')){
	    function date_difference($date1){  
	    	$date2 = date('Y-m-d');
	        $datetime1 = date_create($date1);
	        $datetime2 = date_create($date2);
	        $interval = date_diff($datetime1, $datetime2);
	        return $interval->format('%a');
	    }
	}


	if(!function_exists('date_dif')){
	    function date_dif($date1, $date2){ 
	    	$date1 = date_create($date1);
			$date2 = date_create($date2);
			//difference between two dates
			$diff = date_diff($date1,$date2);
			//count days
			return $diff->format("%a")-1;
	    }
	}


	if(!function_exists('date_count')){
	    function date_count($date, $day){ 
	    	$result = date('Y-m-d', strtotime($date. ' +'.$day.' days'));
	    	if (empty($date) || empty($day)) {
	    		return FALSE;
	    	} else {
	    		return $result;
	    	}
	    }
	}

	

    if(!function_exists('get_time_ago')){
	    function get_time_ago($time_ago){        
	        $ci = get_instance();
	        
	        $dt = new DateTime('now', new DateTimezone(get_time_zone()));
	        $date_time = strtotime($dt->format('Y-m-d H:i:s')); 

	        $time_ago = strtotime($time_ago);
	        $cur_time   = $date_time;
	        $time_elapsed   = $cur_time - $time_ago;
	        $seconds    = $time_elapsed ;
	        $minutes    = round($time_elapsed / 60 );
	        $hours      = round($time_elapsed / 3600);
	        $days       = round($time_elapsed / 86400 );
	        $weeks      = round($time_elapsed / 604800);
	        $months     = round($time_elapsed / 2600640 );
	        $years      = round($time_elapsed / 31207680 );
	        // Seconds

	        //return $seconds;

	        if($seconds <= 60){
	            return "just now";
	        }
	        //Minutes
	        else if($minutes <=60){
	            if($minutes==1){
	                return "one minute ago";
	            }
	            else{
	                return "$minutes minutes ago";
	            }
	        }
	        //Hours
	        else if($hours <=24){
	            if($hours==1){
	                return "an hour ago";
	            }else{
	                return "$hours hrs ago";
	            }
	        }
	        //Days
	        else if($days <= 7){
	            if($days==1){
	                return "yesterday";
	            }else{
	                return "$days days ago";
	            }
	        }
	        //Weeks
	        else if($weeks <= 4.3){
	            if($weeks==1){
	                return "a week ago";
	            }else{
	                return "$weeks weeks ago";
	            }
	        }
	        //Months
	        else if($months <=12){
	            if($months==1){
	                return "a month ago";
	            }else{
	                return "$months months ago";
	            }
	        }
	        //Years
	        else{
	            if($years==1){
	                return "one year ago";
	            }else{
	                return "$years years ago";
	            }
	        }


	        
	    }
	}


	//slug generator
	if (!function_exists('str_slug')) {
	    function str_slug($str, $separator = 'dash', $lowercase = TRUE)
	    {
	        $str = trim($str);
	        $CI =& get_instance();
	        $foreign_characters = array(
	            '/ä|æ|ǽ/' => 'ae',
	            '/ö|œ/' => 'o',
	            '/ü/' => 'u',
	            '/Ä/' => 'Ae',
	            '/Ü/' => 'u',
	            '/Ö/' => 'o',
	            '/À|Á|Â|Ã|Ä|Å|Ǻ|Ā|Ă|Ą|Ǎ|Α|Ά|Ả|Ạ|Ầ|Ẫ|Ẩ|Ậ|Ằ|Ắ|Ẵ|Ẳ|Ặ|А/' => 'A',
	            '/à|á|â|ã|å|ǻ|ā|ă|ą|ǎ|ª|α|ά|ả|ạ|ầ|ấ|ẫ|ẩ|ậ|ằ|ắ|ẵ|ẳ|ặ|а/' => 'a',
	            '/Б/' => 'B',
	            '/б/' => 'b',
	            '/Ç|Ć|Ĉ|Ċ|Č/' => 'C',
	            '/ç|ć|ĉ|ċ|č/' => 'c',
	            '/Д/' => 'D',
	            '/д/' => 'd',
	            '/Ð|Ď|Đ|Δ/' => 'Dj',
	            '/ð|ď|đ|δ/' => 'dj',
	            '/È|É|Ê|Ë|Ē|Ĕ|Ė|Ę|Ě|Ε|Έ|Ẽ|Ẻ|Ẹ|Ề|Ế|Ễ|Ể|Ệ|Е|Э/' => 'E',
	            '/è|é|ê|ë|ē|ĕ|ė|ę|ě|έ|ε|ẽ|ẻ|ẹ|ề|ế|ễ|ể|ệ|е|э/' => 'e',
	            '/Ф/' => 'F',
	            '/ф/' => 'f',
	            '/Ĝ|Ğ|Ġ|Ģ|Γ|Г|Ґ/' => 'G',
	            '/ĝ|ğ|ġ|ģ|γ|г|ґ/' => 'g',
	            '/Ĥ|Ħ/' => 'H',
	            '/ĥ|ħ/' => 'h',
	            '/Ì|Í|Î|Ï|Ĩ|Ī|Ĭ|Ǐ|Į|İ|Η|Ή|Ί|Ι|Ϊ|Ỉ|Ị|И|Ы/' => 'I',
	            '/ì|í|î|ï|ĩ|ī|ĭ|ǐ|į|ı|η|ή|ί|ι|ϊ|ỉ|ị|и|ы|ї/' => 'i',
	            '/Ĵ/' => 'J',
	            '/ĵ/' => 'j',
	            '/Ķ|Κ|К/' => 'K',
	            '/ķ|κ|к/' => 'k',
	            '/Ĺ|Ļ|Ľ|Ŀ|Ł|Λ|Л/' => 'L',
	            '/ĺ|ļ|ľ|ŀ|ł|λ|л/' => 'l',
	            '/М/' => 'M',
	            '/м/' => 'm',
	            '/Ñ|Ń|Ņ|Ň|Ν|Н/' => 'N',
	            '/ñ|ń|ņ|ň|ŉ|ν|н/' => 'n',
	            '/Ò|Ó|Ô|Õ|Ō|Ŏ|Ǒ|Ő|Ơ|Ø|Ǿ|Ο|Ό|Ω|Ώ|Ỏ|Ọ|Ồ|Ố|Ỗ|Ổ|Ộ|Ờ|Ớ|Ỡ|Ở|Ợ|О/' => 'O',
	            '/ò|ó|ô|õ|ō|ŏ|ǒ|ő|ơ|ø|ǿ|º|ο|ό|ω|ώ|ỏ|ọ|ồ|ố|ỗ|ổ|ộ|ờ|ớ|ỡ|ở|ợ|о/' => 'o',
	            '/П/' => 'P',
	            '/п/' => 'p',
	            '/Ŕ|Ŗ|Ř|Ρ|Р/' => 'R',
	            '/ŕ|ŗ|ř|ρ|р/' => 'r',
	            '/Ś|Ŝ|Ş|Ș|Š|Σ|С/' => 'S',
	            '/ś|ŝ|ş|ș|š|ſ|σ|ς|с/' => 's',
	            '/Ț|Ţ|Ť|Ŧ|τ|Т/' => 'T',
	            '/ț|ţ|ť|ŧ|т/' => 't',
	            '/Þ|þ/' => 'th',
	            '/Ù|Ú|Û|Ũ|Ū|Ŭ|Ů|Ű|Ų|Ư|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ|Ũ|Ủ|Ụ|Ừ|Ứ|Ữ|Ử|Ự|У/' => 'U',
	            '/ù|ú|û|ũ|ū|ŭ|ů|ű|ų|ư|ǔ|ǖ|ǘ|ǚ|ǜ|υ|ύ|ϋ|ủ|ụ|ừ|ứ|ữ|ử|ự|у/' => 'u',
	            '/Ý|Ÿ|Ŷ|Υ|Ύ|Ϋ|Ỳ|Ỹ|Ỷ|Ỵ|Й/' => 'Y',
	            '/ý|ÿ|ŷ|ỳ|ỹ|ỷ|ỵ|й/' => 'y',
	            '/В/' => 'V',
	            '/в/' => 'v',
	            '/Ŵ/' => 'W',
	            '/ŵ/' => 'w',
	            '/Ź|Ż|Ž|Ζ|З/' => 'Z',
	            '/ź|ż|ž|ζ|з/' => 'z',
	            '/Æ|Ǽ/' => 'AE',
	            '/ß/' => 'ss',
	            '/Ĳ/' => 'IJ',
	            '/ĳ/' => 'ij',
	            '/Œ/' => 'OE',
	            '/ƒ/' => 'f',
	            '/ξ/' => 'ks',
	            '/π/' => 'p',
	            '/β/' => 'v',
	            '/μ/' => 'm',
	            '/ψ/' => 'ps',
	            '/Ё/' => 'Yo',
	            '/ё/' => 'yo',
	            '/Є/' => 'Ye',
	            '/є/' => 'ye',
	            '/Ї/' => 'Yi',
	            '/Ж/' => 'Zh',
	            '/ж/' => 'zh',
	            '/Х/' => 'Kh',
	            '/х/' => 'kh',
	            '/Ц/' => 'Ts',
	            '/ц/' => 'ts',
	            '/Ч/' => 'Ch',
	            '/ч/' => 'ch',
	            '/Ш/' => 'Sh',
	            '/ш/' => 'sh',
	            '/Щ/' => 'Shch',
	            '/щ/' => 'shch',
	            '/Ъ|ъ|Ь|ь/' => '',
	            '/Ю/' => 'Yu',
	            '/ю/' => 'yu',
	            '/Я/' => 'Ya',
	            '/я/' => 'ya'
	        );

	        $str = preg_replace(array_keys($foreign_characters), array_values($foreign_characters), $str);

	        $replace = ($separator == 'dash') ? '-' : '_';

	        $trans = array(
	            '&\#\d+?;' => '',
	            '&\S+?;' => '',
	            '\s+' => $replace,
	            '[^a-z0-9\-\._]' => '',
	            $replace . '+' => $replace,
	            $replace . '$' => $replace,
	            '^' . $replace => $replace,
	            '\.+$' => ''
	        );

	        $str = strip_tags($str);

	        foreach ($trans as $key => $val) {
	            $str = preg_replace("#" . $key . "#i", $val, $str);
	        }

	        if ($lowercase === TRUE) {
	            if (function_exists('mb_convert_case')) {
	                $str = mb_convert_case($str, MB_CASE_LOWER, "UTF-8");
	            } else {
	                $str = strtolower($str);
	            }
	        }

	        $str = preg_replace('#[^' . $CI->config->item('permitted_uri_chars') . ']#i', '', $str);

	        return trim(stripslashes($str));
	    }
	}











	//check role assign
	if (!function_exists('check_role_assign_features')) {
	    function check_role_assign_features($role, $feature_id)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->admin_model->check_role_assign_features($role, $feature_id);
	    }
	}


	//check view only
	if (!function_exists('check_role_view_only')) {
	    function check_role_view_only($role)
	    {
	        // Get a reference to the controller object
	        $ci =& get_instance();
	        return $ci->admin_model->check_role_view_only($role);
	    }
	}


	// get by id
	if(!function_exists('get_by_id')){
	    function get_by_id($id, $table){        
	        $ci = get_instance();
	        $option = $ci->admin_model->get_by_id($id, $table);
	        return $option;
	    }
    } 


    // get by id
	if(!function_exists('get_feature_slug')){
	    function get_feature_slug($id, $table){        
	        $ci = get_instance();
	        $option = $ci->admin_model->get_by_id($id, $table);
	        return $option->slug;
	    }
    } 


    // check permissions
	if(!function_exists('check_permissions')){
	    function check_permissions($role, $slug){        
	        $ci = get_instance();
	        $response = $ci->admin_model->check_permissions($role, $slug);
	        if (auth('role') == 'user' || auth('role') == 'viewer') {
	        	return TRUE;
	        } else {
	        	if (empty($response)) {
		            return FALSE;
		        } else {
		            return TRUE;
		        }
	        }
	    }
    } 