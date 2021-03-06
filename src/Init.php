<?php

namespace RusseBlanc\Branding;

// Set up plugin class
class Init
{
    public function __construct()
    {
        add_action('login_enqueue_scripts', [$this, 'login_logo']);
        add_filter('admin_footer_text', [$this, 'admin_footer'], 11);
        add_action('admin_bar_menu', [$this, 'remove_wp_logo'], 999);
        add_action('admin_bar_menu', [$this, 'create_menu'], 1);
        add_action('wp_before_admin_bar_render', [$this, 'menu_custom_logo']);
        add_filter('login_headerurl', [$this, 'login_logo_url']);
        add_filter('login_headertitle', [$this, 'login_logo_title']);
        add_action('phpmailer_init', [$this, 'disable_xmailer']);
        add_filter('jpeg_quality', [$this, 'my_custom_jpeg_quality']);
        remove_action('wp_head', 'wp_generator');
        add_theme_support( 'admin-bar', array( 'callback' => '__return_false' ) );
        add_filter( 'style_loader_src', [$this, 'hide_wordpress_version_in_script'], 10, 2 );
        add_filter( 'script_loader_src', [$this, 'hide_wordpress_version_in_script'], 10, 2 );
        add_action('admin_init', [$this, 'msk_custom_admin_color_palette']);
        add_action('user_register', [$this, 'msk_default_admin_color_palette']);

        /**
         * Enable features from Soil when plugin is activated
         * @link https://roots.io/plugins/soil/
         */
        add_theme_support('soil-clean-up');
        add_theme_support('soil-disable-asset-versioning');
        add_theme_support('soil-disable-trackbacks');
        add_theme_support('soil-jquery-cdn');
        add_theme_support('soil-nav-walker');
        add_theme_support('soil-nice-search');
        add_theme_support('soil-relative-urls');
    }

    /**
    * Remove WordPress admin bar menu
    */
    public function remove_wp_logo($wp_admin_bar)
    {
        $wp_admin_bar->remove_node('wp-logo');
    }

    /**
    * Remove WordPress Version Number In URL Parameters From JS/CSS
    */
    public function hide_wordpress_version_in_script($src, $handle)
    {
        $src = remove_query_arg('ver', $src);
        return $src;
    }

    /**
    * Thumbnail size & quality
    */
    public function my_custom_jpeg_quality()
    {
        return 100;
    }

    /**
    * Remove XMailer ads from mail
    */
    public function disable_xmailer($phpmailer) {
        $phpmailer->XMailer = ' ';
    }

    /**
    * Custom admin color palette
    */
    public function msk_custom_admin_color_palette()
    {
        wp_admin_css_color(
            'msk-colors',
            __('RusseBlanc'),
            RUSSEBLANC_BRANDING_PLUGIN_URL . 'assets/styles/admin-style.css',
            array('rgb(213, 43, 30)', 'rgb(31, 31, 31)', 'rgb(213, 43, 30)', 'rgb(255, 255, 255)'),
            array('rgb(213, 43, 30)', 'rgb(31, 31, 31)', 'rgb(213, 43, 30)', 'rgb(255, 255, 255)')
        );
    }

    /**
    * Custom default admin color palette
    */
    public function msk_default_admin_color_palette($user_id) {
        $args = array(
            'ID' => $user_id,
            'admin_color' => 'msk-colors'
        );

        wp_update_user($args);
    }
    /**
    * Replace login screen logo
    */
    public function login_logo()
    {
        ?>
    <style type="text/css">
      body.login {
        background-color: #ffffff;
      }

      body.login form {
       background-color: rgb(213, 43, 30);
       color: #ffffff;
      }

      body.login label {
        color: #ffffff;
      }

      body.login #login {
        padding: 5% 0 0;
      }

      .login form .input,
      .login form input[type=checkbox],
      .login input[type=text] {
        color: rgb(213, 43, 30);
        background-color: #ffffff;
      }

      body input[type=checkbox]:checked:before {
        color: rgb(213, 43, 30);
      }

      body  input[type=checkbox]:focus {
        border-color: #d52b1e;
        box-shadow: 0 0 2px rgb(213, 43, 30);
      }

      body a {
        color: rgb(213, 43, 30);
      }
      
      body.login #backtoblog a:hover,
      body.login #nav a:hover,
      body.login h1 a:hover {
        color: rgb(213, 43, 30);
      }

      body.login.wp-core-ui .button-primary {
        background: rgb(213, 43, 30);
        border-color: #ffffff;
        text-transform: uppercase;
        box-shadow: 0 1px 0 rgb(213, 43, 30);
        text-shadow: 0 -1px 1px rgb(213, 43, 30);
      }

      body.login div#login h1 a {
      background-image: url( <?=(RUSSEBLANC_BRANDING_PLUGIN_URL . 'assets/images/logo-icon.svg')?> );
      background-repeat: no-repeat;
      background-size: auto;
      width: 300px;
      height: 200px;
    }
    </style>
  <?php
    }

    /**
     * Replace login screen logo link
     */
    public function login_logo_url($url)
    {
        return 'https://www.russeblanc.com';
    }



    // Replace login logo title
    public function login_logo_title()
    {
        return '';
    }


    // Create custom admin bar m enu
    public function create_menu()
    {
        global $wp_admin_bar;
        $menu_id = 'my-logo';
        $wp_admin_bar->add_node([
          'id' => $menu_id,
          'title' =>
          '<span class="ab-icon">' . file_get_contents(RUSSEBLANC_BRANDING_PLUGIN_DIR . "assets/images/logo-icon.svg") . '</span>',
          'href' => '/'
          ]);
        $wp_admin_bar->add_node([
          'parent' => $menu_id,
          'title' => __('Homepage'),
          'id' => 'RusseBlanc',
          'href' => 'https://www.russeblanc.com',
          'meta' => ['target' => '_blank']
          ]);
    }


    /**
    * Replace login screen logo
    */
    public function menu_custom_logo()
    {
        ?>
    <style type="text/css">
      #wpadminbar #wp-admin-bar-my-logo > .ab-item .ab-icon {
        height: 20px;
        width: 20px;
        margin-right: 0 !important;
        padding-top: 7px !important;
      }
      #wpadminbar #wp-admin-bar-my-logo > .ab-item .ab-icon svg * {
        fill: currentColor;
      }
    </style>
  <?php
    }

    /**
    * Add "designed and developed..." to admin footer.
    */
    public function admin_footer($content)
    {
        return 'Imaginé & développé avec ❤️ par <a href="https://www.russeblanc.com" style="text-decoration: none;color:#d52b1e" target="_blank">RUSSE<strong>BLANC</strong></a>';
    }
}
