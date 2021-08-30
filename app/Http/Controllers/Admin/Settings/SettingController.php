<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Resources\SettingsResource;
use App\Repositories\Settings\SettingRepository;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use \Illuminate\Contracts\View\View;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\Foundation\Application;

class SettingController extends Controller
{
    public function __construct(
        private SettingRepository $settingRepository
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('admin.settings.index', [
            'title' => __('admin.settings.title')
        ]);
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function getSettingsList(): AnonymousResourceCollection
    {
        $settings = $this->settingRepository->findAll();

        return SettingsResource::collection($settings);
    }
}
