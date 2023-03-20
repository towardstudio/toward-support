<?php
namespace towardstudio\towardsupport\widgets;

use towardstudio\towardsupport\TowardSupport;

use Craft;
use craft\base\Widget;

use yii\base\Component;

class SupportWidget extends Widget
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t("toward-support", "Toward Support");
    }

    public function getTitle(): string
    {
        return Craft::t("toward-support", "Toward Support");
    }

    public function getBodyHtml(): string
    {
		$settings = TowardSupport::$plugin->getSettings();

        return Craft::$app
            ->getView()
            ->renderTemplate(
                "toward-support/_components/widgets/SupportWidget/body",
                [
                    "manager" => $settings->accountManager,
                    "info" => $settings->companyInfo,
                    "url" => $settings->supportUrl,
                ]
            );
    }
}
