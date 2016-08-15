<?php

namespace CodeDelivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Repositories\CupomRepositoryRepository;
use CodeDelivery\Models\CupomRepository;
use CodeDelivery\Validators\CupomRepositoryValidator;

/**
 * Class CupomRepositoryRepositoryEloquent
 * @package namespace CodeDelivery\Repositories;
 */
class CupomRepositoryRepositoryEloquent extends BaseRepository implements CupomRepositoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CupomRepository::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
