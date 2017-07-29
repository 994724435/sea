<?php
namespace Home\Controller;
use Think\Controller;
header('content-type:text/html;charset=utf-8');
class IndexController extends CommonController {
   //主页
	public function index(){
        $menber = M('Menber');
        $paihang = $menber->limit(10)->order("fighting DESC")->select();
        $mine =$menber->where(array('uid'=>session('uid')))->select();
        if($_POST['type']==1){  // 处理道具
            $pro =M('Product')->where(array('id'=>$_POST['proid']))->select();
            $price =bcmul($pro[0]['price'],$_POST['num'],2);
            if($price>$mine[0]['incomebag']){
                echo "<script>alert('金币不足');window.location.href = '".__ROOT__."/index.php/Home/Index/index';</script>";
                exit();
            }
            // 处理钱包
            $incomebag =bcsub($mine[0]['incomebag'],$price,2);
            $menber->where(array('uid'=>session('uid')))->save(array('incomebag'=>$incomebag));
            //日志
            $minebages = M('orderlog')->where(array('userid'=>session('uid'),'states'=>1,'productid'=>$_POST['proid']))->select();
            if($minebages[0]){  // 如果有更新
                $logid  =$minebages[0]['logid'];
                $afternum = $minebages[0]['num'] +  $_POST['num'];
                M('orderlog')->where(array('logid'=>$logid))->save(array('num'=>$afternum));
            }else{
                $incomedata['userid'] =session('uid');
                $incomedata['productid'] =$pro[0]['id'];
                $incomedata['productname'] =$pro[0]['name'];
                $incomedata['productmoney'] =$pro[0]['price'];
                $incomedata['type'] =1;
                $incomedata['states'] =1;
                $incomedata['orderid'] =$pro[0]['name'];
                $incomedata['addtime'] =date("Y-m-d H:i:s",time());
                $incomedata['num'] =$_POST['num'];
                $incomedata['prices'] =$price;
                $incomedata['pic'] =$pro[0]['pic'];
                $logid = M('orderlog')->add($incomedata);
            }
               // 处理收入记录
            $incomelog['type'] =3;
            $incomelog['state'] =2;
            $incomelog['reson'] = "购买道具";
            $incomelog['addymd'] =date("Y-m-d H:i:s",time());
            $incomelog['addtime'] =date("Y-m-d",time());
            $incomelog['orderid'] =$logid;
            $incomelog['userid'] =session('uid');
            $incomelog['income'] =$price;
            M('incomelog')->add($incomelog);
            echo "<script>alert('购买成功');window.location.href = '".__ROOT__."/index.php/Home/Index/index';</script>";
            exit();
        }

        // 父级
        if($mine[0]['fids']){
            $con = substr($mine[0]['fids'], 0, -1);
            $fathers = explode(',',$con);
        }
        // 下级
        $childen =array();
        foreach ($this->getSonNode('',session('uid'),'') as $v){
           array_push($childen,$v);
        }
        if($fathers){
            foreach ($fathers as $v){
                if(!in_array($v,$childen)){
                    array_push($childen,$v);
                }
            }
        }
        $where['uid'] = array('in',$childen);
        $son = $menber->where($where)->select();
        // 朋友
        if($mine[0]['friends']){
            $friendarray['uid'] =array('in',explode(',',$mine[0]['friends']));
            $friends = $menber->where($friendarray)->select();
            $this->assign("friends",$friends);
        }
        // 文章公告
        $article = M('Article')->order('aid DESC')->limit(1)->select();
        // 水族馆
        $proshui =M('product')->where(array('type'=>2))->order('id asc')->select();
        // 平台道具
        $prodaoju =M('product')->where(array('type'=>1))->order('id asc')->select();
        // 背包
        $minebags = M('orderlog')->where(array('userid'=>session('uid'),'states'=>1))->select();

        $this->assign('bags',$minebags);
        $this->assign('prodaoju',$prodaoju);
        $this->assign('proshui',$proshui);
        $this->assign('article',$article[0]);
        $this->assign('mine',$mine[0]);
        $this->assign("son",$son);
        $this->assign("paihang",$paihang);
		$this->display();
	}

