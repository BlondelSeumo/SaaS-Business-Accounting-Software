<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Home_Controller {

	public function __construct()
    {
        parent::__construct();
        //$this->update_currency();
    }
    
    public function index()
    {
        if (!is_admin()) {
            redirect(base_url());
        }
        $data = array();
        $data['currency'] = currency_to_symbol(settings()->currency);
        for ($i = 1; $i <= 13; $i++) {
            $months[] = date("Y-m", strtotime( date('Y-m-01')." -$i months"));
        }

        for ($i = 0; $i <= 11; $i++) {
            $income = $this->admin_model->get_admin_income_by_date(date("Y-m", strtotime( date('Y-m-01')." -$i months")));
            $months[] = array("date" => month_show(date("Y-m", strtotime( date('Y-m-01')." -$i months"))));
            $incomes[] = array("total" => number_format($income, 2));
        }

        $data['income_axis'] = json_encode(array_column($months, 'date'),JSON_NUMERIC_CHECK);
        $data['income_data'] = json_encode(array_column($incomes, 'total'),JSON_NUMERIC_CHECK);
        $data['upackages'] = $this->admin_model->get_users_packages();
        $this->db->group_by(array("title", "date"));

        $data['invoices'] = $this->admin_model->count_invoices($invoice=1);
        $data['estimates'] = $this->admin_model->count_invoices($invoice=2);
        $data['total_users'] = $this->admin_model->count_users();
        $data['business'] = $this->admin_model->count_business();

        $data['page_title'] = 'Dashboard';
        $data['settings'] = $this->admin_model->get('settings');
        $data['users'] = $this->admin_model->get_latest_users(6);
        $data['net_income'] = $this->admin_model->get_admin_income_by_year();
        $data['main_content'] = $this->load->view('admin/admin_dash', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    

    public function business()
    {   
        
        check_recurring_payments();
        $data = array();
        $data['page_title'] = 'User Dashboard';
        $data['currency'] = html_escape($this->business->currency_symbol);
        $data['settings'] = $this->admin_model->get('settings');
        $data['users'] = $this->admin_model->get_latest_users(6);
        $data['user'] = $this->admin_model->get_user_total();
        $data['overdues'] = $this->admin_model->get_invoice_report_types($type=1, $limit=5);
        $data['pending'] = $this->admin_model->get_invoice_report_types($type=0, $limit=5);
        $data['paids'] = $this->admin_model->get_invoice_report_types($type=2, $limit=5);
        $data['upcoming_payments'] = $this->admin_model->get_upcomming_recurring_payments();
        $data['net_income'] = $this->admin_model->get_income_by_year();
        $data['income_report'] = $this->admin_model->get_income_report();
        for ($i = 1; $i <= 13; $i++) {
            $months[] = date("Y-m", strtotime(date('Y-m-01')." -$i months"));
        }

        for ($i = 0; $i <= 11; $i++) {
            $income = $this->admin_model->get_income_report_by_date(date("Y-m", strtotime( date('Y-m-01')." -$i months")));
            $expense = $this->admin_model->get_expense_report_by_date(date("Y-m", strtotime( date('Y-m-01')." -$i months")));
            $expense2 = $this->admin_model->get_expense_report_by_date2(date("Y-m", strtotime( date('Y-m-01')." -$i months")));
            $months[] = array("date" => month_show(date("Y-m", strtotime( date('Y-m-01')." -$i months"))));
            $incomes[] = array("total" => $income);
            $expenses[] = array("total" => $expense+$expense2);
        }
        $data['income_axis'] = json_encode(array_column($months, 'date'),JSON_NUMERIC_CHECK);
        $data['income_data'] = json_encode(array_column($incomes, 'total'),JSON_NUMERIC_CHECK);
        $data['expense_data'] = json_encode(array_column($expenses, 'total'),JSON_NUMERIC_CHECK);
        $data['main_content'] = $this->load->view('admin/dash', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    public function change_password()
    {
        $data = array();
        $data['page_title'] = 'Change Password';
        $data['main_content'] = $this->load->view('admin/change_password', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    //change password
    public function change()
    {   
        if($_POST){
            
            $id = user()->id;
            $user = $this->admin_model->get_by_id($id, 'users');

            if(password_verify($this->input->post('old_pass', true), $user->password)){
                if ($this->input->post('new_pass', true) == $this->input->post('confirm_pass', true)) {
                    $data=array(
                        'password' => hash_password($this->input->post('new_pass', true))
                    );
                    $data = $this->security->xss_clean($data);
                    $this->admin_model->edit_option($data, $id, 'users');
                    echo json_encode(array('st'=>1));
                } else {
                    echo json_encode(array('st'=>2));
                }
            } else {
                echo json_encode(array('st'=>0));
            }
        }
    }


    public function update_currency() {

        $currency = $this->admin_model->get_cur();
        $rate = $this->admin_model->get_rates_date();

        if (date('Y-m-d') != $rate->date) {
            $req_url = 'https://currencyapi.net/api/v1/rates?key=a4c1324d48e2118afa7a9190f2af341dade3&base=USD';
            $response_json = file_get_contents($req_url);
            // Continuing if we got a result
            if(false !== $response_json) {
                // Try or catch for json_decode operation
                try {
                    // Decoding
                    $response = json_decode($response_json);
                    $this->db->truncate('rates');

                    foreach ($currency as $value) {
                        if (!empty($value->currency_code)) {
                            $val = $value->currency_code;
                            if(empty($response->rates->$val)){$response_val = '';}else{$response_val = $response->rates->$val;}
                            $item_data = array(
                                'code' => $value->currency_code,
                                'rate' => $response_val,
                                'date' => my_date_now()
                            );
                            $this->admin_model->insert($item_data, 'rates');
                        }
                    }
                }
                catch(Exception $e) {
                    throw new Exception("Error Processing Request", 1);
                }
            }
        }
    }



}