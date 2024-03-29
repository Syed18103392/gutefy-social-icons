<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://gutefy.com
 * @since      1.0.0
 *
 * @package    Gutefy_Social_Icons
 * @subpackage Gutefy_Social_Icons/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Gutefy_Social_Icons
 * @subpackage Gutefy_Social_Icons/includes
 * @author     Gutefy <gutefy.2023@gmail.com>
 */
class Gf_social_icons_class
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Gf_social_icons_class_loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{
		if (defined('Gutefy_Social_Icons_VERSION')) {
			$this->version = Gutefy_Social_Icons_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'gf-social-icons';
		$this->load_dependencies();
		$this->gf_social_icons_set_locale();
		$this->gf_social_icons_define_admin_hooks();
		$this->gf_social_icons_define_public_hooks();
		// add_action('admin_menu', [$this, 'gf_social_icons_admin_menu_options']);
	}
	public function gf_social_icons_admin_menu_options()
	{
		add_menu_page(
			'Gutefy Social Icons',
			'Gf Social Icons',
			'manage_options',
			'gf_social_icons',
			[$this, 'gf_social_icons_admin_panel_html_markup']
		);
	}
	public function gf_social_icons_admin_panel_html_markup()
	{
		?>
		<h1>Gutefy Social Icons</h1>
		<?php
	}
	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Gf_social_icons_class_loader. Orchestrates the hooks of the plugin.
	 * - Gf_social_icons_class_i18n. Defines internationalization functionality.
	 * - Gutefy_Social_Icons_Admin. Defines all hooks for the admin area.
	 * - Gf_social_icons_class_public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies()
	{

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/gf-social-icons-class-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/gf-social-icons-class-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/gf-social-icons-class-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/gf-social-icons-class-public.php';

		$this->loader = new Gf_social_icons_class_loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Gf_social_icons_class_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function gf_social_icons_set_locale()
	{

		$plugin_i18n = new Gf_social_icons_class_i18n();

		$this->loader->add_action('plugins_loaded', $plugin_i18n, 'gf_social_icons_load_textdomain');

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function gf_social_icons_define_admin_hooks()
	{

		$plugin_admin = new Gf_social_icons_class_admin($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'gf_social_icons_enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'gf_social_icons_enqueue_scripts');

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function gf_social_icons_define_public_hooks()
	{

		$plugin_public = new Gf_social_icons_class_public($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'gf_social_icons_enqueue_styles');
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'gf_social_icons_enqueue_scripts');

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}
	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name()
	{
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Gf_social_icons_class_loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version()
	{
		return $this->version;
	}

}
