<?php

/**
 * @author : Pinank Soni
 * @class :Masters
 * @desc: This class for using masters.
 **/
class Masters extends Config
{
    public function __construct($HEADERS)
    {
        parent::__construct($HEADERS);
    }


    public function getCategoryMasterDetails()
    {
        try {

            $categoryId = $this->handleSpecialCharacters($_POST['categoryId']);

            $appendQuery = '';

            if ($this->isNotNullOrEmptyOrZero($categoryId)) {
                $appendQuery = " WHERE id = '$categoryId' ";
            }
            $query = $this::$masterConn->prepare("SELECT * FROM `category_master` $appendQuery ORDER BY name ASC ");
            if ($query->execute()) {
                if ($query->rowCount() > 0) {
                    $this->successData();
                    foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $row) {
                        $this->data[] = array(
                            'id' => $this->convertNullOrEmptyStringToZero($row['id']),
                            'name' => $this->convertNullToEmptyString($row['name']),
                            'description' => $this->convertNullToEmptyString($row['description']),
                        );
                    }
                    $this::$result = array('category' => $this->data);
                } else {
                    $this->noData("No any category");
                }
            } else {
                $this->failureData();
            }
        } catch (PDOException $e) {
            $this->exceptionData();
        }
    }

    public function addUpdateCategoryMaster()
    {
        try {
            $name = $this->handleSpecialCharacters($_POST['name']);
            $description = $this->handleSpecialCharacters($_POST['description']);
            $categoryId = $this->handleSpecialCharacters($_POST['categoryId']);

            if ($this->equals($this->action, $this->arrayAllAction['add'])) {
                $query = $this::$masterConn->prepare("INSERT INTO `category_master` (`name`,`description`,`created_by`)VALUES ( '$name','$description', '" . $this->userMasterId . "'); ");
            } elseif ($this->isNotNullOrEmptyOrZero($categoryId) && $this->equals($this->action, $this->arrayAllAction['edit'])) {
                $query = $this::$masterConn->prepare("UPDATE `category_master` SET `name` = '$name',`description`='$description',`modified_by` = '" . $this->userMasterId . "' WHERE `id` ='$categoryId'");
            }

            if ($query->execute()) {
                if ($query->rowCount() > 0) {
                    if ($this->equals($this->action, $this->arrayAllAction['add'])) {
                        $this->successData("Category Add successfully.");
                    } elseif ($this->equals($this->action, $this->arrayAllAction['edit'])) {
                        $this->successData("Category Update successfully.");
                    }
                } else {
                    $this->failureData($this->APIMessage['ERR_QUERY_FAIL']);
                }
            } else {
                $this->failureData($this->APIMessage['ERR_QUERY_FAIL']);
            }
        } catch (PDOException $e) {
            $this->exceptionData();
        }
    }

    public function deleteCategory()
    {

        try {
            $categoryId = $this->handleSpecialCharacters($_POST['categoryId']);

            if ($this->isNotNullOrEmptyOrZero($categoryId)) {

                $query = $this::$masterConn->prepare("DELETE FROM `category_master` WHERE id = '$categoryId'");
                if ($query->execute()) {
                    if ($query->rowCount() > 0) {
                        $this->successData("Category Delete successfully.");
                    }
                } else {
                    $this->failureData($this->APIMessage['ERR_QUERY_FAIL']);
                }
            }
        } catch (PDOException $e) {
            $this->exceptionData();
        }
    }


    public function getPhonebookMasterDetails()
    {
        try {

            $phonebookMasterId = $this->handleSpecialCharacters($_POST['phonebookMasterId']);

            $appendQuery = '';

            if ($this->isNotNullOrEmptyOrZero($phonebookMasterId)) {
                $appendQuery = " WHERE id = '$phonebookMasterId' ";
            }
            $query = $this::$masterConn->prepare("SELECT * FROM `phonebook_master` $appendQuery ORDER BY name ASC ");
            if ($query->execute()) {
                if ($query->rowCount() > 0) {
                    $this->successData();
                    foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $row) {
                        $this->data[] = array(
                            'id' => $this->convertNullOrEmptyStringToZero($row['id']),
                            'category' => $this->convertNullOrEmptyStringToZero($row['category']),
                            'name' => $this->convertNullToEmptyString($row['name']),
                            'address' => $this->convertNullToEmptyString($row['address']),
                            'contactNumber' => $this->convertNullToEmptyString($row['contact_number']),
                            'designation' => $this->convertNullToEmptyString($row['designation']),
                            'companyName' => $this->convertNullToEmptyString($row['company_name']),
                            'remark' => $this->convertNullToEmptyString($row['remark']),
                        );
                    }
                    $this::$result = array('phoneBookMaster' => $this->data);
                } else {
                    $this->noData("No any phoneBookMaster");
                }
            } else {
                $this->failureData();
            }
        } catch (PDOException $e) {
            $this->exceptionData();
        }
    }


    public function addUpdatePhonebookMaster()
    {

        try {

            $category = $this->handleSpecialCharacters($_POST['category']);
            $name = $this->handleSpecialCharacters($_POST['name']);
            $address = $this->handleSpecialCharacters($_POST['address']);
            $contactNumber = $this->handleSpecialCharacters($_POST['contactNumber']);
            $designation = $this->handleSpecialCharacters($_POST['designation']);
            $companyName = $this->handleSpecialCharacters($_POST['companyName']);
            $remark = $this->handleSpecialCharacters($_POST['remark']);
            $phonebookMasterId = $this->handleSpecialCharacters($_POST['phonebookMasterId']);

            if ($this->equals($this->action, $this->arrayAllAction['add'])) {
                $query = $this::$masterConn->prepare("INSERT INTO `phonebook_master` (`category`,`name`,`address`,`contact_number`,`designation`,`company_name`,`remark`,`created_by`) 
                VALUES ('$category', '$name','$address','$contactNumber','$designation','$companyName','$remark', '" . $this->userMasterId . "'); ");
            } elseif ($this->isNotNullOrEmptyOrZero($phonebookMasterId) && $this->equals($this->action, $this->arrayAllAction['edit'])) {
                $query = $this::$masterConn->prepare("UPDATE `phonebook_master` SET `name` = '$name',`address`='$address',`contactNumber`='$contactNumber',`designation`='$designation',`companyName`='$companyName',`remark`=''`modified_by` = '" . $this->userMasterId . "' WHERE `id` ='$phonebookMasterId'");
            }


            if ($query->execute()) {
                if ($query->rowCount() > 0) {
                    if ($this->equals($this->action, $this->arrayAllAction['add'])) {
                        $this->successData("Phonebook master Add successfully.");
                    } elseif ($this->equals($this->action, $this->arrayAllAction['edit'])) {
                        $this->successData("Phonebook master Update successfully.");
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

    public function deletePhonebookMaster()
    {

        try {
            $phonebookMasterId = $this->handleSpecialCharacters($_POST['phonebookMasterId']);

            if ($this->isNotNullOrEmptyOrZero($phonebookMasterId)) {

                $query = $this::$masterConn->prepare("DELETE FROM `phonebook_master` WHERE id = '$phonebookMasterId'");
                if ($query->execute()) {
                    if ($query->rowCount() > 0) {
                        $this->successData("Category Delete successfully.");
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
