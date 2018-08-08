<?php

class MF_dateviews_views {

    function topDates($data, $year) {
        ?>
        <div class="btn btn-group change_btn">
            <?php foreach ($data["years"] as $key => $y): ?>
                <a href="<?php echo add_query_arg('year_mf', $key, $_SERVER['REQUEST_URI']); ?>" class="btn btn-<?php echo $key == $year ? 'default' : 'primary'; ?>">
                    <?php echo $key; ?>
                </a>
            <?php endforeach; ?>
        </div>
<?php $preve = ''; ?>
        <?php foreach ($data["years"][$year] as $post): ?>
<?php 
$curent = new DateTime(); 
$curent->setTimestamp($post['meta']['wpcf-event-date'][0]);
if($curent->format("m") != $prev){
    echo '<h2>'.date_i18n("F", $post['meta']['wpcf-event-date'][0]).'</h2>'; 
}
$prev = $curent->format("m"); 
?>
            <div class="row">
                <div class="col-sm-3">
                    <div class="list_image">
                        <?php echo get_the_post_thumbnail($post["post"]->ID); ?>
                    </div>
                </div>
                <div class="col-sm-9">
                    <h3>
                        <a href="<?php echo get_permalink($post["post"]->ID); ?>">
                            <?php echo $post["post"]->post_title; ?>
                        </a> 
                    </h3>
                    <?php echo $post["meta"]["wpcf-resultlisttext"][0]; ?>
                    
                </div>
            </div>
<hr />
        <?php endforeach; ?> 
        <?php
    }

}
