@layout('templates.user')

@section('user_content')

    <div class="page-header"><h1>Editing: {{$price->name}}</h1></div>

    <form method="post" role="form" class="form-horizontal">
        <fieldset>
            <div class="form-group">
                <label class="control-label">Friendly Name</label>
                <div class="input-group">
                    <input id="plan_image" name="friendly_name" type="text" class="form-control" value="{{{ Input::old('friendly_name', $price->friendly_name) }}}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">Note</label>
                <textarea style="width:100%" rows="10" id="description" name="note">{{ $price->note }}</textarea>
            </div>
            <div class="form-group">
                <button id="save" name="save" class="btn btn-success" type="submit">Save</button>
                <a id="cancel" name="cancel" class="btn btn-default" href="/user/quotations/pricing/">Cancel</a>
            </div>
        </fieldset>
    </form>

@endsection