<?php


namespace Modules\Ivehicles\Entities;


class Transmission
{
    const MANUAL = 0;
    const AUTOMATIC = 1;


    /**
     * @var array
     */
    private $transmissions = [];

    public function __construct()
    {
        $this->transmissions = [
            self::MANUAL => trans('ivehicles::transmissions.manual'),
            self::AUTOMATIC => trans('ivehicles::transmissions.automatic'),

        ];
    }

    /**
     * Get the available transmissions
     * @return array
     */
    /*listar*/
    public function lists()
    {
        return $this->transmissions;
    }

    /**
     * Get the post status
     * @param int transmissionId
     * @return string
     */
    public function get($transmissionId)
    {
        if (isset($this->transmissions[$transmissionId])) {
            return $this->transmissions[$transmissionId];
        }

        return $this->transmissions[self::MANUAL];
    }
}