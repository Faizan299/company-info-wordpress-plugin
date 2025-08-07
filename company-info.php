<?php
/*
Plugin Name: Company Info Shortcode
Description: Displays company name, address, and contact using a shortcode with admin settings.
Version: 1.0
Author: Faizan
*/

function show_company_info() {
    $name = get_option('company_name', 'FAIZAN COMPANY');
    $address = get_option('company_address', 'Karachi, Pakistan');
    $contact = get_option('company_contact', '+92 306 2453465');

    return "<p><strong>Company Name:</strong> {$name}</p>
            <p><strong>Address:</strong> {$address}</p>
            <p><strong>Contact:</strong> {$contact}</p>";
}
add_shortcode('company_info', 'show_company_info');


function company_info_menu() {
    add_menu_page(
        'Company Info Settings',
        'Company Info',
        'manage_options',
        'company-info-settings',
        'company_info_settings_page'
    );
}
add_action('admin_menu', 'company_info_menu');

function company_info_settings_page() {
    if (isset($_POST['submit'])) {
        update_option('company_name', sanitize_text_field($_POST['company_name']));
        update_option('company_address', sanitize_text_field($_POST['company_address']));
        update_option('company_contact', sanitize_text_field($_POST['company_contact']));
        echo "<div class='updated'><p>Settings saved!</p></div>";
    }

    $company_name = get_option('company_name', '');
    $company_address = get_option('company_address', '');
    $company_contact = get_option('company_contact', '');
    ?>
    <div class="wrap">
        <h2>Company Info Settings</h2>
        <form method="post">
            <table class="form-table">
                <tr>
                    <th>Company Name:</th>
                    <td><input type="text" name="company_name" value="<?php echo esc_attr($company_name); ?>" class="regular-text" /></td>
                </tr>
                <tr>
                    <th>Address:</th>
                    <td><input type="text" name="company_address" value="<?php echo esc_attr($company_address); ?>" class="regular-text" /></td>
                </tr>
                <tr>
                    <th>Contact:</th>
                    <td><input type="text" name="company_contact" value="<?php echo esc_attr($company_contact); ?>" class="regular-text" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
