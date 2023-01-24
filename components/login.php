<?php

use Models\loginModel;

include_once('./Models/Model.php');

include_once('./Models/loginModel.php');

$model = new loginModel();

?>
<div class="container" style="margin-top: -20px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <img src="./img/avatar.png" alt=""
                style="width: 100px;height:100px; border-radius:50%; position:absolute; left:0; right:0; margin-left:auto; margin-right:auto; z-index:10; margin-top:-60px; filter:brightness(150%) saturate(20%);">
            <div class="card shadow-lg">

                <div class="card-header">
                    <b>Login</b>
                </div>

                <div class="card-body">
                    <form method="POST" id="formLogin" onsubmit="">

                        <div class=" form-group">
                            <label for="email" class="col-form-label text-md-right">Email:</label>

                            <div class="">
                                <input id="email" type="email"
                                    style="font-family: 'Helvetica', FontAwesome, sans-serif; box-shadow:none; caret-color:darkblue;"
                                    class="form-control <?php $model->ifClassError('email'); ?>" name="email" required
                                    placeholder="&#xf002 Email . . ." value="<?php $model->inputValue('email'); ?>">

                            </div>
                        </div>
                        <div class="error text-danger">
                            <?php echo $model->errorMessage('email'); ?>
                        </div>


                        <div class="form-group">
                            <p for="password" class=" col-form-label d-flex justify-content-between">
                                <span>Password:<sub style="color:red; font-weight:bold;"> *</sub></span><i
                                    onclick="toggleIcon('passIcon', 'password');" id="passIcon" style="cursor:pointer;"
                                    class="fa-solid fa-lock pr-2"></i>
                            </p>

                            <div class="">
                                <input id="password" type="password" placeholder="&#xf023 Password . . . . . ."
                                    style="box-shadow: none; font-family: 'Helvetica', FontAwesome, sans-serif; caret-color:red;"
                                    class="form-control <?php $model->ifClassError('password'); ?>" name="password"
                                    required value="<?php $model->inputValue('password'); ?>">

                            </div>
                        </div>
                        <div class="error text-danger">
                            <?php echo $model->errorMessage('password'); ?>
                        </div>

                        <div class="form-group mt-2">

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">

                                <label class="form-check-label" for="remember">
                                    Remember Me
                                </label>
                            </div>

                        </div>

                        <div class="form-group mt-3">

                            <button type="submit" class="btn btn-block btn-secondary form-control">
                                Login
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-flex flex-column align-items-center mt-2">
    <h6>-- OR --</h6>
    <h5><a style="text-decoration: none;" href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/register">Go to
            Register Page</a></h5>
</div>