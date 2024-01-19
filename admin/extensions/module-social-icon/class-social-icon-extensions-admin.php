<?php
require_once plugin_dir_path(__FILE__) . 'class-list-of-social-account.php';
require_once plugin_dir_path(__FILE__) . 'class-gutify-social-icon-style-controller.php';
class Class_Social_Icon_Extensions extends Class_list_of_social_account
{
	public function __construct()
	{
		new Class_gutify_social_icon_style_controller();
		add_action('customize_register', array($this, 'gutefy_social_icons_customizer_settings'));
	}

	public function gutefy_social_icons_customizer_settings($wp_customize)
	{
		// Create a namespace for Gutefy settings
		$gutefy_namespace = 'gutefy_settings_';
		$gutefy_extensions_namespace = '_social_icon';
		$this->social_handler($wp_customize, $gutefy_namespace, $gutefy_extensions_namespace);

		// Add Gutefy Panel
		$wp_customize->add_panel(
			$gutefy_namespace . 'core-panel' . $gutefy_extensions_namespace,
			array(
				'title' => __('Gutefy Social Icons', 'gf-social-icon'),
				'description' => '<p>Gutefy Extensions for website enhancement</p>',
				'priority' => 160,
			)
		);

		$wp_customize->add_section(
			$gutefy_namespace . 'accounts' . $gutefy_extensions_namespace,
			array(
				'title' => __('Social Accounts', 'gf-social-icon'),
				'priority' => 1,
				'panel' => $gutefy_namespace . 'core-panel' . $gutefy_extensions_namespace,
			)
		);



	}
	function custom_url_validation($error_object, $input, $setting_object)
	{
		$social_account_name = str_replace('gutefy_social_url_', '', $setting_object->id);
		// Remove leading and trailing whitespaces
		$input = trim($input);

		if ($input != '') {
			// Check if it's a valid URL, email, or phone number based on the social account name
			switch ($social_account_name) {
				case 'Email':
					if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
						// Email is not valid
						return false;
					}
					break;
				case 'Phone':
					// Add your custom phone number validation logic here
					// For simplicity, let's assume a basic check for digits and length
					if (!preg_match('/^\d{10,}$/', $input)) {
						// Phone number is not valid
						return false;
					}
					// For phone numbers, return the input without esc_url_raw
					return $input;
				default:
					// Assume it's a URL for other social accounts
					if (!filter_var($input, FILTER_VALIDATE_URL)) {
						// URL is not valid
						return false;
					}
			}
		}

		return esc_url_raw($input);
	}


	function single_social_handler($wp_customize, $social_name, $gutefy_namespace, $gutefy_extensions_namespace)
	{
		// Add a URL control
		$wp_customize->add_setting(
			"gutefy_social_url_$social_name",
			array(
				'type' => 'option',
				'capability' => 'manage_options',
				'default' => '',
				'transport' => 'refresh',
				// 'sanitize_callback' => 'esc_url_raw',
				'validate_callback' => [$this, 'custom_url_validation'],
			)
		);

		$wp_customize->add_control(
			"gutefy_social_url_$social_name",
			array(
				'label' => __(ucwords($social_name), 'gf-social-icon'),
				'section' => $gutefy_namespace . 'accounts' . $gutefy_extensions_namespace,
				'type' => 'text',
				'priority' => 30,
				'input_attrs' => array(
					'class' => "gutefy-social__url $social_name",
					'placeholder' => __('https://'),
				),
			)
		);
	}

	function social_handler($wp_customize, $gutefy_namespace, $gutefy_extensions_namespace)
	{

		foreach ($this->socialList as $socialNetwork) {
			$this->single_social_handler($wp_customize, $socialNetwork, $gutefy_namespace, $gutefy_extensions_namespace);
		}
	}
}
