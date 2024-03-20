<?php get_header(); ?>

<?php 
    $bannerImage = get_field('page_banner_background_image');
    $bannerUrl = $bannerImage ? $bannerImage['sizes']['pageBanner'] : get_theme_file_uri('images/ocean.jpg');

    $bannerSubtitle = get_field('page_banner_subtitle');
    $theSubtitle = $bannerSubtitle ? $bannerSubtitle : "We will do great things!";
?>

<?php createPageBanner($bannerUrl, $theSubtitle, "All Programs"); ?>

<div class="container container--narrow page-section">
    <ul class="link-list min" >

    <?php while(have_posts())  { ?>
        <?php the_post(); ?>

        <li><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></li>

    <?php } ?>

    </ul>

    <?php echo paginate_links(); ?>
</div>

  
<?php get_footer(); ?>