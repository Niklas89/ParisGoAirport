<?php


  include '../config.php';

 if (isset($_GET['notvalid'])) {
if($_GET["notvalid"] == "false"){
  $erreurid = 'Please fill in all the fields correctly.';
}
}

//if($_GET["recaptcha"] == "false"){
 // $erreurid = "The reCAPTCHA wasn't entered correctly. Please try again.";
//}

 if (isset($_GET['captcha'])) {
if($_GET["captcha"] == "false"){
  $erreurid = 'Captcha value is wrong.';
}
}



  if (isset($_GET['way'])) {
    $_GET['way'] = htmlspecialchars($_GET['way']);
    $way = $_GET['way'];
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
        <title>Paris Airport Transfers</title>

        <meta name="description" content="Paris Airport Transfers. Private and Shared shuttles: free reservation - pay the driver directly.">
        <meta name="keywords" content="paris airport transfer,paris airport shuttle,paris cdg shuttle,paris orly shuttle,paris beauvais shuttle">
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
        


        <!-- RESERVATION LINKS -->
        <link rel="stylesheet" media="all" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" media="all" type="text/css" href="timedate/jquery-ui-timepicker-addon.css">
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
        <script type="text/javascript" src="timedate/jquery-ui-timepicker-addon.js"></script>
        <script type="text/javascript" src="timedate/jquery-ui-sliderAccess.js"></script>



    <script type="text/javascript" src="formtowizard/formToWizard.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#SignupForm").formToWizard({ submitButton: 'SaveAccount' })
        });
    </script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <?php include '../header.php'; ?>

        <div class="main-container">
            <div class="main wrapper clearfix">
              <div class="paddingdiv">

                <h2>CDG-Orly <?php echo $way; ?> shuttle</h2>
                <p class="main-description">Payment by Paypal / Credit card online. <a href="shuttle-prices.php" title="Prices" target="_blank">Shuttle prices</a>: generated after submission.</p>

                        <?php if(isset($ok)){ echo '<p id="ok">'.$ok.'</p>';} 
                    elseif(isset($erreurid)){ ?>
                    
                      <?php echo '<p id="erreurid">'.$erreurid.'</p>'; } ?>

               <form class="login-form" id="SignupForm" action="confirmreserv-airp.php" method="post">

                            <fieldset>
                      <p class="fieldsetpage">Step 1/4</p>



                                    <div class="wrappper">
                                          <div class="styled-select">
                                              <span class="arrow"></span>
                                              <select name="tfairport">
                                                <option value="To CDG from Orly" >To CDG from Orly</option>
                                                <option value="From CDG to Orly">From CDG to Orly</option>
                                              </select>
                                        </div>
                                    </div> 
                                      

                                      <div class="wrappper">
                                          <div class="styled-select">
                                              <span class="arrow"></span>
                                              <select name="nbadults">
                                        <option value="Adults (over 3 years old)">Persons (over 3 years old)</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                              </select>
                                        </div>
                                    </div>


                                    
                                <input name="firstname" type="text" class="input firstname" value="Firstname" onFocus="this.value='';" onBlur="if(this.value==''){this.value='Firstname';}" />
                          <input name="lastname" type="text" class="input lastname" value="Lastname" onFocus="this.value='';" onBlur="if(this.value==''){this.value='Lastname';}" />


                        </fieldset>
                          

                        <fieldset>
                          
                          <p class="fieldsetpage">Step 2/4</p>
                          <input type="text" name="arrivaldate" class="input date" id="datepicker.[1]" value="Arrival/Departing Date" onFocus="this.value='';" onBlur="if(this.value==''){this.value='Arrival/Departing Date';}" />
                        <script type="text/javascript">
                           $(function() {
                          $( "#datepicker\\.\\[1\\]" ).datepicker();
                        });
                        </script>
                     
                        <input type="text" class="input time" name="arrivaltime" id="timepicker.[1]" value="Arrival/Departing Time" onFocus="this.value='';" onBlur="if(this.value==''){this.value='Arrival/Departing Time';}" />
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $('#timepicker\\.\\[1\\]').timepicker( {
                                    showAnim: 'blind'
                                } );
                            });
                        </script>

                        <input type="text" name="returningdate" class="input date" id="datepicker.[2]" value="Returning Date" onFocus="this.value='';" onBlur="if(this.value==''){this.value='Returning Date';}" />
                        <script type="text/javascript">
                           $(function() {
                          $( "#datepicker\\.\\[2\\]" ).datepicker();
                        });
                        </script>
                     
                        <input type="text" class="input time" name="returningtime" id="timepicker.[2]" value="Returning Time" onFocus="this.value='';" onBlur="if(this.value==''){this.value='Returning Time';}" />
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $('#timepicker\\.\\[2\\]').timepicker( {
                                    showAnim: 'blind'
                                } );
                            });
                        </script>
                      
                        

                        </fieldset>


                         <fieldset>
                          <p class="fieldsetpage">Step 3/4</p>
                          <input name="flightnumb" type="text" id="flight" class="input flight" value="Flight Number" onFocus="this.value='';" onBlur="if(this.value==''){this.value='Flight Number';}" />
                                <input name="terminal" type="text" id="terminal" class="input terminal" value="Airport Terminal" onFocus="this.value='';" onBlur="if(this.value==''){this.value='Airport Terminal';}" /> 

                                 <input name="reflightnumb" type="text" id="flight" class="input flight" value="Returning Flight Number" onFocus="this.value='';" onBlur="if(this.value==''){this.value='Returning Flight Number';}" />
                                <input name="reterminal" type="text" id="terminal" class="input terminal" value="Returning Terminal" onFocus="this.value='';" onBlur="if(this.value==''){this.value='Returning Terminal';}" /> 
                     <input name="way" type="hidden" value="<?php echo $way; ?>" />


                         </fieldset>
                         <fieldset>
                          <p class="fieldsetpage">Step 4/4</p>
                          <input name="email" type="text" class="input email" value="Email" onFocus="this.value='';" onBlur="if(this.value==''){this.value='Email';}" />
                     <input name="phone" type="text" class="input phone" value="Phone with country code" onFocus="this.value='';" onBlur="if(this.value==''){this.value='Phone with country code';}" /><br />


                       <?php
                          //require_once('recaptchalib.php');  this is captcha
                          //$publickey = "6Ldn9eYSAAAAANloYJUqbg2QWu4B-Efp5JVd7iob"; // you got this from the signup page
                          //echo recaptcha_get_html($publickey);
                        ?>

                        <input id="num1" class="inputnumb sum" type="text" name="num1" value="<?php echo rand(1,4) ?>" readonly="readonly" /> <span class="captchacalc">+</span>
                <input id="num2" class="inputnumb sum" type="text" name="num2" value="<?php echo rand(5,9) ?>" readonly="readonly" /> <span class="captchacalc">=</span>
                <input id="captcha" class="inputnumbtotal captcha" type="text" name="captcha" maxlength="2" value="Human ?" onFocus="this.value='';" onBlur="if(this.value==''){this.value='Human ?';}" />
                

        </fieldset>

              </div>
            </div> <!-- #main -->
        </div> <!-- #main-container -->

        <div class="footer-container">
            <footer class="wrapper">
              <div class="paddingdiv">
                <input type="submit" id="SaveAccount" name="submit" value="Submit" class="button" />
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
