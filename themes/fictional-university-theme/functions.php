<?php
    function createPageBanner($bannerUrl, $theSubtitle, $theTitle) { 
        // php logic will here. ?>
        <div class="page-banner">
            <div class="page-banner__bg-image" style="background-image: url(<?php echo $bannerUrl ?>)"></div>
            <div class="page-banner__content container container--narrow">
                <h1 class="page-banner__title"><?php echo $theTitle ?></h1>
                <div class="page-banner__intro">
                    <p><?php echo $theSubtitle; ?></p>
                </div>
            </div>
        </div>
    
    <?php }

    function loadUniversityFiles() {
        // SCRIPTS
        wp_enqueue_script('mainUniversityJavascript', get_theme_file_uri('./build/index.js'), array('jquery'), '1.0', true);

        // STYLES
        wp_enqueue_style('universityMainStyles', get_theme_file_uri('./build/style-index.css'));
        wp_enqueue_style('universityExtraStyles', get_theme_file_uri('./build/index.css'));
        wp_enqueue_style('fontAwesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        wp_enqueue_style('customGoogleFonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    }

    function universityFeatures() {
        register_nav_menu('headerMenuLocation', 'Header Menu Location');
        register_nav_menu('exploreFooterLocation', 'Explore Footer Location');
        register_nav_menu('learnFooterLocation', 'Learn Footer Location');
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_image_size('professorLandscape', 400, 260, true);
        add_image_size('professorPortrait', 480, 650, true);
        add_image_size('pageBanner', 1500, 350, true);
    }

    function universityAdjustQueries($query) {

        // Manipulate the default event archive query.
        if(!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) {
            $today = date('Ymd');

            $query->set('meta_key', 'event_date');
            $query->set('orderby', 'meta_value');
            $query->set('order', 'ASC');
            $query->set('meta_query', array(
                array(
                  'key' => 'event_date',
                  'compare' => '>=',
                  'value' => $today,
                  'type' => 'numeric',
                )
            ));
        }

        // Manipulate the default program archive query.
        if(!is_admin() AND is_post_type_archive('program') AND $query->is_main_query()) {
            $query->set('posts_per_page', -1);
            $query->set('orderby', 'title');
            $query->set('order', 'ASC');
        }
    }

    // Loads files into the head of our html document.
    add_action('wp_enqueue_scripts', 'loadUniversityFiles');

    add_action('after_setup_theme', 'universityFeatures');

    add_action('pre_get_posts', 'universityAdjustQueries');
    
?>