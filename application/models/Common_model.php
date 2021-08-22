<?php
class Common_model extends CI_Model {

    // insert function
	public function insert($data,$table){
        $this->db->insert($table,$data);        
        return $this->db->insert_id();
    }

    // edit function
    function edit_option($action, $id, $table){
        $this->db->where('id',$id);
        $this->db->update($table,$action);
        return;
    } 

    // edit function
    function edit_option_md5($action, $id, $table){
        $this->db->where('md5(id)', $id);
        $this->db->update($table,$action);
        return;
    } 

    // update function
    function update($action,$id,$table){
        $this->db->where('id',$id);
        $this->db->update($table,$action);
    }

    // delete function
    function delete($id,$table){
        $this->db->delete($table, array('id' => $id));
        return;
    }

  

    // get function
    function get($table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    // select by function
    function select_by_user($table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->order_by('user_id','DESC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // select function
    function select($table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // asc select function
    function select_asc($table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('id','ASC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // asc select function
    function select_order_asc($table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('orders','ASC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // select by id
    function select_option($id,$table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    } 

    // select by id
    function get_by_id($id,$table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    } 

    // select by id
    function get_by_md5($id,$table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('md5(id)', $id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    } 

    // get by slug
    function get_by_slug($slug,$table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    } 


   function check_follower($id)
   {
        $this->db->select();
        $this->db->from('follower');
        $this->db->where('action_id', $this->session->userdata('id'));
        $this->db->where('follower_id', $id);
        $this->db->limit(1);
        $this->db->query('SET SQL_BIG_SELECTS=1'); 
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->result();
        }else{
            return 0;
        }
    }

    public function remove_follower($id,$table){
        $this->db->delete($table, array('follower_id' => $id, 'action_id' => $this->session->userdata('id')));
        return;
    }

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

    public function check_username($name)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('user_name', $name); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->result();
        }else{
            return 0;
        }
    }


    // select function
    function get_single_page($slug)
    {
        $this->db->select();
        $this->db->from('pages');
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    //get category
    public function get_category($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('category');
        return $query->row();
    }

    //get category
    public function get_category_option($id, $table)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($table);
        return $query->row();
    }


    function get_subcategory($id)
    {
        $this->db->select();
        $this->db->from('category');
        $this->db->where('parent_id', $id);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    // get settings
    function get_settings()
    {
        $this->db->select('s.*, l.short_name, l.name as language_name, l.slug as lang_slug, l.text_direction as dir');
        $this->db->from('settings s');
        $this->db->join('language as l', 'l.id = s.lang', 'LEFT');
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    function get_slug_by_language($slug,$table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    } 

    // get business
    function get_business_old($uid)
    {
        $this->db->select('b.*, t.name as country, t.currency_name, t.currency_code, t.currency_symbol');
        $this->db->from('business b');
        if ($uid != 0) {
            $this->db->where('b.uid', $uid);
        }else{
            $this->db->where('b.is_primary', 1);
        }
        $this->db->where('b.user_id', $this->session->userdata('id'));
        $this->db->join('country t', 't.id = b.country', 'LEFT');
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    // get business
    function get_business($uid)
    {
        
        if ($this->session->userdata('role') != 'user') {
            $this->db->where('id', $this->session->userdata('parent'));
            $query = $this->db->get('users_role');
            $user = $query->row();

            $this->db->select('b.*, t.name as country, t.currency_name, t.currency_code, t.currency_symbol');
            $this->db->from('business b');
            if ($uid != 0) {
                $this->db->where('b.uid', $uid);
            }else{
                if (isset($user) && $user->business_id != 0) {
                    $this->db->where('b.uid', $user->business_id);
                }else{
                    $this->db->where('b.is_primary', 1);
                }
            }
            $this->db->where('b.user_id', $this->session->userdata('id'));
            $this->db->join('country t', 't.id = b.country', 'LEFT');
            $query = $this->db->get();
            $query = $query->row();  
            return $query;

        } else {
           
            $this->db->select('b.*, t.name as country, t.currency_name, t.currency_code, t.currency_symbol');
            $this->db->from('business b');
            if ($uid != 0) {
                $this->db->where('b.uid', $uid);
            }else{
                $this->db->where('b.is_primary', 1);
            }
            $this->db->where('b.user_id', $this->session->userdata('id'));
            $this->db->join('country t', 't.id = b.country', 'LEFT');
            $query = $this->db->get();
            $query = $query->row();  
            return $query;

        }


    }


    // get my business
    function get_my_all_business()
    {

        $this->db->select('b.*, t.name as country, t.currency_name, t.currency_code, t.currency_symbol');
        $this->db->from('business b');
        $this->db->where('b.user_id', $this->session->userdata('id'));
        $this->db->join('country t', 't.id = b.country', 'LEFT');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }


    // get user business
    function get_user_all_business($business_id)
    {
        $this->db->select('b.*, t.name as country, t.currency_name, t.currency_code, t.currency_symbol');
        $this->db->from('business b');
        $this->db->where('b.user_id', $this->session->userdata('id'));
        if ($business_id != 0) {
            $this->db->where('b.uid', $business_id);
        }
        $this->db->join('country t', 't.id = b.country', 'LEFT');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }


    // select by id
    function select_option_md5($id,$table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where(md5('id'), $id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    } 

    //get user by id
    public function get_user_by_slug($slug)
    {
        $this->db->select('u.*, f.name as font');
        $this->db->from('users u');
        $this->db->join('google_fonts f', 'u.site_font = f.id', 'LEFT');
        $this->db->where('u.slug', $slug);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    // asc select function
    function get_services($user_id)
    {
        $this->db->select();
        $this->db->from('services');
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id','ASC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }


    // currency to symbol
    function currency_to_symbol($currency)
    {
        $this->db->select();
        $this->db->from('country');
        $this->db->where('currency_code', $currency);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    // get pricing packages
    function get_pricing()
    {
        $this->db->select('*');
        $this->db->from('package');
        $query = $this->db->get();
        $query = $query->result_array();  

        foreach ($query as $key => $value) {
            $this->db->select('*');
            $this->db->from('features f');
            $this->db->where('f.package_id',$value['id']);
            $query2 = $this->db->get();
            $query2 = $query2->result_array();
            $query[$key]['features'] = $query2;
        }
        return $query;
    }


    // select max discount
    function select_max_discount()
    {
        $this->db->select_max('dis_month');
        $this->db->select_max('dis_year');
        $this->db->from('package');
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    // get all users
    function get_home_users($total, $limit, $offset)
    {
        $this->db->select('u.*');
        $this->db->from('users u');
        $this->db->where('u.role', 'user');

        if (!empty($_GET['sort'])) {
            if (isset($_GET['sort']) && $_GET['sort'] == 'free' || $_GET['sort'] == 'pro') {
                $this->db->where('u.account_type', $_GET['sort']);
            }
            if (isset($_GET['sort']) && $_GET['sort'] == 'views') {
                $this->db->order_by('u.hit','DESC');
            }else{
                $this->db->order_by('u.id','DESC');
            }
        }
        if (!empty($_GET['skill'])) {
            $this->db->join('skills as s', 's.user_id = u.id', 'LEFT');
            $this->db->where('s.slug', $_GET['skill']);
        }
        $this->db->order_by('u.hit','DESC');

        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();
            return $query;
        }
    }
    

    //increase post hit
    public function increase_user_hit($id)
    {
        //get user
        $user = $this->get_user($id);

        if (!empty($user)):
            if (get_cookie('var_user_' . $id) != 1) :
                //increase hit
                set_cookie('var_user_' . $id, '1', 86400);
                $data = array(
                    'hit' => $user->hit + 1
                );
                $this->db->where('id', $id);
                $this->db->update('users', $data);
            endif;
        endif;
    }

    //get user by id
    public function get_user($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->row();
    }


    // get all users
    function get_common_skills()
    {
        $this->db->select();
        $this->db->from('skills');
        $this->db->group_by('slug');
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }


    // get all users
    function get_total_user_by_type($type)
    {
        $this->db->select();
        $this->db->from('users');
        $this->db->where('role', 'user');
        $this->db->where('account_type', $type);
        $query = $this->db->get();
        $query = $query->num_rows();
        return $query;
    }

    // get followers
    function get_total_followers($id)
    {
        $this->db->select();
        $this->db->from('follower');
        $this->db->where('follower_id', $id);
        $query = $this->db->get();
        $query = $query->num_rows();  
        return $query;
    }

    // get followings
    function get_total_followings($id)
    {
        $this->db->select();
        $this->db->from('follower');
        $this->db->where('action_id', $id);
        $query = $this->db->get();
        $query = $query->num_rows();  
        return $query;
    }

     // get all users
    function get_total_portfolio($id)
    {
        $this->db->select();
        $this->db->from('portfolio');
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        $query = $query->num_rows();  
        return $query;
    }


    // get_payment
    function gets_home_features()
    {
        gets_active_langs();
        $this->db->select();
        $this->db->from('features');
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    // get_payment
    function get_payment($payment_id)
    {
        $this->db->select();
        $this->db->from('payment');
        $this->db->where('puid', $payment_id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    // get_payment
    function get_user_payment()
    {
        $this->db->select();
        $this->db->from('payment');
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    // get_payment
    function get_total_value($table, $date, $type)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('user_id', $this->session->userdata('id'));
        if (!empty($date)) {
            $this->db->where("DATE_FORMAT(created_at,'%Y-%m-%d') >=", $date);
        }
        if ($type != 0) {
            $this->db->where('type', $type);
        }
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        $query = $query->num_rows();  
        return $query;
    }

    // get_payment
    function get_total_value_by_parent($table, $date, $type)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('parent_id', $this->session->userdata('id'));
        if (!empty($date)) {
            $this->db->where("DATE_FORMAT(created_at,'%Y-%m-%d') >=", $date);
        }
        if ($type != 0) {
            $this->db->where('type', $type);
        }
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        $query = $query->num_rows();  
        return $query;
    }


    // get_payment
    function check_package_status($slug)
    {
        $this->db->select();
        $this->db->from('package');
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        $query = $query->row();  
        if ($query->is_active == 1) {
            return true;
        } else {
            return false;
        }
    }

    // get_payment
    function check_package_limit($slug)
    {
        $this->db->select();
        $this->db->from('package_features');
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    // get_payment
    function get_my_package()
    {
        $this->db->select('p.*, k.name as package_name, k.slug');
        $this->db->from('payment p');
        $this->db->join('package k', 'k.id = p.package', 'LEFT');
        $this->db->where('p.user_id', $this->session->userdata('id'));
        $this->db->order_by('p.id', 'DESC');
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    // get_payment
    function check_user_payment($user_id)
    {
        $this->db->select('p.*, k.name as package_name, k.slug');
        $this->db->from('payment p');
        $this->db->join('package k', 'k.id = p.package', 'LEFT');
        $this->db->where('p.user_id', $user_id);
        $this->db->order_by('p.id', 'DESC');
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    // get_package
    function get_package_by_id($id)
    {
        $this->db->select();
        $this->db->from('package');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }
    
    // get_package
    function get_package_by_slug($slug)
    {
        $this->db->select();
        $this->db->from('package');
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    // get_payment
    function get_follower_following($user_id, $type)
    {
        $this->db->select('f.*, u.name, u.thumb, u.account_type, u.slug');
        $this->db->from('follower f');
        if ($type == 1) {
            $this->db->where('action_id', $user_id);
            $this->db->join('users u', 'u.id = follower_id', 'LEFT');
        } else {
            $this->db->where('follower_id', $user_id);
            $this->db->join('users u', 'u.id = action_id', 'LEFT');
        }
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }


    // get home skills
    function get_home_skills($user_id)
    {
        $this->db->select('*');
        $this->db->from('skills');
        $this->db->where('parent_id', 0);
        $this->db->where('user_id', $user_id);
        $this->db->order_by('orders');
        $query = $this->db->get();
        $query = $query->result_array();  

        foreach ($query as $key => $value) {
     
            $this->db->from('skills');
            $this->db->where('parent_id',$value['id']);
            $this->db->where('user_id', $user_id);
            $this->db->order_by('orders');
            $query2 = $this->db->get();
            $query2 = $query2->result_array();
            $query[$key]['sub_skills'] = $query2;
        }
        return $query;
    }

    //get home experiences
    function get_home_experiences($user_id)
    {
        $this->db->select('*');
        $this->db->from('experience');
        $this->db->where('parent_id', 0);
        $this->db->where('user_id', $user_id);
        $this->db->order_by('orders');
        $query = $this->db->get();
        $query = $query->result_array();  

        foreach ($query as $key => $value) {
     
            $this->db->from('experience');
            $this->db->where('parent_id',$value['id']);
            $this->db->where('user_id', $user_id);
            $this->db->order_by('orders');
            $query2 = $this->db->get();
            $query2 = $query2->result_array();
            $query[$key]['sub_exp'] = $query2;
        }
        return $query;
    }

    // get testimonials
    function get_testimonials($user_id){
        $this->db->select();
        $this->db->from('testimonials');
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 

    // get categories
    function get_categories(){
        $this->db->select();
        $this->db->from('category');
        $this->db->where('parent_id', 0);
        $this->db->order_by('cat_order', 'ASC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 

   
    // get subcategories
    function get_subcategories(){
        $this->db->select();
        $this->db->from('category');
        $this->db->where('parent_id !=', 0);
        $this->db->where('sub', 0);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 



    // get subcategories
    function sub_sub_categories(){
        $this->db->select();
        $this->db->from('category');
        $this->db->where('sub', 1);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 


    // get categories
    function get_skills(){
        $this->db->select();
        $this->db->from('skills');
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->where('parent_id', 0);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 

   
    // get subcategories
    function get_subskills(){
        $this->db->select();
        $this->db->from('skills');
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->where('parent_id !=', 0);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 

    // get categories
    function get_experience(){
        $this->db->select();
        $this->db->from('experience');
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->where('parent_id', 0);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 

   
    // get subcategories
    function get_subexperience(){
        $this->db->select();
        $this->db->from('experience');
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->where('parent_id !=', 0);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 

    // get categories
    function get_portfolio_categories(){
        $this->db->select();
        $this->db->from('portfolio_category');
        $this->db->where('user_id', $this->session->userdata('id'));
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 

    // get testimonials
    function get_portfolio_category($user_id){
        $this->db->select();
        $this->db->from('portfolio_category');
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 

    // get expire payments
    function get_expire_payments(){
        $this->db->select();
        $this->db->from('payment');
        $this->db->where('expire_on', date('Y-m-d'));
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 

    // get expire payments
    function get_reminder_expire_payments(){
        $this->db->select();
        $this->db->from('payment');
        $this->db->where('expire_on', date('Y-m-d', strtotime("+7 day")));
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 

    // get trial users
    function get_trial_users(){
        $this->db->select();
        $this->db->from('users');
        $this->db->where('trial_expire', date('Y-m-d'));
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 

    // get home blog posts
    function get_home_blog_posts($limit){
        $this->db->select('b.*, c.slug as category_slug, c.name as category');
        $this->db->from('blog_posts b');
        $this->db->join('blog_category c', 'c.id = b.category_id', 'LEFT');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    } 


    // get blog posts
    function get_blog_posts($total, $limit, $offset){
        $this->db->select('b.*, c.slug as category_slug, c.name as category');
        $this->db->from('blog_posts b');
        $this->db->join('blog_category c', 'c.id = b.category_id', 'LEFT');
        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {
            $this->db->limit($limit);
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();
            return $query;
        }
    } 

    // get_categories
    function get_blog_categories(){
        $this->db->select('b.category_id, c.slug as category_slug, c.name as category');
        $this->db->from('blog_posts b');
        $this->db->join('blog_category c', 'c.id = b.category_id', 'LEFT');
        $this->db->group_by('b.category_id');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 


    //get posts categories
    function get_category_by_slug($slug)
    {
        $this->db->select();
        $this->db->from('blog_category');
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    //get blog categories
    function get_blog_category()
    {
        $this->db->select();
        $this->db->from('blog_category');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }


    //get blog categories
    function get_post_details($slug)
    {
        $this->db->select('p.*, c.name as category, c.slug as category_slug');
        $this->db->from('blog_posts p');
        $this->db->join('blog_category c', 'p.category_id = c.id', 'LEFT');
        $this->db->where('p.slug', $slug);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

  


    //get latest posts
    function get_related_post($category_id, $post_id)
    {
        $this->db->select('p.*');
        $this->db->select('c.name as category');
        $this->db->from('blog_posts p');
        $this->db->join('blog_category c', 'c.id = p.category_id', 'LEFT');
        $this->db->where('p.id !=', $post_id);
        $this->db->where('p.category_id', $category_id);
        $this->db->where('p.status', 1);
        $this->db->order_by('p.id', 'DESC');
        $this->db->limit(3);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }


    //get posts tags
    public function get_post_tags($post_id)
    {
        $this->db->where('post_id', $post_id);
        $query = $this->db->get('tags');
        return $query->result();
    }

    //get comments by img
    public function get_comments_by_post($post_id)
    {   
        $this->db->select('c.*');
        $this->db->from('comments c');
        $this->db->where('c.post_id', $post_id);
        $this->db->order_by('c.id', 'DESC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }
   
    // delete tags
    function delete_tags($post_id, $table){
        $this->db->delete($table, array('post_id' => $post_id));
        return;
    }


    //get category posts
    function get_category_posts($total, $limit, $offset, $id)
    {

        $this->db->select('p.*');
        $this->db->select('c.name as category, c.slug as category_slug');
        $this->db->from('blog_posts p');
        $this->db->join('blog_category as c', 'c.id = p.category_id', 'LEFT');
        $this->db->where('p.status', 1);
        $this->db->where('p.category_id', $id);
        
        $this->db->order_by('p.id', 'DESC');
        
        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {
            $this->db->limit($limit);
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();
            return $query;
        }
    }


    //get category posts
    function count_posts_by_categories($id)
    {
        $this->db->select('count(p.id) as total');
        $this->db->from('blog_posts p');
        $this->db->where('p.status', 1);
        $this->db->where('p.category_id', $id);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->row();
        }else{
            return 0;
        }
    }

    //get random posts
    function get_random_tags($user_id)
    {
        $this->db->select('t.*');
        $this->db->select('p.status, p.slug as post_slug, u.name as author_name');
        $this->db->from('tags t');
        $this->db->join('blog_posts as p', 'p.id = t.post_id', 'LEFT');
        $this->db->join('users as u', 'u.id = p.user_id', 'LEFT');
        $this->db->where('p.status', 1);
        $this->db->where('p.user_id', $user_id);
        $this->db->order_by('rand()');
        $this->db->limit(8);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }


    // // get_categories
    // function get_blog_categories22(){
    //     $this->db->select();
    //     $this->db->from('blog_category');
    //     $query = $this->db->get();
    //     $query = $query->result();  
    //     return $query;
    // } 

    //get latest users
    function get_latest_users(){
        $this->db->select('u.*');
        $this->db->from('users u');
        $this->db->where('u.status', 1);
        $this->db->order_by('u.id','DESC');
        $this->db->limit(6);
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }

    // get all posts
    function get_latest_messages(){
        $this->db->select('c.*');
        $this->db->from('contacts c');
        $this->db->order_by('c.id','DESC');
        $this->db->limit(8);
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }


    // get all users
    function get_all_users(){
        $this->db->select('u.*');
        $this->db->from('users u');
        $this->db->where('u.role', 'user');
        $this->db->order_by('u.id','DESC');
        $this->db->query('SET SQL_BIG_SELECTS=1');
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }




    // get images by user
    function get_total_info(){
        $this->db->select('p.id');
        $this->db->select('(SELECT count(posts.id)
                            FROM posts 
                            WHERE (status = 1)
                            )
                            AS post',TRUE);
        
        $this->db->select('(SELECT count(users.id)
                            FROM users 
                            WHERE (status = 1)
                            )
                            AS user',TRUE);

        $this->db->from('posts p');
        $query = $this->db->get();
        $query = $query->row();
        return $query;
    }


     //get user info
    function get_user_info()
    {
        $this->db->select('u.*');
        $this->db->from('users u');
        $this->db->where('u.id', $this->session->userdata('id'));
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    // image upload function with resize option
    function upload_image($max_size){
            
            // set upload path
            $config['upload_path']  = "./uploads/";
            $config['allowed_types']= 'gif|jpg|png|jpeg';
            $config['max_size']     = '92000';
            $config['max_width']    = '92000';
            $config['max_height']   = '92000';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload("photo")) {

                
                $data = $this->upload->data();

                // set upload path
                $source             = "./uploads/".$data['file_name'] ;
                $destination_thumb  = "./uploads/thumbnail/" ;
                $destination_medium = "./uploads/medium/" ;
                $main_img = $data['file_name'];
                // Permission Configuration
                chmod($source, 0777) ;

                /* Resizing Processing */
                // Configuration Of Image Manipulation :: Static
                $this->load->library('image_lib') ;
                $img['image_library'] = 'GD2';
                $img['create_thumb']  = TRUE;
                $img['maintain_ratio']= TRUE;

                /// Limit Width Resize
                $limit_medium   = $max_size ;
                $limit_thumb    = 150;

                // Size Image Limit was using (LIMIT TOP)
                $limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;

                // Percentase Resize
                if ($limit_use > $limit_medium || $limit_use > $limit_thumb) {
                    $percent_medium = $limit_medium/$limit_use ;
                    $percent_thumb  = $limit_thumb/$limit_use ;
                }

                //// Making THUMBNAIL ///////
                $img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
                $img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_thumb-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = ' 100%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_thumb ;

                $thumb_nail = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;

                ////// Making MEDIUM /////////////
                $img['width']   = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
                $img['height']  = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_medium-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = '100%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_medium ;

                $mid = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;

                // set upload path
                $images = 'uploads/medium/'.$mid;
                $thumb  = 'uploads/thumbnail/'.$thumb_nail;
                unlink($source) ;

                return array(
                    'images' => $images,
                    'thumb' => $thumb
                );
            }
            else {
                echo "Failed! to upload image" ;
            }
            
    }


    //multiple image upload with resize option
    public function do_upload($photo) {                   
        $config['upload_path']  = "./uploads/";
        $config['allowed_types']= 'gif|jpg|png|jpeg';
        $config['max_size']     = '20000';
        $config['max_width']    = '20000';
        $config['max_height']   = '20000';
 
        $this->load->library('upload', $config);                
        
            if ($this->upload->do_upload($photo)) {
                $data       = $this->upload->data(); 
                /* PATH */
                $source             = "./uploads/".$data['file_name'] ;
                $destination_thumb  = "./uploads/thumbnail/" ;
                $destination_medium = "./uploads/medium/" ;
                $destination_big    = "./uploads/big/" ;

                // Permission Configuration
                chmod($source, 0777) ;

                /* Resizing Processing */
                // Configuration Of Image Manipulation :: Static
                $this->load->library('image_lib') ;
                $img['image_library'] = 'GD2';
                $img['create_thumb']  = TRUE;
                $img['maintain_ratio']= TRUE;

                /// Limit Width Resize
                $limit_big   = 1000 ;
                $limit_medium    = 400 ;
                $limit_thumb    = 100 ;

                // Size Image Limit was using (LIMIT TOP)
                $limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;

                // Percentase Resize
                if ($limit_use > $limit_big || $limit_use > $limit_thumb || $limit_use > $limit_medium) {
                    $percent_big = $limit_big/$limit_use ;
                    $percent_medium  = $limit_medium/$limit_use ;
                    $percent_thumb  = $limit_thumb/$limit_use ;
                }

                //// Making THUMBNAIL ///////
                $img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
                $img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_thumb-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = '99%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_thumb ;

                $thumb_nail = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;                 

                //// Making MEDIUM ///////
                $img['width']  = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
                $img['height'] = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_medium-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = '99%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_medium ;

                $medium = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;               

                ////// Making BIG /////////////
                $img['width']   = $limit_use > $limit_big ?  $data['image_width'] * $percent_big : $data['image_width'] ;
                $img['height']  = $limit_use > $limit_big ?  $data['image_height'] * $percent_big : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_big-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = '99%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_big ;

                $album_picture = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;

                $data_image = array(
                    'thumb' => 'uploads/thumbnail/'.$thumb_nail,
                    'medium' => 'uploads/medium/'.$medium,
                    'big' => 'uploads/big/'.$album_picture
                );

                unlink($source) ;   
                return $data_image;   
    
            }
            else {
                return FALSE ;
            }
       
    }

}