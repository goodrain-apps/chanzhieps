<?php if(!defined("RUN_MODE")) die();?>
<?php 
/**
 * The qrcode view of yangcong module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2014 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     商业软件，非开源软件
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     yangcong 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<?php js::set('eventID', $result->event_id);?>
<?php js::set('referer', $referer);?>
<div><?php echo html::image($result->qrcode_url, "class='w-p100'");?></div>
<div><?php echo html::a('javascript:;', $lang->yangcong->scanFinished, "class='btn btn-primary btn-block' id='checkButton'");?></div>
<?php include '../../common/view/footer.modal.html.php';?>
