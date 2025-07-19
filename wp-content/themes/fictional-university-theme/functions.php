<?php 

function university_files()
{
    wp_enqueue_style("university_main_styles", get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style("university_main_styles", get_theme_file_uri('/build/index.css'));
}


add_action('wp_enqueue_scripts', 'university_files');