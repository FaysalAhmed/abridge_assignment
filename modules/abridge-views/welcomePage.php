<link href="modules/abridge-css/loginui.css" rel="stylesheet">
<div class="flat-form">
    <ul class="tabs">
        <li>
            <a href="#login" class="active">Login</a>
        </li>
        <li>
            <a href="#register">Register</a>
        </li>
    </ul>
    <div id="login" class="form-action show">
        <?php if(array_key_exists("error", $params)) echo $params["error"] ?>
        <h1>Login</h1>
        <p>Please Login.</p>
        <form>
            <div class="form-group">
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="User Name">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-default">Login</button>
        </form>
    </div>
    <!--/#login.form-action-->
    <div id="register" class="form-action hide">
        <h1>Register</h1>
        <p>You can Register from here</p>
        <form method="post" action="index.php?r=user/register">
            <div class="form-group">
                <input type="text" name="reg_name" class="form-control" id="exampleInputEmail1" placeholder="User Name">
            </div>
            <div class="form-group">
                <input type="password" name="reg_password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-default">Register</button>
        </form>
    </div>
</div>
<script src="modules/abridge-js/loginui.js"></script>