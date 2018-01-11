<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by zhangzhengwei@zhongan.com
 * Date: 2018/1/10
 * Time: 15:01
 */
use \QCloud_WeApp_SDK\Auth\LoginService as LoginService;

class MY_Controller extends CI_Controller{

    protected $user;

    public function __construct() {
        $result = LoginService::check();
        // check failed
        if ($result['code'] !== 0) {
            return;
        }
        $this->load->model("FrontUserModel");
        $row = $this->FrontUserModel->getUserInfoByOpenid($result['data']['userInfo']['openId']);
        if(!$row){
            $this->user = $this->FrontUserModel->insertRows($result['data']['userInfo']);
        }
        parent::__construct();
    }
}