<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-01-11 15:46:58
         compiled from ".\view\datemsg.html" */ ?>
<?php /*%%SmartyHeaderCode:2384054b1c6596654f5-63679514%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '45d1a22e9845d6a4da7c37ae6fc32f9722a7836b' => 
    array (
      0 => '.\\view\\datemsg.html',
      1 => 1420962361,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2384054b1c6596654f5-63679514',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54b1c65988c5a2_01836619',
  'variables' => 
  array (
    'status' => 0,
    'login_flag' => 0,
    'msgs' => 0,
    'msg' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54b1c65988c5a2_01836619')) {function content_54b1c65988c5a2_01836619($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" charset="utf-8">
		<title>Document</title>
		<link rel="stylesheet" type="text/css" href="./static/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="./static/css/style.css" />
		<link rel="stylesheet" type="text/css" href="./static/css/idate.css" />
		<link rel="stylesheet" type="text/css" href="./static/css/common.css" />
		<link rel="stylesheet" type="text/css" href="./static/css/demostyle.css" />
		<?php echo '<script'; ?>
 src="./static/js/jquery.js" type="text/javascript" charset="utf-8"><?php echo '</script'; ?>
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
		<?php echo '<script'; ?>
 src="./static/js/idate.js" type="text/javascript" charset="utf-8"><?php echo '</script'; ?>
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
				<h1>留言板</h1><a href="index.php">去留言</a>
			</center>
			<center>
				<p class="green">下一步 上传头像，并预览(已完成)</p>
				<p>下一步 登陆注册，加载更多</p>
				<div id="loading"></div>
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
			<div id="icalendar" class="icalendar">
				<div class="ititle">
					<div id="prev">
						&lt; </div>
					<div id="title_time"></div>
					<div id="next">&gt;</div>
				</div>
				<div class="mg-top-10">&nbsp;</div>
				<table>
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</table>
			</div>
			<div id="seltime">当前选择日期是：<span></span></div>
			<div id="success"></div>
			
			<div id="month_msg_date" class=""></div>
		</div>
	</body>

</html><?php }} ?>
