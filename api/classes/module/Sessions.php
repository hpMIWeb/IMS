<?php

/**
 * @author : Pinank Soni
 * @class :Sessions
 * @desc: This class for using session related data
 **/
class Sessions extends Config
{
    public function __construct($HEADERS)
    {
        parent::__construct($HEADERS);
    }

    public function refreshToken()
    {
        $tokenValidityValue = $this->handleSpecialCharacters(($_POST['tokenValidityValue']));
        $tokenValidityType = $this->handleSpecialCharacters(($_POST['tokenValidityType']));

        $issuedAt = time();
        $ATExpireToken = $this->setJwtTokenExpireTime($issuedAt, $tokenValidityValue, $tokenValidityType);
        $refreshIssuedAt = $ATExpireToken - 120; /* Access Token Expire before 2 minute ago refresh token start */

        $isValidToken = $this->verifiedJwtToken($this->accessToken, true);
        if (!$isValidToken) {
            $this->successData();
            $this::$result = array(
                'AT' => $this->generateJwtToken(
                    [
                        'companyMasterKey' => self::$companyMasterKey,
                        'userMasterId' => $this->userMasterId,
                        'userMasterDeviceType' => $this->userMasterDeviceType,
                        'userMasterDeviceId' => $this->userMasterDeviceId,
                        'userMasterDeviceToken' => $this->userMasterDeviceToken,
                        'iat' => $issuedAt,
                        'exp' => $ATExpireToken,
                        'isMaster' => $this->isMaster,
                    ]
                ),
                'RT' => $this->generateJwtToken(
                    [
                        'companyMasterKey' => self::$companyMasterKey,
                        'userMasterId' => $this->userMasterId,
                        'userMasterDeviceType' => $this->userMasterDeviceType,
                        'userMasterDeviceId' => $this->userMasterDeviceId,
                        'userMasterDeviceToken' => $this->userMasterDeviceToken,
                        'iat' => $refreshIssuedAt,
                        'exp' => $this->setJwtTokenExpireTime($refreshIssuedAt, $tokenValidityValue, $tokenValidityType),
                        'isMaster' => $this->isMaster,
                    ]
                )
            );
        } else {
            $this->forceLogout("Token not valid");
        }
    }

    public function login()
    {
        try {

            $companyMasterKey = $this->handleSpecialCharacters(base64_decode($_POST['companyMasterKey']));
            $userMasterUsername = $this->handleSpecialCharacters(base64_decode($_POST['userMasterUsername']));
            $userMasterPassword = $this->handleSpecialCharacters(base64_decode($_POST['userMasterPassword']));
            $userMasterDeviceType = $this->handleSpecialCharacters(($_POST['userMasterDeviceType']));
            $userMasterDeviceId = $this->handleSpecialCharacters(($_POST['userMasterDeviceId']));
            $userMasterDeviceToken = $this->handleSpecialCharacters(($_POST['userMasterDeviceToken']));
            $tokenValidityValue = $this->handleSpecialCharacters(($_POST['tokenValidityValue']));
            $tokenValidityType = $this->handleSpecialCharacters(($_POST['tokenValidityType']));


            $queryUser = $this::$masterConn->prepare("SELECT * FROM user_master WHERE BINARY email ='$userMasterUsername' AND BINARY password = '$userMasterPassword' LIMIT 0,1");


            // var_dump($queryUser);
            if ($queryUser->execute()) {

                if ($queryUser->rowCount() > 0) {
                    foreach ($queryUser->fetchAll(PDO::FETCH_ASSOC) as $row) {
                        if ($this->equals($row['user_status'], $this->getArrayIdByName($this->arrayAllStatus, "Active"))) {
                            $issuedAt = time();
                            $ATExpireToken = $this->setJwtTokenExpireTime($issuedAt, $tokenValidityValue, $tokenValidityType);
                            $refreshIssuedAt = $ATExpireToken - 120; // Access Token Expire before 2 minute ago refresh token start

                            $loginWebId = md5(uniqid(rand(), true));
                            $queryUser = $this::$masterConn->prepare("UPDATE user_master SET login_status = '1' WHERE id ='" . $row['id'] . "' ");
                            $queryUser->execute();

                            $this->successData();
                            $this::$result = array(
                                'AT' => $this->generateJwtToken(
                                    [
                                        'companyMasterKey' => $companyMasterKey,
                                        'userMasterId' => $row['id'],
                                        'userMasterDeviceType' => $userMasterDeviceType,
                                        'userMasterDeviceId' => $userMasterDeviceId,
                                        'userMasterDeviceToken' => $userMasterDeviceToken,
                                        'callFrom' => 'system',
                                        'iat' => $issuedAt,
                                        'exp' => $ATExpireToken,
                                        'loginWebId' => $loginWebId,
                                        'roleId' => $row['role'],
                                        'role' => $this->getArrayNameById($this->arrayAllRole, $row['role'])

                                    ]
                                ),
                                'RT' => $this->generateJwtToken(
                                    [
                                        'companyMasterKey' => $companyMasterKey,
                                        'userMasterId' => $row['id'],
                                        'userMasterDeviceType' => $userMasterDeviceType,
                                        'userMasterDeviceId' => $userMasterDeviceId,
                                        'userMasterDeviceToken' => $userMasterDeviceToken,
                                        'callFrom' => 'system',
                                        'iat' => $refreshIssuedAt,
                                        'exp' => $this->setJwtTokenExpireTime($refreshIssuedAt, $tokenValidityValue, $tokenValidityType),
                                        'loginWebId' => $loginWebId,
                                        'roleId' => $row['role'],
                                        'role' => $this->getArrayNameById($this->arrayAllRole, $row['role'])
                                    ]
                                ),
                                'roleId' => $row['role'],
                                'role' => $this->getArrayNameById($this->arrayAllRole, $row['role'])
                            );
                        } else {
                            $this->noData("User blocked, Please contact to admin!");
                        }
                    }
                } else {
                    $this->noData("Invalid username or password");
                }
            } else {
                $this->failureData();
            }
        } catch (PDOException $e) {
            $this->exceptionData();
        }
    }

