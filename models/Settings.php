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

    public $customMessages = [
       'valid_tinypng_key' => 'The tinypng key entered could not be validated, please check the key and try again.'
    ];

    protected $casts = [
        'default_offset_x' => 'integer',
        'default_offset_y' => 'integer',
        'default_quality'  => 'integer',
        'default_sharpen'  => 'integer'
    ];

    public $rules = [
        'default_quality'           => 'integer|between:0,100',
        'default_sharpen'           => 'integer|between:0,100',
        'tinypng_developer_key'     => 'required_if:enable_tinypng,1'
    ];

    public function beforeValidate()
    {
        if ($this->enable_tinypng == 1) {
            $this->rules['tinypng_developer_key'] .= '|valid_tinypng_key';
        }
    }

    // Default setting data
    public function initSettingsData()
    {
        $this->default_extension = 'auto';
        $this->default_mode = 'auto';
        $this->default_offset_x = 0;
        $this->default_offset_y = 0;
        $this->default_quality = 95;
        $this->default_sharpen = 0;
    }
}
