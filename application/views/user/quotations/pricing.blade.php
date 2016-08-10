@layout('templates.user')

@section('user_content')

    <div class="page-header"><h1>Quotation <small>Update Pricing</small></h1></div>

    @include('widgets.errors')

    <form method="post" role="form" class="form-horizontal">
        <fieldset>
            @foreach ($pricing as $l)
                <div class="form-group">
                    <label class="col-sm-3 control-label"><a href="/user/quotations/pricing_view/{{$l->id}}">{{(!empty($l->friendly_name) ? $l->friendly_name : $l->name)}}</a></label>
                    <div class="col-sm-9 input-group">
                        <div class="input-group-addon">&pound;</div>
                        <input type="text" id="pricing[{{ $l->id }}]" name="pricing[{{ $l->id }}]" value="{{{ number_format(Input::old($l->id, $l->price), 2) }}}" class="form-control">
                    </div>
                </div>
            @endforeach

            <div class="-group">
                <div class="col-sm-offset-3 col-sm-9 form">
                    <button id="save" name="save" class="btn btn-success" type="submit">Save</button>
                    @if($layout)
                        <a id="cancel" name="cancel" class="btn btn-default" href="/user/home/">Cancel</a>
                    @endif
                </div>
            </div>
        </fieldset>
    </form>

@endsection