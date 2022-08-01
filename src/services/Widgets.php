<?php

namespace toward\towardsupport\services;

use Craft;
use yii\base\Component;

use toward\towardsupport\widgets\SupportWidget;
use toward\towardsupport\widgets\NewsWidget;

class Widgets extends Component
{
    public function createWidgets()
    {
        $dashboard = Craft::$app->dashboard;

        $dashboard->saveWidget($dashboard->createWidget(SupportWidget::class));
        $dashboard->saveWidget($dashboard->createWidget(NewsWidget::class));
    }

    public function removeOldWidgets()
    {
        $dashboard = Craft::$app->dashboard;
        $widgets = $dashboard->getAllWidgets();

        $oldWidgets = [
            "craft\widgets\CraftSupport",
            "craft\widgets\Updates",
            "craft\widgets\MissingWidget",
            "craft\widgets\Feed",
        ];

        foreach ($widgets as $widget) {
            $widgetClass = get_class($widget);

            if (in_array($widgetClass, $oldWidgets)) {
                $dashboard->deleteWidget($widget);
            }
        }
    }
}
