<x-admin-layout :title="$title">
    @include('components/admin/paginated-list', ['editRouteName' => "single_$model"])
</x-admin-layout>
