<?php

namespace App\Repositories\Settings;

use App\Models\Types\Type;
use Illuminate\Database\Eloquent\Collection;

class TypeRepository
{
    /**
     * @param int $id
     * @return Type|null
     */
    public function find(int $id): ?Type
    {
        return Type::find($id);
    }

    /**
     * @param array $filters
     * @return Collection|array
     */
    public function findBy(array $filters): Collection|array
    {
        $data = Type::orderBy('id', 'DESC');

        if (isset($filters['resource_type']) && !empty($filters['resource_type'])) {
            $data->where('resource_type', $filters['resource_type']);
        }

        return $data->get();
    }

    /**
     * @param array $filters
     * @return Type|null
     */
    public function findByOne(array $filters): ?Type
    {
        return Type::where($filters)->first();
    }
}
