<?php
/**
 * x -452.859
 * y -3847.157
 * z 238.843
* Single Blog page
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package WordFlex
* @subpackage WordFlex Single Blog Page
* @since 1.0
* @version 1.0
*/

if ( ! defined( 'ABSPATH' ) ) exit; ?>



<!-- Start article -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/Blog">

	<?php the_title( '<h2 class="post-title" itemprop="headline">', '</h2>' ); ?>
	<!-- Start Entry Header -->
	<div class="text-muted small entry-header">
		<?php if ( 'post' === get_post_type() ) : ?>
		<?php _wf_posted_on(); ?>
		<?php endif ?>
	</div>
	<!-- End Entry Header -->
	<hr>
	<?php if(has_post_thumbnail()) : ?>
		<div class="entry-thumbnail">
			<?php _wf_post_thumbnail(); ?>
		</div>
	<?php endif ?>
	<!-- Start Entry content -->
	<div class="entry-content" itemprop="text">
		<?php the_content(); ?>
	</div>
	<!-- End Entry content -->
	<hr>
	<!-- Start Entry footer -->
	<div class="text-muted small entry-footer">
		<?php _wf_entry_footer(); ?>
	</div>
	<!-- End Entry footer -->
	<?php  
	$set_count = new PostViewCount;
	$set_count->setCount('views_count', 1);
	?>

</article>
<!-- End article -->

<?php if ( _wf_get_option('opt-show-feedback') ) : ?>
	<!-- Start Entry Feedback -->
	<div class="jumbotron py-4 entry-feedback">
		<div class="row">
			<?php
			$positive = (int) get_post_meta( get_the_ID(), 'positive', true );
			$negative = (int) get_post_meta( get_the_ID(), 'negative', true );
			$total 	  = $positive + $negative;
			$summary  = sprintf( esc_html__( '%1$d out of %2$d found this useful', 'wordflex' ), $positive, $total );
			?>
			<div class="col-12 vote-controls">
				<span class="vote-question"><?php echo _wf_get_option('opt-feedback-text'); ?>
					<span class="pending-ajax"><i class="fas fa-spinner fa-spin"></i></span>
				</span>
				<span class="vote-positive">

					<button type="button" class="btn btn-vote" data-id="<?php echo the_ID(); ?>" data-type="positive" data-count="<?php echo esc_attr($positive); ?>" title="<?php echo esc_html__('Yes', 'wordflex') ?>">
					   <i class="fas fa-thumbs-up mr-2"></i><span class="badge badge-light vote-badge"><?php echo esc_attr( $positive ); ?></span>
					  <span class="sr-only">Like</span>
					</button>

				</span>
				<span class="vote-negative">

					<button type="button" class="btn btn-vote" data-id="<?php echo the_ID(); ?>" data-type="negative" data-count="<?php echo esc_attr($negative); ?>" title="<?php echo esc_html__('No', 'wordflex') ?>">
					   <i class="fas fa-thumbs-down mr-2"></i><span class="badge badge-light vote-badge"><?php echo esc_attr( $negative ); ?></span>
					  <span class="sr-only">Dislike</span>
					</button>

				</span>
				<span class="feedback-result d-block d-md-inline mt-3 mt-md-0"></span>
				<span class="text-muted small d-block mt-3 vote-counter "><?php echo esc_attr( $summary ); ?></span>
			</div>
		</div>
	</div>
	<!-- End Entry Feedback -->
<?php endif; ?>

<?php if(_wf_get_option ('opt-author-bio')) : ?>
	<!-- Start author bio  -->
	<div class="jumbotron py-4 author-bio">
		<div class="row">
			<div class="col-lg-2 col-12 text-center text-md-left author-avatar" itemprop="image">
				<?php echo get_avatar(get_the_author_meta('ID') , '85'); ?>
			</div>
			<div class="col-lg-9 col-12 text-center text-md-left author-data">
				<h4 class="py-2 author-name">
					<span><?php the_author_posts_link(); ?></span>
				</h4>
				<p class="author-desc"><?php echo get_the_author_meta('description'); ?></p>
				<hr>
				<?php if( _wf_get_option('opt-author-socials') ) :
					_wf_author_socials('text-center text-md-right');
				endif; ?>
			</div>
		</div>
	</div>
	<!-- Start author bio  -->
<?php endif ?>

<?php if (_wf_get_option('opt-post-navigation')) :
	_wf_post_navigation(); 
endif ?>