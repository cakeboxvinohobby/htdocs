<?php
namespace app\admin\controller;
use think\Controller;
class Admin extends Controller
{
	public function admin_permission()
    {
        return $this ->fetch('admin_permission');
	}
	
	public function admin_list()
    {
		$pagesize=input('pagesize');
		$users=\think\Db::name('sys_user')->paginate($pagesize?$pagesize:10);
		$this->assign('users',$users);
        return $this ->fetch('admin_list');
	}
	
	public function admin_role()
    {
        return $this ->fetch('admin_role');
	}
	public function admin_role_add(){
		if(request()->isPost()){
			$data=[
				'adminname'=>input('adminname'),
				'adminname'=>input('adminname'),
				'adminname'=>input('adminname'),
			];
			$db=\think\Db::name('sys_user')->insert($data);
			if($db){
				return $this->success('添加成功！');
			}else{
				return $this->success('添加失败！');
			}
			return;
		}
	    return $this ->fetch('admin_role_add');
	}
}
