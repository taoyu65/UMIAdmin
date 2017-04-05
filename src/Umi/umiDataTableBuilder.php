<?php

namespace YM\Umi;

use Illuminate\Support\Facades\Config;
use YM\Models\Umi;
use YM\umiAuth\Facades\umiAuth;
use YM\Umi\DataTable\DataType\DataTypeOperation;

class umiDataTableBuilder
{
    private $browser;
    private $read;
    private $edit;
    private $add;
    private $delete;
    private $buttonStyle;
    private $tableName;

    #按钮样式 style of button
    protected $BtnCssDelete = 'btn btn-sm btn-danger';
    protected $BtnCssNew = 'btn btn-sm btn-success';
    protected $BtnCssSmallEdit = 'btn btn-xs btn-info';
    protected $BtnCssSmallBrowser = 'btn btn-xs btn-warning';
    protected $BtnCssSmallDelete = 'btn btn-xs btn-danger';

    public function __construct()
    {
        $administrator = new administrator();
        $this->tableName = $administrator->currentTableName();

        #获取所有BREAD 权限
        #get all bread authorization
        $permission = 'browser-' . $this->tableName;
        $this->browser = umiAuth::can($permission) ? true : false;

        $permission = 'read-' . $this->tableName;
        $this->read = umiAuth::can($permission) ? true : false;

        $permission = 'edit-' . $this->tableName;
        $this->edit = umiAuth::can($permission) ? true : false;

        $permission = 'add-' . $this->tableName;
        $this->add = umiAuth::can($permission) ? true : false;

        $permission = 'delete-' . $this->tableName;
        $this->delete = umiAuth::can($permission) ? true : false;

        #获取按钮没有被授权时候的样式,可以设置为不显示或者不可点击
        #get style of button when unauthorized, does not show or not editable
        $this->buttonStyle = Config::get('umi.unAuthorizedAccessStyle');
    }

    public function tableSearch()
    {
        $html = <<<UMI
        searchs
UMI;
        return $html;
    }

    public function tableHeadAlert($superAdmin = false)
    {
        $html = <<<UMI
        <div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">
				<i class="ace-icon fa fa-times"></i>
			</button>
			<strong>This is Table's head!</strong>
			This alert needs your attention, but it's not super important.
			<br />
		</div>
UMI;
        return $html;
    }

    public function tableHead($superAdmin = false)
    {
        #删除按钮 button of delete
        $buttonDelete = $this->ButtonDelete($superAdmin);

        #新建按钮 button of new
        $buttonAdd = $this->ButtonAdd($superAdmin);

        $html = <<<UMI
        <p>
            $buttonDelete
            $buttonAdd
		</p>
UMI;
        return $html;
    }

    #这个专门为超级管理员定义的表格头, 可以继承此类, 自定义不同管理员的不同界面和功能
    #this is for super admin and this class can be extended for any specific
    #function or UI
    public function tableHeadSuperAdmin()
    {
        $buttonDelete = $this->ButtonDelete(true);
        $buttonAdd = $this->ButtonAdd(true);

        $html = <<<UMI
        <p>
            $buttonDelete
            $buttonAdd
		</p>
UMI;
        return $html;
    }

    /**
     * @param bool $superAdmin
     * @return string
     */
    public function tableBody($superAdmin = false)
    {
        #是否有权限浏览表格数据
        #check if have authority to browser the data table
        if (!($superAdmin || $this->browser))
            return $this->wrongMessage('you are not authorized to browser this data table');

        #数据表头 table Head
        $dataTypeOp = new DataTypeOperation('browser', $this->tableName);
        $tHeads = $dataTypeOp->getTHead();
        if (!count($tHeads))
            return $this->wrongMessage('Please open and set up field shows up function', '#');
        $tHeadHtml = '';
        foreach ($tHeads as $tHead) {
            $displayName = $tHead->display_name === '' ? $tHead->field : $tHead->display_name;
            $tHeadHtml .= "<th>$displayName</th>";
        }

        #数据表内容按照类型重写 table body will be rewrite according to the custom data type
        $fields = $dataTypeOp->getFields();
        $perPage = Config::get('umi.umi_table_perPage');
        $umiModel = new Umi();
        $dataSet = $umiModel->getSelectedTable($this->tableName, $fields)->paginate($perPage);
        $args = $this->getArgs(['id']); //获取参数 get args
        $links = $dataSet->appends($args)->links();

        #是否开启 数据映射功能 if available for data reformat
        if (Config::get('umi.data_field_reformat'))
            $dataSet = $dataTypeOp->regulatedDataSet($dataSet);

        #数据表内容 table body
        $trBodyHtml = '';
        if ($dataSet) {
            foreach ($dataSet as $ds) {
                $trBodyHtml .= '<tr>';
                $trBodyHtml .= $this->checkboxHtml();
                foreach ($ds as $item => $value) {
                    $trBodyHtml .= '<td>';
                    $trBodyHtml .= $value;
                    $trBodyHtml .= '</td>';
                }
                $trBodyHtml .= $this->breadButtonHtml($superAdmin);     //获取按钮 get button
                $trBodyHtml .= '</tr>';
            }
        }
        $html = <<<UMI
        <div class="row">
		    <div class="col-xs-12">
			    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
				    <thead>
					    <tr>
						    <th class="center">
							    <label class="pos-rel">
									<input type="checkbox" class="ace" />
									<span class="lbl"></span>
								</label>
							</th>
							$tHeadHtml
							<th></th>
		                </tr>
			        </thead>

			        <tbody>
				        $trBodyHtml
				    </tbody>
				</table>
			</div>
		</div>
UMI;
        $html .= $links;
        return $html;
    }

