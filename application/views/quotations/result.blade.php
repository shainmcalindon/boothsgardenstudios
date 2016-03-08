@layout('templates.main')

@section('content')

<h1>{{ $data->title }}</h1>

<div class="jumbotron">
    <div class="container">     
        <p>The cost of your new studio will be approximately &pound;{{ $data->full_cost }}</p>
        <hr>
        <p><a class="btn btn-primary btn-lg">Click here to email us or call on 00000 000000</a></p>
    </div>
</div>

@endsection