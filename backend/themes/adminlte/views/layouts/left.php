<?php
 use yii\helpers\Html;
 use common\lib\helpers\App;
 use backend\lib\extensions\mdmsoft\admin\components\MenuHelper;

  $identity = App::getIdentity(true);
    $nickname =  Html::encode($identity->userProfile->nickname);
    $create_time = Yii::$app->formatter->asDate($identity->create_time);
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $identity->userProfile->getAvatar($directoryAsset.'/img/avatar.png') ?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?=$nickname?></p>

                <a href="javascript:;"><i class="fa fa-circle text-success"></i> <?=$create_time?></a>
            </div>
        </div>

        <!-- search form -->
<!--        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>-->
        <!-- /.search form -->

        <?php 
        $navActive = isset($this->params['navActive']) ? $this->params['navActive'] : null;
        $callback = function($menu) use ($navActive){
            $data = eval($menu['data']);
            $active = $navActive && $navActive == $menu['route'] ? true : false;
            $callbackItem = [
                'label' => $menu['label'], 
                'icon' => 'fa fa-'.$menu['icon'],
                'url' => [$menu['route']],
                'options' => $data ? $data : [],
                //'active' => $active,
                'items' => $menu['children']
            ];
            if($active){
                $callbackItem['active'] = true;
            }
            return $callbackItem;
        };
        echo dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id, null, $callback),
//                'items' => [
//                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
//                    ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']],
//                    ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug']],
//                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
//                    [
//                        'label' => 'Same tools',
//                        'icon' => 'fa fa-share',
//                        'url' => '#',
//                        'items' => [
//                            ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii'],],
//                            ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
//                            [
//                                'label' => 'Level One',
//                                'icon' => 'fa fa-circle-o',
//                                'url' => '#',
//                                'items' => [
//                                    ['label' => 'Level Two', 'icon' => 'fa fa-circle-o', 'url' => '#',],
//                                    [
//                                        'label' => 'Level Two',
//                                        'icon' => 'fa fa-circle-o',
//                                        'url' => '#',
//                                        'items' => [
//                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
//                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
//                                        ],
//                                    ],
//                                ],
//                            ],
//                        ],
//                    ],
//                ],
            ]
        ) ?>

    </section>

</aside>
