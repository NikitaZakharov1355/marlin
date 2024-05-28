<?php
    $title = get_sub_field('title');
    $text = get_sub_field('text');
    $iframe = get_sub_field('iframe');
?>

<section class="text_video">
    <div class="container flex align_c">
        <div class="text_video-iframe">
            <?php echo $iframe; ?>
        </div>
        <div class="text_video-descr">
            <h2 class="text_video-title"><?php echo $title; ?></h2>
            <?php echo $text; ?>
        </div>
    </div>
</section>