<?php

/**
 * @Author : Pinank Soni
 * @Class :APIBase
 * @Descriptions: This Class Using For Authentication, Check APIKey,Db Connection After Call Next Method or class for Requiment
 **/

class APIBase extends Config
{
    public function __construct($HEADERS)
    {

        parent::__construct($HEADERS);
        /* Check All Param && Check IMS Key  Check  && Check DatabaseConnection*/
        if ($this->existSystemProjectAndSystemModuleFunction()) {


            if ((!in_array($this->systemModuleFunction, $this->ignoreSMF))) {

                if ($this->checkAPIAuth($HEADERS) === true) {
                    if ($this->checkDBConnection()) {
                        $this->executeMainFunction($HEADERS);
                    } else {
                        $this::$message = $this->APIMessage['ERR_CONN'];
                    }
                } else {
                    $this->forceLogout("Token not valid");
                }
            } else if ($this->systemModuleFunction == 'refreshToken') {  // By Pass Request For Some Special call
                $this->executeMainFunction($HEADERS);
            } else { /* other case need Only CompanyMaster Key Because Of Create a DB Connection*/
                $this->checkDBConnection();
                $this->executeMainFunction($HEADERS);
            }
        }
    }

    /* check systemCall and systemFunction */
    public  function existSystemProjectAndSystemModuleFunction()
    {
        /*Check Class Exits Or Not*/


        if (class_exists($this->systemProject)) {
            /*Check method  Exits Or Not*/
            if (method_exists($this->systemProject, $this->systemModuleFunction)) {
                return true;
            } else {
                $this::$message = $this->APIMessage['HFH_INVALID_SYSTEM_MODULE_FUNCTION'];
            }
        } else {
            $this::$message = $this->APIMessage['HFH_INVALID_SYSTEM_PROJECT'];
        }
        return false;
    }

    /* Check API Authentication */
    private function checkAPIAuth($HEADERS)
    {
        if ($this->verifiedJwtToken($HEADERS) === false) {
            $this->forceLogout("Token not valid");
            return false;
        }
        return true;
    }

    /* @Description: Conection For Master Admin , User Login     *
     * Handle Also Special CHARACTER for any request for Database .
     * Handle utf8     *
     * */
    public function checkDBConnection()
    {
        $flag = false;
        try {

            $this::$masterConn = new PDO(
                "mysql:host=$this->masterConnServer;dbname=$this->masterConnDBName",
                $this->masterConnUsername,
                $this->masterConnPassword,
                array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                )
            );
            $flag = true;
        } catch (PDOException $e) {
            $this::$message = $this->APIMessage['ERR_CONN'];
        }

        return $flag;
    }


    /* Get Master Connection */
    public function getMasterConn()
    {
        return $this::$masterConn;
    }

    /* Check Company Master Group and Id */
    public function checkCompanyMasterKeyAndId()
    {
        if ($this->isNullOrEmpty(self::$companyMasterKey) || $this->isNullOrEmptyOrZero(self::$companyMasterId)) {
            $this::$message = $this->APIMessage['ERR_COMPANY_MASTER'];
            return false;
        }
        return true;
    }

    public function executeMainFunction($HEADERS)
    {
        $imsSystemProject = $this->systemProject;
        $imsSystemModuleFunction = $this->systemModuleFunction;

        $imsProjectInstance = new $imsSystemProject($HEADERS);
        $imsProjectInstance->$imsSystemModuleFunction();
    }
}
