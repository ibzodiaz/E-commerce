<?php
require_once "views/View.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ControllerRegistration
{
	private $_customerManager;
	private $_sellerManager;
	private $_view;

	public function __construct($url){

		$url = is_array($url) ? $url : str_split($url);

		if(isset($url) && count($url) > 1){
			throw new Exception("Page introuvable !");
		}
		else{

			$this->_customerManager = new CustomerManager;
			$this->_sellerManager = new SellerManager;

			$this->registration();
			
		}

	}


	private function registration(){

		extract($_POST);

		if(isset($register)){

			if (!empty($prenom) && !empty($nom) && !empty($telephone) && !empty($email) && !empty($password1) && !empty($password2)) {
				if($password1 == $password2 ){
					if(strlen($password1) > 7){

						if (isset($checkbox)) {

						
							$pwd_hashed =  hash_password($password1);

							if($customertype == 1){
								if(!$this->_customerManager->customerEmailExists($email) && !$this->_sellerManager->sellerEmailExists($email)){


									/****************************************/
									//require_once "vendor/autoload.php";

									//0MpkwSSO9oeEzdMKJXPWR-g-XX0u2j13pfzRCLWO

								    /*$sid    = "AC515e3406785a4b9f8ba85ceaeea2b22c";
								    $token  = "5ef86abec4e71a600d9dd766c67e8880";

								    $twilio = new Client($sid, $token);

								    $message = $twilio->messages->create(
								    	$telephone,
								    	array(	
							        		"from" => "+15075169314",
							                "body" => "Bonsoir cher client voici votre code"
								        )
								    );*/

									//Create an instance; passing `true` enables exceptions
									//$mail = new PHPMailer(true);

									try {
									    //Server settings
									   /* $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
									    $mail->isSMTP();                                            //Send using SMTP
									    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
									    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
									    $mail->Username   = 'user@gmail.com';                     //SMTP username
									    $mail->Password   = 'secret';                               //SMTP password
									    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
									    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

									    //Recipients
									    $mail->setFrom('user@gmail.com', 'i-shop.com');
									    $mail->addAddress($email, $prenom);     //Add a recipient

									    $verification_code = substr(number_format(time()*rand(),0,'',''),0,6);

									    //Content
									    $mail->isHTML(true);                                  //Set email format to HTML
									    $mail->Subject = 'Vérification email';
									    $mail->Body    = '<p>Votre code de vérification est: <b style="font-size:30px;">'.$verification_code.'</b></p>';

									    $mail->send();*/

									    $verification_code = substr(number_format(time()*rand(),0,'',''),0,6);

									    $to      = $email;
										$subject = 'Vérification email';
										$message = '<p>Votre code de vérification est: <b style="font-size:30px;">'.$verification_code.'</b></p>';

										$headers = 'From: ibzodiaz32@gmail.com' . "\r\n" .
										'Reply-To: webmaster@example.com' . "\r\n" .
										'X-Mailer: PHP/' . phpversion();

										mail($to, $subject, $message, $headers);

									    $object = array(
											"customer_firstname"=>$prenom,
											"customer_lastname"=>$nom,
											"customer_sexe"=>$sexe,
											"customer_phone"=>$telephone,
											"customer_email"=>$email,
											"customer_password"=>$pwd_hashed
										);
										$this->_customerManager->insertCustomer($object);

									    $_SESSION['success'] = 'Un mail de confirmation vous a été envoyé!';

									    unset($_POST);
										$_POST = array();

										header('Location:index.php?url=registration');
										exit;

									} catch (Exception $e) {
									    $_SESSION['error'] = "Message could not be sent. Mailer Error: ".$e->getMessage();
									}

									
								}else{
						
									$error = "Ce compte existe !";
								}
								
							}
							else{
								if(!$this->_customerManager->customerEmailExists($email) && !$this->_sellerManager->sellerEmailExists($email)){
									$object = array(
										"seller_firstname"=>$prenom,
										"seller_lastname"=>$nom,
										"seller_sexe"=>$sexe,
										"seller_phone"=>$telephone,
										"seller_email"=>$email,
										"seller_password"=>$pwd_hashed
									);
									//POUR LES SELLERS
									$this->_sellerManager->insertSeller($object);

									$_SESSION['success'] = "Votre inscription en tant que fournisseur est passée avec succés!";

									unset($_POST);
									$_POST = array();
									header('Location:index.php?url=registration');
									exit;
								}else{
									$error = "Ce compte existe !";
								}
								
							}

						}
						else{

							$error = "Veuillez accepter les conditions générales d'utilisation d'abord!";

						}

					}
					else{
						$error = "Le mot de passe doit être au moins de 8 caractères!";
					}
				}
				else{
					$error = "Les deux mots de passe ne correspondent pas !";
				}
				
			}
			else{
				$error = "Un champ est vide !";
			}
			
		}

		$data = array(""=>"");
		
		if (isset($error)) 
		{	
			$_SESSION['error'] = $error;
		}

		
		$this->_view = new View('Registration');
		$this->_view->generate($data);

	}
}

?>