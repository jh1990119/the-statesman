<?php get_header(); ?><header class="row">	<div class="sectionhead">		<div class="hline hline-background"></div>		<span class="sectionhead-text sectionhead-text-centered"><?php single_cat_title(); ?></span>	</div></header><main>	<div class="hline hline-strong"></div>	<section class="row">		<article class="main">			<?php $args = array( 'posts_per_page' => 1, 'offset' => 1, 'category__and' => array(883, 163)); ?>			<?php $myposts = new WP_Query( $args ); ?>			<?php while ( $myposts->have_posts() ) : ?>				<?php $myposts->the_post(); ?>				<div class="multicontent">					<?php echo embed_mm_content(get_the_ID()); ?>				</div>				<div class="multislug">					<h1 id="post-<?php the_ID(); ?>">						<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>					</h1>					<p class="metatext metatext-byline small-text">By <?php the_author_posts_link(); ?> / <a href="<?php the_archive_date(); ?>"><?php the_time('F j, Y'); ?></a></p>					<p class="excerpt"><?php the_excerpt(); ?></p>				</div>			<?php endwhile; ?>		</article>		<sidebar class="sidebar">			<?php $displays   = array('video' => 'Video','image' => 'Photo Gallery','audio' => 'Audio');?>			<?php $args = array( 'posts_per_page' => 2, 'offset' => 1, 'category__and' => array(16, 163), 'category__not_in' => array(883)); ?>			<?php $myposts = new WP_Query( $args ); ?>			<?php while ( $myposts->have_posts() ) : ?>			<?php $myposts->the_post(); ?>			<?php $format  = get_post_format(get_the_ID());?>			<article class="vmedia">				<figure class="thumbnail-min thumbnail-sidebar hovertext-container">					<a href="<?php the_permalink(); ?>">						<?php if ( has_post_thumbnail()) {the_post_thumbnail('medium');} ?>						<h5 class="hovertext hovertext-sidebar">							<img src="<?php echo get_template_directory_uri(); ?>	/images/playsmall.png"/>							&nbsp;&nbsp;							<?php echo $displays[$format] ?>						</h5>					</a>				</figure>				<div class="block">					<h4 id="post-<?php the_ID(); ?>">						<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>					</h4>				</div>			</article>			<?php endwhile; ?>		</sidebar>					</section>		<?php $postsPerSlide = 4; $slides = 5;?>	<?php $postFormats   = array('video' => 'video','image' => 'photo','audio' => 'audio');?>	<?php $sliderId      = 0; ?>	<?php foreach ($postFormats as $format => $display):?>	<section class="row">		<div class="hline hline-medium"></div>				<h6><a href="<?php echo esc_url(get_category_link(163)); ?>"><?php echo $display ?></a></h6>		<?php $args = array( 'posts_per_page' => $postsPerSlide*$slides, 'cat' => 163, 'tax_query' => array(array(			'taxonomy' => 'post_format',			'field' => 'slug',			'terms' => array('post-format-'.$format)		))); ?>		<?php $myposts = new WP_Query( $args ); ?>		<?php $postnum = 0?>		<div class="slidecontainer" data-slidelist-<?php echo $sliderId ?>>			<div class="slideprev" data-slidelist-<?php echo $sliderId ?>-prev>				<img src="<?php echo get_template_directory_uri(); ?>/images/thin_left_arrow_333.png" />			</div>			<ul class="slidelist" data-slidelist-<?php echo $sliderId ?>-list>				<?php while ( $myposts->have_posts() ) : ?>				<?php $myposts->the_post();?>				<li class="slideitem" data-slidelist-<?php echo $sliderId ?>-item-<?php echo $postnum;?>>					<figure class="thumbnail-min thumbnail-medium hovertext-container">						<a href="<?php the_permalink(); ?>">							<?php if ( has_post_thumbnail()) {the_post_thumbnail('medium');} ?>							<div class="hovertext hovertext-medium">								<img src="<?php echo get_template_directory_uri(); ?>	/images/playsmall.png"/>							</div>						</a>					</figure>					<div>						<h4 id="post-<?php the_ID(); ?>" class="slideTitle">							<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>						</h4>					</div>				</li>				<?php $postnum += 1; ?>				<?php endwhile; ?>			</ul>						<div class="slidenext" data-slidelist-<?php echo $sliderId ?>-next>				<img src="<?php echo get_template_directory_uri(); ?>/images/thin_right_arrow_333.png" />			</div>		</div>	</section>	<?php $sliderId += 1; ?>	<?php endforeach;?>	<div class="hline hline-medium"></div></main><script>	$(document).ready(function() {		/* Initiate three sliders. */		$('[data-slidelist-0]').slidelist({id: 0});		$('[data-slidelist-1]').slidelist({id: 1});		$('[data-slidelist-2]').slidelist({id: 2});	});</script><?php get_footer(); ?>