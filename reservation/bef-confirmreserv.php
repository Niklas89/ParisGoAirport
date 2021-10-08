<?php


  include '../config.php';


 // require_once('recaptchalib.php'); this is captcha
  ///$privatekey = "-1t5sbL4gleF";
  //$resp = recaptcha_check_answer ($privatekey,
  //                              $_SERVER["REMOTE_ADDR"],
   //                             $_POST["recaptcha_challenge_field"],
  //                              $_POST["recaptcha_response_field"]);

  //if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly

   // header('Location: reservation.php?recaptcha=false');

    // die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
        // "(reCAPTCHA said: " . $resp->error . ")");
 // } else {
    // Your code here to handle a successful verification

$varget = $_POST['airport'];
$way = $_POST['way'];


if(isset($_POST['submit']))  {

  if($way == 'One-Way') {
        if(!empty($_POST['firstname']) && ($_POST['firstname'] != "Firstname") && !empty($_POST['lastname']) && ($_POST['lastname'] != "Lastname") && !empty($_POST['arrivaldate'])
         && ($_POST['arrivaldate'] != "Arrival/Departing Date")  && !empty($_POST['arrivaltime']) && ($_POST['arrivaltime'] != "Arrival/Departing Time")   
          && !empty($_POST['flightnumb']) && ($_POST['flightnumb'] != "Flight Number")   && !empty($_POST['airport']) && ($_POST['airport'] != "Airport")
             && !empty($_POST['parisaddress']) && ($_POST['parisaddress'] != "Paris Address") && !empty($_POST['terminal']) && ($_POST['terminal'] != "Airport Terminal")
               && !empty($_POST['email']) && ($_POST['email'] != "Email")  && !empty($_POST['phone']) && ($_POST['phone'] != "Phone with country code")
            && ($_POST['tfairport'] != "To or From airport ?")  && ($_POST['shuservice'] != "Shuttle Service") && ($_POST['nbadults'] != "Adults (over 3 years old)")
              && ($_POST['nbchildren'] != "Children (under 3 years old)") && preg_match('#^[a-z0-9.!\#$%&\'*+-/=?^_`{|}~]+@([0-9.]+|([^\s]+\.+[a-z]{2,6}))$#si', $_POST['email']) && !empty($_POST['num1'])
               && !empty($_POST['num2']) && !empty($_POST['captcha']) && ($_POST['captcha'] != "Human ?")) {
                extract($_POST);
                $num1 = $_POST['num1'];
                $num2 = $_POST['num2'];
                $total = $_POST['captcha'];
                if( intval($num1) + intval($num2) == intval($total) ) {
                          $valid = true;
                  }
                  else {
                          $valid = false;
          
                          header('Location: one-way-reservation.php?varget='.urlencode($varget).'&way='.urlencode($way).'&captcha=false');
                  }
          
          } else {
           $valid = false;
          
           header('Location: one-way-reservation.php?varget='.urlencode($varget).'&way='.urlencode($way).'&notvalid=false');

          }
    }

    if($way == 'Round-Trip') {
        if(!empty($_POST['firstname']) && ($_POST['firstname'] != "Firstname") && !empty($_POST['lastname']) && ($_POST['lastname'] != "Lastname") && !empty($_POST['arrivaldate'])
         && ($_POST['arrivaldate'] != "Arrival/Departing Date")  && !empty($_POST['arrivaltime']) && ($_POST['arrivaltime'] != "Arrival/Departing Time") 
           && ($_POST['returningdate'] != "Returning Date")  && !empty($_POST['returningtime']) && ($_POST['returningtime'] != "Returning Time")    
          && !empty($_POST['flightnumb']) && ($_POST['flightnumb'] != "Flight Number")   && !empty($_POST['airport']) && ($_POST['airport'] != "Airport")
             && !empty($_POST['parisaddress']) && ($_POST['parisaddress'] != "Paris Address") && !empty($_POST['terminal']) && ($_POST['terminal'] != "Airport Terminal")
               && !empty($_POST['email']) && ($_POST['email'] != "Email")  && !empty($_POST['phone']) && ($_POST['phone'] != "Phone with country code")
            && ($_POST['tfairport'] != "To or From airport ?")  && ($_POST['shuservice'] != "Shuttle Service") && ($_POST['nbadults'] != "Adults (over 3 years old)")
              && ($_POST['nbchildren'] != "Children (under 3 years old)") && preg_match('#^[a-z0-9.!\#$%&\'*+-/=?^_`{|}~]+@([0-9.]+|([^\s]+\.+[a-z]{2,6}))$#si', $_POST['email']) && !empty($_POST['num1'])
               && !empty($_POST['num2']) && !empty($_POST['captcha']) && ($_POST['captcha'] != "Human ?")) {
                extract($_POST);
                $num1 = $_POST['num1'];
                $num2 = $_POST['num2'];
                $total = $_POST['captcha'];
                if( intval($num1) + intval($num2) == intval($total) ) {
                          $valid = true;
                  }
                  else {
                          $valid = false;
          
                          header('Location: round-trip-reservation.php?varget='.urlencode($varget).'&way='.urlencode($way).'&captcha=false');
                  }
          
          } else {
           $valid = false;
          
           header('Location: round-trip-reservation.php?varget='.urlencode($varget).'&way='.urlencode($way).'&notvalid=false');

          }
    }
  
  if($valid)
  {
   // header("confirmreserv.php");

  

    date_default_timezone_set('Europe/Madrid');
    $coldate = date('Y-m-d H:i:s');
    
      $firstname = stripslashes(htmlspecialchars($_POST['firstname']));
      $lastname = stripslashes(htmlspecialchars($_POST['lastname']));
      $arrivaldate = date('Y-m-d', strtotime($_POST['arrivaldate'])); 
      $arrivaltime = $_POST['arrivaltime'];
      $flightnumb = stripslashes(htmlspecialchars($_POST['flightnumb']));
      $airport = stripslashes(htmlspecialchars($_POST['airport']));
      $terminal = stripslashes(htmlspecialchars($_POST['terminal']));
      $email = stripslashes(htmlspecialchars($_POST['email']));
      $phone = stripslashes(htmlspecialchars($_POST['phone']));
      $parisaddress = stripslashes(htmlspecialchars($_POST['parisaddress']));
      $tfairport = $_POST['tfairport'];
      $shuservice = $_POST['shuservice'];
      $nbadults = $_POST['nbadults'];
      $nbchildren = $_POST['nbchildren'];

      if($way == 'Round-Trip') {
        $returningdate = date('Y-m-d', strtotime($_POST['returningdate'])); 
        $returningtime = $_POST['returningtime'];
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
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <div class="header-container">
            <header class="wrapper clearfix">
                <h1 class="title"><a href="../index.php" title="ParisGOairport"><span class="airport">PARIS</span><span class="go">GO</span><span class="airport">AIRPORT</span></a></h1>
               <!-- <nav>
                    <ul>
                        <li><a href="#">nav ul li a</a></li>
                        <li><a href="#">nav ul li a</a></li>
                        <li><a href="#">nav ul li a</a></li>
                    </ul>
                </nav> -->
            </header>
        </div> 

        <div class="main-container">
            <div class="main wrapper clearfix">
              <div class="paddingdiv">

                <h2>Confirm your Reservation</h2>
                <p class="main-description">Confirm that the details below are correct. <a href="shuttle-prices.php" title="Prices" target="_blank">Shuttle prices</a></p>

                        <?php if(isset($ok)){ echo '<p id="ok">'.$ok.'</p>';} 
                    elseif(isset($erreurid)){ ?>
                    
                      <?php echo '<p id="erreurid">'.$erreurid.'</p>'; } ?>


            

                        <h3 class="title-prices-second"><?php echo $way; ?> <?php echo $tfairport; ?> <?php echo $airport; ?> <?php echo $terminal; ?></h3>
                    <table>
                       <tr>
                           <th>Flight Number</th>
                           <td><?php echo $flightnumb; ?></td>
                       </tr>
                       <tr>
                           <th>Flight arrival date / departing date from Paris</th>
                           <td><?php echo $arrivaldate; ?></td>
                       </tr>
                       <tr>
                           <th>Flight arrival time / departing time from Paris</th>
                           <td><?php echo $arrivaltime; ?></td>
                       </tr><?php if($way == 'Round-Trip') { ?>
                       <tr>
                           <th>Returning Date</th>
                           <td><?php echo $returningdate; ?></td>
                       </tr>
                       <tr>
                           <th>Returning Time</th>
                           <td><?php echo $returningtime; ?></td>
                       </tr><?php   } ?>
                       <tr>
                           <th>Firstname</th>
                           <td><?php echo $firstname; ?></td>
                       </tr>
                       <tr>
                           <th>Lastname</th>
                           <td><?php echo $lastname; ?></td>
                       </tr>
                       <tr>
                           <th>Address in Paris</th>
                           <td><?php echo $parisaddress; ?></td>
                       </tr>
                       <tr>
                           <th>Email</th>
                           <td><?php echo $email; ?></td>
                       </tr>
                       <tr>
                           <th>Phone</th>
                           <td><?php echo $phone; ?></td>
                       </tr>
                       <tr>
                           <th>Shuttle Service</th>
                           <td><?php echo $shuservice; ?></td>
                       </tr>
                       <tr>
                           <th>Persons</th>
                           <td><?php echo $nbadults; ?></td>
                       </tr>
                       <tr>
                           <th>Baby Seats (no fee)</th>
                           <td><?php echo $nbchildren; ?></td>
                       </tr>
                       




                    <tr class="total-price-confirmation">
                           <th>Total Price</th>
                           <td>
                    <?php

                    if ($way == "One-Way") {
                     
                         if($shuservice == "Shared") {

                            if($tfairport == "From") {

                                if($nbadults == "1"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee="40"; echo "40";}
                                  else{ $shuttlefee="50"; echo "50";}
                                }
                              if($nbadults == "2"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee="50"; echo "50";}
                                  else{ $shuttlefee="60"; echo "60";}
                                }
                              if($nbadults == "3"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee="60"; echo "60";}
                                  else{ $shuttlefee="70"; echo "70";}
                                }
                              if($nbadults == "4"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee="72"; echo "72";}
                                  else { $shuttlefee="82"; echo "82";}
                                }
                              if($nbadults == "5"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee="85"; echo "85";}
                                  else{ $shuttlefee="95"; echo "95";}
                                }
                              if($nbadults == "6"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee="96"; echo "96";}
                                  else{ $shuttlefee="106"; echo "106";}
                                }
                              if($nbadults == "7"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee="105"; echo "105";}
                                  else{ $shuttlefee="115"; echo "115";}
                                }
                              if($nbadults == "8"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee="112"; echo "112";}
                                  else{ $shuttlefee="122"; echo "122";}
                                }

                            } // end From

                            if($tfairport == "To") {

                              if($nbadults == "1"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee="35"; echo "35";}
                                  else{ $shuttlefee="45"; echo "45";}
                                }
                              if($nbadults == "2"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee="40"; echo "40";}
                                  else{ $shuttlefee="50"; echo "50";}
                                }
                              if($nbadults == "3"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee="57"; echo "57";}
                                  else{ $shuttlefee="67"; echo "67";}
                                }
                              if($nbadults == "4"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee="68"; echo "68";}
                                  else { $shuttlefee="78"; echo "78";}
                                }
                              if($nbadults == "5"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee="85"; echo "85";}
                                  else{ $shuttlefee="95"; echo "95";}
                                }
                              if($nbadults == "6"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee="96"; echo "96";}
                                  else{ $shuttlefee="106"; echo "106";}
                                }
                              if($nbadults == "7"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee="98"; echo "98";}
                                  else{ $shuttlefee="108"; echo "108";}
                                }
                              if($nbadults == "8"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee="100"; echo "100";}
                                  else{ $shuttlefee="110"; echo "110";}
                                }

                            } // end To

                          } // end Shared


                        if($shuservice == "Private") {

                          if($nbadults == "1"){
                             $shuttlefee="75"; echo "75";
                          }
                        if($nbadults == "2"){
                            $shuttlefee="75"; echo "75";
                          }
                        if($nbadults == "3"){
                            $shuttlefee="95"; echo "95";
                          }
                        if($nbadults == "4"){
                            $shuttlefee="95"; echo "95";
                          }
                        if($nbadults == "5"){
                            $shuttlefee="130"; echo "130";
                          }
                        if($nbadults == "6"){
                            $shuttlefee="130"; echo "130";
                          }
                        if($nbadults == "7"){
                            $shuttlefee="150"; echo "150";
                          }
                        if($nbadults == "8"){
                            $shuttlefee="150"; echo "150";
                          }
                        } // end private
                    } // end one-way


                    // ne pas oublier aussi le faire pour le time du retour
                    // -6% = total * 0.94
                    // From Airport To Paris and return for 4 persons : ((26+22) * 4) * 0.94 
                    if ($way == "Round-Trip") {
                     
                         if($shuservice == "Shared") {

                            

                                if($nbadults == "1"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee="61.1"; echo "61.1";}
                                  else{ $shuttlefee="71.1"; echo "71.1";}
                                }
                              if($nbadults == "2"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee="90.24"; echo "90.24";}
                                  else{ $shuttlefee="100.24"; echo "100.24";}
                                }
                              if($nbadults == "3"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee="135.36"; echo "135.36";}
                                  else{ $shuttlefee="145.36"; echo "145.36";}
                                }
                              if($nbadults == "4"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee="180.48"; echo "180.48";}
                                  else { $shuttlefee="190.48"; echo "190.48";}
                                }
                              if($nbadults == "5"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee="225.6"; echo "225.6";}
                                  else{ $shuttlefee="235.6"; echo "235.6";}
                                }
                              if($nbadults == "6"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee="270.72"; echo "270.72";}
                                  else{ $shuttlefee="280.72"; echo "280.72";}
                                }
                              if($nbadults == "7"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee="315.84"; echo "315.84";}
                                  else{ $shuttlefee="325.84"; echo "325.84";}
                                }
                              if($nbadults == "8"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee="360.96"; echo "360.96";}
                                  else{ $shuttlefee="370.96"; echo "370.96";}
                                }

                            

                          } // end Shared


                        if($shuservice == "Private") {

                          if($nbadults == "1"){
                             $shuttlefee="141"; echo "141";
                          }
                        if($nbadults == "2"){
                            $shuttlefee="141"; echo "141";
                          }
                        if($nbadults == "3"){
                            $shuttlefee="178.6"; echo "178.6";
                          }
                        if($nbadults == "4"){
                            $shuttlefee="178.6"; echo "178.6";
                          }
                        if($nbadults == "5"){
                            $shuttlefee="244.4"; echo "244.4";
                          }
                        if($nbadults == "6"){
                            $shuttlefee="244.4"; echo "244.4";
                          }
                        if($nbadults == "7"){
                            $shuttlefee="282"; echo "282";
                          }
                        if($nbadults == "8"){
                            $shuttlefee="282"; echo "282";
                          }
                        } // end private
                    } // end round-trip




                     ?> €</td>
                       </tr>
                    </table>


                     <p id="nighttime-price">The fee is due to be paid directly to the driver.</p>

                     <form class="login-form" id="SignupForm" action="../tours.php" method="post">
                     <!-- <a href="shuttle-prices.php" title="Prices">Check the prices</a> -->
                    <input type="hidden" name="firstname" value="<?php echo $firstname; ?>" />
                    <input type="hidden" name="lastname" value="<?php echo $lastname; ?>" />
                    <input type="hidden" name="arrivaldate" value="<?php echo $arrivaldate; ?>" />
                    <input type="hidden" name="arrivaltime" value="<?php echo $arrivaltime; ?>" />
                    <input type="hidden" name="flightnumb" value="<?php echo $flightnumb; ?>" />
                    <input type="hidden" name="airport" value="<?php echo $airport; ?>" />
                    <input type="hidden" name="way" value="<?php echo $way; ?>" />
                    <input type="hidden" name="terminal" value="<?php echo $terminal; ?>" />
                    <input type="hidden" name="email" value="<?php echo $email; ?>" />
                    <input type="hidden" name="phone" value="<?php echo $phone; ?>" />
                    <input type="hidden" name="parisaddress" value="<?php echo $parisaddress; ?>" />
                    <input type="hidden" name="tfairport" value="<?php echo $tfairport; ?>" />
                    <input type="hidden" name="shuservice" value="<?php echo $shuservice; ?>" />
                    <input type="hidden" name="nbadults" value="<?php echo $nbadults; ?>" />
                    <input type="hidden" name="nbchildren" value="<?php echo $nbchildren; ?>" />
                    <input type="hidden" name="shuttlefee" value="<?php echo $shuttlefee; ?>" />
                    <?php if($way == 'Round-Trip') { ?>
                    <input type="hidden" name="returningdate" value="<?php echo $returningdate; ?>" />
                    <input type="hidden" name="returningtime" value="<?php echo $returningtime; ?>" />
                    <?php   } ?>

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

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../js/vendor/jquery-1.10.1.min.js"><\/script>')</script>

        <script src="../js/main.js"></script>

<?php
// hide captcha  } // end captcha
}
}

?>
    </body>
</html>
