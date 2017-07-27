<?php
namespace app\admin\controller;
use think\Controller;
class Feedback extends Controller
{
    public function feedback_list()
    {
        return $this ->fetch('feedback_list');
	}
}
