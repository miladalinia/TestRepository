@extends('layouts.app')
@section('content')

    <div class="container box">
        <h3 align="center"> Live search in Laravel using Ajax</h3>
        <br/>
        <div class="panel panel-default">

            <div class="panel-heading">Search Customer Data
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <input type="text" name="search" id="search" class="form-control"
                           placeholder="Search Customer Data">
                </div>
                <div class="table-responsive">
                    <h3 align="center"> Total Data: <span id="total-records"></span>
                    </h3>

                    <table class="table table-striped table-bordered">

                        <thead>
                        <tr>
                            <th>customer name</th>
                            <th>address</th>
                            <th>city</th>
                            <th>postal code</th>
                            <th>country</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--                        @foreach($customers as $customer)--}}
                        {{--                            <tr>--}}
                        {{--                                <td>{{$customer->name}}</td>--}}
                        {{--                                <td>{{$customer->address}}</td>--}}
                        {{--                                <td>{{$customer->city}}</td>--}}
                        {{--                                <td>{{$customer->postal_code}}</td>--}}
                        {{--                                <td>{{$customer->country}}</td>--}}
                        {{--                            </tr>--}}
                        {{--                        @endforeach--}}
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {

            fetch_customer_data();

            function fetch_customer_data(query = '') {
                $.ajax({
                    type: 'GET',
                    url: "{{route('live_search.action')}}",
                    data: {query: query},
                    dataType: 'json',
                    success: function (data) {
                        $('tbody').html(data.table_data);
                        $('#total-records').text(data.total_data);
                    },
                })

            }

            $(document).on('keyup', '#search', function () {
                var query = $(this).val();
                fetch_customer_data(query);
            });
        });
    </script>
@endsection

