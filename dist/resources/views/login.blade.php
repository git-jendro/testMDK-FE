
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
</head>
<body>
    <div class="container">
        <div class="col-md-4 offset-md-4 mt-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Form Login</h3>
                </div>
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for=""><strong>Email</strong></label>
                        <input type="text" id="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for=""><strong>Password</strong></label>
                        <input type="password" id="password" class="form-control" placeholder="Password">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary btn-block">Submit</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function(){
        $("button").click(function(){
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            
            $.ajax({
                type : 'post',
                url : 'http://test-mdk.herokuapp.com/login',
                data : {
                    email : email,
                    password : password,
                },
                success : function (res) {
                    alert(res.message);
                },
                error :function (xhr, ajaxOption, thrownError) {
                    if (!xhr.responseJSON.message) {
                        if (!xhr.responseJSON.email) {
                            $.each(xhr.responseJSON.password, function (i, item){
                                alert(item);
                            })
                        } else {
                            $.each(xhr.responseJSON.email, function (i, item){
                                alert(item);
                            })
                        }
                    } else {
                        alert(xhr.responseJSON.message);
                    }
                }
            })
        });
    });
</script>
</html>