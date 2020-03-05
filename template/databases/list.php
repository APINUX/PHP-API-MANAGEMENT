<?php $this->layout('template', ['title' => 'Databases']); ?>

<a href="/<?=$crumbs[0]?>/<?=$crumbs[1]?>/add" class="btn btn-success">Add New DB</a>
<hr>
<div class="row">
    <?php foreach($databases as $db){ ?>
        <div class="col-md-4">
            <div class="card">
                <h4 class="card-header"><?=$db['name']?>
                    <a href="/<?=$crumbs[0]?>/<?=$crumbs[1]?>/edit/<?=$db['id']?>" class="btn btn-warning btn-xs float-right">Edit</a></h4>
                <div class="card-body">
                    <p class="card-text btn-group btn-block">
                        <a class="btn btn-primary text-white" title="header"><?=$db['db_type']?></a>
                        <a class="btn btn-info text-white" title="expired"><?=$db['environment']?></a>
                    </p>
                    <small class="form-text text-muted"><?=$db['db_host']?></small><br>
                </div>
            </div>
    </div>
    <?php } ?>
</div>
