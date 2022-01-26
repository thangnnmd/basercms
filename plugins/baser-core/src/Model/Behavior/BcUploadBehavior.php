<?php
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) baserCMS User Community <https://basercms.net/community/>
 *
 * @copyright     Copyright (c) baserCMS User Community
 * @link          https://basercms.net baserCMS Project
 * @since         5.0.0
 * @license       http://basercms.net/license/index.html MIT License
 */

namespace BaserCore\Model\Behavior;

use ArrayObject;
use BaserCore\Utility\BcUpload;
use Cake\ORM\Behavior;
use Cake\Event\EventInterface;
use Cake\Datasource\EntityInterface;
use BaserCore\Annotation\Note;
use BaserCore\Annotation\NoTodo;
use BaserCore\Annotation\Checked;
use BaserCore\Annotation\UnitTest;

/**
 * ファイルアップロードビヘイビア
 */
/*
    《設定例》
    $this->addBehavior('BaserCore.BcUpload', [
        // 保存フォルダ名
        'saveDir' => "editor",
        // サブフォルダフォーマット
        // 保存フォルダをサブフォルダで分類する場合に設定
        'subdirDateFormat' => 'Y/m',
        // フィールドごとの設定
        'fields' => [
            // フィールド名
            'image' => [
                // ファイルタイプ
                // all | image | ファイルの拡張子
                'type' => 'image',
                // ファイル名を変換する際に参照するフィールド
                'namefield' => 'id',
                // ファイル名に追加する文字列
                // 文字列 | false
                'nameadd' => false,
                // リサイズ設定
                // アップロードした本体画像をリサイズ
                'imageresize' => [
                // プレフィックス
                'prefix' => 'template',
                // 横幅
                'width' => '100',
                // 高さ
                'height' => '100'
                ],
                // コピー設定
                'imagecopy' => [
                    'thumb' => [
                        'suffix' => 'template',
                        'width' => '150',
                        'height' => '150'
                    ],
                    'thumb_mobile' => [
                        'suffix' => 'template',
                        'width' => '100',
                        'height' => '100'
                    ]
                ]
            ],
            'pdf' => [
                'type' => 'pdf',
                'namefield' => 'id',
                'nameformat' => '%d',
                'nameadd' => false
            ]
        ]
    ]);
 */

/**
 * Class BcUploadBehavior
 *
 * @property BcUpload[] $BcUpload
 */
class BcUploadBehavior extends Behavior
{

    /**
     * 設定
     *
     * @var array
     */
    public $settings = null;

    /**
     * BcUpload
     * @var BcUpload[]
     */
    public $BcUpload = [];

    /**
     * Initialize
     * @param array $config
     * @return void
     * @checked
     * @noTodo
     * @unitTest
     */
    public function initialize(array $config): void
    {
        $this->BcUpload[$this->table()->getAlias()] = new BcUpload();
        $this->BcUpload[$this->table()->getAlias()]->initialize($config, $this->table());
    }

    /**
     * Before Marshal
     *
     * アップロード用のリクエストデータを変換する
     * @param EventInterface $event
     * @param ArrayObject $data
     * @checked
     * @noTodo
     * @unitTest
     */
    public function beforeMarshal(EventInterface $event, ArrayObject $data)
    {
        $this->BcUpload[$this->table()->getAlias()]->setupRequestData($data);
        $this->BcUpload[$this->table()->getAlias()]->setupTmpData($data);
    }

    /**
     * Before Save
     * @param EventInterface $event
     * @param EntityInterface $entity
     * @checked
     * @noTodo
     * @unitTest
     */
    public function beforeSave(EventInterface $event, EntityInterface $entity)
    {
        if ($entity->id) {
            $this->BcUpload[$this->table()->getAlias()]->deleteExistingFiles($entity);
        }
        $this->BcUpload[$this->table()->getAlias()]->saveFiles($entity);
        if ($entity->id) {
            $this->BcUpload[$this->table()->getAlias()]->deleteFiles($entity);
        }
    }

    /**
     * After Save
     *
     * @param EventInterface $event
     * @param EntityInterface $entity
     * @checked
     * @noTodo
     * @unitTest
     */
    public function afterSave(EventInterface $event, EntityInterface $entity)
    {
        if ($this->BcUpload[$this->table()->getAlias()]->isUploaded()) {
            $this->BcUpload[$this->table()->getAlias()]->renameToBasenameFields($entity);
            $this->BcUpload[$this->table()->getAlias()]->resetUploaded();
        }
    }

    /**
     * Before delete
     * テーブル削除時に対象の画像ファイルの削除を行う
     * 削除に失敗してもデータの削除は行う
     * @param EventInterface $event
     * @param EntityInterface $entity
     * @checked
     * @noTodo
     * @unitTest
     */
    public function beforeDelete(EventInterface $event, EntityInterface $entity)
    {
        $this->BcUpload[$this->table()->getAlias()]->deleteFiles($entity, true);
    }

    /**
     * 一時ファイルとして保存する
     *
     * @param array $data
     * @param string $tmpId
     * @return mixed false|array
     * @checked
     * @noTodo
     * @unitTest
     */
    public function saveTmpFiles($data, $tmpId)
    {
        return $this->BcUpload[$this->table()->getAlias()]->saveTmpFiles($data, $tmpId);
    }

    /**
     * 設定情報を取得
     * @param $alias
     * @return mixed
     * @checked
     * @noTodo
     * @unitTest
     */
    public function getSettings()
    {
        return $this->BcUpload[$this->table()->getAlias()]->settings;
    }

    /**
     * 設定情報を設定
     * @param $alias
     * @param $settings
     * @checked
     * @noTodo
     * @unitTest
     */
    public function setSettings($settings)
    {
        $this->BcUpload[$this->table()->getAlias()]->settings = $settings;
    }

    /**
     * 保存先のパスを取得
     * @param $alias
     * @param false $isTheme
     * @param false $limited
     * @return string
     */
    public function getSaveDir($isTheme = false, $limited = false)
    {
        return $this->BcUpload[$this->table()->getAlias()]->getSaveDir($isTheme, $limited);
    }

}
