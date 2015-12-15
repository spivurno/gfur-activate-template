<?php

global $gw_activate_template;

define( 'WP_INSTALLING', true );

$gw_activate_template = new GWActivateTemplate();
$gw_activate_template->template();

class GWActivateTemplate {

    function __construct( $args = array() ) {

        extract( wp_parse_args( $args, array(
            'template_folder' => basename( dirname( __file__ ) )
            ) ) );

        $this->template_folder = $template_folder;

        $this->load_gfur_signup_functionality();
        $this->hooks();

    }

    function load_gfur_signup_functionality() {

        if( function_exists( 'gf_user_registration' ) ) {
            $signups = gf_user_registration()->get_base_path() . '/includes/signups.php';
        } else {
            $signups = GFUser::get_base_path() . '/includes/signups.php';
        }

        // include GF User Registration functionality
        require_once( $signups );
        GFUserSignups::prep_signups_functionality();
    }

    function hooks() {

        add_action('body_class', create_function('$classes', '$classes[] = "gfur-activate"; return $classes;'));

    }

    function do_activate_header() {
        do_action( 'activate_wp_head' );
    }

    function wpmu_activate_stylesheet() {
        ?>
        <style type="text/css">
            form { margin-top: 2em; }
            #submit, #key { width: 90%; font-size: 24px; }
            #language { margin-top: .5em; }
            .error { background: #f66; }
            span.h3 { padding: 0 8px; font-size: 1.3em; font-family: "Lucida Grande", Verdana, Arial, "Bitstream Vera Sans", sans-serif; font-weight: bold; color: #333; }
        </style>
        <?php
    }

    function has_activation_key() {
        return !empty($_GET['key']) || !empty($_POST['key']);
    }

    function get_activation_key() {

        if( isset( $_GET['key'] ) && $_GET['key'] )
            return $_GET['key'];

        if( isset( $_POST['key'] ) && $_POST['key'] )
            return $_POST['key'];

        return false;
    }

    function is_blog_taken( $result ) {
        return 'blog_taken' == $result->get_error_code();
    }

    function is_blog_already_active( $result ) {
        return 'already_active' == $result->get_error_code();
    }

    function template() {

        do_action( 'activate_header' );

        add_action( 'wp_head', array( $this, 'do_activate_header' ) );
        add_action( 'wp_head', array( $this, 'wpmu_activate_stylesheet' ) );

        get_header();

        ?>

        <div id="content" class="widecolumn">

            <?php if ( !$this->has_activation_key() ) {

                get_template_part( $this->template_folder . '/activate', 'no-key' );

            } else {

                $key = $this->get_activation_key();
                $this->result = GFUserSignups::activate_signup($key);

                if ( is_wp_error( $this->result ) ) {

                    get_template_part( $this->template_folder . '/activate', 'error' );

                } else {

                    get_template_part( $this->template_folder . '/activate', 'success' );

                }

            } ?>

        </div>

        <script type="text/javascript">
            var key_input = document.getElementById('key');
            key_input && key_input.focus();
        </script>

        <?php

        get_footer();

    }

}

?>