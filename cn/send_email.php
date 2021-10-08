
<?php

  include 'config.php';
    
  // Replace this with your own email address
  $to="lkjlkj@mail.com";

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


    date_default_timezone_set('Europe/Madrid');
    $coldate = date('Y-m-d H:i:s');
    $name = stripslashes(htmlspecialchars($name));
    $subject = stripslashes(htmlspecialchars($subject));
    $message = stripslashes(htmlspecialchars($message));
    
    $req = $bdd->prepare('INSERT INTO messages (name,email,subject,message,coldate) VALUES (:name,:email,:subject,:message,:coldate)');
    $req->execute(array(
      'name'=>$name,
      'email'=>$email,
      'subject'=>$subject,
      'message'=>$message,
      'coldate'=>$coldate
    ));
    $req->closeCursor();

    $headers =  'From: ParisGoAirport <no-reply@parisgoairport.com>'. "\r\n" .
          'Reply-To: '.$email.'' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();
    $email_subject = "Website Contact Form: $email";
    $message="Name: $name \n\nEmail: $email \n\nSubject: $subject \n\nMessage:\n\n $message";
  
    
     mail($to, $email_subject, $message, $headers); 

    echo "true";
  
  } else {
    echo $errors;
  }
  
?>