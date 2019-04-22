<?php

namespace Modules\Ivehicles\Presenters;

use Laracasts\Presenter\Presenter;
use Modules\Ivehicles\Entities\Status;

class BrandPresenter extends Presenter
{
    /**
     * @var \Modules\Ivehicles\Entities\Status
     */
    protected $status;
    /**
     * @var \Modules\Ivehicles\Repositories\BrandRepository
     */
    private $brand;

    public function __construct($entity)
    {
        parent::__construct($entity);
        $this->brand = app('Modules\Ivehicles\Repositories\BrandRepository');
        $this->status = app('Modules\Ivehicles\Entities\Status');
    }

    /**
     * Get the post status
     * @return string
     */
    public function status()
    {
        return $this->status->get($this->entity->status);
    }

    /**
     * Getting the label class for the appropriate status
     * @return string
     */
    public function statusLabelClass()
    {
        switch ($this->entity->status) {
            case Status::INACTIVE:
                return 'bg-red';
                break;

            case Status::ACTIVE:
                return 'bg-green';
                break;

            default:
                return 'bg-red';
                break;
        }
    }
}
