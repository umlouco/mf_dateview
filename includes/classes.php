<?php

require plugin_dir_path(__file__) . 'views.php';

class MF_Dataviews {

    public function __construct() {

        //$this->load_scripts();
        $this->addSchortcodes();
    }

    private function load_scripts() {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
    }

    public function enqueue_scripts() {
        wp_enqueue_style('jquery_calendar', $this->plugin_url . '/public/css/eventCalendar.css');
        wp_enqueue_style('jquery_calendar_theme', $this->plugin_url . '/public/css/eventCalendar_theme_responsive.css');

        wp_enqueue_script('jquery2', $this->plugin_url . '/public/js/jquery-2.2.4.js');
        wp_enqueue_script('jquery_clendar', $this->plugin_url . '/public/js/jquery.eventCalendar.js', array('jquery2'), 1, true);
    }

    function addSchortcodes() {
        add_shortcode('mf_dateview', array($this, 'showCalendar'));
    }

    function showCalendar($args) {
        $views = new MF_dateviews_views();
        $data = $this->getDates($args['category']);
        $year = $_GET['year_mf']; 
        if(empty($year)){
            $year = date("Y"); 
        }
        return $views->topDates($data, $year);
    }

    function getDates($category) {
        $cat = get_category_by_slug($category);
        $id = $cat->term_id;
        $args = array(
            "category" => $id,
            "posts_per_page" => -1, 
            "meta_key" => "wpcf-event-date", 
            "orderby" => "meta_value", 
            "order" => "ASC",
        );
        $posts = get_posts($args);
        $years = array();
        foreach ($posts as $key => $post) {
            $meta = get_post_meta($post->ID);
            $date = new DateTime();
            if ($meta['wpcf-event-date'][0] > 0) {
                $date->setTimestamp($meta['wpcf-event-date'][0]);
                $y = $date->format("Y");
                $data = array(
                    "post" => $post, 
                    "meta" => $meta
                ); 
                $years[$y][] = $data;
            }
        }
         ksort($years);
        $data["years"] = $years; 
        
        return $data; 
    }

}
