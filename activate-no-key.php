<h2><?php _e('Activation Key Required') ?></h2>
<form name="activateform" id="activateform" method="post" action="<?php echo add_query_arg( array( 'page' => 'gf_activation' ) ); ?>">
    <p>
        <label for="key"><?php _e('Activation Key:') ?></label>
        <br /><input type="text" name="key" id="key" value="" size="50" />
    </p>
    <p class="submit">
        <input id="submit" type="submit" name="Submit" class="submit" value="<?php esc_attr_e('Activate') ?>" />
    </p>
</form>