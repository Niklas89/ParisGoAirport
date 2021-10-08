         <?php    if(isset($_POST['submit']))  {    

          $email = $_POST['email'];

          require_once('../PHPMailer_5.2.4/class.phpmailer.php');
            //include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

            $mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

            $mail->IsSMTP(); // telling the class to use SMTP

            try {
              $mailmessage = file_get_contents('nonamemail-template-fr.html');
              $mail->Host       = "ssl://in.mailjet.com"; // SMTP server
              $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
              $mail->SMTPAuth   = true;                  // enable SMTP authentication
              $mail->Host       = "ssl://in.mailjet.com"; // sets the SMTP server
              $mail->Port       = 443;                    // set the SMTP port for the GMAIL server
              $mail->Username   = "qsdqd"; // SMTP account username
              $mail->Password   = "qsdqdqd";        // SMTP account password
              $mail->AddAddress($email);
              $mail->SetFrom('contact@parisgoairport.com');
              $mail->AddReplyTo('contact@parisgoairport.com', 'ParisGoAirport');
              $mail->Subject = 'Paris-airport shuttles';
              // $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
              $mail->MsgHTML($mailmessage);
              $mail->CharSet="UTF-8";

              // $mail->AddAttachment('images/phpmailer.gif');      // attachment
              // $mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
              $mail->Send();
              
            } catch (phpmailerException $e) {
              echo $e->errorMessage(); //Pretty error messages from PHPMailer
            } catch (Exception $e) {
              echo $e->getMessage(); //Boring error messages from anything else!
            } 

            $ok = "Email sent to ".$email;

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
        <title>Mail auto</title>

        <meta name="description" content="ParisGoAirport provides not only Paris airport taxi services, but also Paris sightseeing tours, whether day city tours or night tours." />
        <meta name="keywords" content="private Paris tours, Paris airport taxi, Paris sightseeing tours, Paris city tours, Paris by night tours" />
        <meta name="author" content="Niklas Edelstam">
        <meta name="robots" content="noindex,nofollow" />
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

                <h2>Mail auto en francais</h2>
                <p class="main-description">auto mail</p>

                <?php if(isset($ok)){ echo '<h3 id="ok">'.$ok.'</h3>';} 
            elseif(isset($erreurid)){ ?>
            
              <?php echo '<h3 id="erreurid">'.$erreurid.'</h3>'; } ?>
              <form class="login-form" id="SignupForm" action="nonamemail-fr.php" method="post">

                <p><a href="index.php" title="back">Back</a></p>


                 <input name="email" type="text" class="input email" value="Email" onFocus="this.value='';" onBlur="if(this.value==''){this.value='Email';}" />
                                 
                                     





               
                </div>

            </div> <!-- #main -->
        </div> <!-- #main-container -->

        <div class="footer-container">
            <footer class="wrapper">
              <div class="paddingdiv">
                <input type="submit" id="SaveAccount" name="submit" value="Send" class="button" />
                <div class="contacticon"><a href="../contact.php" title="Contact us" class="contactlink">Contact</a></div>
                <div class="homeicon"><a href="../index.php" title="Home" class="homelink">Home</a></div>
                <div class="toursicon"><a href="../tours.php" title="Sightseeing Tours" class="tourslink">Sightseeing</a></div>
              </div>
            </footer>

            <div id="copyright"><p>© 2013 ParisGoAirport - <a href="../terms.php" title="Terms and Conditions">Terms</a></p></div>
        </div>
</form>


        <script src="../js/main.js"></script>



    </body>
</html>
