<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['sender_email']	= 'no_reply@mokets.com';
$config['sender_name'] = 'Mokets';
$config['stripe_secret_key'] = "sk_test_lxHim6W6aJAjb4jjAtfviY0t";
$config['fcm_api_key']  = "AIzaSyC8knOj8F1_a0wxLg9Nu9T80q4UsYz9xHU"; 
$config['gmap_api_key'] = "AIzaSyDWRJCZRSf2XNckr_WXepCZnovyqOB4c7Q";
$config['pending_color']  = "#f23939";
$config['confirm_color']  = "#219427";
$config['complete_color'] = "#3d39f2";
$config['cancel_color']   = "#60605b";
$config['base_url']	= 'http://votepen.tk/avm/';
$config['index_page'] = 'index.php';
$config['uri_protocol']	= 'AUTO';
$config['url_suffix'] = '';
$config['language']	= 'english';
$config['charset'] = 'UTF-8';
$config['enable_hooks'] = FALSE;
$config['subclass_prefix'] = 'MY_';
#$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-@';
$config['allow_get_array']		= TRUE;
$config['enable_query_strings'] = FALSE;
$config['controller_trigger']	= 'c';
$config['function_trigger']		= 'm';
$config['directory_trigger']	= 'd'; // experimental not currently in use
$config['log_threshold'] = 0;
$config['log_path'] = '';
$config['log_date_format'] = 'Y-m-d H:i:s';
$config['cache_path'] = '';
$config['encryption_key'] = 'teampscodecyan';
$config['sess_cookie_name']		= 'ci_session';
$config['sess_expiration']		= 7200;
$config['sess_expire_on_close']	= FALSE;
$config['sess_encrypt_cookie']	= FALSE;
$config['sess_use_database']	= FALSE;
$config['sess_table_name']		= 'ci_sessions';
$config['sess_match_ip']		= FALSE;
$config['sess_match_useragent']	= TRUE;
$config['sess_time_to_update']	= 300;
$config['cookie_prefix']	= "";
$config['cookie_domain']	= "";
$config['cookie_path']		= "/";
$config['cookie_secure']	= FALSE;
$config['global_xss_filtering'] = TRUE;

if (isset($_SERVER["REQUEST_URI"])) 
{
    if(stripos($_SERVER["REQUEST_URI"],'/fileupload') === FALSE && stripos($_SERVER["REQUEST_URI"],'/rest') === FALSE)
    {
        $config['csrf_protection'] = TRUE;
    }
    else
    {
        $config['csrf_protection'] = FALSE;
    } 
} 
else 
{
    $config['csrf_protection'] = TRUE;
} 
#$config['csrf_protection'] = true;
$config['csrf_token_name'] = 'mokets_csrf_token';
$config['csrf_cookie_name'] = 'mokets_csrf_cookie';
$config['csrf_expire'] = 7200;
$config['compress_output'] = FALSE;
$config['time_reference'] = 'local';
$config['rewrite_short_tags'] = FALSE;
$config['proxy_ips'] = '';