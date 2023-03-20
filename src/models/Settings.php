<?php
namespace towardstudio\towardsupport\models;

use Craft;
use craft\base\Model;

class Settings extends Model
{
	// Public Properties
	// =========================================================================

	/**
	 * @var string
	 */

	public $name = "Toward Support";
	public $accountManager;
	public $companyInfo = "We're in the studio 8:30 - 17:00 Monday to Friday. We aim to get back to you within 24 hours.";
	public $supportUrl;

	// Public Methods
	// =========================================================================

	/**
	 * @inheritdoc
	 */
	public function rules(): array
	{
		return [
			[['accountManager', 'companyInfo', 'supportUrl'], 'required'],
			[['accountManager', 'companyInfo', 'supportUrl'], 'string'],
		];
	}
}
