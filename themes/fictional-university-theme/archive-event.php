<?php get_header(); ?>

<?php 
    $bannerImage = get_field('page_banner_background_image');
    $bannerUrl = $bannerImage ? $bannerImage['sizes']['pageBanner'] : get_theme_file_uri('images/ocean.jpg');

    $bannerSubtitle = get_field('page_banner_subtitle');
    $theSubtitle = $bannerSubtitle ? $bannerSubtitle : "We will do great things!";
?>

<?php createPageBanner($bannerUrl, $theSubtitle, "All Events"); ?>

<div class="container container--narrow page-section">
  <?php while(have_posts())  { ?>
    <?php the_post(); ?>
    
    <?php get_template_part('template-parts/content-event')?>

  <?php } ?>

  <?php echo paginate_links() ?>

  <hr class="section-break">
  
  <p>Looking for a recap of past events? <a href="<?php echo site_url('/past-events')?>">Check out our past events archive</a></p>
</div>

  
<?php get_footer(); ?>