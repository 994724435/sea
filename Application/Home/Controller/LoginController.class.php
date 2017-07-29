<?php
namespace Home\Controller;
use Think\Controller;
use Think\Verify;
header('content-type:text/html;charset=utf-8');
class LoginController extends Controller{
    public function login(){
        session_start();
        $numbers = rand(1000,9999);
        if($_POST){
            if($_POST['number']!=$_POST['numbers']){
                echo "<script>alert('验证码错误');</script>";
                echo "<script>window.location.href='".__ROOT__."/index.php/Home/Login/login';</script>";
            }
            $menber =M('menber');
            $res = $menber->where(array('phone'=>$_POST['name'],'pwd'=>$_POST['pwd']))->select();
            if($res[0]){
                session('name',$res[0]['name']);
                session('uid',$res[0]['uid']);
                echo "<script>window.location.href='".__ROOT__."/index.php/Home/Index/index';</script>";
            }else{
                echo "<script>alert('用户名或密码错误');</script>";
                echo "<script>window.location.href='".__ROOT__."/index.php/Home/Login/login';</script>";
            }
        }
        $this->assign('numbers',$numbers);
        $this->display();
    }

    public function reg(){
        session_start();
        $numbers = rand(1000,9999);
        $fid =$_GET['fuid'];
        if($_POST['name']&&$_POST['pwd']){
            if(preg_match("/^1[34578]{1}\d{9}$/",$_POST['name'])){

            }else{
                echo "<script>alert('请用手机号码注册');";
                echo "window.location.href='".__ROOT__."/index.php/Home/Login/reg/fuid/".$fid."';";
                echo "</script>";
                exit;
            }
            if($_POST['pwd']!=$_POST['pwd1']){
                echo "<script>alert('密码不一致');";
                echo "window.location.href='".__ROOT__."/index.php/Home/Login/reg/fuid/".$fid."';";
                echo "</script>";
                exit;
            }
            if($_POST['number']!=$_POST['numbers']){
                echo "<script>alert('验证码错误');</script>";
                echo "<script>window.location.href='".__ROOT__."/index.php/Home/Login/reg/fuid/".$fid."';</script>";
            }
            $menber =M('menber');
            //  用户名
            $fid =$_GET['fuid'];
            $res_user =$menber->where(array('phone'=>$_POST['name']))->select();
            $res_usefid[0] =1;
            if($fid){
                $res_usefid =$menber->where(array('uid'=>$fid))->select();
            }

            if($res_user[0]||!$res_usefid[0]){
                echo "<script>alert('手机号已存在或注册码不正确');";
                echo "window.location.href='".__ROOT__."/index.php/Home/Login/reg/fuid/".$fid."';";
                echo "</script>";
                exit;
            }

            if($fid){
                if($res_usefid[0]['fids']){
                    $data['fids'] =$res_usefid[0]['fids'].$fid.',';
                }else{
                    $data['fids'] =$fid.',';
                }
                $data['fid'] =$fid;
            }

            $data['phone'] =$_POST['name'];
            $data['name'] =$_POST['nickname'];
            $data['pwd'] =$_POST['pwd'];
            $data['type'] =1;
            $data['addtime'] =date('Y-m-d H:i:s',time());
            $data['addymd'] = date('Y-m-d',time());
            $data['incomebag'] =0;
            $data['baoshibag'] =0;
            $data['userface'] =$this->getRandUserFace();
            $data['showface'] =$this->getrealFace();
            $res =$menber->add($data);

            if($res){
                session('name',$_POST['nickname']);
                session('uid',$res);
                echo "<script>alert('用户".$_POST['name']."注册成功');";
                echo "window.location.href='".__ROOT__."/index.php/Home/Index/index';";
                echo "</script>";
                exit;
            }
        }
        $this->assign('numbers',$numbers);
        $this->display();
    }

    private function getrealFace(){
        $ru =rand(0,2);
        if($ru==1){
            return "/Public/Home/img/p_26.png";
        }elseif ($ru==2){
            return "/Public/Home/img/p_27.png";
        }else{
            return "/Public/Home/img/p_26.png";
        }
    }

    private function getRandUserFace(){
        $ru =rand(0,3);
        if($ru==1){
            return "/Public/Home/img/game/free1.png";
        }elseif ($ru==2){
            return "/Public/Home/img/game/free2.png";
        }elseif ($ru==3){
            return "/Public/Home/img/game/free3.png";
        }else{
            return "/Public/Home/img/game/free1.png";
        }
    }

    public function dealpro($uid,$otheruid,$proid,$num){
//        $uid =1;
//        $num =2;
//        $otheruid =6;
//        $proid =3;
        $product =M('product');
        $res = $product->where(array('id'=>$proid))->select();
        $data['userid']=$uid;
        $data['productid']=$res[0]['id'];
        $data['productname']=$res[0]['name'];
        $data['productmoney']=0;
        $data['type']=$res[0]['type'];
        $data['states']=0;
        $data['orderid']=$otheruid;
        $data['addtime']=date('Y-m-d H:i:s',time());
        $data['num']=$res[0]['num'];
        $data['prices']=0;
        $data['pic']=$res[0]['pic'];
        $data['num']=$num;
        $data['life']=$res[0]['life'];
        $orderlog =M('orderlog');
        $id = $orderlog->add($data);
        return  $id;
    }

}