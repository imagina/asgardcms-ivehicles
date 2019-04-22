<?php

namespace Modules\Ivehicles\Presenters;

use Laracasts\Presenter\Presenter;
use Modules\Ivehicles\Entities\Status;

class VehiclePresenter extends Presenter
{

    protected $status;
    protected $fuel;
    protected $transmission;

    public function __construct($entity)
    {
        parent::__construct($entity);
        $this->status = app('Modules\Ivehicles\Entities\Status');
        $this->fuel = app('Modules\Ivehicles\Entities\Fuel');
        $this->transmission=app('Modules\Ivehicles\Entities\Transmission');
    }

    public function status()
    {
        return $this->status->get($this->entity->status);
    }

    public function transmission()
    {
        return $this->transmission->get($this->entity->transmission);
    }
    public function fuel()
    {
    return $this->fuel->get($this->entity->fuel);
}

    public function views()
    {
        if (function_exists('viewCount')) {
            return viewCount('vehicles', $this->entity->id);
        }
        return 0;
    }


    public function sendViewWrapper()
    {
        return PHP_EOL . '<script>
  var URLdomain ='.url('/').'
        var id= '.$this->entity->id.'
    $(document).ready(function(){
        function sendVisit(id){
            var data = {"attributes":{"entity":"vehicles","entity_id":id}}

            $.post(URLdomain + \'/api/counts\',data).done(function(response){
                
            })
            .fail(function(error){
                console.log(error);
            })
            .always(function(data) {
                console.log(\'send\')
            });
        }
         setTimeout(function() {
                    sendVisit(id);
                },10000); 
        });
                  
            
            </script>'. PHP_EOL;
    }

    /**
     * Getting the label class for the appropriate status
     * @return string
     */
    public function statusLabelClass()
    {
        switch ($this->entity->status) {
            case Status::INACTIVE:
                return 'red';
                break;
            case Status::ACTIVE:
                return 'green';
                break;
            default:
                return 'orange';
                break;
        }
    }


}