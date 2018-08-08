<?php
/**
 * @package Date view
 * @version 0.1
 */
/*
Plugin Name: Date view
Plugin URI: http://mario-flores.com/
Description: Show posts organized by date
Author: Mario Flores
Version: 0.1
Author URI: http://mario-flores.com/
*/

if(! defined( 'WPINC')){
    die; 
}
require plugin_dir_path(__file__).'includes/classes.php'; 

function mf_dateview(){
    $plugin = new MF_Dataviews(); 
    $plugin->plugin_url = plugins_url('/', __FILE__); 
    
}

mf_dateview(); 
