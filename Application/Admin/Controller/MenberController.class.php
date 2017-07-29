<?php
namespace Admin\Controller;
use Think\Controller;
class MenberController extends CommonController {
	public function select(){
        $menber = M('menber');
        $orderlog =M('orderlog');
        $match =M('match');
        if($_GET['name']){
            $map['name']=array('like','%'.$_GET['name'].'%');
            $users= $menber->where($map)->select();
        }else{
            $users= $menber->select();
        }
        foreach ($users as $k=>$v){
            // 现在的鱼
            $nowfish = $orderlog->where(array('logid'=>$v['nowfish']))->select();
            $users[$k]['fishname'] = $nowfish[0]['productname'];
            // 比赛场数
            $pipei = $match->where(array('uid'=>$v['uid'],'state'=>2))->select();
            $users[$k]['matchnum']  = count($pipei);
            // 购买的鱼
            $buyfish = $orderlog->where(array('userid'=>$v['uid'],'type'=>2))->select();
            $users[$k]['buyfishnum']  = count($buyfish);
        }

        $this->assign('users',$users);
        $this->display();
    }

    public function charge(){
        $menber = M('menber');
        $users= $menber->select();
        if($_POST['user']&&$_POST['num']){
            if($_POST['num']<=0){
                echo "<script>alert('请输入正确金额');window.location.href = '".__ROOT__."/index.php/Admin/Menber/charge';</script>";exit();
            }
            $user = $menber->where(array('uid'=>$_POST['user']))->select();
            $chargebag= $user[0]['chargebag']+$_POST['num'];
            $res = $menber->where(array('uid'=>$_POST['user']))->save(array('chargebag'=>$chargebag));

            $datas['state'] = 1;
            $datas['reson'] = "充值";
            $datas['type'] = 2;
            $datas['addymd'] = date('Y-m-d',time());
            $datas['addtime'] = date('Y-m-d H:i:s',time());
            $datas['orderid'] = $_SESSION['uname'];
            $datas['userid'] = $_POST['user'];
            $datas['income'] = $_POST['num'];
            $comelog =M('incomelog');
            $comelog->add($datas);
            if($res){
                $message =$user[0]['name'].'成功充值'.$_POST['num'].'元';
                echo "<script>alert('$message');";
                echo "window.location.href = '".__ROOT__."/index.php/Admin/Menber/charge';";
                echo "</script>";
                exit;
            }

        }
        $this->assign('users',$users);
        $this->display();
    }

    public function usermessage(){
        $incomelog = M('incomelog');
//        if($_GET['productid']){
////            $map['name']=array('like','%'.$_GET['name'].'%');
//            $map['productid'] =$_GET['productid'];
//        }
        if($_GET['uid']){
            $map['userid'] =$_GET['uid'];
        }
        if($_GET['type']){
            $map['type'] =$_GET['type'];
        }
        if($_GET['mindate']&&$_GET['maxdate']){
            $map['addymd'] =array(array('elt',$_GET['maxdate']),array('egt',$_GET['mindate']),'and');;
        }
        $users= $incomelog->order('id DESC')->where($map)->select();

        $this->assign('users',$users);
        $this->display();
    }

    public function userupdate(){
        $menber = M('menber');
        if($_POST){
            $data['name'] =$_POST['name'];
            $data['address'] =$_POST['address'];
            $data['sex'] =$_POST['sex'];
            $data['ismanager'] =$_POST['ismanager'];
            $data['group'] =$_POST['group'];
            $result = $menber->where(array('id'=>$_GET['id']))->save($data);
            if($result){
                echo "<script>alert('更新成功');window.location.href = '".__ROOT__."/index.php/Admin/Menber/select';</script>";exit();
            }else{
                echo "<script>alert('更新失败');window.location.href = '".__ROOT__."/index.php/Admin/Menber/select';</script>";exit();
            }
        }
        $user= $menber->where(array('id'=>$_GET['id']))->select();
        $this->assign('user',$user[0]);
        $this->display();
    }

//    删除用户
    public function userdelete(){
        $menber = M('menber');
        $result = $menber->where(array('id'=>$_GET['id']))->delete();
        if($result){
            echo "<script>window.location.href = '".__ROOT__."/index.php/Admin/Menber/select';</script>";exit();
        }else{
            echo "<script>alert('更新失败');window.location.href = '".__ROOT__."/index.php/Admin/Menber/select';</script>";exit();
        }
    }

    //充值审核
    public function chargesheng(){
        $income =M('incomelog');
        $data['p_incomelog.type'] =0;
        $data['p_incomelog.state'] =0;
        $data['p_incomelog.reson'] ='充值';
        $data['p_incomelog.addtime'] =array('gt',0);
        $result =$income->field('p_incomelog.addtime as addtimes,p_incomelog.addymd as addymds,p_menber.name,p_incomelog.userid,income,id')->join('p_menber ON p_incomelog.userid=p_menber.uid')->where($data)->select();
        $this->assign('res',$result);
        $this->display();
    }

