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


    public function getPhoneBookMasterDetails()
    {
        try {

            $phoneBookMasterId = $this->handleSpecialCharacters($_POST['phoneBookMasterId']);
            $categoryId = $this->handleSpecialCharacters($_POST['categoryId']);

            $appendQuery = '';

            if ($this->isNotNullOrEmptyOrZero($categoryId)) {
                $appendQuery = " WHERE category = '$categoryId' ";
            }
            if ($this->isNotNullOrEmptyOrZero($phoneBookMasterId)) {
                $appendQuery = " WHERE id = '$phoneBookMasterId' ";
            }
            $query = $this::$masterConn->prepare("SELECT * FROM `phone_book_master` $appendQuery ORDER BY name ASC ");
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


    public function addUpdatePhoneBookMaster()
    {

        try {

            $category = $this->handleSpecialCharacters($_POST['category']);
            $name = $this->handleSpecialCharacters($_POST['name']);
            $address = $this->handleSpecialCharacters($_POST['address']);
            $contactNumber = $this->handleSpecialCharacters($_POST['contactNumber']);
            $designation = $this->handleSpecialCharacters($_POST['designation']);
            $companyName = $this->handleSpecialCharacters($_POST['companyName']);
            $remark = $this->handleSpecialCharacters($_POST['remark']);
            $phoneBookMasterId = $this->handleSpecialCharacters($_POST['phoneBookMasterId']);

            if ($this->equals($this->action, $this->arrayAllAction['add'])) {
                $query = $this::$masterConn->prepare("INSERT INTO `phone_book_master` (`category`,`name`,`address`,`contact_number`,`designation`,`company_name`,`remark`,`created_by`) 
                VALUES ('$category', '$name','$address','$contactNumber','$designation','$companyName','$remark', '" . $this->userMasterId . "'); ");
            } elseif ($this->isNotNullOrEmptyOrZero($phoneBookMasterId) && $this->equals($this->action, $this->arrayAllAction['edit'])) {
                $query = $this::$masterConn->prepare("UPDATE `phone_book_master` SET `name` = '$name',`address`='$address',`contact_number`='$contactNumber',`designation`='$designation',`company_name`='$companyName',`remark`='$remark',`modified_by` = '" . $this->userMasterId . "' WHERE `id` ='$phoneBookMasterId'");
            }



            if ($query->execute()) {

                if ($this->equals($this->action, $this->arrayAllAction['add'])) {
                    $this->successData("Phone book master Add successfully.");
                } elseif ($this->equals($this->action, $this->arrayAllAction['edit'])) {
                    $this->successData("Phone book master Update successfully.");
                }
            } else {
                $this->failureData($this->APIMessage['ERR_QUERY_FAIL']);
            }
        } catch (PDOException $e) {
            $this->exceptionData($e);
        }
    }

    public function deletePhoneBookMaster()
    {

        try {
            $phoneBookMasterId = $this->handleSpecialCharacters($_POST['phoneBookMasterId']);

            if ($this->isNotNullOrEmptyOrZero($phoneBookMasterId)) {

                $query = $this::$masterConn->prepare("DELETE FROM `phone_book_master` WHERE id = '$phoneBookMasterId'");
                if ($query->execute()) {
                    if ($query->rowCount() > 0) {
                        $this->successData("Phone Book  Delete successfully.");
                    }
                } else {
                    $this->failureData($this->APIMessage['ERR_QUERY_FAIL']);
                }
            }
        } catch (PDOException $e) {
            $this->exceptionData();
        }
    }


    public function getAmcMasterDetails()
    {
        try {

            $amcMasterId = $this->handleSpecialCharacters($_POST['amcMasterId']);

            $appendQuery = '';

            if ($this->isNotNullOrEmptyOrZero($amcMasterId)) {
                $appendQuery = " WHERE id = '$amcMasterId' ";
            }
            $query = $this::$masterConn->prepare("SELECT * FROM `amc_master` $appendQuery ORDER BY id DESC");
            if ($query->execute()) {
                if ($query->rowCount() > 0) {
                    $this->successData();
                    foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $row) {
                        $this->data[] = array(
                            'id' => $this->convertNullOrEmptyStringToZero($row['id']),
                            'customerName' => $this->convertNullToEmptyString($row['customer_name']),
                            'contactNumber' => $this->convertNullToEmptyString($row['contact_number']),
                            'startDate' => $this->convertNullToEmptyString($row['start_date']),
                            'startDateDisplay' => $this->convertNullToEmptyString($this->formatDateTime('d-m-Y', $row['end_date'])),
                            'endDate' => $this->convertNullToEmptyString($row['start_date']),
                            'endDateDisplay' => $this->convertNullToEmptyString($this->formatDateTime('d-m-Y', $row['end_date'])),
                            'address' => $this->convertNullToEmptyString($row['address']),
                            'customerCardNumber' => $this->convertNullToEmptyString($row['customer_card_number']),
                            'noOfBathroom' => $this->convertNullOrEmptyStringToZero($row['no_of_bathroom']),
                            'noService' => $this->convertNullOrEmptyStringToZero($row['no_service']),
                            'amcCharges' => $this->convertNullOrEmptyStringToZero($row['amc_charges']),
                            'remark' => $this->convertNullToEmptyString($row['remark']),
                        );
                    }
                    $this::$result = array('amcMaster' => $this->data);
                } else {
                    $this->noData("No any amcMaster");
                }
            } else {
                $this->failureData();
            }
        } catch (PDOException $e) {
            $this->exceptionData();
        }
    }


    public function ccMaster()
    {

        try {

            $customerName = $this->handleSpecialCharacters($_POST['customerName']);
            $address = $this->handleSpecialCharacters($_POST['address']);
            $contactNumber = $this->handleSpecialCharacters($_POST['contactNumber']);
            $startDate =  $this->handleSpecialCharacters($this->convertDateTimeFormat($_POST['startDate'], true, false));;
            $endDate =  $this->handleSpecialCharacters($this->convertDateTimeFormat($_POST['endDate'], true, false));;
            $noOfService = $this->handleSpecialCharacters($_POST['noOfService']);
            $noOfBathroom = $this->handleSpecialCharacters($_POST['noOfBathroom']);
            $amcCharges = $this->handleSpecialCharacters($_POST['amcCharges']);
            $remark = $this->handleSpecialCharacters($_POST['remark']);
            $customerCardNumber = $this->handleSpecialCharacters($_POST['customerCardNumber']);
            $amcMasterId = $this->handleSpecialCharacters($_POST['amcMasterId']);

            if ($this->equals($this->action, $this->arrayAllAction['add'])) {
                $query = $this::$masterConn->prepare("INSERT INTO `amc_master`
                ( `customer_name`, `address`, `contact_number`, `no_of_bathroom`, `start_date`, `end_date`, `no_service`, `amc_charges`, `remark`, `customer_card_number`,`created_by`) 
                VALUES ('$customerName','$address','$contactNumber','$noOfBathroom','$startDate','$endDate','$noOfService','$amcCharges','$remark','$customerCardNumber','" . $this->userMasterId . "')");
            } elseif ($this->isNotNullOrEmptyOrZero($amcMasterId) && $this->equals($this->action, $this->arrayAllAction['edit'])) {
                $query = $this::$masterConn->prepare("UPDATE `amc_master` SET `customer_name`='$customerName',`address`='$address',`contact_number`='$contactNumber',`no_of_bathroom`='$noOfBathroom',`start_date`='$startDate',`end_date`='$endDate',`no_service`='$noOfService',`amc_charges`='$amcCharges',`remark`='$remark',`customer_card_number`='$customerCardNumber',`modified_by`='" . $this->userMasterId . "' WHERE id = '$amcMasterId'");
            }

            if ($query->execute()) {
                if ($query->rowCount() > 0) {
                    if ($this->equals($this->action, $this->arrayAllAction['add'])) {
                        $this->successData("AMC Master master Add successfully.");
                    } elseif ($this->equals($this->action, $this->arrayAllAction['edit'])) {
                        $this->successData("AMC Master master Update successfully.");
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


    public function deleteAmcMaster()
    {

        try {
            $amcMasterId = $this->handleSpecialCharacters($_POST['amcMasterId']);

            if ($this->isNotNullOrEmptyOrZero($amcMasterId)) {

                $query = $this::$masterConn->prepare("DELETE FROM `amc_master` WHERE id = '$amcMasterId'");
                if ($query->execute()) {
                    if ($query->rowCount() > 0) {
                        $this->successData("AMC Master Deleted successfully.");
                    }
                } else {
                    $this->failureData($this->APIMessage['ERR_QUERY_FAIL']);
                }
            }
        } catch (PDOException $e) {
            $this->exceptionData();
        }
    }

    public function getAmcDetails()
    {
        try {

            $amcMasterId = $this->handleSpecialCharacters($_POST['amcMasterId']);

            $appendQuery = '';

            if ($this->isNotNullOrEmptyOrZero($amcMasterId)) {
                $appendQuery = " WHERE `amc_details`.amc_master_id = '$amcMasterId' ";
            }
            $query = $this::$masterConn->prepare("SELECT `amc_details`.*,`user_master`.username AS amcAttendPerson FROM `amc_details` 
            LEFT JOIN `user_master` ON  `user_master`.id = `amc_details`.created_by
            $appendQuery ORDER BY `amc_details`.id DESC");
            if ($query->execute()) {
                if ($query->rowCount() > 0) {
                    $this->successData();
                    foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $row) {
                        $this->data[] = array(
                            'id' => $this->convertNullOrEmptyStringToZero($row['id']),
                            'amcMasterId' => $this->convertNullOrEmptyStringToZero($row['amc_master_id']),
                            'customerName' => $this->convertNullToEmptyString($row['customer_name']),
                            'contactNumber' => $this->convertNullToEmptyString($row['contact_number']),
                            'visitDate' => $this->convertNullToEmptyString($row['visit_date']),
                            'visitDateDisplay' => $this->convertNullToEmptyString($this->formatDateTime('d-m-Y', $row['visit_date'])),
                            'workDetails' => $this->convertNullToEmptyString($row['work_details']),
                            'attendBy' => $this->convertNullToEmptyString($row['attendBy']),
                        );
                    }
                    $this::$result = array('amcDetails' => $this->data);
                } else {
                    $this->noData("No any amcDetails");
                }
            } else {
                $this->failureData();
            }
        } catch (PDOException $e) {
            $this->exceptionData();
        }
    }

    public function addUpdateAmcDetails()
    {

        try {

            $amcMasterId = $this->handleSpecialCharacters($_POST['amcMasterId']);
            $customerName = $this->handleSpecialCharacters($_POST['customerName']);
            $workDetails = $this->handleSpecialCharacters($_POST['workDetails']);
            $contactNumber = $this->handleSpecialCharacters($_POST['contactNumber']);
            $attendBy = $this->handleSpecialCharacters($_POST['attendBy']);
            $visitDate =  $this->handleSpecialCharacters($this->convertDateTimeFormat($_POST['visitDate'], true, false));;

            if ($this->equals($this->action, $this->arrayAllAction['add'])) {
                $query = $this::$masterConn->prepare("INSERT INTO `amc_details`( `amc_master_id`, `customer_name`, `visit_date`, `work_details`, `contact_number`,`attendBy`, `created_by`) 
                VALUES ('$amcMasterId','$customerName','$visitDate','$workDetails','$contactNumber','$attendBy','" . $this->userMasterId . "')");
            }



            if ($query->execute()) {
                if ($query->rowCount() > 0) {
                    if ($this->equals($this->action, $this->arrayAllAction['add'])) {
                        $this->successData("AMC Master master Add successfully.");
                    } elseif ($this->equals($this->action, $this->arrayAllAction['edit'])) {
                        $this->successData("AMC Master master Update successfully.");
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


    public function getItemDetails()
    {
        try {

            $itemId = $this->handleSpecialCharacters($_POST['itemId']);

            $appendQuery = '';

            if ($this->isNotNullOrEmptyOrZero($itemId)) {
                $appendQuery = " WHERE id = '$itemId' ";
            }
            $query = $this::$masterConn->prepare("SELECT * FROM `item_list` $appendQuery ORDER BY id DESC ");

            if ($query->execute()) {
                if ($query->rowCount() > 0) {
                    $this->successData();
                    foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $row) {
                        $this->data[] = array(
                            'id' => $this->convertNullOrEmptyStringToZero($row['id']),
                            'itemName' => $this->convertNullToEmptyString($row['item_name']),
                            'itemCode' => $this->convertNullToEmptyString($row['item_code']),
                            'hsnCode' => $this->convertNullToEmptyString($row['hsn_code']),
                            'minimumStockLevel' => $this->convertNullOrEmptyStringToZero($row['minimum_stock_level']),
                            'openingStock' => $this->convertNullOrEmptyStringToZero($row['opening_stock']),
                            'purchaseBasicCost' => $this->convertNullOrEmptyStringToZero($row['purchase_basic_cost']),
                            'basicSellingPrice' => $this->convertNullOrEmptyStringToZero($row['basic_selling_price']),
                            'landingCost' => $this->convertNullOrEmptyStringToZero($row['landing_cost']),
                            'mrp' => $this->convertNullOrEmptyStringToZero($row['mrp']),
                        );
                    }
                    $this::$result = array('itemList' => $this->data);
                } else {
                    $this->noData("No any Item");
                }
            } else {
                $this->failureData();
            }
        } catch (PDOException $e) {
            $this->exceptionData();
        }
    }

    public function addUpdateItem()
    {

        try {

            $itemName = $this->handleSpecialCharacters($_POST['itemName']);
            $itemCode = $this->handleSpecialCharacters($_POST['itemCode']);
            $hsnCode = $this->handleSpecialCharacters($_POST['hsnCode']);
            $openingStock = $this->handleSpecialCharacters($_POST['openingStock']);
            $minimumStockLevel = $this->handleSpecialCharacters($_POST['minimumStockLevel']);
            $purchaseBasicCost = $this->handleSpecialCharacters($_POST['purchaseBasicCost']);
            $basicSellingPrice = $this->handleSpecialCharacters($_POST['basicSellingPrice']);
            $purchaseBasicCostTax = $this->handleSpecialCharacters($_POST['purchaseBasicCostTax']);
            $basicSellingPriceTax = $this->handleSpecialCharacters($_POST['basicSellingPriceTax']);
            $landingCost = $this->handleSpecialCharacters($_POST['landingCost']);
            $mrp = $this->handleSpecialCharacters($_POST['mrp']);
            $itemId = $this->handleSpecialCharacters($_POST['itemId']);


            if ($this->equals($this->action, $this->arrayAllAction['add'])) {
                $query = $this::$masterConn->prepare("INSERT INTO `item_list`
                 (`item_name`,`item_code`,`hsn_code`,`opening_stock`,`minimum_stock_level`,`purchase_basic_cost`,`basic_selling_price`,`basic_selling_tax`,`landing_cost`,`landing_cost_tax`,`mrp`,`created_by`) 
                VALUES ('$itemName', '$itemCode','$hsnCode','$openingStock','$minimumStockLevel','$purchaseBasicCost','$basicSellingPrice', '$basicSellingPriceTax','$landingCost','$basicSellingPriceTax','$mrp','" . $this->userMasterId . "'); ");
            } elseif ($this->isNotNullOrEmptyOrZero($itemId) && $this->equals($this->action, $this->arrayAllAction['edit'])) {
                $query = $this::$masterConn->prepare("UPDATE `item_list` SET `item_name` = '$itemName',`item_code`='$itemCode',`hsn_code`='$hsnCode',`opening_stock`='$openingStock',`minimum_stock_level`='$minimumStockLevel',`purchase_basic_cost`='$purchaseBasicCost',`basic_selling_price`='$basicSellingPrice',`landing_cost`='$landingCost',`mrp`='$mrp',`modified_by` = '" . $this->userMasterId . "' WHERE `id` ='$itemId'");
            }

            if ($query->execute()) {
                if ($query->rowCount() > 0) {
                    if ($this->equals($this->action, $this->arrayAllAction['add'])) {
                        $this->successData("Item Add successfully.");
                    } elseif ($this->equals($this->action, $this->arrayAllAction['edit'])) {
                        $this->successData("Item Update successfully.");
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

    public function deleteItems()
    {

        try {
            $itemId = $this->handleSpecialCharacters($_POST['itemId']);

            if ($this->isNotNullOrEmptyOrZero($itemId)) {

                $query = $this::$masterConn->prepare("DELETE FROM `item_list` WHERE id = '$itemId'");
                if ($query->execute()) {
                    if ($query->rowCount() > 0) {
                        $this->successData("Item Delete successfully.");
                    }
                } else {
                    $this->failureData($this->APIMessage['ERR_QUERY_FAIL']);
                }
            }
        } catch (PDOException $e) {
            $this->exceptionData();
        }
    }

    public function addUpdateItemAllocation()
    {
        try {
            $itemAllocationId = $this->handleSpecialCharacters($_POST['itemAllocationId']);
            $itemId = $this->handleSpecialCharacters($_POST['itemId']);
            $userId = $this->handleSpecialCharacters($_POST['userId']);
            $allocateQty = $this->handleSpecialCharacters($_POST['allocatedQty']);

            if ($this->equals($this->action, $this->arrayAllAction['add'])) {
                $query = $this::$masterConn->prepare("INSERT INTO `item_user_allocation` (`user_id`,`item_id`,`allocate_qty`,`created_by`,`created_at`) 
                VALUES ('$userId','$itemId','$allocateQty','" . $this->userMasterId . "','".$this->getDateTime()."');");
            } elseif ($this->isNotNullOrEmptyOrZero($itemAllocationId) && $this->equals($this->action, $this->arrayAllAction['edit'])) {
                 $query = $this::$masterConn->prepare("UPDATE `item_user_allocation` SET `allocate_qty`='$allocateQty',`modified_by`='" . $this->userMasterId . "' WHERE id = '$itemAllocationId'");
             }

            if ($query->execute()) {

                    $updateItemQty = $this::$masterConn->prepare("UPDATE item_list SET opening_stock = opening_stock - $allocateQty WHERE id = '$itemId';");
                    if ($updateItemQty->execute()) {
                        
                    }
                    if ($this->equals($this->action, $this->arrayAllAction['add'])) {
                        $this->successData("Item Assign successfully.");
                    } elseif ($this->equals($this->action, $this->arrayAllAction['edit'])) {
                        $this->successData("Item Update successfully.");
                    }
            } else {
                $this->failureData($this->APIMessage['ERR_QUERY_FAIL']);
            }
        } catch (PDOException $e) {
            $this->exceptionData($e);
        }
    }

     public function getItemAllocationDetails()
    {
        try {
            $itemAllocationId = $this->handleSpecialCharacters($_POST['itemAllocationId']);

            $itemId = $this->handleSpecialCharacters($_POST['itemId']);
            $userId = $this->handleSpecialCharacters($_POST['userId']);


            $appendQuery = "";

            if($this->isNotNullOrEmptyOrZero($userId)){
                $appendQuery  = " WHERE `item_user_allocation`.user_id = '$userId' ";
            }

            
            if($this->isNotNullOrEmptyOrZero($userId) && $this->isNotNullOrEmptyOrZero($itemId)){
                $appendQuery  = " WHERE `item_user_allocation`.user_id = '$userId' AND `item_user_allocation`.item_id = '$itemId' ";
            }

            $query = $this::$masterConn->prepare("SELECT `item_user_allocation`.*,`item_list`.`item_name` AS itemName,`item_list`.`item_code` AS itemCode FROM `item_user_allocation` LEFT JOIN `item_list` ON `item_list`.id=`item_user_allocation`.item_id $appendQuery");
           if ($query->execute()) {
                if ($query->rowCount() > 0) {
                    $this->successData();
                    foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $row) {
                        $this->data[] = array(
                            'id' => $this->convertNullOrEmptyStringToZero($row['id']),
                            'itemId' => $this->convertNullOrEmptyStringToZero($row['item_id']),
                            'itemCode' => $this->convertNullToEmptyString($row['itemCode']),
                            'itemName' => $this->convertNullToEmptyString($row['itemName']),
                            'userId' => $this->convertNullOrEmptyStringToZero($row['user_id']),
                            'allocateQty' => $this->convertNullOrEmptyStringToZero($row['allocate_qty']),
                            
                        );
                    }
                    $this::$result = array('itemList' => $this->data);
                } else {
                    $this->noData("No any Item");
                }
            } else {
                $this->failureData($this->APIMessage['ERR_QUERY_FAIL']);
            }
        } catch (PDOException $e) {
            $this->exceptionData($e);
        }
    }

    public function addUpdateItemDefective()
    {
        try {
            $itemAllocationId = $this->handleSpecialCharacters($_POST['itemAllocationId']);
            $itemId = $this->handleSpecialCharacters($_POST['itemId']);
            $userId = $this->handleSpecialCharacters($_POST['userId']);
            $defectiveQty = $this->handleSpecialCharacters($_POST['defectiveQty']);

            if ($this->equals($this->action, $this->arrayAllAction['add'])) {
                $query = $this::$masterConn->prepare("INSERT INTO `item_defective_master` (`user_id`,`item_id`,`defective_qty`,`created_by`,`created_at`) 
                VALUES ('$userId','$itemId','$defectiveQty','" . $this->userMasterId . "','".$this->getDateTime()."');");
            } elseif ($this->isNotNullOrEmptyOrZero($itemAllocationId) && $this->equals($this->action, $this->arrayAllAction['edit'])) {
                 $query = $this::$masterConn->prepare("UPDATE `item_defective_master` SET `defective_qty`='$defectiveQty',`modified_by`='" . $this->userMasterId . "' WHERE id = '$itemAllocationId'");
             }

            if ($query->execute()) {
                    if ($this->equals($this->action, $this->arrayAllAction['add'])) {
                        $this->successData("Item Defective successfully.");
                    } elseif ($this->equals($this->action, $this->arrayAllAction['edit'])) {
                        $this->successData("Item Defective successfully.");
                    }
            } else {
                $this->failureData($this->APIMessage['ERR_QUERY_FAIL']);
            }
        } catch (PDOException $e) {
            $this->exceptionData($e);
        }
    }

     public function getItemDefectiveDetails()
    {
        try {
            $itemDefectiveId = $this->handleSpecialCharacters($_POST['itemDefectiveId']);

            $itemId = $this->handleSpecialCharacters($_POST['itemId']);
            $userId = $this->handleSpecialCharacters($_POST['userId']);


            $appendQuery = "";

            if($this->isNotNullOrEmptyOrZero($userId)){
                $appendQuery  = " WHERE `item_defective_master`.user_id = '$userId' ";
            }

            
            if($this->isNotNullOrEmptyOrZero($userId) && $this->isNotNullOrEmptyOrZero($itemId)){
                $appendQuery  = " WHERE `item_defective_master`.user_id = '$userId' AND `item_defective_master`.item_id = '$itemId' ";
            }

           $query = $this::$masterConn->prepare("SELECT `item_defective_master`.*,`item_list`.`item_name` AS itemName,`item_list`.`item_code` AS itemCode FROM `item_defective_master` LEFT JOIN `item_list` ON `item_list`.id=`item_defective_master`.item_id $appendQuery");
           if ($query->execute()) {
                if ($query->rowCount() > 0) {
                    $this->successData();
                    foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $row) {
                        $this->data[] = array(
                            'id' => $this->convertNullOrEmptyStringToZero($row['id']),
                            'itemId' => $this->convertNullOrEmptyStringToZero($row['item_id']),
                            'itemName' => $this->convertNullToEmptyString($row['itemName']),
                            'itemCode' => $this->convertNullToEmptyString($row['itemCode']),
                            'userId' => $this->convertNullOrEmptyStringToZero($row['user_id']),
                            'defectiveQty' => $this->convertNullOrEmptyStringToZero($row['defective_qty']),
                            
                        );
                    }
                    $this::$result = array('itemList' => $this->data);
                } else {
                    $this->noData("No any Item");
                }
            } else {
                $this->failureData($this->APIMessage['ERR_QUERY_FAIL']);
            }
        } catch (PDOException $e) {
            $this->exceptionData();
        }
    }


    public function addUpdateInvoiceDetails(){
        try{

            $invoiceId = $this->handleSpecialCharacters($_POST['invoiceId']);
            $billNo = $this->handleSpecialCharacters($_POST['billNo']);
            $clientName = $this->handleSpecialCharacters($_POST['clientName']);
            $contactNumber = $this->handleSpecialCharacters($_POST['contactNumber']);
            $email = $this->handleSpecialCharacters($_POST['email']);
            $clientGST = $this->handleSpecialCharacters($_POST['clientGST']);
            $address = $this->handleSpecialCharacters($_POST['address']);
            $state = $this->handleSpecialCharacters($_POST['state']);
            $invoiceTotalAmount = $this->handleSpecialCharacters($_POST['invoiceTotalAmount']);
            $invoiceTotalDiscountAmount = $this->handleSpecialCharacters($_POST['invoiceTotalDiscountAmount']);
            $gstType = $this->handleSpecialCharacters($_POST['gstType']);
            $invoiceGSTAmount = $this->handleSpecialCharacters($_POST['invoiceGSTAmount']);
            $invoiceRoundOff = $this->handleSpecialCharacters($_POST['invoiceRoundOff']);
            $invoiceNetAmount = $this->handleSpecialCharacters($_POST['invoiceNetAmount']);
            $itemArray = json_decode($_POST['itemArray'],true);


            if ($this->equals($this->action, $this->arrayAllAction['add'])) {
                $query = $this::$masterConn->prepare("INSERT INTO `invoice_master`(`bill_no`, `client_name`, `contact_number`, `email`, `client_gst_number`, `client_address`, `client_state`, `total_amount`, `total_discount`, `gst_type`, `gst_amount`, `gst_percentage`, `round_off`, `net_amount`, `created_by`) 
                        VALUES  ('$billNo','$clientName','$contactNumber','$email','$clientGST','$address','$state','$invoiceTotalAmount','$invoiceTotalDiscountAmount','$gstType','$invoiceGSTAmount','18','$invoiceRoundOff','$invoiceNetAmount','".$this->userMasterId."')");
            }

            if ($query->execute()) {
                if ($this->equals($this->action, $this->arrayAllAction['add'])) {

                     $invoiceId = $this::$masterConn->lastInsertId();
                    if($this->isNotNullOrEmptyOrZero($invoiceId) && $this->isNotNullOrEmptyOrZero($itemArray)){
                        foreach ($itemArray as $item){
                       
                            $itemsId = $this->handleSpecialCharacters($item['itemId']);
                            $itemsQty = $this->handleSpecialCharacters($item['itemQty']);
                            $itemsRate = $this->handleSpecialCharacters($item['itemRate']);
                            $itemsDiscount = $this->handleSpecialCharacters($item['itemDiscount']);
                            $total = $this->handleSpecialCharacters($item['total']);

                            $itemInsertQuery = $this::$masterConn->prepare("INSERT INTO  `invoice_details`(`invoice_idi`, `item_id`, `item_qty`, `item_rate`, `item_discount`, `item_total`, `created_by`) 
                            VALUES ('$invoiceId','$itemsId','$itemsQty','$itemsRate','$itemsDiscount','$total','".$this->userMasterId."')");
     
                            $itemInsertQuery->execute();

                        }
                    }
                    $this->successData("Invoice Created successfully.");
                } elseif ($this->equals($this->action, $this->arrayAllAction['edit'])) {
                    $this->successData("Invoice Updated successfully.");
                }
            } else {
                $this->failureData($this->APIMessage['ERR_QUERY_FAIL']);
            }

        }catch (PDOException $e){
            $this->exceptionData();
        }
    }

    public function getInvoiceDetails(){
        try{

            $invoiceId = $this->handleSpecialCharacters($_POST['invoiceId']);
           
            $query = $this::$masterConn->prepare("SELECT `item_defective_master`.*,`item_list`.`item_name` AS itemName FROM `item_defective_master` LEFT JOIN `item_list` ON `item_list`.id=`item_defective_master`.item_id $appendQuery");
            if ($query->execute()) {
                    if ($query->rowCount() > 0) {
                        $this->successData();
                        foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $row) {
                            $this->data[] = array(
                                'id' => $this->convertNullOrEmptyStringToZero($row['id']),
                                'itemId' => $this->convertNullOrEmptyStringToZero($row['item_id']),
                                'itemName' => $this->convertNullToEmptyString($row['itemName']),
                                'userId' => $this->convertNullOrEmptyStringToZero($row['user_id']),
                                'defectiveQty' => $this->convertNullOrEmptyStringToZero($row['defective_qty']),
                                
                            );
                        }
                        $this::$result = array('itemList' => $this->data);
                    } else {
                        $this->noData("No any Item");
                    }
                } else {
                    $this->failureData($this->APIMessage['ERR_QUERY_FAIL']);
                }


        }catch(PDOException $e){
            $this->exceptionData();
        }
    }
}