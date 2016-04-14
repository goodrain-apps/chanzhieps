UPDATE `eps_block` SET `type` = 'htmlcode' WHERE `type`='code';
ALTER TABLE `eps_product` CHANGE `summary` `desc` text NOT NULL;
