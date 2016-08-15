<?php
/**
 * @Author shaowei
 * @Date   2016-05-10
 */

namespace src\admin\controller;

class HomeController extends AdminController
{
    public function index()
    {
        $data = array(
            'iframe' => '/admin/Event/listPage',
            'account' => $this->account,
        );
        $this->display('framwork', $data);
    }
}
