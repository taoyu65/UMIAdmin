<?php

namespace YM\Umi;


class umiDataTableBuilder
{
    public function __construct()
    {

    }

    public function tableSearch()
    {
        $html = <<<EOD
EOD;
        return $html;
    }

    public function tableHead()
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

    public function tableBody()
    {
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
				            		<button class="btn btn-xs btn-success">
				            			<i class="ace-icon fa fa-check bigger-120"></i>
				            		</button>

				            		<button class="btn btn-xs btn-info">
				            			<i class="ace-icon fa fa-pencil bigger-120"></i>
				            		</button>

				            		<button class="btn btn-xs btn-danger">
				            			<i class="ace-icon fa fa-trash-o bigger-120"></i>
				            		</button>

				            		<button class="btn btn-xs btn-warning">
				            			<i class="ace-icon fa fa-eye bigger-120"></i>
				            		</button>
				            	</div>

				                <div class="hidden-md hidden-lg">
				            		<div class="inline pos-rel">
				            			<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
				            				<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
				            			</button>

				            			<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
				            				<li>
				            					<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
				            						<span class="blue">
				            							<i class="ace-icon fa fa-search-plus bigger-120"></i>
				            						</span>
				            					</a>
				            				</li>

				            				<li>
				            					<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
				            						<span class="green">
				            							<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
				            						</span>
				            					</a>
				            				</li>

				            				<li>
				            					<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
				            						<span class="red">
				            							<i class="ace-icon fa fa-trash-o bigger-120"></i>
				            						</span>
				            					</a>
				            				</li>
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

    public function tableFoot()
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
    #endregion
}