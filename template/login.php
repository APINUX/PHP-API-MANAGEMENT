<?php $this->layout('template', ['title' => 'Login']) ?>

<form class="form" method="post">
<div class="row">
    <div class="col-md-6 offset-md-3">

        <?php if(!empty($msg)){ showAlert($msg, $msgType); }?>

        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="email">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" name="login" value="true" class="btn btn-info btn-block">Login</button>
            </div>
            <input type="hidden" name="$_SESSION['CHECK_K']" value="$_SESSION['CHECK_V']">
        </div>
    </div>
</div>
</form>