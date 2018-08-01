<?php if(!is_user_logged_in()){ 
    global $wpdb;
    $user_status = 1;
    $key = $_GET['key'];
    $wpdb->update($wpdb->users, array('user_status' => $user_status), array('user_activation_key' => $key));
        echo '<div class="alert alert-success"><strong>Congratulations</strong><br /><br />Your account has been activated. Click here to <strong><a href="'.get_bloginfo('home').'/login">Login</a></strong></div>';
        
    $user_data = $wpdb->get_results("SELECT * FROM $wpdb->users WHERE user_activation_key = '$key'");
    //print_r($user_data);
    if(!empty($user_data)){
        foreach($user_data as $ud){
            $to = $ud->user_email;
            $display_name = $ud->display_name;
            $userid = $ud->ID;
            $user_login = $ud->user_login;
        }
    }
    $pwd = get_user_meta($userid, 'pwd', true);
    
    if($userid != 1){
    $admin_name = get_bloginfo('name');
    // mail to user
        $to1 = $to;
    	$from1 = "no-reply@".$_SERVER['HTTP_HOST'];
    	$headers1 = 'From: '.$from1. "\r\n";
        $headers1 .= "Reply-To: ".get_option('admin_email')."\r\n";
        $headers1 .= "MIME-Version: 1.0\n"; 
        $headers1 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    	$subject1 = "Thank you for joinning"; 
        $msg1 = 'Welcome to '.get_bloginfo('name').'.<br /><br />Thank you for joining.<br /><br />Please note login details.<br /><br /><table><tr><th>Username: </th><td>'.$user_login.'</td></tr><tr><th>Password: </th><td>'.$pwd.'</td></tr></table><br><br>Regards,<br>'.$admin_name;
        
    	wp_mail( $to1, $subject1, $msg1, $headers1 );
    }
} 
?>