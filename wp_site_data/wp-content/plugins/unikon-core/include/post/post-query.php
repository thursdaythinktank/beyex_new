<?php

// get post settings
function tp_get_post_settings($settings)
{
    foreach ($settings as $key => $value) {
        $post_args[$key] = $value;
    }
    $post_args['post_status'] = 'publish';

    return $post_args;
}

// Post Orderby Options
function tp_get_orderby_options()
{
    $orderby = array(
        'ID' => 'Post ID',
        'author' => 'Post Author',
        'title' => 'Title',
        'date' => 'Date',
        'modified' => 'Last Modified Date',
        'parent' => 'Parent Id',
        'rand' => 'Random',
        'comment_count' => 'Comment Count',
        'menu_order' => 'Menu Order',
    );
    return $orderby;
}



// get all types post
function tp_get_all_types_post($post_type)
{

    $posts_args = get_posts(array(
        'post_type' => $post_type,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_status' => 'publish',
        'posts_per_page' => -1,
    ));

    $posts = array();

    if (!empty($posts_args) && !is_wp_error($posts_args)) {
        foreach ($posts_args as $post) {
            $posts[$post->ID] = $post->post_title;
        }
    }

    return $posts;
}



// get all category 
function tp_get_categories($category = 'category')
{
    $categories = get_categories(array(
        'taxonomy' => $category,
        'orderby' => 'name',
        'order' => 'ASC',
    ));
    $cat_list = [];
    foreach ($categories as $cat) {
        $cat_list[$cat->slug] = $cat->name;
    }
    return $cat_list;
}


// get cat slug and name 
function tp_get_categories_data($categories = [], $delimeter = ' ', $term = 'slug')
{
    $slugs = [];
    foreach ($categories as $cat) {
        if ($term == 'slug') {
            array_push($slugs, $cat->slug);
        }
        if ($term == 'name') {
            $slugs[] = $cat->name;
        }
    }
    return implode($delimeter, $slugs);
}



// Get All Post Types
function tp_get_post_types()
{

    $tp_cpts = get_post_types(array('public' => true, 'show_in_nav_menus' => true), 'object');
    $tp_exclude_cpts = array('elementor_library', 'attachment');
    foreach ($tp_exclude_cpts as $exclude_cpt) {
        unset($tp_cpts[$exclude_cpt]);
    }
    $post_types = array_merge($tp_cpts);
    foreach ($post_types as $type) {
        $types[$type->name] = $type->label;
    }
    return $types;
}



function tp_query_args($post_type = 'post', $taxonomy = 'category', $settings = null)
{

    // settings control
    $posts_per_page = !empty($settings['posts_per_page']) ? $settings['posts_per_page'] : -1;
    $order = !empty($settings['order']) ? $settings['order'] : 'DESC';
    $order_by = !empty($settings['order_by']) ? $settings['order_by'] : 'date';

    $cat_list = !empty($settings['category']) ? $settings['category'] : [];
    $cat_exclude = !empty($settings['exclude_category']) ? $settings['exclude_category'] : [];
    $cat_include = !empty($settings['category']) ? $settings['category'] : [];

    $post_exclude = !empty($settings['post__not_in']) ? $settings['post__not_in'] : [];
    $post_include = !empty($settings['post__in']) ? $settings['post__in'] : [];
    $ignore_sticky_posts = (!empty($settings['ignore_sticky_posts']) && 'yes' == $settings['ignore_sticky_posts']) ? true : false;


    if (get_query_var('paged')) {
        $paged = get_query_var('paged');
    } else if (get_query_var('page')) {
        $paged = get_query_var('page');
    } else {
        $paged = 1;
    }

    $offset_value = (!empty($settings['offset'])) ? $settings['offset'] : '0';
    $off = (!empty($offset_value)) ? $offset_value : 0;
    $offset = $off + (($paged - 1) * $posts_per_page);



    $args = array(
        'post_type' => $post_type,
        'post_status' => 'publish',
        'order' => $order,
        'offset' => $offset,
        'orderby' => $order_by,
        'posts_per_page' => $posts_per_page,
        'post__not_in' => $post_exclude,
        'post__in' => $post_include,
        'ignore_sticky_posts' => $ignore_sticky_posts
    );


    if (!empty($cat_include) && !empty($cat_exclude)) {
        $args['tax_query'] = array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $cat_include,
                'operator' => 'IN',
            ),
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $cat_exclude,
                'operator' => 'NOT IN',
            ),
        );
    } elseif (!empty($cat_list || $cat_exclude)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => !empty($cat_exclude) ? $cat_exclude : $cat_list,
                'operator' => !empty($cat_exclude) ? 'NOT IN' : 'IN',
            ),
        );
    }




    return $args;
}