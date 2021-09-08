<?php

namespace App\Services\Settings;

use App\Models\Types\Type;

class TypeService
{
    /**
     * @param array $data
     * @param Type|null $type
     * @return Type
     */
    public function save(array $data, Type $type = null): Type
    {
        if ($type) {
            $type->update($data);

            return $type;
        }

        return Type::create($data);
    }

    /**
     * @param Type $type
     * @return bool|null
     */
    public function remove(Type $type): ?bool
    {
        return $type->delete();
    }
}
