<?php
/**
 * baserCMS :  Based Website Development Project <http://basercms.net>
 * Copyright (c) baserCMS Users Community <http://basercms.net/community/>
 *
 * @copyright		Copyright (c) baserCMS Users Community
 * @link			http://basercms.net baserCMS Project
 * @package			Baser.View
 * @since			baserCMS v 4.0.0
 * @license			http://basercms.net/license/index.html
 */

/**
 * [PUBLISH] サイトマップ
 * 
 * カテゴリの階層構造を表現する為、再帰呼び出しを行う
 * $this->BcBaser->contentsMenu() で呼び出す
 */
		 
if (!isset($level)) {
	$level = 1;
}
if(!isset($currentId)) {
	$currentId = null;
}
?>


<?php if (isset($tree)): ?>
<ul class="menu ul-level-<?php echo $level ?>">
	<?php if (isset($tree)): ?>
		<?php foreach ($tree as $content): ?>
			<?php if ($content['Content']['title']): ?>
				<?php
					$liClass = 'menu-content li-level-' . $level;
					if($content['Content']['id'] == $currentId) {
						$liClass .= ' current';
					}
				?>
				<li class="<?php echo $liClass ?>"><?php $this->BcBaser->link($content['Content']['title'], $content['Content']['url']) ?>
				<?php if (!empty($content['children'])): ?>
					<?php $this->BcBaser->element('contents_menu', array('tree' => $content['children'], 'level' => $level + 1, 'currentId' => $currentId)) ?>
				<?php endif ?>
				</li>
			<?php endif ?>
		<?php endforeach; ?>
	<?php endif ?>
</ul>
<?php endif ?>