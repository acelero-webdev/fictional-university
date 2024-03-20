<?php  get_header(); ?>
    
<?php // While we have a post in our "Posts" collection. ?>
<?php while(have_posts()) { ?>
    <?php // Keeps track of the current wordpress post. ?>
    <?php the_post(); ?>

    <?php 
        $bannerImage = get_field('page_banner_background_image');
        $bannerUrl = $bannerImage ? $bannerImage['sizes']['pageBanner'] : get_theme_file_uri('images/ocean.jpg');

        $bannerSubtitle = get_field('page_banner_subtitle');
        $theSubtitle = $bannerSubtitle ? $bannerSubtitle : "We will do great things!";
    ?>

    <?php createPageBanner($bannerUrl, $theSubtitle, get_the_title()); ?>

    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?php echo site_url('/programs') ?>"><i class="fa fa-home" aria-hidden="true"></i> All Programs</a> 
                <span class="metabox__main"><?php the_title(); ?></span>
            </p>
        </div>

        <div class="generic-content">
            <?php the_content()?>
        </div>

        <?php $today = date('Ymd') ?>

    <?php # Retrieve the related professors via a custom query ?>
    <?php $relatedProfessors = new WP_Query(array(
        'post_type' => 'professor',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'related_programs',
                'compare' => 'LIKE',
                'value' =>  '"' . get_the_ID() . '"',
            )
        )
    )) ?>

    <?php # Loop through related professors and display them on the screen.?>
    <?php if($relatedProfessors->have_posts()) { ?>
        <hr class="section-break"></hr>
        <h2 class="headline headline--medium"><?php the_title() ?> Professors</h2>
        
        <ul class="professor_cards">
        <?php while($relatedProfessors->have_posts()) { ?>
            <?php $relatedProfessors->the_post(); ?>
            <li class="professor-card__list-item">
                <a class="professor-card" href="<?php the_permalink()?>">
                    <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape'); ?>"/>
                    <span class="professor-card__name"> <?php the_title(); ?> </span>
                </a>
            </li>
        <?php } ?>
        </ul>

        <?php wp_reset_postdata(); ?>
    <?php } ?>


    <?php # Retrieve the related events via a custom query ?>
    <?php $relatedEvents = new WP_Query(array(
        'post_type' => 'event',
        'posts_per_page' => 2,
        'meta_key' => 'event_date',
        'orderby' => 'meta_value',
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' =>  $today,
                'type' => 'numeric',
            ),
            array(
                'key' => 'related_programs',
                'compare' => 'LIKE',
                'value' =>  '"' . get_the_ID() . '"',
            )
        )
    )) ?>

    <?php # Loop through related events and display them on the screen.?>
    <?php if($relatedEvents->have_posts()) { ?>
        <hr class="section-break"></hr>
        <h2 class="headline headline--medium">Upcoming <?php the_title() ?> Events</h2>
        <?php while($relatedEvents->have_posts()) { ?>
            <?php $relatedEvents->the_post(); ?>
            <?php get_template_part('template-parts/content-event')?>
        <?php } ?>
        <?php wp_reset_postdata(); ?>
    <?php } ?>

    </div>
<?php } ?>

<?php get_footer(); ?>