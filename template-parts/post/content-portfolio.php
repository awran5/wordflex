<?php
/**
 * Template Name: Portfolio kos
 * The template for displaying Portfolio page.
 *
 * @package WordFlex Portfolio Template
 * @since 1.0
 */
// Exit if accessed directly
if (! defined('ABSPATH'))  exit; ?>


<!-- Start article portfolio -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/Blog">
    <div class="portfolio-content">
        <div class="row">
            <div class="col-md-7 py-4 portfolio-img">
                <?php _wf_post_thumbnail(); ?>
            </div>

            <div class="col-md-5 py-4 portfolio-details">
				<?php the_title( '<h3 class="post-title" itemprop="headline">', '</h3>' ); ?>

                <?php
                // Grab the metadata from the database
                $client   = get_post_meta( get_the_ID(), 'cmb_client', true );
                $designer = get_post_meta( get_the_ID(), 'cmb_designer', true );
                $date     = get_post_meta( get_the_ID(), 'cmb_date', true ); 
                $tags     = get_the_term_list( get_the_ID(), 'portfolio-tags', ' ', ', ');
                ?>

                <!-- Start Entry content -->
                <div class="portfolio-content mt-4">
                    <ul class="list-unstyled portfolio-list small text-muted">
                        <?php 
                        echo !empty( $client ) ? '<li class="list-item"><i class="fas fa-user"></i> Client:  <span class="font-weight-bold">' . esc_html( $client ) . '</span></li>' : '';
                        echo !empty( $designer ) ? '<li class="list-item"><i class="fas fa-user-graduate"></i> Designer: <span class="font-weight-bold">' . esc_html( $designer ) . '</span></li>' : '';
                        echo !empty( $date ) ? '<li class="list-item"><i class="far fa-calendar-alt"></i> Created Date: <span class="font-weight-bold">' . esc_html( $date ) . '</span></li>' : '';
                        ?>
                      <li class="list-item"><i class="fas fa-tags"></i>Tags: <?php echo $tags ?></li>
                    </ul>
                	<?php the_content(); ?>
                </div>
                <!-- End content -->
            </div>
        </div>
        <hr>
        <h4 class="my-4"><?php _e('You may also like:', 'wordflex') ?></h4>
        <ul class="list-inline">
            <?php
            // Array will hold tags ids
            $tag_ids = array();
            // get the tags
            $tags = get_the_tags( get_the_ID() );
            if ( $tags ) {
                foreach($tags as $tag) {
                    $tag_ids[] = $tag->term_id;
                }
            } 
            // related post query 
            $related = new WP_Query( array(
                'post_type' => 'portfolio',
                'numberposts' => 6,
                'orderby' => 'rand',
                'tag__in' => $tag_ids,
                'post__not_in' => array(get_the_ID())
            ) );
            // Loop through posts and display...
            if($related->have_posts()) {
                while ($related->have_posts() ) : $related->the_post(); ?>

                    <li class="list-inline-item">
                        <?php if (has_post_thumbnail()) { ?>
                            <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"> <?php the_post_thumbnail( 'thumbnail', array('alt' => get_the_title()) ); ?> </a>
                        <?php } else { ?>
                            <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                        <?php } ?>
                    </li>

                <?php endwhile; 
                wp_reset_query();
            } ?>
        </ul>
    </div>
</article>