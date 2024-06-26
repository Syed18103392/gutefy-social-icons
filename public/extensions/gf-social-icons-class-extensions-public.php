<?php

if (!defined('ABSPATH'))
        exit; // Exit if accessed directly 

require_once plugin_dir_path(__FILE__) . '../../admin/extensions/gf-social-icons-class-list-of-account-admin.php';
require_once plugin_dir_path(__FILE__) . './gf-social-icons-class-style-template.php';
class Gf_social_icons_class_extensions_public extends Gf_social_icons_class_list_of_account_admin
{
        use Gf_social_icons_class_style_template;
        private $data = [];
        private $data_style = [];
        public $data_icon_list;
        function __construct()
        {
                $this->data_icon_list = $this->socialListDefaultIcon;
                $this->gf_social_icons_insert_content();
        }
        public function gf_social_icons_insert_content()
        {
                try {
                        add_action('woocommerce_after_main_content', array($this, 'gf_social_icons_get_icon_data'));
                        add_filter('the_content', array($this, 'gf_social_icons_get_icon_data'), 99999);
                        add_filter('get_the_excerpt', array($this, 'gf_social_icons_get_icon_data'), 99999);
                } catch (\Throwable $th) {
                        //throw $th;
                }
        }

        public function gf_social_icons_get_icon_data($content)
        {
                $account_data = json_decode(get_option('gutefy_settings_accounts_social_icon'));

                $account_data_array = json_decode(json_encode($account_data), true);

                // Initialize the array to store the reformatted data
                // Check if the decoded data is an array
                if (is_array($account_data_array)) {
                        // Loop through each item in the account data
                        foreach ($account_data as $item) {
                                // Check if the item is an object and has the properties 'icon' and 'url'
                                if (is_object($item) && isset($item->icon) && isset($item->url)) {
                                        // Add the icon and url to the $data array
                                        $data[] = ['url'=>$item->url,'icon'=>$item->icon];
                                }
                        }
                }
                $style_data= $this->gf_social_icons_style_settings();
                $content = $this->gf_social_icons_render_frontend($content, $data, $style_data);
                return $content;
        }

        public function gf_social_icons_get_icon_data_2($content)
        {
                foreach ($this->socialList as $socialNetwork) {
                        if ($socialNetwork == 'Email') {
                                $generate_email_url = (get_option('gutefy_social_url_' . $socialNetwork) != '') ? "mailto:" . str_replace('http://', '', get_option('gutefy_social_url_' . $socialNetwork)) : '';
                                $data[$socialNetwork . "_url"] = $generate_email_url;
                        } elseif ($socialNetwork == 'Phone') {
                                $generate_phone_url = (get_option('gutefy_social_url_' . $socialNetwork) != '') ? "tel:" . str_replace('http://', '', get_option('gutefy_social_url_' . $socialNetwork)) : '';
                                $data[$socialNetwork . "_url"] = $generate_phone_url;
                        } else {
                                $data[$socialNetwork . "_url"] = get_option('gutefy_social_url_' . $socialNetwork);
                        }

                }

                $content = $this->gf_social_icons_render_frontend($content, $data, $data_style);
                return $content;
        }

        function gf_social_icons_style_settings(){
                $data_style['gutefy_settings_color_social_icon'] = get_option("gutefy_settings_color_social_icon", "");
                $data_style['gutefy_settings_bg_color_social_icon'] = get_option("gutefy_settings_bg_color_social_icon", "");
                $data_style['gutefy_settings_hover_bg_color_social_icon'] = get_option("gutefy_settings_hover_bg_color_social_icon", "");
                $data_style['gutefy_settings_hover_color_social_icon'] = get_option("gutefy_settings_hover_color_social_icon", "");
                $data_style['gutefy_settings_icon_size_social_icon'] = get_option("gutefy_settings_icon_size_social_icon", "");
                $data_style['gutefy_settings_icon_wrapper_size_social_icon'] = get_option("gutefy_settings_icon_wrapper_size_social_icon", "");
                $data_style['gutefy_settings_icon-wrapper-position-top_social_icon'] = get_option("gutefy_settings_icon-wrapper-position-top_social_icon", "");
                $data_style['gutefy_settings_icon_position_social_icon'] = get_option("gutefy_settings_icon_position_social_icon", "");
                $data_style['gutefy_settings_icon_wrapper_z_index_social_icon'] = get_option("gutefy_settings_icon_wrapper_z_index_social_icon", "");
                $data_style['gutefy_settings_icon_wrapper_opacity_social_icon'] = get_option("gutefy_settings_icon-wrapper-opacity_social_icon", "");

                return $data_style;
        }
        function gf_social_icons_render_frontend($html, $data, $data_style)
        {
                // Concatenate HTML

                $new_html = $this->gf_social_icons_markup($html, $data, $data_style);

                return $new_html;
        }

        function gf_social_icons_markup($html, $data, $data_style)
        {
                if ($data) {
                        $markup_style = get_option("gutefy_settings_selected_style_social_icon", "");
                        if ($markup_style === 'style1') {
                                $html = $this->gf_social_icons_style_one($html, $data, $data_style, $this->data_icon_list);
                        } elseif ($markup_style === 'style2') {
                                $html = $this->gf_social_icons_style_two($html, $data, $data_style, $this->data_icon_list);
                        } else {
                                $html = $this->gf_social_icons_style_two($html, $data, $data_style, $this->data_icon_list);
                        }
                }

                return $html;
        }


}

new Gf_social_icons_class_extensions_public();
