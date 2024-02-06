<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
// Yii::import('vendors.yii-mail.YiiMailMessage');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ContactForm extends CFormModel
{
	public $name;
	public $email;
	public $cc;
	public $subject;
	public $body;
	public $filename;
	public $verifyCode;
	public $message;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('name, email, subject, body, filename', 'required'),
			// email has to be a valid email address
			array('email', 'email'),
			array('cc', 'match', 'pattern' => "/^([_a-z0-9\-]+)(\.[_a-z0-9\-]+)*@([a-z0-9\-]{2,}\.)*([a-z]{2,4})(,([_a-z0-9\-]+)(\.[_a-z0-9\-]+)*@([a-z0-9\-]{2,}\.)*([a-z]{2,4}))*$/", 'message' => 'separate email ids with commas'),
			// verifyCode needs to be entered correctly
			//array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'verifyCode' => 'Verification Code',
		);
	}

	/**
	 * Sends an email to the specified email address using the information collected by this model.
	 * @param string $email the target email address
	 * @return boolean whether the model passes validation
	 */
	public function contact($email)
	{
		//	$message = new YiiMailMessage;

		if ($this->validate()) {

			/*	$message->setTo($email);
						 $message->setFrom(array(Yii::app()->params['adminEmail'] => $this->name));
						 $message->setSubject($this->subject);
						 $message->setBody($this->body);
						 $message->attach(Swift_Attachment::fromPath($this->filename));
					  */

			//Load Composer's autoloader
			require 'vendor/autoload.php';

			//Create an instance; passing `true` enables exceptions
			//$mail = new PHPMailer(true);
			$mail = new YiiMailer();
			try {
				//Server settings

				$mail->setSmtp('smtp.gmail.com', 465, 'ssl', true, Yii::app()->params['adminEmail'], 'M1yMaker');
				/*$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
								  $mail->isSMTP();                                            //Send using SMTP
								  $mail->Host       = 'smtp.google.com';                     //Set the SMTP server to send through
								  $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
								  $mail->Username   = Yii::app()->params['adminEmail'];                     //SMTP username
								  $mail->Password   = 'M1yMaker';                               //SMTP password
								  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
								  $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
								  */
				//Recipients
				$mail->setView('contact');
				$mail->setFrom(Yii::app()->params['adminEmail'], 'Mailer');
				$mail->addAddress($email[0]); //Add a recipient
				//	$mail->addAddress('ellen@example.com');               //Name is optional
				//	$mail->addReplyTo('info@example.com', 'Information');
				//	$mail->addCC('cc@example.com');
				//	$mail->addBCC('bcc@example.com');

				//Attachments
				$mail->addAttachment($this->filename); //Add attachments
				//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

				//Content
				$mail->isHTML(true); //Set email format to HTML
				$mail->Subject = $this->subject;
				$mail->Body = $this->body;
				$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


				$mail->send();
				echo 'Message has been sent';
			} catch (Exception $e) {
				echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}
			//	Yii::app()->mail->send($message);
			return true;
		} else {
			return false;
		}
	}
}