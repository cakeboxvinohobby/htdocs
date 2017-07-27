<?php
namespace app\admin\controller;
use think\Controller;
class Picture extends Controller
{
    public function picture_list()
    {
		$pagesize=input('pagesize');
		if(!empty(input('search'))){
			$ad=\think\Db::name('vino_ad')
			->where('name','like','%'.input('search').'%')
			->paginate($pagesize?$pagesize:10);
			$this->assign('ad',$ad);
		}else{
			$ad=\think\Db::name('vino_ad')->paginate($pagesize?$pagesize:10);
			$this->assign('ad',$ad);
		}
        return $this ->fetch('picture_list');
	}
	public function picture_add()
    {	
		if(request()->isPost())
		{
			// 获取表单上传文件
			$data=[
				'title' =>input('title'),
				'state' => 0,
				'time'  => time(),
			]; 
			$file = request()->file('img');
			// 移动到框架应用根目录/public/uploads/ 目录下
			if($_FILES['img']['tmp_name']){
				$info = $file->validate(['size'=>1567118,'ext'=>'jpg,png,gif,ico'])->move(ROOT_PATH . 'public' . DS . '/static/uploadfile');
				if($info){
					// 成功上传后 获取上传信息
					$data['ad_path']='uploadfile/'.date('Ymd').'/'.$info->getFilename();  
				}else{
					// 上传失败获取错误信息
					return $this->error($file->getError());
				}
			}else{
				return $this ->error("请选择文件！",'picture_add');
			}
			$db=\think\Db::name('vino_ad')->insert($data);
			if($db){
				return $this->success('添加成功！','picture_list');
			}else{
				return $this->success('添加失败！');
			}
		}
        return $this ->fetch('picture_add');
	}
	public function picture_update2()
    {	
		$data =\think\Db::name('vino_ad')->where('id',input('id'))->find();
		if(request()->isPost())
		{
		
			// 获取表单上传文件
			if(!empty(input('title'))){
				$data['title']=input('title');
			}
			$file = request()->file('img');
			// 移动到框架应用根目录/public/uploads/ 目录下
			if($_FILES['img']['tmp_name']){
				$info = $file->validate(['size'=>1567118,'ext'=>'jpg,png,gif,ico'])->move(ROOT_PATH . 'public' . DS . '/static/uploadfile');
				if($info){
					// 成功上传后 获取上传信息
					$data['ad_path']='uploadfile/'.date('Ymd').'/'.$info->getFilename();  
				}else{
					// 上传失败获取错误信息
					return $this->error($file->getError());
				}
			}else{
				return $this ->error("请选择文件！",'picture_update');
			}
			$db=\think\Db::name('vino_ad')->update($data);
			if($db){
				return $this->success('修改成功！','picture_list');
			}else{
				return $this->success('修改失败！');
			}
		}
		$this->assign('ad',$data);
    	return $this ->fetch('picture_update');
	}
	public function picture_del(){
		$id=input('did');
		if(db('vino_ad')->delete($id)){
			return $this->success('删除类型成功！');
		}else{
			return $this->success('删除类型失败！');
		}
	}
	
	public function picture_update(){
		$id=input('did');
		$ad=\think\Db::name('vino_ad') ->where('id',$id)->find();
		if($ad['state']==0){
			$ad['state']=1;
		}else{
			$ad['state']=0;
		}
		$db=\think\Db::name('vino_ad')->update($ad);
		if($db){
			return $this->success('修改成功！');
		}else{
			return $this->error('修改失败！');
		}
	}
}
