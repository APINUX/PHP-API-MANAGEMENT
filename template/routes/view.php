<?php $this->layout('template', ['title' => 'View Route','footerScript'=>""]); ?>

<?php if(!empty($msg)){ showAlert($msg, $msgType); }?>

<form class="form" method="post">
<div class="card">
    <div class="card-body">
        <h4><?=$data['name']?></h4>
        <p><?=$data['description']?></p>
    </div>
</div>
<div class="card bg-<?php if($data['enabled']==1){ if($data['environment']=='production') echo 'success'; 
        else if($data['environment']=='staging') echo 'primary'; 
        else if($data['environment']=='development') echo 'info';
        }else echo 'danger'; ?>">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Group</label>
                    <h4><?=$data['group_name']?></h4>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Environment</label>
                    <h4><?=$data['environment']?></h4>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h4>
            <?php foreach(explode(',',$data['methods']) as $method){
                echo '<span class="badge badge-secondary">'.$method.'</span>&nbsp;';
            }?>
            <?=$_SERVER['HTTP_HOST']?>/<?php if($data['environment']=='staging') echo 'sta';
                                else if($data['environment']=='development') echo 'dev'; ?>/<?= implode('/',array_filter([$data['version'],$data['category'],$data['function']])) ?>
        </h4>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-2">
                <label>Tipe</label>
                <h4><?=$data['route_type']?></h4>
            </div>
            <div class="col-md-2">
                <label>Database</label>
                <h4><?=$data['db_name']?></h4>
            </div>
            <div class="col-md-2">
                <label>Retry</label>
                <h4><?=$data['retry']?></h4>
            </div>
            <div class="col-md-2">
                <label>Retry Delay</label>
                <h4><?=$data['retry_delay']?></h4>
            </div>
            <div class="col-md-2">
                <label>Timeout</label>
                <h4><?=$data['timeout']?></h4>
            </div>
            <div class="col-md-2">
                <label>Enabled</label>
                <p>
                <?php if($data['enabled']){ ?>
                <a href="?off" onclick="return confirm('Disable?')" class="btn btn-success btn-block text-white" role="button">ON</a>
                <?php }else{ ?>
                <a href="?on" onclick="return confirm('Enable?')" class="btn btn-danger btn-block text-white" role="button">OFF</a>
                <?php } ?></p>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label>Content Type</label>
                    <h4><?=$data['content_type']?></h4>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Auth Validation</label>
                    <h4><?=$data['auth_name']?></h4>
                </div>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <label>Content</label>
            <p><?=htmlspecialchars($data['content'])?></p>
        </div>
    </div>
    <hr>
    <div class="card-footer">
        <div class="btn-group btn-block btn-group-justified" role="group">
            <a href="/admin/routes/edit/<?=$data['id']?>" class="btn btn-info">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a>
            <a href="/admin/routes/clone/<?=$data['id']?>" onclick="return confirm('Clone <?=$route['name']?> Route')" class="btn btn-success">clone</a>
        </div>
    </div>
</div>
</form>