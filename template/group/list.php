<?php $this->layout('template', ['title' => 'Groups']); ?>
<a href="/<?=$crumbs[0]?>/<?=$crumbs[1]?>/add" class="btn btn-success">Add New Group</a>
<hr>
<div class="row">
    <?php foreach($groups as $group){ ?>
    <div class="col-md-4">
        <div class="card">
            <h4 class="card-header"><?=$group['name']?></h4>
            <div class="card-body">
                <p class="card-text"><?=$group['description']?></p>
                <form method="post" action="/<?=$crumbs[0]?>/routes/" class="btn-group btn-block" role="group">
                    <button type="submit" class="btn btn-info btn-xs" name="group" value="<?=$group['id']?>">APIs</button>
                    <a href="/<?=$crumbs[0]?>/<?=$crumbs[1]?>/edit/<?=$group['id']?>" class="btn btn-primary btn-xs">Edit</a>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>
</div>