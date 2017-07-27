<?php
namespace app\common\controller;
use think\File;
class Upload{
 public function upload()
   {
		$file = request()->file('');
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
};
?>