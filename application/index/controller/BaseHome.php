<?php
namespace app\index\controller;

use think\Controller;


class BaseHome extends Controller
{
    public function _initialize()
    {
        session("siteid",37);

        $host="http://221.14.138.77:8001";
        $this->assign("host",$host);

        $siteid=session("siteid");
        $footer_link=db("link_info")->where(["parentid"=>0,"linktype"=>"youlian","siteid"=>$siteid])->order("orderid desc")->select();
        foreach($footer_link as $k => $v){
            $footer_link[$k]['list']=db("link_info")->where(["linktype"=>"youlian","parentid"=>$v['id']])->select();
        }
        $this->assign("footer_link",$footer_link);

        $site=db("site_info")->where("id",$siteid)->find();
        $this->assign("sites",$site);

        $other=db("other")->where("siteid=$siteid")->find();
        $this->assign("other",$other);
       

        $banner=db("banner")->where("siteid",$siteid)->find();
        $this->assign("banner",$banner);

        $site=db("category_info")->where(["siteid"=>$siteid,"status"=>0,"level"=>0])->order("orderid desc")->select();
        $this->assign("site",$site);

        $cou=count($site);
        $bl=(100/$cou);
        
        $this->assign("bl",$bl);
       
       
    }
    public function _empty()
    {
        $this->redirect("Index/index");
    }
}