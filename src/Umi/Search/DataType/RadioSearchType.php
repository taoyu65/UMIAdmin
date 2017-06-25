<?php

namespace YM\Umi\Search\DataType;

class RadioSearchType extends SearchDataTypeAbstract
{
    public function searchFieldInput ($search)
    {
        $displayName = $search->display_name;
        $property = $this->getProperty($search);
        $className = "customCss$search->id";

        $html = <<<UMI
        <style type="text/css">
            label {
                float: left;
            }
            .rr {
                float: left;
                line-height: 30px;
                height: 30px;
                font-size: 12px;
                margin: 0px 10px 10px 0px;
                padding: 0px 5px 0px 5px;
                cursor: pointer;
                border: 1px solid #ebebeb;
            }
            .red {
                color: red;
                border: 1px solid red !important;
            }
            .rr input {
                filter: alpha(opacity=0);
                -moz-opacity: 0;
                opacity: 0;
                position: absolute;
            }
            .rr span {
                padding: 10px 10px 10px 10px;
                position: relative;
            }
        </style>
 
        <div class="col-sm-3" id="$className">
            <label>$displayName: &nbsp;</label> 
            <label class="red rr"><input type="radio" $property value="1" checked /><span>YES</span></label>
            <label class="rr"><input type="radio" $property value="0"/><span>NO</span></label>
        </div>
         
        <script>
            $(document).ready(function () {
                //单选框
                //switch
                $('div#$className .rr').click(function () {
                    var labelLength = $('div#$className .rr').length;
                    for (var i = 0; i < labelLength; i++) {
                        if (this == $('div#$className .rr').get(i)) {
                            $('div#$className .rr').eq(i).addClass('red');
                        } else {
                            $('div#$className .rr').eq(i).removeClass('red');
                        }
                    }
                });
            });
        </script>
UMI;
        return $html;
    }
}