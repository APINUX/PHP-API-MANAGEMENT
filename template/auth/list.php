<?php $this->layout('template', ['title' => 'JWT AUTH']); ?>

<a href="/<?=$crumbs[0]?>/<?=$crumbs[1]?>/add" class="btn btn-success">Add New Auth</a>
<hr>
<div class="row">
    <?php foreach($auths as $auth){ ?>
        <div class="col-md-4">
            <div class="card">
                <h4 class="card-header"><?=$auth['name']?>
                    <a href="/<?=$crumbs[0]?>/<?=$crumbs[1]?>/edit/<?=$auth['id']?>" class="btn btn-warning btn-xs float-right">Edit</a></h4>
                <div class="card-body">
                    <p class="card-text btn-group btn-block">
                        <a class="btn btn-primary text-white" title="header"><?=$auth['header']?></a>
                        <a class="btn btn-success text-white" title="expired"><?=$auth['expired']?> hour(s)</a>
                    </p>
                </div>
            </div>
    </div>
    <?php } ?>
</div>
