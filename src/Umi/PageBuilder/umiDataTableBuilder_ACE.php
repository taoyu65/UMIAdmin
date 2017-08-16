<?php

namespace YM\Umi\PageBuilder;

use Illuminate\Support\Facades\Config;
use YM\Models\Search;
use YM\Models\TableRelationOperation;
use YM\Models\UmiModel;
use YM\Facades\Umi as Ym;
use YM\Umi\Admin\AdminStrategy;
use YM\umiAuth\Facades\umiAuth;
use YM\Umi\DataTable\DataType\DataTypeOperation;

class umiDataTableBuilder_ACE
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
    protected $BtnCssSmallRead = 'btn btn-xs btn-warning';
    protected $BtnCssSmallDelete = 'btn btn-xs btn-danger';

    #默认数据表主键为id 可以通过继承修改
    #default data table's primary key is id, can be changed by inheriting this class
    protected $tableId = 'id';

    public function __construct()
    {
        $this->tableName = Ym::currentTableName();

        #获取所有BREAD权限
        #get all bread authorization
        if (Ym::isSystemRole()) {
            $adminStrategy = new AdminStrategy($this->tableName);
            $this->browser = $adminStrategy->browserPermission();
            $this->read = $adminStrategy->readPermission();
            $this->edit = $adminStrategy->editPermission();
            $this->add = $adminStrategy->addPermission();
            $this->delete = $adminStrategy->deletePermission();
        } else {
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
        }

        #获取按钮没有被授权时候的样式,可以设置为不显示或者不可点击
        #get style of button when unauthorized, does not show or not editable
        $this->buttonStyle = Config::get('umi.unAuthorizedAccessStyle');
    }

    public function tableHeadAlert()
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

    public function tableHead()
    {
        #删除按钮 button of delete
        $buttonDelete = '';//$this->ButtonDelete();

        #新建按钮 button of new
        $buttonAdd = $this->ButtonAdd();

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
        $buttonDelete = '';//$this->ButtonDelete();
        $buttonAdd = $this->ButtonAdd();

        $html = <<<UMI
        <p>
            $buttonDelete
            $buttonAdd
		</p>
UMI;
        return $html;
    }

    /**
     * @return string
     */
    public function tableBody()
    {
        #是否有权限浏览表格数据
        #check if have authority to browser the data table
        if (!$this->browser)
            return $this->wrongMessage('you are not authorized to browser this data table');

        #数据表头
        #table Head
        $dataTypeOp = new DataTypeOperation('browser', $this->tableName);
        $tHeads = $dataTypeOp->getTHead();
        if (!$tHeads->first())
            return $this->wrongMessage('Please open and set up field shows up function', '#');
        $tHeadHtml = '';
        foreach ($tHeads as $tHead) {
            $displayName = $tHead->display_name === '' ? $tHead->field : $tHead->display_name;
            $tHeadHtml .= "<th>$displayName</th>";
        }

        #数据表原始内容
        #table original records
        $fields = $dataTypeOp->getFields();
        $perPage = Config::get('umi.umi_table_perPage');

        $umiModel = new UmiModel($this->tableName, 'id', 'desc');
        $whereList = $this->getWhere();
        $dataSet = $umiModel->getSelectedTable($fields);

        #获取搜索结果分页参数
        #get the parameter of result of searching for paginate
        $whereLink = '';
        if (\Request::isMethod('post')){
            if ($whereList != null) {
                foreach ($whereList as $where) {
                    $value = $_REQUEST[$where->field . '-' . $where->id];
                    if ($value == '') continue;
                    if ($where->is_fuzzy) {
                        $whereLink .= "`$where->field` like '%$value%' and ";
                    } else {
                        $whereLink .= "`$where->field`='$value' and ";
                    }
                }
                $whereLink = $whereLink == '' ? '' : $whereLink . ' 1=1';
            }
        } else {
            if (isset($_REQUEST['w']))
                $whereLink = base64_decode($_REQUEST['w']);
        }

        #将参数添加到url接连 并生成新的数据
        #add parameter into url link and generate new data table
        $dataSet = $whereLink == '' ? $dataSet : $dataSet->whereRaw($whereLink);
        $dataSet = $dataSet->paginate($perPage);
        $args = $this->getArgs(['id', 'dd', 'dda', 'page']); //获取参数 get args
        if ($whereLink != '')
            $args['w'] = base64_encode($whereLink);
        $links = $dataSet->appends($args)->links();

        #获取用于执行数据库关联操作的数据
        #get data for execute data table relation operation
        $TRO = new TableRelationOperation();
        //$rules = $TRO->getRulesByNames(Ym::currentTableId(), false);
        $rules = $TRO->getTableRelationOperationByTableId(Ym::currentTableId());
        $activeFieldValueList = [];
        if ($rules) {
            foreach ($dataSet as $ds) {
                $activeFieldValue = '';
                foreach ($rules as $rule) {
                    $activeTableField = $rule->active_table_field;
                    $dsActField = $ds->$activeTableField;
                    $activeFieldValue .= "\"$activeTableField\":\"$dsActField\",";
                }
                #转换成对象类型
                #turn into object
                $activeFieldValue = $activeFieldValue == '' ? '' : "{" . trim($activeFieldValue,',') . "}";
                array_push($activeFieldValueList, $activeFieldValue);
            }
        }

        #是否开启 数据映射功能
        #if available for data reformat
        if (Config::get('umi.data_field_reformat'))
            $regulatedDataSet = $dataTypeOp->regulatedDataSet($dataSet);

        #数据表内容
        #table body
        $trBodyHtml = '';
        if ($regulatedDataSet) {
            $pointer = 0;
            foreach ($regulatedDataSet as $ds) {
                $trBodyHtml .= '<tr>';
                $trBodyHtml .= $this->checkboxHtml();
                foreach ($ds as $item => $value) {
                    $trBodyHtml .= '<td>';
                    $trBodyHtml .= $value;
                    $trBodyHtml .= '</td>';
                }

                #获取数据行的主键值
                #get value of primary key of record
                $primaryKey = Config::get('umi.primary_key');
                $recordId = array_has($ds, $primaryKey) ? $dataSet->all()[$pointer]->$primaryKey : 0;

                $activeFieldValue = $activeFieldValueList[$pointer];
                $trBodyHtml .= $this->breadButtonHtml($recordId, $activeFieldValue);     //获取按钮 get button
                $trBodyHtml .= '</tr>';

                $pointer++;
            }
        }
        $html = <<<UMI
        <div class="row">
            <div class="col-xs-12">
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <!--<th class="center">
                                <label class="pos-rel">
                                    <input type="checkbox" class="ace" />
                                    <span class="lbl"></span>
                                </label>
                            </th>-->
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

    public function getWhere()
    {
        if (\Request::isMethod('post')) {
            #获取search_tab_id        #get search_tab_id
            if (isset($_REQUEST['std'])) {
                $search = new Search();
                $searchList = $search->getSearchByTabId($_REQUEST['std'])->all();
                return $searchList;
            }
        }
    }

    public function tableFoot()
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
            if ($value != '')
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
        return '';
        //return $html;
    }

    private function breadButtonHtml($recordId, $activeFieldValue)
    {
        #表格右侧小按钮
        #small button on the right side of table
        $buttonSmallEdit = $this->ButtonSmallEdit($recordId, $activeFieldValue);
        $buttonSmallRead = $this->ButtonSmallRead($recordId, $activeFieldValue);
        $buttonSmallDelete = $this->ButtonSmallDelete($recordId, $activeFieldValue);
        $linkHideEdit = $this->LinkHideEdit($recordId, $activeFieldValue);
        $linkHideDelete = $this->LinkHideDelete($recordId, $activeFieldValue);
        $linkHideRead = $this->LinkHideRead($recordId, $activeFieldValue);

        $html = <<<UMI
        <td>
	    	<div class="hidden-sm hidden-xs btn-group">
	    		$buttonSmallEdit

	    		$buttonSmallRead

	    		$buttonSmallDelete
	    	</div>

	        <div class="hidden-md hidden-lg">
	    		<div class="inline pos-rel">
	    			<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
	    				<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
	    			</button>

	    			<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
	    				$linkHideRead

                        $linkHideEdit

                        $linkHideDelete
	    			</ul>
	    		</div>
	    	</div>
	    </td>
UMI;
        return $html;
    }

    private function ButtonAdd()
    {
        if ($this->add) {
            return $this->ButtonAddHtml();
        } else {
            return $this->buttonStyle === 'disable' ?
                $this->ButtonAddHtml('disabled') : '';
        }
    }

    private function ButtonAddHtml($disable = '')
    {
        $addUrl = url('adding'). "/$this->tableName";
        $html = <<<UMI
        <button class="$this->BtnCssNew $disable" $disable type="button" onclick="showAdding('$addUrl');">
            <i class="ace-icon fa fa-plus"></i>
            New
        </button>
UMI;
        return $html;
    }

    private function ButtonDelete()
    {
        if ($this->delete) {
            return $this->ButtonDeleteHtml();
        } else {
            return $this->buttonStyle === 'disable' ?
                $this->ButtonDeleteHtml('disabled') : '';
        }
    }

    private function ButtonDeleteHtml($disable = '')
    {
        $html = <<<UMI
        <button class="$this->BtnCssDelete $disable" $disable>
                    <i class="ace-icon fa fa-trash-o"></i>
            Delete
        </button>
UMI;
        return $html;
    }

    private function ButtonSmallEdit($recordId, $activeFieldValue)
    {
        if ($this->edit) {
            return $this->ButtonSmallEditHtml($recordId, $activeFieldValue);
        } else {
            return $this->buttonStyle === 'disable' ?
                $this->ButtonSmallEditHtml($recordId, $activeFieldValue, 'disabled') : '';
        }
    }

    private function ButtonSmallEditHtml($recordId, $activeFieldValue, $disable = '')
    {
        $activeFieldValue = base64_encode($activeFieldValue);
        $tableName = $this->tableName;//Ym::umiEncrypt($this->tableName);
        $parameterField = $activeFieldValue === '' ? '' : "/$activeFieldValue";
        $editUrl = url('editing') . "/$tableName/$recordId$parameterField";

        $html = <<<UMI
        <button class="$this->BtnCssSmallEdit $disable" $disable onclick="showEditing('$editUrl');">
            <i class="ace-icon fa fa-pencil bigger-120"></i>
        </button>
UMI;
        return $html;
    }

    private function ButtonSmallRead($recordId, $activeFieldValue)
    {
        if ($this->read) {
            return $this->ButtonSmallReadHtml($recordId, $activeFieldValue);
        } else {
            return $this->buttonStyle === 'disable' ?
                $this->ButtonSmallReadHtml($recordId, $activeFieldValue, 'disabled') : '';
        }
    }

    private function ButtonSmallReadHtml($recordId, $activeFieldValue, $disable = '')
    {
        $tableName = $this->tableName;//Ym::umiEncrypt($this->tableName);
        $readUrl = url('reading') . "/$tableName/$recordId";

        $html = <<<UMI
        <button class="$this->BtnCssSmallRead $disable" $disable onclick="showReading('$readUrl');">
            <i class="ace-icon fa fa-eye bigger-120"></i>
        </button>
UMI;
        return $html;
    }

    private function ButtonSmallDelete($recordId, $activeFieldValue)
    {
        if ($this->delete) {
            return $this->ButtonSmallDeleteHtml($recordId, $activeFieldValue);
        } else {
            return $this->buttonStyle === 'disable' ?
                $this->ButtonSmallDeleteHtml($recordId, $activeFieldValue, 'disabled') : '';
        }
    }

    private function ButtonSmallDeleteHtml($recordId, $activeFieldValue, $disable = '')
    {
        $activeFieldValue = base64_encode($activeFieldValue);
        $tableName = $this->tableName;//Ym::umiEncrypt($this->tableName);

        $parameterField = $activeFieldValue === '' ? '' : "/$activeFieldValue";
        $deleteUrl = url('deleting') . "/$tableName/$recordId$parameterField";

        $html = <<<UMI
        <button class="$this->BtnCssSmallDelete $disable" $disable onclick="showDeleting('$deleteUrl');">
            <i class="ace-icon fa fa-trash-o bigger-120"></i>
        </button>
UMI;
        return $html;
    }

    private function LinkHideRead($recordId, $activeFieldValue)
    {
        if ($this->read) {
            return $this->LinkHideReadHtml($recordId, $activeFieldValue);
        } else {
            return $this->buttonStyle === 'disable' ?
                $this->LinkHideReadHtml($recordId, $activeFieldValue, 'disabled') : '';
        }
    }

    private function LinkHideReadHtml($recordId, $activeFieldValue, $disable = '')
    {
        $tableName = $this->tableName;//Ym::umiEncrypt($this->tableName);
        $readUrl = url('reading') . "/$tableName/$recordId";

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
                <a href="#" class="tooltip-info disabled" data-rel="tooltip" title="View" onclick="showReading('$readUrl');">
                    <span class="green">
                        <i class="ace-icon fa fa-eye bigger-120"></i>
                    </span>
                </a>
            </li>
UMI;
        }
        return $html;
    }

    private function LinkHideEdit($recordId, $activeFieldValue)
    {
        if ($this->edit) {
            return $this->LinkHideEditHtml($recordId, $activeFieldValue);
        } else {
            return $this->buttonStyle === 'disable' ?
                $this->LinkHideEditHtml($recordId, $activeFieldValue, 'disabled') : '';
        }
    }

    private function LinkHideEditHtml($recordId, $activeFieldValue, $disable = '')
    {
        $activeFieldValue = base64_encode($activeFieldValue);
        $tableName = $this->tableName;//Ym::umiEncrypt($this->tableName);
        $parameterField = $activeFieldValue === '' ? '' : "/$activeFieldValue";
        $editUrl = url('editing') . "/$tableName/$recordId$parameterField";

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
                <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit" onclick="showEditing('$editUrl');">
                    <span class="blue">
                        <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                    </span>
                </a>
            </li>
UMI;
        }

        return $html;
    }

    private function LinkHideDelete($recordId, $activeFieldValue)
    {
        if ($this->delete) {
            return $this->LinkHideDeleteHtml($recordId, $activeFieldValue);
        } else {
            return $this->buttonStyle === 'disable' ?
                $this->LinkHideDeleteHtml($recordId, $activeFieldValue, 'disabled') : '';
        }
    }

    private function LinkHideDeleteHtml($recordId, $activeFieldValue, $disable = '')
    {
        $activeFieldValue = base64_encode($activeFieldValue);
        $tableName = $this->tableName;//Ym::umiEncrypt($this->tableName);

        $parameterField = $activeFieldValue === '' ? '' : "/$activeFieldValue";
        $deleteUrl = url('deleting') . "/$tableName/$recordId$parameterField";

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
                <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete" onclick="showDeleting('$deleteUrl');">
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