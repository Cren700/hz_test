<?php
class Uploadfile extends HZ_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->smarty->display('upload.tpl');
    }

    public function uploadFile($type = 'img')
    {
        $data = doUpload($type);
        echo json_encode($data);
    }
}