<?php

namespace App\Traits;

use App\Models\Settings\Setting;
use App\Repositories\Settings\SettingRepository;
use Illuminate\Support\Str;

trait GenerateNumber
{
    /**
     * @param int $lengthGenerateNumber
     * @return array|string
     */
    public function generateRandomNumber(int $lengthGenerateNumber = 5): array|string
    {
        $settingRepository = new SettingRepository();
        $patternItem = $settingRepository->findByOne(['name' => Setting::$names['number_pattern']]);
        if (!$patternItem) {
            return Str::random(3);
        }

        $pattern = $patternItem->value;

        $generateNumber = strtoupper(Str::random($lengthGenerateNumber));

        return str_replace('[NUMBER]', $generateNumber, $pattern);
    }
}
