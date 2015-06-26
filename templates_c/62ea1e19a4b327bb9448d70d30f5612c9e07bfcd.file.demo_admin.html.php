<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-26 11:29:39
         compiled from ".\view\demo_admin.html" */ ?>
<?php /*%%SmartyHeaderCode:17836558cc723c86391-96782616%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '62ea1e19a4b327bb9448d70d30f5612c9e07bfcd' => 
    array (
      0 => '.\\view\\demo_admin.html',
      1 => 1420971312,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17836558cc723c86391-96782616',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'status' => 0,
    'login_flag' => 0,
    'msgs' => 0,
    'msg' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_558cc723dd1858_13852937',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_558cc723dd1858_13852937')) {function content_558cc723dd1858_13852937($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" charset="utf-8">
		<title>Document</title>
		<link rel="stylesheet" type="text/css" href="./static/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="./static/css/style.css" />
		<link rel="stylesheet" type="text/css" href="./static/css/common.css" />
		<link rel="stylesheet" type="text/css" href="./static/css/demostyle.css" />
		<?php echo '<script'; ?>
 src="./static/js/jquery.js" type="text/javascript" charset="utf-8"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="./static/js/ajaxupload.3.5.js" type="text/javascript" charset="utf-8"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="./static/js/uploadimg.js" type="text/javascript" charset="utf-8"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="./static/bootstrap/js/bootstrap.js" type="text/javascript" charset="utf-8"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="./static/bootstrap/js/bootstrap.min.js" type="text/javascript" charset="utf-8"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="./static/js/demo.js" type="text/javascript" charset="utf-8"><?php echo '</script'; ?>
>
		<style>
			body {
				padding-top: 50px;
				padding-bottom: 20px;
			}
		</style>
	</head>

	<body>
		<div class="coverdiv"></div>
		<div class="signup-div" id="signup-id">
			<button type="button" class="close">
			</button>
			<form class="form-signin" role="form" action="index.php?c=demo&a=signup" method="post">
				<h2 class="form-signin-heading">Please sign up</h2>
				<input type="text" id="username" name="username" class="form-control" placeholder="Email address" required autofocus>
				<input type="password" id="password" name="password" class="form-control psw1" placeholder="Password" required>
				<input type="password" class="form-control psw2" placeholder="Confirm Password" required>
				<div class="checkbox">
					<label>
						<input type="checkbox" value="remember-me"> Remember me
					</label>
				</div>
				<button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
			</form>
		</div>

		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Project name</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<?php if (($_smarty_tpl->tpl_vars['status']->value=="yes")) {?>
					<span class="label label-success">
						<?php echo $_smarty_tpl->tpl_vars['login_flag']->value;?>

					</span> <?php } else {
if (($_smarty_tpl->tpl_vars['status']->value=="no")) {?>
					<span class="label label-warning">
						<?php echo $_smarty_tpl->tpl_vars['login_flag']->value;?>

					</span><?php }?>
					<form class="navbar-form navbar-right" role="form" action="index.php?c=demo&a=signin" method="post">
						<div class="form-group">
							<input type="text" id="username" name="username" placeholder="Email" class="form-control">
						</div>
						<div class="form-group">
							<input type="password" id="password" name="password" placeholder="Password" class="form-control">
						</div>
						<button type="submit" class="btn btn-success">Sign in</button>
						<a class="" href="http://www.baidu.com" id="signup">Sign Up</a>
					</form>
					<?php }?>
				</div>
				<!--/.navbar-collapse -->
			</div>
		</nav>
		<div class="fl col-xs-8">
			<center>
				<h1>留言板</h1><a href="index.php?c=demo&a=datemsg">查看留言日历</a>
			</center>
			<center>
				<p class="green">下一步 上传头像，并预览(已完成)</p>
				<p>下一步 登陆注册，加载更多</p>
			</center>
			<div class="mg-top-20"></div>
			<div class="msgs" id="msgs">
				<?php  $_smarty_tpl->tpl_vars['msg'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['msg']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['msgs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['msg']->key => $_smarty_tpl->tpl_vars['msg']->value) {
$_smarty_tpl->tpl_vars['msg']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['msg']->key;
?>
				<div class="mycontainer">
					<img src="<?php echo $_smarty_tpl->tpl_vars['msg']->value['guest_portrait'];?>
" alt="" class="guest-portrait" title=<?php echo $_smarty_tpl->tpl_vars['msg']->value["uname"];?>
 />
					<span class="uname"><?php echo $_smarty_tpl->tpl_vars['msg']->value["uname"];?>
</span>
					<img <?php if (($_smarty_tpl->tpl_vars['msg']->value['sex'])==1) {?>src="./static/pic/sex1.jpg"<?php } else { ?>src="./static/pic/sex2.jpg"<?php }?> alt="" class="usex" title=<?php echo $_smarty_tpl->tpl_vars['msg']->value["uname"];?>
 />
					<span class="time"><?php echo date("Y-m-d H:i:s",$_smarty_tpl->tpl_vars['msg']->value['ontime']);?>
</span>
					<br>
					<pre class="content"><?php echo $_smarty_tpl->tpl_vars['msg']->value["content"];?>
</pre>
					<a class="dropmsg" href="index.php?c=demo&a=delmsg&id=<?php echo $_smarty_tpl->tpl_vars['msg']->value['id'];?>
">
						<div class="content-close bd-r-100 display-none">×</div>
					</a>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class="box col-xs-4">
			<form role="form" action="index.php?c=demo&a=index" method="post">
				<div class="form-group">
					<label for="exampleInputEmail1">UserName</label>
					<input type="text" class="form-control" id="username" name="username" placeholder="Enter your name">
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">上传头像</label>
					<label for="exampleInputEmail1" id="divpicview1">未选择文件</label>
					<div class="pos-r">
						<a class=" upload pos-a top-0">上传</a>
						<input type="file" class="upload display-none" id="upload" name="upload" placeholder="Enter your name">
						<img id="avatar1" src="" alt="" class="w-100 h-100 " />
					</div>
				</div>
				<label class="radio-inline">
					<input type="radio" name="sexRadio" id="sexRadio1" value="1" checked=""> Man
				</label>
				<label class="radio-inline">
					<input type="radio" name="sexRadio" id="sexRadio2" value="2"> Woman
				</label>
				<div class="form-group">
					<label for="content">Content</label>
					<textarea class="form-control" rows="3" id="content" name="content"></textarea>
				</div>
				<div class="alert alert-warning alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
					</button>
					<strong>Warning!</strong> Better check yourself, you're not looking too good.
				</div>
				<input type="hidden" id="wimg1" name="wimg1" />
				<input type="hidden" id="wimgnm1" name="wimgnm1" />
				<button type="submit" id="addmsg" class="btn btn-default" onclick="check(this.form)">Submit</button>
			</form>
		</div>
	</body>

</html><?php }} ?>
