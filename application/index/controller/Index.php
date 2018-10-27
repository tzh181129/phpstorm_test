<?php
namespace app\index\controller;

use think\Controller;
use think\captcha\Captcha;
use app\common\model\Tzh;


class Index extends \think\Controller
{
    public function index()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="ad_bd568ce7058a1091"></think>';
    }

    public function captcha(){
        $captcha = new Captcha();
        $captcha->entry();
        return view();
    }

    public function  tzh(){
        $code =$_POST['code'];
       if(!$_POST['name']){
           return "<script>alert('请填写用户名!');history.back();</script>";
       }else {
           $captcha = new Captcha();
           if ($captcha->check($code)==false) {
               return '验证码不正确';
           } else {
               $tzhmodel = new \app\common\model\Tzh;
               $arr['name']=$_POST['name'];
               $de=$tzhmodel->field('id,name,sex')->where($arr)->count();
               if($de == 0) {
                   //insert数据库字段增加
                   if ($tzhmodel->insert($arr)) {
                       $data=$tzhmodel->select();
                       $this->assign('info',$data);
                       return $this->fetch('index/tzh');
                   } else {
                       return '未知错误';
                   }
               }else{
                   //update数据库字段更新用法
                   //if($tzhmodel->where($arr)->update(['sex'=>'女'])){
                   //delete数据库字段删除
                   //if($tzhmodel->where($arr)->delete()) {
                   //select数据库字段查询
                   $data=$tzhmodel->select();
                   $this->assign('info',$data);
                   return $this->fetch('index/tzh');
                   }
               }
           }
       }

       public function read(){

       }



}
