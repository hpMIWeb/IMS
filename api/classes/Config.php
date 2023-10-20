<?php

/* install firebase jwt composer */

use Firebase\JWT\JWT;

/**
 * @Author : Pinank Soni
 * @Class :CommonConfig
 * @Descriptions: This Class Using Declare For All Variable and Default Config Value
 **/
class Config
{
    /** You Can Set Current Mode (3 option are there at that time only one mode are set )
     * 1) Local = development mode or local config set
     * 2) Server = Live Server Config set
     * 3) TestServer = Test Server Config set
     */

    const currentModeServer = 'Server'; /* Set User Connection*/
    const currentModeServerConfig = array(
        'Local' => array(
            'baseUrl' => 'http://localhost/ims/',
            'masterConnServer' => 'localhost',
            'masterConnUsername' => 'root',
            'masterConnPassword' => '',
            'masterConnDBName' => 'ims'
        ),
        'Server' => array(
             'baseUrl' => 'https://miwebsolution.com/ims/',
            'masterConnServer' => 'localhost',
            'masterConnUsername' => 'husfilms_IMS',
            'masterConnPassword' => 'Um@ng_IMS@2023',
            'masterConnDBName' => 'husfilms_IMS'
        )
    );

    /* Set Master Urls */
    const baseUrl = self::currentModeServerConfig[self::currentModeServer]['baseUrl'];
    const imsApiKey = "IMS";
    protected static $masterConn;
    protected static $cmConn;
    protected static $notSet = "NotSet";
    protected static $responseCode = "0"; /* 0-no record, 1-record, 2-force logout */
    protected static $message = "Fail"; /* response message */
    protected static $result = ""; /* response record */
    protected static $companyMasterConnServer = "";/* response all data */

    /* firebase fcm */
    protected static $companyMasterConnUsername = "";
    protected static $companyMasterConnPassword = "";

    /* base urls */
    protected static $companyMasterConnDBName = "";
    protected static $companyMasterId = "0";
    protected static $companyMasterKey = "";
    protected static $callFrom = "";


    /* Owner Database Setting */
    public $IMSFileElement = 'IMSFileElement';
    public $deleteAttachmentArray = array();
    protected $data = array();
    protected $fcmUrl = "";

    /* Company Setting */
    protected $fcmServerKey = ""; //key of firebase
    protected $baseUrlAttachment = self::baseUrl . "assets/attachment/";
    protected $baseUrlProject = self::baseUrl . "project";
    protected $masterConnServer = self::currentModeServerConfig[self::currentModeServer]['masterConnServer'];
    protected $masterConnUsername = self::currentModeServerConfig[self::currentModeServer]['masterConnUsername'];
    protected $masterConnPassword = self::currentModeServerConfig[self::currentModeServer]['masterConnPassword'];
    protected $masterConnDBName = self::currentModeServerConfig[self::currentModeServer]['masterConnDBName'];
    protected $apiKey;
    protected $accessToken;
    protected $userMasterId;
    protected $userMasterDeviceType;
    protected $webLoginDeviceId;

    /* Send Mail From Server Side Config*/
    protected $userMasterDeviceId;
    protected $userMasterDeviceToken;
    protected $systemProject;
    protected $systemModuleFunction;
    protected $emailSMTPSecure = 'ssl';
    protected $emailHost = 'smtp.gmail.com';
    protected $emailPort = '465';
    protected $emailUsername = 'rs.pinanksoni@gmail.com';

    /* project related */
    protected $emailPassword = 'tdqcbljuebdadjry';
    protected $emailSMTPAuth = true;
    protected $emailFrom = 'rs.pinanksoni@gmail.com';
    protected $emailFromName = 'IMS';
    protected $actionType = "";
    protected $action = "";
    protected $actionTypeId = "0";

    /* Set Listing Last limit */
    protected $isDetails = false;
    protected $dataLogic = "";
    protected $arrayStatus = "";

    /* financial setup */
    protected $arrayType = "";
    protected $skipData = 0;

    /* Attachment update */
    protected $takeData = 50;
    protected $appendQueryLimit = "";
    protected $financialDay = "01";

