<?php
namespace app\index\controller;

class News extends BaseHome
{
    public function index()
    {
        $siteid=session("siteid");
        $site=db("category_info")->where(["siteid"=>$siteid,"status"=>0,"level"=>0])->order("orderid desc")->select();
        $this->assign("site",$site);

        $id=input("id");
        $re=db("category_info")->where("id",$id)->find();
        $this->assign("re",$re);

        if($re['level'] == 0){
            $res=db("category_info")->where(["siteid"=>$siteid,"status"=>0,"parentid"=>$re['id']])->order("orderid desc")->select();
            $cates=db("category_info")->where(["parentid"=>$re['id'],"status"=>0])->select();
            $arr=array();
            $arr[]=$re['id'];
            foreach($cates as $vs){
             $arr[]=$vs['id']; 
            }
            $list=db("article_category")->alias("a")->field("a.categoryid as categoryids ,articleid,b.id,title,createtime,reviewstatus,createtime,subtitle,arttype")->where(['reviewstatus'=>1,"a.categoryid"=>["in",$arr]])->join("article_info b","a.articleid=b.id")->order("createtime desc")->paginate(20);
          //  var_dump($res);
            $page=$list->render();
        }else{
            $res=db("category_info")->where(["siteid"=>$siteid,"status"=>0,"parentid"=>$re['parentid']])->order("orderid desc")->select();

            $list=db("article_category")->alias("a")->field("a.categoryid as categoryids ,articleid,b.id,title,createtime,reviewstatus,createtime,subtitle,arttype")->where(['reviewstatus'=>1,"a.categoryid"=>$re['id']])->join("article_info b","a.articleid=b.id")->order("createtime desc")->paginate(20);
           
            $page=$list->render();
        }
        

        $this->assign("res",$res);
        $this->assign("list",$list);
        $this->assign("page",$page);

        return $this->fetch();
    }
    public function detail()
    {
        $siteid=session("siteid");
        $site=db("category_info")->where(["siteid"=>$siteid,"status"=>0,"level"=>0])->order("orderid desc")->select();
        $this->assign("site",$site);

        $nid=input("nid");
        $article_category=db("article_category")->where("articleid",$nid)->find();
        $re=db("category_info")->where("id",$article_category['categoryid'])->find();
        $this->assign("re",$re);

        $info=db("article_info")->where("id",$nid)->find();
        $this->assign("info",$info);

        $content=db("article_content")->where("articleid",$nid)->find();
        $this->assign("content",$content);

        db("article_info")->where("id",$nid)->setInc("clicks",1);

        // $arr=array();
        // if($re['level'] == 0){
        //    $arr[]=$re['id'];
        // }else{

        // }

        //上一篇
        $pre=db("article_category")->alias("a")->field("b.id,title")->where("articleid>$nid")->where("a.categoryid",$re['id'])->join("article_info b","a.articleid=b.id")->order("a.id asc")->limit("1")->find();
        $this->assign("pre",$pre);
        
        //下一篇
        $nre=db("article_category")->alias("a")->field("b.id,title")->where("articleid<$nid")->where("a.categoryid",$re['id'])->join("article_info b","a.articleid=b.id")->order("a.id desc")->limit("1")->find();
        $this->assign("nre",$nre);
        

        return $this->fetch();
    }
    public function msg()
    {
        $siteid=session("siteid");
        $site=db("category_info")->where(["siteid"=>$siteid,"status"=>0,"level"=>0])->order("orderid desc")->select();
        $this->assign("site",$site);

        $list=db("msg_info")->where(["siteid"=>$siteid,"status"=>1])->order("id desc")->paginate(10);

        $page=$list->render();

        $this->assign("list",$list);
        $this->assign("page",$page);
        
        return $this->fetch();
    }
    public function save()
    {
       // var_dump(input("post."));
        if(!captcha_check(input('post.yzm'))) {
            // 校验失败
            echo '1';exit;
        }
        $data['username']=\strip_tags(input('name'));
        $data['email']=\strip_tags(input('email'));
        $data['tel']=\strip_tags(input('tel'));
        $data['content']=\strip_tags(input('content'));
        $data['createtime']=date("Y-m-d H:i:s");
        $data['siteid']=session("siteid");
        $re=db("msg_info")->insert($data);
        if($re){
            echo '0';
        }else{
            echo '2';
        }

    }
}