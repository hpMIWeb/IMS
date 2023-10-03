<?php

/* @Author: Pinank Soni
 * @Trait : CommonFunction
 * @Desc: All Common Function Declare Here
 * */
trait CommonFunction
{

    protected $platformType = array(
        'BOTH' => 'BOTH',
        'WEB' => 'WEB',
        'MOBILE' => 'MOBILE'
    );

    protected $platform = array(
        'WEB' => 'web',
        'ANDROID' => 'android',
        'IOS' => 'ios'
    );

    /*****************************************************
     * @Author : Pinank Soni
     * @Desc : handleSpecialCharacters [ single quote (')
     * double quote (")
     * backslash (\)
     * NULL
     * ]   inserted value in database
     * @paramates: pass string
     * @return : convert string
     *****************************************************/
    public function handleSpecialCharacters($string)
    {
        return addslashes(strip_tags(trim($string)));
    }

    /**
     * @param: $array
     * @return: String(Comma-Separate)
     * @author: Pinank Soni
     * @desc: generate sql in array string
     */
    public function createSQLInArray($array)
    {
        if (!empty($array)) {
            return "'" . implode("','", $array) . "'";
        } else {
            return '';
        }
    }

    public function handleSpecialCharactersWithoutTrim($string)
    {
        return addslashes(strip_tags($string));
    }

    /**
     * @param: $path =  String(path)
     * @return: Boolean(true/false)
     * @author: Pinank Soni
     * @desc: create directory
     */
    public function createDirectory($path)
    {
        if (!file_exists($path)) {
            if (mkdir($path, 0777, true)) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }

    }

