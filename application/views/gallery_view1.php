<link rel="stylesheet" type="text/css" media="screen" href="<?= base_url() ?>css/fancyapps.css" lang="en">
<script type="text/javascript" src="<?= base_url() ?>js/isotope.pkgd.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/packery-mode.pkgd.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/fancyapps.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.category-list li a.catlink').on('click', function() {
            $('.category-list li a.catlink, .category-list li a.prolink').removeClass("active");
            $(this).addClass("active");
            var cat_id = $(this).attr("cat_id");
            $.ajax({
                url: base_url + "gallery/getProductsByCat",
                type: "POST",
                dataType: 'json',
                data: {cat_id: cat_id},
                beforeSend: function() {
                    $("#productlist").html('<div style="text-align:center;line-height:80px;"><img src="' + base_url + 'images/loading.gif" alt="Processing" /></div>');
                },
                success: function(response) {
                    $("#productlist").html(response.content);
                }
            });
        });
        $('.category-list li a.prolink').on('click', function() {
            $('.category-list li a.prolink').removeClass("active");
            $(this).addClass("active");
            var selector = $(this).data('filter');
            $('.gallery-main').isotope({
                filter: selector
            });
        });
    });
</script>
<div class="vart-container">
    <h2 class="text-center catebanner wowload fadeInUp animated animated" style="visibility: visible; animation-name: fadeInUp;">
        <?= $cat_id > 0 ? $currentCat->cat_name : 'Cateogry' ?>
    </h2>

    <?php if ($cat_id > 0 && $currentCat->image != '') { ?>
        <div class="cat-bannerimage col-sm-12">
            <img src="<?= base_url() ?>images/category/<?= $currentCat->image ?>" alt="Category" />
        </div>
    <?php } ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php if ($cat_id > 0 && $currentCat->image != '') { ?>
                    <p><?= $currentCat->cat_description ?></p>
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 yellow-bg" style="margin-bottom:10px;">
                <ul class="category-list">
                    <?php foreach ($categoryList as $index => $cat) { ?>
                        <li>
                            <a class="catlink <?= ($cat_id == $cat->cat_id ? "active " : "") ?>accordion-toggle" data-toggle="collapse" href="#collapse<?= $index ?>" cat_id="<?= $cat->cat_id ?>"><?= $cat->cat_name ?>
                                <div class="cat-toggle"><i class="fa fa-caret-right"></i></div>
                            </a>

                            <?php if (isset($productList[$cat->cat_id]) && count($productList[$cat->cat_id]) > 0) { ?>
                                <ul id="collapse<?= $index ?>" class="accordion-body collapse<?= ($cat_id == $cat->cat_id ? ' in' : "") ?>">
                                    <li><a href="javascript:void(0);" data-filter="*" class="prolink">All</a></li>
                                    <?php foreach ($productList[$cat->cat_id] as $pro) { ?>
                                        <li>
                                            <a href="javascript:void(0);" class="prolink" data-filter=".<?= str_replace(" ", "_", strtolower($pro->pro_name)) ?>"><?= $pro->pro_name ?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-sm-9" id="productlist">
                <?php
                $data['productImageList'] = $productImageList;
                $this->load->view("productlist_view", $data);
                ?>
            </div>
        </div>
    </div>
</div>