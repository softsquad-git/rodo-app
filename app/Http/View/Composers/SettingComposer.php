<?php

namespace App\Http\View\Composers;

use App\Models\Settings\Setting;
use App\Repositories\Settings\SettingRepository;
use Illuminate\View\View;

class SettingComposer
{
    /**
     * @param SettingRepository $settingRepository
     */
    public function __construct(
        private SettingRepository $settingRepository,
    )
    {}

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $settings = $this->settingRepository->findAll();
        $data = [];
        foreach ($settings as $setting) {
            /**
             * @var Setting $setting
             */
            $data[$setting->name] = $setting->getValue();
        }

        $view->with('setting', $data);
    }
}
