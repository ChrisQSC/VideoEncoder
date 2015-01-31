<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Video".
 *
 * @property integer $id
 * @property string $filename
 * @property string $create_at
 * @property string $path
 * @property integer $uploader_id
 * @property string $thumbnail
 * @property string $md5
 * @property string $resolution
 * @property integer $bitrate
 * @property string $duration
 * @property integer $1080p
 * @property integer $720p
 * @property integer $480p
 * @property integer $category
 */
class Video extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Video';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['filename', 'path', 'uploader_id'], 'required'],
            [['create_at'], 'safe'],
            [['uploader_id', 'bitrate', '1080p', '720p', '480p', 'category'], 'integer'],
            [['filename'], 'string', 'max' => 100],
            [['path', 'thumbnail'], 'string', 'max' => 255],
            [['md5', 'duration'], 'string', 'max' => 60],
            [['resolution'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'filename' => Yii::t('app', 'Filename'),
            'create_at' => Yii::t('app', 'Create At'),
            'path' => Yii::t('app', 'Path'),
            'uploader_id' => Yii::t('app', 'Uploader ID'),
            'thumbnail' => Yii::t('app', 'Thumbnail'),
            'md5' => Yii::t('app', 'Md5'),
            'resolution' => Yii::t('app', 'Resolution'),
            'bitrate' => Yii::t('app', 'Bitrate'),
            'duration' => Yii::t('app', 'Duration'),
            '1080p' => Yii::t('app', '1080p'),
            '720p' => Yii::t('app', '720p'),
            '480p' => Yii::t('app', '480p'),
            'category' => Yii::t('app', 'Category'),
        ];
    }
}
