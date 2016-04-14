<?php if(!defined("RUN_MODE")) die();?>
<?php include "header.html.php"; ?>
<div class='pull-right'>
  <div id='searchbox'>
    <input type='text' placeholder='<?php echo $lang->visual->searchBlock ?>' class='form-control'>
    <i class='icon icon-search'></i>
  </div>
  <a href='###' id='createBlockBtn' class='btn btn-primary'><i class='icon icon-plus'> </i><?php echo $lang->visual->js->createBlock ?></a>
</div>
<ul class='nav nav-tabs'>
  <li class='active' data-key=''><a href='###' data-key=''><?php echo $lang->visual->allBlock; ?></a></li>
  <?php foreach ($lang->block->categoryList as $category => $name):?>
  <li data-key='<?php echo $category ?>'><a href='###' data-key='<?php echo $category ?>'><?php echo $name ?></a></li>
  <?php endforeach ?>
</ul>
<ul class='nav nav-blocks clearfix'>
  <?php if($allowregionblock): ?>
    <li data-keys='#region <?php echo $lang->visual->js->subRegion ?>'>
      <a href='###' class='btn-add-block' data-id='region' id='addRegionBlock'>
      <strong class='nobr'><?php echo $lang->visual->js->subRegion;?></strong>
      <small class='text-muted nobr'><?php echo $lang->visual->js->subRegionDesc ?></small>
      </a>
    </li>
  <?php endif; ?>

  <?php foreach($config->block->categoryList as $category => $blockList):?>
    <?php foreach($blocks as $block):?>
    <?php if(strpos($blockList, ",$block->type,") === false) continue;?>
    <li data-keys='<?php echo "={$block->type} {$typeList[$block->type]} @{$category} {$block->title} #{$block->id}"?>'>
      <a href='###' class='btn-add-block' title="<?php echo $block->title?>" data-id='<?php echo $block->id;?>'>
        <strong class='nobr'><?php echo helper::subStr($block->title, 20);?></strong>
        <small class='text-muted nobr'><?php echo $lang->block->categoryList[$category];?> / <?php echo $typeList[$block->type] ?></small>
      </a>
    </li>
    <?php endforeach;?>
  <?php endforeach;?>
</ul>
<script>
$(function()
{
    var $blocks = $('.nav-blocks > li');
    var searchBlocks = function(key)
    {
        if(!key || key === '') $blocks.removeClass('hidden');
        $blocks.each(function()
        {
            var $block = $(this);
            $block.toggleClass('hidden', $(this).data('keys').indexOf(key) < 0);
        });
        $('.nav-tabs > li.active').removeClass('active');
        $('.nav-tabs > li[data-key="' + key + '"]').addClass('active');
    };

    $(document).on('click', '.btn-add-block:not(.disabled, #addRegionBlock)', function()
    {
        window.parent.$.addBlock('<?php echo $page?>', '<?php echo $region?>', $(this).data('id'), '<?php echo $parent?>');
    }).on('click', '.nav-tabs > li > a', function()
    {
        var $a = $(this);
        $('.nav-tabs > li.active').removeClass('active');
        $a.parent().addClass('active');
        searchBlocks($a.data('key'));
    });

    $('#createBlockBtn').on('click', function()
    {
        window.parent.$.createBlock('<?php echo $page?>', '<?php echo $region?>', '<?php echo $parent?>');
    });

    $('#addRegionBlock').on('click', function()
    {
        window.parent.$.addBlock('<?php echo $page?>', '<?php echo $region?>', 'region');
    });

    $('#searchbox > .form-control').on('keyup paste input change', function()
    {
        var key = $(this).val();
        searchBlocks(key);
    });
});
</script>
<?php include "footer.html.php"; ?>
