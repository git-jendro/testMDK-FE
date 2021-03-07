
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="{{ public_path('js/app.js') }}"></script>
    <script src="{{ public_path('js/jquery.min.js') }}"></script>
    <script src="{{ public_path('js/moments.js') }}"></script>
</head>
<body>
    <div class="container">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">List Registered User</h3>
                </div>
                @csrf
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Register At</th>
                          </tr>
                        </thead>
                        <tbody id="tbody">
                          
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function(){
        $('#tbody').html('');
        $.ajax({
            type : 'get',
            url : 'http://test-mdk.herokuapp.com/list',
            success : function (res) {
                $.each(res, function (i, item){
                    i++;
                    var date= moment(item.created_at).format("DD-MM-YYYY hh:mm:ss A");
                    console.log();
                    $('#tbody').append('<tr><td >'+i+'</td><td >'+item.nama+'</td><td >'+item.email+'</td><td >'+date+'</td></tr>');
                })
            },
        })
    });
</script>
</html>