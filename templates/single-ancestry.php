<?php get_header(); ?>
<div class="mh-wrapper clearfix">

	<div id="main-content" class="mh-content" role="main" itemprop="mainContentOfPage"><?php
		while (have_posts()) : the_post(); ?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header clearfix">
		

			<div class="gcofa-row">
			<?php if ( has_post_thumbnail() ) {
				the_post_thumbnail('thumbnail', array('class' => 'alignleft'));
			} else {
        		// get all items in your custom taxonomy
				if( has_term( 'male', 'gender' ) ) {
					echo '<img class="gcofa-avatar" width="90" src="' . plugins_url('../img/male-sillo.png', __FILE__ ) . '" />';
				} elseif( has_term( 'female', 'gender' ) ) {
					echo '<img class="gcofa-avatar" width="90" src="' . plugins_url('../img/female-sillo.png', __FILE__ ) . '" />';
				} else {
					echo '<img class="gcofa-avatar" width="90" src="' . plugins_url('../img/unknown-sillo.png', __FILE__ ) . '" />';
				}

			}
			the_title('<h1 class="entry-title">', '</h1>');

        	$DateBorn = get_post_meta($post->ID, 'date_born', true);
				if ( ! empty ( $DateBorn ) ) {
					echo '<span class="LifeDates">Born: ' . $DateBorn . '</span><br />';
				}

        	$DateDied = get_post_meta($post->ID, 'date_died', true);
				if ( ! empty ( $DateDied ) ) {
					echo '<span class="LifeDates">Died: ' . $DateDied . '</span>';
				} ?>
			</div>

        	<?php echo '<p class="mh-meta entry-meta">' . "\n";
			echo '<span class="entry-meta-date updated"><i class="fa fa-clock-o"></i>Record Added on <a href="' . esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))) . '">' . get_the_date() . '</a></span>' . "\n";
			echo '<span class="entry-meta-author author vcard">by <i class="fa fa-user"></i><span class="fn">' . esc_html(get_the_author()) . '</span></span>' . "\n";
		echo '</p>' . "\n"; ?>

	</header>

	<?php dynamic_sidebar('posts-1'); ?>

	<div class="entry-content clearfix">

        <div class="gcofa-entry-row">
		<?php
			the_content();
		?>
        </div>

        <?php
			$unformatted_content = get_post_meta($post->ID, 'life_facts', true);
			$formatted_content = apply_filters('meta_content', $unformatted_content);
			if ( ! empty ( $unformatted_content ) ) {
		?>
        <div class="gcofa-row">
        <div class="life-facts">
        <h3 class="gcofa-title">Life Facts</h3>
        <?php
			echo $formatted_content;
		?>
        </div>
        <?php } ?>

        <?php
			$unformatted_content = get_post_meta($post->ID, 'family_group', true);
			$formatted_content = apply_filters('meta_content', $unformatted_content);
			if ( ! empty ( $unformatted_content ) ) {
		?>
        <div class="family-group">
        <h3 class="gcofa-title">Family</h3>
        <?php
			echo $formatted_content;
		?>
        </div>
        </div><!-- .gcofa-row -->
        <?php } ?>

        <?php
			$unformatted_content = get_post_meta($post->ID, 'family_tree', true);
			if ( ! empty ( $unformatted_content ) ) {
		?>
        <h3 class="gcofa-title">Family Tree</h3>
        <div class="emperor-pedigree">
	        <?php echo get_post_meta($post->ID, 'family_tree', true); ?>
        </div>
        <?php } ?>

        <?php
			$unformatted_content = get_post_meta($post->ID, 'gcofa_sources', true);
			$formatted_content = apply_filters('meta_content', $unformatted_content);
			if ( ! empty ( $unformatted_content ) ) {
		?>
        <div class="gcofa-row">
        <h4 class="gcofa-title">Evidence and Sources</h4>
        <?php
			echo $formatted_content;
		?>
        </div>
        <?php } ?>

	</div>

	<?php dynamic_sidebar('posts-2'); ?>
</article>


			<?php comments_template();
		endwhile; ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>