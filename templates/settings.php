<?php

/**
 * @package XSS filter
 * @author Iurii Makukh <gplcart.software@gmail.com>
 * @copyright Copyright (c) 2018, Iurii Makukh <gplcart.software@gmail.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html GPL-3.0-or-later
 * @var $this \gplcart\core\controllers\backend\Controller
 * To see available variables <?php print_r(get_defined_vars()); ?>
 */
?>
<form method="post" class="form-horizontal">
  <input type="hidden" name="token" value="<?php echo $_token; ?>">
  <div class="form-group<?php echo $this->error('tags', ' has-error'); ?>">
    <label class="col-md-2 control-label"><?php echo $this->text('Allowed tags'); ?></label>
    <div class="col-md-4">
      <input name="settings[tags]" class="form-control" value="<?php echo isset($settings['tags']) ? $this->e($settings['tags']) : ''; ?>">
      <div class="help-block">
          <?php echo $this->error('tags'); ?>
        <div class="text-muted">
          <?php echo $this->text('List of HTML tags to keep in the filtered text. Separate each name with comma'); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="form-group<?php echo $this->error('protocols', ' has-error'); ?>">
    <label class="col-md-2 control-label"><?php echo $this->text('Allowed protocols'); ?></label>
    <div class="col-md-4">
      <input name="settings[protocols]" class="form-control" value="<?php echo isset($settings['protocols']) ? $this->e($settings['protocols']) : ''; ?>">
      <div class="help-block">
          <?php echo $this->error('protocols'); ?>
        <div class="text-muted">
            <?php echo $this->text('Allow only the specified protocols in external URLs, otherwise cut them. Separate each name with comma'); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-4 col-md-offset-2">
      <div class="btn-toolbar">
        <a href="<?php echo $this->url("admin/module/list"); ?>" class="btn btn-default"><?php echo $this->text("Cancel"); ?></a>
        <button class="btn btn-default save" name="save" value="1"><?php echo $this->text("Save"); ?></button>
      </div>
    </div>
  </div>
</form>