<?php

namespace app\models;

use app\helpers\CustomHelper;
use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;


/**
 * This is the model class for table "manager".
 *
 * @property int $id
 * @property string $title
 * @property string $image
 * @property string $company
 * @property string $address
 * @property string $email
 * @property string $site
 * @property string $phone
 * @property string $phone_time
 * @property int $type_f
 * @property int $created_at
 * @property int $updated_at
 * @property int $status_id
 *
 * @property Category[] $categories
 * @property Event[] $events
 * @property Type $typeF
 * @property Paper[] $papers
 * @property Webinar[] $webinars
 * @property string $type
 * @property UploadedFile $download
 */
class Manager extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $download;

    public function behaviors()
    {
        return [
            \yii\behaviors\TimestampBehavior::className(),
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'manager';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'company', 'email', 'phone_time', 'address', 'site', 'phone'], 'required'],
            [['type_f', 'status_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'address', 'image'], 'string', 'max' => 255],
            [['download'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxSize' => CustomHelper::getSizeLimitBytes()],
            [['company'], 'string', 'max' => 50],
            [['email', 'phone_time'], 'string', 'max' => 60],
            [['site', 'phone'], 'string', 'max' => 20],
            [['type_f'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type_f' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'image' => 'Image',
            'company' => 'Company',
            'address' => 'Address',
            'email' => 'Email',
            'site' => 'Site',
            'phone' => 'Phone',
            'phone_time' => 'Phone Time',
            'type_f' => 'Type F',
            'status_id' => 'Status Id',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['manager_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['manager_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypeF()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_f']);
    }

    /**
     * @return mixed
     */
    public function getType() {
        return $this->getTypeF()->one()->attributes['db_name'];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPapers()
    {
        return $this->hasMany(Paper::className(), ['manager_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWebinars()
    {
        return $this->hasMany(Webinar::className(), ['manager_id' => 'id']);
    }

    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function getDate()
    {
        return Yii::$app->formatter->asDatetime($this->updated_at,'php:d.m.Y');
    }

    /**
     * @return bool
     */
    public function upload()
    {

        if ($this->download) {
            $baseName = Yii::$app->transliter->translate($this->download->baseName) . '_' . rand(0, 99);

            $nameAndExtension = $baseName  . '.' . $this->download->extension;
            $fileName = 'manager_images/original/' . $nameAndExtension;
            $this->download->saveAs($fileName);
            $img = Image::getImagine()->open($fileName);

            $size = $img->getSize();
            $currentWidth = $size->getWidth();
            if ($currentWidth != 50) {
                $ratio = $currentWidth/$size->getHeight();
                $width = 50;
                $height = round($width/$ratio);

                $box = new Box($width, $height);
                $img->resize($box)->save('manager_images/' . $nameAndExtension, ['quality' => 100]);
            }
            else {
                copy($fileName, 'manager_images/' . $nameAndExtension);
                @unlink($fileName);
            }

            return $nameAndExtension;
        } else {
            return false;
        }
    }
}
