<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

//Load Composer's autoloader
require APPPATH . '../vendor/autoload.php';

//header("Content-Type: application/json");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer{

	public function send($name, $email, $subject, $body){

		// Passing `true` enables exceptions
		$template = $this->new_mail($name, $body, $subject);
		$mail = new PHPMailer(true);
		try {
			//Server settings
			$mail->SMTPDebug = 0;                                 // Enable verbose debug output
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.office365.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'assignments@crutech.edu.ng';                 // SMTP username
			$mail->Password = '$Jfj8484#j--';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to

			//Recipients
			$mail->setFrom('assignments@crutech.edu.ng', 'CRUTECH WEB PLATFORM');
			$mail->addAddress($email, $first_name);     // Add a recipient
			$mail->addReplyTo('assignments@crutech.edu.ng', 'Do Not Reply');

			//Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = $subject;
			$mail->Body = $template;

			$mail->send();
		} catch (Exception $e) {
			//echo json_encode(array("error" => true, "message" => 'Message could not be sent.', "error" => $mail->ErrorInfo, "data" => $data));
		}

	}



	public function sendlecturemail($name, $email, $subject, $body){
		$template = $this->new_mail($name, $body, $subject);
    
		$mail = new PHPMailer(true);
		try {
			$mail->SMTPDebug = 0;                                                    // Enable verbose debug output
			$mail->isSMTP();                                                      // Set mailer to use SMTP
			$mail->Host = "smtp.office365.com"; //$this->_mail_server;             // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = "ennaxtechnologies@gmail.com";//$this->_email;                 // SMTP username
			$mail->Password = "Ennax8899xx"; //$this->_password;                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, ⁠ ssl ⁠ also accepted
			$mail->Port = "587";    //$this->_mail_port;                                   // TCP port to connect to

			//Recipients
					// $mail->setFrom($this->_email, $this->_app_name);
					// $mail->addAddress($email, $name);     // Add a recipient
					// $mail->addReplyTo($this->_email, $this->_app_name);


			$mail->setFrom("ennaxtechnologies@gmail.com", " POST ONLINE STORE ");
			$mail->addAddress($email, $name);     // Add a recipient
			$mail->addReplyTo("ennaxtechnologies@gmail.com", "Do Not Reply");

			//Content
			$mail->isHTML(true);                       // Set email format to HTML
			$mail->Subject = $subject;
			$mail->Body = $template;

			$mail->send();

			return true;


		} catch (\Exception $e) {
			return false;

		}


	}


	public function electionMail($name, $email, $subject, $body){

		$credentials = array(
			// array(
			// 	'username' => 'election@crutech.edu.ng',
			// 	'password' => '383jsjkpwped6%2#@000'
			// ),
			array(
				'username' => 'elections@crutech.edu.ng',
				'password' => 'Lar97683'
			),
			array(
				'username' => 'elections2@crutech.edu.ng',
				'password' => 'Fup90305'
			),
			array(
				'username' => 'elections3@crutech.edu.ng',
				'password' => 'Zoc41036'
			),
			array(
				'username' => 'elections4@crutech.edu.ng',
				'password' => 'Bog11614'
			),
			array(
				'username' => 'elections5@crutech.edu.ng',
				'password' => 'Bot06487'
			),
			array(
				'username' => 'elections6@crutech.edu.ng',
				'password' => 'Waf36153'
			),
			array(
				'username' => 'elections7@crutech.edu.ng',
				'password' => 'Buf98628'
			),
			array(
				'username' => 'elections8@crutech.edu.ng',
				'password' => 'Yoh27360'
			),
			array(
				'username' => 'elections9@crutech.edu.ng',
				'password' => 'Hok88365'
			),
			array(
				'username' => 'elections10@crutech.edu.ng',
				'password' => 'Top81912'
			)
		);

		$index = array_rand($credentials);

		// var_dump($credentials[$index]['username']); die;

		// Passing `true` enables exceptions
		$template = $this->new_mail($name, $body, $subject);

		// echo $template; die;
		$mail = new PHPMailer(true);
		try {
			//Server settings
			$mail->SMTPDebug = 0;                                 // Enable verbose debug output
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.office365.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = $credentials[$index]['username'];                 // SMTP username
			$mail->Password = $credentials[$index]['password'];                          // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to

			//Recipients
			$mail->setFrom($credentials[$index]['username'], 'CRUTECH ELECTIONS');
			$mail->addAddress($email, $name);     // Add a recipient
			$mail->addReplyTo($credentials[$index]['username'], 'Do Not Reply');

			//Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = $subject;
			$mail->Body = $template;

			$mail->send();
		} catch (Exception $e) {
			// echo json_encode(array("error" => true, "message" => 'Message could not be sent.', "error" => $mail->ErrorInfo, "data" => $data));
		}
	}


	function new_mail($name, $body, $subject){
		$template ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


		<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
		<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
		<meta content="width=device-width" name="viewport"/>
		<meta content="IE=edge" http-equiv="X-UA-Compatible"/>
		<title>'. $subject. '</title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
		<style type="text/css">
		body {
			margin: 0;
			padding: 0;
		}

		table,
		td,
		tr {
			vertical-align: top;
			border-collapse: collapse;
		}

		* {
			line-height: inherit;
		}

		a[x-apple-data-detectors=true] {
			color: inherit !important;
			text-decoration: none !important;
		}
		</style>
		<style id="media-query" type="text/css">
		@media (max-width: 670px) {

			.block-grid,
			.col {
				min-width: 320px !important;
				max-width: 100% !important;
				display: block !important;
			}

			.block-grid {
				width: 100% !important;
			}

			.col {
				width: 100% !important;
			}

			.col>div {
				margin: 0 auto;
			}

			img.fullwidth,
			img.fullwidthOnMobile {
				max-width: 100% !important;
			}

			.no-stack .col {
				min-width: 0 !important;
				display: table-cell !important;
			}

			.no-stack.two-up .col {
				width: 50% !important;
			}

			.no-stack .col.num4 {
				width: 33% !important;
			}

			.no-stack .col.num8 {
				width: 66% !important;
			}

			.no-stack .col.num4 {
				width: 33% !important;
			}

			.no-stack .col.num3 {
				width: 25% !important;
			}

			.no-stack .col.num6 {
				width: 50% !important;
			}

			.no-stack .col.num9 {
				width: 75% !important;
			}

			.video-block {
				max-width: none !important;
			}

			.mobile_hide {
				min-height: 0px;
				max-height: 0px;
				max-width: 0px;
				display: none;
				overflow: hidden;
				font-size: 0px;
			}

			.desktop_hide {
				display: block !important;
				max-height: none !important;
			}
		}
		</style>
		</head>
		<body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #F1F3F3;">
		<table bgcolor="#F1F3F3" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="table-layout: fixed; vertical-align: top; min-width: 320px; Margin: 0 auto; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #F1F3F3; width: 100;" valign="top" width="100%">
		<tbody>
		<tr style="vertical-align: top;" valign="top">
		<td style="word-break: break-word; vertical-align: top;" valign="top">

		<div style="background-color:transparent;">
		<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 650px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
		<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">

		<div class="col num12" style="min-width: 320px; max-width: 650px; display: table-cell; vertical-align: top; width: 650px;">
		<div style="width:100% !important;">
		<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
		<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
		<tbody>
		<tr style="vertical-align: top;" valign="top">
		<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
		<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="15" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 0px solid transparent; height: 15px;" valign="top" width="100%">
		<tbody>
		<tr style="vertical-align: top;" valign="top">
		<td height="15" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span>
		</td>
		</tr>
		</tbody>
		</table>
		</td>
		</tr>
		</tbody>
		</table>

		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		<div style="background-color:transparent;">
		<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 650px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;">
		<div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">

		<div class="col num12" style="min-width: 320px; max-width: 650px; display: table-cell; vertical-align: top; width: 634px;">
		<div style="background-color:#FFFFFF;width:100% !important;">
		<div style="border-top:0px solid transparent; border-left:8px solid #F1F3F3; border-bottom:0px solid transparent; border-right:8px solid #F1F3F3; padding-top:50px; padding-bottom:5px; padding-right: 50px; padding-left: 50px;">
		<div align="center" class="img-container center fixedwidth" style="padding-right: 0px;padding-left: 0px;">
		<img align="center" alt="Image" border="0" class="center fixedwidth" src="' . base_url('assets/crutech-logo-small.png') .'" style="text-decoration: none; -ms-interpolation-mode: bicubic; border: 0; height: auto; width: 100%; max-width: 100px; display: block;" title="Image" width="100"/>


		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		<div style="background-color:transparent;">
		<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 650px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;">
		<div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
		<div class="col num12" style="min-width: 320px; max-width: 650px; display: table-cell; vertical-align: top; width: 634px;">
		<div style="background-color:#FFFFFF;width:100% !important;">
		<div style="border-top:0px solid transparent; border-left:8px solid #F1F3F3; border-bottom:0px solid transparent; border-right:8px solid #F1F3F3; padding-top:25px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
		<div align="center" class="img-container center autowidth fullwidth" style="padding-right: 0px;padding-left: 0px;">


		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		<div style="background-color:transparent;">
		<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 650px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;">
		<div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
		<div class="col num12" style="min-width: 320px; max-width: 650px; display: table-cell; vertical-align: top; width: 634px;">
		<div style="background-color:#FFFFFF;width:100% !important;">
		<div style="border-top:0px solid transparent; border-left:8px solid #F1F3F3; border-bottom:0px solid transparent; border-right:8px solid #F1F3F3; padding-top:35px; padding-bottom:5px; padding-right: 50px; padding-left: 50px;">

		<div style="color:#CFCFCF;font-family:"Open Sans", "Helvetica Neue", Helvetica, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px; margin-top: 40px; margin-bottom: 30px;">
		<div style="font-size: 12px; line-height: 14px; font-family: "Open Sans", "Helvetica Neue", Helvetica, sans-serif; color: #555555;">
		<p style="font-size: 14px; line-height: 16px; text-align: left; margin: 0;">
		<strong>Hi '. $name .',</strong>
		</p>
		</div>
		</div>

		<div style="text-align: center; margin-bottom: 30px; margin-top: 30px;">
		<!--<div style="text-align: center; color:#66BECD;font-family:"Open Sans", Tahoma, Verdana, Segoe, sans-serif;line-height:120%;padding-top:30px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
		<p style="font-size: 15px; line-height: 19px; text-align: center; color: #555555; font-family: "Open Sans", Tahoma, Verdana, Segoe, sans-serif; margin: 0;">
		<span style="font-size: 19px; text-align: center;">'.$subject.'</span>
		</p>
		</div>-->
		</div>
		<div style="color:#555555;font-family:"Open Sans", "Helvetica Neue", Helvetica, sans-serif;line-height:150%;padding-top:15px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
		<div style="font-size: 10px; line-height: 18px; font-family:"Open Sans", "Helvetica Neue", Helvetica, sans-serif; color: #555555;">
		<p style="font-size: 11px; line-height: 25px; text-align: left; margin: 0;">
		<span style="font-size: 14px; mso-ansi-font-size: 13px;">'.$body.'</span>
		</p>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>

		<div style="background-color:transparent;">
		<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 650px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;">
		<div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
		<div class="col num12" style="min-width: 320px; max-width: 650px; display: table-cell; vertical-align: top; width: 634px;">
		<div style="background-color:#FFFFFF;width:100% !important;">
		<div style="border-top:0px solid transparent; border-left:8px solid #F1F3F3; border-bottom:0px solid transparent; border-right:8px solid #F1F3F3; padding-top:30px; padding-bottom:30px; padding-right: 50px; padding-left: 50px;">
		<div style="color:#555555;font-family:"Open Sans", "Helvetica Neue", Helvetica, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
		<div style="font-size: 12px; line-height: 14px; font-family: "Open Sans", "Helvetica Neue", Helvetica, sans-serif; color: #555555;">
		<p style="font-size: 14px; line-height: 16px; text-align: right; margin: 0;">
		Powered By
		<strong>
		<a href="https://portal.unicross.edu.ng/" rel="noopener" style="text-decoration: underline; color: #66BECD;" target="_blank">
		UNICROSS Support.
		</a>
		</strong>
		</p>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		<div style="background-color:transparent;">
		<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 650px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
		<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
		<div class="col num12" style="min-width: 320px; max-width: 650px; display: table-cell; vertical-align: top; width: 650px;">
		<div style="width:100% !important;">
		<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
		<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
		<tbody>
		<tr style="vertical-align: top;" valign="top">
		<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
		<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="15" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 0px solid transparent; height: 15px;" valign="top" width="100%">
		<tbody>
		<tr style="vertical-align: top;" valign="top">
		<td height="15" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top">
		<span></span>
		</td>
		</tr>
		</tbody>
		</table>
		</td>
		</tr>
		</tbody>
		</table>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</td>
		</tr>
		</tbody>
		</table>
		</body>
		</html>';

		return $template;
	}

}
?>
