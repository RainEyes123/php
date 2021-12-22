<?php
/**
 * 管理员模块控制类
 */
class adminController extends platformController {//继承后台平台控制器
	/**
	 * 登录方式
	 */
	public function loginAction() {
		//判断是否有表单提交
		if(!empty($_POST)) {
			//实例化admin模型
			$adminModel = new adminModel();
			//调用验证方法
			if ($adminModel->checkByLogin()){
				//登录成功
				session_start();
				$_SESSION['admin'] = 'yes';//实例化admin模型，调用模型中的验证方法
				//跳转
				$this->jump('index.php?p=admin');
			} else {
				//登录失败
				die('登录失败，用户名或密码错误.');
			}
		}
		//载入视图文件
		require('./application/admin/view/admin_login.html');
	}
	/**
	 * 退出方法
	 */
	public function logoutAction(){
		$_SESSION = null;
		session_destroy();
		//跳转
		$this->jump('index.php?p=admin');
	}
}
?>