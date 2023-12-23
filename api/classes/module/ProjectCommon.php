<?php

/* @author: Pinank Soni
 * @trait : ProjectCommon
 * @desc: All Project Common Function Declare Here
 * */
trait ProjectCommon
{
    /* File Path Structure And File Prefix Name */
    protected $filePathStructure = array(
        'root' => "..",
        'attachment' => "../assets/attachment/",
        'portfolio' => "portfolio/",
        'users' => "users/",
        'catalogue' => "catalogue/",

    );

    protected $arrayAllStatus = array(
        "1" => "Active",
        "2" => "De-Active",
    );

    protected $arrayAllRole = array(
        "1" => "Super Admin",
        "2" => "Back Office",
        "3" => "Normal User",
    );

    protected $arrayAllAction = array(
        "add" => "add",
        "edit" => "edit",
    );

    protected $arrayStockType = array(
        "live" => "live",
        "defective" => "defective",
        "company" => "company",
    );

    protected $filePrefixName = array(
        'portfolio' => "portfolio_",
        'users' => "users_",
        'users' => "catalogue_",
    );

    protected $invoiceType = array(
        '1' => "Cash Memo",
        '2' => "GST Invoice",
    );

    /* constants generation key */
    protected $urlKeyUniqueId = "?uniqueid=";

    protected $userEnable = 1;

    /* all data logic */
    protected $arrayAllDataLogic = array();

    public function getArrayIdByName($arrayName, $value)
    {

        return array_search($value, $arrayName);
    }

    public function getArrayNameById($arrayName, $value)
    {
        return $arrayName[$value];
    }

    public function generateAttachmentFilePath($filePathStructure)
    {
        return $this->filePathStructure['attachment'] . $filePathStructure;
    }

    public function generateAttachmentFileName($filePrefixName, $attachmentName, $otherPostfix = "", $putFileName = "")
    {
        if ($this->isNotNullOrEmptyOrZero($putFileName)) {
            return $filePrefixName . $putFileName;
        } else {
            return $filePrefixName . $this->getDateTime('YmdHis') . $this->getUniqId() . $otherPostfix . $this->getExtension($attachmentName, true);
        }
    }

    /**
     * @Author:Pinank Soni
     * @Description: This Function Convert Date & time Fomat as you want
     * @Default : by default getValue Current DateTime Value
     *
     * @param string $getDateTimeValue = Your Date or DateTime Value
     * @param bool $isGetDateTimeValue = default this function return dateTimeValue then default value set = true
     * @param bool $isGetOnlyDate = if you want to only convert to Date then this flag true
     * @param string $expectedDateFormat = This function work for only Date Format so if you want to get any other format then pass format here
     * @param string $expectedDateTimeFormat = This function work form only DateTime Format so if you want to get date other format then pass there format here
     * @return false|string = return as expected format wise date or DateTime value
     */
    public function convertDateTimeFormat($getDateTimeValue = "", $isGetDateTimeValue = true, $isGetOnlyDate = false, $expectedDateFormat = "", $expectedDateTimeFormat = "")
    {

        if (empty($expectedDateFormat)) // default set 'Y-m-d' Format
        {
            $expectedDateFormat = 'Y-m-d';
        }
        if (empty($expectedDateTimeFormat)) // default set 'Y-m-d H:i:s' Format
        {
            $expectedDateTimeFormat = 'Y-m-d H:i:s';
        }

        if ($isGetDateTimeValue) // Convert only DateTime
        {
            if ($this->isNotNullOrEmptyOrZero($getDateTimeValue)) // if you pass Date or DateTime Value
            {
                $getTime = explode(" ", $getDateTimeValue);

                if ($this->isNotNullOrEmptyOrZero($getTime) || $getTime[1] == "00:00:00") {
                    $getDateTimeValue = $getTime[0] . ' ' . date('H:i:s');
                }

                return date($expectedDateTimeFormat, strtotime(str_replace("/", "-", "$getDateTimeValue")));
            } else {
                return date($expectedDateTimeFormat);
            }
        } else if ($isGetOnlyDate) // Convert only Date
        {
            if ($getDateTimeValue) // if you pass Date or DateTime Value
            {
                return date($expectedDateFormat, strtotime($getDateTimeValue));
            } else {
                return date($expectedDateFormat);
            }
        }
    }

