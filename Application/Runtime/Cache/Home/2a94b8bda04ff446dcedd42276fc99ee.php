<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>首页</title>
	<script type="text/javascript" src="/Public/Home/js/fontSize.js"></script>
	<link rel="stylesheet" href="/Public/Home/css/common.css">
	<script type="text/javascript" src="/Public/Home/layer_mobile/layer.js"></script>
	<script type="text/javascript" src="/Public/Home/js/jquery-3.1.1.min.js"></script>
	<style type="text/css">
		body{background: url(/Public/Home/img/p_10.png) no-repeat #07a1de;background-size: 100% auto;overflow: hidden;position: relative;}
		.pkImg{width:1.5rem;position: absolute;left: .4rem;top: 1.1rem; }
		.freeImg{width:1.5rem;position: absolute;left: 2rem;top: .9rem; }
		.groupImg{width:1.5rem;position: absolute;left: 3.8rem;top: .8rem; }
		.shengcunImg{width:1.5rem;position: absolute;left: 5.5rem;top: 1rem; }
		.tab{position: absolute;top:3rem;width: 70%;left: 50%;margin-left: -35%;overflow: hidden;}
		.tab li{width: 20%;text-align: center;float: left;}
		.tab li img{width: 60%;}
		.startImg{width: 18%;position: absolute;top:2.3rem;left: 50%;margin-left: -9%; }
		.mask{width: 100%;height: 100%;position: fixed;top: 0;left: 0;z-index: 100;}
		.model{width: 100%;height: 100%;position: absolute;top: 0;left: 0;z-index: 99;}

		.rank_content{position: absolute;z-index: 100;width: 90%;height: 3.7rem;top: 0rem;left: 50%;margin-left: -45%;background: url('/Public/Home/img/p_28.png') no-repeat;background-size: 100% auto;}
		.family_content{position: absolute;z-index: 100;width: 90%;height: 3.7rem;top: 0rem;left: 50%;margin-left: -45%;background: url('/Public/Home/img/p_33.png') no-repeat;background-size: 100% auto;}

		.closeImg{width: .4rem;position: absolute;right: .05rem;top: .4rem;z-index: 100;}
		.closeImg1{width: .4rem;position: absolute;right: .1rem;top: .28rem;z-index: 100;}
		.closeImg3{width: .4rem;position: absolute;right: .1rem;top: .28rem;z-index: 100;}
		.closeImg4{width: .4rem;position: absolute;right: .1rem;top: .28rem;z-index: 100;}
		.close_match{width: .4rem;position: absolute;right: .05rem;top: 0rem;z-index: 100;}
		.rank_content table, .family_content table{display: table;border-collapse: collapse;width: 100%;}
		.rank_content table tr,.family_content table tr{height: .52rem;    border-bottom: 2px solid #3adbff;}
		.rank_content table tr td,.family_content table tr td{color: #fff;font-size: .26rem;text-align: center;}
		.table_div{height: 2.35rem;overflow-y: scroll;width: 91%;margin-top: 1.3rem;margin-left: .16rem;background: #0f5c8e;    border-radius: .1rem;}
		.photo{width: .3rem;vertical-align: middle;}
		.tool_content{position: absolute;z-index: 100;width: 90%;height: 4.2rem;top: .1rem;left: 50%;margin-left: -45%;background: url('/Public/Home/img/p_29.png') no-repeat;background-size: 100% auto;}
		.toolImg{width: .7rem;position: absolute;top: 1.8rem;}
		.toolImg1{left: .7rem;}
		.toolImg2{left: 2.2rem;}
		.toolImg3{left: 3.7rem;top: 1.9rem;}
		.toolImg4{left: 5.15rem;top: 1.9rem;}

		.water_content{position: absolute;z-index: 100;top: 1rem;left: 50%;margin-left: -45%;width: 90%;height: 2.35rem;background: url('/Public/Home/img/p_32.png') no-repeat;background-size: 100% auto;border-radius: .3rem;}
		.package_content{position: absolute;z-index: 100;top: .1rem;left: 50%;margin-left: -45%;width: 90%;height: 4.45rem;background: url('/Public/Home/img/p_21.png') no-repeat;background-size: 100% auto;border-radius: .3rem;}
		.waterImg{width: 1rem;margin-left: .17rem; margin-top: .08rem;}
		.closeImg2{width: .3rem;top: .1rem;right: .1rem;position: absolute;z-index: 100;}
		.package_content table{width: 91%;margin-top:1.1rem;margin-left: .1rem;}
		.package_content table td{text-align: center;width: 14.25%;}
		.family_content  .table_div{margin-top: 1.2rem;height: 2.48rem;margin-left: .28rem;width: 89%;border-radius: .1rem;}
		.packageImg{width: .5rem;position: absolute;top: 1.25rem;}
		.packageImg1{left: .5rem;}
		.packageImg2{left: 1.35rem;}
		.packageImg3{left: 2.2rem;}
		.packageImg4{left: 3.04rem;}
		body .layui-m-layer .layui-m-layer-msg{bottom: -100px;}
		.tel{position: absolute;top: 3.47rem;left: .1rem;color: #fff;font-size: .1rem;transform:rotate(-7deg);}
		.info{color: #fff;font-weight: bold;font-size: .2rem;position: absolute;top: .1rem;left: .1rem;}
		.rank_mask,.tool_mask,.water_mask,.package_mask,.family_mask{display: none;}
		.message{color: #fff;position: absolute;top: .38rem;width: 60%;text-align: center;left: 50%;margin-left: -30%;}
		.diamond{width: .3rem;float: left;}
		.reddiamond{position: absolute;right: .1rem;top: .1rem;border-radius: 50%;min-width: .6rem;border-radius: 50%;background:#328fc6;}
		.bluediamond{position: absolute;right: .1rem;top: .5rem;border-radius: 50%;min-width: .6rem;border-radius: 50%;background:#328fc6;}

		.reddiamond span,.bluediamond span{float: left;background:#328fc6;display: inline-block;min-width: .3rem;height: .28rem;line-height: .28rem;border-radius: 45%;font-size: .16rem;color: #fff;padding:0 .1rem;}
		.packageNum{color: #fff;font-size: .2rem;position: absolute;top: 1.6rem;}
		.packageNum1{left: .88rem;}
		.packageNum2{left: 1.7rem;}
		.packageNum3{left: 2.55rem;}
		.packageNum4{left: 3.4rem;}
		.tool_num_content{text-align: center;z-index: 100;position: absolute;width: 30%;height: 3rem;background: #2f8ec6;top: .6rem;left: 50%;margin-left: -15%;border-radius: .2rem;}
		#number{width: .3rem;text-align: center;height: .26rem;float: left;}
		.jisuan{display: inline-block;width: 1rem;overflow: hidden;}
		.minus,.plus{width: .25rem;height: .3rem;float: left;border:none;outline: none;line-height: .3rem;}
		.tol_info{text-align: center;color: #fff;padding: .5rem 0 0 0;}
		.tol_money{color: #fff;text-align: center;font-size: .2rem;height: .5rem;line-height: .5rem;}
		.tol_money span,.totleDiv span{color: #fff;font-size: .2rem;}
		.totleDiv{height: .5rem;line-height: .5rem;color: #fff;font-size: .2rem;}
		.cancel{width: .7rem;border:none;outline: none;height:.3rem;font-size: .2rem;border-radius: .05rem;float: left;margin-top: .1rem;margin-left: .2rem; }
		.sure{width: .7rem;border:none;outline: none;height:.3rem;font-size: .2rem;border-radius: .05rem;float: right;margin-top: .1rem;margin-right: .2rem;}
		.tool_num{display: none;}
		.tool_num .model{background: rgba(0, 0, 0, 0.28);}
		.match_content{width: 3rem;background: url('/Public/Home/img/p_36.png') no-repeat;background-size: 100% auto;height: 2.5rem;position: absolute;top: .5rem;left: 50%;margin-left: -1.5rem;z-index: 100;}
		#count{color: #fb9e28;font-size: .3rem;width: 40%;height: .6rem;position: absolute;top: .8rem;left: 27%;}
		.match_game{width: 40%;position: absolute;top: 1.4rem;left: 27%;}
		.match_mask .model{background: rgba(0, 0, 0, 0.28);}
		.match_mask{display: none;}
		.tuiguang{width: .6rem;position: absolute;top: 3.3rem;right: .1rem;}
	</style>
</head>
<body>
<audio src="/Public/Home/css/REC20170711100043.mp3" autoplay="autoplay" loop="loop"></audio>
<img src="/Public/Home/img/p_40.png" alt="" class="tuiguang">
<!-- 头部信息显示 -->
<span class="tel">199999</span>
<span class="info"><?php echo ($username); ?></span>
<span class="message">公告：<?php echo ($article["cont"]); ?></span>
<div class="reddiamond">
	<img src="/Public/Home/img/p_34.png" alt="" class="diamond">
	<span><?php echo (int)$mine['incomebag']; ?></span>
</div>
<div class="bluediamond">
	<img src="/Public/Home/img/p_35.png" alt="" class="diamond">
	<span><?php echo (int)$mine['baoshibag']; ?></span>
</div>
<!-- 头部信息显示 -->
<!-- 匹配 -->
<div class="mask match_mask">
	<div class="model"></div>
	<div class="match_content">
		<img src="/Public/Home/img/p_31.png" alt="" class="close_match">
		<div id="count">00:00:00</div>
		<img src="/Public/Home/img/p_38.png" alt="" class="match_game">

	</div>
</div>
<!-- 匹配 -->
<img src="/Public/Home/img/p_3.png" alt="" class="pkImg pattern" pattern="free">
<img src="/Public/Home/img/p_6.png" alt="" class="freeImg pattern" pattern="live">
<img src="/Public/Home/img/p_4.png" alt="" class="groupImg pattern" pattern="group">
<img src="/Public/Home/img/p_1.png" alt="" class="shengcunImg pattern" pattern="house">

<img src="/Public/Home/img/p_9.png" alt="" class="startImg" pattern="">
<ul class="tab">
	<li>
		<img src="/Public/Home/img/p_8.png" alt="" class="openrank">
	</li>
	<li>
		<img src="/Public/Home/img/p_5.png" alt="" class="openpackage">
	</li>
	<li>
		<img src="/Public/Home/img/p_2.png" alt="" class="openfamily">
	</li>
	<li>
		<img src="/Public/Home/img/p_20.png" alt="" class="openwater">
	</li>

	<li>
		<img src="/Public/Home/img/p_7.png" alt="" class="opentool">
	</li>
</ul>

<!-- 排行榜开始 -->
<div class="mask rank_mask">
	<div class="model"></div>
	<div class="rank_content">
		<img src="/Public/Home/img/p_31.png" alt="" class="closeImg">
		<div class="table_div">
			<table>
				<?php if(is_array($paihang)): foreach($paihang as $k=>$v): ?><tr data-id="0">
					<td><?php echo $k+1;?></td>
					<td><img src="<?php echo ($v["showface"]); ?>" class="photo"></td>
					<td><?php echo ($v["name"]); ?></td>
				</tr><?php endforeach; endif; ?>
		</table>
	</div>
</div>
</div>
<!-- 排行榜 end -->
<!-- 水族开始    -->
<div class="mask water_mask">
	<div class="model"></div>
	<div class="water_content">
		<img src="/Public/Home/img/p_31.png" alt="" class="closeImg2">
		<?php if(is_array($proshui)): foreach($proshui as $k=>$v): ?><img src="<?php echo ($v["pic"]); ?>" alt="" class="waterImg" data-value="<?php echo ($v["price"]); ?>" data-id="<?php echo ($v["id"]); ?>"><?php endforeach; endif; ?>
	</div>
</div>
<!-- 水族结束    -->
<!-- 家族开始    -->
<div class="mask family_mask">
	<div class="model"></div>
	<div class="family_content">
		<img src="/Public/Home/img/p_31.png" alt="" class="closeImg4">
		<div class="table_div">
			<table>
				<?php if(is_array($son)): foreach($son as $k=>$v): ?><tr>
						<td><?php echo $k+1;?></td>
						<td><img src="<?php echo ($v["showface"]); ?>" class="photo"></td>
						<td><?php echo ($v["name"]); ?></td>
					</tr><?php endforeach; endif; ?>
		</div>
		</table>
	</div>

</div>
</div>
<!-- 家族结束    -->

<!-- 背包开始    -->
<div class="mask package_mask">
	<div class="model"></div>
	<div class="package_content">
		<img src="/Public/Home/img/p_31.png" alt="" class="closeImg3">
		<!-- 背包一 -->
		<?php if(is_array($bags)): foreach($bags as $k=>$v): ?><img src="<?php echo ($v["pic"]); ?>" alt="" class="packageImg packageImg<?php echo $k+1?>" data-id="<?php echo ($v["logid"]); ?>">
		<span class="packageNum packageNum<?php echo $k+1?>">x<?php echo ($v["num"]); ?></span><?php endforeach; endif; ?>
	</div>
</div>
<!-- 背包结束    -->
<!-- 道具开始 -->
<div class="mask tool_mask">
	<div class="model"></div>
	<div class="tool_content">
		<img src="/Public/Home/img/p_31.png" alt="" class="closeImg1">
		<?php if(is_array($prodaoju)): foreach($prodaoju as $k=>$v): ?><img src="<?php echo ($v["pic"]); ?>" alt="" class="toolImg toolImg<?php echo $k+1 ?>" data-intro="<?php echo ($v["cont"]); ?>" data-money="<?php echo ($v["price"]); ?>" data-id="<?php echo ($v["id"]); ?>"><?php endforeach; endif; ?>
	</div>
</div>
<!-- 道具 end -->

<!-- 道具价格 -->
<div class="mask tool_num">
	<div class="model"></div>
	<div class="tool_num_content">
		<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" id="productId" name="proid" value="0">
		<input type="hidden"  name="uid" value="<?php echo ($myid); ?>">
		<input type="hidden"  name="type" value="1">
		<div class="tol_info">增加灵敏度</div>
		<div class="tol_money">单价：￥<span id="money">20</span></div>
		<div class="jisuan"><button type="button" class="minus">-</button><input type="number" name="num" id="number" value="1"  id="num"><button type="button" class="plus">+</button></div>
		<div class="totleDiv">总价：￥<span id="totle">20</span></div>
		<button class="cancel">取消</button>
		<button class="sure">确定</button>
		</form>
	</div>
</div>
<!-- 道具价格 -->


<script type="text/javascript">
    $(function(){

        $('body').height($(window).height());

        // 加减js
        $(".minus").click(function() {
            var val=Number($("#number").val());
            var singleMoney=Number($("#money").html());
            if(val<=1){
                return false;
            }
            $("#number").val(--val);
            $("#totle").html(parseInt(val*singleMoney));
        });

        $(".plus").click(function() {
            var val=Number($("#number").val());
            var singleMoney=Number($("#money").html());
            $("#number").val(++val);
            $("#totle").html(parseInt(val*singleMoney));
        });



        // 开关排行榜
        $(".rank_mask .closeImg").click(function() {
            $(".rank_mask").hide();
        });
        $(".openrank").click(function() {
            $(".rank_mask").show();
        });

        // 开关道具
        $(".closeImg1").click(function() {
            $(".tool_mask").hide();
        });
        $(".opentool").click(function() {
            $(".tool_mask").show();

        });
        var intro,money,toolId,num;
        $(".toolImg").click(function() {
            num=$(this).attr('num');
            money=$(this).attr('data-money');
            toolId=$(this).attr('data-id');
            $(".tol_info").html(intro);
            $("#money,#totle").html(money);
            $("#number").val(1);
            $("#productId").val(toolId);
            $(".tool_num").show();
        });
//        $(".tool_num .sure").click(function() {
//            $.ajax({
//                type: "POST",
//                url: "some.php",
//                data: {
//                    num :money,
//                    proid :toolId,
//                    uid:<?php echo ($myid); ?>
//                },
//                success: function(msg){
//                    alert(1);
//                },
//                error: function(msg){
//                    alert(1);
//                }
//            });
//        });

        $(".cancel").click(function() {
            $(".tool_num").hide();
        });

        // 水族开关
        $(".closeImg2").click(function() {
            $(".water_mask").hide();
        });
        $(".openpackage").click(function() {
            $(".water_mask").show();

        });
        // 背包开关
        $(".closeImg3").click(function() {
            $(".package_mask").hide();
        });
        $(".openwater").click(function() {
            $(".package_mask").show();

        });

        // 家族开关
        $(".closeImg4").click(function() {
            $(".family_mask").hide();
        });
        $(".openfamily").click(function() {
            $(".family_mask").show();

        });
        window.onorientationchange = function(){
            switch(window.orientation){
                case -90:
                case 90:
                // alert("横屏:" + window.orientation);
                case 0:
                case 180:
                    layer.open({
                        content: '横屏体验会更加哟~'
                        ,btn: '我知道了'
                    });
                    // alert("竖屏:" + window.orientation);
                    break;
            }
        }
        $(".pattern").click(function() {

            var pattern=$(this).attr("pattern");
            $(".startImg").attr("pattern",pattern);


        });

        var HH = 0;
        var mm = 0;
        var ss = 0;
        var str = '';
        function timer(pattern){
            str = "";
            if(ss%3==0){
                $.ajax({
                    type: "POST",
                    url: "/index.php/Home/Index/getcompetion/type/"+ pattern,
                    data: {
                        type:1
                    },
                    success: function(msg){
                        if(msg==1){
                            window.location.href=pattern+".html";
                        }
                        console.log(pattern);
                    },
                    error: function(msg){
                    }
                });
			}
            if(++ss==60)
            {
                if(++mm==60)
                {
                    HH++;
                    mm=0;
                }
                ss=0;
            }

            str+=HH<10?"0"+HH:HH;
            str+=":";
            str+=mm<10?"0"+mm:mm;
            str+=":";
            str+=ss<10?"0"+ss:ss;
            $("#count").html(str);

        }
        var eime;

        //创建一个函数，用于返回一个无参数函数
        function _timer(_name){
            return function(){
                timer(_name);
            }
        }
		// 转换比赛类型
		function changeType(type) {
            if(type==1){
                return "您正在进行自由场比赛";
            }else if (type==2){
                return "您正在进行生存场比赛";
            }else if (type==3){
                return "您正在进行团战比赛";
            }else if (type==4){
                return "您正在进行房间PK比赛";
            }
        }

        // 开始按钮点击
        $(".startImg").click(function() {
            var pattern=$(this).attr("pattern");
//            alert(pattern);
            if(pattern==""){
                show_info("请选择游戏模式！");
            }else{
				// 请求数据 判断比赛
                 $.ajax({
                      type: "POST",
                      url: "/index.php/Home/Index/isconpetion",
                      data: {
                          patternType:pattern
                      },
                      success: function(msg){
                          if(msg==10){   // 可以比赛
                              if(pattern=="house"||pattern=="group"){
                                  eime=setInterval(_timer(pattern),1000);
                                  $(".match_mask").show();
                                  setTimeout(function(){
                                      clearInterval(eime);
                                      $("#count").html("00:00:00");
                                      HH = 0;
                                      mm = 0;
                                      ss = 0;
                                      window.location.href=pattern+".html";
                                  },60000000);

                              }else{
                                  window.location.href=pattern+".html";
                              }
						  }else if(msg==1){  // 已有自由场比赛
							  if(pattern=="free"){
                                  window.location.href=pattern+".html";
							  }
                              layer.open({
                                  content:changeType(msg)
                                  ,btn: ['是']
                              });
						  }else if(msg==2){  // 已有生存场比赛
                              if(pattern=="live"){
                                  window.location.href=pattern+".html";
                              }
                              layer.open({
                                  content:changeType(msg)
                                  ,btn: ['是']
                              });
                          }else if(msg==3){  // 已有团战比赛
                              if(pattern=="group"){
                                  window.location.href=pattern+".html";
                              }
                              layer.open({
                                  content:changeType(msg)
                                  ,btn: ['是']
                              });
                          }else if(msg==4){  // 已有房间PK比赛
                              if(pattern=="house"){
                                  window.location.href=pattern+".html";
                              }
                              layer.open({
                                  content:changeType(msg)
                                  ,btn: ['是']
                              });
                          }else {
                              layer.open({
                                  content:msg
                                  ,btn: ['是']
                              });
						  }
                      },
 					 error: function(msg){
                         layer.open({
                             content:msg
                             ,btn: ['是']
                         });
                      }
                   });
            }

        });

        $(".pkImg").click(function() {
            show_info("您选择了自由模式");
        });
        $(".freeImg").click(function() {
            show_info("您选择了生存模式");
        });
        $(".groupImg").click(function() {
            show_info("您选择了团战模式");
        });
        $(".shengcunImg").click(function() {
            show_info("您选择了房间模式");
        });

        $(".model")[0].addEventListener('touchmove', function (event) {
            event.preventDefault();
        })

        // 添加好友
//        $(".rank_mask tr,.family_mask tr").click(function() {
//            var id=$(this).attr('data-id');
//            layer.open({
//                content: '您是否要加该玩家为好友？'
//                ,btn: ['是', '否']
//                ,yes: function(index){
//                    $.ajax({
//                        type: "POST",
//                        url: "some.php",
//                        data: {
//                        },
//                        success: function(msg){
//                        },
//                        error: function(msg){
//                        }
//                    });
//                }
//            });
//        });

        // 购买鱼
        $(".waterImg").click(function() {
            var value=$(this).attr('data-value');
            var id=$(this).attr('data-id');
            layer.open({
                content: '该鱼价格为'+value+'，您是否要购买？'
                ,btn: ['是', '否']
                ,yes: function(index){
                    $.ajax({
                        type: "POST",
                        url: "/index.php/Home/Index/dealfish",
                        data: {
							'proid':id
                        },
                        success: function(msg){
                            layer.open({
                                content:msg
                                ,btn: ['是']
                            });
                        },
                        error: function(msg){
                        }
                    });
                }
            });
        });

        // 点击背包弹窗
        $(".packageImg").click(function() {
            var id=$(this).attr('data-id');
            layer.open({
                content: '是否使用该道具？'
                ,btn: ['是', '否']
                ,yes: function(index){
                    $.ajax({
                        type: "POST",
                        url: "/index.php/Home/Index/dealtool",
                        data: {
                            'proid':id
                        },
                        success: function(msg){
                            if(msg==1){
                                layer.open({
                                    content:"使用成功"
                                    ,btn: ['是']
                                });
							}else{
                                layer.open({
                                    content:msg
                                    ,btn: ['是']
                                });
							}

                        },
                        error: function(msg){
                            alert(msg);
                        }
                    });
                }
            });
        });

        // 点击推广
        $(".tuiguang").click(function() {
            window.location.href="/index.php/Home/Login/reg/fuid/<?php echo ($myid); ?>";
        });
		// 点击充值
        $(".bluediamond,.reddiamond").click(function() {
            window.location.href="/index.php/Home/Index/exchange/fuid/<?php echo ($myid); ?>";
        });
        // 匹配结束
        $(".close_match,.match_game").click(function() {
            $(".match_mask").hide();
            clearInterval(eime);
            $("#count").html("00:00:00");
            HH = 0;
            mm = 0;
            ss = 0;
        });

    });

</script>
</body>
</html>