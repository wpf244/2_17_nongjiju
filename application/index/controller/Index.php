<?php
namespace app\index\controller;


class Index extends BaseHome
{
    public function index()
    {
        $siteid=session("siteid");
        

        $category=db("category_info")->where(["siteid"=>$siteid,"status"=>0])->select();
        $arr=array();
        foreach($category as $v){
            $arr[]=$v['id'];
        }
        //轮播
        $reb=db("article_category")->alias("a")->field("a.id as aid,articleid,category_code,b.id,reviewstatus,bannerid,title,coverimage")->where(['reviewstatus'=>1,'bannerid'=>1])->where("a.categoryid","in",$arr)->join("article_info b","a.articleid=b.id")->group("articleid")->order("a.articleid desc")->limit(0,5)->select();
        $this->assign("reb",$reb);

        //模块1
        $re1=db("navidic")->where(["siteid"=>$siteid,"kuaiid"=>1])->find();
        $categoryid=$re1['categoryidlist'];
        $categoryname=$re1['categorynamelist'];
        $arrid=explode(",",$categoryid);
        $arrname=explode(",",$categoryname);
        $arrs = array_combine($arrid, $arrname);
        $res=array();
        foreach($arrs as $k => $v){
            if(!empty($k)){
                $res[]=array("id"=>$k,"name"=>$v);
            }
        }
        
        foreach($res as $k => $v){
            if($v['name'] == "周口要闻"){
                $catey=db("category_info")->field("id,code,status")->where(["code"=>"zkyw","status"=>0])->find();
                $yid=$catey['id'];
                $res[$k]['list']=db("article_category")->alias("a")->field("a.categoryid as categoryids ,articleid,b.id,title,createtime,reviewstatus")->where(['reviewstatus'=>1,"a.categoryid"=>$yid])->join("article_info b","a.articleid=b.id")->order("id desc")->limit(0,8)->select();
            }else{
                $res[$k]['list1']=db("article_category")->alias("a")->field("a.categoryid as categoryids ,articleid,b.id,title,createtime,reviewstatus")->where(['reviewstatus'=>1,"a.categoryid"=>$v['id']])->join("article_info b","a.articleid=b.id")->order("id desc")->limit(0,8)->select();
            }
        }
        $this->assign("res",$res);

        //通知公告
        $re7=db("navidic")->where(["siteid"=>$siteid,"kuaiid"=>7])->find();
        $categoryid7=$re7['categoryidlist'];
        $arrid7=explode(",",$categoryid7);
        $arrid7=array_filter($arrid7);
        $res7=db("article_category")->alias("a")->field("a.categoryid as categoryids ,articleid,b.id,title,createtime,reviewstatus")->where(['reviewstatus'=>1,"a.categoryid"=>["in",$arrid7]])->join("article_info b","a.articleid=b.id")->order("id desc")->limit(0,8)->select();
        $this->assign("res7",$res7);

        //政务公开
        $re2=db("navidic")->where(["siteid"=>$siteid,"kuaiid"=>2])->find();
        $categoryid2=$re2['categoryidlist'];
        $categoryname2=$re2['categorynamelist'];
        $arrid2=explode(",",$categoryid2);
        $arrname2=explode(",",$categoryname2);
        $arrs2 = array_combine($arrid2, $arrname2);
        $res2=array();
        foreach($arrs2 as $k2 => $v2){
            if(!empty($k2)){
                $res2[]=array("id"=>$k2,"name"=>$v2);
            }
        }
        
        foreach($res2 as $k => $v){
            if($v['name'] == "周口要闻"){
                $catey=db("category_info")->field("id,code,status")->where(["code"=>"zkyw","status"=>0])->find();
                $yid=$catey['id'];
                $res2[$k]['list']=db("article_category")->alias("a")->field("a.categoryid as categoryids ,articleid,b.id,title,createtime,reviewstatus")->where(['reviewstatus'=>1,"a.categoryid"=>$yid])->join("article_info b","a.articleid=b.id")->order("id desc")->limit(0,8)->select();
            }else{
                $res2[$k]['list1']=db("article_category")->alias("a")->field("a.categoryid as categoryids ,articleid,b.id,title,createtime,reviewstatus")->where(['reviewstatus'=>1,"a.categoryid"=>$v['id']])->join("article_info b","a.articleid=b.id")->order("id desc")->limit(0,8)->select();
            }
        }
        $this->assign("res2",$res2);

        //农机管理
        $re3=db("navidic")->where(["siteid"=>$siteid,"kuaiid"=>3])->find();
        $categoryid3=$re3['categoryidlist'];
        $categoryname3=$re3['categorynamelist'];
        $arrid3=explode(",",$categoryid3);
        $arrname3=explode(",",$categoryname3);
        $arrs3 = array_combine($arrid3, $arrname3);
        $res3=array();
        foreach($arrs3 as $k3 => $v3){
            if(!empty($k3)){
                $res3[]=array("id"=>$k3,"name"=>$v3);
            }
        }
        
        foreach($res3 as $k => $v){
            if($v['name'] == "周口要闻"){
                $catey=db("category_info")->field("id,code,status")->where(["code"=>"zkyw","status"=>0])->find();
                $yid=$catey['id'];
                $res3[$k]['list']=db("article_category")->alias("a")->field("a.categoryid as categoryids ,articleid,b.id,title,createtime,reviewstatus")->where(['reviewstatus'=>1,"a.categoryid"=>$yid])->join("article_info b","a.articleid=b.id")->order("id desc")->limit(0,8)->select();
            }else{
                $res3[$k]['list1']=db("article_category")->alias("a")->field("a.categoryid as categoryids ,articleid,b.id,title,createtime,reviewstatus")->where(['reviewstatus'=>1,"a.categoryid"=>$v['id']])->join("article_info b","a.articleid=b.id")->order("id desc")->limit(0,8)->select();
            }
        }
        $this->assign("res3",$res3);

        //政策法规
        $re4=db("navidic")->where(["siteid"=>$siteid,"kuaiid"=>4])->find();
        $categoryid4=$re4['categoryidlist'];
        $categoryname4=$re4['categorynamelist'];
        $arrid4=explode(",",$categoryid4);
        $arrname4=explode(",",$categoryname4);
        $arrs4 = array_combine($arrid4, $arrname4);
        $res4=array();
        foreach($arrs4 as $k4 => $v4){
            if(!empty($k4)){
                $res4[]=array("id"=>$k4,"name"=>$v4);
            }
        }
        
        foreach($res4 as $k => $v){
            if($v['name'] == "周口要闻"){
                $catey=db("category_info")->field("id,code,status")->where(["code"=>"zkyw","status"=>0])->find();
                $yid=$catey['id'];
                $res4[$k]['list']=db("article_category")->alias("a")->field("a.categoryid as categoryids ,articleid,b.id,title,createtime,reviewstatus")->where(['reviewstatus'=>1,"a.categoryid"=>$yid])->join("article_info b","a.articleid=b.id")->order("id desc")->limit(0,8)->select();
            }else{
                $res4[$k]['list1']=db("article_category")->alias("a")->field("a.categoryid as categoryids ,articleid,b.id,title,createtime,reviewstatus")->where(['reviewstatus'=>1,"a.categoryid"=>$v['id']])->join("article_info b","a.articleid=b.id")->order("id desc")->limit(0,8)->select();
            }
        }
        $this->assign("res4",$res4);

        //图片新闻
        $re5=db("navidic")->where(["siteid"=>$siteid,"kuaiid"=>5])->find();
        $categoryid5=$re5['categoryidlist'];
        $categoryname5=$re5['categorynamelist'];
        $arrid5=explode(",",$categoryid5);
        $arrname5=explode(",",$categoryname5);
        $arrs5 = array_combine($arrid5, $arrname5);
        
        $res5=array();
        foreach($arrs5 as $k5 => $v5){
            if(!empty($k5)){
                $res5[]=array("id"=>$k5,"name"=>$v5);
            }
        }
        
        foreach($res5 as $k => $v){     
            $res5[$k]['list1']=db("article_category")->alias("a")->field("a.categoryid as categoryids ,articleid,b.id,title,createtime,coverimage,reviewstatus")->where(['reviewstatus'=>1,"a.categoryid"=>$v['id']])->join("article_info b","a.articleid=b.id")->order("createtime desc")->limit(0,8)->select();
        }
        
        $this->assign("res5",$res5);

        //便民服务
        $re6=db("navidic")->where(["siteid"=>$siteid,"kuaiid"=>6])->find();
        $categoryid6=$re6['categoryidlist'];
        $categoryname6=$re6['categorynamelist'];
        $arrid6=explode(",",$categoryid6);
        $arrname6=explode(",",$categoryname6);
        $arrs6 = array_combine($arrid6, $arrname6);
        $res6=array();
        foreach($arrs6 as $k6 => $v6){
            if(!empty($k6)){
                $res6[]=array("id"=>$k6,"name"=>$v6);
            }
        }
       
        $this->assign("res6",$res6);




        return $this->fetch();
    }
    public function serach()
    {
        $siteid=session("siteid");
        $site=db("category_info")->where(["siteid"=>$siteid,"status"=>0,"level"=>0])->order("orderid desc")->select();
        $this->assign("site",$site);

        $keywords=input("keywords");

        $arr=array();
        foreach($site as $v){
            $arr[]=$v['id'];
        }
        $res=db("category_info")->where(["siteid"=>$siteid,"status"=>0,"parentid"=>["in",$arr]])->select();
        foreach($res as $vv){
            $arr[]=$v['id'];
        }
        $list=db("article_category")->alias("a")->field("a.categoryid as categoryids ,articleid,b.id,title,createtime,reviewstatus,createtime,subtitle,arttype")->where(['reviewstatus'=>1,"a.categoryid"=>["in",$arr]])->where("title","like","%$keywords%")->join("article_info b","a.articleid=b.id")->order("id desc")->paginate(20);
        $page=$list->render();

        $this->assign("list",$list);
        $this->assign("page",$page);
        

        return $this->fetch();
    }
    
}