	public function exchange(){
	    $this->display();
    }

	// 购买鱼
	public function dealfish(){
	    $id = $_POST['proid'];
	    $orderlog = M('orderlog');
	    $user = M('menber')->where(array('uid'=>session('uid')))->select();
	    if($user[0]['nowfish']){
            $fishlog = $orderlog->where(array('logid'=>$user[0]['nowfish']))->select();
	        echo "当前已有".$fishlog[0]['productname'];
	        exit();
        }
        $menber = M('Menber');
        $mine =$menber->where(array('uid'=>session('uid')))->select();
        $pro =M('Product')->where(array('id'=>$id))->select();
        $price =bcmul($pro[0]['price'],1,2);
        if($price>$mine[0]['baoshibag']){
            echo "宝石不足";
            exit();
        }
        $incomedata['userid'] =session('uid');
        $incomedata['productid'] =$pro[0]['id'];
        $incomedata['productname'] =$pro[0]['name'];
        $incomedata['productmoney'] =$pro[0]['price'];
        $incomedata['type'] =2;
        $incomedata['states'] =1;
        $incomedata['orderid'] =$pro[0]['name'];
        $incomedata['addtime'] =date("Y-m-d H:i:s",time());
        $incomedata['num'] =1;
        $incomedata['prices'] =$price;
        $incomedata['pic'] =$pro[0]['userface'];
        $logid =$orderlog->add($incomedata);

        $baoshi =$mine[0]['baoshibag'] - $price;
        //处理个人
        M('menber')->where(array('uid'=>session('uid')))->save(array('nowfish'=>$logid,'baoshibag'=>$baoshi,'userface'=>$pro[0]['userface']));
        // 处理收入记录
        $incomelog['type'] =3;
        $incomelog['state'] =2;
        $incomelog['reson'] = "购买鱼";
        $incomelog['addymd'] =date("Y-m-d H:i:s",time());
        $incomelog['addtime'] =date("Y-m-d",time());
        $incomelog['orderid'] =$logid;
        $incomelog['userid'] =session('uid');
        $incomelog['income'] =$price;
        M('incomelog')->add($incomelog);
	    echo '购买成功';

    }


