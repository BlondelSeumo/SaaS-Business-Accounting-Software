<?php
class Email_model extends CI_Model {
    

    function send($email_to, $subject, $message, $email_myself=''){
        if ($this->settings->mail_protocol == 'smtp') {
            // Load PHPMailer library
            $this->load->library('PHPMailer_Lib');
            // PHPMailer object
            $mail = $this->phpmailer_lib->load();
            // SMTP configuration
            $mail->isSMTP();
            $mail->Host     = $this->settings->mail_host;
            $mail->SMTPAuth = true;
            $mail->Username = $this->settings->mail_username;
            $mail->Password = base64_decode($this->settings->mail_password);
            $mail->SMTPSecure = $this->settings->mail_encryption;;
            $mail->Port     = $this->settings->mail_port;
            
            $mail->setFrom($this->settings->admin_email, $this->settings->site_name);
            $mail->addReplyTo('no-reply@gmail.com', $this->settings->site_name);
            
            // Add a recipient
            $mail->addAddress($email_to);
            
            // Add cc or bcc 
            if (!empty($email_myself)) {
                $mail->addCC($email_myself);
            }
            // $mail->addBCC('bcc@example.com');
            
            // Email subject
            $mail->Subject = $subject;
            
            // Set email format to HTML
            $mail->isHTML(true);
            
            // Email body content
            $mailContent = $message;
            $mail->Body = $mailContent;
            
            // Send email

            if(!$mail->send()){
                return 'Mailer Error: ' . $mail->ErrorInfo;
                //return false;
            }else{
                //echo 'Message has been sent';
                return true;
            }
        } else {
            $this->load->library('email');
            $this->load->library('encryption');
            $this->email->set_mailtype('html');
            
            $this->email->from($this->settings->admin_email, $this->settings->site_name);
            $this->email->to($email_to);
            if (!empty($email_myself)) {
                $this->email->cc($email_myself);
            }
            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->send();

            if($this->email->send()){
               //Success email Sent
               return true;
            }else{
               //Email Failed To Send
               return $this->email->print_debugger();
            }
        }
    }
   

    function send_email($email_to, $subject='', $message=''){
        if ($this->settings->mail_protocol == 'smtp') {
            // Load PHPMailer library
            $this->load->library('PHPMailer_Lib');
            // PHPMailer object
            $mail = $this->phpmailer_lib->load();
            // SMTP configuration
            $mail->isSMTP();
            $mail->Host     = $this->settings->mail_host;
            $mail->SMTPAuth = true;
            $mail->Username = $this->settings->mail_username;
            $mail->Password = base64_decode($this->settings->mail_password);
            $mail->SMTPSecure = $this->settings->mail_encryption;;
            $mail->Port     = $this->settings->mail_port;
            
            $mail->setFrom($this->settings->admin_email, $this->settings->site_name);
            
            // Add a recipient
            $mail->addAddress($email_to);
            
            // Email subject
            $mail->Subject = $subject;
            
            // Set email format to HTML
            $mail->isHTML(true);
            
            // Email body content
            $mailContent = $message;
            $mail->Body = $mailContent;

            if(!$mail->send()){
                return 'Mailer Error: ' . $mail->ErrorInfo;
                //return false;
            }else{
                //echo 'Message has been sent';
                return true;
            }
        } else {
            $this->load->library('email');
            $this->load->library('encryption');
            $this->email->set_mailtype('html');
            
            $this->email->from($this->settings->admin_email, $this->settings->site_name);
            $this->email->to($email_to);
            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->send();
            if($this->email->send()){
               //Success email Sent
               return true;
            }else{
               //Email Failed To Send
               return $this->email->print_debugger();
            }
        }
    }

}