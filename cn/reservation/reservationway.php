<?php


  include '../config.php';




  if (isset($_GET['varget'])) {
    $_GET['varget'] = htmlspecialchars($_GET['varget']);
    $varget = $_GET['varget'];
} else {
  $varget = '飞机场';
}


?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>ParisGoAirport - 机场接机预订</title>

        <meta name="description" content="巴黎接机. 拼车接机-包车接机: 网上免费预订 - 到场付款">
        <meta name="keywords" content="巴黎接机,拼车接机,包车接机,奥利机场,戴高乐机场,博韦机场,迪斯尼乐园—巴黎/机场">
        <meta name="author" content="Niklas Edelstam">
        <meta name="robots" content="index,follow" />
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="../css/normalize.min.css">
        <link rel="stylesheet" href="../css/main.css">
        
        <link rel="icon" type="image/png" href="../img/icons/favicon.png" />
        <!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="img/icons/favicon.ico" /><![endif]-->
        <link rel="apple-touch-icon" href="../img/icons/apple-touch-icon-57x57.png" /> 
        <link rel="apple-touch-icon" sizes="72x72" href="../img/icons/apple-touch-icon-72x72" /> 
        <link rel="apple-touch-icon" sizes="114x114" href="../img/icons/apple-touch-icon-114x114.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="../img/icons/apple-touch-icon-144x144.png" />

        <script src="../js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <?php include '../header.php'; ?>

        <div class="main-container">
            <div class="main wrapper clearfix">
                <div class="paddingdiv">

                

                        <?php if(isset($ok)){ echo '<p id="ok">'.$ok.'</p>';} 
                    elseif(isset($erreurid)){ ?>
                    
                      <?php echo '<p id="erreurid">'.$erreurid.'</p>'; } ?>

                <div class="choose-airport">
                <h2><?php echo $varget; ?>接机预订</h2>
                 <a href="one-way-reservation.php?varget=<?php echo urlencode($varget); ?>&amp;way=<?php echo urlencode('单程'); ?>" title="单程"><img src="../img/one-way.png" alt="单程" class="buttons-airport" width="160" /></a>
         <a href="round-trip-reservation.php?varget=<?php echo urlencode($varget); ?>&amp;way=<?php echo urlencode('往返'); ?>" title="往返"><img src="../img/round-trip.png" alt="往返" class="buttons-airport" width="160" /></a><br />

                 <p class="main-description">单程 还是 往返</p>
                </div>

            </div>
            </div> <!-- #main -->
        </div> <!-- #main-container -->

        <div class="footer-container">
            <footer class="wrapper">
                <div class="paddingdiv">
                <div class="contacticon"><a href="../contact.php" title="联系我们" class="contactlink">联系我们</a></div>
                <div class="homeicon"><a href="../index.php" title="主页" class="homelink">主页</a></div>
                <div class="toursicon"><a href="../tours.php" title="巴黎观光 Tours" class="tourslink">巴黎观光</a></div>
            </div>
            </footer>

            <div id="copyright"><p>© 2013 ParisGoAirport - <a href="../terms.php" title="相关条款">相关条款</a></p></div>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../js/vendor/jquery-1.10.1.min.js"><\/script>')</script>

        <script src="../js/main.js"></script>


    </body>
</html>
