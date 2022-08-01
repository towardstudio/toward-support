<?php
namespace toward\towardsupport;

use Craft;
use craft\base\Element;
use craft\base\Plugin;
use craft\events\RegisterComponentTypesEvent;
use craft\events\RegisterTemplateRootsEvent;
use craft\events\RegisterUrlRulesEvent;
use craft\events\PluginEvent;
use craft\services\Plugins;
use craft\services\Dashboard;
use craft\web\UrlManager;
use craft\web\View;

use toward\towardsupport\services\Widgets as WidgetService;
use toward\towardsupport\widgets\SupportWidget;
use toward\towardsupport\widgets\NewsWidget;

use yii\base\Event;

/**
 * @author    Toward
 * @package   JobViews
 * @since     1.0.0
 *
 */
class TowardSupport extends Plugin
{
    public static $plugin;

    // Public Methods
    // =========================================================================

    public function init()
    {
        parent::init();
        self::$plugin = $this;

        // Set Components
        $this->setComponents([
            "widgets" => WidgetService::class,
        ]);

        // Register our widgets
        $this->_registerWidgets();

        // Register our CP routes
        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_CP_URL_RULES,
            function (RegisterUrlRulesEvent $event) {
                $event->rules["cpActionTrigger1"] =
                    "jobs-module/default/do-something";
            }
        );

        // Handler: EVENT_AFTER_INSTALL_PLUGIN
        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                    // Remove old Widgets
                    $this->widgets->removeOldWidgets();

                    // Add our widget
                    $this->widgets->createWidgets();
                }
            }
        );

        Craft::info(
            Craft::t("toward-support", "{name} plugin loaded", [
                "name" => $this->name,
            ]),
            __METHOD__
        );
    }

    // Private Methods
    // =========================================================================

    private function _registerWidgets()
    {
        Event::on(
            Dashboard::class,
            Dashboard::EVENT_REGISTER_WIDGET_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = SupportWidget::class;
                $event->types[] = NewsWidget::class;
            }
        );
    }
}