    //匹配模式
    public function getcompetion(){
	    $type =$this->changeTypes($_GET['type']);
	    // 查询是否有排队比赛
        $match =M('Match');
        $menber =M('Menber');
        $ismatch = $match->where(array('state'=>0,'type'=>$type))->select();
        $userinfo =$menber->where(array('uid'=>session('uid')))->select();
        $fish =M('Orderlog')->where(array('logid'=>$userinfo[0]['nowfish']))->select();

        if($ismatch[0]){ // 如果有match
            // 处理PK
            if($type==4){
                foreach ($ismatch as $k=>$v){

                    if($v['uid']!=session('uid')){  // 匹配比赛队友
                        $MyHistoryMatch= $match->where(array('state'=>0,'type'=>$type,'uid'=>session('uid')))->select();
                        $user = $menber->where(array('uid'=>$v['uid']))->select();
                        if($MyHistoryMatch[0]){    // 匹配相同等级
                            if($userinfo[0]['nowfish'] && $user[0]['nowfish']){
                                $match->where(array('id'=>$MyHistoryMatch[0]['id']))->save(array('commit_id'=>$v['commit_id'],'state'=>1,'addtime'=>date('Y-m-d H:i:s',time())));
                                $match->where(array('id'=>$v['id']))->save(array('commit_id'=>$v['commit_id'],'state'=>1,'addtime'=>date('Y-m-d H:i:s',time())));
                                $menber->where(array('uid'=>array('in',array(session('uid'),$v['uid']))))->save(array('iscompetion'=>4));
                                echo 1;
                                exit();break;
                            }
                            if(!$userinfo[0]['nowfish'] && !$user[0]['nowfish']){
                                $match->where(array('id'=>$MyHistoryMatch[0]['id']))->save(array('commit_id'=>$v['commit_id'],'state'=>1,'addtime'=>date('Y-m-d H:i:s',time())));
                                $match->where(array('id'=>$v['id']))->save(array('commit_id'=>$v['commit_id'],'state'=>1,'addtime'=>date('Y-m-d H:i:s',time())));
                                $menber->where(array('uid'=>array('in',array(session('uid'),$v['uid']))))->save(array('iscompetion'=>4));
                                echo 1;
                                exit();break;
                            }
                        }else{ // 创建自己 PK
                            if($v['commit_id']){
                                $data['commit_id'] =$v['commit_id'];
                            }else{
                                $data['commit_id'] =$this->create_guid(session('uid'));
                            }
                            $data['uid'] =session('uid');
                            $data['userface'] =$userinfo[0]['userface'];
                            $data['username'] =$userinfo[0]['name'];
                            $data['fishname'] =$fish[0]['productname'];
                            $data['addtime'] =date('Y-m-d H:i:s',time());
                            $data['type'] =$type;
                            $data['state'] =1;
                            $data['belong']=2;
                            $matchid =$match->add($data);
                            $match->where(array('id'=>$v['id']))->save(array('commit_id'=>$v['commit_id'],'state'=>1));
                            $menber->where(array('uid'=>array('in',array(session('uid'),$v['uid']))))->save(array('iscompetion'=>4));
                            echo 1;exit();
                        }
                    }
                }
                echo "比赛创建中";
                exit();

            }

            // 家族查询   团战比赛
            $condtion['state'] = 0;
            $condtion['type'] = $type;
            $friends = $this->getSonNode('',session('uid'),'');
            // 查询历史排队记录
            $MyHistoryMatch = $match->where(array('state'=>0,'type'=>$type,'uid'=>session('uid')))->select();
            unset($friends[0]);
            // 父级
            if($userinfo[0]['fids']){
                $con = substr($userinfo[0]['fids'], 0, -1);
                foreach (explode(',',$con) as $v){
                    if(!in_array($v,$friends)){
                        array_push($friends,$v);
                    }
                }
            }
            $condtion['uid'] =array('in',$friends);
            $family = $match->where($condtion)->select();
            $all = $match->where(array('type'=>$type,'state'=>0))->select();
            $cha = count($all) -count($family);
            if(count($family)>=4 && $cha>=3 && $MyHistoryMatch[0]['commit_id']){
                foreach ($all as $v){
                    if(in_array($v['uid'],$friends)){
                        $match->where(array('id'=>$v['id']))->save(array('state'=>1,'belong'=>1,'commit_id'=>$MyHistoryMatch[0]['commit_id']));
                    }else{
                        $match->where(array('id'=>$v['id']))->save(array('state'=>1,'belong'=>2,'commit_id'=>$MyHistoryMatch[0]['commit_id']));
                    }
                    $menber->where(array('uid'=>$v['uid']))->save(array('iscompetion'=>3));
                }
                echo 1;exit();
            }

            if($MyHistoryMatch[0]['commit_id']){  // 自己有commit_id
                if($family[0]['commit_id']){   // 家庭有commit_id
                    $matchid = $match->where(array('id'=>$MyHistoryMatch[0]['id']))->save(array('commit_id'=>$family[0]['commit_id']));
                }else{
                    $matchid = $match->where(array('id'=>$MyHistoryMatch[0]['id']))->save(array('commit_id'=>$this->create_guid(session('uid'))));
                }
            }else{
                if($family[0]){
                    $data['commit_id'] =$family[0]['commit_id'];
                }else{
                    $data['commit_id'] =$this->create_guid(session('uid'));
                }
                $data['uid'] =session('uid');
                $data['userface'] =$userinfo[0]['userface'];
                $data['username'] =$userinfo[0]['name'];
                $data['fishname'] =$fish[0]['productname'];
                $data['addtime'] =date('Y-m-d H:i:s',time());
                $data['type'] =$type;
                $data['state'] =0;
                $data['belong']=1;
                $matchid =$match->add($data);
            }
        }else{           // 没有创建match
            $data['uid'] =session('uid');
            $data['userface'] =$userinfo[0]['userface'];
            $data['username'] =$userinfo[0]['name'];
            $data['fishname'] =$fish[0]['productname'];
            $data['addtime'] =date('Y-m-d H:i:s',time());
            $data['type'] =$type;
            $data['state'] =0;
            $data['belong']=1;
            $data['commit_id'] =$this->create_guid(session('uid'));
            $matchid = $match->add($data);
        }
        if( $matchid){
            echo '比赛创建'.$matchid;
        }else{
            echo '排队等待';
        }
    }

