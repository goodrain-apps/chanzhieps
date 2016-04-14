<?php if(!defined("RUN_MODE")) die();?>
<section id="listMode" class='list-products'>
  <table class='table table-list'>
    <tbody>
      <?php foreach($products as $product):?>
      <tr>
        <td class='w-80px text-middle'>
        <?php
        if(empty($product->image))
        {
            echo html::a(inlink('view', "id=$product->id", "category={$product->category->alias}&name=$product->alias"), '<div class="media-placeholder media-placeholder-list" data-id="' . $product->id . '">' . $product->name . '</div>', "class='w-80px'");
        }
        else
        {
            $title = $product->image->primary->title ? $product->image->primary->title : $product->name;
            echo html::a(inlink('view', "id=$product->id", "category={$product->category->alias}&name=$product->alias"), html::image($product->image->primary->middleURL, "width='80' title='{$title}' alt='{$product->name}'"), "class='w-80px'");
        }
        ?>
        </td>
        <td id='listProduct<?php echo $product->id?>' data-ve='product' data-id='<?php echo $product->id?>'>
          <?php echo html::a(inlink('view', "id={$product->id}", "category={$product->category->alias}&name=$product->alias"), '<strong>' . $product->name . '</strong>');?>
        </td>
        <td>
          <?php
          if(!$product->unsaleable)
          {
              if($product->promotion != 0)
              {
                  echo "<strong class='text-muted'>"  .'</strong>';
                  echo "<strong class='text-danger'>" . $this->config->product->currencySymbol . $product->promotion . '</strong>&nbsp;&nbsp;';
              }
              else
              {
                  if($product->price != 0)
                  {
                      echo "<strong class='text-danger'>" . $this->config->product->currencySymbol . $product->price . '</strong>&nbsp;&nbsp;';
                  }
              }
          }
          ?>
        </td>
        <td class="w-100px">
          <?php if(!$product->unsaleable and commonModel::isAvailable('shop')):?>
          <?php echo html::a(inlink('view', "id={$product->id}", "category={$product->category->alias}&name=$product->alias"), $lang->product->buyNow, "class='btn btn-xs btn-success'")?>
          <?php else:?>
          <?php echo html::a(inlink('view', "id={$product->id}", "category={$product->category->alias}&name=$product->alias"), $lang->product->detail, "class='btn btn-xs btn-success'")?>
          <?php endif;?>
        </td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>
</section>
