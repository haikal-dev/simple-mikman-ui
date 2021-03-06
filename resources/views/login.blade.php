<!DOCTYPE html>
<html lang="en">
<head>
  <title>{{ $title }} {{ $version }}</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    .wp-siteLoader {
            width: 2rem;
            height: 2rem;
            border: 5px solid #f3f3f3;
            border-top: 6px solid #9c41f2;
            border-radius: 100%;
            margin: auto;
            visibility: visible;
            animation: spin 1s infinite linear;
        }
        @keyframes    spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="{{ env('APP_URL') }}">{{ $title }}</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="{{ env('APP_URL') }}">Home</a></li>
        <!-- <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Page 1-1</a></li>
            <li><a href="#">Page 1-2</a></li>
            <li><a href="#">Page 1-3</a></li>
          </ul>
        </li>
        <li><a href="#">Page 2</a></li>
        <li><a href="#">Page 3</a></li> -->
      </ul>
      <!-- <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul> -->
    </div>
  </div>
</nav>
  
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 align="center">Simple Mikman UI</h3>
                </div>
                <div class="panel-body">
                    @if(isset($error))
                    
                    <div class="alert alert-danger text-center">{{ $error }}</div>

                    @else

                    <div class="alert alert-info text-center">Authentication is required to access this page</div>

                    @endif
                    
                    <form method="post" action="{{ env('APP_URL') }}/login" class="form" onsubmit="return login(this)">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                        <div class="form-group">
                            <label>Username</label>
                            <input class="form-control" type="text" name="username" placeholder="Enter username" required />
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" type="password" name="password" placeholder="Enter password" required />
                        </div>

                        <div align="center" id="loader"></div>

                        <div class="form-group">
                            <input class="btn btn-primary form-control" type="submit" name="btn" value="Login" />
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success form-control" onclick="signup()">Signup</button>
                        </div>
                    </form>
                </div>
                <div class="panel-footer text-center">
                  {{ $title }} {{ $version }}
                </div>
            </div>
        </div>
    </div>
</div>
<script>

function loader(e){
	var el = document.createElement('div');
	el.className = 'wp-siteLoader';
	el.style.margin = '10px';
	$(e).html(el);
}
  
function login(form){
  form.btn.disabled = true;
  loader('#loader');
  form.submit();

  return false;
}

function signup(){
  window.location = "/signup";
}

</script>
</body>
</html>
