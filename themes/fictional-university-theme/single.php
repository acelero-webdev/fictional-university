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
                <a class="metabox__blog-home-link" href="<?php echo site_url('/blog') ?>"><i class="fa fa-home" aria-hidden="true"></i> Blog Home</a> 
                <span class="metabox__main">Posted by <?php the_author_posts_link()?> on <?php the_time('l, F jS, Y') ?> in <?php echo get_the_category_list(', ')?></span>
            </p>
        </div>

        <div class="generic-content">
            <?php the_content()?>
        </div>
    </div>

<?php } ?>

<?php get_footer(); ?>