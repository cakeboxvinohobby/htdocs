<?php
namespace app\admin\controller;
use think\Controller;
use think\File;
class Article extends Controller
{
    public function article_list()
    {
		$pagesize=input('pagesize');
		$article=\think\Db::name('vino_information')->order('create_time desc')
		->alias("i")->join('vino_information_type t','i.type =t.id','LEFT')->paginate($pagesize?$pagesize:10);
		$atype=\think\Db::name('vino_information_type') ->select();
		$this->assign('atype',$atype);
		$this->assign('article',$article);
        return $this ->fetch('article_list');
	}
	public function article_add()
    {
		if(request()->isPost()){
			$data=$_POST; 
			$data['articletitle']=input('articletitle');
			$data['articletitle']=input('articlecolumn');
			$data['articletitle']=input('author');
			$data['articletitle']=input('isshow');
			$data['articletitle']=input('istop');
			$data['articletitle']=input('isshow');
			$data['articletitle']=input('istop');
			$file = request()->file('img');
			// 移动到框架应用根目录/public/uploads/ 目录下
			if($_FILES['img']['tmp_name']){
				$info = $file->validate(['size'=>1567118,'ext'=>'jpg,png,gif,ico'])->move(ROOT_PATH . 'public' . DS . '/static/uploadfile');
				if($info){
					// 成功上传后 获取上传信息
					// 输出 jpg
					$data['pic_address']='uploadfile/'.date('Ymd').'/'.$info->getFilename();  
					//echo $info->getExtension();
					// 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
					//echo $info->getSaveName();
					// 输出 42a79759f284b767dfcb2a0197904287.jpg
					//echo $info->getFilename(); 
				}else{
					// 上传失败获取错误信息
					return $this->error($file->getError());
				}
			}else{
				return $this ->error("请选择文件！",'article_type_add');
			}
			
		}
		$atype=\think\Db::name('vino_information_type') ->select();
		$this->assign('atype',$atype);
        return $this ->fetch('article_add');
	}
	
	
	//文章类型列表
	public function article_type_list()
    {
		$pagesize=input('pagesize');
		if(!empty(input('typename'))){
			$atype=\think\Db::name('vino_information_type')
			->where('name','like','%'.input('typename').'%')
			->paginate($pagesize?$pagesize:10);
			$this->assign('atype',$atype);
		}else{
			$atype=\think\Db::name('vino_information_type')->paginate($pagesize?$pagesize:10);
			$this->assign('atype',$atype);
		}
		return $this ->fetch('article_type_list');
	}
	//文章类型添加
	public function article_type_add()
    {	
		if(request()->isPost())
		{
			// 获取表单上传文件
			$data=$_POST; 
			$file = request()->file('img');
			// 移动到框架应用根目录/public/uploads/ 目录下
			if($_FILES['img']['tmp_name']){
				$info = $file->validate(['size'=>1567118,'ext'=>'jpg,png,gif,ico'])->move(ROOT_PATH . 'public' . DS . '/static/uploadfile');
				if($info){
					// 成功上传后 获取上传信息
					// 输出 jpg
					$data['pic_address']='uploadfile/'.date('Ymd').'/'.$info->getFilename();  
					//echo $info->getExtension();
					// 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
					//echo $info->getSaveName();
					// 输出 42a79759f284b767dfcb2a0197904287.jpg
					//echo $info->getFilename(); 
				}else{
					// 上传失败获取错误信息
					return $this->error($file->getError());
				}
			}else{
				return $this ->error("请选择文件！",'article_type_add');
			}
			$data['name']=input('name');
			$validate=\think\Loader::validate('ArticleType');
			if($validate->check($data)){
				$db=\think\Db::name('vino_information_type')->insert($data);
				if($db){
					return $this->success('添加成功！','article_type_list');
				}else{
					return $this->success('添加失败！');
				}
			}else{
				return $this->error($validate->getError());
			}
		}
        return $this ->fetch('article_type_add');
	}
	
	public function article_type_update()
    {
		if(request()->isPost())
		{
			$id=input('id');
			$file = request()->file('img');
			// 获取表单上传文件
			$type=\think\Db::name('vino_information_type')->where('id',$id)->find();
			if($_FILES['img']['tmp_name']){
				$info = $file->validate(['size'=>1567118,'ext'=>'jpg,png,gif,ico'])->move(ROOT_PATH . 'public' . DS . '/static/uploadfile');
				if($info){
					// 成功上传后 获取上传信息
					// 输出 jpg
					$data['pic_address']='uploadfile/'.date('Ymd').'/'.$info->getFilename();  
					//echo $info->getExtension();
					// 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
					//echo $info->getSaveName();
					// 输出 42a79759f284b767dfcb2a0197904287.jpg
					//echo $info->getFilename(); 
				}else{
					// 上传失败获取错误信息
					return $this->error($file->getError());
				}
			}
			if(!empty(input('name'))){
				$type['name']=input('name');  
			}
			$db=\think\Db::name('vino_information_type')->update($type);
			if($db){
				return $this->success('修改成功！','article_type_list');
			}else{
				return $this->error('修改失败！');
			}
		}
        return $this ->fetch('article_type_update');
	}
	
	public function get_article_type()
    {
		$id=input('id');
		if(!empty($id)){
			$type=\think\Db::name('vino_information_type')->where('id',$id)->find();
			$this->assign('type',$type);
		}
		if(input('type')==1){
			  return $this ->fetch('article_type_update');
		}else{
			return $this ->fetch('picture_show');
		}
	}
	
	public function article_type_del()
    {
		$id=input('did');
		if(db('vino_information_type')->delete($id)){
			return $this->success('删除类型成功！');
		}else{
			return $this->success('删除类型失败！');
		}
    
	}
}
