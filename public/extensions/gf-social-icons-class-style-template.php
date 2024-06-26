<?php

if (!defined('ABSPATH'))
        exit; // Exit if accessed directly 
trait Gf_social_icons_class_style_template
{
        private function get_json_account_data()
        {
                $jsonFilePath = plugin_dir_path(__FILE__) . '../../assets/json/gf-social-icons-fontawsome.json';
                if (file_exists($jsonFilePath)) {
                        $json_data = file_get_contents($jsonFilePath);
                        $data = json_decode($json_data, true);
                        if (json_last_error() === JSON_ERROR_NONE) {
                                // Successfully decoded JSON
                                return ($data);
                        } else {
                                // Handle JSON decode errors
                                echo "Error decoding JSON: " . json_last_error_msg();
                        }
                }
        }
        private function gf_social_icons_get_style_settings($data_style)
        {
                $style = '<style>';
                $style .= 'body{';
                $style .= ($data_style['gutefy_settings_color_social_icon'] != '') ? '--gutefy-secondary-color:' . $data_style['gutefy_settings_color_social_icon'] . ' !important;' : '';
                $style .= ($data_style['gutefy_settings_bg_color_social_icon'] != '') ? '--gutefy-primary-color:' . $data_style['gutefy_settings_bg_color_social_icon'] . ' !important;' : '';
                $style .= ($data_style['gutefy_settings_hover_color_social_icon'] != '') ? '--gutefy-secondary-hover-color:' . $data_style['gutefy_settings_hover_color_social_icon'] . ' !important;' : '';
                $style .= ($data_style['gutefy_settings_hover_bg_color_social_icon'] != '') ? '--gutefy-primary-hover-color:' . $data_style['gutefy_settings_hover_bg_color_social_icon'] . ' !important;' : '';
                $style .= ($data_style['gutefy_settings_icon_size_social_icon'] != '') ? '--gutefy-icon-size:' . $data_style['gutefy_settings_icon_size_social_icon'] . 'px' . ' !important;' : '';
                $style .= ($data_style['gutefy_settings_icon_wrapper_size_social_icon'] != '') ? '--gutefy-icon-wrapper-size:' . $data_style['gutefy_settings_icon_wrapper_size_social_icon'] . 'px' . ' !important;' : '';
                $style .= ($data_style['gutefy_settings_icon-wrapper-position-top_social_icon'] != '') ? '--gutefy-icon-wrapper-position-top:' . $data_style['gutefy_settings_icon-wrapper-position-top_social_icon'] . '%' . ' !important;' : '';
                $style .= ($data_style['gutefy_settings_icon_wrapper_size_social_icon'] != '') ? '--gutefy-icon-wrapper-size:' . $data_style['gutefy_settings_icon_wrapper_size_social_icon'] . 'px' . ' !important;' : '';
                $style .= ($data_style['gutefy_settings_icon_wrapper_z_index_social_icon'] != '') ? '--gutefy-icon-wrapper-z-index:' . $data_style['gutefy_settings_icon_wrapper_z_index_social_icon'] . ' !important;' : '';
                $style .= ($data_style['gutefy_settings_icon_wrapper_opacity_social_icon'] != '') ? '--gutefy-icon-wrapper-opacity:' . $data_style['gutefy_settings_icon_wrapper_opacity_social_icon'] . ' !important;' : '';

                $style .= '}';
                $style .= '</style>';
                return $style;
        }
        private function gf_social_icons_get_account_name_from_string($key)
        {
                $accountName = str_replace('_url', '', $key);
                return $accountName;
        }
        public function gf_social_icons_style_one($html, $data, $data_style, $data_icon_list)
        {
                $icon_data = $this->get_json_account_data();

                $html .= '<div class="gutefy-section-wrapper style-one">';
                $html .= ' <div class="gf_social_icons-float-sm">';


                foreach ($data as $socialNetwork) {
                        if ($socialNetwork != '') {
                                $accountName = $socialNetwork['icon'];
                                $html .= '<div class="gf_social_icons-fl-fl gf_social_icons-float-">';
                                $html .= $icon_data[$socialNetwork['icon']]['icon'];
                                $html .= '<a  href=' . $socialNetwork['url'] . '>' . $socialNetwork['icon'] . '</a>';
                                $html .= '</div>';
                        }
                }
                $html .= '</div>'; // End Section
                $html .= '</div>'; // End Section
                $html .= $this->gf_social_icons_get_style_settings($data_style);
                return $html;
        }
        public function gf_social_icons_style_two($html, $data, $data_style, $data_icon_list)
        {
                $icon_data = $this->get_json_account_data();
                $html .= '<div class="gutefy-section-wrapper style-two">';
                $html .= '<div class="gf_social_icons_social_float">';

                foreach ($data as $socialNetwork) {
                        if ($socialNetwork != '') {
                                $html .= '<a href="' . $socialNetwork['url'] . '" class="gf_social_icons_social_icon" id="' . $socialNetwork['icon'] . '" >' . $icon_data[$socialNetwork['icon']]['icon'] . '</a>';
                        }

                }
                $html .= '</div>';
                $html .= '</div>';
                $html .= $this->gf_social_icons_get_style_settings($data_style);

                return $html;
        }
}
