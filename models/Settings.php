<?php namespace ToughDeveloper\ImageResizer\Models;

use Model;

/**
 * Settings Model
 */
class Settings extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'toughdeveloper_imageresizer_settings';

    public $settingsFields = 'fields.yaml';

    protected $casts = [
        'default_offset_x' => 'integer',
        'default_offset_y' => 'integer',
        'default_quality'  => 'integer',
        'default_sharpen'  => 'integer',
    ];

    public $rules = [
        'default_quality'   => 'integer|between:0,100',
        'default_sharpen'   => 'integer|between:0,100',
    ];
}
