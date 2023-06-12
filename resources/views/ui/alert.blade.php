<div class="alert alert-warning alert-dismissible" role="alert" style="position: absolute;bottom:0;left:16vw;width:84vw;margin:0">
    {{trans('product.cannot')}}
        @if($models->isEmpty())
            <b>{{trans('product.model')}}</b>
        @endif
        @if($models->isEmpty() && $catelogs->isEmpty()){{trans('product.or')}}@endif
        @if($catelogs->isEmpty())
            <b>{{trans('product.catelog')}}</b>
        @endif
        <a href="#create">{{trans('product.create')}}</a>
</div>