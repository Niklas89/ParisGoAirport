<?php


  include '../config.php';

 if (isset($_GET['notvalid'])) {
if($_GET["notvalid"] == "false"){
  $erreurid = '请正确填写以下信息。';
}
}

//if($_GET["recaptcha"] == "false"){
 // $erreurid = "The reCAPTCHA wasn't entered correctly. Please try again.";
//}

 if (isset($_GET['captcha'])) {
if($_GET["captcha"] == "false"){
  $erreurid = '验证码错误。';
}
}

  if (isset($_GET['varget'])) {
    $_GET['varget'] = htmlspecialchars($_GET['varget']);
    $varget = $_GET['varget'];
} else {
  $varget = '飞机场';
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

                <h2><?php echo $varget; ?> 接送单程服务</h2>
                <p class="main-description">网上预订 - <a href="shuttle-prices.php" title="价格" target="_blank">价格</a>: 将在提交预订单后生成</p>

                        <?php if(isset($ok)){ echo '<p id="ok">'.$ok.'</p>';} 
                    elseif(isset($erreurid)){ ?>
                    
                      <?php echo '<p id="erreurid">'.$erreurid.'</p>'; } ?>

               <form class="login-form" id="SignupForm" action="confirmreserv.php" method="post">

                      <fieldset>
                            <p class="fieldsetpage">第1/4步</p>
                                    <!--<div class="wrappper">
                                          <div class="styled-select">
                                              <span class="arrow"></span>
                                              <select name="airport">
                                                <option value="<?php echo $varget; ?>" ><?php echo $varget;

                                                //if (isset($_GET['varget'])) {

                                                 //if ($varget == "CDG") {
                                                  //echo "Charles de Gaulle (CDG)";
                                                // }
                                                 //if ($varget == "Beauvais") {
                                                 // echo "Beauvais (BVA)";
                                                // }
                                                // if ($varget == "Orly") {
                                                 // echo "Orly (ORY)";
                                                 //} 
                                               //} else { echo $varget; }




                                                ?></option>
                                                <option value="Charles de Gaulle (CDG)">Charles de Gaulle (CDG)</option>
                                                <option value="Beauvais (BVA)">Beauvais (BVA)</option>
                                                <option value="Orly (ORY)">Orly (ORY)</option>
                                              </select>
                                        </div>
                                      </div> -->

                                      <div class="wrappper">
                                          <div class="styled-select">
                                              <span class="arrow"></span>
                                              <select name="shuservice">
                                                <option value="私人包车">私人包车</option>
                                              </select>
                                        </div>
                                      </div>



                                  <div class="wrappper">
                                        <div class="styled-select">
                                            <span class="arrow"></span>
                                            <select name="tfairport">
                                              <option value="送机或接机" >送机或接机</option>
                                              <option value="送机">送机</option>
                                              <option value="接机">接机</option>
                                            </select>
                                      </div>
                                  </div> 
                                  
                                    

                                  
                                    

                                    <div class="wrappper">
                                        <div class="styled-select">
                                            <span class="arrow"></span>
                                            <select name="nbadults">
                                      <option value="人数（3岁以上)">人数（3岁以上)</option>
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

                                  <div class="wrappper">
                                        <div class="styled-select">
                                            <span class="arrow"></span>
                                            <select name="nbchildren">
                                      <option value="0">婴儿座椅</option>
                                      <option value="0">0</option>
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                      <option value="6">6</option>
                                      <option value="7">7</option>
                                            </select>
                                      </div>
                                  </div> 



                                    </fieldset>
                                      
                                    <fieldset>
                                      
                                      <p class="fieldsetpage">第2/4步</p>
                                      <input type="text" name="arrivaldate" class="input date" id="datepicker.[1]" value="到港日期/离港日期" onFocus="this.value='';" onBlur="if(this.value==''){this.value='到港日期/离港日期';}" />
                                      <script type="text/javascript">
                                         $(function() {
                                        $( "#datepicker\\.\\[1\\]" ).datepicker();
                                      });
                                      </script>
                                   
                                      <input type="text" class="input time" name="arrivaltime" id="timepicker.[1]" value="到港时间/离港时间" onFocus="this.value='';" onBlur="if(this.value==''){this.value='到港时间/离港时间';}" />
                                      <script type="text/javascript">
                                          $(document).ready(function() {
                                              $('#timepicker\\.\\[1\\]').timepicker( {
                                                  showAnim: 'blind'
                                              } );
                                          });
                                      </script>
                                  
                                    <input name="flightnumb" type="text" id="flight" class="input flight" value="航班号" onFocus="this.value='';" onBlur="if(this.value==''){this.value='航班号';}" />
                                <input name="terminal" type="text" id="terminal" class="input terminal" value="航站楼" onFocus="this.value='';" onBlur="if(this.value==''){this.value='航站楼';}" /> 

                                    </fieldset>


                                     <fieldset>
                                      <p class="fieldsetpage">第3/4步</p>
                                      <input name="firstname" type="text" class="input firstname" value="姓（拼音）" onFocus="this.value='';" onBlur="if(this.value==''){this.value='姓（拼音）';}" />
                                      <input name="lastname" type="text" class="input lastname" value="名（拼音）" onFocus="this.value='';" onBlur="if(this.value==''){this.value='名（拼音）';}" />
                                      <input name="email" type="text" class="input email" value="电子邮件" onFocus="this.value='';" onBlur="if(this.value==''){this.value='电子邮件';}" />
                                 <input name="phone" type="text" class="input phone" value="电话号码（附加国家区号)" onFocus="this.value='';" onBlur="if(this.value==''){this.value='电话号码（附加国家区号)';}" />
                                 <input name="way" type="hidden" value="<?php echo $way; ?>" />
                                 <input name="airport" type="hidden" value="<?php echo $varget; ?>" />

                                    </fieldset>
                                    <fieldset>
                                      <p class="fieldsetpage">第4/4步</p>

                                    
                                      <input name="parisaddress" type="text" class="input address" value="巴黎地址" onFocus="this.value='';" onBlur="if(this.value==''){this.value='巴黎地址';}" /> <br />
                                      <!-- <div class="wrappperrlonger">
                                          <div class="styled-select">
                                              <span class="arrow"></span>
                                              <select name="nbchildren">
                                        <option value="0">Baby Seats (under 3 years old)</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                              </select>
                                        </div>
                                    </div> -->

                                   <?php
                                      //require_once('recaptchalib.php');  this is captcha
                                      //$publickey = "6Ldn9eYSAAAAANloYJUqbg2QWu4B-Efp5JVd7iob"; // you got this from the signup page
                                      //echo recaptcha_get_html($publickey);
                                    ?>

                                    <input id="num1" class="inputnumb sum" type="text" name="num1" value="<?php echo rand(1,4) ?>" readonly="readonly" /> <span class="captchacalc">+</span>
                                    <input id="num2" class="inputnumb sum" type="text" name="num2" value="<?php echo rand(5,9) ?>" readonly="readonly" /> <span class="captchacalc">=</span>
                                    <input id="captcha" class="inputnumbtotal captcha" type="text" name="captcha" maxlength="2" value="有效验证" onFocus="this.value='';" onBlur="if(this.value==''){this.value='有效验证';}" />
                                    <!-- See more at: http://www.sinawiwebdesign.com/blog/topics/programming/jquery-and-php-and-catcha-tutorial/#!prettyPhoto -->

                    </fieldset>

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

        <script src="../js/main.js"></script>


    </body>
</html>
