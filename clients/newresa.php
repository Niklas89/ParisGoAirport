<?php


  include '../config.php';

if(isset($_POST['submit']))  {
  if(!empty($_POST['name']) && !empty($_POST['shuttlefee']) && !empty($_POST['arrivaldate'])  && !empty($_POST['arrivaltime'])   && !empty($_POST['phone'])
      ) {
    extract($_POST);
    $valid = true;
    } else {
     $valid = false;
    $erreurid = 'Please fill in all the fields.';
    }
  
  
    if($valid)
    {


      

          date_default_timezone_set('Europe/Madrid');
      $coldate = date('Y-m-d H:i:s');
        

        $name = $_POST['name'];
        $arrivaldate = date('Y-m-d', strtotime($_POST['arrivaldate']));
        $arrivaltime = $_POST['arrivaltime'];
        $flightnumb = $_POST['flightnumb'];
        $airport = $_POST['airport'];
        $terminal = $_POST['terminal'];
        $phone = $_POST['phone'];
        $parisaddress = $_POST['parisaddress'];
        $tfairport = $_POST['tfairport'];
        $nbadults = $_POST['nbadults'];
        $shuttlefee = $_POST['shuttlefee'];
        $description = $_POST['description'];

        

    


      
      $req = $bdd->prepare('INSERT INTO resachauffeurs (coldate,name,arrivaldate,arrivaltime,flightnumb,airport,terminal,phone,tfairport,nbadults,parisaddress,shuttlefee,description) 
        VALUES (:coldate,:name,:arrivaldate,:arrivaltime,:flightnumb,:airport,:terminal,:phone,:tfairport,:nbadults,:parisaddress,:shuttlefee,:description)');
      $req->execute(array(
        'coldate'=>$coldate,
        'name'=>$name,
        'arrivaldate'=>$arrivaldate,
        'arrivaltime'=>$arrivaltime,
        'flightnumb'=>$flightnumb,
        'airport'=>$airport,
        'terminal'=>$terminal,
        'phone'=>$phone,
        'tfairport'=>$tfairport,
        'nbadults'=>$nbadults,
        'parisaddress'=>$parisaddress,
        'shuttlefee'=>$shuttlefee,
        'description'=>$description
        
      ));
      $req->closeCursor();



         $resultats=$bdd->query('SELECT * FROM chauffeurs ORDER BY id');
                              $resultats->setFetchMode(PDO::FETCH_OBJ);
                              while( $resultat = $resultats->fetch() )
                              {
                                $driveremail = $resultat->email;
                                $driverpseudo = $resultat->pseudo;


      $sth = $bdd->prepare("SELECT id FROM resachauffeurs WHERE coldate = :coldate");
        $sth->execute(array(':coldate' => $coldate));
        $result = $sth->fetch(PDO::FETCH_OBJ);
        $sth->closeCursor();
        $invoice = $result->id;

        //faire un while ci-dessous



       // $sthh = $bdd->prepare("SELECT pseudo, email FROM membres");
       // $sthh->execute(array(':id_users' => $id_users));
       // $resultt = $sthh->fetch(PDO::FETCH_OBJ);
       // $sthh->closeCursor();
       // $driveremail = $resultt->email;
       // $driverpseudo = $resultt->pseudo;

         require_once('../PHPMailer_5.2.4/class.phpmailer.php');
            //include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded


       

            $mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

            $mail->IsSMTP(); // telling the class to use SMTP

            try {
              $mailmessage = file_get_contents('new-course.html');
              $mailmessage = str_replace('%name%', $name, $mailmessage);  
            $mailmessage = str_replace('%driverpseudo%', $driverpseudo, $mailmessage); 
              $mailmessage = str_replace('%arrivaldate%', $arrivaldate, $mailmessage); 
              $mailmessage = str_replace('%arrivaltime%', $arrivaltime, $mailmessage); 
              $mailmessage = str_replace('%flightnumb%', $flightnumb, $mailmessage); 
              $mailmessage = str_replace('%airport%', $airport, $mailmessage); 
              $mailmessage = str_replace('%phone%', $phone, $mailmessage); 
              $mailmessage = str_replace('%tfairport%', $tfairport, $mailmessage); 
              $mailmessage = str_replace('%nbadults%', $nbadults, $mailmessage); 
              $mailmessage = str_replace('%parisaddress%', $parisaddress, $mailmessage); 
              $mailmessage = str_replace('%shuttlefee%', $shuttlefee, $mailmessage); 
              $mailmessage = str_replace('%terminal%', $terminal, $mailmessage); 
              $mailmessage = str_replace('%description%', $description, $mailmessage);
              $mailmessage = str_replace('%invoice%', $invoice, $mailmessage);
              $mail->Host       = "ssl://in.mailjet.com"; // SMTP server
              $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
              $mail->SMTPAuth   = true;                  // enable SMTP authentication
              $mail->Host       = "ssl://in.mailjet.com"; // sets the SMTP server
              $mail->Port       = 443;                    // set the SMTP port for the GMAIL server
              $mail->Username   = "qsdsq"; // SMTP account username
              $mail->Password   = "qsdqds";        // SMTP account password
              $mail->AddAddress($driveremail);
              $mail->SetFrom('partners@parisgoairport.com');
              $mail->AddReplyTo('partners@parisgoairport.com', 'ParisGoAirport');
              $mail->Subject = 'Nouvelle course';
              $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
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

          } //end while

         $ok = "Course envoyé !";

       } //end if valid
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

                <h2>Envoyer une course aux chauffeurs</h2>

                        <?php if(isset($ok)){ echo '<p id="ok">'.$ok.'</p>';} 
                    elseif(isset($erreurid)){ ?>
                    
                      <?php echo '<p id="erreurid">'.$erreurid.'</p>'; } ?>

               <form class="login-form" id="SignupForm" action="newresa.php" method="post">

                      <fieldset>
                            <p class="fieldsetpage">Step 1/4</p>
                                    <div class="wrappper">
                                          <div class="styled-select">
                                              <span class="arrow"></span>
                                              <select name="airport">

                                                <option value="Charles de Gaulle (CDG)">Charles de Gaulle (CDG)</option>
                                                <option value="Beauvais (BVA)">Beauvais (BVA)</option>
                                                <option value="Orly (ORY)">Orly (ORY)</option>
                                              </select>
                                        </div>
                                      </div>

                                      


                                    <div class="wrappper">
                                          <div class="styled-select">
                                              <span class="arrow"></span>
                                              <select name="tfairport">
                                                <option value="To or From airport ?" >To or From Airport ?</option>
                                                <option value="depuis">Depuis</option>
                                                <option value="vers">Vers</option>
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

                                    <div><br /><a href="clients.php" title="All Clients" class="tours">Back to Clients</a></div>


                                    </fieldset>
                                      
                                    <fieldset>
                                      
                                      <p class="fieldsetpage">Step 2/4</p>
                                      <input type="text" name="arrivaldate" class="input date" id="datepicker" value="Arrival/Departing Date" onFocus="this.value='';" onBlur="if(this.value==''){this.value='Arrival/Departing Date';}" />
                                    <script type="text/javascript">
                                       $(function() {
                                      $( "#datepicker" ).datepicker();
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
                                  
                                    <input name="flightnumb" type="text" id="flight" class="input flight" value="Flight Number" onFocus="this.value='';" onBlur="if(this.value==''){this.value='Flight Number';}" />
                                <input name="terminal" type="text" id="terminal" class="input terminal" value="Airport Terminal" onFocus="this.value='';" onBlur="if(this.value==''){this.value='Airport Terminal';}" /> 

                                    </fieldset>


                                     <fieldset>
                                      <p class="fieldsetpage">Step 3/4</p>
                                      <input name="name" type="text" class="input name" value="Client name" onFocus="this.value='';" onBlur="if(this.value==''){this.value='Client name';}" />
                                 <input name="phone" type="text" class="input phone" value="Phone with country code" onFocus="this.value='';" onBlur="if(this.value==''){this.value='Phone with country code';}" />
                                <input name="shuttlefee" type="text" class="input shuttlefee" value="Total Price" onFocus="this.value='';" onBlur="if(this.value==''){this.value='Total Price';}" />
                                      <input name="parisaddress" type="text" class="input address" value="Paris Address" onFocus="this.value='';" onBlur="if(this.value==''){this.value='Paris Address';}" />
                                 

                                    </fieldset>
                                    <fieldset>
                                      <p class="fieldsetpage">Step 4/4</p>

                                    
                                       <textarea class="inputt text" cols="15" rows="5" name="description" id="message" value="Description" onFocus="this.value='';" onBlur="if(this.value==''){this.value='Description';}">Description</textarea><br />

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
