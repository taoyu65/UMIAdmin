<?php

namespace YM\Umi\Auth;

use YM\Umi\Contracts\PrintHtml\MasterPageInterface;

abstract class UmiMasterPage implements MasterPageInterface
{

    public function header()
    {
        $a= 'head';
        $string = <<<EOD
        <div>$a</div>
EOD;
        return $string;
    }

    public function sideMenu()
    {
        $html = <<<EOD
        ''
EOD;
        return $html;
    }

    public function body()
    {
        $html = <<<EOD
        ''
EOD;
        return $html;
    }

    public function footer()
    {
        $html = <<<EOD
        <span class="bigger-120">
			<span class="blue bolder">Umi Admin</span>
			Application &copy; 2017
		</span>
		&nbsp; &nbsp;
		<span class="action-buttons">
			<a href="#">
			<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
			</a>

			<a href="#">
			    <i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
			</a>

			<a href="#">
				<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
			</a>
		</span>
EOD;
        return $html;
    }


}