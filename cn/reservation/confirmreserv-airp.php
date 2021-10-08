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


$way = $_POST['way'];


if(isset($_POST['submit']))  {

  if($way == '单程') {
        if(!empty($_POST['firstname']) && ($_POST['firstname'] != "姓（拼音）") && !empty($_POST['lastname']) && ($_POST['lastname'] != "名（拼音）") && !empty($_POST['arrivaldate'])
         && ($_POST['arrivaldate'] != "到港日期/离港日期")  && !empty($_POST['arrivaltime']) && ($_POST['arrivaltime'] != "到港时间/离港时间") 
               && !empty($_POST['email']) && ($_POST['email'] != "电子邮件")  && !empty($_POST['phone']) && ($_POST['phone'] != "电话号码（附加国家区号)")
                && !empty($_POST['flightnumb']) && ($_POST['flightnumb'] != "航班号") && !empty($_POST['terminal']) && ($_POST['terminal'] != "航站楼") 
            && ($_POST['nbadults'] != "人数（3岁以上)") && preg_match('#^[a-z0-9.!\#$%&\'*+-/=?^_`{|}~]+@([0-9.]+|([^\s]+\.+[a-z]{2,6}))$#si', $_POST['email']) && !empty($_POST['num1'])
               && !empty($_POST['num2']) && !empty($_POST['captcha']) && ($_POST['captcha'] != "有效验证")) {
                extract($_POST);
                $num1 = $_POST['num1'];
                $num2 = $_POST['num2'];
                $total = $_POST['captcha'];
                if( intval($num1) + intval($num2) == intval($total) ) {
                          $valid = true;
                  }
                  else {
                          $valid = false;
          
                          header('Location: one-way-reservation-airp.php?way='.urlencode($way).'&captcha=false');
                  }
          
          } else {
           $valid = false;
          
           header('Location: one-way-reservation-airp.php?way='.urlencode($way).'&notvalid=false');

          }
    }

    if($way == '往返') {
        if(!empty($_POST['firstname']) && ($_POST['firstname'] != "姓（拼音）") && !empty($_POST['lastname']) && ($_POST['lastname'] != "姓（拼音）") && !empty($_POST['arrivaldate'])
         && ($_POST['arrivaldate'] != "到港日期/离港日期")  && !empty($_POST['arrivaltime']) && ($_POST['arrivaltime'] != "到港时间/离港时间")
           && ($_POST['returningdate'] != "返回日期")  && !empty($_POST['returningtime']) && ($_POST['returningtime'] != "返回时间")
               && !empty($_POST['email']) && ($_POST['email'] != "电子邮件")  && !empty($_POST['phone']) && ($_POST['phone'] != "电话号码（附加国家区号)")
             && ($_POST['nbadults'] != "人数（3岁以上)")
             && !empty($_POST['flightnumb']) && ($_POST['flightnumb'] != "航班号") && !empty($_POST['terminal']) && ($_POST['terminal'] != "航站楼") 
             && !empty($_POST['reflightnumb']) && ($_POST['reflightnumb'] != "返回航班号") && !empty($_POST['reterminal']) && ($_POST['reterminal'] != "返回航站楼")  
               && preg_match('#^[a-z0-9.!\#$%&\'*+-/=?^_`{|}~]+@([0-9.]+|([^\s]+\.+[a-z]{2,6}))$#si', $_POST['email']) && !empty($_POST['num1'])
               && !empty($_POST['num2']) && !empty($_POST['captcha']) && ($_POST['captcha'] != "有效验证")) {
                extract($_POST);
                $num1 = $_POST['num1'];
                $num2 = $_POST['num2'];
                $total = $_POST['captcha'];
                if( intval($num1) + intval($num2) == intval($total) ) {
                          $valid = true;
                  }
                  else {
                          $valid = false;
          
                          header('Location: round-trip-reservation-airp.php?way='.urlencode($way).'&captcha=false');
                  }
          
          } else {
           $valid = false;
          
           header('Location: round-trip-reservation-airp.php?way='.urlencode($way).'&notvalid=false');

          }
    }
  
  if($valid)
  {
   // header("confirmreserv.php");

  

    date_default_timezone_set('Europe/Madrid');
    $coldate = date('Y-m-d H:i:s');
    
      $firstname = htmlspecialchars($_POST['firstname']);
      $lastname = htmlspecialchars($_POST['lastname']);
      $arrivaldate = htmlspecialchars(date('Y-m-d', strtotime($_POST['arrivaldate']))); 
      $arrivaltime = htmlspecialchars($_POST['arrivaltime']);
      $flightnumb = htmlspecialchars($_POST['flightnumb']);
      $terminal = htmlspecialchars($_POST['terminal']);
      $email = htmlspecialchars($_POST['email']);
      $phone = htmlspecialchars($_POST['phone']);
      $tfairport = htmlspecialchars($_POST['tfairport']);
      $shuservice = '私人包车（默认）';
      $nbadults = htmlspecialchars($_POST['nbadults']);

      if($way == '往返') {
        $returningdate = htmlspecialchars(date('Y-m-d', strtotime($_POST['returningdate']))); 
        $returningtime = htmlspecialchars($_POST['returningtime']);
        $reflightnumb = htmlspecialchars($_POST['reflightnumb']);
        $reterminal = htmlspecialchars($_POST['reterminal']);
        $flightnumb .= ' - 返回: '.$reflightnumb;
        $terminal .= ' - 返回: '.$reterminal;
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
        <title>ParisGoAirport - 巴黎接机预订</title>

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

                <h2>确认您的预订。</h2>
                <p class="main-description">确认以下填写内容无误。<a href="shuttle-prices.php" title="价格" target="_blank">服务价格</a></p>

                        <?php if(isset($ok)){ echo '<p id="ok">'.$ok.'</p>';} 
                    elseif(isset($erreurid)){ ?>
                    
                      <?php echo '<p id="erreurid">'.$erreurid.'</p>'; } ?>


                       
                        <h3 class="title-prices-second"><?php echo $way; ?> <?php echo $tfairport; ?></h3>
                    <table>
                       <tr>
                           <th>航班号</th>
                           <td><?php echo $flightnumb; ?></td>
                       </tr>
                       <tr>
                           <th>航站楼</th>
                           <td><?php echo $terminal; ?></td>
                       </tr>
                       <tr>
                           <th>到港日期/离港日期</th>
                           <td><?php echo $arrivaldate; ?></td>
                       </tr>
                       <tr>
                           <th>到港时间/离港时间</th>
                           <td><?php echo $arrivaltime; ?></td>
                       </tr><?php if($way == '往返') { ?>
                       <tr>
                           <th>返回日期</th>
                           <td><?php echo $returningdate; ?></td>
                       </tr>
                       <tr>
                           <th>返回时间</th>
                           <td><?php echo $returningtime; ?></td>
                       </tr><?php   } ?>
                       <tr>
                           <th>姓（拼音）</th>
                           <td><?php echo $firstname; ?></td>
                       </tr>
                       <tr>
                           <th>名（拼音）</th>
                           <td><?php echo $lastname; ?></td>
                       </tr>
                       <tr>
                           <th>电子邮件</th>
                           <td><?php echo $email; ?></td>
                       </tr>
                       <tr>
                           <th>电话号码</th>
                           <td><?php echo $phone; ?></td>
                       </tr>
                       <tr>
                           <th>请选择服务</th>
                           <td><?php echo $shuservice; ?></td>
                       </tr>
                       <tr>
                           <th>人数</th>
                           <td><?php echo $nbadults; ?></td>
                       </tr>




                    <tr class="total-price-confirmation">
                           <th>总价</th>
                           <td>
                    <?php

                     $oneper = "65";
                    $twoper ="65";
                    $threeper ="65";
                    $fourper = "65";
                    $fiveper = "85";
                    $sixper = "85";
                    $sevenper = "85";
                    $eightper = "85";

                    if ($way == "单程") {



                                if($nbadults == "1"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee= $oneper; echo $shuttlefee;}
                                  else{ $shuttlefee=$oneper+10; echo $shuttlefee;}
                                }
                              if($nbadults == "2"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$twoper; echo $shuttlefee;}
                                  else{ $shuttlefee=$twoper+10; echo $shuttlefee;}
                                }
                              if($nbadults == "3"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$threeper; echo $shuttlefee;}
                                  else{ $shuttlefee=$threeper+10; echo $shuttlefee;}
                                }
                              if($nbadults == "4"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$fourper; echo $shuttlefee;}
                                  else { $shuttlefee=$fourper+10; echo $shuttlefee;}
                                }
                              if($nbadults == "5"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$fiveper; echo $shuttlefee;}
                                  else{ $shuttlefee=$fiveper+10; echo $shuttlefee;}
                                }
                              if($nbadults == "6"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$sixper; echo $shuttlefee;}
                                  else{ $shuttlefee=$sixper+10; echo $shuttlefee;}
                                }
                              if($nbadults == "7"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$sevenper; echo $shuttlefee;}
                                  else{ $shuttlefee=$sevenper+10; echo $shuttlefee;}
                                }
                              if($nbadults == "8"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$eightper; echo $shuttlefee;}
                                  else{ $shuttlefee=$eightper+10; echo $shuttlefee;}

                    } // end one-way

                    if ($way == "往返") {
                     


                                if($nbadults == "1"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee= $oneper*2; echo $shuttlefee;}
                                  else{ $shuttlefee=$oneper*2; $shuttlefee += 10; echo $shuttlefee;}
                                }
                              if($nbadults == "2"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$twoper*2; echo $shuttlefee;}
                                  else{ $shuttlefee=$twoper*2; $shuttlefee += 10; echo $shuttlefee;}
                                }
                              if($nbadults == "3"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$threeper*2; echo $shuttlefee;}
                                  else{ $shuttlefee=$threeper*2; $shuttlefee += 10; echo $shuttlefee;}
                                }
                              if($nbadults == "4"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$fourper*2; echo $shuttlefee;}
                                  else { $shuttlefee=$fourper*2; $shuttlefee += 10; echo $shuttlefee;}
                                }
                              if($nbadults == "5"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$fiveper*2; echo $shuttlefee;}
                                  else{ $shuttlefee=$fiveper*2; $shuttlefee += 10; echo $shuttlefee;}
                                }
                              if($nbadults == "6"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$sixper*2; echo $shuttlefee;}
                                  else{ $shuttlefee=$sixper*2; $shuttlefee += 10; echo $shuttlefee;}
                                }
                              if($nbadults == "7"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$sevenper*2; echo $shuttlefee;}
                                  else{ $shuttlefee=$sevenper*2; $shuttlefee += 10; echo $shuttlefee;}
                                }
                              if($nbadults == "8"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$eightper*2; echo $shuttlefee;}
                                  else{ $shuttlefee=$eightper*2; $shuttlefee += 10; echo $shuttlefee;}
                                }

                    } // end round-trip




                     ?> €</td>
                       </tr>
                    </table>



                     <form class="login-form" id="SignupForm" action="../tours-airp-res.php" method="post">
                     <!-- <a href="shuttle-prices.php" title="Prices">Check the prices</a> -->
                    <input type="hidden" name="firstname" value="<?php echo $firstname; ?>" />
                    <input type="hidden" name="lastname" value="<?php echo $lastname; ?>" />
                    <input type="hidden" name="arrivaldate" value="<?php echo $arrivaldate; ?>" />
                    <input type="hidden" name="arrivaltime" value="<?php echo $arrivaltime; ?>" />
                    <input type="hidden" name="flightnumb" value="<?php echo $flightnumb; ?>" />
                    <input type="hidden" name="way" value="<?php echo $way; ?>" />
                    <input type="hidden" name="terminal" value="<?php echo $terminal; ?>" />
                    <input type="hidden" name="email" value="<?php echo $email; ?>" />
                    <input type="hidden" name="phone" value="<?php echo $phone; ?>" />
                    <input type="hidden" name="tfairport" value="<?php echo $tfairport; ?>" />
                    <input type="hidden" name="shuservice" value="<?php echo $shuservice; ?>" />
                    <input type="hidden" name="nbadults" value="<?php echo $nbadults; ?>" />
                    <input type="hidden" name="shuttlefee" value="<?php echo $shuttlefee; ?>" />
                    <?php if($way == '往返') { ?>
                    <input type="hidden" name="returningdate" value="<?php echo $returningdate; ?>" />
                    <input type="hidden" name="returningtime" value="<?php echo $returningtime; ?>" />
                    <?php   } ?>

                  </div>

            </div> <!-- #main -->
        </div> <!-- #main-container -->

        <div class="footer-container">
            <footer class="wrapper">
              <div class="paddingdiv">
                <input type="submit" id="SaveAccount" name="submit" value="确认" class="button" />
                <div class="contacticon"><a href="../contact.php" title="联系我们" class="contactlink">联系我们</a></div>
                <div class="homeicon"><a href="../index.php" title="主页" class="homelink">主页</a></div>
                <div class="toursicon"><a href="../tours.php" title="巴黎观光 Tours" class="tourslink">巴黎观光</a></div>
            </div>
            </footer>

            <div id="copyright"><p>© 2013 ParisGoAirport - <a href="../terms.php" title="相关条款">相关条款</a></p></div>
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
