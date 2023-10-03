<?php
include_once 'common-constat.php';
?>
<script type="application/javascript">
    async function APICallAjax(SendDataObject, callback) {

        if (SendDataObject['IMSFileElement'] && SendDataObject.IMSFileElement.length > 0) {
            let data = new FormData();
            $.each(SendDataObject, function(key, input) {
                if (key != 'IMSFileElement') {
                    data.append(key, input);
                }
            });

            for (var i = 0; i < SendDataObject.IMSFileElement.length; i++) {
                data.append("IMSFileElement[]", SendDataObject.IMSFileElement[i]);
            }

            $.ajax({
                type: "POST",
                url: "<?php echo API_BASE_URL; ?>",
                headers: {
                    "Authorization": localStorage.getItem("AT"),
                },
                data: data,
                contentType: false,
                processData: false,
                async: false,
                success: function(response) {
                    if (response.responseCode == 2) {
                        // Token Invalid
                        window.open("<?php echo LogOutPath; ?>", "_self");
                    } else {

                        callback(response);
                    }
                },
                error: function(jqXHR, status, err) {
                    callback(err);
                }
            });
        } else {
            delete SendDataObject["IMSFileElement"];
            $.ajax({
                type: "POST",
                url: "<?php echo API_BASE_URL; ?>",
                headers: {
                    "Authorization": localStorage.getItem("AT")
                },
                async: false,
                data: SendDataObject,
                success: function(response) {
                    if (response.responseCode == 2) {
                        //checkRefreshToken(function(res){
                        if (response.responseCode == 2) {
                            // Token Invalid
                            window.open("<?php echo LogOutPath; ?>", "_self");
                        } else {
                            callback(res);
                        }
                        // });
                    } else {
                        callback(response);
                    }
                },
                error: function(jqXHR, status, err) {
                    callback(err);
                }
            });
        }

    }

    async function checkRefreshToken(callback) {
        $.ajax({
            type: "POST",
            url: "<?php echo API_BASE_URL; ?>",
            async: false,
            headers: {
                "Authorization": localStorage.getItem("RT"),
            },
            data: {
                '<?php echo systemProject; ?>': 'Sessions',
                '<?php echo systemModuleFunction; ?>': 'refreshToken',
                'tokenValidityType': 'minutes',
                'tokenValidityValue': localStorage.getItem("IdleTimeoutSessionValue"),
            },
            success: function(response) {
                if (response.responseCode != 2) {
                    // Token Set local
                    localStorage.setItem('AT', response.result.AT);
                    localStorage.setItem('RT', response.result.RT);
                }
                callback(response);
            },
            error: function(jqXHR, status, err) {
                callback(err);
            }
        });
    }
</script>