<?php $this->layout('template', ['title' => 'User '.(($edit)? 'Edit': 'Add')]); ?>

<form class="form" method="post">
<div class="row">
    <div class="col-md-6 offset-md-3">

        <?php if(!empty($msg)){ showAlert($msg, $msgType); }?>

        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" id="name" required class="form-control" placeholder="name" value="<?=$data['name']?>">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" id="email" required class="form-control" placeholder="email" value="<?=$data['email']?>">
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control" style="width: 100%;">
                        <option value="1" <?=($data['role']==1)? 'selected':''; ?>>Superadmin</option>
                        <option value="2" <?=(!$data['role']==2)? 'selected':''; ?>>Admin</option>
                        <option value="3" <?=(!$data['role']==3)? 'selected':''; ?>>Developer</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Enable</label>
                    <select name="enable" class="form-control" style="width: 100%;">
                        <option value="1" <?=($data['enable'])? 'selected':''; ?>>Enable</option>
                        <option value="0" <?=(!$data['enable'])? 'selected':''; ?>>Disable</option>
                    </select>
                </div>
                <?php if(!$login_email){ ?>
                <hr>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="pass1" <?= (!$edit) ? 'required':'';?> id="pass1"  autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" class="form-control" placeholder="Password" value="<?=$data['pass1']?>">
                </div>
                <div class="form-group">
                    <label>Repeat Password</label>
                    <input type="password" name="pass2" <?= (!$edit) ? 'required':'';?> id="pass2"  autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" class="form-control" placeholder="Repeat password" value="<?=$data['pass2']?>">
                </div>
                <?php } ?>
            </div>
            <div class="card-footer">
                <button type="submit" name="save" value="true" class="btn btn-info btn-block">SAVE</button>
                <a href="../" class="btn btn-warning btn-sm float-left">back</a>
            <?php if($edit){?><button type="submit" name="delete" onclick="return confirm('Delete it?')" value="true" class="btn btn-danger btn-xs float-right">delete</button><?php } ?>
            </div>
        </div>
    </div>
</div>
</form>