    public function tableFoot($superAdmin = false)
    {
        $html = <<< UMI
        <div class="alert alert-block alert-success">
			<button type="button" class="close" data-dismiss="alert">
				<i class="ace-icon fa fa-times"></i>
			</button>

			<p>
				<strong>
					<i class="ace-icon fa fa-check"></i>
					This is Table's Foot
				</strong>
				You can customize this footer.<br>
				Footer, Header, Body of Table can be different by extending a new class for the a new administrator
			</p>

			<p>
				<button class="btn btn-sm btn-success">Do This</button>
				<button class="btn btn-sm btn-info">Or This One</button>
			</p>
		</div>
UMI;
        return $html;
    }

    /**
     * @param $args - 获取url参数, 可以指定键值数组 get url args, can be array of key like ['id','key','search']
     * @return array - 参数的键值 the key
     */
    private function getArgs($args)
    {
        $args = is_array($args) ? $args : [$args];
        $arr = [];

        for ($i = 0; $i < count($args); $i++) {
            $key = $args[$i];
            $value = isset($_REQUEST[$key]) ? $_REQUEST[$key] : '';
            $arr[$key] =  $value;
        }
        return $arr;
    }

    #region component
    private function checkboxHtml()
    {
        $disabled = $this->delete ? '' : 'disabled';
        $html = <<<UMI
        <td class="center">
	        <label class="pos-rel">
	            <input type="checkbox" class="ace" $disabled/>
	            <span class="lbl"></span>
	        </label>
	    </td>
UMI;
        return $html;
    }

    private function breadButtonHtml($superAdmin)
    {
        #表格右侧小按钮 small button on the right side of table
        $buttonSmallEdit = $this->ButtonSmallEdit($superAdmin);
        $buttonSmallBrowser = $this->ButtonSmallBrowser($superAdmin);
        $buttonSmallDelete = $this->ButtonSmallDelete($superAdmin);
        $linkHideEdit = $this->LinkHideEdit($superAdmin);
        $linkHideDelete = $this->LinkHideDelete($superAdmin);
        $linkHideBrowser = $this->LinkHideBrowser($superAdmin);

        $html = <<<UMI
        <td>
	    	<div class="hidden-sm hidden-xs btn-group">
	    		$buttonSmallEdit

	    		$buttonSmallBrowser

	    		$buttonSmallDelete
	    	</div>

	        <div class="hidden-md hidden-lg">
	    		<div class="inline pos-rel">
	    			<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
	    				<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
	    			</button>

	    			<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
	    				$linkHideBrowser

                        $linkHideEdit

                        $linkHideDelete
	    			</ul>
	    		</div>
	    	</div>
	    </td>
UMI;
        return $html;
    }

    private function ButtonAdd($superAdmin)
    {
        if ($superAdmin || $this->add) {
            return $this->ButtonAddHtml();
        } else {
            return $this->buttonStyle === 'disable' ?
                $this->ButtonAddHtml('disabled') : '';
        }
    }
    private function ButtonAddHtml($disable = '')
    {
        $html = <<<UMI
        <button class="$this->BtnCssNew $disable">
	    	<i class="ace-icon fa fa-plus"></i>
            New
	    </button>
UMI;
        return $html;
    }

    private function ButtonDelete($superAdmin)
    {
        if ($superAdmin || $this->delete) {
            return $this->ButtonDeleteHtml();
        } else {
            return $this->buttonStyle === 'disable' ?
                $this->ButtonDeleteHtml('disabled') : '';
        }
    }

    private function ButtonDeleteHtml($disable = '')
    {
        $html = <<<UMI
        <button class="$this->BtnCssDelete $disable">
	    	<i class="ace-icon fa fa-trash-o"></i>
	    	Delete
	    </button>
UMI;
        return $html;
    }

    private function ButtonSmallEdit($superAdmin)
    {
        if ($superAdmin || $this->edit) {
            return $this->ButtonSmallEditHtml();
        } else {
            return $this->buttonStyle === 'disable' ?
                $this->ButtonSmallEditHtml('disabled') : '';
        }
    }