    public function loginAuth()
    {
        try {

            $userMasterDeviceToken = $this->handleSpecialCharacters(($_POST['userMasterDeviceToken']));

            $queryUser = $this::$masterConn->prepare("SELECT * FROM user_master WHERE id IN (" . $this->userMasterId . ") LIMIT 0,1");
            if ($queryUser->execute()) {
                if ($queryUser->rowCount() > 0) {
                    foreach ($queryUser->fetchAll(PDO::FETCH_ASSOC) as $row) {

                        $this->data = array(
                            'uniqueId' => $this->convertNullToEmptyString($row['id']),
                            'userMasterId' => $row['id'],
                            'userMasterName' => $row['name'],
                            'userMasterEmail' => $row['email'],
                            'userMasterMobile' => $row['mobile'],
                            'userMasterUsername' => $row['username'],
                        );
                        if ($this->equals($row['status'], $this->getArrayIdByName($this->arrayAllStatus, 'Active'))) {

                            $appendQuery = "UPDATE user_master SET login_status = '1' WHERE id IN (" . $row['id'] . ")";
                            $queryUpdate = $this::$masterConn->prepare($appendQuery);
                            if ($queryUpdate->execute()) {
                                $this->successData();
                                $this::$result = array('userMaster' => $this->data);
                            } else {
                                $this->failureData();
                            }
                        } else {
                            $appendQuery = "UPDATE user_master SET login_status = '0' WHERE id IN (" . $row['id'] . ")";
                            $queryUpdate = $this::$masterConn->prepare($appendQuery);
                            if ($queryUpdate->execute()) {
                                $this->noData("User blocked, Please contact to admin!");
                            } else {
                                $this->failureData();
                            }
                        }
                    }
                } else {
                    $this->noData("Invalid username or password");
                }
            } else {
                $this->failureData();
            }
        } catch (PDOException $e) {
            $this->exceptionData();
        }
    }

