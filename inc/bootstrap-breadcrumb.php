<?php
/**
* 
* @package WordFlex
* @subpackage WordFlex Breadcrumb
* @since 1.0
* @version 1.0
*
* @author ajulien
* @link https://github.com/ajulien-fr/bootstrap_breadcrumb/blob/master/bootstrap-breadcrumb.php
* 
* I just added some modification and HTML schema compatibility
*/


/**
 * Retrieve category parents.
 * @param  int $id Category ID.
 * @param  array $visited Optional. Already linked to categories to prevent duplicates.
 * @return string|WP_Error A list of category parents on success, WP_Error on failure.
 */
function custom_get_category_parents( $id, $visited = array() ) {

    $chain = '';
    $parent = get_term( $id, 'category' );

    if ( is_wp_error( $parent ) )
        return $parent;

    $name = $parent->name;

    if ( $parent->parent && ( $parent->parent != $parent->term_id ) && !in_array( $parent->parent, $visited ) ) {
        $visited[] = $parent->parent;
        $chain .= custom_get_category_parents( $parent->parent, $visited );
    }

    $chain .= '<li itemprop="itemListElement" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumb-item"><a href="' . esc_url( get_category_link( $parent->term_id ) ) . ' itemprop="item"><span itemprop="name">' . $name . '</span></a>' . '</li>';

    return $chain;
}

/**
 * Breadcrumb Function]
 * @return [string] [breadcrumb output]
 */
