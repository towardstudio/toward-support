<?php
namespace toward\towardsupport\models;

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
	public $supportUrl;

	// Public Methods
	// =========================================================================

	/**
	 * @inheritdoc
	 */
	public function rules(): array
	{
		return [
			["accountManager", "string"],
			["supportUrl", "string"],
		];
	}
}
