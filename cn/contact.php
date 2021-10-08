

<?php

  include 'config.php';
    if(isset($_POST['submit']))  {
  // Replace this with your own email address
  $to="contact@parisgoairport.com";

  // Extract form contents
  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];
    
  // Validate email address
  function valid_email($str) {
    return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
  }
  
  // Return errors if present
  $errors = "";
  
  if($name =='') { $errors .= "name,"; }
  if(valid_email($email)==FALSE) { $errors .= "email,"; }
  if($message =='') { $errors .= "message,"; }

  // Send email
  if($errors =='') {


    // date_default_timezone_set('Europe/Madrid');
    // $coldate = date('Y-m-d H:i:s');
    //pas besoin avec pdo $name = stripslashes(htmlspecialchars($name));
    //pas besoin avec pdo $subject = stripslashes(htmlspecialchars($subject));
    //pas besoin avec pdo $message = stripslashes(htmlspecialchars($message));
    
    // $req = $bdd->prepare('INSERT INTO messages (name,email,subject,message,coldate) VALUES (:name,:email,:subject,:message,:coldate)');
    // $req->execute(array(
    //   'name'=>$name,
    //   'email'=>$email,
     //  'subject'=>$subject,
    //   'message'=>$message,
     //  'coldate'=>$coldate
    // ));
    // $req->closeCursor();

     $headers =  'Content-type: text/html; charset=utf-8'. "\r\n" .
          'From: ParisGoAirport <no-reply@parisgoairport.com>'. "\r\n" .
          'Reply-To: '.$email.'' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();
    $email_subject = "Website Contact Form: $email";
    $message="Name: $name \n\nEmail: $email \n\nSubject: $subject \n\nMessage:\n\n $message";


  
    
     mail($to, $email_subject, $message, $headers); 

    $ok = 'Email sent with success !';
  
  } else {
     $erreurid = 'Please fill in all the fields.';
  }
  
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
        <title>ParisGoAirport - 联系我们</title>

        <meta name="description" content="联系我们">
        <meta name="keywords" content="联系我们">
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

                <h2>联系我们</h2>
               

                <?php if(isset($ok)){ echo '<p id="ok">'.$ok.'</p>';} 
            elseif(isset($erreurid)){ ?>
            
              <?php echo '<p id="erreurid">'.$erreurid.'</p>'; } ?>

                <form name="login-form" class="login-form" action="contact.php" method="post">

                    <input name="name" type="text" class="input name" value="姓名" onFocus="this.value='';" onBlur="if(this.value==''){this.value='姓名';}" /><br />
                  <input name="email" type="text" class="input email" value="电子邮件" onFocus="this.value='';" onBlur="if(this.value==''){this.value='电子邮件';}" />
                  <input name="subject" type="text" class="input subject" value="主题" onFocus="this.value='';" onBlur="if(this.value==''){this.value='主题';}" />
                 

                    <textarea class="inputt text" cols="10" rows="3" name="message" id="message" value="留言" onFocus="this.value='';" onBlur="if(this.value==''){this.value='留言';}">留言</textarea>

                    

                    <div>
                          <p class="main-description">联系电话 (法国 ，巴黎):  <strong>+33-977-555-558</strong></p>
                          <p class="main-description">Wechat / WhatsApp:  <strong>+33-6987987</strong></p>
                          <p class="main-description">地址: Adresse</p>
                    </div>

                  </div>

            </div> <!-- #main -->
        </div> <!-- #main-container -->

        <div class="footer-container">
            <footer class="wrapper">
              <div class="paddingdiv">
                <input type="submit" name="submit" value="发送" class="button" />
              <div class="homeicon"><a href="index.php" title="主页" class="homelink">主页</a></div>
              <div class="toursicon"><a href="tours.php" title="巴黎观光" class="tourslink">巴黎观光</a></div>
            </div>
            </footer>

            <?php include 'socialfooter.php'; ?>
        </div>
        </form>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.1.min.js"><\/script>')</script>

        <script src="js/main.js"></script>



    </body>
</html>
