
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}" >

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        .box{
            width:600px;
            margin:0 auto;
            border:1px solid #ccc;
        }
    </style>


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
</head>
<body>


<div class="container box">
    <h3 align="center">Ajax Dynamic Dependent Dropdown in Laravel</h3><br />
    <div class="form-group">
        <select name="region" id="region" class="form-control input-lg " data-dependent="state">
            <option value="">Select Region</option>
            @foreach($array as $value)
                <option value="{{ $value->region}}">{{ $value->region }}</option>
            @endforeach
        </select>
    </div>
    <br />
    <div class="form-group">
        <select name="country" id="country" class="form-control input-lg dynamic" data-dependent="city">
            <option value="">Select Country</option>
        </select>
    </div>
    <br />
    <div class="form-group" id="endding">
        Population: <input type="number" id="population" ><br>
        Capital: <input type="text" name="capital" id="capital"><br>
    </div>
    {{ csrf_field() }}
    <br />
    <br />
</div>

<script>
    $(document).ready(function() {

        $('#region').change(function (e) {
            e.preventDefault();
            var e = document.getElementById("region");
            var region = e.options[e.selectedIndex].value;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{Route('getdata')}}",
                method: "get",
                datatype: "json",
                data: {
                    region: region,
                },
                success: function (data) {
                    var obj = JSON.parse(data);
                    $.each(obj, function(index, value){
                        $("#country").append('<option value="' + value.name + '">' + value.name  + '</option>');
                    });
                },
            });
        });

        $('#country').change(function (e) {
            e.preventDefault();
            var e = document.getElementById("country");
            var country = e.options[e.selectedIndex].value;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{Route('getdetails')}}",
                method: "get",
                datatype: "json",
                data: {
                    country: country,
                },
                success: function (data) {
                    var obj = JSON.parse(data);
                    $.each(obj, function(index, value){
                        $("#population").val(value.population);
                        $("#capital").val(value.capital);
                    });
                },
            });
        });

    });


</script>


</body>
</html>
