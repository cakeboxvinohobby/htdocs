<?php
namespace app\admin\controller;
use think\Controller;
use think\File;
class Upload extends Controller{
 public function upload()
   {
		$files = request()->file('');
		$cars=array();
		foreach($files as $file){
				$info = $file->move(ROOT_PATH . 'public' . DS . '/static/uploadfile');
				if($info){
					$cars[]='uploadfile/'.date('Ymd').'/'.$info->getFilename();					
				}else{
					// 上传失败获取错误信息
					return $this->error($file->getError());
				}
			}
		echo json_encode($cars);
    }
	/**
	 * 首页
	 */
	public function index(){
        // 如果是post提交则显示上传的文件 否则显示上传页面
        if(request()->isPost()){
            dump($_POST);die;
        }else{
            return $this->fetch();
        }
           
	}

    /**
     * webuploader 上传文件
     */
    public function ajax_upload(){
        // 根据自己的业务调整上传路径、允许的格式、文件大小
        $this->ajax_uploader();
    }

    /**
     * webuploader 上传demo
     */
    public function webuploader(){
        // 如果是post提交则显示上传的文件 否则显示上传页面
        if(request()->isPost()){
            dump($_POST);die;
        }else{
            $this->display();
        }
    }

    //获取webuploader上传的文件路径并返回给ajax
    public function ajax_uploader(){    
        // 获取表单上传文件
        $files = request()->file('');
		$path='';
        foreach($files as $file){        
            // 移动到框架应用根目录/public/uploads/ 目录下        
				$info = $file->move(ROOT_PATH . 'public' . DS . '/static/uploadfile');
           if($info){
                // 输出 42a79759f284b767dfcb2a0197904287.jpg
				$path ='uploadfile/'.date('Ymd').'/'.$info->getFilename();		
            }else{
                // 上传失败获取错误信息
                return $this->error($file->getError()) ;
            }    
        }
        echo json_encode($path);
    }

};
?>