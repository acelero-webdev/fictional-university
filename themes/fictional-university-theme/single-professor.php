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
        <div class="generic-content">
            <div class "row group">
                <div class="one-third">
                    <?php the_post_thumbnail('professorPortrait'); ?>
                </div>
                <div class="two-third">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>

        <?php $relatedPrograms = get_field('related_programs'); ?>

        <?php if($relatedPrograms) { ?>
            <hr class="section-break"></hr>
            <h2 "headline headline--medium">Subject(s) Taught</h2>
            <ul class="link-list min-list">
            <?php foreach($relatedPrograms as $relatedProgram) { ?>
                <li><a href="<?php echo get_the_permalink($relatedProgram);?>"><?php echo get_the_title($relatedProgram); ?></li>
            <?php } ?>
            </ul>
        <?php } ?>
    </div>

<?php } ?>

<?php get_footer(); ?>