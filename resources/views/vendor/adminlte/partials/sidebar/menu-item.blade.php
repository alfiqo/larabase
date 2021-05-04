@inject('menuItemHelper', 'JeroenNoten\LaravelAdminLte\Helpers\MenuItemHelper')

@if ($menuItemHelper->isHeader($item))

    {{-- Header --}}
    @include('adminlte::partials.sidebar.menu-item-header')

@elseif ($menuItemHelper->isSearchBar($item))

    {{-- Search form --}}
    @include('adminlte::partials.sidebar.menu-item-search-form')

@elseif ($menuItemHelper->isSubmenu($item))

    {{-- Treeview menu --}}
    @can('view '. strtolower($item['text']))
        @include('adminlte::partials.sidebar.menu-item-treeview-menu')
    @endcan

@elseif ($menuItemHelper->isLink($item))

    {{-- Link --}}
    {{-- @include('adminlte::partials.sidebar.menu-item-link') --}}

    @if(Gate::check('create '. strtolower($item['text'])) || Gate::check('view '. strtolower($item['text'])))
        @include('adminlte::partials.sidebar.menu-item-link')
    @endif
@endif
