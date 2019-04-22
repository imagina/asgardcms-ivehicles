<?php


namespace Modules\Ivehicles\Presenters;

use Laracasts\Presenter\Presenter;
use Modules\Ivehicles\Entities\TypeFeature;

class FeaturePresenter extends Presenter
{
    protected $type;


    public function __construct($entity)
    {
        parent::__construct($entity);
        $this->type = app('Modules\Ivehicles\Entities\TypeFeature');
    }

    public function type()
    {
        return $this->type->get($this->entity->type);
    }
    /**
     * Getting the label class for the appropriate type
     * @return string
     */
    public function typeLabelClass()
    {
        switch ($this->entity->type) {
            case TypeFeature::INSIDE:
                return 'red';
                break;
            case TypeFeature::OUTSIDE:
                return 'green';
                break;
            default:
                return 'orange';
                break;
        }
    }

}