    /* compare value */
    public function equals($value1, $value2, $ignoreCase = true)
    {
        if ($ignoreCase) {
            if (strtolower($value1) == strtolower($value2)) {
                return true;
            } else {
                return false;
            }
        } else {
            if ($value1 == $value2) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * @param: $format (default = Y-m-d H:i:s) =  date time format Y-m-d, d-m-Y, H:i:s, h:i A, Y-m-d H:i:s, etc..
     *          $dateNextPrev = pass next prev count (days, months, years)
     * @return: Date
     * @author: Pinank Soni
     * @desc: current date time
     */
    public function getDateTime($format = 'Y-m-d H:i:s', $dateNextPrev = '0 days')
    {
        if (!empty(trim($format)) && !empty($dateNextPrev)) {
            date_default_timezone_set("Asia/Kolkata");
            return date($format, strtotime(trim($dateNextPrev)));
        } else {
            return "";
        }
    }

    /**
     * @param: $format (default = Y-m-d H:i:s) =  date time format Y-m-d, d-m-Y, H:i:s, h:i A, Y-m-d H:i:s, etc..
     *          $dayType = (first, last)
     *          $monthType = (this, next, previous)
     * @return: Date
     * @author: Pinank Soni
     * @desc: get date time by month
     */
    public function getDateTimeByMonth($date, $format = 'Y-m-d H:i:s', $dayType = 'first', $monthType = 'this')
    {
        if (!empty(trim($date)) && !empty(trim($format)) && !empty($dayType)) {
            date_default_timezone_set("Asia/Kolkata");
            return date($format, strtotime($this->formatDateTime("Y-m", $date) . " , $dayType day of $monthType month"));
        } else {
            return "";
        }
    }

    /**
     * @param: $date
     * @return: String or empty String
     * @author: Pinank Soni
     * @desc: convert 0000-00-00 to empty string
     */
    public function convertDateTimeZeroToString($date)
    {
        if ($this->equals($date, '0000-00-00')
            || $this->equals($date, '00-00-0000')
            || $this->equals($date, '00:00:00')
            || $this->equals($date, '0000-00-00 00:00:00')
            || $this->equals($date, '00-00-0000 00:00:00')
        ) {
            return "";
        } else {
            return $date;
        }
    }

    /**
     * @param: $str =  String or Null value
     * @return: String
     * @author: Pinank Soni
     * @desc: check null or empty or datetime zero
     */
    public function isNullOrEmptyOrDateTimeZero($str)
    {
        if ($this->isNullOrEmptyOrZero($str)
            || ($this->equals($str, '0000-00-00')
                || $this->equals($str, '00-00-0000')
                || $this->equals($str, '00:00:00')
                || $this->equals($str, '0000-00-00 00:00:00')
                || $this->equals($str, '00-00-0000 00:00:00')
            )
        ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param: $str =  String value
     * @return: double
     * @author: Pinank Soni
     * @desc: covert string to double
     */
    public function convertStringToDouble($strVal)
    {
        if (!$this->isNullOrEmpty($strVal)) {
            return doubleval($strVal);
        } else {
            return 0;
        }
    }

    /**
     * @param: $str =  String or Null value
     * @return: String
     * @author: Pinank Soni
     * @desc: covert Null to String
     */
    public function convertNullToEmptyString($str)
    {
        if ($this->isNullOrEmptyOrDateTimeZero($str)) {
            return "";
        } else {
            return $str;
        }
    }

    /**
     * @param: $str =  String or Null value
     * @return: Zero String
     * @author: Pinank Soni
     * @desc: covert Null to String
     */
    public function convertNullOrEmptyStringToZero($str)
    {
        if ($this->isNullOrEmptyOrDateTimeZero($str)) {
            return "0";
        } else {
            return $str;
        }
    }

    /**
     * @param: $str =  Negative or Positive value
     * @return: Positive value
     * @author: Pinank Soni
     * @desc: covert negative or positive value to positive value
     */
    public function convertNegativeToPositiveValue($str)
    {
        if ($this->isNullOrEmptyOrDateTimeZero($str)) {
            return 0;
        } else {
            return abs($str);
        }
    }

    /**
     * @param: $format (default = Y-m-d H:i:s) =  date time format Y-m-d, d-m-Y, H:i:s, h:i A, Y-m-d H:i:s, D, etc..
     *          $mDateTime = pass date
     * @return: Date or Empty String
     * @author: Pinank Soni
     * @desc: current date time
     */
    public function formatDateTime($format = 'Y-m-d H:i:s', $mDateTime = '')
    {
        if ($this->isNullOrEmptyOrDateTimeZero($mDateTime)) {
            return "";
        } else {
            date_default_timezone_set("Asia/Kolkata");
            return date($format, strtotime($mDateTime));
        }
    }

    /**
     * @param: $mDate = date (format  Y-m, Y-m-d)
     *          $plusOrMinus = (+, -)
     *          $periodValue = (1, 2, 3, ......)
     *          $range = (days, months, years)
     *          $outputFormat (default = Y-m-d) etc...
     * @return: Date
     * @author: Pinank Soni
     * @desc: date by period
     */
    public function getDateByPeriod($mDate, $plusOrMinus = '+', $periodValue = '0', $range = 'days', $outputFormat = 'Y-m-d')
    {
        if (!$this->isNullOrEmptyOrDateTimeZero($mDate)) {
            date_default_timezone_set("Asia/Kolkata");
            return date($outputFormat, strtotime($plusOrMinus . $periodValue . " " . $range, strtotime($mDate)));
        } else {
            return "";
        }
    }

    /**
     * @param: $fromDate = date (format  Y-m, Y-m-d)
     *          $toDate = date (format  Y-m, Y-m-d)
     *          $formatDate (default = Y-m-d) etc...
     *          $periodTime (1 years, 1 months, 1 days)
     *          $range (year, month, day)
     * @return: Array of (Dates or Months or Years)
     * @author: Pinank Soni
     * @desc: date range
     */
    public function getDatesFromDateRange($fromDate, $toDate, $formatDate = 'Y-m-d', $periodTime = '1 month', $range = 'month')
    {

        $dates = array();
        date_default_timezone_set("Asia/Kolkata");
        try {
            if ($this->equals($range, 'day')) {
                $from = (new DateTime($fromDate));
                $to = (new DateTime($toDate));
            } else if ($this->equals($range, 'month')) {
                $from = (new DateTime($fromDate))->modify('first day of this month');
                $to = (new DateTime($toDate))->modify('first day of next month');
            }
            $interval = DateInterval::createFromDateString($periodTime);
            $period = new DatePeriod($from, $interval, $to);

            foreach ($period as $dt) {
                $dates[] = $dt->format($formatDate);
            }
        } catch (Exception $e) {
        }

        return $dates;
    }

    /**
     * @param: $str = String
     * @return: Boolean - true/false
     * @author: Pinank Soni
     * @desc: check Null or Empty
     */
    public function isNullOrEmpty($str)
    {
        if (trim($str) == null || trim($str) == '') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param: $str = String
     * @return: Boolean - true/false
     * @author: Pinank Soni
     * @desc: check Null or Empty or Zero
     */
    public function isNullOrEmptyOrZero($str)
    {
        if (empty($str)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param: $str = String
     * @return: Boolean - true/false
     * @author: Pinank Soni
     * @desc: check not Null or Empty or Zero
     */
    public function isNotNullOrEmptyOrZero($str)
    {
        if (!empty($str)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param: $str = String, decimal, float, double
     * @return: Boolean - true/false
     * @author: Pinank Soni
     * @desc: check zero or not
     */
    public function isZero($val)
    {
        if ($this->convertStringToDouble($val) == 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param: $url = String(url), $withDot = Boolean(true/false)
     * @return: Boolean - true/false
     * @author: Pinank Soni
     * @desc: generate file extension
     */
    public function getExtension($url, $withDot)
    {
        if ($withDot) {
            return "." . pathinfo(trim($url), PATHINFO_EXTENSION);
        } else {
            return pathinfo(trim($url), PATHINFO_EXTENSION);
        }
    }

    public function convertToUTF8Char($string)
    {
        return $string;
    }

    /*remove space between string*/
    function replaceString($string, $searchKeyWord, $replaceKeyWord = "")
    {
        return str_replace($searchKeyWord, $replaceKeyWord, $string);
    }

}

?>