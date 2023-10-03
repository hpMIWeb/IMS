<?php
define('API_BASE_URL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/ims/api/');
define('LogOutPath', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/logout.php');
define('systemProject', 'systemProject');
define('systemModuleFunction', 'systemModuleFunction');
define('responseCode', 'responseCode');
define('message', 'message');
define('IMSFileElement', 'IMSFileElement');
define('result', 'result');
define('resultOk', '1');
define('BASE_URL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']);
?>

<script>
    const BASE_URL = "<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/"; ?>"
    const API_BASE_URL = "<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/ims/api/"; ?>"
    const LogOutPathAPI_BASE_URL =
        "<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/logout.php'; ?>"
    const RESULT_OK = "1";
    const SYSTEM_PROJECT = "systemProject";
    const SYSTEM_MODULE_FUNCTION = "systemModuleFunction";
    const RESPONSE_CODE = "responseCode";
    const MESSAGE = "message";
    const IMSFileElement = "IMSFileElement";
    const RESULT = "result";
</script>