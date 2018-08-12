<?php
/**
* Author Page Template
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package WordFlex
* @subpackage WordFlex Author Page
* @since 1.0
* @version 1.1
*/

if ( ! defined( 'ABSPATH' ) ) exit;

$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
get_header() ?>
<!-- Start site-body -->
<main class="site-body" role="main">
	<!-- Start container -->
	<div class="container">
		<h2 class="mb-4 text-center stats author-name">
			<?php printf( esc_html__( '%s Profile', 'wordflex' ), $curauth->nickname )?>
		</h2>
		<!-- Start author-info -->
		<div class="jumbotron author-info">
			<div class="row">
				<div class="col-md-3 text-center">
					<?php 
					$args = array(
						'class' => 'img-fluid img-thumbnail mb-4' 
						);
					echo get_avatar( get_the_author_meta('ID'), 256, '', 'User Avatar', $args );
					?>
				</div>
				<div class="col-md-9 text-center text-md-left">
					<ul class="list-unstyled text-muted small">
						<li><i class="fas fa-user fa-fw" aria-hidden="true"></i>
							<strong><?php echo esc_html__(' Name: ', 'wordflex') ?></strong>
							<?php echo $curauth->first_name . ' ' . $curauth->last_name ?>
						</li>

						<li><i class="fas fa-history fa-fw" aria-hidden="true"></i>
							<strong><?php echo esc_html__(' Member Since: ', 'wordflex') ?></strong><?php echo date( "M Y", strtotime( $curauth->user_registered ) ) ?>
						</li>

						<li><i class="fas fa-envelope fa-fw" aria-hidden="true"></i>
							<strong><?php echo esc_html__(' Email: ', 'wordflex') ?></strong>
							<a href="mailto:<?php echo $curauth->user_email ?>"><?php echo $curauth->user_email ?></a>
						</li>

						<li><i class="fas fa-globe fa-fw" aria-hidden="true"></i>
							<strong><?php echo esc_html__(' Website: ', 'wordflex') ?></strong>
							<a href="<?php echo $curauth->user_url ?>" target="blank"><?php echo $curauth->user_url ?></a>
						</li>	
					</ul>
					<?php _wf_author_socials('m-0') ?>
					<hr>
					<p><?php echo $curauth->description !== '' ? $curauth->description : esc_html__('No Bio', 'wordflex') ?></p>
				</div>
			</div>
		</div>
		<!-- End author-info -->
		<!-- Start author-stats -->
		<div class="text-center author-stats">
			<h3 class="author-name stats mb-4">
				<?php echo esc_html__( 'Author Stats', 'wordflex' ) ?>
			</h3>
			
			<div class="row">
				<div class="col-md-3">
					<div class="stats shadow">
						<?php echo __('Published Posts', 'wordflex') ?>
						<span><?php the_author_posts() ?></span>
					</div>
				</div>
				<div class="col-md-3">
					<div class="stats shadow">
						<?php echo esc_html__('Posts viewed', 'wordflex') ?>
						<span>
							<?php 
							// all posts IDs by current authoe
							$args = array(
								'author'        	=>  $curauth->ID,
								'posts_per_page' 	=> -1,
								'fields'        	=> 'ids',
								'meta_key'        	=> 'post_views_count',
								);

							$curauth_posts = get_posts( $args );
							$views = 0;
							// loop thought out the posts to get the meta
							foreach ($curauth_posts as $key => $ids) {
								$meta = (int) get_post_meta($ids, 'post_views_count', true);
								// sum all views
								$views += $meta;
							}
							echo $views; 
							?>
						</span>
					</div>
				</div>
				<div class="col-md-3">
					<div class="stats shadow">
						<?php echo esc_html__('Posts Liked', 'wordflex') ?>
						<span>
							<?php 
							// all posts IDs by current authoe
							$args = array(
								'author'        	=>  $curauth->ID,
								'posts_per_page' 	=> -1,
								'fields'        	=> 'ids',
								'meta_key'        	=> 'positive',
								);

							$curauth_posts = get_posts( $args );
							$liked = 0;
							// loop thought out the posts to get the meta
							foreach ($curauth_posts as $key => $ids) {
								$meta = (int) get_post_meta($ids, 'positive', true);
								// sum all liked
								$liked += $meta;
							}
							echo $liked; 
							?>
						</span>
					</div>
				</div>
				<div class="col-md-3">
					<div class="stats shadow">
						<?php echo esc_html__('Total Comments', 'wordflex') ?>
						<span>
							<?php 
							$args = array(
								'user_id' => $curauth->ID,
								'count'	  => true
								);
							echo (int) get_comments( $args );
							?>
						</span>
					</div>
				</div>
			</div><!-- row -->
		</div>
		<!-- End author-stats -->
		<!-- Start author-posts -->
		<div class="author-posts">
			<h4 class="author-name stats mb-5 text-center"><?php printf( esc_html__( '%s Posts', 'wordflex' ), $curauth->nickname )?></h4>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/post/content', 'author'); ?>
				<?php endwhile ?>
				<div class="d-flex justify-content-center mt-4"><?php _wf_pagination(); ?></div>
			<?php else : ?>
				<?php echo esc_html__('No posts to display', 'wordflex') ?>
			<?php endif ?>
		</div>
		<!-- Start author-posts -->
	</div>
	<!-- End container -->
</main>
<!-- End site-body -->
<hr>
<?php get_footer() ?>