    /* Call From API*/
    protected $financialMonth = "04";
    protected $isAttachmentUpdate = false;

    /* IMS API Messages */
    protected $APIMessage = array(
        'ERR_APIKEY' => "API KEY is not valid",
        'ERR_CONN' => "Connection not found, Please try again!",
        'ERR_INVALID' => "Invalid error, Please try again!",
        'ERR_INVALID_VALUE' => "Invalid value!, Please try again!",
        'ERR_MISSING_HEADERS_PARAMS' => "Missing Headers parameter!",
        'ERR_MISSING_SYSTEM_PARAMS' => "Missing systemProject or systemModuleFunction parameter!",
        'ERR_MISSING_BODY_PARAMS' => "Missing body parameter!",
        'ERR_INVALID_SYSTEM_PROJECT' => "Invalid systemProject",
        'ERR_INVALID_SYSTEM_MODULE_FUNCTION' => "Invalid systemModuleFunction",
        'ERR_COMPANY_MASTER' => "Company or Shop not found, Please try again!",
        'ERR_QUERY' => "Fail",
        'ERR_INVALID_TOKEN' => "Yor token is invalid please try again.",
        'ERR_QUERY_FAIL' => "Something wrong please try again.",
    );

    protected $ignoreSMF = ['login', 'refreshToken', 'forgotPassword', 'resetPassword'];
    protected $isMaster = false;
    protected $isAdmin = false;
    public function __construct($HEADERS)
    {



        $this->systemProject = isset($_POST['systemProject']) ? $_POST['systemProject'] : self::$notSet;
        $this->systemModuleFunction = isset($_POST['systemModuleFunction']) ? $_POST['systemModuleFunction'] : self::$notSet;

        $this->skipData = (!empty($this->handleSpecialCharacters($_POST['skipData']))) ? $this->handleSpecialCharacters($_POST['skipData']) : $this->skipData;
        $this->takeData = (!empty($this->handleSpecialCharacters($_POST['takeData']))) ? $this->handleSpecialCharacters($_POST['takeData']) : $this->takeData;
        $this->appendQueryLimit = (!empty($this->handleSpecialCharacters($_POST['isLimitData'])) && $this->handleSpecialCharacters($_POST['isLimitData']) == 'true') ? (' LIMIT ' . $this->skipData . ',' . $this->takeData) : $this->appendQueryLimit;

        $this->actionType = $this->handleSpecialCharacters($_POST['actionType']);
        $this->action = $this->handleSpecialCharacters($_POST['action']);
        $this->actionTypeId = $this->handleSpecialCharacters($_POST['actionTypeId']);
        $this->isDetails = (!empty($this->handleSpecialCharacters($_POST['isDetails'])) && $this->handleSpecialCharacters($_POST['isDetails']) == 'true') ? true : $this->isDetails;
        $this->dataLogic = $this->handleSpecialCharacters($_POST['dataLogic']);
        $this->arrayStatus = json_decode($_POST['arrayStatus'], true);
        $this->arrayType = json_decode($_POST['arrayType'], true);
        $this->deleteAttachmentArray = json_decode($_POST['deleteAttachmentArray'], true);


        if (empty($_FILES['IMSFileElement'])) {
            $this->isAttachmentUpdate = false;
        } else {
            if ($this->isNotNullOrEmptyOrZero($_FILES['IMSFileElement']['tmp_name'][0])) {
                $this->isAttachmentUpdate = true;
            } else {
                $this->isAttachmentUpdate = false;
            }
        }


        if (!in_array($this->systemModuleFunction, $this->ignoreSMF)) {
            $this->verifiedJwtToken($HEADERS);
        }
    }

    /* include CommonFunctions */
    use CommonFunction;
    use ProjectCommon;


    /* Company or Shop Database Connection */

