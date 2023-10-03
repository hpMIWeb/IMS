<?php

/**
 * @Author : Ronak12
 * @Class : Email
 * @Descriptions: This Class for Email related all Data
 **/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


/*
 * for SendEmail function()
 * $emailArray = array(
                        'Host' => 'HostName',
                        'SSL' => '1 or 0',
                        'Port' => 'You Can Pass Port ',
                        'Userid' => 'Pass UserId',
                        'Password' => 'Password',
                        'Subject' => 'Subject Here',
                        'Body' => 'Body Contain here ',
                        'FromEmailId' => 'From Email ID Here',
                        'FromEmailName' => 'From Email Name',
                        'ReplayEmailId' => Replay Email Id ',
                        'ReplayEmailName' => 'Replay Email Name ',
                        'ToEmailId' => 'Pass Array like  [
                                            [
                                                "Id" => "p@test.com",
                                                "Name" => ""
                                            ],
                                            [
                                                "Id" => "12@test.com",
                                                "Name" => " Test"
                                            ]
                                        ]',
                        'CCEmailId' => 'Pass  Array like [  "p@test.com", "12@test.com" ],
                        'BCCEmailId' => 'Pass Array like [  "p@test.com", "12@test.com" ],
                        'Attachment' =>'Pass  Array like  [
                                            [
                                                "Path" => "path here ",
                                                "Name" => "attachemnt name"
                                            ],
                                            [
                                                "Path" => "path here ",
                                                "Name" => "attachemnt name"
                                            ]
                                        ]',,
                    );
*/


class Email extends Config
{
    public $emailArray;
    public static $emailErrorMsg = 'email not send';

    public function __construct($emailArray)
    {
        global $HEADERS;
        parent::__construct($HEADERS);
    }

    public function SendEmail($emailArray)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->IsSMTP();
            $mail->SMTPDebug = 0;
            $mail->Host = $emailArray['Host'];
            $mail->SMTPAuth = $this->emailSMTPAuth;
            $mail->Username = $emailArray['Userid'];
            $mail->Password = $emailArray['Password'];
            $mail->Port = $emailArray['Port'];
            $mail->CharSet = "UTF-8";
            $mail->SMTPSecure = $this->emailSMTPSecure;

            if($mail->SMTPSecure == 1){
                $mail->SMTPSecure=PHPMailer::ENCRYPTION_SMTPS;
            }else{
                $mail->SMTPSecure=PHPMailer::ENCRYPTION_STARTTLS;
            }
            $mail->IsMail();
            $mail->SetFrom($emailArray['FromEmailId'], $emailArray['FromEmailName']);
            $mail->AddReplyTo($emailArray['FromEmailId'], $emailArray['FromEmailName']);


            if($this->isNotNullOrEmptyOrZero($emailArray['ToEmailId'])){
                foreach($emailArray['ToEmailId'] as $key => $value){
                    if($this->isNotNullOrEmptyOrZero($value['Name'])){
                        $mail->AddAddress(trim($value['Id']));
                    }else{
                        $mail->AddAddress(trim($value['Id']));
                    }
                }
            }


            if($this->isNotNullOrEmptyOrZero($emailArray['CCEmailId'])){
                foreach($emailArray['CCEmailId'] as $value){
                    $mail->addCC(trim($value));
                }
            }

            if($this->isNotNullOrEmptyOrZero($emailArray['BCCEmailId'])){
                foreach($emailArray['BCCEmailId'] as $value){
                    $mail->addBCC(trim($value));
                }
            }

            if($this->isNotNullOrEmptyOrZero($emailArray['Attachment'])){

                foreach ($emailArray['Attachment'] as $AttachmentData)
                {
                    $mail->AddAttachment($AttachmentData['Path']);

                    if(!$this->isNotNullOrEmptyOrZero($AttachmentData['Name']))
                    {
                        $mail->AddAttachment($AttachmentData['Path']);
                    }
                    else
                    {
                        $mail->AddAttachment($AttachmentData['Path'], $AttachmentData['Name']);
                    }
                }
            }

            $mail->isHTML(true);
            $mail->Subject =  $emailArray['Subject'];
            $mail->Body    =  $emailArray['Body'];
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if ($mail->Send()){
                self::$emailErrorMsg = "Sent mail";
                return true;
            } else {
                self::$emailErrorMsg = $mail->ErrorInfo;
                return false;
            }

        } catch (PDOException $e) {
            $this->exceptionData();
            self::$emailErrorMsg =  $e->getMessage($e->getMessage());
            return false;
        }
    }

    public function SendEmail1($to,$body,$subject)
    {

        $mail = new PHPMailer();
        $this->emailTo = $to;
        $this->emailBody = $body;
        $this->emailSubject = $subject;
        $mail->IsSMTP();
        $mail->CharSet = "UTF-8";
        $mail->SMTPSecure = $this->emailSMTPSecure;
        $mail->Host = $this->emailHost;
        $mail->Port = $this->emailPort;
        $mail->Username = $this->emailUsername;
        $mail->Password = $this->emailPassword;
        $mail->SMTPAuth = $this->emailSMTPAuth;

        $mail->From = $this->emailFrom;
        $mail->FromName = $this->emailFromName;
        $mail->AddAddress($this->emailTo);
        $mail->IsHTML(true);
        $mail->Subject = $this->emailSubject;
        $mail->Body = $this->emailBody;
        /*$mail->SMTPOptions=array('ssl'=>array(
            'verify_peer'=>false,
            'verify_peer_name'=>false,
            'allow_self_signed'=>false
        ));*/

        if ($mail->Send()) {
            self::$emailErrorMsg = "Sent mail";
            return true;
        } else {
            self::$emailErrorMsg = $mail->ErrorInfo;
            return false;
        }

    }

}

?>