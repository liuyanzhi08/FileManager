-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 12, 2013 at 02:09 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_reglog`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_comment`
--

CREATE TABLE IF NOT EXISTS `tb_comment` (
  `id` int(6) NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `author_id` int(6) NOT NULL COMMENT '评论者的id',
  `message_id` int(6) NOT NULL COMMENT '被评论的消息的id',
  `content` varchar(200) NOT NULL COMMENT '评论内容',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '评论时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_docfile`
--

CREATE TABLE IF NOT EXISTS `tb_docfile` (
  `id` int(4) NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `name` varchar(200) NOT NULL COMMENT '资料名称',
  `doctypeid` int(4) NOT NULL COMMENT '所属分类id',
  `path` varchar(200) NOT NULL COMMENT '资料下载路径',
  `uptime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '资料上传时间',
  `size` bigint(20) NOT NULL COMMENT '文件大小',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tb_docfile`
--

INSERT INTO `tb_docfile` (`id`, `name`, `doctypeid`, `path`, `uptime`, `size`) VALUES
(12, 'msvcp90.dll', 159, '../updocs/159/1371002732271235252.dll', '2013-06-12 02:05:32', 568832);

-- --------------------------------------------------------

--
-- Table structure for table `tb_doctype`
--

CREATE TABLE IF NOT EXISTS `tb_doctype` (
  `id` int(4) NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `name` varchar(200) NOT NULL COMMENT '分类名称',
  `pretypeid` int(4) NOT NULL DEFAULT '0' COMMENT '下级分类id',
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '分类建立时间',
  `path` varchar(200) NOT NULL COMMENT '分类下载路径名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=160 ;

--
-- Dumping data for table `tb_doctype`
--

INSERT INTO `tb_doctype` (`id`, `name`, `pretypeid`, `createtime`, `path`) VALUES
(1, '根分类', 0, '2013-06-11 10:09:04', '../updocs/1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_member`
--

CREATE TABLE IF NOT EXISTS `tb_member` (
  `id` int(4) NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `name` varchar(100) NOT NULL COMMENT '用户名称',
  `password` varchar(100) NOT NULL COMMENT '用户密码',
  `email` varchar(100) NOT NULL COMMENT 'Email',
  `realname` varchar(100) NOT NULL COMMENT '真实姓名',
  `birthday` date NOT NULL COMMENT '出生日期',
  `telephone` varchar(20) NOT NULL COMMENT '电话号码',
  `qq` varchar(15) NOT NULL COMMENT 'QQ号码',
  `count` int(1) NOT NULL DEFAULT '0' COMMENT '登录限制',
  `active` int(1) NOT NULL DEFAULT '0' COMMENT '是否激活',
  `right` int(1) NOT NULL COMMENT '用户权限',
  `content` bigint(50) NOT NULL COMMENT '空间使用情况',
  `admin` int(1) NOT NULL DEFAULT '0' COMMENT '是否是管理员',
  `number` varchar(100) NOT NULL COMMENT '学号',
  `phone` varchar(100) NOT NULL COMMENT '电话号码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tb_member`
--

INSERT INTO `tb_member` (`id`, `name`, `password`, `email`, `realname`, `birthday`, `telephone`, `qq`, `count`, `active`, `right`, `content`, `admin`, `number`, `phone`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '702368372@qq.com', '张三', '0000-00-00', '', '', 1, 1, 0, 0, 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_message`
--

CREATE TABLE IF NOT EXISTS `tb_message` (
  `id` int(6) NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `content` varchar(200) NOT NULL COMMENT '消息内容',
  `author_id` int(4) NOT NULL COMMENT '消息作者id',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '消息时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_notice`
--

CREATE TABLE IF NOT EXISTS `tb_notice` (
  `id` int(4) NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `content` varchar(200) NOT NULL COMMENT '公告内容',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '发布时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_upfile`
--

CREATE TABLE IF NOT EXISTS `tb_upfile` (
  `id` int(4) NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `filename` varchar(200) NOT NULL COMMENT '文件名称',
  `filepath` varchar(200) NOT NULL COMMENT '保存路径',
  `filetype` varchar(100) NOT NULL COMMENT '文件类型',
  `upauthor` varchar(100) NOT NULL COMMENT '上传用户',
  `uptime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `filesize` bigint(20) NOT NULL COMMENT '文件大小',
  `filetype_id` int(4) NOT NULL COMMENT '文件类型id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_uptype`
--

CREATE TABLE IF NOT EXISTS `tb_uptype` (
  `id` int(4) NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `genrename` varchar(200) NOT NULL COMMENT '类型名称',
  `description` varchar(400) NOT NULL COMMENT '分类的说明',
  `deadline` datetime NOT NULL COMMENT '分类上传截止时间',
  `foldpath` varchar(200) NOT NULL COMMENT '储存分类的文件路径',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=161 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
