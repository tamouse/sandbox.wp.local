<?php

// this is the magic that allows our custom theme's styles and scripts to get added to the page.
// they will come out during wp_head() call.
//
// I wonder how one might have js inclusion happen at the bottom of the page...
//

function demo_theme_name_scripts() {
    wp_enqueue_style( 'demo-style', get_stylesheet_uri() );
    // no JS at this point
    //wp_enqueue_script( 'demo-script', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'demo_theme_name_scripts' );


// Register Custom Post Type
function employee_post_type() {

    $labels = array(
        'name'                  => _x( 'Employees', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Employee', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Employees', 'text_domain' ),
        'name_admin_bar'        => __( 'Employees', 'text_domain' ),
        'archives'              => __( 'Employee Archives', 'text_domain' ),
        'parent_item_colon'     => __( '', 'text_domain' ),
        'all_items'             => __( 'All Employees', 'text_domain' ),
        'add_new_item'          => __( 'Add Employee', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Employee', 'text_domain' ),
        'edit_item'             => __( 'Edit Employee', 'text_domain' ),
        'update_item'           => __( 'Upate Employee', 'text_domain' ),
        'view_item'             => __( 'View Employee', 'text_domain' ),
        'search_items'          => __( 'Search Employees', 'text_domain' ),
        'not_found'             => __( 'Employee Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Employee Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into Employee', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this emploeeq', 'text_domain' ),
        'items_list'            => __( 'Employee list', 'text_domain' ),
        'items_list_navigation' => __( 'Employees list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter employees list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Employee', 'text_domain' ),
        'description'           => __( 'Employee', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', ),
        
        // the array must contain taxonomies defined elsewhere.
        // the string must match the name given to the taxonomy
        // in the `register_taxonomy()` function call in the taxonomy.
        'taxonomies'            => array( 'position' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    
    // the name given to the post type will be used as an identifier for linking taxonomies
    register_post_type( 'employee', $args );

}
// the function name created above for the new post type
add_action( 'init', 'employee_post_type', 10 );

// Register Custom Taxonomy
function position_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Positions', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Position', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Positions', 'text_domain' ),
        'all_items'                  => __( 'All Items', 'text_domain' ),
        'parent_item'                => __( 'Parent Item', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
        'new_item_name'              => __( 'New Item Name', 'text_domain' ),
        'add_new_item'               => __( 'Add New Item', 'text_domain' ),
        'edit_item'                  => __( 'Edit Item', 'text_domain' ),
        'update_item'                => __( 'Update Item', 'text_domain' ),
        'view_item'                  => __( 'View Item', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
        'popular_items'              => __( 'Popular Items', 'text_domain' ),
        'search_items'               => __( 'Search Items', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
        'no_terms'                   => __( 'No items', 'text_domain' ),
        'items_list'                 => __( 'Items list', 'text_domain' ),
        'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
    );
    $args = array(
        'labels'                     => $labels,

        // making the taxonomy hierarchical sets up the checkbox to select the position
        // in the metabox on the edit page.
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        // is this how you get a check box for the position?
/*        'capabilities'               => array(
            'manage_terms'  => 'manage_position',
            'edit_terms'    => 'manage_position',
            'assign_terms'  => 'edit_position',
        ),*/
        // no, apperently not
        // is this even the right way to do this -- an employee should only be able to have one
        // position, how can that be limited?
        // Turns out NO -- but it is something that can be done with CMB2.
    );
    
    // the name given to `register_taxonomy` will be used to link the post types given in the array
    register_taxonomy( 'position', array( 'employee' ), $args );

}
// the function name created above
add_action( 'init', 'position_taxonomy', 10 );