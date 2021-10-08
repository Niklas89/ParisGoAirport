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
        <title>ParisGoAirport - 火车站</title>

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

                <h2>火车站</h2>
                <p class="main-description">请选择您的目的地</p>

                <?php if(isset($ok)){ echo '<h3 id="ok">'.$ok.'</h3>';} 
            elseif(isset($erreurid)){ ?>
            
              <?php echo '<h3 id="erreurid">'.$erreurid.'</h3>'; } ?>

                  <div class="tourscat">
                    <a href="../reservationway-other.php?location=<?php echo urlencode('Gare de lEst'); ?>" title="Gare de l'Est"><img src="gareest160.jpg" alt="Gare de l'Est" /></a>
                    <p><a href="../reservationway-other.php?location=<?php echo urlencode('Gare de lEst'); ?>" title="Gare de l'Est">Gare de l'Est</a></p>
                  </div>


                  <div class="tourscat">
                    <a href="../reservationway-other.php?location=<?php echo urlencode('Gare dAusterlitz'); ?>" title="Gare d\'Austerlitz"><img src="gareausterlitz160.jpg" alt="Gare d\'Austerlitz" /></a>
                    <p><a href="../reservationway-other.php?location=<?php echo urlencode('Gare dAusterlitz'); ?>" title="Gare d\'Austerlitz">Gare d'Austerlitz</a></p>
                  </div>

                  <div class="tourscat">
                    <a href="../reservationway-other.php?location=<?php echo urlencode('Gare Saint-Lazare'); ?>" title="Gare Saint-Lazare"><img src="garesaintlazare160.jpg" alt="Gare Saint-Lazare" /></a>
                    <p><a href="../reservationway-other.php?location=<?php echo urlencode('Gare Saint-Lazare'); ?>" title="Gare Saint-Lazare">Gare Saint-Lazare</a></p>
                  </div>


                  <div class="tourscat">
                    <a href="../reservationway-other.php?location=<?php echo urlencode('Gare du Nord'); ?>" title="Gare du Nord"><img src="garenord160.jpg" alt="Gare du Nord" /></a>
                    <p><a href="../reservationway-other.php?location=<?php echo urlencode('Gare du Nord'); ?>" title="Gare du Nord">Gare du Nord</a></p>
                  </div>

                  <div class="tourscat">
                    <a href="../reservationway-other.php?location=<?php echo urlencode('Gare Montparnasse'); ?>" title="Gare Montparnasse"><img src="garemontparnasse160.jpg" alt="Gare Montparnasse" /></a>
                    <p><a href="../reservationway-other.php?location=<?php echo urlencode('Gare Montparnasse'); ?>" title="Gare Montparnasse">Gare Montparnasse</a></p>
                  </div>

                  <div class="tourscat">
                    <a href="../reservationway-other.php?location=<?php echo urlencode('Gare de Lyon'); ?>" title="Gare de Lyon"><img src="garelyon160.jpg" alt="Gare de Lyon" /></a>
                    <p><a href="../reservationway-other.php?location=<?php echo urlencode('Gare de Lyon'); ?>" title="Gare de Lyon">Gare de Lyon</a></p>
                  </div>

                  <div class="tourscat">
                    <a href="../reservationway-other.php?location=<?php echo urlencode('Gare de Bercy'); ?>" title="Gare de Bercy"><img src="garebercy160.jpg" alt="Gare de Bercy" /></a>
                    <p><a href="../reservationway-other.php?location=<?php echo urlencode('Gare de Bercy'); ?>" title="Gare de Bercy">Gare de Bercy</a></p>
                  </div>

                </div>

            </div> <!-- #main -->
        </div> <!-- #main-container -->

        <div class="footer-container">
            <footer class="wrapper">
              <div class="paddingdiv">
                <div class="contacticon"><a href="../../contact.php" title="联系我们" class="contactlink">联系我们</a></div>
                 <div class="homeicon"><a href="../../index.php" title="主页" class="homelink">主页</a></div>
                 <a href="destinations.php" title="中转至其他目的地" class="tours">返回</a>
               </div>
            </footer>

            <?php include 'socialfooter.php'; ?>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../js/vendor/jquery-1.10.1.min.js"><\/script>')</script>

        <script src="../../js/main.js"></script>



    </body>
</html>
