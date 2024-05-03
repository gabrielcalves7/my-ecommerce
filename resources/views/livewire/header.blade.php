<div>
    @if(isset($public) && $public == false)
        <x-admin.header :categories="$categories" :public="$public"></x-admin.header>
    @else
        <x-public.header :categories="$categories" :public="true"></x-public.header>
    @endif
</div>
