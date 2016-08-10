@layout('templates.main')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/new_styles.css') }}">
@endsection

@section('content')
    <div class="page-header">
        <h1 id="myQuotesTitle">My Quotes</h1>
        <div id="myQuotesLogout">
            <a href="/quotations/sign_out">Logout</a>
        </div>
        <div class="clear"></div>
        <p>Please find all your quotes below</p>
    </div>

    <table id="myQuotesTable">
        <tr class="header">
            <td>Quote ID</td>
            <td>Layout</td>
            <td>Price</td>
            <td></td>
        </tr>
        @foreach($quotes AS $quote)
            <?php $layout = $quote->layout()->first(); ?>
            <tr>
                <td style="width: 10%;">{{$quote->id}}</td>
                <td style="width: 10%;">{{$layout->studio()->first()->name}}</td>
                <td style="width: 10%;">&pound;{{$quote->price}}</td>
                <td style="width: 10%; text-align: right; padding-right: 8px;"><a href="/quotations/my_quotes_load/{{$quote->id}}">Load Quote</a></td>
            </tr>
        @endforeach
    </table>

@endsection