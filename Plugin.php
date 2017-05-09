<?php namespace VojtaSvoboda\BugSnag;

use Backend;
use Bugsnag_Client;
use Event;
use Log;
use MeadSteve\MonoSnag\BugsnagHandler;
use System\Classes\PluginBase;
use VojtaSvoboda\ErrorLogger\Models\Settings;

class Plugin extends PluginBase
{
    public $require = [
        'VojtaSvoboda.ErrorLogger',
    ];

    public function pluginDetails()
    {
        return [
            'name' => 'vojtasvoboda.bugsnag::lang.plugin.name',
            'description' => 'vojtasvoboda.bugsnag::lang.plugin.description',
            'author' => 'Vojta Svoboda',
            'icon' => 'icon-bug',
        ];
    }

    public function boot()
    {
        // register Bugsnag handler
        $monolog = Log::getMonolog();
        $this->setBugsnagHandler($monolog);

        // extend ErrorLogger settings form
        Event::listen('backend.form.extendFields', function($widget) {
            if (!$widget->model instanceof Settings) {
                return;
            }

            $widget->addTabFields([
                'bugsnag_enabled' => [
                    'tab' => 'vojtasvoboda.bugsnag::lang.tab.name',
                    'label' => 'vojtasvoboda.bugsnag::lang.fields.bugsnag_enabled.label',
                    'type' => 'switch',
                ],
                'bugsnag_api_key' => [
                    'tab' => 'vojtasvoboda.bugsnag::lang.tab.name',
                    'label' => 'vojtasvoboda.bugsnag::lang.fields.bugsnag_api_key.label',
                    'comment' => 'vojtasvoboda.bugsnag::lang.fields.bugsnag_api_key.comment',
                    'required' => true,
                    'trigger' => [
                        'action' => 'show',
                        'field' => 'bugsnag_enabled',
                        'condition' => 'checked',
                    ],
                ],
            ]);
        });
    }

    /**
     * Set Bugsnag handler.
     *
     * @param $monolog
     *
     * @return mixed
     */
    protected function setBugsnagHandler($monolog)
    {
        $required = ['bugsnag_enabled', 'bugsnag_api_key'];
        if (!$this->checkRequiredFields($required)) {
            return $monolog;
        }

        $api_key = Settings::get('bugsnag_api_key');
        $client = new Bugsnag_Client($api_key);
        $monolog->pushHandler(new BugsnagHandler($client));
    }

    /**
     * Check handler required fields.
     *
     * @param array $fields
     *
     * @return bool
     */
    private function checkRequiredFields(array $fields)
    {
        foreach ($fields as $field) {
            $value = Settings::get($field);
            if (!$value || empty($value)) {
                return false;
            }
        }

        return true;
    }
}