    public function uploadAttachment($filePathStructure, $filePrefixName, $attachmentName = '', $attachmentBase64Str = '', $otherPostfix = "", $putFileName = "", $isTicket = false)
    {
        $fileNameArray = array();
        $i = 0;
        if (!empty($_FILES[$this->IMSFileElement]['name'])) {
            foreach ($_FILES[$this->IMSFileElement]['name'] as $file => $data) {
                $fileTempPath = $_FILES[$this->IMSFileElement]['tmp_name'][$i];
                $fileOriginalName = $_FILES[$this->IMSFileElement]['name'][$i];

                $attachmentFileName = $this->generateAttachmentFileName($filePrefixName, $fileOriginalName, $otherPostfix, $putFileName);
                $attachmentFilePath = $this->generateAttachmentFilePath($filePathStructure);

                $fileFullPath = $attachmentFilePath . $attachmentFileName;

                if ($this->createDirectory($attachmentFilePath)) {
                    if (!move_uploaded_file($fileTempPath, $fileFullPath)) {
                        //throw new Exception('Could not move file');
                    }
                    $fileNameArray[$i]['filePath'] = $fileFullPath;
                    $fileNameArray[$i]['fileOriginalName'] = $fileOriginalName;
                    $fileNameArray[$i]['fileName'] = $attachmentFileName;
                    $i++;
                }
            }
        } else {
            $attachmentFileName = $this->generateAttachmentFileName($filePrefixName, $attachmentName, $otherPostfix, $putFileName);
            $attachmentFilePath = $this->generateAttachmentFilePath($filePathStructure);
            if ($this->createDirectory($attachmentFilePath)) {
                if (file_put_contents($attachmentFilePath . $attachmentFileName, base64_decode($attachmentBase64Str))) {
                    $fileNameArray['fileName'] = $attachmentFileName;
                }
            }
        }
        return $fileNameArray;
    }

    /* delete attachment */
    public function deleteAttachment($filePathStructure, $attachmentName, $isOwner = false)
    {
        if ($this->isNotNullOrEmptyOrZero($attachmentName)) {
            unlink($this->filePathStructure['attachment'] . $filePathStructure . $attachmentName);
        }
    }

    /* get microseconds name */
    public function getMicroSeconds($preFix = '')
    {
        return $preFix . round(microtime(true) * 1000);
    }

    /* get uniqId */
    public function getUniqId($preFix = '')
    {
        return $preFix . "_" . uniqid();
    }

    public function isFileUpdate($isAddFile = false)
    {
        $isFileUpdate = false;
        if ($this->isNotNullOrEmptyOrZero($this->deleteAttachmentArray)) {
            $isFileUpdate = true;
            if ($isAddFile) {
                if ($this->isAttachmentUpdate) {
                    $isFileUpdate = true;
                } else {
                    $isFileUpdate = false;
                }
            }
        } else if ($this->isAttachmentUpdate) {
            $isFileUpdate = true;
        }

        return $isFileUpdate;
    }

    public function generatePortfolioAttachmentUrl($attachmentName)
    {
        $url = '';
        if ($this->isNotNullOrEmptyOrZero($attachmentName)) {
            $url = $this->baseUrlAttachment . $this->filePathStructure['portfolio'] . $attachmentName;
        }
        return $url;
    }

    public function generateUserProfileAttachmentUrl($attachmentName)
    {
        $url = '';
        if ($this->isNotNullOrEmptyOrZero($attachmentName)) {
            $url = $this->baseUrlAttachment . $this->filePathStructure['users'] . $attachmentName;
        }
        return $url;
    }
}
