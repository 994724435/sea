<?php
namespace Admin\Controller;
use Think\Controller;
class ArticleController extends CommonController {
	public function lists(){
        $article =M('Article');
        $res = $article->order('aid DESC')->select();
        $this->assign('res',$res);
        $this->display();
    }

    public function addarticle(){
        if($_POST['title']){
            $article =M('Article');
            $data['type'] =1;
            $data['title'] =$_POST['title'];
            $data['cont'] =$_POST['content1'];
            $data['addtime'] =date('Y-m-d H:i:s');
            $data['addymd'] =date('Y-m-d');
            $data['admin'] =$_SESSION['uname'];
            $result = $article->add($data);
            if($result){
                echo "<script>alert('添加成功');window.location.href = '".__ROOT__."/index.php/Admin/Article/lists';</script>";
            }
        }
        $this->display();
    }

    public function delete(){
        $article =M('Article');
        $res =$article->where(array('aid'=>$_GET['id']))->delete();
        if($res){
            echo "<script>alert('删除成功');window.location.href = '".__ROOT__."/index.php/Admin/Article/lists';</script>";exit();
        }
    }

    public function editearticle(){
        $article =M('Article');
        if($_POST['title']){
            $data['title'] =$_POST['title'];
            $data['cont'] =$_POST['content1'];
            $data['addtime'] =date('Y-m-d H:i:s');
            $data['addymd'] =date('Y-m-d');
            $data['admin'] =$_SESSION['uname'];
            $result = $article->where(array('aid'=>$_GET['id']))->save($data);
            if($result){
                echo "<script>alert('修改成功');window.location.href = '".__ROOT__."/index.php/Admin/Article/lists';</script>";exit();
            }
        }
        $res = $article->where(array('aid'=>$_GET['id']))->select();
        $this->assign('res',$res[0]);
        $this->display();
    }
}



 ?>