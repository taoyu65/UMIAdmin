<?php

namespace YM\Umi;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class umiMasterPageBuilder
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
        $path = config('umi.assets_path') . '/ace';
        $userName = Auth::user()->name;
        $logout = url('logout');
        $refresh =  url('refresh') . '?u=' . base64_encode(URL::full());

        #region head of master page
        $list = compact('path', 'userName', 'logout', 'refresh');
        return view('umi::common.master.masterPageHead', $list);
        #endregion
    }
}