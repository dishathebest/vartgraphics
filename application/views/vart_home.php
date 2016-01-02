<div id="home">
    <!-- Slider Starts -->
    <div id="myCarousel" class="carousel slide banner-slider animated bounceInDown" data-ride="carousel">     
        <div class="carousel-inner">
            <?php
            $i = 1;
            foreach ($bannerList as $banner) {
                ?>
                <div class="item <?= $i == 1 ? "active" : "" ?>">
                    <img src="<?= base_url() ?>images/home_banner/<?= $banner->image ?>" alt="banner">
                </div>
                <?php
                $i++;
            }
            ?>
            <!-- Item 1 
            <div class="item">
              <img src="<?= base_url() ?>images/back1.jpg" alt="banner">
            </div>
            <!-- #Item 1 -->

            <!-- Item 1 
            <div class="item">
              <img src="<?= base_url() ?>images/back2.jpg" alt="banner">
            </div>
            <!-- #Item 1 
    
            <!-- Item 1 
            <div class="item">
              <img src="<?= base_url() ?>images/back3.jpg" alt="banner">
            </div>
            <!-- #Item 1 
    
            <!-- Item 1 
            <div class="item">
              <img src="<?= base_url() ?>images/back4.jpg" alt="banner">
            </div>
            <!-- #Item 1 -->
        </div>
        <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon-chevron-left"><i class="fa fa-angle-left"></i></span></a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon-chevron-right"><i class="fa fa-angle-right"></i></span></a>
    </div>
    <!-- #Slider Ends -->
</div>

<!-- Cirlce Starts -->
<div id="about" class="container spacer about">
    <h2 style="visibility: visible; animation-name: fadeInUp;" class="text-center wowload fadeInUp animated">Creative Graphic Designers</h2>  
    <div class="row">
        <div style="visibility: visible; animation-name: fadeInLeft;" class="col-sm-6 wowload fadeInLeft animated">
            <h4><i class="fa fa-camera-retro"></i> <?= $introduction->page_title ?></h4>
            <?= $introduction->content ?>


        </div>
        <div style="visibility: visible; animation-name: fadeInRight;" class="col-sm-6 wowload fadeInRight animated">
            <h4><i class="fa fa-coffee"></i> <?= $passion->page_title ?></h4>
            <?= $passion->content ?>
        </div>
    </div>

    <div class="services">
        <h3 style="visibility: visible; animation-name: fadeInUp;" class="text-center wowload fadeInUp animated">Services</h3>
        <ul style="visibility: visible; animation-name: bounceInUp;" class="row text-center list-inline  wowload bounceInUp animated">
            <li>
                <span><i class="fa fa-camera-retro"></i><b>Photography</b></span>
            </li>
            <li>
                <span><i class="fa fa-cube"></i><b>Studio</b></span>
            </li>
            <li>
                <span><i class="fa fa-graduation-cap"></i><b>Trainings</b></span>
            </li>
            <li>
                <span><i class="fa fa-umbrella"></i><b>Travel</b></span>
            </li>        
            <li>
                <span><i class="fa fa-heart-o"></i><b>Wedding</b></span>
            </li>
        </ul>
    </div>
</div>
<!-- #Cirlce Ends -->


<!-- works -->
<div id="works" class=" clearfix grid">
    <?php foreach ($categoryList as $cat) { ?>
        <figure style="visibility: visible; animation-name: fadeInUp;" class="effect-oscar  wowload fadeInUp animated">
            <img src="<?= base_url() ?>images/category/<?= $cat->image_home ?>" alt="img01">
            <div class="overlay1"></div>
            <figcaption>
                <h2><?= $cat->cat_name ?></h2>
                <p><?= $cat->cat_description ?><br>
                    <a href="<?= base_url() ?>gallery/index/<?= str_replace(" ", "_", (strtolower($cat->cat_name))) ?>" title="1" data-gallery="">View more</a></p>            		
            </figcaption>
        </figure>
    <?php } ?>
</div>
<!-- works -->


