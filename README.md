Gravity Forms User Registration Activate Template
=================================================
**[Full Walk-through on Gravity Wiz](http://gravitywiz.com/2013/02/13/customizing-gravity-forms-user-registration-activation-page)**

These files are intended to be added to your WordPress theme and loaded in place of the default Gravity Forms User Registration activate.php template.

The benefit of this custom activate.php template is that the 99% of the HTML markup which exists in the original activate.php has been moved into separate template parts. This allows for much easier customization. 

Additionally, the core activate.php template has been reconfigured as a class. For advanced users who would like additionally flexbility, the new GFActivateTemplate class can be extended and any methods you would like to customize can be overriden in your child class.

### Install

1. Download *gfur-activate-template* folder.
2. Place the *gfur-activate-template* folder in your theme folder.
3. Paste the following snippet into your theme's functions.php file:
```php
/**
* Gravity Forms Custom Activation Template
* http://gravitywiz.com/customizing-gravity-forms-user-registration-activation-page
*/
add_action('wp', 'custom_maybe_activate_user', 9);
function custom_maybe_activate_user() {

    $template_path = STYLESHEETPATH . '/gfur-activate-template/activate.php';
    $is_activate_page = isset( $_GET['page'] ) && $_GET['page'] == 'gf_activation';
    
    if( ! file_exists( $template_path ) || ! $is_activate_page  )
        return;
    
    require_once( $template_path );
    
    exit();
}
```

### More Information

Read the full walk-through here: **[Full Walk-through on Gravity Wiz](http://gravitywiz.com/2013/02/13/customizing-gravity-forms-user-registration-activation-page)**
