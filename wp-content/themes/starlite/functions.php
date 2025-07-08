<?php
add_action('wp', function () {
    show_admin_bar(false);
});

add_action('wp_enqueue_scripts', function () {

    // scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('swiper-js', get_stylesheet_directory_uri() . '/js/swiper.min.js');
    wp_enqueue_script('font-awesome-js', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js');
    wp_enqueue_script('index-js', get_stylesheet_directory_uri() . '/js/index.js', array('jquery'));

    // styles
    wp_enqueue_style('font-awesome-css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css');
    wp_enqueue_style('swiper-css', get_stylesheet_directory_uri() . '/css/swiper.min.css');
    wp_enqueue_style('index-css', get_stylesheet_directory_uri() . '/css/index.css');

});

add_filter('use_code_block_editor', function () {
    return false;
});

add_action('init', function () {

    // Remove for post type 'page'
    remove_post_type_support('page', 'editor');
    remove_post_type_support('page', 'revisions');
    remove_post_type_support('page', 'page-attributes');

    // register post type
    register_post_type('product', [
        'labels' => [
            'name' => 'Products',
            'singular_name' => 'Product',
            'add_new' => 'Add New Product',
            'add_new_item' => 'Add New Product',
            'new_item' => 'New Product',
            'view_item' => 'View Product',
            'view_items' => 'View Product',
            'all_items' => 'All Products',
        ],
        'public' => true,
        'supports' => ['title',],
        'menu_position' => 20,
        'menu_icon' => 'dashicons-cart',
        'show_in_rest' => true,
        'show_in_graphql' => true,
        'show_in_nav_menus' => true,
        'graphql_single_name' => 'Product',
        'graphql_plural_name' => 'Products',
    ]);

    register_taxonomy('product-category', 'product', [
        'labels' => 'Categories',
        'hierarchical' => true,
    ]);

    register_post_type('part', [
        'labels' => [
            'name' => 'Parts',
            'singular_name' => 'Part',
            'add_new' => 'Add New Part',
            'add_new_item' => 'Add New Part',
            'new_item' => 'New Part',
            'view_item' => 'View Part',
            'view_items' => 'View Part',
            'all_items' => 'All Parts',
        ],
        'public' => true,
        'supports' => ['title', 'page-attributes'],
        'menu_position' => 20,
        'show_in_rest' => true,
        'show_in_graphql' => true,
        'show_in_nav_menus' => true,
        'graphql_single_name' => 'Part',
        'graphql_plural_name' => 'Parts',
        'menu_icon' => 'dashicons-align-right',
    ]);

    register_post_type('project', [
        'labels' => [
            'name' => 'Projects',
            'singular_name' => 'Project',
            'add_new' => 'Add New Project',
            'add_new_item' => 'Add New Project',
            'new_item' => 'New Project',
            'view_item' => 'View Project',
            'view_items' => 'View Project',
            'all_items' => 'All Projects',
        ],
        'public' => true,
        'supports' => ['title',],
        'menu_position' => 20,
        'menu_icon' => 'dashicons-portfolio',
        'show_in_rest' => true,
        'show_in_graphql' => true,
        'show_in_nav_menus' => true,
        'graphql_single_name' => 'Project',
        'graphql_plural_name' => 'Projects',
    ]);

    register_post_type('client', [
        'labels' => [
            'name' => 'Clients',
            'singular_name' => 'Client',
            'add_new' => 'Add New Client',
            'add_new_item' => 'Add New Client',
            'new_item' => 'New Client',
            'view_item' => 'View Client',
            'view_items' => 'View Client',
            'all_items' => 'All Clients',
        ],
        'public' => true,
        'supports' => ['title',],
        'menu_position' => 20,
        'menu_icon' => 'dashicons-groups',
        'show_in_rest' => true,
        'show_in_graphql' => true,
        'show_in_nav_menus' => true,
        'graphql_single_name' => 'Client',
        'graphql_plural_name' => 'Clients',
    ]);

    register_post_type('position', [
        'labels' => [
            'name' => 'Careers',
            'singular_name' => 'Career',
            'add_new' => 'Add New Career',
            'add_new_item' => 'Add New Career',
            'new_item' => 'New Career',
            'view_item' => 'View Career',
            'view_items' => 'View Career',
            'all_items' => 'All Careers',
        ],
        'public' => true,
        'supports' => ['title',],
        'menu_position' => 20,
        'menu_icon' => 'dashicons-businessperson',
        'show_in_rest' => true,
        'show_in_graphql' => true,
        'show_in_nav_menus' => true,
        'graphql_single_name' => 'Career',
        'graphql_plural_name' => 'Careers',
    ]);
});

function theme_custom_logo_setup() {
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array('site-title', 'site-description'),
    ));

    add_theme_support('menus');
    register_nav_menus(
        array(
            'primary-menu' => __( 'Primary Menu', 'your-theme-textdomain' ),
        )
    );
}
add_action('after_setup_theme', 'theme_custom_logo_setup');

