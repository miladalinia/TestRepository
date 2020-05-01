<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<div class="container">
    <h1>Laravel 7 Ajax Request example - codechief.org</h1>

    <form>

        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" placeholder="Name" required="">
        </div>

        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" placeholder="Password" required="">
        </div>

        <div class="form-group">
            <strong>Email:</strong>
            <input type="email" name="email" class="form-control" placeholder="Email" required="">
        </div>

        <div class="form-group">
            <button class="btn btn-success btn-submit">Submit</button>
        </div>

    </form>
</div>

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".btn-submit").on('click',function(e){

        e.preventDefault();

        var name = $("input[name=name]").val();
        var password = $("input[name=password]").val();
        var email = $("input[name=email]").val();

        $.ajax({
            type:'POST',
            url:"{{ route('ajaxRequest.post') }}",
            data:{name:name, password:password, email:email},
            success:function(data){
                alert(data.success);
            }
        });

    });

</script>

