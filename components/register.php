<?php

use Models\RegisterModel;


include_once('./Models/Model.php');

include_once('./Models/RegisterModel.php');

$model = new RegisterModel();


?>

<div class="container mt-1">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header">
                    <b>Register</b>
                </div>

                <div class="card-body">

                    <form method="POST" action="">
                        <div class="row">
                            <div class="col-md">
                                <div class=" form-group">
                                    <label for="firstname" class="col-form-label text-md-right">First Name:<sub
                                            style="color:red; font-weight:bold;"> *</sub></label>

                                    <div class="">
                                        <input id="firstname" type="text"
                                            style="font-family: 'Helvetica', FontAwesome, sans-serif; box-shadow:none;"
                                            class="form-control <?php $model->ifClassError('firstname'); ?>"
                                            name="firstname" placeholder="&#xf573 First Name . . ."
                                            value="<?php $model->inputValue('firstname'); ?>">

                                    </div>
                                </div>
                                <div class="error text-danger">
                                    <?php echo $model->errorMessage('firstname'); ?>
                                </div>
                            </div>

                            <div class="col-md">
                                <div class=" form-group">
                                    <label for="lastname" class="col-form-label text-md-right">Last Name:<sub
                                            style="color:red; font-weight:bold;"> *</sub></label>

                                    <div class="">
                                        <input id="lastname" type="text"
                                            style="font-family: 'Helvetica', FontAwesome, sans-serif; box-shadow:none;"
                                            class="form-control <?php $model->ifClassError('lastname'); ?>"
                                            name="lastname" placeholder="&#xf573 Last Name . . ."
                                            value="<?php $model->inputValue('lastname'); ?>">

                                    </div>
                                </div>
                                <div class="error text-danger">
                                    <?php echo $model->errorMessage('lastname'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md">
                                <div class=" form-group">
                                    <label for="username" class="col-form-label text-md-right">User Name:
                                        <span class="text-secondary" style="font-size:.8em">(Optional)</span>
                                    </label>

                                    <div class="">
                                        <input id="username" type="text"
                                            style="font-family: 'Helvetica', FontAwesome, sans-serif; box-shadow:none;"
                                            class="form-control <?php $model->ifClassError('username'); ?>"
                                            name="username" placeholder="&#xf573 User Name . . ."
                                            value="<?php $model->inputValue('username'); ?>">

                                    </div>
                                </div>
                                <div class="error text-danger">
                                    <?php echo $model->errorMessage('username'); ?>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class=" form-group">
                                    <label for="email" class="col-form-label text-md-right">Email:<sub
                                            style="color:red; font-weight:bold;"> *</sub></label>

                                    <div class="">
                                        <input id="email" type="email"
                                            style="font-family: 'Helvetica', FontAwesome, sans-serif; box-shadow:none;"
                                            class="form-control <?php $model->ifClassError('email'); ?>" name="email"
                                            placeholder="&#xf0e0 Email . . ."
                                            value="<?php $model->inputValue('email'); ?>">

                                    </div>
                                </div>
                                <div class="error text-danger">
                                    <?php echo $model->errorMessage('email'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <p for="password" class=" col-form-label d-flex justify-content-between">
                                <span>Password:<sub style="color:red; font-weight:bold;"> *</sub></span><i
                                    onclick="toggleIcon('passIcon', 'password');" id="passIcon" style="cursor:pointer;"
                                    class="fa-solid fa-lock pr-2"></i>
                            </p>

                            <div class="">
                                <input id="password" type="password" placeholder="&#xf023 Password . . . . . ."
                                    style="box-shadow: none; font-family: 'Helvetica', FontAwesome, sans-serif;"
                                    class="form-control <?php $model->ifClassError('password'); ?>"
                                    value="<?php $model->inputValue('password'); ?>" name="password">

                            </div>
                        </div>
                        <div class="error text-danger">
                            <?php echo $model->errorMessage('password'); ?>
                        </div>

                        <div class="form-group">
                            <p for="confirmpassword" class=" col-form-label d-flex justify-content-between">
                                <span>Confirm Password:<sub style="color:red; font-weight:bold;"> *</sub></span><i
                                    onclick="toggleIcon('passIcon2', 'confirmpassword');" id="passIcon2"
                                    style="cursor:pointer;" class="fa-solid fa-lock pr-2"></i>
                            </p>

                            <div class="">
                                <input id="confirmpassword" type="password"
                                    placeholder="&#xf023 confirmpassword . . . . . ."
                                    style="box-shadow: none; font-family: 'Helvetica', FontAwesome, sans-serif;"
                                    class="form-control <?php $model->ifClassError('confirmPassword'); ?>"
                                    name="confirmPassword" value="<?php $model->inputValue('confirmPassword'); ?>">

                            </div>
                        </div>
                        <div class="error text-danger">
                            <?php echo $model->errorMessage('confirmPassword'); ?>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-block btn-secondary form-control">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>