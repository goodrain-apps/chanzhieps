#!/bin/bash

Dirs="www/data config tmp"
PermanentDir="/data"
AppDir="/app"
UserCfg="${PermanentDir}/config/my.php"
InstallFile="${AppDir}/www/sys/install.php"
UpgradeFile="${AppDir}/www/sys/upgrade.php"


# 在持久化存储中创建需要的目录
for d in $Dirs
do
  if [ ! -d ${PermanentDir}/${d} ] ;then
  
    if [ "$d" == "www/data" ];then
      [ -d ${AppDir}/${d} ] && mkdir -pv ${PermanentDir}/www && mv ${AppDir}/${d} ${PermanentDir}/www
    fi
  
    [ -d ${AppDir}/${d} ] && mv ${AppDir}/${d} ${PermanentDir}/${d} || mkdir -pv ${PermanentDir}/${d}
  else
    mv ${AppDir}/${d} ${AppDir}/${d}.bak
  fi

  ln -s ${PermanentDir}/${d} ${AppDir}/${d}
done

# 如果存在my.php 清理install.php和upgrade.php 文件
if [ -f $UserCfg ];then
  [ -f $InstallFile ] && rm -f $InstallFile
  [ -f $UpgradeFile ] && rm -f $UpgradeFile
fi


# 启动web server
vendor/bin/heroku-php-nginx www/