    public function ischarge(){
        $income =M('incomelog');
        $result = $income->where(array('id'=>$_GET['id']))->select();
        if($result[0]){
            if($_GET['state']==1){
                $data['type'] =2;
                $data['state'] =1;
                $income->where(array('id'=>$_GET['id']))->save($data);
                $menber =M('menber');
                $user= $menber->where(array('uid'=>$result[0]['userid']))->select();
//                $chargebag =$user[0]['chargebag']+$result[0]['income'];
                $chargebag =bcadd($user[0]['chargebag'],$result[0]['income'],2);
                $menber->where(array('uid'=>$result[0]['userid']))->save(array('chargebag'=>$chargebag));
                echo "<script>alert('更新成功');window.location.href = '".__ROOT__."/index.php/Admin/Menber/chargesheng';</script>";exit();
            }
            if($_GET['state']==2){
                $data['type'] =2;
                $data['state'] =0;
                $income->where(array('id'=>$_GET['id']))->save($data);
                echo "<script>window.location.href = '".__ROOT__."/index.php/Admin/Menber/chargesheng';</script>";exit();
            }
        }
    }

    public function tixiansheng(){
        $income =M('incomelog');
        $data['p_incomelog.type'] =3;
        $data['p_incomelog.state'] =0;
        $data['p_incomelog.addtime'] =array('gt',0);
        $result =$income->field('p_incomelog.addtime as addtimes,p_incomelog.addymd as addymds,p_menber.name,p_incomelog.userid,income,id,orderid,reson')->join('p_menber ON p_incomelog.userid=p_menber.uid')->where($data)->select();

        foreach($result as $k=>$v){
            if($v['orderid']){
                $account =explode(',',$v['orderid']);
                $result[$k]['accountname'] =$account[0];
                $result[$k]['accountnum'] =$account[1];
                $result[$k]['carnum'] =$account[2];
                $result[$k]['carmame'] =$account[3];
                $result[$k]['carhang'] =$account[4];
                $result[$k]['caraddr'] =$account[5];
            }
        }
//        print_r($result);die;
        $this->assign('res',$result);
        $this->display();
    }

    public function istixian(){
        $income =M('incomelog');
        $result = $income->where(array('id'=>$_GET['id']))->select();
        if($result[0]){
            if($_GET['state']==1){ // 提现成功
                $data['type'] =3;
                $data['state'] =2;
                $income->where(array('id'=>$_GET['id']))->save($data);
                echo "<script>alert('更新成功');window.location.href = '".__ROOT__."/index.php/Admin/Menber/tixiansheng';</script>";exit();
            }
            if($_GET['state']==2){   // 提现失败
                $menber =M('menber');
                $user= $menber->where(array('uid'=>$result[0]['userid']))->select();
//                $chargebag =$user[0]['chargebag']+$result[0]['income'];
                $chargebag =bcadd($user[0]['incomebag'],$result[0]['income'],2);
                $menber->where(array('uid'=>$result[0]['userid']))->save(array('incomebag'=>$chargebag));
                $data['type'] =3;
                $data['state'] =3;
                $income->where(array('id'=>$_GET['id']))->save($data);
                echo "<script>window.location.href = '".__ROOT__."/index.php/Admin/Menber/tixiansheng';</script>";exit();
            }
        }
    }


    public function editUser(){
        $menber =M('menber');
        if($_POST['name']){
            $data['pwd']= $_POST['pwd'];
            $data['zhifubao']= $_POST['zhifubao'];
            $data['name']= $_POST['name'];
            $data['weixin']= $_POST['weixin'];
            $res = $menber->where(array('uid'=>$_GET['uid']))->save($data);
            echo "<script>window.location.href = '".__ROOT__."/index.php/Admin/Menber/select';</script>";exit();
        }
        $user= $menber->where(array('uid'=>$_GET['uid']))->select();
        $this->assign('user',$user[0]);
       $this->display();
    }


    public function recharge(){
        if($_POST['user']&&$_POST['money']){
            $menber =M('menber');
            $user =$menber->where(array('uid'=>$_POST['user']))->select();
            if(!$user[0]){
                echo "<script>alert('会员不存在');window.location.href = '".__ROOT__."/index.php/Admin/Menber/recharge';</script>";exit();
            }
            if($_POST['type']==1){
                $afterbag =bcadd ($user[0]['incomebag'] , $_POST['money'],2) ;
                $menber->where(array('uid'=>$_POST['user']))->save(array('incomebag'=>$afterbag));
                $data['type'] = 1;
                $data['state'] = 1;
                $data['reson'] = '金币充值';
                $data['addymd'] =date('Y-m-d',time());
                $data['addtime'] = date('Y-m-d H:i:s',time());
                $data['orderid'] = 0;
                $data['userid'] = $_POST['user'];
                $data['income'] = $_POST['money'];
                M('incomelog')->add($data);
            }elseif ($_POST['type']==2){
                $afterbag =bcadd ($user[0]['baoshibag'] , $_POST['money'],2) ;
                $menber->where(array('uid'=>$_POST['user']))->save(array('baoshibag'=>$afterbag));
                $data['type'] = 2;
                $data['state'] = 1;
                $data['reson'] = '道具充值';
                $data['addymd'] =date('Y-m-d',time());
                $data['addtime'] = date('Y-m-d H:i:s',time());
                $data['orderid'] = 0;
                $data['userid'] = $_POST['user'];
                $data['income'] = $_POST['money'];
                M('incomelog')->add($data);
            }
            echo "<script>window.location.href = '".__ROOT__."/index.php/Admin/Menber/usermessage';</script>";exit();
        }
        $menber =M('menber')->select();
        $this->assign('menber',$menber);
        $this->display();
    }


}



 ?>