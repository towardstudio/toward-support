<?php
namespace toward\towardsupport\widgets;

use toward\towardsupport\TowardSupport;

use Craft;
use craft\base\Widget;

use yii\base\Component;

class SupportWidget extends Widget
{
    // Public Properties
    // =========================================================================

    public $accountManager;
    public $projectManagementUrl;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t("app", "Toward Support");
    }

    public function getTitle(): string
    {
        return Craft::t("app", "Toward Support");
    }

    /**
     * @inheritdoc
     */
    public function getSettingsHtml()
    {
        return Craft::$app
            ->getView()
            ->renderTemplate(
                "toward-support/_components/widgets/SupportWidget/settings",
                [
                    "widget" => $this,
                ]
            );
    }

    public function getBodyHtml(): string
    {
        return Craft::$app
            ->getView()
            ->renderTemplate(
                "toward-support/_components/widgets/SupportWidget/body",
                [
                    "manager" => $this->accountManager,
                    "url" => $this->projectManagementUrl,
                ]
            );
    }
}