    /**
     * @Author:Pinank Soni
     * @Description: Verified token
     * @param $jwt pass token
     * @return string
     */
    protected function verifiedJwtToken($HEADERS, $refreshCheck = false)
    {
        global $publicKey;
        try {
            $this->accessToken = isset($HEADERS['Authorization']) ? $HEADERS['Authorization'] : '';
            try {
                $getPayLoadData = (array)JWT::decode($this->accessToken, $publicKey, ['RS256']);
            } catch (Exception  $e) {
                return false;
            }

            if ($refreshCheck) {
                if (!$getPayLoadData['iat'] >= time()) {
                    return false;
                }
            }

            $this->userMasterId = $getPayLoadData['userMasterId'];
            $this->userMasterDeviceType = $getPayLoadData['userMasterDeviceType'];
            $this->userMasterDeviceId = $getPayLoadData['userMasterDeviceId'];
            $this->userMasterDeviceToken = $getPayLoadData['userMasterDeviceToken'];
            $this->webLoginDeviceId = $getPayLoadData['loginWebId'];

            return true;
        } catch (Exception  $e) {
            return false;
        }
    }

    public function connCMDatabase($companyMasterConnServer, $companyMasterConnUsername, $companyMasterConnPassword, $companyMasterConnDBName)
    {
        try {

            if ($this->isNotNullOrEmptyOrZero($companyMasterConnServer) && $this->isNotNullOrEmptyOrZero($companyMasterConnUsername) && $this->isNotNullOrEmptyOrZero($companyMasterConnDBName)) {
                $this::$cmConn = new PDO(
                    "mysql:host=$companyMasterConnServer;dbname=$companyMasterConnDBName",
                    $companyMasterConnUsername,
                    $companyMasterConnPassword,
                    array(
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                        PDO::ATTR_ERRMODE,
                        PDO::ERRMODE_EXCEPTION
                    )
                );

                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            $this::$message = $this->APIMessage['ERR_CONN'];
            return false;
        }
    }

    public function getConfigVariable($configVaribleName)
    {
        return $this->$configVaribleName;
    }

    public function setConfigVariable($configVariableName, $updateValue)
    {
        return $this->$configVariableName = $updateValue;
    }

    public function returnAPIData()
    {
        return json_encode(array('responseCode' => $this::$responseCode, 'message' => $this::$message, 'result' => $this::$result));
    }

    /**
     * @Author:Pinank Soni
     * @Description: Generate  Token
     * @param $payload : information
     * @return mixed
     */
    protected function generateJwtToken($payload)
    {

        global $privateKey;
        return JWT::encode($payload, $privateKey, 'RS256');
    }

    /**
     * @Author:Pinank Soni
     * @Description: Set Token Time
     * @param $issuedAt = timestamp
     * @param $value = value pass
     * @param $type = type pass second,minutes,hours,days
     * @return float|int
     * @return float|int
     */
    protected function setJwtTokenExpireTime($issuedAt, $value, $type)
    {
        /**
         * $issuedAt = time(); // current time
         *  jwt valid for 60 days (60 seconds * 60 minutes * 24 hours * 60 days)
         * $expirationTime = $issuedAt + 60 * 60 * 24 * 60;
         */

        switch ($type) {
            case 'seconds':
                $expirationTime = $issuedAt + $value;
                break;
            case 'minutes':
                $expirationTime = $issuedAt + 60 * $value;
                break;
            case 'hours':
                $expirationTime = $issuedAt + 60 * 60 * $value;
                break;
            case 'days':
                $expirationTime = $issuedAt + 60 * 60 * 24 * $value;
                break;
            default:
                $expirationTime = $issuedAt;
        }
        return $expirationTime;
    }

    protected function successData($string = "Success")
    {
        $this::$responseCode = "1";
        $this::$message = $string;
    }

    protected function noData($string = "No record")
    {
        $this::$responseCode = "0";
        $this::$message = $string;
        $this::$result = "";
    }

    protected function failureData($string = "Fail")
    {
        $this::$responseCode = "0";
        $this::$message = $string;
        $this::$result = "";
    }

    protected function forceLogout($string = "Something went wrong, Please login again!")
    {
        $this::$responseCode = "2";
        $this::$message = $string;
        $this::$result = "";
    }

    protected function exceptionData($string = "Exception error!, Please try again!")
    {
        $this::$responseCode = "0";
        $this::$message = $string;
        $this::$result = "";
    }
}