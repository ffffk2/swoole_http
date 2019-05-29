<?php

namespace app\index\controller;

use core\Controller;

class Index extends Controller{

    public function index(){
        $str = '<!DOCTYPE html><html lang="en"><head>	<meta charset="UTF-8">	<title>爱易学堂</title>	<style type="text/css">		body{padding:0;margin:0;background:#f1f1f1;}		#title{width:100%; padding:10px 0;text-align: center;}		#title h1{margin:0;color: #28b779;font-size: 30px;font-weight: bold;}		#title h3{margin:0;color: #666;font-weight: bold;padding:10px 0;}		#title p{padding:10px 0; font-size:16px; color:#555;}		.wal{width:1200px; margin:0px auto; text-align:center;}		/*底部*/		#footDiv{ background:#dfe3e7;position:absolute;bottom:0;left:0;width:100%;padding:10px 0;text-align:center;}		#footDiv .imgDiv{ padding-top:30px; margin-bottom:20px;}		#footDiv .list{ padding-bottom:50px;}		#footDiv .list .list_1{ width:487px;}		#footDiv .list .list_2{ width:310px;}		#footDiv .list p{ font-size:14px; color:#898989; line-height:20px; margin-bottom:14px;}	</style></head><body><div style=" width:800px; height:500px; margin:0 auto;"><h3>广州外语通软件科技有限公司</h3><p>	<span style="font-size: 14px"><strong>广州外语通软件科技有限公司</strong>是专业从事教育内容资源开发与研发、图书编辑、词典编撰、教育数据制作转换、教育应用软件开发的高新技术企业，是中国教育电子行业最大的内容提供商及服务商。广州外语通成立于2003年，是业内最早最专业的教育版权内容核心研发商，我们为出版行业提供了数千套教材、词典、视听读物；为教育电子行业提供优质教育内容及应用软件：同步教辅用书（近2千本）、动漫课堂、海淀黄冈同步名师课堂（涵盖中国大部分教材数万节课）、中小学知识点微课堂(4万节课左右)、百万题库系统、早教内容及互动游戏全方案、版权词典、多国语学习软件，</span><span style="font-size: 12px"> 广州外语通为出版行业提供全套服务、选题制作排版、配套软件开发、配套音视频制作。</span></p><p>	<span style="font-size: 14px"> 广州外语通为教育电子行业提供内容开发、教育应用开发、系统集成、网站建设、一站式解决方案，是中国教育电子业内销量排名前8名厂商的核心内容及软件供应商。</span></p><p>	<span style="font-size: 14px"> 广州外语通拥有中国最大的大学、中学、小学教师人才平台（超过50万大中小学教师），签约教师超过数万名，在广州、北京、武汉、西安、上海、中山均设立了数百人的研发中心。</span></p><p>	<span style="font-size: 14px"> 广州外语通致力于以优质教育资源改变教育教育不均衡现状，以新型IT技术创造更好更新的用户学习体验。</span></p><p>	<span style="font-size: 14px">我们的信念：十年树木，百年树人！教育是一项需要坚守的行业。诚信本分做人，务实肯干做事，创新开拓做产品是我们的立命之本。</span></p><p>	<span style="font-size: 14px">我们欢迎热爱教育的有识人士加入我们。</span></p></div><div style=" width:800px;margin:0 auto;"><p style="text-align:center">© 2003-2016 视界云教育-广州外语通软件科技有限公司 版权所有 推荐使用IE6.0以上版本的浏览器 </p><p style="text-align:center"><a href="http://www.miitbeian.gov.cn/" style="text-decoration:none">粤ICP备15051375号-7 </a> 电子邮箱：magaworld@163.com </p>        </div></body></html>';
        $this->send($str);
    }
}