function bootstrap_breadcrumb() {
    global $post;
    $schema_link = 'http://schema.org/ListItem';
    $html = '<nav aria-label="breadcrumb" class="small text-muted mb-5 breadcrumb-navigation is-sticky"><ol class="breadcrumb" itemprop="itemListElement" itemscope itemtype="http://schema.org/BreadcrumbList">';

    if ( (is_front_page()) || (is_home()) ) {
        $html .= '<li itemprop="itemListElement" itemscope itemtype="' . $schema_link . '" class="breadcrumb-item active" aria-current="page"><span itemprop="name">' . __('Home', 'wordflex') . '</span></li>';
    }

    else {
        $html .= '<li itemprop="itemListElement" itemscope itemtype="' . $schema_link . '" class="breadcrumb-item"><a href="' . esc_url(home_url('/')) . '" itemprop="item"><span itemprop="name">' . __('Home', 'wordflex') . '</span></a></li>';

        if ( is_attachment() ) {
            $parent = get_post($post->post_parent);
            $categories = get_the_category($parent->ID);

            if ( $categories[0] ) {
                $html .= custom_get_category_parents($categories[0]);
            }

            $html .= '<li itemprop="itemListElement" itemscope itemtype="' . $schema_link . '" class="breadcrumb-item"><a href="' . esc_url( get_permalink( $parent ) ) . '" itemprop="item"><span itemprop="name">' . $parent->post_title . '</span></a></li>';
            $html .= '<li itemprop="itemListElement" itemscope itemtype="' . $schema_link . '" class="breadcrumb-item active" aria-current="page"><span itemprop="name">' . get_the_title() . '</span></li>';
        }
        if (get_page_by_path('blog') && get_post_type() != 'portfolio') {
            if (!is_page()) {
                $html .= '<li itemprop="itemListElement" itemscope itemtype="' . $schema_link . '" class="breadcrumb-item"><a href="' . get_permalink(get_page_by_path('blog')) . '" itemprop="item"><span itemprop="name">' . __('Blog', 'wordflex') . '</span></a></li>';
            }
        }
        elseif (get_page_by_path('portfolio')) {
     
            $html .= '<li itemprop="itemListElement" itemscope itemtype="' . $schema_link . '" class="breadcrumb-item"><a href="' . get_permalink(get_page_by_path('portfolio')) . '" itemprop="item"><span itemprop="name">' . __('portfolio', 'wordflex') . '</span></a></li>';
          
        }
        if ( is_category() ) {
            $category = get_category( get_query_var( 'cat' ) );

            if ( $category->parent != 0 ) {
                $html .= custom_get_category_parents( $category->parent );
            }

            $html .= '<li itemprop="itemListElement" itemscope itemtype="' . $schema_link . '" class="breadcrumb-item active" aria-current="page"><span itemprop="name">' . single_cat_title( '', false ) . '</span></li>';
        }

        elseif ( is_page() && !is_front_page() ) {
            $parent_id = $post->post_parent;
            $parent_pages = array();

            while ( $parent_id ) {
                $page = get_page($parent_id);
                $parent_pages[] = $page;
                $parent_id = $page->post_parent;
            }

            $parent_pages = array_reverse( $parent_pages );

            if ( !empty( $parent_pages ) ) {
                foreach ( $parent_pages as $parent ) {
                    $html .= '<li itemprop="itemListElement" itemscope itemtype="' . $schema_link . '" class="breadcrumb-item"><a href="' . esc_url( get_permalink( $parent->ID ) ) . '" itemprop="item"><span itemprop="name">' . get_the_title( $parent->ID ) . '</span></a></li>';
                }
            }

            $html .= '<li itemprop="itemListElement" itemscope itemtype="' . $schema_link . '" class="breadcrumb-item active" aria-current="page"><span itemprop="name">' . get_the_title() . '</span></li>';
        }

        elseif ( is_singular( 'post' ) ) {
            $categories = get_the_category();

            if ( $categories[0] ) {
                $html .= custom_get_category_parents($categories[0]);
            }

            $html .= '<li itemprop="itemListElement" itemscope itemtype="' . $schema_link . '" class="breadcrumb-item active" aria-current="page"><span itemprop="name">' . get_the_title() . '</span></li>';
        }

        elseif ( is_tag() ) {
            $html .= '<li itemprop="itemListElement" itemscope itemtype="' . $schema_link . '" class="breadcrumb-item active" aria-current="page"><span itemprop="name">' . single_tag_title( '', false ) . '</span></li>';
        }

        elseif ( is_day() ) {
            $html .= '<li itemprop="itemListElement" itemscope itemtype="' . $schema_link . '" class="breadcrumb-item"><a href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '" itemprop="item"><span itemprop="name">' . get_the_time( 'Y' ) . '</span></a></li>';
            $html .= '<li itemprop="itemListElement" itemscope itemtype="' . $schema_link . '" class="breadcrumb-item"><a href="' . esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ) . '" itemprop="item"><span itemprop="name">' . get_the_time( 'm' ) . '</span></a></li>';
            $html .= '<li itemprop="itemListElement" itemscope itemtype="' . $schema_link . '" class="breadcrumb-item active" aria-current="page"><span itemprop="name">' . get_the_time('d') . '</span></li>';
        }

        elseif ( is_month() ) {
            $html .= '<li itemprop="itemListElement" itemscope itemtype="' . $schema_link . '" class="breadcrumb-item"><a href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '" itemprop="item">' . get_the_time( 'Y' ) . '</a></li>';
            $html .= '<li itemprop="itemListElement" itemscope itemtype="' . $schema_link . '" class="breadcrumb-item active" aria-current="page"><span itemprop="name">' . get_the_time( 'F' ) . '</span></li>';
        }

        elseif ( is_year() ) {
            $html .= '<li itemprop="itemListElement" itemscope itemtype="' . $schema_link . '" class="breadcrumb-item active" aria-current="page"><span itemprop="name">' . get_the_time( 'Y' ) . '</span></li>';
        }

        elseif ( is_author() ) {
            $html .= '<li itemprop="itemListElement" itemscope itemtype="' . $schema_link . '" class="breadcrumb-item active" aria-current="page"><span itemprop="name">' . get_the_author() . '</span></li>';
        }

        elseif (  'portfolio' == get_post_type() ) {
            $html .= '<li itemprop="itemListElement" itemscope itemtype="' . $schema_link . '" class="breadcrumb-item active" aria-current="page"><span itemprop="name">'. get_the_title() .'</span></li>';
        }

        elseif ( is_search() ) {

        }

        elseif ( is_404() ) {

        }
    }

    $html .= '</ol></nav>';

    echo $html;
}
