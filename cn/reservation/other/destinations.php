<?php


  include '../../config.php';


?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>ParisGoAirport - 前往其他目的地</title>

        <meta name="description" content="观光旅游: 巴黎市区观光, 巴黎之夜, 巴黎迪斯尼乐园, 凡尔赛皇宫, 吉维尼小镇, 枫丹白露小镇, 巴比桑镇, 其他省份">
        <meta name="keywords" content="观光旅游,巴黎市区观光,巴黎之夜,巴黎迪斯尼乐园,凡尔赛皇宫,吉维尼小镇,枫丹白露小镇,巴比桑镇,其他省份,前往其他目的地">
        <meta name="author" content="Niklas Edelstam">
        <meta name="robots" content="index,follow" />
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="../../css/normalize.min.css">
        <link rel="stylesheet" href="../../css/main.css">
        
        <link rel="icon" type="image/png" href="../../img/icons/favicon.png" />
        <!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="img/icons/favicon.ico" /><![endif]-->
        <link rel="apple-touch-icon" href="../../img/icons/apple-touch-icon-57x57.png" /> 
        <link rel="apple-touch-icon" sizes="72x72" href="../../img/icons/apple-touch-icon-72x72" /> 
        <link rel="apple-touch-icon" sizes="114x114" href="../../img/icons/apple-touch-icon-114x114.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="../../img/icons/apple-touch-icon-144x144.png" />

        <script src="../../js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <?php include '../../header.php'; ?>

        <div class="main-container">
            <div class="main wrapper clearfix">
              <div class="paddingdiv">

                <h2>前往其他目的地</h2>
                <p class="main-description">请选择您的目的地</p>

                <?php if(isset($ok)){ echo '<h3 id="ok">'.$ok.'</h3>';} 
            elseif(isset($erreurid)){ ?>
            
              <?php echo '<h3 id="erreurid">'.$erreurid.'</h3>'; } ?>

                  <div class="tourscat">
                    <a href="paris.php" title="巴黎"><img src="../../img/paristours160.jpg" alt="巴黎" /></a>
                    <p><a href="paris.php" title="巴黎">巴黎</a></p>
                  </div>


                  <div class="tourscat">
                    <a href="../reservationway-other.php?location=<?php echo urlencode('Versailles'); ?>" title="Versailles"><img src="../../img/versaille160.jpg" alt="Versailles" /></a>
                    <p><a href="../reservationway-other.php?location=<?php echo urlencode('Versailles'); ?>" title="Versailles">凡尔赛皇宫</a></p>
                  </div>

                  <div class="tourscat">
                    <a href="../reservationway-other.php?location=<?php echo urlencode('Giverny'); ?>" title="Giverny"><img src="../../img/giverny160.jpg" alt="Giverny" /></a>
                    <p><a href="../reservationway-other.php?location=<?php echo urlencode('Giverny'); ?>" title="Giverny">吉维尼小镇</a></p>
                  </div>


                  <div class="tourscat">
                    <a href="../reservationway-other.php?location=<?php echo urlencode('Fontainebleau'); ?>" title="Fontainebleau"><img src="../../img/fontainebleau160.jpg" alt="Fontainebleau" /></a>
                    <p><a href="../reservationway-other.php?location=<?php echo urlencode('Fontainebleau'); ?>" title="Fontainebleau">枫丹白露小镇/巴比桑镇</a></p>
                  </div>

                  <div class="tourscat">
                    <a href="../reservationway-other.php?location=<?php echo urlencode('Parc des Expositions'); ?>" title="Parc des Expositions"><img src="parcexpos160.jpg" alt="Parc des Expositions" /></a>
                    <p><a href="../reservationway-other.php?location=<?php echo urlencode('Parc des Expositions'); ?>" title="Parc des Expositions">博览会公园</a></p>
                  </div>

                  <div class="tourscat">
                    <a href="trainstations.php" title="火车站"><img src="trainstations160.jpg" alt="火车站" /></a>
                    <p><a href="trainstations.php" title="火车站">火车站</a></p>
                  </div>

                </div>

            </div> <!-- #main -->
        </div> <!-- #main-container -->

        <div class="footer-container">
            <footer class="wrapper">
              <div class="paddingdiv">
                <div class="contacticon"><a href="../../contact.php" title="联系我们" class="contactlink">联系我们</a></div>
                 <div class="homeicon"><a href="../../index.php" title="主页" class="homelink">主页</a></div>
               </div>
            </footer>

            <?php include 'socialfooter.php'; ?>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../js/vendor/jquery-1.10.1.min.js"><\/script>')</script>

        <script src="../../js/main.js"></script>



    </body>
</html>
