<?php

namespace Modules\Ivehicles\Entities;


class Fuel
{

    const PETROL = 0;
    const GAS = 1;
    const ELECTRIC = 2;
    const HYBRID =3;


    /**
     * @var array
     */
    private $fuels = [];

    public function __construct()
    {
        $this->fuels = [
            self::PETROL => trans('ivehicles::fuels.petrol'),
            self::GAS  => trans('ivehicles::fuels.gas'),
            self::ELECTRIC => trans('ivehicles::fuels.electric'),
            self::HYBRID => trans('ivehicles::fuels.hybrid'),
        ];
    }

    /**
     * Get the available fuelses
     * @return array
     */
    /*listar*/
    public function lists()
    {
        return $this->fuels;
    }

    /**
     * Get the post fuels
     * @param int $fuel_id
     * @return string
     */
    public function get($fuel_id)
    {
        if (isset($this->fuels[$fuel_id])) {
            return $this->fuels[$fuel_id];
        }

        return $this->fuels[self::PETROL];
    }
}