<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2015
 * @package yii2-widgets
 * @subpackage yii2-widget-select2
 * @version 2.0.2
 */

namespace kartik\select2;

use Yii;

/**
 * Asset bundle for Select2 Widget
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class Select2Asset extends \kartik\base\AssetBundle
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setSourcePath(__DIR__ . '/assets');
        $this->setupAssets('css', ['css/select2']);
        $this->setupAssets('js', ['js/select2.full', 'js/select2-krajee']);
        parent::init();
    }
}