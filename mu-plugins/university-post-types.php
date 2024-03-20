<?php

    function universityPostTypes() {
        // Event Post Type
        register_post_type('event', array(
            'public' => true,
            'show_in_rest' => true,
            'has_archive' => 'events',
            'supports' => array('title', 'editor', 'excerpt'),
            'labels' => array(
                'name' => 'Events',
                'add_new' => 'Add New Event',
                'add_new_item' => 'Add New Event',
                'edit_item' => 'Edit Event',
                'all_items' => 'All Events',
                'singular_name' => 'Event',
            ),
            'menu_icon' => 'dashicons-calendar',
        ));

        // Program Post Type
        register_post_type('program', array(
            'public' => true,
            'show_in_rest' => true,
            'has_archive' => 'programs',
            'supports' => array('title', 'editor'),
            'labels' => array(
                'name' => 'Programs',
                'add_new' => 'Add New Program',
                'add_new_item' => 'Add New Program',
                'edit_item' => 'Edit Program',
                'all_items' => 'All Programs',
                'singular_name' => 'Program',
            ),
            'menu_icon' => 'dashicons-awards',
        ));

        // Professor Post Type
        register_post_type('professor', array(
            'public' => true,
            'show_in_rest' => true,
            'rewrite' => array('slug' => 'professors'),
            'supports' => array('title', 'editor', 'thumbnail'),
            'labels' => array(
                'name' => 'Professors',
                'add_new' => 'Add New Professor',
                'add_new_item' => 'Add New Professor',
                'edit_item' => 'Edit Professor',
                'all_items' => 'All Professors',
                'singular_name' => 'Professor',
            ),
            'menu_icon' => 'dashicons-welcome-learn-more',
        ));
    }

    add_action('init', 'universityPostTypes');

?>