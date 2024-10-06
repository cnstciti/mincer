<?php declare(strict_types=1);

use diecoding\slick\SlickCarousel;
use yii\web\View;

/**
 * @var View $this
 * @var string $catalogName
 * @var string $entityName
 * @var int $catalogId
 * @var array $pictures
 * @var array $simpleTypes
 * @var array $setTypes
 */

$descriptionId = 2;

$title = "Продукт '{$entityName}'. Демонстрация";
$this->title = Yii::$app->name . ' :: ' . $title;

$this->params['breadcrumbs'][] = [
    'label' => 'Каталоги',
    'url'   => ['/domains/catalog/default/index'],
];
$this->params['breadcrumbs'][] = [
    'label' => $catalogName . '. Продукты',
    'url'   => ['/domains/entity/default/index', 'catalogId' => $catalogId],
];
$this->params['breadcrumbs'][] = $title;

$storageImg = Yii::getAlias('@storageWebMincerImg');
?>
<h1><?= $entityName ?></h1>
<div class="row">
    <div class="col-6">

        <?
            $items = [];
            foreach ($pictures as $picture) {
                $src = $storageImg . '/' . $picture['file'];
                $items[] = '<div><img
                        src="' . $src . '"
                        alt=""
                        height="400"
                    /></div>';
            }
            
            if (!empty($items)) {
                try {
                    echo SlickCarousel::widget([
                        'items'            => $items,
                        'containerOptions' => ['class' => 'slider-for'],
                        // (array) HTML attributes to render on the container
                        'containerTag'     => 'div',
                        // (string) HTML tag to render the container
                        'itemOptions'      => [],
                        // (array) HTML attributes for the one item
                        'itemTag'          => 'div',
                        // (string) HTML tag to render items for the carousel
                        'skipCoreAssets'   => false,
                        // (bool) default `false`, `true` if use custom or external slick assets
                        'pluginOptions'    => [        // (array) default `[]`, for option `$(#options['id']).slick(pluginOptions);`
                            // @see https://github.com/kenwheeler/slick/#settings
                
                            // 'accessibility'    => true,                                                         // boolean, default `true`
                            // 'adaptiveHeight'   => false,                                                        // boolean, default `false`
                            // 'appendArrows'     => $(element),                                                   // string, default `$(element)`
                            // 'appendDots'       => $(element),                                                   // string, default `$(element)`
                            'arrows'         => false,
                            // boolean, default `true`
                            'asNavFor'       => '.slider-nav',
                            // string, default `$(element)`
                            // 'autoplay'         => false,                                                        // boolean, default `false`
                            // 'autoplaySpeed'    => 3000,                                                         // int, default `3000`
                            // 'centerMode'       => true,                                                        // boolean, default `false`
                            // 'centerPadding'    => '50px',                                                       // string, default `'50px'`
                            // 'cssEase'          => 'ease',                                                       // string, default `'ease'`
                            // 'customPaging'     => n/a,                                                          // function, default `n/a`
                            // 'dots'             => false,                                                        // boolean, default `false`
                            // 'dotsClass'        => 'slick-dots',                                                 // string, default `'slick-dots'`
                            // 'draggable'        => true,                                                         // boolean, default `true`
                            // 'easing'           => 'linear',                                                     // string, default `'linear'`
                            // 'edgeFriction'     => 0.15,                                                         // integer, default `0.15`
                            'fade'           => true,
                            // boolean, default `false`
                            // 'focusOnSelect'    => false,                                                        // boolean, default `false`
                            // 'focusOnChange'    => false,                                                        // boolean, default `false`
                            // 'infinite'         => true,                                                         // boolean, default `true`
                            // 'initialSlide'     => 0,                                                            // integer, default `0`
                            // 'lazyLoad'         => 'ondemand',                                                   // string, default `'ondemand'`
                            // 'mobileFirst'      => false,                                                        // boolean, default `false`
                            // 'nextArrow'        => <button type="button" class="slick-next">next</button>,       // string (html | jQuery selector) | object (DOM node | jQuery object), default `<button type="button" class="slick-next">next</button>`
                            // 'pauseOnDotsHover' => false,                                                        // boolean, default `false`
                            // 'pauseOnFocus'     => true,                                                         // boolean, default `true`
                            // 'pauseOnHover'     => true,                                                         // boolean, default `true`
                            // 'prevArrow'        => <button type="button" class="slick-prev">previous</button>,   // string (html | jQuery selector) | object (DOM node | jQuery object), default `<button type="button" class="slick-prev">previous</button>`
                            // 'respondTo'        => 'window',                                                     // string, default `'window'`
                            // 'responsive'       => null,                                                         // array, default `null`
                            // 'rows'             => 1,                                                            // int, default `1`
                            // 'rtl'              => false,                                                        // boolean, default `false`
                            // 'slide'            => '',                                                           // string, default `''`
                            // 'slidesPerRow'     => 1,                                                            // int, default `1`
                            'slidesToScroll' => 1,
                            // int, default `1`
                            'slidesToShow'   => 1,
                            // int, default `1`
                            // 'speed'            => 300,                                                          // int, default `300`
                            // 'swipe'            => true,                                                         // boolean, default `true`
                            // 'swipeToSlide'     => false,                                                        // boolean, default `false`
                            // 'touchMove'        => true,                                                         // boolean, default `true`
                            // 'touchThreshold'   => 5,                                                            // int, default `5`
                            // 'useCSS'           => true,                                                         // boolean, default `true`
                            // 'useTransform'     => true,                                                         // boolean, default `true`
                            // 'variableWidth'    => false,                                                        // boolean, default `false`
                            // 'vertical'         => false,                                                        // boolean, default `false`
                            // 'verticalSwiping'  => false,                                                        // boolean, default `false`
                            // 'waitForAnimate'   => true,                                                         // boolean, default `true`
                            // 'zIndex'           => 1000,                                                         // number, default `1000`
                        ],
                        'pluginEvents'     => [ // array default `[]`, JQuery events
                            // @see https://github.com/kenwheeler/slick/#events
                
                            // 'afterChange' => 'function(event, slick, currentSlide) {
                            //     console.log("After slide change callback");
                            // }',
                            // 'beforeChange' => 'function(event, slick, currentSlide, nextSlide) {
                            //     console.log("Before slide change callback");
                            // }',
                            // 'breakpoint' => 'function(event, slick, breakpoint) {
                            //     console.log("Fires after a breakpoint is hit");
                            // }',
                            // 'destroy' => 'function(event, slick) {
                            //     console.log("When slider is destroyed, or unslicked.");
                            // }',
                            // 'edge' => 'function(event, slick, direction) {
                            //     console.log("Fires when an edge is overscrolled in non-infinite mode.");
                            // }',
                            // 'init' => 'function(event, slick) {
                            //     console.log("When Slick initializes for the first time callback. Note that this event should be defined before initializing the slider.");
                            // }',
                            // 'reInit' => 'function(event, slick) {
                            //     console.log("Every time Slick (re-)initializes callback");
                            // }',
                            // 'setPosition' => 'function(event, slick) {
                            //     console.log("Every time Slick recalculates position");
                            // }',
                            // 'swipe' => 'function(event, slick, direction) {
                            //     console.log("Fires after swipe/drag");
                            // }',
                            // 'lazyLoaded' => 'function(event, slick, image, imageSource) {
                            //     console.log("Fires after image loads lazily");
                            // }',
                            // 'lazyLoadError' => 'function(event, slick, image, imageSource) {
                            //     console.log("Fires after image fails to load");
                            // }',
                        ],
                    ]);
                } catch(Throwable $e) {
                    throw new Exception('Ошибка при создании SlickCarousel. ' . $e->getMessage());
                }
    
                $items = [];
                foreach ($pictures as $picture) {
                    $src     = $storageImg . '/' . $picture['file'];
                    $items[] = '<div><img
                        src="' . $src . '"
                        alt=""
                        height="80"
                    /></div>';
                }

                if (!empty($items)) {
                    try {
                        echo SlickCarousel::widget([
                            'items'            => $items,
                            'containerOptions' => ['class' => 'slider-nav'],
                            'containerTag'     => 'div',
                            'itemOptions'      => [],
                            'itemTag'          => 'div',
                            'skipCoreAssets'   => false,
                            'pluginOptions'    => [
                                'asNavFor'       => '.slider-for',
                                'centerMode'     => true,
                                'dots'           => true,
                                'focusOnSelect'  => true,
                                'slidesToScroll' => 1,
                                'slidesToShow'   => 4,
                            ],
                            'pluginEvents'     => [],
                        ]);
                    } catch(Throwable $e) {
                        throw new Exception('Ошибка при создании SlickCarousel. ' . $e->getMessage());
                    }
                }
            }
        ?>

    </div>
    <div class="col-6">
        <h2>Характеристики</h2>
        <?
            foreach ($simpleTypes as $simpleType) {
                if ($descriptionId !== $simpleType['attributeId']) {
                    $prompt = sprintf(
                        '%s%s:',
                        $simpleType['attributeName'],
                        $simpleType['unitName'] ? ', ' . $simpleType['unitName'] : ''
                    );
                    if ($value = $simpleType['value']) {
                        ?>
                        <div class="row">
                            <div class="col-5">
                                <?= $prompt ?>
                            </div>
                            <div class="col-auto">
                                <?= $value ?>
                            </div>
                        </div>
                        <?
                    }
                }
            }
            
            foreach ($setTypes as $setType) {
                $prompt = sprintf(
                    '%s%s:',
                    $setType['attributeName'],
                    $setType['unitName'] ? ', ' . $setType['unitName'] : ''
                );
                if ($value = $setType['value']) {
                    ?>
                    <div class="row">
                        <div class="col-5">
                            <?= $prompt ?>
                        </div>
                        <div class="col-auto">
                            <?= $value ?>
                        </div>
                    </div>
                    <?
                }
            }
        ?>
    </div>
</div>
<div class="row">
    <div class="col-11">
        <h2>Описание</h2>
        <?
            foreach ($simpleTypes as $simpleType) {
                if ($descriptionId == $simpleType['attributeId']) {
                    echo $simpleType['value'] ?? 'НЕТ ОПИСАНИЯ!!!';
                }
            }
        ?>
    </div>
</div>
