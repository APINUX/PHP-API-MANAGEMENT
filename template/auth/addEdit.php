<?php $this->layout('template', ['title' => 'JWT Auth '.(($edit)? 'Edit': 'Add')]); ?>

<form class="form" method="post">
<div class="row">
    <div class="col-md-6 offset-md-3">

        <?php if(!empty($msg)){ showAlert($msg, $msgType); }?>

        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="name" value="<?=$data['name']?>">
                </div>
                <div class="form-group">
                    <label>JWT Secret</label>
                    <input type="text" name="jwt_secret" id="jwt_secret" class="form-control" placeholder="JWT Secret" value="<?=$data['jwt_secret']?>">
                </div>
                <div class="form-group">
                    <label>Expired</label>
                    <div class="input-group mb-3">
                        <input type="number" name="expired" id="expired" class="form-control" placeholder="expired" value="<?=$data['expired']?>">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">hour(s)</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Header Name</label>
                    <input type="text" name="header" id="header" class="form-control" placeholder="X-AUTH" value="<?=$data['header']?>">
                    <small class="form-text text-muted">By default, for every http request type, headers will be sent to another API</small>
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