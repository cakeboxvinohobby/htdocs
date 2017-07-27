<?php
namespace app\admin\validate;
use think\Validate;
class ArticleType extends Validate
{ 
	protected $rule=[
		'name' => 'require|max:200|unique:vino_information_type',
	];
	protected $message=[
		'name.require' =>'类型名称不能为空!',
		'name.max' =>'类型名称大于200位！',
		'name.unique'=>'类型名称不能重复！',
	];
}
