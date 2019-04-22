<div class="row checkbox">

    <div class="col-xs-12">
        <div class="content-cat" style="max-height:490px;overflow-y: auto;">
            @if(count($features)>0)
                @php
                    if(isset($vehicle->features) && count($vehicle->features)>0){
                    $oldCat = array();
                        foreach ($vehicle->features as $cat){
                                   array_push($oldCat,$cat->id);
                               }

                           }else{
                           $oldCat=old('features');
                           }
                @endphp


                @foreach ($features->groupBy('type') as $index=>$featuresByType)


                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <label>{{$typeFeature->get($index)}}</label>
                            </div>
                            <div class="box-body">
                                <ul class="checkbox" style="list-style: none;padding-left: 5px;">
                                    @foreach ($featuresByType as $index=>$features)
                                        <li style="padding-top: 5px">
                                            <label>
                                                <input type="checkbox" class="flat-blue jsInherit" name="features[]"

                                                       value="{{$features->id}}"
                                                       @isset($oldCat) @if(in_array($features->id, $oldCat)) checked="checked" @endif @endisset> {{$features->name}}
                                            </label>
                                            @if(count($features->children)>0)
                                                @php
                                                    $children=$features->children
                                                @endphp
                                                @include('ivehicles::admin.fields.checklist.related.children',['children'=>$features])
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>


                @endforeach


            @endif

        </div>
    </div>

</div>