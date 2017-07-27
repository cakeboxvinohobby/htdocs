<?php
namespace app\index\model;
use Think\Db;

class Testsss extends BaseModel{
	public function login($loginName,$loginPwd){
		$phone=$obj["phone"];
		$password=$obj["password"];
		$user=Db::query('select * from vino_user where phone=? and password=?',[$request->get('phone'),$request->get('password')]);
		return current($user);
	}
	  /**
	  * 获取用户信息
	  */
     public function get($userId=0){

	 	$userId = intval($userId?$userId:I('id',0));
		$user = $this->where("userId=".$userId)->find();
		if(!empty($user) && $user['userType']==1){
			//加载商家信息
		 	$sp = M('shops');
		 	$shops = $sp->where('userId='.$user['userId']." and shopFlag=1")->find();
		 	if(!empty($shops))$user = array_merge($shops,$user);
		}
		return $user;
	 }
	 
	/**
	  * 获取用户信息
	  */
     public function getUserInfo($loginName,$loginPwd){
		$loginPwd = md5($loginPwd);
	 	$rs = $this->where(" loginName ='%s' AND loginPwd ='%s' ",array($loginName,$loginPwd))->find();
	    return $rs;
	 }
	 
	/**
	  * 获取用户信息
	  */
     public function getUserById($obj){
		$userId = (int)$obj["userId"];
	 	$rs = $this->where(" userId ='%s' ",array($userId))->find();
	    return $rs;
	 }
 ?>