    public function logout()
    {
        try {
            $appendQuery = "UPDATE user_master SET web_device_token = '' WHERE id IN (" . $this->userMasterId . ")";
            if ($this->equals($this->userMasterDeviceType, "android")) {
                $appendQuery = "UPDATE user_master SET deviceid = '', android_device_token = '', ios_device_token = '' WHERE id IN (" . $this->userMasterId . ")";
            } else if ($this->equals($this->userMasterDeviceType, "ios")) {
                $appendQuery = "UPDATE user_master SET deviceid = '', android_device_token = '', ios_device_token = '' WHERE id IN (" . $this->userMasterId . ")";
            }
            $queryUpdate = $this::$masterConn->prepare($appendQuery);
            if ($queryUpdate->execute()) {
                if ($queryUpdate->rowCount() > 0) {
                    $this->successData("Logout");
                } else {
                    $this->noData("Invalid, Please try again!");
                }
            } else {
                $this->failureData();
            }
        } catch (PDOException $e) {
            $this->exceptionData();
        }
    }

    public function forgotPassword()
    {
        try {


            $userMasterEmailMobile = $this->handleSpecialCharacters($_POST['userMasterEmailMobile']);
            $userOTP = strval(mt_rand(100000, 999999));

            $queryCheckUser = $this::$masterConn->prepare("SELECT * FROM user_master WHERE email IN ('$userMasterEmailMobile') OR mobile IN ('$userMasterEmailMobile') LIMIT 0,1");
            if ($queryCheckUser->execute()) {
                if ($queryCheckUser->rowCount() > 0) {
                    foreach ($queryCheckUser->fetchAll(PDO::FETCH_ASSOC) as $row) {
                        $userMasterEmailArray = array();
                        if ($this->equals($row['status'], $this->arrayAllStatus['sessions']['user']['enable'])) {
                            $userMasterEmail = $row['email'];
                            $userMasterMobile = $row['mobile'];


                            if ($this->equals($userMasterEmailMobile, $userMasterEmail)) {
                                $subject = "Reset Password";
                                $body = "Dear " . $row['name'] . ",<br><br>This is your IMS OTP: " . $userOTP . " (This OTP is used for only one time.)";
                                $userMasterEmailArray[] = array(
                                    'Id' => $userMasterEmail,
                                    'Name' => ''
                                );

                                $emailArray = array(
                                    'Host' => $this->emailHost,
                                    'SSL' => 1,
                                    'Port' => $this->emailPort,
                                    'Userid' => $this->emailUsername,
                                    'Password' => $this->emailPassword,
                                    'Subject' => $subject,
                                    'Body' => $body,
                                    'FromEmailId' => $this->emailFrom,
                                    'FromEmailName' => $this->emailFromName,
                                    'ReplayEmailId' => '',
                                    'ReplayEmailName' => '',
                                    'ToEmailId' => $userMasterEmailArray,
                                    'CCEmailId' => [],
                                    'BCCEmailId' => [],
                                    'Attachment' => '',
                                );

                                $emailInstance = new Email($emailArray);
                                if ($emailInstance->SendEmail($emailArray)) {
                                    $this->data = array('forgotType' => "EMAIL", 'otp' => $userOTP);
                                    $this->successData("OTP sent!");
                                    $this::$result = array('verification' => $this->data);
                                } else {
                                    $this->noData(Email::$emailErrorMsg);
                                }
                            } else if ($this->equals($userMasterEmailMobile, $userMasterMobile)) {
                                $this->data = array('forgotType' => "PHONE", 'otp' => $userOTP);
                                $this->successData("OTP sent!");
                                $this::$result = array('verification' => $this->data);
                            } else {
                                $this->failureData('Invalid!');
                            }
                        } else {
                            $this->noData("User blocked");
                        }
                    }
                } else {
                    $this->noData('User not found!');
                }
            } else {
                $this->failureData();
            }
        } catch (PDOException $e) {
            $this->exceptionData();
        }
    }

    public function resetPassword()
    {
        try {

            $userMasterEmailMobile = $this->handleSpecialCharacters($_POST['userMasterEmailMobile']);
            $userMasterPassword = $this->handleSpecialCharacters(base64_decode($_POST['userMasterPassword']));

            $queryUpdate = $this::$masterConn->prepare("UPDATE user_master SET password = '$userMasterPassword', deviceid='" . $this->userMasterDeviceId . "' WHERE email IN ('$userMasterEmailMobile') OR mobile IN ('$userMasterEmailMobile')");
            if ($queryUpdate->execute()) {
                if ($queryUpdate->rowCount() > 0) {
                    $this->successData('Your password reset successfully!');
                } else {
                    $this->noData("Password does not reset, Please try again!");
                }
            } else {
                $this->failureData();
            }
        } catch (PDOException $e) {
            $this->exceptionData();
        }
    }

