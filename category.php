<?php get_header(); ?>

<main class="clearfix" id="content" role="main">
	<h1 class="headline"><b class="ss-icon" data-icon="database">&#xE7A0;</b> <?php printf( 'Category Archives: %s', single_cat_title( '', false )); ?></h1>

	<ul class="entries list-reset">
		<?php if( have_posts() ) : while( have_posts() ) : the_post()?>
			<li class="entries__item" id="post-<?php the_ID(); ?>">
				<article <?php post_class('entry'); ?>>
					<h1 class="entry__title"><?php the_title(); ?></h1>

					<?php get_template_part( 'inc/meta' ); ?>

					<div class="entry__content">
						<?php the_content( '<div class="button"><span class="read-more ss-icon">&#x1F440;</span></div>' ); ?>
					</div>
				</article>
			</li>
		<?php endwhile; ?>
	</ul>

	<?php else : ?>
		<p><b class="ss-icon">warning</b><?php echo ( 'Holy smokes! This is totally crazy. No posts match anything even remotely close to that in our database. Sorry Mon Frere, try again' ); ?></p>
	<?php endif; ?>

	<div class="pagination">
		<p><?php posts_nav_link( ' &#8734; ', '&laquo; Go Forward In Time', 'Go Back In Time &raquo;' ); ?></p>
	</div>
</main>

<?php get_footer(); ?>