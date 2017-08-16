<?php
namespace YM\Umi\PageBuilder;

use YM\Models\Search;
use YM\Models\SearchTab;
use YM\Facades\Umi as Ym;

class umiSearchBuilder_LTE
{
    private $contentList = [];
    private $firstIcon;
    private $currentTableId;
    private $searchContent;
    private $search;

    public function __construct()
    {
        $this->firstIcon = 'green ace-icon fa fa-search bigger-120';
        $this->currentTableId = Ym::currentTableId();
        $this->search = new Search();
    }

    public function searchHtml()
    {
        return $this->search();
    }

    #region component
    private function search()
    {
        $searchTab = new SearchTab();

        $searchTabList = $searchTab->searchTabs($this->currentTableId);

        #获得并缓存所有当前标签的搜索选项
        #get and cache all the content of current tab
        $tabIdList = $searchTabList->pluck('id')->flatten()->all();     //即将被缓存的数据的索引 all the index of data will be cached
        if ($tabIdList == null) return;

        #缓存数据  cached data
        $this->searchContent = $this->search->content($tabIdList);

        #循环所有标签     #for each all the tabs
        $active = 'active';     //第一个标签默认为激活    the first tab will be active by default
        $tabs = '';
        foreach ($searchTabList as $searchTab) {
            $tabDataId = $searchTab->id;
            $tabUiId = 'tab' . $tabDataId;

            $active2 = isset($_REQUEST["dda"]) ? $_REQUEST["dda"] : $active;

            $tabs .= $this->searchTab($searchTab->tab_title, $tabUiId, $active2, $tabDataId);
            $active = '';
        }

        #内容 contents
        $content = '';
        foreach ($this->contentList as $item) {
            $content .= $item;
        }

        $html = <<<UMI
        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab1">
                $tabs
            </ul>

            <div class="tab-content">
                $content
            </div>
        </div>
        <br>
UMI;
        return $html;
    }

    private function searchTab($tabName, $tabUiId, $active, $tabDataId)
    {
        #第一张选显卡显示home(默认)的小图标   #the default home icon on the first tab will be showing
        $homeIcon = $this->firstIcon == '' ? '' : "<i class='$this->firstIcon'></i>";
        $this->firstIcon = '';

        #选项卡的激活状态 tab's active status
        $contentActive = $active == 'active' ? 'in active' : '';
        if (isset($_REQUEST['dda'])) {
            $contentActive = $tabUiId == $_REQUEST['dda'] ? 'in active' : '';
        }
        $active = $contentActive == 'in active' ? 'active' : '';

        $html =<<<UMI
            <li class="$active">
                <a data-toggle="tab" href="#$tabUiId">
                    $homeIcon
                    $tabName
                </a>
            </li>
UMI;

        #添加标签所对应的内容     #add content for current tab
        $content = $this->getContent($tabDataId);
        array_push($this->contentList, $this->addContent($tabDataId, $tabUiId, $content, $contentActive));

        return $html;
    }

    private function addContent($tabDataId, $tabUiId, $content, $active)
    {

        $tableName = Ym::currentTableName();
        $token = csrf_field();
        $menuId = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
        $queryString = "id=$menuId";//$_SERVER['QUERY_STRING'];

        $html =<<<UMI
        <div id="$tabUiId" class="tab-pane fade $active">
            <form class="form-horizontal" role="form" method="post" action="$tableName?$queryString">
                $token
                <div class="form-group">
                    $content
                    <input type="hidden" name="dda" value="$tabUiId">
                    <input type="hidden" name="std" value="$tabDataId">
                </div>
                <div class="row">
			    <div class="col-md-12">
					<button class="btn btn-sm btn-info" type="submit" >
						<i class="ace-icon fa fa-search bigger-110"></i>
						Search
					</button>
					&nbsp; &nbsp; &nbsp;
					<button class="btn btn-sm" type="reset">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						Reset
					</button>
				</div>
			    </div>
            </form>
        </div>
UMI;
        return $html;
    }

    private function getContent($tabDataId)
    {
        $searchFields = $this->searchContent->where('search_tab_id', $tabDataId);

        $contentHtml = '';
        foreach ($searchFields as $searchField) {
            if ($searchField == null) return '';
            $dataType = $searchField->type;
            $dataTypeFactory = new FactorySearchDataType($dataType);
            $search = $dataTypeFactory->getInstance();
            if ($search != null){
                $content = $search->searchFieldInput($searchField);
                $contentHtml .= $content;
            }
        }

        $html =<<<UMI
        $contentHtml
UMI;
        return $html;
    }
    #endregion
}