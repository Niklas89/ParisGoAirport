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
        <title>Paris Airport Transfers - Paris Destinations</title>

        <meta name="description" content="Paris Airport Transfers. Private and Shared shuttles: free reservation - pay the driver directly.">
        <meta name="keywords" content="paris airport transfer,paris airport shuttle,paris cdg shuttle,paris orly shuttle,paris beauvais shuttle">
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

                <h2>Destinations in Paris</h2>
                <p class="main-description">Choose your destination</p>

                <?php if(isset($ok)){ echo '<h3 id="ok">'.$ok.'</h3>';} 
            elseif(isset($erreurid)){ ?>
            
              <?php echo '<h3 id="erreurid">'.$erreurid.'</h3>'; } ?>

                  <div class="tourscat">
                    <a href="../reservationway-other.php?location=<?php echo urlencode('Eiffel Tower'); ?>" title="Eiffel Tower"><img src="eiffeltower160.jpg" alt="Eiffel Tower" /></a>
                    <p><a href="../reservationway-other.php?location=<?php echo urlencode('Eiffel Tower'); ?>" title="Eiffel Tower">Eiffel Tower</a></p>
                  </div>


                  <div class="tourscat">
                    <a href="../reservationway-other.php?location=<?php echo urlencode('Montmartre'); ?>" title="Montmartre"><img src="montmartre160.jpg" alt="Montmartre" /></a>
                    <p><a href="../reservationway-other.php?location=<?php echo urlencode('Montmartre'); ?>" title="Montmartre">Montmartre</a></p>
                  </div>

                  <div class="tourscat">
                    <a href="../reservationway-other.php?location=<?php echo urlencode('Notre-Dame'); ?>" title="Notre-Dame"><img src="notredame160.jpg" alt="Notre-Dame" /></a>
                    <p><a href="../reservationway-other.php?location=<?php echo urlencode('Notre-Dame'); ?>" title="Notre-Dame">Notre-Dame</a></p>
                  </div>


                  <div class="tourscat">
                    <a href="../reservationway-other.php?location=<?php echo urlencode('Louvre'); ?>" title="Le Louvre"><img src="louvre160.jpg" alt="Le Louvre" /></a>
                    <p><a href="../reservationway-other.php?location=<?php echo urlencode('Louvre'); ?>" title="Le Louvre">Le Louvre</a></p>
                  </div>

                  <div class="tourscat">
                    <a href="../reservationway-other.php?location=<?php echo urlencode('Beaubourg'); ?>" title="Beaubourg"><img src="beaubourg160.jpg" alt="Beaubourg" /></a>
                    <p><a href="../reservationway-other.php?location=<?php echo urlencode('Beaubourg'); ?>" title="Beaubourg">Beaubourg, Pompidou</a></p>
                  </div>

                  <div class="tourscat">
                    <a href="../reservationway-other.php?location=<?php echo urlencode('Grand Palais'); ?>" title="Grand Palais"><img src="grandpalais160.jpg" alt="Grand Palais" /></a>
                    <p><a href="../reservationway-other.php?location=<?php echo urlencode('Grand Palais'); ?>" title="Grand Palais">Grand Palais</a></p>
                  </div>

                  <div class="tourscat">
                    <a href="../reservationway-other.php?location=<?php echo urlencode('Arc de Triomphe'); ?>" title="Arc de Triomphe"><img src="arctriomphe160.jpg" alt="Arc de Triomphe" /></a>
                    <p><a href="../reservationway-other.php?location=<?php echo urlencode('Arc de Triomphe'); ?>" title="Arc de Triomphe">Arc de Triomphe</a></p>
                  </div>

                </div>

            </div> <!-- #main -->
        </div> <!-- #main-container -->

        <div class="footer-container">
            <footer class="wrapper">
              <div class="paddingdiv">
                <div class="contacticon"><a href="../../contact.php" title="Contact us" class="contactlink">Contact</a></div>
                 <div class="homeicon"><a href="../../index.php" title="Home" class="homelink">Home</a></div>
                 <a href="destinations.php" title="All destinations" class="tours">Back</a>
               </div>
            </footer>

            <?php include 'socialfooter.php'; ?>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../js/vendor/jquery-1.10.1.min.js"><\/script>')</script>

        <script src="../../js/main.js"></script>



    </body>
</html>