<div id="partners" class="container spacer ">
    <h2 style="visibility: visible; animation-name: fadeInUp;" class="text-center  wowload fadeInUp animated">Some of our happy clients</h2>
    <div class="clearfix">
        <div style="visibility: visible; animation-name: fadeInLeft;" class="col-sm-6 partners  wowload fadeInLeft animated">
            <img src="<?= base_url() ?>images/1.jpg" alt="partners">
            <img src="<?= base_url() ?>images/2_002.jpg" alt="partners">
            <img src="<?= base_url() ?>images/3.jpg" alt="partners">
            <img src="<?= base_url() ?>images/4.jpg" alt="partners">
        </div>
        <div class="col-sm-6">


            <div style="visibility: visible; animation-name: fadeInRight;" id="carousel-testimonials" class="carousel slide testimonails  wowload fadeInRight animated" data-ride="carousel">
                <div class="carousel-inner">  
                    <?php
                    $j = 0;
                    foreach ($testimonialList as $testimonial) {
                        ?>
                        <div class="item animated bounceInRight row<?php
                        if ($j == "0") {
                            echo " active";
                        }
                        ?>">
                                 <?php
                                 $testi_image = "images/user-placeholder.png";
                                 if ($testimonial->image != '') {
                                     $testi_image = "images/testimonial/" . $testimonial->image;
                                 }
                                 ?>
                            <div class="animated slideInLeft col-xs-2"><img alt="Testimonial" src="<?= base_url() . $testi_image ?>" class="img-circle img-responsive" width="100"></div>
                            <div class="col-xs-10">
                                <p><?= $testimonial->comment ?></p>      
                                <span><?= $testimonial->name ?> - <b><?= $testimonial->company_name ?></b></span>
                            </div>
                        </div>
                        <?php
                        $j++;
                    }
                    ?>

                </div>

                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <?php
                    $j = 0;
                    foreach ($testimonialList as $testimonial) {
                        ?>
                        <li class="<?= $j == "0" ? "active" : "" ?>" data-target="#carousel-testimonials" data-slide-to="<?= $j ?>"></li>
                        <?php
                        $j++;
                    }
                    ?>
                </ol>
                <!-- Indicators -->
            </div>



        </div>
    </div>


    <!-- team -->
    <!--<h3 style="visibility: visible; animation-name: fadeInUp;" class="text-center  wowload fadeInUp animated">Our team</h3>
    <p style="visibility: visible; animation-name: fadeInLeft;" class="text-center  wowload fadeInLeft animated">Our creative team that is making everything possible</p>
    <div style="visibility: visible; animation-name: fadeInUpBig;" class="row grid team  wowload fadeInUpBig animated">	
        <div class=" col-sm-3 col-xs-6">
            <figure class="effect-chico">
                <img src="<?= base_url() ?>images/8_002.jpg" alt="img01" class="img-responsive">
                <figcaption>
                    <p><b>Barbara Husto</b><br>Senior Designer<br><br><a href="#"><i class="fa fa-dribbble"></i></a> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-twitter"></i></a></p>            
                </figcaption>
            </figure>
        </div>

        <div class=" col-sm-3 col-xs-6">
            <figure class="effect-chico">
                <img src="<?= base_url() ?>images/10.jpg" alt="img01">
                <figcaption>            
                    <p><b>Barbara Husto</b><br>Senior Designer<br><br><a href="#"><i class="fa fa-dribbble"></i></a> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-twitter"></i></a></p>            
                </figcaption>
            </figure>
        </div>

        <div class=" col-sm-3 col-xs-6">
            <figure class="effect-chico">
                <img src="<?= base_url() ?>images/12.jpg" alt="img01">
                <figcaption>
                    <p><b>Barbara Husto</b><br>Senior Designer<br><br><a href="#"><i class="fa fa-dribbble"></i></a> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-twitter"></i></a></p>          
                </figcaption>
            </figure>
        </div>

        <div class=" col-sm-3 col-xs-6">
            <figure class="effect-chico">
                <img src="<?= base_url() ?>images/17.jpg" alt="img01">
                <figcaption>
                    <p><b>Barbara Husto</b><br>Senior Designer<br><br><a href="#"><i class="fa fa-dribbble"></i></a> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-twitter"></i></a></p>
                </figcaption>
            </figure>
        </div>


    </div>-->
    <!-- team -->

</div>









<!-- About Starts -->
<div class="highlight-info">
    <div class="overlay spacer">
        <div class="container">
            <div style="visibility: visible; animation-name: fadeInDownBig;" class="row text-center  wowload fadeInDownBig animated">
                <div class="col-sm-3 col-xs-6">
                    <i class="fa fa-smile-o  fa-5x"></i><h4>24 Clients</h4>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <i class="fa fa-rocket  fa-5x"></i><h4>75 Projects</h4>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <i class="fa fa-cloud-download  fa-5x"></i><h4>454 Downloads</h4>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <i class="fa fa-map-marker fa-5x"></i><h4>2 Offices</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="highlight-info">
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <script>
        function initialize() {
            var mapProp = {
                center: new google.maps.LatLng(51.508742, -0.120850),
                zoom: 5,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <div id="googleMap" style="width:100%;height:295px;"></div>
</div>
<!-- About Ends -->








<div id="contact" class="spacer">
    <!--Contact Starts-->
    <div class="container contactform center">
        <h2 style="visibility: visible; animation-name: fadeInUp;" class="text-center  wowload fadeInUp animated">Get in touch to start your project</h2>
        <div style="visibility: visible; animation-name: fadeInLeftBig;" class="row wowload fadeInLeftBig animated">      
            <div class="col-sm-6 col-sm-offset-3 col-xs-12">
                <div class="alert alert-dismissable hide" id="inquiryFormHolder">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <!-- message here -->
                </div>
                <form method="POST" action="javascript:void(0);" id="contact-form">
                    <div class="form-group">
                        <input type="text" placeholder="Your name" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <input placeholder="Company" type="text" name="company" id="company">
                    </div>
                    <div class="form-group">
                        <input placeholder="Email" type="text" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <textarea rows="5" placeholder="Message" name="message" id="message"></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit" id="btn-contact"><i class="fa fa-paper-plane"></i> Send</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Contact Ends-->
<a href="#home" class="gototop "><i class="fa fa-angle-up  fa-3x"></i></a>