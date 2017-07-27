<?php
namespace app\admin\controller;
use think\Controller;
class Member extends Controller
{
    public function member_list()
    {
		$pagesize=input('pagesize');
		$users=\think\Db::name('vino_user')->paginate($pagesize?$pagesize:10);
		$this->assign('users',$users);
        return $this ->fetch('member_list');
	}
	
	public function member_add()
    {
        return $this ->fetch('member_add');
	}
	
	public function member_del()
	{
		$id=input('userid');
		return $this ->$id;
		if(db('vino_user')->delete($id)){
			 return $this ->success('删除用户成功！','member_list');
		}else{
			 return $this ->error('删除用户失败！');
		}
       
	}
	
	public function member_level()
	{
        return $this ->fetch('member_level');
	}
	
	
}
