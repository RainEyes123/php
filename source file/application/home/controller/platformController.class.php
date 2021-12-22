<?php
/**
 * home 平台控制器
 */
class platformController {
	/**
	 * 定义了跳转方法
	 * @param $url 目标URL
	 * @param $msg 提示信息
	 * @param $time 提示秒数
	 */

	protected function jump($url,$msg='',$time = 2) {
		// 有无提示信息
		if ($msg == '') {
			//没有提示信息
			header('Location:$url');
		} else {
			//有提示信息
			require './application/home/view/jump.html';
		}
		//终止脚本执行
		die;
	}
}
?>