    public function changePassword()
    {
        try {
            $userMasterCurrentPassword = $this->handleSpecialCharacters(base64_decode($_POST['userMasterCurrentPassword']));
            $userMasterNewPassword = $this->handleSpecialCharacters(base64_decode($_POST['userMasterNewPassword']));

            $query = $this::$masterConn->prepare("SELECT * FROM user_master WHERE id IN (" . $this->userMasterId . ") AND BINARY password IN ('$userMasterCurrentPassword')");
            if ($query->execute()) {
                if ($query->rowCount() > 0) {
                    $queryUpdate = $this::$masterConn->prepare("UPDATE user_master SET password = '$userMasterNewPassword', deviceid = '" . $this->userMasterDeviceId . "' WHERE id IN (" . $this->userMasterId . ")");
                    if ($queryUpdate->execute()) {
                        if ($queryUpdate->rowCount() > 0) {
                            $this->successData("Your password changed successfully!");
                        } else {
                            $this->noData("Current password and New password both are same, Please try another password!");
                        }
                    } else {
                        $this->failureData();
                    }
                } else {
                    $this->noData("Current password does not match, Please try again!");
                }
            } else {
                $this->failureData();
            }
        } catch (PDOException $e) {
            $this->exceptionData();
        }
    }

    public function changeUserMasterProfileImage()
    {
        try {

            $queryUser = $this::$masterConn->prepare("SELECT * FROM user_master WHERE id IN (" . $this->userMasterId . ")");
            if ($queryUser->execute()) {
                if ($queryUser->rowCount() > 0) {
                    foreach ($queryUser->fetchAll(PDO::FETCH_ASSOC) as $row) {
                        $this->deleteAttachment($this->filePathStructure['user_image'], $row['image']);
                        $userMasterId = $row['id'];
                        if ($this->isAttachmentUpdate) {
                            $attachmentData = $this->uploadAttachment($this->filePathStructure['user_image'], $this->filePrefixName['user_profile']);
                            $fileName = '';
                            if ($this->isNotNullOrEmptyOrZero($attachmentData)) {
                                foreach ($attachmentData as $value) {
                                    $fileName = $value['fileName'];
                                }
                            }
                            $queryUpdate = $this::$masterConn->prepare("UPDATE user_master SET image = '$fileName' WHERE id IN ($userMasterId)");
                            $queryUpdate->execute();
                        }

                        $queryUserData = $this::$masterConn->prepare("SELECT * FROM user_master WHERE id IN ($userMasterId)");
                        if ($queryUserData->execute()) {
                            if ($queryUserData->rowCount() > 0) {
                                $this->successData("Profile changed");
                                foreach ($queryUserData->fetchAll(PDO::FETCH_ASSOC) as $rowUserData) {
                                    //   $this->data = array('userMasterProfileImageUrl' => $this->generateUserProfileUrl($rowUserData['image']));
                                }
                                $this::$result = array('userMaster' => $this->data);
                            }
                        } else {
                            $this->failureData();
                        }
                    }
                } else {
                    $this->noData('User not found!');
                }
            } else {
                $this->failureData();
            }
        } catch (PDOException $e) {
            $this->exceptionData();
        }
    }

