<style>
    .font{
        font-size:12px !important;
    }
</style>

<header>
    <div class="vertical-menu">

        <div data-simplebar class="h-100">
            <div class="menu-title text-white text-center mt-2"  id="time_sidebar" class="font" style="border-bottom: 1px solid #bbbbbb">
                <p id="date_dashboard" style="font-size: 0.8rem; margin: 0"></p>
                <i class="text-white" id="time_dashboard" style="font-size: 2.2rem"></i>
            </div>
            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title" key="t-menu">Menu Utama</li>
                    @foreach ($menus as $item)
                        @php
                            $_active = ($loop->first) ? 'menu-item-active' : '';
                        @endphp

                        @if (count($item['menu_childs']) == 0)
                            <li>
                                <a href="{{$item['url']}}" class="waves-effect {{$_active}}">
                                    <i class="{{$item['icon']}} mx-2"></i>
                                    <span>{{$item['name']}}</span>
                                </a>
                            </li>
                        @else
                            @include('layouts.menucomponent',[
                                'menus'=> $item['menu_childs'],
                                'parent'=> $item['name'],
                                'parent_icon' => $item['icon']
                            ])
                        @endif
                    @endforeach
                </ul>
            </div>
            <!-- Sidebar -->
        </div>
    </div>
</header>