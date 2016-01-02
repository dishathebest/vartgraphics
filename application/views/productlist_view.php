<script type="text/javascript">
    $(window).load(function() {
        $('.gallery-main').isotope({
            animationEngine: 'best-available',
            itemSelector: '.gallery-item'
        });
    });
    $(document).ready(function() {
        $(".fancyopen").fancybox({
            openEffect: 'elastic'
        });
    });
</script>
<?php if (count($productImageList) > 0) { ?>
    <ul class="gallery-main">
        <?php
        foreach ($productImageList as $key => $img) {
            ?>
            <li class="gallery-item col-sm-4 <?= str_replace(" ", "_", strtolower($img->pro_name)) ?>">
                <div class="gallery-content">
                    <a class="fancyopen" data-fancybox-group="gallery" href="<?= base_url() ?>uploads/pro_images/<?= $img->image ?>" title="<?php echo "<b>" . $img->caption . "</b><br />" . $img->long_description ?>">
                        <div class="img-div">
                            <img src="<?= base_url() ?>uploads/pro_images/<?= $img->image ?>" alt="Product" />
                            <div class="img-div-hover">
                                <div class="img-zoom">
                                    <i class="fa fa-search-plus fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="pro-description">
                        <h6><?= $img->caption ?></h6>
                        <p><?= substr($img->short_description, 0, 200) ?></p>
                    </div>
                </div>
            </li>
        <?php } ?>
    </ul>
<?php } ?>