    public function create_guid($namespace = '') {
        static $guid = '';
        $uid = uniqid("", true);
        $data = $namespace;
        $data .= $_SERVER['REQUEST_TIME'];
        $data .= $_SERVER['HTTP_USER_AGENT'];
        $data .= $_SERVER['LOCAL_ADDR'];
        $data .= $_SERVER['LOCAL_PORT'];
        $data .= $_SERVER['REMOTE_ADDR'];
        $data .= $_SERVER['REMOTE_PORT'];
        $hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
        $guid =
            substr($hash, 0, 8) .
            '-' .
            substr($hash, 8, 4) .
            '-' .
            substr($hash, 12, 4) .
            '-' .
            substr($hash, 16, 4) .
            '-' .
            substr($hash, 20, 12) ;
        return $guid;
    }

    private function changeTypes($type){
        if($type=="group"){
            return 3 ;
        }elseif ($type=="house"){
            return 4;
        }
    }

   // 自由场
    public function free(){
        $match =M('Match');
        // 处理当前用户
        $userinfo =M('Menber')->where(array('uid'=>session('uid')))->select();
        $mine = $match->where(array('state'=>1,'type'=>1,'uid'=>session('uid')))->select();
        if($mine){
            M('Menber')->where(array('uid'=>session('uid')))->save(array('iscompetion'=>1));
        }else{
            if($userinfo[0]['nowfish']){
                $fish =M('orderlog')->where(array('logid'=>$userinfo[0]['nowfish']))->select();
            }
            $data['uid'] =session('uid');
            $data['fishname'] =isset($fish[0]['productname']) ? $fish[0]['productname']: '免费鱼' ;
            $data['username'] =$userinfo[0]['name'];
            $data['userface'] =$userinfo[0]['userface'];
            $data['type'] =1;
            $data['state'] =1;
            $data['commit_id'] =$this->create_guid(session('uid'));
            $data['addtime'] =date('Y-m-d H:i:s',time());
            $match->add($data);
            M('Menber')->where(array('uid'=>session('uid')))->save(array('iscompetion'=>1));
        }
        $GameMatch= $match->where(array('state'=>1,'type'=>1))->select();
        $this->assign('match',$GameMatch);
        $this->display();
    }
    // 生存场
    public function live(){
        $match =M('Match');
        // 处理当前用户
        $userinfo =M('Menber')->where(array('uid'=>session('uid')))->select();
        $mine = $match->where(array('state'=>1,'type'=>2,'uid'=>session('uid')))->select();
        if($mine[0]){
            M('Menber')->where(array('uid'=>session('uid')))->save(array('iscompetion'=>2));
        }else{
            if($userinfo[0]['nowfish']){
                $fish =M('orderlog')->where(array('logid'=>$userinfo[0]['nowfish']))->select();
            }
            $data['uid'] =session('uid');
            $data['fishname'] =isset($fish[0]['productname']) ? $fish[0]['productname']: '免费鱼' ;
            $data['username'] =$userinfo[0]['name'];
            $data['userface'] =$userinfo[0]['userface'];
            $data['type'] =2;
            $data['state'] =1;
            $data['commit_id'] =$this->create_guid(session('uid'));
            $data['addtime'] =date('Y-m-d H:i:s',time());
            $match->add($data);
            M('Menber')->where(array('uid'=>session('uid')))->save(array('iscompetion'=>2));
        }
        $GameMatch= $match->where(array('state'=>1,'type'=>2))->select();
        $this->assign('match',$GameMatch);
        $this->display();
    }
    // 团战场
    public function group(){
        $match =M('Match');
        $GameMatch= $match->where(array('state'=>1,'type'=>3))->select();
        $this->assign('match',$GameMatch);
        $this->display();
    }
    // PK
    public function house(){
        $match =M('Match');
        $MyHistoryMatch= $match->where(array('state'=>1,'type'=>4,'uid'=>session('uid')))->select();
        $all = $match->where(array('commit_id'=>$MyHistoryMatch[0]['commit_id']))->select();
        $this->assign('all',$all);
        $this->display();
    }
    // 当前是否有比赛
    public function isconpetion(){
        //选择比赛类型
        $type = $_REQUEST['patternType'];
        $menber =M('Menber');
        $userinfo =$menber ->where(array('uid'=>session('uid')))->select();
        if($type=="live"){  // 生存场
            if($userinfo[0]['iscompetion']){  // 当前有比赛
                echo $userinfo[0]['iscompetion'];exit();
            }
            // 查看该成员是否生存场解锁
            if(!$userinfo[0]['islive']){   // 没有解锁
                $config = M('Config')->where(array('cid'=>3))->select();
                if($userinfo[0]['incomebag']<$config[0]['cont']){   // 钱包余额不足
                    echo '钱包余额不足';exit();
                }else{                                              // 解锁
                    $left = $userinfo[0]['incomebag'] -  $config[0]['cont'];
                    $menber->where(array('uid'=>session('uid')))->save(array('incomebag'=>$left));
                    $data['type'] = 3;
                    $data['state'] = 2;
                    $data['reson'] = '生存场解锁';
                    $data['addymd'] = date('Y-m-d',time());
                    $data['addtime'] = date('Y-m-d H:i:s',time());
                    $data['orderid'] = 0;
                    $data['userid'] = session('uid');
                    $data['income'] = $config[0]['cont'];
                    M('incomelog')->add($data);
                }
            }
        }elseif ($type=="group"){   // 团战
            if($userinfo[0]['iscompetion']){
                echo $userinfo[0]['iscompetion'];exit();
            }
            if($userinfo[0]['incomebag']<10){
                echo '金币不足'; exit();
            }
        }elseif ($type=="house"){  // PK
            if($userinfo[0]['iscompetion']){
                echo $userinfo[0]['iscompetion'];exit();
            }
            if($userinfo[0]['incomebag']<10){
                echo '金币不足';exit();
            }
        }
	    if($userinfo[0]['iscompetion']){
            echo $userinfo[0]['iscompetion'];
        }else{
	        echo 10;
        }
    }

