<?php
namespace Admin\Controller;
use Think\Controller;
class ConfigController extends CommonController {
	public function pk(){
        $Config =M('Config');
	    $con =$Config->where(array('cid'=>1))->select();
	    if($_POST['cont']){
            $Config->where(array('cid'=>1))->save(array('cont'=>$_POST['cont']));
            echo "<script>";
            echo "window.location.href = '".__ROOT__."/index.php/Admin/Config/pk';";
            echo "</script>";
            exit;
        }
	    $this->assign('cont',$con[0]);
        $this->display();
    }

    public function team(){
        $Config =M('Config');
        $con =$Config->where(array('cid'=>2))->select();
        if($_POST['cont']){
            $Config->where(array('cid'=>2))->save(array('cont'=>$_POST['cont']));
            echo "<script>";
            echo "window.location.href = '".__ROOT__."/index.php/Admin/Config/team';";
            echo "</script>";
            exit;
        }
        $this->assign('cont',$con[0]);
        $this->display();
    }
}



 ?>