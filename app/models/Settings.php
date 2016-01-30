<?php

class Settings extends Eloquent {
    
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'settings';

	public static function getSettingValue($name)
	{
		$setting = Settings::where('name', $name)->get()->first();

		if(!empty($setting))
		{
			return $setting->value;
		}
		else
		{
			return false;
		}
	}

}