    public function checkUserMasterEmailMobile()
    {
        try {
            $action = $this->handleSpecialCharacters($_POST['action']);
            $userMasterEmail = $this->handleSpecialCharacters($_POST['userMasterEmail']);
            $userMasterMobile = $this->handleSpecialCharacters($_POST['userMasterMobile']);

            if ($this->equals($action, 'checkEmailMobile')) {
                $queryEmail = $this::$masterConn->prepare("SELECT * FROM user_master WHERE id NOT IN (" . $this->userMasterId . ") AND email IN ('$userMasterEmail')");
                if ($queryEmail->execute()) {
                    if ($queryEmail->rowCount() > 0) {
                        $this->noData("Email already exist, Please try another email");
                    } else {
                        $queryMobile = $this::$masterConn->prepare("SELECT * FROM user_master WHERE id NOT IN (" . $this->userMasterId . ") AND mobile IN ('$userMasterMobile')");
                        if ($queryMobile->execute()) {
                            if ($queryMobile->rowCount() > 0) {
                                $this->noData("Mobile number already exist, Please try another mobile number");
                            } else {
                                $this->successData();
                            }
                        } else {
                            $this->failureData();
                        }
                    }
                } else {
                    $this->failureData();
                }
            } else if ($this->equals($action, 'checkEmail')) {
                $queryEmail = $this::$masterConn->prepare("SELECT * FROM user_master WHERE id NOT IN (" . $this->userMasterId . ") AND email IN ('$userMasterEmail')");
                if ($queryEmail->execute()) {
                    if ($queryEmail->rowCount() > 0) {
                        $this->noData("Email already exist, Please try another email");
                    } else {
                        $this->successData();
                    }
                } else {
                    $this->failureData();
                }
            } else if ($this->equals($action, 'checkMobile')) {
                $queryMobile = $this::$masterConn->prepare("SELECT * FROM user_master WHERE id NOT IN (" . $this->userMasterId . ") AND mobile IN ('$userMasterMobile')");
                if ($queryMobile->execute()) {
                    if ($queryMobile->rowCount() > 0) {
                        $this->noData("Mobile number already exist, Please try another mobile number");
                    } else {
                        $this->successData();
                    }
                } else {
                    $this->failureData();
                }
            }
        } catch (PDOException $e) {
            $this->exceptionData();
        }
    }

    public function sendOTPToEmailForForgot()
    {
        try {
            $userMasterEmail = $this->handleSpecialCharacters($_POST['userMasterEmail']);
            $otp = strval(mt_rand(100000, 999999));
            $subject = "Reset Password";
            $body = "This is your IMS OTP: " . $otp . " (This OTP is used for only one time.)";
            $emailInstance = new Email(array());
            if ($emailInstance->SendEmail1($userMasterEmail, $body, $subject)) {
                $this->data = array('forgotType' => "EMAIL", 'otp' => $otp);
                $this->successData("OTP sent!");
                $this::$result = array('verification' => $this->data);
            } else {
                $this->noData(Email::$emailErrorMsg);
            }
        } catch (PDOException $e) {
            $this->exceptionData();
        }
    }

    public function updateUserMasterEmailMobile()
    {
        try {
            $userMasterEmail = $this->handleSpecialCharacters($_POST['userMasterEmail']);
            $userMasterMobile = $this->handleSpecialCharacters($_POST['userMasterMobile']);

            $queryUpdate = $this::$masterConn->prepare("UPDATE user_master SET email = '$userMasterEmail', mobile = '$userMasterMobile' WHERE id IN (" . $this->userMasterId . ")");
            if ($queryUpdate->execute()) {
                if ($queryUpdate->rowCount() > 0) {
                    $this->successData("Update successfully!");
                } else {
                    $this->noData("Already updated!");
                }
            } else {
                $this->failureData();
            }
        } catch (PDOException $e) {
            $this->exceptionData();
        }
    }

    public function updateUserMasterData()
    {
        try {
            $userMasterName = $this->handleSpecialCharacters($_POST['userMasterName']);
            $userMasterDOB = $this->handleSpecialCharacters($this->formatDateTime('Y-m-d', $_POST['userMasterDOB']));
            $userMasterDOA = $this->handleSpecialCharacters($this->formatDateTime('Y-m-d', $_POST['userMasterDOA']));
            $userMasterDesignation = $this->handleSpecialCharacters($_POST['userMasterDesignation']);

            $queryUpdate = $this::$masterConn->prepare("UPDATE user_master SET name = '$userMasterName', dob = '$userMasterDOB', anniversary = '$userMasterDOA', designation = '$userMasterDesignation' WHERE id IN (" . $this->userMasterId . ")");
            if ($queryUpdate->execute()) {
                if ($queryUpdate->rowCount() > 0) {
                    $this->successData("Update successfully!");
                } else {
                    $this->noData("Already updated!");
                }
            } else {
                $this->failureData();
            }
        } catch (PDOException $e) {
            $this->exceptionData();
        }
    }

    public function userRegister()
    {
        try {
        } catch (PDOException $e) {
            $this->exceptionData();
        }
    }


