<html class=""><head>

       <link href="http://localhost/vartgraphics3/css/css.css" rel="stylesheet" type="text/css">

        <!-- font awesome -->
        <link href="http://localhost/vartgraphics3/css/font-awesome.min.css" rel="stylesheet">

        <!-- bootstrap -->
        <link rel="stylesheet" href="http://localhost/vartgraphics3/css/bootstrap.css">

        <!-- animate.css -->
        <link rel="stylesheet" href="http://localhost/vartgraphics3/css/animate.css">
        <link rel="stylesheet" href="http://localhost/vartgraphics3/css/set.css">

        <!-- gallery -->
        <link rel="stylesheet" href="http://localhost/vartgraphics3/css/blueimp-gallery.css">

        <!-- favicon -->
        <link rel="shortcut icon" href="http://thebootstrapthemes.com/live/thebootstrapthemes-photography/images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="http://thebootstrapthemes.com/live/thebootstrapthemes-photography/images/favicon.ico" type="image/x-icon">


        <link rel="stylesheet" href="http://localhost/vartgraphics3/css/style.css">

        <script type="text/javascript">
            var base_url = "http://localhost/vartgraphics3/";
        </script>

        <!-- jquery -->
        <script src="http://localhost/vartgraphics3/js/jquery.min.js"></script>

        <!-- wow script -->
        <script src="http://localhost/vartgraphics3/js/wow.js"></script>

        <!-- boostrap -->
        <script src="http://localhost/vartgraphics3/js/bootstrap.min.js" type="text/javascript"></script>

        <!-- jquery mobile -->
        <script src="http://localhost/vartgraphics3/js/touchSwipe.js"></script>
        <script src="http://localhost/vartgraphics3/js/respond.js"></script>

        <!-- gallery -->
        <script src="http://localhost/vartgraphics3/js/jquery.js"></script>

        <script src="http://localhost/vartgraphics3/js/jquery.validate.js"></script>
        <!-- custom script -->
        <script src="http://localhost/vartgraphics3/js/script.js"></script>

<style>

/* inherit height from window */

body {
  font-family: sans-serif;
}


/* ---- grid ---- */

.grid {
  background: #DDD;
  height: 75%; /* inherit height from body */
}

/* clear fix */


/* ---- .grid-item ---- */

.grid-item {
  float: left;
  width: 100px;
  height: 100px;
  background: #0D8;
  border: 2px solid #333;
  border-color: hsla(0, 0%, 0%, 0.7);
}

.grid-item--width2 { width: 200px; }
.grid-item--height2 { height: 200px; }
</style></head><body>
<script type="text/javascript" src="http://localhost/vartgraphics3/js/isotope.pkgd.js"></script>
<script type="text/javascript" src="http://localhost/vartgraphics3/js/packery-mode.pkgd.min.js"></script>
<script>
$(document).ready(function () {
    $('.grid').isotope({
        layoutMode: 'packery',
        itemSelector: '.grid-item',
        packery: { isHorizontal: true }
    });
});
//# sourceURL=pen.js
</script>
<h1>Isotope - packery isHorizontal</h1>

<div class="grid">
  <div class="grid-item grid-item--height2"></div>
  <div class="grid-item grid-item--width2"></div>
  <div class="grid-item"></div>
  <div class="grid-item"></div>
  <div class="grid-item grid-item--width2 grid-item--height2"></div>
  <div class="grid-item grid-item--width2"></div>
  <div class="grid-item grid-item--width2"></div>
  <div class="grid-item grid-item--height2"></div>
  <div class="grid-item"></div>
  <div class="grid-item grid-item--width2"></div>
  <div class="grid-item grid-item--height2"></div>
  <div class="grid-item"></div>
  <div class="grid-item"></div>
</div>


</body></html>