function get_logo()
{
    if (function_exists('the_custom_logo')) {
        $custom_logo_id = get_theme_mod('custom_logo');
        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
        return $logo[0];
    }
    return null;
}

// Removes from admin menu
add_action( 'admin_menu', 'my_remove_admin_menus' );
function my_remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
}
// Removes from post and pages
add_action('init', 'remove_comment_support', 100);

function remove_comment_support() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
}
// Removes from admin bar
function mytheme_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );

// Remove "Posts" and "Comments" from Dashboard "At a Glance" metabox
function remove_posts_and_comments_from_at_a_glance() {
    add_filter('dashboard_glance_items', function($items) {
        if (isset($items['post'])) {
            unset($items['post']);
        }
        if (isset($items['comment'])) {
            unset($items['comment']);
        }
        return $items;
    });
}
add_action('admin_init', 'remove_posts_and_comments_from_at_a_glance');

// Disable comment feeds
add_action('do_feed_rdf', 'disable_feeds', 1);
add_action('do_feed_rss', 'disable_feeds', 1);
add_action('do_feed_rss2', 'disable_feeds', 1);
add_action('do_feed_atom', 'disable_feeds', 1);
add_action('do_feed_rss2_comments', 'disable_feeds', 1);
add_action('do_feed_atom_comments', 'disable_feeds', 1);

function disable_feeds() {
    wp_die(__('No feed available, please visit our <a href="'. get_bloginfo('url') .'">homepage</a>!'));
}

// Remove comment-related metadata from headers
function remove_comment_meta() {
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'feed_links', 2);
}
add_action('init', 'remove_comment_meta');

function get_current_lang() {
    return get_field('lang', get_the_ID());
}

function get_current_lang_details()
{
    $part = get_posts([
        'posts_per_page' => 1,
        'post_type' => 'part',
        'name'           => 'language-' . get_current_lang(),
        'post_status'    => 'publish',
    ]);
    if(count($part) > 0) {
        return get_field('lang_details', $part[0]->ID);
    }
    return false;
}

function is_part_visible($section)
{
    $part = get_posts([
        'posts_per_page' => 1,
        'post_type' => 'part',
        'name'           => $section . '-' . get_current_lang(),
        'post_status'    => 'publish',
    ]);
    if(count($part) > 0 && in_array('is_visible', get_field($section.'_visibility', $part[0]->ID))) {
        return $part[0]->ID;
    }
    return false;
}

function get_menus() {

    $lang = get_current_lang();
    if($lang) {
        $menu_items = wp_get_nav_menu_items('Menu ('. $lang .')');
    }

    // default
    if(!$menu_items) {
        $menu_items = wp_get_nav_menu_items('Menu (EN)');
    }

    if (!$menu_items) {
        return [];
    }

    // Build associative array of menu items
    $menu_tree = [];
    $items_by_id = [];

    foreach ($menu_items as $item) {
        $menu_item = [
            'ID' => $item->ID,
            'title' => $item->title,
            'url' => $item->url,
            'parent' => $item->menu_item_parent,
            'children' => []
        ];
        $items_by_id[$item->ID] = $menu_item;
    }

    // Assign children to their respective parents
    foreach ($items_by_id as &$item) {
        if ($item['parent'] == 0) {
            $menu_tree[$item['ID']] = &$item;
        } else {
            $items_by_id[$item['parent']]['children'][] = &$item;
        }
    }

    return array_values($menu_tree);
}

