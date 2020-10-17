<?php

global $gw_activate_template;

/**
 * @var $user_id
 * @var $blog_id
 * @var $password
 */
extract( $gw_activate_template->result );

$url = is_multisite() ? get_blogaddress_by_id( (int) $blog_id ) : home_url('', 'http');
$user = new WP_User( (int) $user_id );

if ( $gw_activate_template->result['password_hash'] ) {
	$password = esc_html__( 'Set at registration.', 'gravityformsuserregistration' );
} elseif ( ! empty( $user->user_activation_key ) ) {
	$password = esc_html__( 'Check your email for the set password link.', 'gravityformsuserregistration' );
} else {
	$password = sprintf( '<a href="%s">%s</a>', esc_url( gf_user_registration()->get_set_password_url( $user ) ), esc_html__( 'Set your password.', 'gravityformsuserregistration' ) );
}

?>

<h2><?php _e('Your account is now active!'); ?></h2>

<div id="signup-welcome">
    <p><span class="h3"><?php _e('Username:'); ?></span> <?php echo $user->user_login ?></p>
    <p><span class="h3"><?php _e('Password:'); ?></span> <?php echo $password; ?></p>
</div>

<?php if ( $url != network_home_url('', 'http') ) : ?>
    <p class="view"><?php printf( __('Your account is now activated. <a href="%1$s">View your site</a> or <a href="%2$s">Log in</a>'), $url, $url . 'wp-login.php' ); ?></p>
<?php else: ?>
    <p class="view"><?php printf( __('Your account is now activated. <a href="%1$s">Log in</a> or go back to the <a href="%2$s">homepage</a>.' ), network_site_url('wp-login.php', 'login'), network_home_url() ); ?></p>
<?php endif; ?>