<?php if(!defined("RUN_MODE")) die();?>
  </div>
<?php if($config->debug) js::import($jsRoot . 'jquery/form/min.js');?>
<?php if(isset($pageJS)) js::execute($pageJS);?>
</body>
</html>
