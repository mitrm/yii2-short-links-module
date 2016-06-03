<?php
namespace mitrm\links;

use Yii;
use yii\base\InvalidConfigException;

/**
 * ShortLinks module.
 */
class Module extends \yii\base\Module
{
    public $is_backend = true;

    public $domain = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if(!$this->domain) {
            throw new InvalidConfigException('Не указан домен');
        }
        if ($this->is_backend === true) {
            $this->setViewPath('@mitrm/links/views/backend');
            if ($this->controllerNamespace === null) {
                $this->controllerNamespace = 'mitrm\links\controllers';
            }
        } else {

        }
        parent::init();
    }
}