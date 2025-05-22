<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'web/css/register.css',
        'web/css/login.css',
        'web/css/side.css',
        'web/css/topbar.css',
        'web/main_web.css',
        'web/css/footer.css',
        'web/css/web/header.css',
        'web/css/web/nav.css',
        'web/css/web/footer.css',
        'web/css/web/slideshow.css',
        'web/css/web/features.css',
        'web/css/web/about.css',
        'web/css/web/services.css',
        'web/css/web/terms.css',
        'web/css/web/contacts.css',
        'web/css/admin/navigation.css',
        'web/css/admin/dashboard.css',
        'web/css/admin/user_index.css',
        'web/css/admin/user_form.css',
        'web/css/admin/jobs.css',
        'web/css/admin/job_create.css',
        'web/css/profile.css'
    ];
    public $js = [
        'web/js/login.js',
        'web/js/side.js',
        'web/js/web/land.js',
        'web/js/web/slideshow.js',
        'web/js/admin/navigation.js',
        'https://cdn.jsdelivr.net/npm/sweetalert2@11',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];
}
