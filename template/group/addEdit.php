<?php $this->layout('template', ['title' => 'Group '.(($edit)? 'Edit': 'Add')]); ?>

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
                    <label>Description</label>
                    <textarea name="description" id="description" class="form-control" rows="2" placeholder="Description"><?=$data['description']?></textarea>
                </div>
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