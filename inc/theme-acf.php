<?php
/**
 * ACFs.
 */
define ('THEME_ACF_JSON', THEME_DIR . '/acf-json');

if ( function_exists( 'acf_add_options_page' ) ) {

    if (!is_dir(THEME_ACF_JSON)) {
        mkdir(THEME_ACF_JSON);
    }

    $acf_options_pages = array();
    $acf_options_pages[0] = array (
        'page_title' => 'Theme General Settings',    
        'menu_title' => 'Theme Settings',
        'menu_slug'  => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect'   => true, 
    );
	$acf_options_pages[] = [
		'page_title'  => 'Header Settings',
		'menu_title'  => 'Header',
        'parent_slug' => 'theme-general-settings',
        'acf_json_group_name' => 'header'
	];
	$acf_options_pages[] = [ 
		'page_title'  => 'Footer Settings',
		'menu_title'  => 'Footer',
		'parent_slug' => 'theme-general-settings',
        'acf_json_group_name' => 'footer'
	];
	$acf_options_pages[] = [
		'page_title'  => '404 page Settings',
		'menu_title'  => '404 page',
		'parent_slug' => 'theme-general-settings',
        'acf_json_group_name' => '404_page'
    ];
	$acf_options_pages[] = [
		'page_title'  => 'General Settings',
		'menu_title'  => 'General',
		'parent_slug' => 'theme-general-settings',
        'acf_json_group_name' => 'general'
    ];

    foreach ($acf_options_pages as $key => $acf_option) {
        // creation de la page d'option
        acf_add_options_page($acf_option);
        // création du groupe ACF et json correspondant
        if (isset($acf_option['acf_json_group_name'] && $acf_option['acf_json_group_name'] != '') {

            $acf_json_group_name = 'group_theme_options_' . $acf_option['acf_json_group_name'];

            if (!file_exists(THEME_ACF_JSON . '/' . $acf_json_group_name . '.json')) {
                $json_data = '{
    "key": "' . $acf_json_group_name . '",
    "title": "Thème options - ' . $acf_option['menu_title'] . '",
    "fields": [],
    "location": [
        [
            {
                "param": "options_page",
                "operator": "==",
                "value": "acf-options-' . strtolower(str_replace(' ', '-', $acf_option['menu_title'])) . '"
            }
        ]
    ],
    "menu_order": 0,
    "position": "normal",
    "style": "default",
    "label_placement": "top",
    "instruction_placement": "label",
    "hide_on_screen": "",
    "active": 1,
    "description": "",
    "modified": ' . time() . '
}';

                $fp = fopen(THEME_ACF_JSON . '/' . $acf_json_group_name . '.json', 'w');
                fwrite($fp, $json_data);
                fclose($fp);
            }
        }
    }
}
