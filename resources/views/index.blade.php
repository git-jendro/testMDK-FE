
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title id="title">Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="{{ public_path('js/app.js') }}"></script>
    {{-- <script src="{{ public_path('js/jquery.min.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>
    <div class="container">
        <div class="col-md-4 offset-md-4 mt-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Form Login</h3>
                </div>
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
                    <p class="py-2">Register akun <a href="#">click here</a></p>
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
                url : 'https://test-mdk.herokuapp.com/login',
                data : {
                    email : email,
                    password : password,
                },
                success : function (res) {
                    alert(res.message);
                    $('title').html('List Registered User');
                    $('.container').html('<div class="col-12 mt-5"><div class="col-3 py-2"><div class="ui-widget"><input id="tags" class="form-control" placeholder="Search nama..."></div></div><div class="card"><div class="card-header"><h3 class="text-center">List Registered User</h3></div><div class="card-body"><table class="table"><thead><tr><th scope="col">#</th><th scope="col">Nama</th><th scope="col">Email</th><th scope="col">Register At</th></tr></thead><tbody id="tbody"></tbody></table></div></div></div>');
                    $.ajax({
                        type : 'get',
                        url : 'https://test-mdk.herokuapp.com/list',
                        success : function (res) {
                            $.each(res, function (i, item){
                                i++;
                                var date= moment(item.created_at).format("DD-MM-YYYY hh:mm:ss A");
                                console.log();
                                $('#tbody').append('<tr><td >'+i+'</td><td >'+item.nama+'</td><td >'+item.email+'</td><td >'+date+'</td></tr>');
                            })
                        },
                        error :function (xhr, ajaxOption, thrownError) {
                                console.log(xhr.responseJSON.message);
                            }
                    })
                    $(document).ready(function(){
                        $( "#tags" ).autocomplete({
                            source: function( request, response ) {
                                $.ajax({
                                    url:"https://test-mdk.herokuapp.com/tags",
                                    type: 'post',
                                    dataType: "json",
                                    data: {
                                        tags: request.term
                                    },
                                    success: function( res ) {
                                        response( res );
                                    }
                                });
                            },
                            select: function (event, ui) {
                                alert(ui);
                                $('#tags').val(ui.item.label);
                                $('#tagsid').val(ui.item.value); 
                            },
                        });
                    });
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
        $("a").click(function(){
            $('title').html('Register');
            $('.container').html('<div class="col-md-4 offset-md-4 mt-5"><div class="card"><div class="card-header"><h3 class="text-center">Form Register</h3></div><div class="card-body"><div class="form-group"><label for=""><strong>Nama</strong></label><input type="text" id="nama" class="form-control" placeholder="Nama"></div><div class="form-group"><label for=""><strong>Email</strong></label><input type="text" id="email" class="form-control" placeholder="Email"></div><div class="form-group"><label for=""><strong>Password</strong></label><input type="password" id="password" class="form-control" placeholder="Password"></div></div><div class="card-footer"><button type="button" class="btn btn-primary btn-block">Submit</button></div></div></div>');
            $("button").click(function(){
                var nama = document.getElementById("nama").value;
                var email = document.getElementById("email").value;
                var password = document.getElementById("password").value;
                
                $.ajax({
                    type : 'post',
                    url : 'https://test-mdk.herokuapp.com/regist',
                    data : {
                        nama : nama,
                        email : email,
                        password : password,
                    },
                    success : function (res) {
                        alert(res.message);
                        $('title').html('Login');
                        $('.container').html('<div class="col-md-4 offset-md-4 mt-5"><div class="card"><div class="card-header"><h3 class="text-center">Form Login</h3></div><div class="card-body"><div class="form-group"><label for=""><strong>Email</strong></label><input type="text" id="email" class="form-control" placeholder="Email"></div><div class="form-group"><label for=""><strong>Password</strong></label><input type="password" id="password" class="form-control" placeholder="Password"></div></div><div class="card-footer"><button type="button" class="btn btn-primary btn-block">Submit</button><p class="py-2">Register akun <a href="#">click here</a></p></div></div></div>');
                        $("button").click(function(){
                            var email = document.getElementById("email").value;
                            var password = document.getElementById("password").value;
                            
                            $.ajax({
                                type : 'post',
                                url : 'https://test-mdk.herokuapp.com/login',
                                data : {
                                    email : email,
                                    password : password,
                                },
                                success : function (res) {
                                    alert(res.message);
                                    $('title').html('List Registered User');
                                    $('.container').html('<div class="col-12 mt-5"><div class="col-3 py-2"><div class="ui-widget"><input id="tags" class="form-control" placeholder="Search nama..."></div></div><div class="card"><div class="card-header"><h3 class="text-center">List Registered User</h3></div><div class="card-body"><table class="table"><thead><tr><th scope="col">#</th><th scope="col">Nama</th><th scope="col">Email</th><th scope="col">Register At</th></tr></thead><tbody id="tbody"></tbody></table></div></div></div>');
                                    $.ajax({
                                        type : 'get',
                                        url : 'https://test-mdk.herokuapp.com/list',
                                        success : function (res) {
                                            $.each(res, function (i, item){
                                                i++;
                                                var date= moment(item.created_at).format("DD-MM-YYYY hh:mm:ss A");
                                                console.log();
                                                $('#tbody').append('<tr><td >'+i+'</td><td >'+item.nama+'</td><td >'+item.email+'</td><td >'+date+'</td></tr>');
                                            })
                                        },
                                        error :function (xhr, ajaxOption, thrownError) {
                                                console.log(xhr.responseJSON.message);
                                            }
                                    })
                                    $(document).ready(function(){
                                        $( "#tags" ).autocomplete({
                                            source: function( request, response ) {
                                                $.ajax({
                                                    url:"https://test-mdk.herokuapp.com/tags",
                                                    type: 'post',
                                                    dataType: "json",
                                                    data: {
                                                        tags: request.term
                                                    },
                                                    success: function( res ) {
                                                        response( res );
                                                    }
                                                });
                                            },
                                            select: function (event, ui) {
                                                alert(ui);
                                                $('#tags').val(ui.item.label);
                                                $('#tagsid').val(ui.item.value); 
                                            },
                                        });
                                    });
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
                    },
                    error :function (xhr, ajaxOption, thrownError) {
                        if (!xhr.responseJSON.message) {
                            if (xhr.responseJSON.nama) {
                                $.each(xhr.responseJSON.nama, function (i, item){
                                    alert(item);
                                })
                            } else if (xhr.responseJSON.email) {
                                $.each(xhr.responseJSON.email, function (i, item){
                                    alert(item);
                                })
                            } else if (xhr.responseJSON.password){
                                $.each(xhr.responseJSON.password, function (i, item){
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
    });
</script>
</html>