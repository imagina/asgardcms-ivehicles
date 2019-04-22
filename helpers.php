<?php

if(!function_exists('get_vehicles')){

    function get_vehicles($options=array()){
        $vehicles= app('Modules\Ivehicles\Repositories\VehicleRepository');
        $default_options = array(
            'brands' => null,
            'fuel' => null, //
            'price' => array(),//['min'=>1000, 'max'=>100000]
            'owner' => array(),// place, categorias o usuarios, que desee excluir de una consulta metodo de llmado tour=>'', places=>'' , users=>''
            'take' => 5, //Numero de places a obtener,
            'skip' => 0, //Omitir Cuantos place a llamar
            'order' => array(),//['field'=>'created_at', 'way'=>'des']
            'status' => 1
        );

        $options = array_merge($default_options, $options);

        $params =(object)['filter'=>$options, 'includes'=>array(), 'page'=>null,'take'=>$options['take']];

        return $vehicles->getItemsBy($params);


    }



}