    public function getUserDetails()
    {
        try {

            $userId = $this->handleSpecialCharacters($_POST['userId']);

            $appendQuery = '';

            if ($this->isNotNullOrEmptyOrZero($userId)) {
                $appendQuery = " WHERE id = '$userId' ";
            }
            $query = $this::$masterConn->prepare("SELECT * FROM `user_master` $appendQuery ORDER BY id DESC ");

            if ($query->execute()) {
                if ($query->rowCount() > 0) {
                    $this->successData();
                    foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $row) {
                        $this->data[] = array(
                            'id' => $this->convertNullOrEmptyStringToZero($row['id']),

                            'firstName' => $this->convertNullToEmptyString($row['first_name']),
                            'lastName' => $this->convertNullToEmptyString($row['last_name']),
                            'user_name' => $this->convertNullToEmptyString($row['user_name']),
                            'address' => $this->convertNullToEmptyString($row['address']),
                            'state' => $this->convertNullToEmptyString($row['state']),
                            'password' => $this->convertNullToEmptyString($row['passsword']),
                            'email' => $this->convertNullToEmptyString($row['email']),
                            'mobile' => $this->convertNullToEmptyString($row['mobile']),
                        );
                    }
                    $this::$result = array('user' => $this->data);
                } else {
                    $this->noData("No any users");
                }
            } else {
                $this->failureData();
            }
        } catch (PDOException $e) {
            $this->exceptionData();
        }
    }

    public function addUpdateCreateUser()
    {

        try {

            $firstName = $this->handleSpecialCharacters($_POST['firstName']);
            $lastName = $this->handleSpecialCharacters($_POST['lastName']);
            $userName = $this->handleSpecialCharacters($_POST['userName']);
            $address = $this->handleSpecialCharacters($_POST['address']);
            $state = $this->handleSpecialCharacters($_POST['state']);
            $password = $this->handleSpecialCharacters($_POST['password']);
            $mobile = $this->handleSpecialCharacters($_POST['mobile']);
            $email = $this->handleSpecialCharacters($_POST['email']);
            $userId = $this->handleSpecialCharacters($_POST['userId']);

            if ($this->equals($this->action, $this->arrayAllAction['add'])) {
                $query = $this::$masterConn->prepare("INSERT INTO `user_master`
                 (`first_name`,`last_name`,`username`,`address`,`state`,`password`,`mobile`,`email`,`created_by`) 
                VALUES ('$firstName', '$lastName','$userName','$address','$state','$password','$mobile', '$email','" . $this->userMasterId . "'); ");
            } elseif ($this->isNotNullOrEmptyOrZero($userId) && $this->equals($this->action, $this->arrayAllAction['edit'])) {
                $query = $this::$masterConn->prepare("UPDATE `user_master` SET `first_name` = '$firstName',`last_name`='$lastName',`user_name`='$userName',`address`='$address',`state`='$state',`password`='$password',`mobile`='$mobile',`email`='$email',`modified_by` = '" . $this->userMasterId . "' WHERE `id` ='$userId'");
            }



            if ($query->execute()) {
                if ($query->rowCount() > 0) {
                    if ($this->equals($this->action, $this->arrayAllAction['add'])) {
                        $this->successData("User Add successfully.");
                    } elseif ($this->equals($this->action, $this->arrayAllAction['edit'])) {
                        $this->successData("User Update successfully.");
                    }
                } else {
                    $this->failureData($this->APIMessage['ERR_QUERY_FAIL']);
                }
            } else {
                $this->failureData($this->APIMessage['ERR_QUERY_FAIL']);
            }
        } catch (PDOException $e) {
            $this->exceptionData($e);
        }
    }

    public function deleteUsers()
    {

        try {
            $userId = $this->handleSpecialCharacters($_POST['userId']);

            if ($this->isNotNullOrEmptyOrZero($userId)) {

                $query = $this::$masterConn->prepare("DELETE FROM `user_master` WHERE id = '$userId'");
                if ($query->execute()) {
                    if ($query->rowCount() > 0) {
                        $this->successData("User Delete successfully.");
                    }
                } else {
                    $this->failureData($this->APIMessage['ERR_QUERY_FAIL']);
                }
            }
        } catch (PDOException $e) {
            $this->exceptionData();
        }
    }
}
