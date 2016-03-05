<?php
	
	//这是一个用于保存分页信息的类
	class FenyePage{
		public $pageSize=10;
		public $res_array;  //这是显示数据
		public $rowCount;   //这是从数据库中获取
		public $pageNow=1;  //用户指定的
		public $pageCount;  //这个是计算得到的
		public $navigate;   //上下页页导航
        public $goto;      //跳转

	}

?>