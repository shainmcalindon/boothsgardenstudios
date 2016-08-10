@layout('templates.blog')

@section('content')
    <style>
        #FAQSearchForm input{
            border: 1px solid rgb(221, 221, 221);
            border-radius: 6px;
            float: left;
            margin-right: 7px;
            padding: 11px 0;
            text-indent: 10px;
            width: 215px;
        }
        #FAQsearchingFor{
            margin-bottom: 9px;
        }
    </style>
    <div class="page-header">
        <h1>FAQ's</h1>
        @if(!empty($search))
            <div id="FAQsearchingFor">Searching for "{{$search}}" <span><a href="/faqs">(clear search)</a></span></div>
        @endif

        <form id="FAQSearchForm"  method="get" action="/faqs">
            <input type="text" placeholder="Search" name="search" value="{{$search}}">
            <button class="btn btn-primary btn-lg">Search</button>
        </form>
    </div>
    <div class="panel-group" id="accordion">
        @foreach ($faqs AS $i => $faq)
            <?php $i = $i + 1; ?>
            <div class="panel panel-default" data-id="{{$faq->id}}">
                <div class="panel-heading">
                    <a class="accordion-toggle panel-title" data-toggle="collapse" data-parent="#accordion" href="#{{{ $faq->id }}}">
                        {{$i}}. {{{ $faq->question }}}
                    </a>
                </div>
                <div id="{{{ $faq->id }}}" class="panel-collapse collapse">
                    <div class="panel-body">
                        {{ $faq->answer }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('script')
    <script>
        var searchIDs = new Array();
        @if(sizeof($search_faqs))
            @foreach($search_faqs AS $idx => $data)
                searchIDs[{{$idx}}] = {{$data->id}};
            @endforeach
        @endif

        jQuery(function($){
            if(searchIDs.length){
                // Hide all results, so we can show only the required ones
                $('#accordion .panel').hide();

                // Show found search results
                for($a=0; $a < searchIDs.length; $a++){
                    $('#accordion .panel[data-id="' + searchIDs[$a] + '"]').show();
                }
            }
        });
    </script>
@endsection