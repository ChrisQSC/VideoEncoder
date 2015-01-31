<!doctype html>
<html>
<head>
  
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>登录</title>
  <link rel="stylesheet" href="css/pure-min.css" type="text/css" />
  <link rel="stylesheet" href="css/global.css" type="text/css" />
</head>

<body>
  <div class="pure-g-r main-content text-center">
  </div>
  <div class="pure-g-r text-center">
    <div class="pure-u">
<form class="pure-form pure-form-aligned " method="post" action="checklogin.php">
    <fieldset>
      <legend>登录在线评测系统</legend>
        <div class="pure-control-group">
            <label for="username">Username</label>
            <input name="username" type="text" placeholder="Username" />
        </div>

        <div class="pure-control-group">
            <label for="password">Password</label>
            <input name="password" type="password" placeholder="Password" />
        </div>

        <div class="pure-controls text-left">
            <button type="submit" class="pure-button">Submit</button>
        </div>
    </fieldset>
</form>
        </div>
        </div>
</body>
</html>