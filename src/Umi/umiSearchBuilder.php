<?php
namespace YM\Umi;

use YM\Models\SearchTab;
use YM\Facades\Umi as Ym;

class umiSearchBuilder
{
    private $contentList = [];
    private $firstIcon;
    private $tableName;

    public function __construct()
    {
        $this->firstIcon = 'green ace-icon fa fa-search bigger-120';

    }

    public function searchHtml()
    {
        return $this->search();
    }

    #region component
    private function search()
    {
        $tabs = '';

        $searchTab = new SearchTab();

        $active = 'active';
        $searchTabList = $searchTab->searchTabs(Ym::currentTableId());
        foreach ($searchTabList as $searchTab) {
            $tabs .= $this->searchTab($searchTab->tab_title, $active);
            $active = '';
        }

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

    private function searchTab($tabName, $active)
    {
        $html = '';

        #选项卡类型  #tab's type
        $realTabName = explode('?', $tabName);
        $type = count($realTabName) === 2 ? 'dropdown' : 'tab';

        #第一张选显卡显示home(默认)的小图标   #the default home icon on the first tab will be showing
        $homeIcon = $this->firstIcon == '' ? '' : "<i class='$this->firstIcon'></i>";
        $this->firstIcon = '';

        if ($type === 'tab') {

            $html =<<<UMI

            <li class="$active">
                <a data-toggle="tab" href="#$tabName">
                    $homeIcon
                    $tabName
                </a>
            </li>
UMI;
            #添加标签所对应的内容     #add content for current tab
            $content = $this->getContent($tabName, $active);
            array_push($this->contentList, $this->addContent($tabName, $content, $active));

        } elseif ($type === 'dropdown') {

            $dropDownName = $realTabName[0];
            $dropDownList = explode(':', $realTabName[1]);

            $html .= <<<UMI
            <li class="dropdown $active">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                    $dropDownName &nbsp;
                    <i class="green ace-icon fa fa-question bigger-120"></i>
                    <i class="ace-icon fa fa-caret-down bigger-110 width-auto"></i>
                </a>
                <ul class="dropdown-menu dropdown-info">
UMI;

            $contentActive = 'in active';
            foreach ($dropDownList as $dropDown ) {
                $html .= <<<UMI
                    <li>
                        <a data-toggle="tab" href="#$dropDownName$dropDown">$dropDown</a>
                    </li>
UMI;
                #添加标签所对应的内容     #add content for current tab
                $content = $this->getContent($dropDownName.$dropDown, $active);
                array_push($this->contentList, $this->addContent($dropDownName.$dropDown, $content, $contentActive));
                $contentActive = '';
            }

            $html .= <<<UMI
                </ul>
            </li>
UMI;
        } else{
            return '';
        }
        return $html;
    }

    private function addContent($contentId, $content, $active)
    {
        $html =<<<UMI
        <div id="$contentId" class="tab-pane fade $active">
            <p>$content</p>
        </div>
UMI;
        return $html;
    }

    private function getContent($tabName, $active)
    {
        $html =<<<UMI
        $tabName
UMI;
        return $html;
    }
    #endregion
}