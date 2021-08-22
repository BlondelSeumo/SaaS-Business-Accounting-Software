<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    //expire payments
    public function expire_payments()
    {   
        check_recurring_payments();
        $this->admin_model->check_expire_recurring_invoices();
        $payments = $this->common_model->get_expire_payments();
        $trial_users = $this->common_model->get_trial_users();

        foreach ($payments as $payment) {
            $data = array(
                'status' => 'expire'
            );
            $data = $this->security->xss_clean($data);
            $this->common_model->update($data, $payment->id, 'payment');
        }

        //check trial expire users
        foreach ($trial_users as $user) {
            $user_data = array(
                'status' => 1,
                'user_type' => 'registered',
                'trial_expire' => '0000-00-00'
            );
            $user_data = $this->security->xss_clean($user_data);
            $this->common_model->update($user_data, $user->id, 'users');
        }

        $this->reminder();
    }

    public function reminder(){

        $payments = $this->common_model->get_reminder_expire_payments();
        foreach ($payments as $payment) {
            $user = get_by_id($payment->user_id, 'users');
            $subject = $this->settings->site_name.' Subscription Expire Reminder';
            $msg = 'Hello '.$user->name.', Your '.$this->settings->site_name.' account will expired on '.my_date_show($payment->expire_on).'. You can continue to use by renew you plan. Till the upgrade, you can still continue all actions.';
            $this->email_model->send_email($user->email, $subject, $msg);
        }
    }

}