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
		$setting = Settings::where('name', $name)->get();

		if($setting->count() > 0)
		{
			return $setting[0]->value;
		}
		else
		{
			return 0;
		}
	}

}