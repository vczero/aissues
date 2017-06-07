-- MySQL dump 10.13  Distrib 5.7.12, for osx10.9 (x86_64)
--
-- Host: 127.0.0.1    Database: aissues_xiaoshu
-- ------------------------------------------------------
-- Server version	5.7.18

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `newsid` varchar(100) NOT NULL,
  `userid` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `author` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `time` varchar(45) DEFAULT NULL,
  `content` varchar(2000) DEFAULT NULL,
  `keywords` varchar(45) DEFAULT NULL,
  `imgurl` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`newsid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES ('01092B49-12FE-4CB4-9189-EA238DC0EB9C','b62b939fff35d6ade758e9da10b1bf78a','工作太忙，如何抽时间学习','簋谣','管理','17-06-07 17:41:39','<h1><a href=\"http://t.aissues.com/tag/wenda/\" style=\"font-size: 1.6rem; font-weight: 400;\">问答栏目</a><span style=\"font-size: 1.6rem; font-weight: 400;\">&nbsp;</span><time style=\"font-size: 1.6rem; font-weight: 400;\">2017-06-05</time><br></h1><section><p>问这个问题的是我的一个朋友，毕业 3 年左右，非科班出身，在一个创业公司做客户端开发。他的疑问是创业公司太忙了，晚上升职加班到11、12点才回家，所以基本上没有时间去学习。</p><p>但是，该同学呢，又是一个勤奋上进的积极份子，所以就会疑虑，就会苦闷，就会恐慌，甚至害怕落后。同样，也有很多同学问过簋谣的类似问题，尤其是快速奔跑的创业公司。</p><p>这里簋谣就分析几点。</p><h5>真的没有时间吗？</h5><p>回答这个问题，需要从你的实际行动中去看。比如，上班坐了一个小时的地铁，但是地铁看的却是笑话或者发呆，那么我认为这个时间，你可以利用起来。比如，可以下几个 pdf 或者关注几个技术博客。但是这样的碎片时间，簋谣不建议看系统化的知识，因为在这样的一个环境里容易被打扰，容易分神，不利于深入思考，万一不小心坐过站了呢。但是，了解横向的知识是可以的。OK, 可以尝试问问自己这个问题，然后搜索一些时间管理方面的素材看看。</p><h5>是否考虑过跟公司业务结合</h5><p>很多同学，一想到进步就是新奇、就是跟公司的技术不一样。其实，这样需要区别看待。比如切页面这个工作你做的还不错，然后又想学习 JavaScript，那么可以业务学习。但是如果你连这个工作都没有做到理想的程度，就希望业余时间恶补其他知识，这是会造成一个主次不分的现象。</p><p>因为，公司使用的技术正好是实战的平台，大可深挖。所以，在开发公司业务的同时，学习知识，相信主管或者老板是十分理解的。一味的追求新奇技术，任何时候都是 \"Hello world\"。意义并不大。如果你写了 n 多 HELLO WORLD ，那也是“集市”成就，不过那时候你肯定也烦了。</p><h5>可以走了</h5><p>一家不注重员工成长的公司，是可耻的。成长分两个方面：「财务」和「能力」。如果，这两方面都提供不了，就跟你说：“哥们，坚持，坚持，坚持 3 个月，产品出来就好了”。看到没，根本没有承诺，根本就是“在需要的时候打感情牌”。</p><p>如果公司盈利很丰厚，技术环境你觉得可以忍受，待遇也算公平，甚至还可以，那么留下就好。但是，技术和财务两方面都没有情况下，大可让他做“春秋美梦”。签了一纸合约，就是契约精神，能做到的就是合作和尊重。</p><p>说到尊重，前几天知乎一同学评论。说拉他入伙，创建项目，结果入伙了，项目外部了，团队解散。这就是梦想碎了，蛋疼了。这样的公司可以走了。</p><h5>总结</h5><p>首先，需要问自己是否真的完全没有时间，哪些可以安排，哪些可以支配，哪些可以更好的管理。其次，学习不是一味的追求新技能，不是一味的的 HELLO WORLD。可以参考这篇文章《你追求的只是技能，根本不是什么能力》。 最后，深入了解公司和内心的诉求，在这家公司你还希望得到什么，而这部分正好公司也需要，是走是留，走心就好。簋谣.问答出品，仅供参考。</p></section><p><br></p>','簋谣',NULL),('0EB7A5D7-3BF1-419F-884C-8809D9539249','b62b939fff35d6ade758e9da10b1bf78a','如何定制学习计划？','如何定制学习计划？','科技','17-06-07 17:44:10','<h1>如何定制学习计划？</h1><p><br></p>','如何定制学习计划？',NULL),('35350D5E-A428-41AA-87E8-8B7B1DBE9CE0','b62b939fff35d6ade758e9da10b1bf78a','如何定制学习计划？','如何定制学习计划？','weex','17-06-07 17:44:31','<h1>如何定制学习计划？</h1><p><br></p>','如何定制学习计划？',NULL),('44766D8C-DB1E-4956-B3F0-5AD950334A41','b62b939fff35d6ade758e9da10b1bf78a','如何定制学习计划？','如何定制学习计划？','科技','17-06-07 17:43:43','<h1>如何定制学习计划？</h1><p><br></p>','如何定制学习计划？',NULL),('5F33FCBA-C4FC-441A-B3C9-C109CC2C0FF5','b62b939fff35d6ade758e9da10b1bf78a','如何定制学习计划？','如何定制学习计划？','科技','17-06-07 17:44:52','<p><br></p>','如何定制学习计划？',NULL),('897A9B29-5684-4AF1-989D-088ABE4EDFC9','b62b939fff35d6ade758e9da10b1bf78a','如何定制学习计划？','如何定制学习计划？','科技','17-06-07 17:44:59','<h1>如何定制学习计划？</h1><p><br></p>','如何定制学习计划？',NULL),('936177DB-A360-41F3-B645-6DC08A17E132','b62b939fff35d6ade758e9da10b1bf78a','如何定制学习计划？','如何定制学习计划？','微信小程序','17-06-07 17:44:22','<h1>如何定制学习计划？</h1><p><br></p>','如何定制学习计划？',NULL),('937F1968-1754-4264-9BF0-DFA7B1EB2521','b62b939fff35d6ade758e9da10b1bf78a','如何定制学习计划？','如何定制学习计划？','生活','17-06-07 17:43:53','<h1>如何定制学习计划？</h1><p><br></p>','如何定制学习计划？',NULL),('A45C7EDD-851D-4F8A-8843-A55F47E8C505','b62b939fff35d6ade758e9da10b1bf78a','通向未来的前端工程师','簋谣','互联网','17-06-07 17:40:10','<p><a href=\"http://t.aissues.com/tong-xiang-wei-lai-de-qian-duan-gong-cheng-shi/\" target=\"_blank\">http://t.aissues.com/tong-xiang-wei-lai-de-qian-duan-gong-cheng-shi/</a></p><p><br></p>','簋谣',NULL),('DD6B15F4-D602-4091-9EC1-52A6F942F09F','b62b939fff35d6ade758e9da10b1bf78a','如何定制学习计划？','簋谣','电影','17-06-07 17:42:51','<p>没有编辑任何内容</p>','如何定制学习计划？',NULL);
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-07 18:03:20
