<?php


namespace Modules\Ivehicles\Entities;


class TypeFeature
{
    const INSIDE = 0;
    const EQUIPMENT = 1;
    const OUTSIDE = 2;


    /**
     * @var array
     */
    private $types = [];

    public function __construct()
    {
        $this->types = [
            self::INSIDE => trans('ivehicles::type_features.inside'),
            self::EQUIPMENT => trans('ivehicles::type_features.equipment'),
            self::OUTSIDE => trans('ivehicles::type_features.outside'),
        ];
    }

    /**
     * Get the available type_featurees
     * @return array
     */
    /*listar*/
    public function lists()
    {
        return $this->types;
    }

    /**
     * Get the post type_feature
     * @param int $type_id
     * @return string
     */
    public function get($type_id)
    {
        if (isset($this->types[$type_id])) {
            return $this->types[$type_id];
        }

        return $this->tyope[self::INSIDE];
    }

}