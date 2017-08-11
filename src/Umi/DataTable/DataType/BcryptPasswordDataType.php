<?php

namespace YM\Umi\DataTable\DataType;

class BcryptPasswordDataType extends DataTypeAbstract
{
    public function regulateDataEditAdd($data, $relatedTable = '', $relatedField = '', $validation = '', $option = [])
    {
        return $this->getHtml($data, $option, $validation);
    }

    private function getHtml($data, $option, $validation)
    {
        $property = $this->getProperty($option);
        $validation = $this->getValidation($validation);
        $url = url('/api/generatePassword');

        return <<<UMI
<input class='form-control' type='password' $property $validation id='thisPassword' placeholder='after input click Generate Password'>
<button type='button' class='btn btn-sm btn-info' onclick="getPassword()">Generate Password</button>
<span id="status"></span>
<script>
    function getPassword()
    {
        var thisPassword = $('#thisPassword').val();
        if (thisPassword.trim() == '') {
            $('#status').html("<span class='red'>Please enter a password</span>");
            return false;
        }
        $('#status').html("<i id='responseLoading' class='ace-icon fa fa-spinner fa-spin orange bigger-160'></i>");
        var thisUrl = '$url/' + thisPassword;
        
        $.ajax({
            type: 'get',
            url: thisUrl,
            success: function (data) {
                $('#status').html('');
                $('#thisPassword').val(data);
                $('#thisPassword').attr('type', 'text');
            },
            error: function () {
                $('#status').html("<span class='red'>something went wrong, please try again.</span>");
            }
        });
    }
</script>
UMI;
    }
}