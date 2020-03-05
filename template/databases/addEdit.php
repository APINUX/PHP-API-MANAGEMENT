<?php $this->layout('template', ['title' => 'DB '.(($edit)? 'Edit': 'Add')]); ?>

<form class="form" method="post">
<div class="row">
    <div class="col-md-6 offset-md-3">

        <?php if(!empty($msg)){ showAlert($msg, $msgType); }?>

        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" required id="name" class="form-control" placeholder="name" value="<?=$data['name']?>">
                </div>
                <div class="form-group">
                    <label>Database Type</label>
                    <select name="environment" id="environment" class="form-control" style="width: 100%;">
                    <?php foreach($_dbs as $db){
                        if($db==$data['environment'])
                        echo '<option value="'.$db.'" selected>'.strtoupper($db).'</option>';
                        else
                        echo '<option value="'.$db.'">'.strtoupper($db).'</option>';
                    }?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Database Name</label>
                    <input type="text" name="db_name" required id="db_name" class="form-control" value="<?=$data['db_name']?>">
                </div>
                <div class="form-group">
                    <label>Database User</label>
                    <input type="text" name="db_user" required id="db_user" readonly onfocus="this.removeAttribute('readonly');" class="form-control" value="<?=$data['db_user']?>">
                </div>
                <div class="form-group">
                    <label>Database password</label>
                    <input type="password" name="db_pass"  autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" required id="db_pass" class="form-control" value="<?=$data['db_pass']?>">
                </div>
                <div class="form-group">
                    <label>Environment</label>
                    <select name="environment" id="environment" class="form-control" style="width: 100%;">
                    <?php foreach($_env as $env){
                        if($env==$data['environment'])
                        echo '<option value="'.$env.'" selected>'.ucfirst($env).'</option>';
                        else
                        echo '<option value="'.$env.'">'.ucfirst($env).'</option>';
                    }?>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" name="save" value="true" class="btn btn-info btn-block">SAVE</button>
            <?php if($edit){?><button type="submit" name="delete" onclick="return confirm('Delete it?')" value="true" class="btn btn-danger btn-xs float-right">delete</button><?php } ?>
            </div>
        </div>
    </div>
</div>
</form>