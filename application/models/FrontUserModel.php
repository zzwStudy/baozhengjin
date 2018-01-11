<?php

/**
 * Created by zhangzhengwei@zhongan.com
 * Date: 2018/1/10
 * Time: 14:36
 */
class FrontUserModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function getUserInfoByOpenid($openid){
        $query = $this->db->get_where('user', array('openid' => $openid));
        return $query->result();
    }

    public function getUserInfoById($id){
        $query = $this->db->get_where('user', array('id' => $id));
        return $query->result();
    }

    public function getUserListByIds($ids){
        $query = $this->db->where_in('user', array('id' => $ids));
        return $query->result();
    }

    public function insertRows($row){
        $data = [
            'nickname' => $row['nickname'],
            'openid' => $row['openId'],
            'unionid' => isset($row['unionid']) ? $row['unionid'] : '',
            'avatar_url' => $row['avatarUrl'],
            'gender' => $row['gender'],
            'city' => $row['city'],
            'balance' => 0,
            'country' => $row['country'],
            'province' => $row['province'],
            'language' => $row['language'],
            'create_date' => date('Y-m-d H:i:s',time()),
            'update_date' => date('Y-m-d H:i:s',time())
        ];
        $res = $this->db->insert('user', $data);
        if($res){
            $id = $this->db->insert_id();
            $data['id'] = $id;
        }
        return $data;
    }
}