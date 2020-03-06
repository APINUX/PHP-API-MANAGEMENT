<?php $this->layout('template', ['title' => 'Admin List']); ?>

<a href="/<?=$crumbs[0]?>/<?=$crumbs[1]?>/add" class="btn btn-success">Add New User</a>
<hr>
<div class="row">
    <?php foreach($admins as $admin){ ?>
        <div class="col-md-4">
            <div class="card">
                <h4 class="card-header"><?=$admin['name']?>
                    <?php if($admin['id']==$_SESSION['UID']){ ?>
                    <a href="/<?=$crumbs[0]?>/profile/" class="btn btn-warning btn-xs float-right">Edit</a></h4>
                    <?php }else{ ?>
                    <a href="/<?=$crumbs[0]?>/<?=$crumbs[1]?>/edit/<?=$admin['id']?>" class="btn btn-warning btn-xs float-right">Edit</a></h4>
                    <?php } ?>
                <div class="card-body">
                    <p class="card-text btn-group btn-block">
                        <a class="btn btn-primary text-white" title="header"><?=$admin['email']?></a>
                        <a href="?<?=($admin['enable']==1)? 'off':'on' ?>" onclick="return confirm('disable <?=$admin['name']?> account?')" class="btn btn-<?=($admin['enable']==1)? 'success':'danger' ?> text-white" title="expired"><?=($admin['enable']==1)? 'ACTIVE':'DISABLED' ?></a>
                    </p>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
