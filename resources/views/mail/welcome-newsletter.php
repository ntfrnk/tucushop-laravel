<?

// Fin de variables

$from = $pow_mail_remitente; //cuenta que envia
$destinatario = $pow_post['email']; //cuenta destino

$subject = "¡Suscripción exitosa a ".$pow_web_name."!";

$header = $pow_html_mail_header;

$text.= '<p>¡Bienvenid@ a nuestro boletín de novedades!</p>'."\n";
$text.= '<p>Estamos muy felices de que te sumes a la gran familia de '.$pow_web_name_html'.</p>'."\n";
$text.= '<p>A través de nuestros boletines te vamos a mantener informad@ sobre las ofertas y novedades que se añaden cada semana a nuestra web.</p>'."\n";
$text.= '<p>Te recordamos además que en cualquier momento podrás cancelar o suspender la suscripción temporalmente.</p>'."\n";
$text.= '<p>Quedamos a tu entera disposición, y nuevamente:</p>'."\n";
$text.= '<p>¡Gracias por ser parte de '.$pow_web_name_html.'!</p>'."\n";

$text.= $pow_html_mail_firma;

include("../includes/mail/template-mail.php");

mail($destinatario,$subject,$html,$header);

?>