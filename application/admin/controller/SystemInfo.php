<?php
namespace app\admin\controller;
use think\Controller;
class SystemInfo extends Controller
{
    public function system_base()
    {
        return $this ->fetch('system_base');
	}
	  public function system_log()
    {
        return $this ->fetch('system_log');
	}
	 public function system_shielding()
    {
        return $this ->fetch('system_shielding');
	}
	 public function system_data()
    {
        return $this ->fetch('system_data');
	}
	public function system_category()
    {
        return $this ->fetch('system_category');
	}
}
