<?php
/*
Template Name: Press Page
*/

?>

<?php get_header(); ?>
<div class="content press">
<?php the_post(); ?>
	<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<h1 class="the_title"><?php the_title(); ?></h1>
		<?php
			global $wp_query;
			$temp = $wp_query;
			$wp_query = null;
			$wp_query = new WP_Query();
			$showposts = -1;
			$args = array(
				'post_type' => 'ap_press',
				'posts_per_page' => $showposts,
				'order' => 'ASC'
			);
			query_posts($args); ?>
			<script type="text/javascript">
				jQuery(document).ready(function ($) {
					$("#makeMeScrollable").smoothDivScroll({
						mousewheelScrolling: "allDirections",
						manualContinuousScrolling: true
					});
				});
			</script>
			<div class="entry" id="makeMeScrollable">
				<div class="scrollableArea">
				<?php while ( have_posts() ) : the_post(); ?>
					<section class="product" id="<?php the_ID(); ?>">
						<a href="<?php echo get_post_meta( get_the_ID(), 'url', true  ); ?>" rel="bookmark" ><?php the_post_thumbnail(array(190,190,true)); ?></a><br />
						<a href="<?php echo get_post_meta( get_the_ID(), 'url', true  ); ?>" rel="bookmark" ><?php the_title(); ?></a>
					</section>
				<?php endwhile; ?>
				</div>
			</div><!-- entry -->
		</div><!-- post -->
		<?php $wp_query = null; $wp_query = $temp; ?>
</div><!-- content -->
</div>
<div class="clear"></div>

<?php get_footer(); ?>