    private function changecompotion($type){
        if($type==1){
            return "您正在进行自由场比赛";
        }elseif ($type==2){
            return "您正在进行生存场比赛";
        }elseif ($type==3){
            return "您正在进行团战比赛";
        }elseif ($type==4){
            return "您正在进行房间PK比赛";
        }
    }

    public function test()
    {
        $uid = 4;
       print_r( $this->getSonNode('',4,''));
    }

    function getSonNode($data,$pid=0,$SonNode = array()){
        $SonNode[] = $pid;
        $menber = M('Menber');
        $res_user = $menber->where(array('fid'=>$pid))->select();
        foreach($res_user as $k=>$v){
            if($v['fid'] == $pid){
                $SonNode = $this->getSonNode($data,$v['uid'],$SonNode);
            }
        }
        return $SonNode;
    }

    public function getson($uid)
    {
        $menber = M('Menber');
        while (true){
          $res_user = $menber->where(array('fid'=>$uid))->select();
          print_r($res_user[0]['uid']);
          if($res_user[0]['uid']){
              $this->getson($res_user[0]['uid']);
          }else{
              break;
          }
        }
    }

    public function dealtool(){
        $logid =$_POST['proid'];
        if($logid){
            $res =M('orderlog')->where(array('logid'=>$logid))->save(array('states'=>2));
            if($res){
                $return =1;
            }else{
                $return ="更新失败";
            }
        }else{
            $return ="改商品不存在";
        }
       echo $return;
    }
}