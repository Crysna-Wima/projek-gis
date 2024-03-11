<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <i class="{{$parent_icon}} mx-2"></i>
        <span key="t-ui-elements">{{$parent}}</span>
    </a>
    <ul class="sub-menu" aria-expanded="false">
        @foreach($menus as $item)
            @if(count($item['menu_childs'])!=0)
                @include('templates.menucomponent',['menus' => $item['menu_childs'],'parent'=>$item['name'],'parent_icon' => $item['icon']])
            @else
            <li>
                <a href="{{$item['url']}}" class='font' key="t-alerts">
                   <i class="{{$item['icon']}} mx-3"></i>{{$item['name']}}
                </a>
            </li>
            @endif
        @endforeach
    </ul>
</li>