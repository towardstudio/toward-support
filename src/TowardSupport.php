<?php
namespace towardstudio\towardsupport;

use Craft;
use craft\base\Element;
use craft\base\Model;
use craft\base\Plugin;
use craft\events\RegisterComponentTypesEvent;
use craft\events\RegisterTemplateRootsEvent;
use craft\events\RegisterUrlRulesEvent;
use craft\events\PluginEvent;
use craft\helpers\UrlHelper;
use craft\services\Plugins;
use craft\services\Dashboard;
use craft\web\UrlManager;
use craft\web\View;

use towardstudio\towardsupport\models\Settings;
use towardstudio\towardsupport\widgets\SupportWidget;
use towardstudio\towardsupport\widgets\NewsWidget;

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
	public bool $hasCpSettings = true;
	public static ?Settings $settings;

    // Public Methods
    // =========================================================================

    public function init()
    {
        parent::init();
        self::$plugin = $this;
		self::$settings = $this->getSettings();

        // Set Components
        $this->setComponents([
            "widgets" => WidgetService::class,
        ]);

        // Register our widgets
        $this->_registerWidgets();

        // Handler: EVENT_AFTER_INSTALL_PLUGIN
        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                    // Send them to our settings screen
                    $request = Craft::$app->getRequest();
                    if ($request->isCpRequest) {
                        Craft::$app->getResponse()->redirect(UrlHelper::cpUrl('settings/plugins/toward-support'))->send();
                    }
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

	// Protected Methods
	// =========================================================================

	/**
	 * @inheritdoc
	 */
	protected function createSettingsModel(): ?Model
	{
		return new Settings();
	}

	protected function settingsHtml(): string
	{
		return Craft::$app
			->getView()
			->renderTemplate("toward-support/settings", [
				"settings" => $this->getSettings(),
			]);
	}
}
