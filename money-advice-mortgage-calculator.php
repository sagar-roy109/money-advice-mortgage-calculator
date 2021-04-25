<?php
/*
Plugin Name: Money Advice Mortagege Calculator
Plugin URI: https://www.linkedin.com/in/sagar-roy-3445b5119/
Description: This is a Mortgage Calculator Plugin for Wordpress. Using this calculator you can find monthly repayment and interest rate. 
Version: 1.0
Author: Sagar Roy
Author URI: https://www.linkedin.com/in/sagar-roy-3445b5119/
Text Domian: mortgage
*/


if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


//Define Paths

define("PLUGIN_DIR_PATH", plugin_dir_path(__FILE__));
define("PLUGIN_URL", plugins_url());








// Register Admin Page for Plugin

function money_advice_mortgage_custom_menu()
{
    add_menu_page(
        "mortgagecalc",  // Page title
        "Money Mortgage Calculator", // menu title
        "manage_options", // admin level
        "money-advice-mortgage-calculator", // slug
        "mortgage_admin_view" // output function
    );
}

add_action("admin_menu", "money_advice_mortgage_custom_menu");

function money_advice_mortgage_admin_view()
{
    include_once PLUGIN_DIR_PATH."/admin-view/admin-panel-output.php";
}







//adding styles  worpress admin

if(!function_exists("money_advice_mortgage_calc_admin_assests")) :
	function money_advice_mortgage_calc_admin_assests() {
		global $pagenow;

		$current_page = get_current_screen();

		if( 
            (isset($_GET["page"]) && $_GET["page"] === 'money-advice-mortgage-calculator')
		) { 
			wp_enqueue_style(
                "mortgage_bootstrap",
                "//cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css", 
            );
		}

	}
    
//end of adding styles and scripts for wordpress admin.

add_action('admin_enqueue_scripts', 'money_advice_mortgage_calc_admin_assests', 1);

endif;






//Assets For Output

function money_advice_morgage_custom_assets(){
    
    //Bootstrap
    
    wp_enqueue_style(
        "mortgage_bootstrap",
        "//cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css"
    );
    
    // Range Slider Css

    wp_enqueue_style(
        "mortgage_slider_css",
        PLUGIN_URL."/money-advice-mortgage-calculator/assets/css/rSlider.min.css", 
        "mortgage_bootstrap"
    );
    
    // Main CSs

    wp_enqueue_style(
        "mortgage_style",
        PLUGIN_URL."/money-advice-mortgage-calculator/style.css",
        "[mortgage_bootstrap, mortgage_slider_css]"
    );
    
    // responsive Css

    wp_enqueue_style(
        "mortgage_calc_responsive_style",
        PLUGIN_URL."/money-advice-mortgage-calculator/calc-responsive.css" , 
        "[mortgage_bootstrap, mortgage_slider_css, mortgage_style]"
    );

    // Jquery

    
    wp_enqueue_script(
        "mortgage-jquery",
        "//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js", 
        "",
        null,
        true
        
    );


    //Slider js

    wp_enqueue_script(
        "mortgage-slider-js",
        PLUGIN_URL."/money-advice-mortgage-calculator/assets/js/rSlider.min.js", 
        "",
        null,
        true
        
    );

    //  JS


    wp_enqueue_script(
        "mortgage-calc-js",
        PLUGIN_URL."/money-advice-mortgage-calculator/custom.js", 
        "[mortgage-jquery,mortgage-slider-js]",
        null,
        true
        
    );
}


add_action("wp_enqueue_scripts" , "money_advice_morgage_custom_assets");





// Create Shortcodes



add_shortcode('money_advice_calculator', "money_advice_calculator_shortcode");

function money_advice_calculator_shortcode($params){
    $values = shortcode_atts(

        array(
            "first_url" => "#",
            "second_url" => "#",
            "third_url" => "#"
        ),
        $params,

    );
    
    ob_start();
    include_once PLUGIN_DIR_PATH."/tamplets/calc.php";
    return ob_get_clean();
}

