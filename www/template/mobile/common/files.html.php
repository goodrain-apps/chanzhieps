<?php if(!defined("RUN_MODE")) die();?>
<style>
.files-list {display: block; padding: 5px; margin: 0; background-color: @color-gray-pale;}
.files-list > li {position: relative; display: block; float: left; padding: 0; margin: 5px; position: relative;}
.files-list > li > a {color: #666; display: block; height: 70px; min-width: 70px; line-height: 60px; padding: 3px; max-width: 400px; overflow: hidden; text-align: center;background-color: #fff; opacity: 0.9; border: 1px solid #ddd}
.files-list > li > a:hover {opacity: 1; box-shadow: 0 1px 6px rgba(0, 0, 0, 0.3); border-color: #ccc; color: #506EAF;text-decoration: none;}
.files-list > li > a > img, .files-list > li > a > img:hover{max-width: 200px; max-height: 100%; box-shadow: none; margin: 0}
.files-list:empty {display: none;}
.files-list > li.file > a {line-height: 25px; padding: 40px 30px 5px; max-width: 240px; white-space:nowrap; text-overflow:ellipsis; -o-text-overflow:ellipsis; overflow:hidden;}
.files-list > li.file > a:before {display: block; width: 100%; font-size: 30px; position: absolute; top: 10px; text-align: center; left: 0; content: '\e6d4'; font-family: ZenIcon;}
.files-list > li.files-list-heading {float: none; display: block; color: #999;font-weight: bold;}
.files-list > li .file-actions {display: block; position: absolute; right: 0; top: 0;} 
.files-list > li .file-actions > a {opacity: 0; display: inline-block; background-color: #D9E8F5; color: #666; padding: 3px 7px;}
.files-list > li:hover .file-actions > a,.files-list > li .file-actions > a:hover {opacity: 1; background-color: #145BCC; color: #fff; text-decoration: none;}

.files-list > li.file.file-zip > a:before, .files-list > li.file.file-rar > a:before {content: '\e751'}
.files-list > li.file.file-doc > a:before {content: '\e72c';}
.files-list > li.file > .file-md5 {display: none}
.files-list > li.file > .file-download {top: 3px; right: 5px; position: absolute; font-size: 12px; opacity: .5}
</style>
