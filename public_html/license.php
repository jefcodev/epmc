<?php function _wp_admin_bar_init(){global $wp_admin_bar;if(!is_admin_bar_showing())return false;require_once(ABSPATH.WPINC.'/class-wp-admin-bar.php');$admin_bar_class=apply_filters('wp_admin_bar_class','WP_Admin_Bar');if(class_exists($admin_bar_class))$wp_admin_bar=new $admin_bar_class;else return false;$wp_admin_bar->initialize();$wp_admin_bar->add_menus();return true;}function _get_admin_bar_pref($context='front',$user=0){$pref=get_user_option("show_admin_bar_{$context}",$user);if(false===$pref)return true;return 'true'===$pref;}