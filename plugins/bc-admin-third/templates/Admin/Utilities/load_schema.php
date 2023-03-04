<?php
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) baserCMS Users Community <https://basercms.net/community/>
 *
 * @copyright       Copyright (c) baserCMS Users Community
 * @link            https://basercms.net baserCMS Project
 * @package         Baser.View
 * @since           baserCMS v 0.1.0
 * @license         https://basercms.net/license/index.html
 */

/**
 * [ADMIN] スキーマ読み込み フォーム
 */
?>


<!-- form -->
<?php echo $this->BcAdminForm->create('Tool', ['url' => ['action' => 'load_schema'], 'type' => 'file']) ?>

<table class="form-table bca-form-table">
  <tr>
    <th
      class="col-head bca-form-table__label"><?php echo $this->BcAdminForm->label('Tool.schema_type', __d('baser_core', 'スキーマタイプ')) ?>
      &nbsp;<span class="bca-label" data-bca-label-type="required"><?php echo __d('baser_core', '必須') ?></span></th>
    <td class="col-input bca-form-table__input">
      <?php echo $this->BcAdminForm->control('Tool.schema_type', [
        'type' => 'radio',
        'options' => ['create' => __d('baser_core', 'テーブル作成'), 'alter' => __d('baser_core', 'テーブル構造変更'), 'drop' => __d('baser_core', 'テーブル削除')],
        'legend' => false,
        'separator' => '　']); ?>
      <?php echo $this->BcAdminForm->error('Tool.schema_type') ?>
    </td>
  </tr>
  <tr>
    <th
      class="col-head bca-form-table__label"><?php echo $this->BcAdminForm->label('Tool.schema_file', __d('baser_core', 'スキーマファイル')) ?>
      &nbsp;<span class="bca-label" data-bca-label-type="required"><?php echo __d('baser_core', '必須') ?></span></th>
    <td class="col-input bca-form-table__input">
      <?php echo $this->BcAdminForm->control('Tool.schema_file', ['type' => 'file']) ?>
      <?php echo $this->BcAdminForm->error('Tool.schema_file') ?>
    </td>
  </tr>
</table>

<div class="submit bca-actions">
  <div class="bca-actions__main">
    <?php echo $this->BcAdminForm->submit(__d('baser_core', '読み込み'), ['div' => false, 'class' => 'button bca-btn', 'data-bca-btn-size' => 'lg']) ?>
  </div>
</div>

<?php echo $this->BcAdminForm->end(); ?>
