<?php

if (!defined('ABSPATH'))
	exit; // Exit if accessed directly 


class Gf_social_icons__class_style_controller_admin
{
	public function __construct()
	{
		add_action('customize_register', array($this, 'gf_social_icons__style_controller'));
	}

	public function gf_social_icons__style_controller($wp_customize)
	{
		//initiate custom controller files
		require_once (plugin_dir_path(__FILE__) . './../controls/slider/gf_social_icons_class_control_slider.php');
		require_once (plugin_dir_path(__FILE__) . './../controls/select/gf_social_icons__class_control_select.php');
		require_once (plugin_dir_path(__FILE__) . './../controls/spaching/gf_social_icons_class_control_spaching.php');

		// Create a namespace for Gutefy settings
		$gf_social_icons__namespace = 'gutefy_settings_';
		$gf_social_icons__extensions_namespace = '_social_icon';

		// Add Gutefy Section under the Gutefy Panel
		$wp_customize->add_section(
			$gf_social_icons__namespace . 'settings' . $gf_social_icons__extensions_namespace,
			array(
				'title' => __('Style Settings', 'gf-social-icons'),
				'priority' => 2,
				'panel' => $gf_social_icons__namespace . 'core-panel' . $gf_social_icons__extensions_namespace,
			)
		);

		// Add color control under Gutefy social icons section for icon color
		$wp_customize->add_setting(
			$gf_social_icons__namespace . 'color' . $gf_social_icons__extensions_namespace,
			array(
				'default' => '#ffffff',
				'transport' => 'postMessage',
				'type' => 'option',
				'capability' => 'manage_options',
			)
		);



		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$gf_social_icons__namespace . 'color' . $gf_social_icons__extensions_namespace,
				array(
					'label' => __('Icon Color', 'gf-social-icons'),
					'section' => $gf_social_icons__namespace . 'settings' . $gf_social_icons__extensions_namespace,
					'priority' => 2,
				)
			)
		);

		// Add color control under Gutefy social icons section for hover color
		$wp_customize->add_setting(
			$gf_social_icons__namespace . 'hover_color' . $gf_social_icons__extensions_namespace,
			array(
				'default' => '#F5AD3C',
				'transport' => 'postMessage',
				'type' => 'option',
				'capability' => 'manage_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$gf_social_icons__namespace . 'hover_color' . $gf_social_icons__extensions_namespace,
				array(
					'label' => __('Icon Hover Color', 'gf-social-icons'),
					'section' => $gf_social_icons__namespace . 'settings' . $gf_social_icons__extensions_namespace,
					'priority' => 3,
				)
			)
		);


		// Add background color control under Gutefy social icons section
		$wp_customize->add_setting(
			$gf_social_icons__namespace . 'bg_color' . $gf_social_icons__extensions_namespace,
			array(
				'default' => '#000000',
				'transport' => 'postMessage',
				'type' => 'option',
				'capability' => 'manage_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$gf_social_icons__namespace . 'bg_color' . $gf_social_icons__extensions_namespace,
				array(
					'label' => __('Icon Background Color', 'gf-social-icons'),
					'section' => $gf_social_icons__namespace . 'settings' . $gf_social_icons__extensions_namespace,
					'priority' => 3,
				)
			)
		);

		// Add hover background color control under Gutefy social icons section
		$wp_customize->add_setting(
			$gf_social_icons__namespace . 'hover_bg_color' . $gf_social_icons__extensions_namespace,
			array(
				'default' => '#086A61',
				'transport' => 'postMessage',
				'type' => 'option',
				'capability' => 'manage_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$gf_social_icons__namespace . 'hover_bg_color' . $gf_social_icons__extensions_namespace,
				array(
					'label' => __('Hover Background Color', 'gf-social-icons'),
					'section' => $gf_social_icons__namespace . 'settings' . $gf_social_icons__extensions_namespace,
					'priority' => 4,
				)
			)
		);


		// Add style select control under Gutefy social icons section
		$wp_customize->add_setting(
			$gf_social_icons__namespace . 'selected_style' . $gf_social_icons__extensions_namespace,
			array(
				'default' => 'style2',
				'transport' => 'postMessage',
				'type' => 'option',
				'capability' => 'manage_options',
			)
		);

		//Icon wrapper opacity
		$wp_customize->add_setting(
			$gf_social_icons__namespace . 'icon-wrapper-opacity' . $gf_social_icons__extensions_namespace,
			array(
				'default' => '0.4',
				'transport' => 'postMessage',
				'type' => 'option',
				'capability' => 'manage_options',

			)
		);


		// ------------------
		$wp_customize->add_control(
			new Gf_social_icons_class_control_select(
				$wp_customize,
				$gf_social_icons__namespace . 'selected_style' . $gf_social_icons__extensions_namespace,
				array(
					'label' => __('Social Hover Style', 'gf-social-icons'),
					'section' => $gf_social_icons__namespace . 'settings' . $gf_social_icons__extensions_namespace,
					'priority' => 1,
					'choices' => array(
						'style1' => __('Style 1', 'gf-social-icons'),
						'style2' => __('Style 2', 'gf-social-icons'),
					),
					'input_attrs' => array(
						'min' => '0',
						'max' => '1',
						'step' => '0.01',
					),
					'settings' => [
						'selected_style' => $gf_social_icons__namespace . 'selected_style' . $gf_social_icons__extensions_namespace,
						'opacity-control' => $gf_social_icons__namespace . 'icon-wrapper-opacity' . $gf_social_icons__extensions_namespace
					]
				)
			)
		);

		// Add icon size select control under Gutefy social icons section
		$wp_customize->add_setting(
			$gf_social_icons__namespace . 'icon_size' . $gf_social_icons__extensions_namespace,
			array(

				'default' => '12',
				'transport' => 'postMessage',
				'capability' => 'manage_options',
				'type' => 'option'
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				$gf_social_icons__namespace . 'icon_size' . $gf_social_icons__extensions_namespace,
				array(
					'label' => __('Icon Size', 'gf-social-icons'),
					'section' => $gf_social_icons__namespace . 'settings' . $gf_social_icons__extensions_namespace,
					'type'	=> 'number',
					'input_attrs' => array(
						'min' => '0',
						'max' => '100',
						'step' => '1',
					),
				)
			)
		);


		// Add icon wrapper size select control under Gutefy social icons section
		$wp_customize->add_setting(
			$gf_social_icons__namespace . 'icon_wrapper_size' . $gf_social_icons__extensions_namespace,
			array(

				'default' => '44',
				'transport' => 'postMessage',
				'capability' => 'manage_options',
				'type' => 'option'
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				$gf_social_icons__namespace . 'icon_wrapper_size' . $gf_social_icons__extensions_namespace,
				array(
					'label' => __('Icon Wrapper Size', 'gf-social-icons'),
					'section' => $gf_social_icons__namespace . 'settings' . $gf_social_icons__extensions_namespace,
					'type'	=>	'number',
					'input_attrs' => array(
						'min' => '0',
						'max' => '200',
						'step' => '1',
					),
				)
			)

		);

		// $wp_customize->add_setting(
		// 	$gf_social_icons__namespace . 'icon_position' . $gf_social_icons__extensions_namespace,
		// 	array(
		// 		'default' => 'bottom_right',
		// 		'transport' => 'postMessage',
		// 		'capability' => 'manage_options',
		// 		'type' => 'option'
		// 	)
		// );

		// $wp_customize->add_control(
		// 	new Gf_social_icons_class_control_select(
		// 		$wp_customize,
		// 		$gf_social_icons__namespace . 'icon_position' . $gf_social_icons__extensions_namespace,
		// 		array(
		// 			'label' => __('Icon Position', 'gf-social-icons'),
		// 			'section' => $gf_social_icons__namespace . 'settings' . $gf_social_icons__extensions_namespace,
		// 			'priority' => 1,
		// 			'choices' => array(
		// 				'bottom_right' => __('Bottom Right', 'gf-social-icons'),
		// 				'bottom_left' => __('Bottom Left', 'gf-social-icons'),
		// 			),
		// 		)
		// 	)
		// );

		//z-index control 
		// $wp_customize->add_setting(
		// 	$gf_social_icons__namespace . 'icon_wrapper_z_index' . $gf_social_icons__extensions_namespace,
		// 	array(
		// 		'default' => '9999999999',
		// 		'transport' => 'postMessage',
		// 		'capability' => 'manage_options',
		// 		'type' => 'option'
		// 	)
		// );
		// $wp_customize->add_control(
		// 	new WP_Customize_Control(
		// 		$wp_customize,
		// 		$gf_social_icons__namespace . 'icon_wrapper_z_index' . $gf_social_icons__extensions_namespace,
		// 		array(
		// 			'label' => __('Z-index', 'gf-social-icons'),
		// 			'section' => $gf_social_icons__namespace . 'settings' . $gf_social_icons__extensions_namespace,
		// 			'type' => 'text'
		// 		)
		// 	)
		// );


		$wp_customize->add_setting(
			$gf_social_icons__namespace . 'icon_padding' . $gf_social_icons__extensions_namespace . '["left"]',
			array(
				'default' => '0',
				'transport' => 'postMessage',
				'capability' => 'manage_options',
				'type' => 'option'
			)
		);
		$wp_customize->add_setting(
			$gf_social_icons__namespace . 'icon_padding' . $gf_social_icons__extensions_namespace . '["right"]',
			array(
				'default' => '0',
				'transport' => 'postMessage',
				'capability' => 'manage_options',
				'type' => 'option'
			)
		);
		$wp_customize->add_setting(
			$gf_social_icons__namespace . 'icon_padding' . $gf_social_icons__extensions_namespace . '["top"]',
			array(
				'default' => '0',
				'transport' => 'postMessage',
				'capability' => 'manage_options',
				'type' => 'option'
			)
		);
		$wp_customize->add_setting(
			$gf_social_icons__namespace . 'icon_padding' . $gf_social_icons__extensions_namespace . '["bottom"]',
			array(
				'default' => '0',
				'transport' => 'postMessage',
				'capability' => 'manage_options',
				'type' => 'option'
			)
		);

		// $wp_customize->add_control(
		// 	new Gf_social_icons_class_control_spaching(
		// 		$wp_customize,
		// 		$gf_social_icons__namespace . 'icon_padding' . $gf_social_icons__extensions_namespace,
		// 		array(
		// 			'label' => __('Icon Spaching', 'gf-social-icons'),
		// 			'section' => $gf_social_icons__namespace . 'settings' . $gf_social_icons__extensions_namespace,
		// 			'settings'=> [
		// 				'padding_right' => $gf_social_icons__namespace . 'icon_padding' . $gf_social_icons__extensions_namespace.'["right"]',
		// 				'padding_left' => $gf_social_icons__namespace . 'icon_padding' . $gf_social_icons__extensions_namespace.'["left"]',
		// 				'padding_top' => $gf_social_icons__namespace . 'icon_padding' . $gf_social_icons__extensions_namespace.'["top"]',
		// 				'padding_bottom' => $gf_social_icons__namespace . 'icon_padding' . $gf_social_icons__extensions_namespace.'["bottom"]',
		// 			],
		// 		)
		// 	)
		// );
				//position top 

				$wp_customize->add_setting(
					$gf_social_icons__namespace . 'icon-wrapper-position-top' . $gf_social_icons__extensions_namespace,
					array(
		
						'default' => '40',
						'transport' => 'postMessage',
						'capability' => 'manage_options',
						'type' => 'option'
					)
				);
		
				$wp_customize->add_control(
					new Gf_social_icons__class_control_slider(
						$wp_customize,
						$gf_social_icons__namespace . 'icon-wrapper-position-top' . $gf_social_icons__extensions_namespace,
						array(
							'label' => __('Set Vertical Position', 'gf-social-icons'),
							'section' => $gf_social_icons__namespace . 'settings' . $gf_social_icons__extensions_namespace,
							'input_attrs' => array(
								'min' => '0',
								'max' => '100',
								'step' => '1',
							),
						)
					)
				);

	}

	//Padding controller 

}
new Gf_social_icons__class_style_controller_admin();
