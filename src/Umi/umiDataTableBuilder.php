<?php

namespace YM\Umi;

use YM\umiAuth\Facades\umiAuth;

class umiDataTableBuilder
{
    private $browser;
    private $read;
    private $edit;
    private $add;
    private $delete;

    public function __construct()
    {
        $administrator = new administrator();
        $tableName = $administrator->currentTableName();

        $permission = 'browser-' . $tableName;
        $this->browser = umiAuth::can($permission) ? true : false;

        $permission = 'read-' . $tableName;
        $this->read = umiAuth::can($permission) ? true : false;

        $permission = 'edit-' . $tableName;
        $this->edit = umiAuth::can($permission) ? true : false;

        $permission = 'add-' . $tableName;
        $this->add = umiAuth::can($permission) ? true : false;

        $permission = 'delete-' . $tableName;
        $this->delete = umiAuth::can($permission) ? true : false;
    }

    public function tableSearch()
    {
        $html = <<<EOD
EOD;
        return $html;
    }

    public function tableHead($superAdmin = false)
    {
        #删除按钮 button of delete
        $buttonDelete = $superAdmin || $this->delete ? $this->ButtonDelete() : '';

        #新建按钮 button of new
        $buttonNew = $superAdmin || $this->add ? $this->ButtonNew() : '';

        $html = <<<EOD
        <p>
            $buttonDelete
            $buttonNew
		</p>
EOD;
        return $html;
    }

    public function tableHeadSuperAdmin()
    {
        $buttonDelete = $this->ButtonDelete();
        $buttonNew = $this->ButtonNew();

        $html = <<<EOD
        <p>
            $buttonDelete
            $buttonNew
		</p>
EOD;
        return $html;
    }

    public function tableBody($superAdmin = false)
    {
        #表格右侧小按钮 small button on the right side of table
        $buttonSmallEdit = $superAdmin || $this->edit ? $this->ButtonSmallEdit() : '';
        $buttonSmallBrowser = $superAdmin || $this->browser ? $this->ButtonSmallBrowser() : '';
        $buttonSmallDelete = $superAdmin || $this->delete ? $this->ButtonSmallDelete() : '';
        $linkHideEdit = $superAdmin || $this->edit ? $this->LinkHideEdit() : '';
        $linkHideDelete = $superAdmin || $this->delete ? $this->LinkHideDelete() : '';
        $linkHideBrowser = $superAdmin || $this->browser ? $this->LinkHideBrowser() : '';

        $html = <<<EOD
        <div class="row">
		    <div class="col-xs-12">
			    <table id="simple-table" class="table  table-bordered table-hover">
				    <thead>
					    <tr>
						    <th class="center">
							    <label class="pos-rel">
									<input type="checkbox" class="ace" />
									<span class="lbl"></span>
								</label>
							</th>
							<th class="detail-col">Details</th>
							<th>Domain</th>
							<th>Price</th>
							<th class="hidden-480">Clicks</th>

							<th>
								<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
								Update
							</th>
							<th class="hidden-480">Status</th>

							<th></th>
		                </tr>
			        </thead>

			        <tbody>
				        <tr>
				            <td class="center">
						        <label class="pos-rel">
							        <input type="checkbox" class="ace" />
							        <span class="lbl"></span>
						        </label>
				            </td>

				            <td class="center">
				            	<div class="action-buttons">
				            		<a href="#" class="green bigger-140 show-details-btn" title="Show Details">
				            			<i class="ace-icon fa fa-angle-double-down"></i>
				            			<span class="sr-only">Details</span>
				            		</a>
				            	</div>
				            </td>

				            <td>
				            	<a href="#">ace.com</a>
				            </td>
				            <td>$45</td>
				            <td class="hidden-480">3,330</td>
				            <td>Feb 12</td>

				            <td class="hidden-480">
				            	<span class="label label-sm label-warning">Expiring</span>
				            </td>

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
				        </tr>
				    </tbody>
				</table>
			</div>
		</div>
EOD;
        return $html;
    }

    public function tableFoot($superAdmin = false)
    {
        $html = <<<EOD

EOD;
        return $html;
    }

    #region component
    private function ButtonNew()
    {
        $html = <<<EOD
        <button class="btn btn-sm btn-success">
	    	<i class="ace-icon fa fa-plus"></i>
            New
	    </button>
EOD;
        return $html;
    }

    private function ButtonDelete()
    {
        $html = <<<EOD
        <button class="btn btn-sm btn-danger">
	    	<i class="ace-icon fa fa-trash-o"></i>
	    	Delete
	    </button>
EOD;
        return $html;
    }

    private function ButtonSmallEdit()
    {
        $html = <<<EOD
        <button class="btn btn-xs btn-info">
            <i class="ace-icon fa fa-pencil bigger-120"></i>
        </button>
EOD;
        return $html;
    }

    private function ButtonSmallBrowser()
    {
        $html = <<<EOD
        <button class="btn btn-xs btn-warning">
            <i class="ace-icon fa fa-eye bigger-120"></i>
        </button>
EOD;
        return $html;
    }

    private function ButtonSmallDelete()
    {
        $html = <<<EOD
        <button class="btn btn-xs btn-danger">
            <i class="ace-icon fa fa-trash-o bigger-120"></i>
        </button>
EOD;
        return $html;
    }

    private function LinkHideBrowser()
    {
        $html = <<<EOD
        <li>
            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                <span class="green">
                	<i class="ace-icon fa fa-eye bigger-120"></i>
                </span>
            </a>
        </li>
EOD;
        return $html;
    }

    private function LinkHideEdit()
    {
        $html = <<<EOD
        <li>
            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                <span class="blue">
                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                </span>
            </a>
        </li>
EOD;
        return $html;
    }

    private function LinkHideDelete()
    {
        $html = <<<EOD
        <li>
            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                <span class="red">
                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                </span>
            </a>
        </li>
EOD;
        return $html;
    }
    #endregion
}