    private function ButtonSmallEditHtml($disable = '')
    {
        $html = <<<UMI
        <button class="$this->BtnCssSmallEdit $disable">
            <i class="ace-icon fa fa-pencil bigger-120"></i>
        </button>
UMI;
        return $html;
    }

    private function ButtonSmallBrowser($superAdmin)
    {
        if ($superAdmin || $this->browser) {
            return $this->ButtonSmallBrowserHtml();
        } else {
            return $this->buttonStyle === 'disable' ?
                $this->ButtonSmallBrowserHtml('disabled') : '';
        }
    }

    private function ButtonSmallBrowserHtml($disable = '')
    {
        $html = <<<UMI
        <button class="$this->BtnCssSmallBrowser $disable">
            <i class="ace-icon fa fa-eye bigger-120"></i>
        </button>
UMI;
        return $html;
    }

    private function ButtonSmallDelete($superAdmin)
    {
        if ($superAdmin || $this->delete) {
            return $this->ButtonSmallDeleteHtml();
        } else {
            return $this->buttonStyle === 'disable' ?
                $this->ButtonSmallDeleteHtml('disabled') : '';
        }
    }

    private function ButtonSmallDeleteHtml($disable = '')
    {
        $html = <<<UMI
        <button class="$this->BtnCssSmallDelete $disable">
            <i class="ace-icon fa fa-trash-o bigger-120"></i>
        </button>
UMI;
        return $html;
    }

    private function LinkHideBrowser($superAdmin)
    {
        if ($superAdmin || $this->browser) {
            return $this->LinkHideBrowserHtml();
        } else {
            return $this->buttonStyle === 'disable' ?
                $this->LinkHideBrowserHtml('disabled') : '';
        }
    }

    private function LinkHideBrowserHtml($disable = '')
    {
        if ($disable === 'disabled') {
            $html = <<<UMI
            <li>
                <a href="#">
                    <span class="green" style="cursor:not-allowed">
                    	<i class="ace-icon fa fa-eye bigger-120"></i>
                    </span>
                </a>
            </li>
UMI;
        } else {
            $html = <<<UMI
            <li>
                <a href="#" class="tooltip-info disabled" data-rel="tooltip" title="View">
                    <span class="green">
                        <i class="ace-icon fa fa-eye bigger-120"></i>
                    </span>
                </a>
            </li>
UMI;
        }
        return $html;
    }

    private function LinkHideEdit($superAdmin)
    {
        if ($superAdmin || $this->edit) {
            return $this->LinkHideEditHtml();
        } else {
            return $this->buttonStyle === 'disable' ?
                $this->LinkHideEditHtml('disabled') : '';
        }
    }

    private function LinkHideEditHtml($disable = '')
    {
        if ($disable === 'disabled') {
            $html = <<<UMI
            <li>
                <a href="#">
                    <span class="blue" style="cursor:not-allowed">
                        <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                    </span>
                </a>
            </li>
UMI;
        } else {
            $html = <<<UMI
            <li>
                <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                    <span class="blue">
                        <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                    </span>
                </a>
            </li>
UMI;
        }

        return $html;
    }

    private function LinkHideDelete($superAdmin)
    {
        if ($superAdmin || $this->delete) {
            return $this->LinkHideDeleteHtml();
        } else {
            return $this->buttonStyle === 'disable' ?
                $this->LinkHideDeleteHtml('disabled') : '';
        }
    }

    private function LinkHideDeleteHtml($disable = '')
    {
        if ($disable === 'disabled') {
            $html = <<<UMI
            <li>
                <a href="#">
                    <span class="red" style="cursor:not-allowed">
                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                    </span>
                </a>
            </li>
UMI;
        } else {
            $html = <<<UMI
            <li>
                <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                    <span class="red">
                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                    </span>
                </a>
            </li>
UMI;
        }
        return $html;
    }

    /**
     * 错误信息 the wrong message
     * @param $message
     * @param string $url - 错误信息中可以为按钮设置一个链接 到想要的页面
     *                    - set a url for redirection on the wrong message
     * @return string
     */
    private function wrongMessage($message, $url = '')
    {
        $showingButton = $url === '' ? '' : '<p><button class="btn btn-sm btn-success">Go Set Up</button> <button class="btn btn-sm">Not Now</button></p>';

        $html = <<<UMI
        <div class="alert alert-danger">
	    	<button type="button" class="close" data-dismiss="alert">
	    		<i class="ace-icon fa fa-times"></i>
	    	</button>
	    	<strong>
	    		<i class="ace-icon fa fa-times"></i>
	    		Oh whoops!
	    	</strong>
	    		$message
	    	<br />
	    	$showingButton
	    </div>
UMI;
        return $html;
    }
    #endregion
}