[蝉知](http://www.chanzhi.org/)门户系统(chanzhieps)
=====================

> 适配 好雨云 **一键部署** ，源码与官方同步更新。感谢 [易软天创](http://www.cnezsoft.com/) 为我们带来如此优秀的开源软件！


<img src="http://www.goodrain.com/images/apps/chanzhi/logo.png" width="201px" height="78px"></img>


蝉知企业门户系统是由业内资深开发团队开发的一款专向企业营销使用的企业门户系统，企业使用蝉知系统可以非常方便地搭建一个专业的企业营销网站，进行宣传，开展业务，服务客户。蝉知系统内置了文章、产品、论坛、评论、会员、博客、帮助等功能，同时还可以和微信进行集成绑定。功能丰富实用，后台操作简洁方便。蝉知系统还内置了搜索引擎优化必备的功能，比如关键词，摘要，站点地图，友好路径等，使用蝉知系统可以非常方便的搭建对搜索引擎友好的网站。

**蝉知，为天下企业提供专业的营销工具！**

更多信息参见[官方介绍](http://www.chanzhi.org/book/chanzhieps/37.html)

<a href="＃" target="_blank" ><img src="http://www.goodrain.com/images/deploy/button_160125.png" width="147" height="32"></img></a>

# 目录
- [部署到好雨云](#部署到好雨云)
  - [一键部署](#一键部署)
  - [配置向导](#配置向导)
    - [欢迎页面](#欢迎页面)
    - [授权协议](#授权协议)
    - [系统检查](#系统检查)
    - [配置数据库](#配置数据库)
    - [设置帐号](#设置帐号)
    - [安装完成](#安装完成)
    - [登录](#登录)
- [参与和讨论](#参与和讨论)
- [版权说明](#版权说明)


# 部署到好雨云
## 一键部署
通过点击本文最上方的 “部署到好雨云” 按钮会跳转到 好雨应用市场的应用首页中，可以通过一键部署按钮安装

**部署蝉知**

<img src="http://www.goodrain.com/images/apps/chanzhi/deploy00.png" width="70%" height="70%"></img>


**注意：** 由于蝉知需要MySQL数据库，因此部署时会提示用户新建MySQL应用或者选择一个已有的MySQL应用。

## 配置向导
部署完成后 应用首页 点击 “访问” 按钮会跳转到蝉知的安装向导页面，如下图：

### 欢迎页面

<img src="http://www.goodrain.com/images/apps/chanzhi/deploy01.png" width="70%" height="70%"></img>


### 授权协议

<img src="http://www.goodrain.com/images/apps/chanzhi/deploy02.png" width="70%" height="70%"></img>

### 系统检查

<img src="http://www.goodrain.com/images/apps/chanzhi/deploy03.png" width="70%" height="70%"></img>

### 配置数据库
> 请根据关联的MySQL实际情况填写连接信息，可以在MySQL首页，或者蝉知的依赖页面查看到MySQL的连接信息。

<img src="http://www.goodrain.com/images/apps/chanzhi/deploy04.png" width="70%" height="70%"></img>

### 设置帐号

<img src="http://www.goodrain.com/images/apps/chanzhi/deploy05.png" width="60%" height="60%"></img>

### 安装完成

<img src="http://www.goodrain.com/images/apps/chanzhi/deploy06.png" width="60%" height="60%"></img>

> - 安装完成后平台会自动删除 `install.php` 和 `upgrade.php` 文件
> - 如果需要重新初始化配置，只需要删除 `../config/my.php` 文件即可

### 登录

<img src="http://www.goodrain.com/images/apps/chanzhi/deploy07.png" width="60%" height="60%"></img>

# 参与和讨论
如果您对本项目感兴趣或有疑问可以在好雨讨论社区[发表评论](http://t.goodrain.com/c/11-category)

# 版权说明
本项目同步更新 [蝉知](http://www.chanzhi.org/) 官方发布的开源版本，并适配好雨云的一键部署 功能。

[蝉知](http://www.chanzhi.org/) 开源版本 版权归[青岛易软天创网络科技有限公司](http://www.cnezsoft.com/)所有并遵循原软件的[版权规则](https://github.com/goodrain-apps/chanzhieps/blob/master/system/doc/LICENSE)
