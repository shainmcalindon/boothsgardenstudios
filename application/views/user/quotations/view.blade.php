@layout('templates.user')

@section('user_content')

    <div class="page-header"><h1>Quotations <small>Viewing quotations</small></h1></div>

    @include('widgets.errors')

    <table id="myQuotesTable" class="datatable">
        <thead class="header">
            <th>Quote ID</th>
            <th>Layout</th>
            <th>Email</th>
            <th>Post Code</th>
            <th>Price</th>
            <th></th>
        </thead>
        <tbody>
            @foreach($quotes AS $quote)
                <?php $layout = $quote->layout()->first(); ?>
                <tr>
                    <td style="width: 10%;">{{$quote->id}}</td>
                    <td style="width: 10%;">{{$layout->studio()->first()->name}}</td>
                    <td style="width: 10%;">{{$quote->user()->first()->email}}</td>
                    <td style="width: 10%;">{{$quote->postcode}}</td>
                    <td style="width: 10%;">&pound;{{number_format($quote->price, 2)}}</td>
                    <td style="width: 10%; text-align: right; padding-right: 8px;"><a target="_blank" href="/quotations/my_quotes_load/{{$quote->id}}?c={{$quote->quick_access_code}}">Load Quote</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        jQuery(function($){
            $('.datatable').DataTable();
        });
    </script>
@endsection