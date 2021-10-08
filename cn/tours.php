<?php


  include 'config.php';

if(isset($_POST['submit']))  {
  if(!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['arrivaldate'])  && !empty($_POST['arrivaltime'])   && !empty($_POST['email'])  && !empty($_POST['phone']) && !empty($_POST['shuttlefee'])
        && ($_POST['shuservice'] != "请选择服务")) {
    extract($_POST);
    $valid = true;
    } else {
     $valid = false;
    $erreurid = '请填写下列所有信息。<a href="reservation/reservationway.php" title="预订">预订</a>';
    }
  
  
    if($valid)
    {
          date_default_timezone_set('Europe/Madrid');
      $coldate = date('Y-m-d H:i:s');
      
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $arrivaldate = date('Y-m-d', strtotime($_POST['arrivaldate']));
        $arrivaltime = $_POST['arrivaltime'];
        $flightnumb = $_POST['flightnumb'];
        $airport = $_POST['airport'];
        $terminal = $_POST['terminal'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $parisaddress = $_POST['parisaddress'];
        $tfairport = $_POST['tfairport'];
        $shuservice = $_POST['shuservice'];
        $nbadults = $_POST['nbadults'];
        $nbchildren = $_POST['nbchildren'];
        $shuttlefee = $_POST['shuttlefee'];
        $way = $_POST['way'];

      if($way == '往返') {
        $returningdate = date('Y-m-d', strtotime($_POST['returningdate'])); 
        $returningtime = $_POST['returningtime'];

      
      $req = $bdd->prepare('INSERT INTO personnes (coldate,firstname,lastname,arrivaldate,arrivaltime,flightnumb,airport,terminal,email,phone,tfairport,nbadults,nbchildren,shuservice,parisaddress,shuttlefee,way,returningdate,returningtime) 
        VALUES (:coldate,:firstname,:lastname,:arrivaldate,:arrivaltime,:flightnumb,:airport,:terminal,:email,:phone,:tfairport,:nbadults,:nbchildren,:shuservice,:parisaddress,:shuttlefee,:way,:returningdate,:returningtime)');
      $req->execute(array(
        'coldate'=>$coldate,
        'firstname'=>$firstname,
        'lastname'=>$lastname,
        'arrivaldate'=>$arrivaldate,
        'arrivaltime'=>$arrivaltime,
        'flightnumb'=>$flightnumb,
        'airport'=>$airport,
        'terminal'=>$terminal,
        'email'=>$email,
        'phone'=>$phone,
        'tfairport'=>$tfairport,
        'nbadults'=>$nbadults,
        'nbchildren'=>$nbchildren,
        'shuservice'=>$shuservice,
        'parisaddress'=>$parisaddress,
        'shuttlefee'=>$shuttlefee,
        'way'=>$way,
        'returningdate'=>$returningdate,
        'returningtime'=>$returningtime
        
      ));
      $req->closeCursor();



      $sth = $bdd->prepare("SELECT id FROM personnes WHERE coldate = :coldate");
        $sth->execute(array(':coldate' => $coldate));
        $result = $sth->fetch(PDO::FETCH_OBJ);
        $sth->closeCursor();
        $invoice = $result->id;
        
      $ok = '
       <form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" id="_xclick" method="post">
       <img class="pp-img" src="../img/paypal.png" alt="Make payments with PayPal - it\'s fast, free and secure!" title="PayPal" />
                            <p>重要提示：您将重新登录Paypal网站完成安全支付.</p>
                           
                            <input type="hidden" name="cmd" value="_xclick"> 
                            <input type="hidden" name="business" id="business" value="qsdsqd@parisgoairport.com">
                            <input type="hidden" name="currency_code" value="EUR">
                            <INPUT type="hidden" name="charset" value="utf-8">
                            <input name="cancel_return" type="hidden" value="http://www.parisgoairport.com" />
                            <input name="no_note" type="hidden" value="1" />
                            <input name="bn" type="hidden" value="PP-BuyNowBF" />
                            <input type="hidden" name="item_name" id="item_name" value="'.$arrivaldate.' 往返 '.$airport.' '.$nbadults.'人">
                            
                        <input type="hidden" name="amount" id="amount" value="'.$shuttlefee.'">
                            
                            <button class="button" type="submit" name="submit">通过Paypal查询</button></form>'; 


                  require_once('PHPMailer_5.2.4/class.phpmailer.php');
            //include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

            $mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

            $mail->IsSMTP(); // telling the class to use SMTP

            try {
              $mailmessage = file_get_contents('reservation/round-trip-mail.html');
              $mailmessage = str_replace('%firstname%', $firstname, $mailmessage);  
              $mailmessage = str_replace('%lastname%', $lastname, $mailmessage); 
              $mailmessage = str_replace('%arrivaldate%', $arrivaldate, $mailmessage); 
              $mailmessage = str_replace('%arrivaltime%', $arrivaltime, $mailmessage);
              $mailmessage = str_replace('%returningdate%', $returningdate, $mailmessage); 
              $mailmessage = str_replace('%returningtime%', $returningtime, $mailmessage);  
              $mailmessage = str_replace('%flightnumb%', $flightnumb, $mailmessage); 
              $mailmessage = str_replace('%airport%', $airport, $mailmessage); 
              $mailmessage = str_replace('%phone%', $phone, $mailmessage); 
              $mailmessage = str_replace('%tfairport%', $tfairport, $mailmessage); 
              $mailmessage = str_replace('%nbadults%', $nbadults, $mailmessage); 
              $mailmessage = str_replace('%nbchildren%', $nbchildren, $mailmessage); 
              $mailmessage = str_replace('%shuservice%', $shuservice, $mailmessage); 
              $mailmessage = str_replace('%parisaddress%', $parisaddress, $mailmessage); 
              $mailmessage = str_replace('%shuttlefee%', $shuttlefee, $mailmessage); 
              $mailmessage = str_replace('%terminal%', $terminal, $mailmessage); 
              $mailmessage = str_replace('%way%', $way, $mailmessage);
              $mailmessage = str_replace('%invoice%', $invoice, $mailmessage);
              $mail->Host       = "ssl://in.mailjet.com"; // SMTP server
              $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
              $mail->SMTPAuth   = true;                  // enable SMTP authentication
              $mail->Host       = "ssl://in.mailjet.com"; // sets the SMTP server
              $mail->Port       = 443;                    // set the SMTP port for the GMAIL server
              $mail->Username   = "qsdsqd"; // SMTP account username
              $mail->Password   = "qsdsqd";        // SMTP account password
              $mail->AddAddress($email);
              $mail->SetFrom('contact@parisgoairport.com');
              $mail->AddReplyTo('contact@parisgoairport.com', 'ParisGoAirport');
              $mail->AddCC('contact@parisgoairport.com');
              $mail->Subject = '您的预订 ParisGoAirport';
              $mail->AltBody = '请 使用可兼容HTML网络脚本语言的游览器查看信息'; // optional - MsgHTML will create an alternate automatically
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

      } //end if round-trip



       if($way == '单程') {

      
      $req = $bdd->prepare('INSERT INTO personnes (coldate,firstname,lastname,arrivaldate,arrivaltime,flightnumb,airport,terminal,email,phone,tfairport,nbadults,nbchildren,shuservice,parisaddress,shuttlefee,way) 
        VALUES (:coldate,:firstname,:lastname,:arrivaldate,:arrivaltime,:flightnumb,:airport,:terminal,:email,:phone,:tfairport,:nbadults,:nbchildren,:shuservice,:parisaddress,:shuttlefee,:way)');
      $req->execute(array(
        'coldate'=>$coldate,
        'firstname'=>$firstname,
        'lastname'=>$lastname,
        'arrivaldate'=>$arrivaldate,
        'arrivaltime'=>$arrivaltime,
        'flightnumb'=>$flightnumb,
        'airport'=>$airport,
        'terminal'=>$terminal,
        'email'=>$email,
        'phone'=>$phone,
        'tfairport'=>$tfairport,
        'nbadults'=>$nbadults,
        'nbchildren'=>$nbchildren,
        'shuservice'=>$shuservice,
        'parisaddress'=>$parisaddress,
        'shuttlefee'=>$shuttlefee,
        'way'=>$way
        
      ));
      $req->closeCursor();



      $sth = $bdd->prepare("SELECT id FROM personnes WHERE coldate = :coldate");
        $sth->execute(array(':coldate' => $coldate));
        $result = $sth->fetch(PDO::FETCH_OBJ);
        $sth->closeCursor();
        $invoice = $result->id;
        
     $ok = '
       <form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" id="_xclick" method="post">
       <img class="pp-img" src="../img/paypal.png" alt="Make payments with PayPal - it\'s fast, free and secure!" title="PayPal" />
                            <p>重要提示：您将重新登录Paypal网站完成安全支付.</p>
                           
                            <input type="hidden" name="cmd" value="_xclick"> 
                            <input type="hidden" name="business" id="business" value="qsdsqd@parisgoairport.com">
                            <input type="hidden" name="currency_code" value="EUR">
                            <INPUT type="hidden" name="charset" value="utf-8">
                            <input name="cancel_return" type="hidden" value="http://www.parisgoairport.com" />
                            <input name="no_note" type="hidden" value="1" />
                            <input name="bn" type="hidden" value="PP-BuyNowBF" />
                            <input type="hidden" name="item_name" id="item_name" value="'.$arrivaldate.' 单程 '.$airport.' '.$nbadults.'人">
                            
                        <input type="hidden" name="amount" id="amount" value="'.$shuttlefee.'">
                            
                            <button class="button" type="submit" name="submit">通过Paypal查询</button></form>'; 


                  require_once('PHPMailer_5.2.4/class.phpmailer.php');
            //include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

            $mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

            $mail->IsSMTP(); // telling the class to use SMTP

            try {
              $mailmessage = file_get_contents('reservation/one-way-mail.html');
              $mailmessage = str_replace('%firstname%', $firstname, $mailmessage);  
              $mailmessage = str_replace('%lastname%', $lastname, $mailmessage); 
              $mailmessage = str_replace('%arrivaldate%', $arrivaldate, $mailmessage); 
              $mailmessage = str_replace('%arrivaltime%', $arrivaltime, $mailmessage); 
              $mailmessage = str_replace('%flightnumb%', $flightnumb, $mailmessage); 
              $mailmessage = str_replace('%airport%', $airport, $mailmessage); 
              $mailmessage = str_replace('%phone%', $phone, $mailmessage); 
              $mailmessage = str_replace('%tfairport%', $tfairport, $mailmessage); 
              $mailmessage = str_replace('%nbadults%', $nbadults, $mailmessage); 
              $mailmessage = str_replace('%nbchildren%', $nbchildren, $mailmessage); 
              $mailmessage = str_replace('%shuservice%', $shuservice, $mailmessage); 
              $mailmessage = str_replace('%parisaddress%', $parisaddress, $mailmessage); 
              $mailmessage = str_replace('%shuttlefee%', $shuttlefee, $mailmessage); 
              $mailmessage = str_replace('%terminal%', $terminal, $mailmessage); 
              $mailmessage = str_replace('%way%', $way, $mailmessage);
              $mailmessage = str_replace('%invoice%', $invoice, $mailmessage);
              $mail->Host       = "ssl://in.mailjet.com"; // SMTP server
              $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
              $mail->SMTPAuth   = true;                  // enable SMTP authentication
              $mail->Host       = "ssl://in.mailjet.com"; // sets the SMTP server
              $mail->Port       = 443;                    // set the SMTP port for the GMAIL server
              $mail->Username   = "qsdsqd"; // SMTP account username
              $mail->Password   = "qsdsqd";        // SMTP account password
              $mail->AddAddress($email);
              $mail->SetFrom('contact@parisgoairport.com');
              $mail->AddReplyTo('contact@parisgoairport.com', 'ParisGoAirport');
              $mail->AddCC('contact@parisgoairport.com');
              $mail->Subject = '您的预订 ParisGoAirport';
              $mail->AltBody = '请 使用可兼容HTML网络脚本语言的游览器查看信息'; // optional - MsgHTML will create an alternate automatically
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

        } //end if one-way



      
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
        <title>ParisGoAirport - 观光旅游</title>

        <meta name="description" content="观光旅游: 巴黎市区观光, 巴黎之夜, 巴黎迪斯尼乐园, 凡尔赛皇宫, 吉维尼小镇, 枫丹白露小镇, 巴比桑镇, 其他省份">
        <meta name="keywords" content="观光旅游,巴黎市区观光,巴黎之夜,巴黎迪斯尼乐园,凡尔赛皇宫,吉维尼小镇,枫丹白露小镇,巴比桑镇,其他省份">
        <meta name="author" content="Niklas Edelstam">
        <meta name="robots" content="index,follow" />
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css">
        
        <link rel="icon" type="image/png" href="img/icons/favicon.png" />
        <!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="img/icons/favicon.ico" /><![endif]-->
        <link rel="apple-touch-icon" href="img/icons/apple-touch-icon-57x57.png" /> 
        <link rel="apple-touch-icon" sizes="72x72" href="img/icons/apple-touch-icon-72x72" /> 
        <link rel="apple-touch-icon" sizes="114x114" href="img/icons/apple-touch-icon-114x114.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="img/icons/apple-touch-icon-144x144.png" />

        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <?php include 'header.php'; ?>

        <div class="main-container">
            <div class="main wrapper clearfix">
              <div class="paddingdiv">

                <h2>观光旅游</h2>
                <p class="main-description">巴黎旅游观光</p>

                <?php if(isset($ok)){ echo '<div class="paddingdiv" id="ok">'.$ok.'</div>';} 
            elseif(isset($erreurid)){ ?>
            
              <?php echo '<h3 id="erreurid">'.$erreurid.'</h3>'; } ?>

                  <div class="tourscat">
                    <a href="tours/paris/paristours.php" title="巴黎"><img src="img/paristours160.jpg" alt="巴黎" /></a>
                    <p><a href="tours/paris/paristours.php" title="巴黎">巴黎</a></p>
                  </div>

                  <div class="tourscat">
                    <a href="tours/parisnight/parisnight.php" title="巴黎之夜"><img src="img/parisnight160.jpg" alt="巴黎之夜" /></a>
                    <p><a href="tours/parisnight/parisnight.php" title="巴黎之夜">巴黎之夜</a></p>
                  </div>


                  <div class="tourscat">
                    <a href="tours/disneyland/disneyland.php" title="巴黎迪斯尼乐园"><img src="img/disneyland160.jpg" alt="巴黎迪斯尼乐园" /></a>
                    <p><a href="tours/disneyland/disneyland.php" title="巴黎迪斯尼乐园">巴黎迪斯尼乐园</a></p>
                  </div>



                  <div class="tourscat">
                    <a href="tours/versailles/versaillestours.php" title="凡尔赛皇宫"><img src="img/versaille160.jpg" alt="凡尔赛皇宫" /></a>
                    <p><a href="tours/versailles/versaillestours.php" title="凡尔赛皇宫">凡尔赛皇宫</a></p>
                  </div>

                  <div class="tourscat">
                    <a href="tours/giverny/givernytours.php" title="吉维尼小镇"><img src="img/giverny160.jpg" alt="吉维尼小镇" /></a>
                    <p><a href="tours/giverny/givernytours.php" title="吉维尼小镇">吉维尼小镇</a></p>
                  </div>


                  <div class="tourscat">
                    <a href="tours/fontainebleau/fontainebleautours.php" title="枫丹白露小镇"><img src="img/fontainebleau160.jpg" alt="枫丹白露小镇" /></a>
                    <p><a href="tours/fontainebleau/fontainebleautours.php" title="枫丹白露小镇">枫丹白露小镇&巴比桑镇</a></p>
                  </div>


                  <div class="tourscat">
                    <a href="tours/province/province.php" title="其他省份"><img src="img/province160.jpg" alt="其他省份" /></a>
                    <p><a href="tours/province/province.php" title="其他省份">其他省份</a></p>
                  </div>

                  <div class="tourscat">
                    <a href="tours/belgium/belgium.php" title="比利时"><img src="img/belgium160.jpg" alt="比利时" /></a>
                    <p><a href="tours/belgium/belgium.php" title="比利时">比利时</a></p>
                  </div>

                </div>

            </div> <!-- #main -->
        </div> <!-- #main-container -->

        <div class="footer-container">
            <footer class="wrapper">
              <div class="paddingdiv">
                <div class="contacticon"><a href="contact.php" title="联系我们" class="contactlink">联系我们</a></div>
                 <div class="homeicon"><a href="index.php" title="主页" class="homelink">主页</a></div>
               </div>
            </footer>

            <?php include 'socialfooter.php'; ?>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.1.min.js"><\/script>')</script>

        <script src="js/main.js"></script>



    </body>
</html>
