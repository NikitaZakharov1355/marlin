<?php
    $title = get_sub_field('title');
    $faq_items = get_sub_field('faq_items');
    $image = get_sub_field('images');
?>

<section class="faq">
    <div class="container text_c">
        <h2 class="faq_title"><?php echo $title; ?></h2>
    </div>
    <div class="container_fluid flex">
        <div class="faq_toggle">
        <?php foreach($faq_items as $item): ?>
            <div class="toggle">
                <div class="toggle_title">
                    <?php echo $item['title']; ?>
                </div>
                <div class="toggle_text">
                    <?php echo $item['text']; ?>
                </div>     
            </div>       
        <?php endforeach; ?>
        </div>
        <div class="faq_gallery">
            <div class="faq_gallery-wrapper">
            <div class="green_bg"></div>
            <?php foreach($image as $item): ?>
                <picture>
                    <img src="<?php echo $item['url']; ?>" alt="<?php echo $item['alt']; ?>">
                </picture>
            <?php endforeach; ?>
        </div>
        </div>
    </div>
</section>