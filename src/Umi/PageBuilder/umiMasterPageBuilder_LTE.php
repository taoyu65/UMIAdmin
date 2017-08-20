<?php

namespace YM\Umi\PageBuilder;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use YM\Umi\Contracts\PageBuilder\masterPageInterface;

class umiMasterPageBuilder_LTE implements masterPageInterface
{
    public function masterPageHead()
    {
        return $this->headHtml();
    }

    public function masterPageBody()
    {
        return '';
    }

    public function masterPageFoot()
    {
        return view('umi::common.master.masterPageFoot');
    }

    private function headHtml()
    {
        $assetPath = url(config('umi.assets_path'));
        $path = $assetPath . '/lte';
        $userName = Auth::user()->name;
        $logout = url('logout');
        $refresh =  url('refresh') . '?u=' . base64_encode(URL::full());

        #region head of master page
        $list = compact('path', 'assetPath', 'userName', 'logout', 'refresh');
        return view('umi::common.master.masterPageHead', $list);
        #endregion
    }
}