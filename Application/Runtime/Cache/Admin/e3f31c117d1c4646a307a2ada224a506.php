<?php if (!defined('THINK_PATH')) exit();?>


<!DOCTYPE HTML>
<html>
<head>
<title>Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Modern Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link href="/Public/Admin/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="/Public/Admin/css/style.css" rel='stylesheet' type='text/css' />
<!-- Graph CSS -->
<link href="/Public/Admin/css/lines.css" rel='stylesheet' type='text/css' />
<link href="/Public/Admin/css/font-awesome.css" rel="stylesheet">
<!-- jQuery -->
<script src="/Public/Admin/js/jquery.min.js"></script>
<link href="/Public/Admin/css/custom.css" rel="stylesheet">
<!-- Metis Menu Plugin JavaScript -->
<script src="/Public/Admin/js/metisMenu.min.js"></script>
<script src="/Public/Admin/js/custom.js"></script>
<!-- Graph JavaScript -->
<script src="/Public/Admin/js/d3.v3.js"></script>
<script src="/Public/Admin/js/rickshaw.js"></script>
   <script src="/Public/Admin/js/bootstrap.min.js"></script>
</head>
<body>
<div id="wrapper">
     <!-- Navigation -->
        <nav class="top1 navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">当前登录员：<font color=red><?php echo ($names); ?></font></a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-nav navbar-right">
        
      </ul>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <?php if($manager == 2): ?><li>
                                <a href="/index.php/Admin/Index/main"><i class="fa fa-dashboard fa-fw nav_icon"></i>管理员列表</a>
                            </li><?php endif; ?>
                        <li>
                            <a href="#"><i class="fa fa-indent nav_icon"></i>产品管理<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <!--<li>-->
                                    <!--<a href="/index.php/Admin/Index/addproduct">添加产品</a>-->
                                <!--</li>-->
                                <li>
                                    <a href="/index.php/Admin/Index/productlist">产品管理</a>
                                </li>
                            </ul>
                        </li>
                        <?php if($manager == 2): ?><li>
                            <a href="#"><i class="fa fa-indent nav_icon"></i> 订单管理<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/index.php/Admin/Index/select">订单查询</a>
                                </li>
                            </ul>                         
                        </li><?php endif; ?>
                        <?php if($manager == 2): ?><li>
                            <a href="#"><i class="fa fa-indent nav_icon"></i>用户管理<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                  <li>
                                    <a href="/index.php/Admin/Menber/select">用户列表</a>
                                </li>
                            </ul>
                        </li><?php endif; ?>
                        <li>
                            <a href="#"><i class="fa fa-indent nav_icon"></i>充值管理<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/index.php/Admin/Menber/usermessage">资金列表</a>
                                </li>
                                <li>
                                    <a href="/index.php/Admin/Menber/recharge">会员充值</a>
                                </li>
                                <!--<li>-->
                                    <!--<a href="/index.php/Admin/Menber/tixiansheng">提现审核</a>-->
                                <!--</li>-->
                            </ul>
                        </li>
                        
                        <li>
                            <a href="#"><i class="fa fa-indent nav_icon"></i>PK设置<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/index.php/Admin/Config/pk">PK设置</a>
                                </li>
                                <li>
                                    <a href="/index.php/Admin/Config/team">团战设置</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-indent nav_icon"></i>文章管理<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/index.php/Admin/Article/lists">公告管理</a>
                                </li>
                            </ul>
                        </li>
                          <li>
                            <a href="/index.php/admin/User/logOut"><i class="fa fa-flask fa-fw nav_icon"></i>退出系统</a>
                        </li>
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
           
        
        <div id="page-wrapper">
        <div class="graphs">	  
    <div class="content_bottom">
     <div class="col-md-12 span_3">
		  <div class="bs-example1" data-example-id="contextual-table">
			  <h3>用户列表</h3>
			  <form class="form-horizontal" action="" method="get" enctype="multipart/form-data">
				  <div class="form-group">
					  <label for="focusedinput" class="col-sm-2 control-label">用户名</label>
					  <div class="col-sm-8">
						  <input type="text" name="name" value="" class="form-control1" id="focusedinput" placeholder="">
						  <p style="margin-left: 200px;margin-top: 20px;"></p><button class="btn-success btn">Submit</button>
					   </div>
					  <div class="col-sm-2">
						  <p class="help-block"></p>
					  </div>
				  </div>

			  </form>
		    <table class="table">
		      <thead>

		        <tr style="text-align: center;">

		        </tr>
		        <tr>
		          <th>用户id</th>
					<th>上家id</th>
					<th>好友id</th>
					<th>电话(账号)</th>
					<th>姓名</th>
				  <th>钱包</th>
					<th>当前鱼</th>
					<th>购买鱼次数</th>
					<th>比赛次数</th>
		          <!--<th>注册时间</th>-->
				 <!--<th>操作</th>-->
		        </tr>
		      </thead>
		      <tbody>	      
		      <?php  $i = 1; ?>
		      <?php if(is_array($users)): foreach($users as $key=>$v): if(($i%2)==1){ echo "<tr class='active'>"; }else{ echo "<tr class='info'>"; } ?>
		          <th scope="row"><?php echo ($v["uid"]); ?></th>
				  <th><?php if($v['fid']){echo $v['fid'];}else{echo '无';} ?> </th>
				  <th><?php if($v['fids']){echo $v['fids'];}else{echo '无';} ?></th>
				  <th><?php echo ($v["phone"]); ?></th>
				  <th><?php echo ($v["name"]); ?></th>
				  <th><?php echo ($v["incomebag"]); ?></th>
				  <th><?php echo ($v["fishname"]); ?></th>
				  <th><?php echo ($v["buyfishnum"]); ?></th>
				  <th><?php echo ($v["matchnum"]); ?></th>
				  <!--<td><?php echo ($v["addymd"]); ?></td>-->
				  <td><a href="/index.php/Admin/Menber/editUser/uid/<?php echo ($v["uid"]); ?>">详 情</a></td>

			  </tr>
		      	<?php $i++ ; endforeach; endif; ?>		      
		      </tbody>
		    </table>
		   </div>
	   </div>
		<div class="clearfix"> </div>
	    </div>
		<div class="copy">
            <p>Copyright &copy; 2016  All rights reserved.</p>
	    </div>
		</div>
       </div>
      <!-- /#page-wrapper -->
   </div>
    <!-- /#wrapper -->
    <!-- Bootstrap Core JavaScript -->
    <script src="/Public/admin/js/bootstrap.min.js"></script>
</body>
</html>