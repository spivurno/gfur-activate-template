<?php

global $gw_activate_template;

$result = $gw_activate_template->result;

// if the blog is already active or if the blog is taken, display respective messages
if ( $gw_activate_template->is_blog_already_active( $result ) || $gw_activate_template->is_blog_taken( $result ) ):
    $signup = $result->get_error_data();
    ?>

    <h2><?php _e('Your account is now active!'); ?></h2>
    <p class="lead-in">
    <?php if ( $signup->domain . $signup->path == '' ): ?>

        Your account has been activated. You may now <a href="<?php echo network_site_url( 'wp-login.php', 'login' ); ?>">log in</a> to the site
        using your chosen username of &#8220;<?php echo $signup->user_login; ?>&#8221;. Please check your email inbox at <?php echo $signup->user_email; ?>
        for your password and login instructions. If you do not receive an email, please check your junk or spam folder. If you still
        do not receive an email within an hour, you can <a href="<?php echo network_site_url( 'wp-login.php?action=lostpassword', 'login' ); ?>">reset your password</a>.

    <?php else: ?>

        Your site at <a href="http://<?php echo $signup->domain; ?>"><?php echo $signup->domain; ?></a> is active.
        You may now log in to your site using your chosen username of <?php echo $signup->user_login; ?>.
        Please check your email inbox at <?php echo $signup->user_email; ?> for your password and login instructions.
        If you do not receive an email, please check your junk or spam folder.
        If you still do not receive an email within an hour, you can <a href="<?php echo network_site_url( 'wp-login.php?action=lostpassword' ); ?>">reset your password</a>.

    <?php endif; ?>
    </p>

<?php else: ?>

    <h2><?php _e('An error occurred during the activation'); ?></h2>
    <p><?php echo $result->get_error_message(); ?></p>

<?php endif; ?>