function get_products($limit = -1)
{
    $args = [
        'posts_per_page' => $limit,
        'post_type' => 'product',
//        'meta_key' => 'product_order',
//        'orderby' => 'meta_value',
//        'order' => 'ASC',
        'meta_query' => [
            [
                'key' => 'lang',
                'value' => get_current_lang(),
                'compare' => '=',
            ]
        ]
    ];

//    if (isset($_GET['category'])) {
//        $args['tax_query'] = array(
//            array(
//                'taxonomy' => 'product-category',
//                'field' => 'slug',
//                'terms' => $_GET['category']
//            )
//        );
//    }

    return get_posts($args);
}

function get_footer_data()
{
    $the_slug = 'footer-' . get_current_lang();
    $args = array(
        'name'           => $the_slug,
        'post_type'      => 'part',
        'post_status'    => 'publish',
        'posts_per_page' => 1
    );
    return get_posts($args)[0];
}

function get_part($slug)
{
    $the_slug = $slug . '-' . get_current_lang();
    $args = array(
        'name'           => $the_slug,
        'post_type'      => 'part',
        'post_status'    => 'publish',
        'posts_per_page' => 1
    );
    $post = get_posts($args)[0];

    if($post) {
        return get_field($slug, $post->ID);
    }

    return null;
}

function get_front_page_url(): string
{
    $lang = get_field('lang', get_the_ID());

    if($lang === 'en') {
        return site_url('/');
    }

    return site_url('/' . $lang);
}

function get_product_categories()
{
    return get_terms([
        'taxonomy' => 'product-category', '
        hide_empty' => false,
        'orderby' => 'ID',
        'order' => 'ASC'
    ]);
}

function get_current_product_category()
{
    $category_slug = $_GET['category'];
    if (!$category_slug) return null;

    return get_term_by('slug', $category_slug, 'product-category');
}

function get_locale_page($page)
{
    $the_slug = $page . '-' . get_current_lang();
    $args = array(
        'name'           => $the_slug,
        'post_type'      => 'page',
        'post_status'    => 'publish',
        'posts_per_page' => 1
    );
    return get_posts($args)[0];
}

function get_page_title()
{
    $site_title = get_bloginfo('name');
    if ($title = get_field('page_title')) {
        return $title . ' | ' . $site_title;
    }
    return $site_title;
}

function get_meta_defaults()
{
    return [
        'title' => get_page_title(),
        'description' => get_bloginfo('description'),
        'image' => get_template_directory_uri() . '/img/starlite.webp'
    ];
}

function get_projects($limit = -1)
{
    $args = [
        'posts_per_page' => $limit,
        'post_type' => 'project',
        'orderby' => 'ID',
        'order' => 'ASC'
    ];

    return get_posts($args);
}

function get_clients($limit = -1)
{
    $args = [
        'posts_per_page' => $limit,
        'post_type' => 'client',
    ];

    return get_posts($args);
}

function get_open_positions($limit = -1)
{
    $args = [
        'posts_per_page' => $limit,
        'post_type' => 'position',
    ];

    return get_posts($args);
}

function get_latest_news($limit = -1)
{
    $args = [
        'posts_per_page' => $limit,
        'post_type' => 'post',
    ];

    return get_posts($args);
}

add_filter('use_block_editor_for_post', '__return_false');

function my_own_mime_types( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'my_own_mime_types' );

function encodeURIComponent($str) {
    $revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
    return strtr(rawurlencode($str), $revert);
}

function get_current_page_slug()
{
    $page = get_post(get_the_ID());
    return substr($page->post_name, 0, strlen($page->post_name)-3);
}

function get_page_url_by_lang($slug, $lang, $default_url = '')
{
    $page = get_page_by_path($slug . '-' . $lang);

    if($page) {
        return get_the_permalink($page->ID);
    }

    return $default_url;
}