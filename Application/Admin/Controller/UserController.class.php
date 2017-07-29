<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {
	public function login(){
        if(IS_POST){
            $name = I('post.name');
            $pwd = I('post.pwd');
            $user = M('user');
            $result= $user->where(array('name'=>$name,'password'=>$pwd))->select();
            if($result[0]){
                $_SESSION['uname']=$name;
                echo "<script>window.location.href = '".__ROOT__."/index.php/Admin/Index/productlist';</script>";
            }else{
                    echo "<script>alert('用户名或密码不存在');";
                    echo "window.history.go(-1);";
                    echo "</script>";
                }
        }
        $this->display();
    }

    public function logOut(){
        session('uname',null);
        cookie('is_login',null);
        echo "<script>window.location.href = '".__ROOT__."/index.php/Admin/User/login';</script>";
    }

    /**
     * 自由场 ok  7分钟
     */
    public function crontabfree(){
        $orderlog =M('match');
        $match = $orderlog->where(array('type'=>1,'state'=>1))->select();
        foreach ($match as $k=>$v){
            $time =time() - strtotime($v['addtime']);
            $ordertime = 7*60;  // 7分钟
            if($time>$ordertime){   // 处理分红
                $menber =M('menber');
                $userinfo =$menber->where(array('uid'=>$v['uid']))->select();
                $money =1.42 ;
                $incomebag =bcadd($userinfo[0]['incomebag'],$money,2);
                // 处理用户
                $menber->where(array('uid'=>$v['uid']))->save(array('incomebag'=>$incomebag,'nowfish'=>0,'iscompetion'=>0));
                // 处理当前比赛
                $orderlog->where(array('id'=>$v['id']))->save(array('state'=>2,'money'=>$money));

                // 处理收入记录
                $incomelog['type'] =4;
                $incomelog['state'] =1;
                $incomelog['reson'] = "自由场鱼收益";
                $incomelog['addymd'] =date("Y-m-d H:i:s",time());
                $incomelog['addtime'] =date("Y-m-d",time());
                $incomelog['orderid'] =$v['id'];
                $incomelog['userid'] =$v['uid'];
                $incomelog['income'] =$money;
                print_r($incomelog);
                M('incomelog')->add($incomelog);
                print_r($incomelog);
                // 处理七次记录
                $result = $orderlog->where(array('type'=>1,'state'=>2))->select();
                if(count($result)>=7){
                    $menber->where(array('uid'=>$v['uid']))->save(array('isoutfree'=>1));
                }
            }else{
                echo "暂无处理";
            }
        }
    }

    /**
     * 生存场 ok  每天一次
     * one day once
     */
    public function crontablive(){
        $matchlog =M('match');
        $match = $matchlog->where(array('type'=>2,'state'=>1))->select();
        if(!$match[0]){
            echo "生存场暂无比赛";exit();
        }
        foreach ($match as $k=>$v){
            $time =time() - strtotime($v['addtime']);
            $ordertime = 7*60;  // 7分钟
            if($time>$ordertime){   // 处理分红
                $menber =M('menber');
                $userinfo =$menber->where(array('uid'=>$v['uid']))->select();
                // 查询返回的利率
                $orderlogid = $userinfo[0]['nowfish'];
                if($orderlogid){   // 购买鱼
                    $nowfish =  M('orderlog')->where(array('logid'=>$orderlogid))->select();
                    $money = $nowfish[0]['prices'];  // 投资金额
                    $efftday = $this->changday($money);
                    $allincome = M('incomelog')->where(array('type'=>4,'state'=>1,'userid'=>$v['uid'],',orderid'=>$v['id']))->select();
                    if(count($allincome)>=$efftday && $efftday>0){  // 结束比赛
                        // 处理用户
                        $menber->where(array('uid'=>$v['uid']))->save(array('nowfish'=>0,'iscompetion'=>0));
                        // 处理当前比赛
                        $matchlog->where(array('id'=>$v['id']))->save(array('state'=>2,'money'=>$money));
                        continue;
                    }elseif ($efftday>0){// 收益
                        $lilv = $this->changelilv($money);
                        $income =bcmul($money,$lilv,2);
                        // 处理收入记录
                        $incomelog['type'] =4;
                        $incomelog['state'] =1;
                        $incomelog['reson'] = "生存场鱼收益";
                        $incomelog['addymd'] =date("Y-m-d H:i:s",time());
                        $incomelog['addtime'] =date("Y-m-d",time());
                        $incomelog['orderid'] =$v['id'];
                        $incomelog['userid'] =$v['uid'];
                        $incomelog['income'] =$income;

                        M('incomelog')->add($incomelog);
                        $incomebag =bcadd($userinfo[0]['incomebag'],$income,2);
                        // 处理用户
                        $menber->where(array('uid'=>$v['uid']))->save(array('incomebag'=>$incomebag));
                        print_r(count($allincome));
                        print_r($incomelog);
                    }
                }
            }else{
                echo "暂无处理";
            }
        }
    }

    /**
     * 房间PK ok  7 min
     */
    public function crontabpk(){
        $matchlog =M('match');
        $match = $matchlog->where(array('type'=>4,'state'=>1))->select();
        if(!$match[0]){
            echo "PK暂无比赛";exit();
        }
        foreach ($match as $k=>$v){
            $time =time() - strtotime($v['addtime']);
            $ordertime = 7*60;  // 7分钟
            if($time>$ordertime){   // 处理分红
                $menber =M('menber');
                $orderlog = M('orderlog');
                $competion = $matchlog->where(array('commit_id'=>$v['commit_id'],'state'=>1))->select();
                if(count($competion)==2){
                    $oneid = $this->getUserfight($competion[0]['uid']);
                    $twoid = $this->getUserfight($competion[1]['uid']);
                    $config = M('Config')->where(array('cid'=>1))->select();
                    $commoney =$config[0]['cont'];

                    if($oneid>=$twoid){
                        $onemoney =$menber->where(array('uid'=>$competion[0]['uid']))->select();
                        $oneafter = bcadd($onemoney[0]['incomebag'] ,$commoney,2) ;
                        $this->deallog(5,1,"PK赛收益",$competion[0]['id'],$competion[0]['uid'],$commoney); // 日志
                        $menber->where(array('uid'=>$competion[0]['uid']))->save(array('incomebag'=>$oneafter,'iscompetion'=>0));  //收入

                        $twomoney =$menber->where(array('uid'=>$competion[1]['uid']))->select();
                        $twoafter = bcsub ($twomoney[0]['incomebag'] ,$commoney,2) ;
                        $this->deallog(5,2,"PK赛收益",$competion[1]['id'],$competion[1]['uid'],$commoney);  // 日志
                        $menber->where(array('uid'=>$competion[1]['uid']))->save(array('incomebag'=>$twoafter,'iscompetion'=>0));
                    }else{

                        $onemoney =$menber->where(array('uid'=>$competion[0]['uid']))->select();
                        $oneafter = bcsub ($onemoney[0]['incomebag'] ,$commoney,2) ;
                        $this->deallog(5,2,"PK赛收益",$competion[0]['id'],$competion[0]['uid'],$commoney);  // 日志
                        $menber->where(array('uid'=>$competion[0]['uid']))->save(array('incomebag'=>$oneafter,'iscompetion'=>0));

                        $twomoney =$menber->where(array('uid'=>$competion[1]['uid']))->select();
                        $twoafter = bcadd($twomoney[0]['incomebag'] ,$commoney,2) ;
                        $this->deallog(5,1,"PK赛收益",$competion[1]['id'],$competion[1]['uid'],$commoney);  // 日志
                        $menber->where(array('uid'=>$competion[1]['uid']))->save(array('incomebag'=>$twoafter,'iscompetion'=>0));
                    }
                    $matchlog->where(array('id'=>$competion[0]['id']))->save(array('state'=>2));
                    $matchlog->where(array('id'=>$competion[1]['id']))->save(array('state'=>2));
                }
            }
        }
    }

    public function crontabgroup(){
        $matchlog =M('match');
        $match = $matchlog->where(array('type'=>4,'state'=>1))->select();
        if(!$match[0]){
            echo "PK暂无比赛";exit();
        }

    }

    /**
     * 处理垃圾比赛   30 min
     */
    public function dealoutmatch(){
        $matchlog =M('match');
        $cond['type'] =array('in',array(3,4));
        $cond['state'] =0 ;
        $match = $matchlog->where($cond)->select();
        if($match[0]){
            foreach ($match as $v){
                $time =time() - strtotime($v['addtime']);
                $ordertime = 30*60;  // 30分钟
                if($time>$ordertime) {   // 处理
                   $res =  $matchlog->where(array('id'=>$v['id']))->delete();
                  if($res){
                      print_r("logid".$v['id']."已被清除<br>");
                  }
                }
            }
        }else{
            echo  "暂无可清除比赛";
        }
        print_r($match);
    }

    private function deallog($type,$state,$reson,$orderid,$userid,$income){
        $onedata['type'] =$type;
        $onedata['state'] =$state;
        $onedata['reson'] =$reson;
        $onedata['addymd'] =date('Y-m-d',time());
        $onedata['addtime'] =date('Y-m-d H:i:s',time());;
        $onedata['orderid'] =$orderid;
        $onedata['userid'] =$userid;
        $onedata['income'] =$income;
        print_r($onedata);
        M('incomelog')->add($onedata);
    }
    /**
     * @param $uid
     * @return mixed
     * 查询 Userid 的能力值
     */
    private function getUserfight($uid){
        $menber =M('menber');
        $orderlog = M('orderlog');
        $oneuser = $menber->where(array('uid'=> $uid))->select();
        $nowfish = $orderlog->where(array('logid'=>$oneuser[0]['nowfish']))->select();
        $daoju = $orderlog->where(array('userid'=>$uid,'type'=>1,'states'=>2))->select();
        $ones =0;
        if($daoju[0]){
            foreach ($daoju as $v){
                $ones =$ones + (int)$v['prices'];
            }
        }
        $one_result =$nowfish[0]['prices'] + $ones;
        return $one_result;
    }
    /**
     * @param $type
     * @return string
     * 利率查询
     */
    private function changelilv($type){
        if($type==50){
            return '0.023';
        }elseif ($type==100){
            return '0.035';
        }elseif ($type==200){
            return '0.038';
        }elseif ($type==400){
            return '0.045';
        }elseif ($type==500){
            return '0.038';
        }elseif ($type==600){
            return '0.032';
        }else{
            return 0;
        }
    }

    /**
     * @param $type
     * @return string
     * 收益天数查询
     */
    private function changday($type){
        if($type==50){
            return 15;
        }elseif ($type==100){
            return 17;
        }elseif ($type==200){
            return 19;
        }elseif ($type==400){
            return 21;
        }elseif ($type==500){
            return 23;
        }elseif ($type==600){
            return 26;
        }else{
            return 0;
        }
    }


}



 ?>