<?php
    $items = get_sub_field('items');
?>

<section class="banners">
    <div class="container flex">
        <?php foreach($items as $item): ?>
            <a href="<?php echo $item['link']['url']; ?>" title="<?php echo $item['link']['title']; ?>" class="banners_item">
                <img src="<?php echo $item['image']['url']; ?>" alt="<?php echo $item['image']['alt']; ?>">
            </a>
        <?php endforeach; ?>
    </div>
</section>