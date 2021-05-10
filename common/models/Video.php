<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;

/**
 * This is the model class for table "{{%video}}".
 *
 * @property string $video_id
 * @property string $title
 * @property string|null $description
 * @property string|null $tags
 * @property int|null $status
 * @property int|null $has_thumbnail
 * @property string|null $video_name
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 */
class Video extends \yii\db\ActiveRecord
{

    const STATUS_UNLISTED = 0;
    const STATUS_PUBLISHED = 1;

    /**
     * @var \yii\web\UploadedFile
     */
    public $video;

    /**
     * @var \yii\web\UploadedFile
     */
    public $thumbnail;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%video}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => BlameableBehavior::class,
                'updatedByAttribute' => false
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['video_id', 'title'], 'required'],
            [['description'], 'string'],
            [['status', 'has_thumbnail', 'created_at', 'updated_at', 'created_by'], 'integer'],
            [['video_id'], 'string', 'max' => 16],
            [['title', 'tags', 'video_name'], 'string', 'max' => 512],
            [['video_id'], 'unique'],
            ['has_thumbnail', 'default', 'value' => 0],
            ['status', 'default', 'value' => self::STATUS_UNLISTED],
            ['thumbnail', 'image', 'minWidth' => 720],
            ['video', 'file', 'extensions' => ['mp4']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => 'id'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'video_id' => Yii::t('app', 'Video ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'tags' => Yii::t('app', 'Tags'),
            'status' => Yii::t('app', 'Status'),
            'has_thumbnail' => Yii::t('app', 'Has Thumbnail'),
            'video_name' => Yii::t('app', 'Video Name'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'thumbnail' => Yii::t('app', 'Thumbnail'),
        ];
    }

    public function getStatusLabels()
    {
        return [
            self::STATUS_UNLISTED => 'Unlisted',
            self::STATUS_PUBLISHED => 'Published',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     * 
     * @return \yii\db\ActiveQuery\common\models\query\UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\VideoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\VideoQuery(get_called_class());
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->isNewRecord) {
            $this->video_id = Yii::$app->security->generateRandomString(8);
            $this->title = $this->video->name;
            $this->video_name = $this->video->name;
        }
        if($this->thumbnail){
            $this->has_thumbnail = 1;
        }
        $saved = parent::save($runValidation, $attributeNames);
        if (!$saved) {
            return false;
        }
        if ($this->isNewRecord) {
            $videoPath = Yii::getAlias('@frontend/web/storage/videos/'.$this->video_id.'.mp4');
            if(!is_dir(dirname($videoPath))){
                FileHelper::createDirectory(dirname($videoPath));
            }
            $this->video->saveAs($videoPath);
        }
        if($this->thumbnail){
            $thumbnailPath = Yii::getAlias('@frontend/web/storage/thumbs/'.$this->video_id.'.png');
            if(!is_dir(dirname($thumbnailPath))){
                FileHelper::createDirectory(dirname($thumbnailPath));
            }
            $this->thumbnail->saveAs($thumbnailPath);
            Image::getImagine()->open($thumbnailPath)->thumbnail(new Box(640,360))->save();
        }

        return true;
    }

    public function getVideoLink()
    {
        return Yii::$app->params['frontendUrl'].'/storage/videos/'.$this->video_id.'.mp4';
    }

    public function getThumbnailLink()
    {
        return $this->has_thumbnail 
            ? Yii::$app->params['frontendUrl'].'/storage/thumbs/'.$this->video_id.'.png'
            : '';
    }
}
