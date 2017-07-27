<?php
namespace app\admin\model;
use Think\Db;
use app\admin\model\Base;

class User extends Base{
	//protected $table = 'vino_user';
	public static function login($phone,$password){
		$user=Db::query('select * from vino_user where phone=? and password=?',[$phone,$password]);
		return $user;
	}
	public static function getUserInfoByPhone($phone){
		$user=Db::query('select * from vino_user where phone=?',[$phone]);
		return $user;
	}
	public static function getUserInfoById($id){
		$user=Db::query('select * from vino_user where id=?',[$id]);
		return $user;
	}
}
 ?>