<?php

namespace Laraflow\TripleA\Repositories\Eloquent\Auth;

use Laraflow\Core\Abstracts\Repository\EloquentRepository;
use Laraflow\TripleA\Services\Auth\AuthenticatedSessionService;

/**
 * Class UserRepository
 * @package Laraflow\TripleA\Repositories\Eloquent\Auth
 */
class UserRepository extends EloquentRepository
{
    /**
     * UserRepository constructor.
     * @param null $model
     */
    public function __construct($model = null)
    {
        /**
         * Set the model that will be used for repo
         */
        $model = $model ?? config('triplea.auth.model');

        parent::__construct($model);
    }

    public function filter(array $conditions = [])
    {
        $query = $this->getQueryBuilder();

        if (isset($filters['search']) && ! empty($filters['search'])) :
            $query->where('name', 'like', "%{$filters['search']}%")
                ->orWhere('username', 'like', "%{$filters['search']}%")
                ->orWhere('email', '=', "%{$filters['search']}%")
                ->orWhere('mobile', '=', "%{$filters['search']}%")
                ->orWhere('enabled', '=', "%{$filters['search']}%");
        endif;

        if (isset($filters['enabled']) && ! empty($filters['enabled'])) :
            $query->where('enabled', '=', $filters['enabled']);
        endif;

        if (isset($filters['parent_id']) && ! empty($filters['parent_id'])) :
            $query->where('parent_id', '=', $filters['parent_id']);
        endif;

        if (isset($filters['sort']) && ! empty($filters['direction'])) :
            $query->orderBy($filters['sort'], $filters['direction']);
        endif;

        //Role may be int, string, array
        if (isset($filters['role']) && ! empty($filters['role'])) :
            $query->whereHas('roles', function ($subQuery) use ($filters) {
                if (! is_array($filters['role'])):
                    $filters['role'][] = $filters['role'];
                endif;

                $firstRole = array_shift($filters['role']);
                $subQuery->where('id', '=', $firstRole);

                if (! empty($filters['role'])) :
                    foreach ($filters['role'] as $role):
                        $subQuery->orWhere('id', '=', $role);
                endforeach;
                endif;
            });
        endif;

        if (AuthenticatedSessionService::isSuperAdmin()) :
            $query->withTrashed();
        endif;


        return $query;
    }
}
