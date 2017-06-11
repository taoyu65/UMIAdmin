<?php

namespace YM\Umi\DataTable\DataType;

class TagsDataType extends DataTypeAbstract
{
    public function regulateDataEditAdd ($data, $relatedTable = '', $relatedField = '', $validation = '', $option = [])
    {
        return $this->getAddHtml($data, $validation, $option);
    }

    private function getAddHtml($data, $validation, $option)
    {
        $property = $this->getProperty($option);
        $validationString = $this->getValidation($validation);
        $path = config('umi.assets_path') . '/ace';

        $html =<<<UMI
       
            <input class="form-control" type="text" $property $validationString id="form-field-tags" value="" placeholder="Enter tags ..." />

            <script>
                jQuery(function ($) {
                var tag_input = $('#form-field-tags');
				try{
					tag_input.tag(
					  {
						placeholder:tag_input.attr('placeholder'),
					  }
					)
			
					//programmatically add/remove a tag
					var tag_obj = $('#form-field-tags').data('tag');
					tag_obj.add('Delete me, I am a test');
					
					var index = tag_obj.inValues('some tag');
					tag_obj.remove(index);
				}
				catch(e) {
					//display a textarea for old IE, because it doesn't support this plugin or another one I tried!
					tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
					//autosize($('#form-field-tags'));
				}
            })
            </script>
		    <script src="$path/js/bootstrap-tag.min.js"></script>
UMI;
        return $html;
    }
}