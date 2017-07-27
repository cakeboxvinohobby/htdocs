<?php
namespace app\admin\validate;
use think\Validate;
class Picture extends Validate
{
	protected $rule=[
		'adminname' => 'require|max:25',
	];
	
	protected $message=> [
		'adminname.require' =>'用户名不能为空',
	];
}
