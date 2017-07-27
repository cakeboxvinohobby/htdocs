<?php
namespace app\admin\controller;
use think\Controller;
class Product extends Controller
{
    public function product_list()
    {
        return $this ->fetch('product_list');
	}
	
	public function product_category_add()
    {
        return $this ->fetch('product_category_add');
	}
	
	public function product_category()
    {
        return $this ->fetch('product_category');
	}
	
	public function product_brand()
    {
        return $this ->fetch('product_brand');
	}
	
	public function product_add()
    {
        return $this ->fetch('product_add');
	}
}
