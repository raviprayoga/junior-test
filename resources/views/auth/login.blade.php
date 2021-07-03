<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    <div class="container">
        <div class="col-sm-8">
            <p class="jdl-lgn">Login Page</p>
            <form class="loginpage" action="/loginpost" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder="email">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" placeholder="password">
                  </div>
                </div>
                <button type="submit" class="btn btn-primary lgn">Login</button>
                <p class="sgn-txt">dont have <a href={{route('signup')}}>acount?</a> </p>
              </form>
        </div>
    </div>
</body>
</html>