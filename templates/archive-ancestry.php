<?php get_header(); ?>
<div class="mh-wrapper clearfix">
	<div id="main-content" class="mh-loop mh-content" role="main"><?php
		mh_before_page_content(); ?>

		<header class="page-header"><?php
			the_archive_title('<h1 class="page-title">', '</h1>'); ?>
		</header>

		<article class="archive-list clearfix">
			<div class="entry-content">
				<ol>
				<?php
                	$args = array(
						'post_type'      => 'ancestry',
						'posts_per_page' => -1,
						'orderby'        => 'title',
						'order'          => 'ASC'
						);
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post(); ?>
					
						<li><a href="<?php the_permalink();?>"><?php the_title(); ?></a></li>

					<?php endwhile; ?>
				</ol>
			</div>
		</article>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>