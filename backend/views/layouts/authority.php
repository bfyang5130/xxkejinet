<?php

use yii\helpers\Html;
use backend\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
AppAsset::addPageCss($this, '/css/fullcalendar.css');
AppAsset::addPageCss($this, '/css/maruti-style.css');
AppAsset::addPageCss($this, '/css/maruti-media.css');
AppAsset::addPageScript($this, '/js/jquery.ui.custom.js');
AppAsset::addPageScript($this, '/js/bootstrap.min.js');
AppAsset::addPageScript($this, '/js/maruti.js');
$this->title = "寻想网络科技";
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <!-- common_header -->
        <?= $this->render('common_header') ?>
        <!-- end-common_header -->
        <!-- common_menu -->
        <?= $this->render('common_authority') ?>
        <!-- end-common_menu -->
        <?= $content ?>
        <!-- common_footer -->
        <?= $this->render('common_footer') ?>
        <!-- end-common_footer -->
        <?php $this->endBody() ?>
        <script type="text/javascript">
            // This function is called from the pop-up menus to transfer to
            // a different page. Ignore if the value returned is a null string:
            function goPage(newURL) {

                // if url is empty, skip the menu dividers and reset the menu selection to default
                if (newURL != "") {

                    // if url is "-", it is this page -- reset the menu:
                    if (newURL == "-") {
                        resetMenu();
                    }
                    // else, send page to designated URL            
                    else {
                        document.location.href = newURL;
                    }
                }
            }

            // resets the menu selection upon entry to this page:
            function resetMenu() {
                document.gomenu.selector.selectedIndex = 2;
            }
        </script>
    </body>

</html>
<?php $this->endPage() ?>