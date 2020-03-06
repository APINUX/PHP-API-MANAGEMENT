<?php $this->layout('template', ['title' => 'Route '.(($edit)? 'Edit': 'Add'),'footerScript'=>"
<script src=\"http://js.nicedit.com/nicEdit-latest.js\" type=\"text/javascript\"></script>
<script type=\"text/javascript\">bkLib.onDomLoaded(new nicEditor().panelInstance('description'));</script>

<script>

$(function () {
    //Initialize Select2 Elements
    $('.select2').select2({tags: true});
    $('.select22').select2({});
    buildPath();
    setType();
})

function buildPath(){
    var ver = $( '#version' ).val().replace(/[^0-9]/g, '');
    var cat = $( '#category' ).val().replace(/[^a-zA-Z0-9-_.]/g, '');
    var fun = $( '#function' ).val().replace(/[^a-zA-Z0-9-_.]/g, '');
    if(ver == null || ver.length<1){
        return;
    }
    $( '#buildPath' ).html('/'+ver+'/');
    if(cat == null || cat.length<1){
        return;
    }
    $( '#buildPath' ).html('/'+ver+'/'+cat);
    if(fun != null && fun.trim().length>2){
        $( '#buildPath' ).html('/'+ver+'/'+cat+'/'+fun);
    }

}

function setType(){
    var tipe = $( '#route_type' ).val();

    $('#content').attr('rows', 10);
    $('#content').attr('placeholder', 'Content');
    $('#database').removeAttr('disabled');
    $('#retry').removeAttr('disabled');
    $('#retry_delay').removeAttr('disabled');
    $('#timeout').removeAttr('disabled');
    $('#content').removeAttr('disabled');
    $('#content').removeAttr('disabled');
    $('#content_type').removeAttr('disabled');

    if(tipe=='http'){
        $('#content').attr('rows', 1);
        $('#content').attr('placeholder', 'https://');
        $('#database').attr('disabled','disabled');
    }else if(tipe=='plain'){
        $('#content').attr('rows', 20);
        $('#content').attr('placeholder', 'Write something...');
        $('#retry').attr('disabled','disabled');
        $('#retry_delay').attr('disabled','disabled');
        $('#database').attr('disabled','disabled');
        $('#timeout').attr('disabled','disabled');
    }else if(tipe=='echo'){
        $('#content').attr('rows', 1);
        $('#content').attr('placeholder', 'not used');
        $('#content').attr('disabled','disabled');
        $('#database').attr('disabled','disabled');
        $('#retry').attr('disabled','disabled');
        $('#retry_delay').attr('disabled','disabled');
        $('#timeout').attr('disabled','disabled');
        $('#content_type').attr('disabled','disabled');
    }else if(tipe=='php'){
        $('#content').attr('rows', 20);
        $('#content').attr('placeholder', '<?php echo \"Hello World\";');
        $('#database').attr('disabled','disabled');
        $('#retry').attr('disabled','disabled');
        $('#retry_delay').attr('disabled','disabled');
        $('#timeout').attr('disabled','disabled');
    }else if(tipe=='sql'){
        $('#content').attr('placeholder', 'select * from where id=:id and name=:name');
        $('#retry').attr('disabled','disabled');
        $('#retry_delay').attr('disabled','disabled');
        $('#timeout').attr('disabled','disabled');
    }
}
</script>

"]); ?>

<?php if(!empty($msg)){ showAlert($msg, $msgType); }?>

<form class="form" method="post">
<div class="card">
    <div class="card-body">
        <?php if($edit){ ?>
            <h4><?=$data['name']?></h4>
        <?php } ?>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Group</label>
                    <select name="group_id" id="group_id" onchange="buildPath()" class="form-control" style="width: 100%;">
                    <?php if(!empty($data['group_name'])){ ?>
                    <option value="<?=$data['group_id']?>"><?=$data['group_name']?></option>
                    <?php } ?>
                    <?php foreach($groups as $group){
                        if($group['id']!=$data['group_id'])
                        echo '<option value="'.$group['id'].'">'.$group['name'].'</option>';
                    }?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
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
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Version</label>
                    <select name="version" required id="version" onchange="buildPath()" onkeyup="this.value=this.value.replace(/[^0-9]/g, '')" class="form-control select2" style="width: 100%;">
                    <option value="<?=$data['version']?>"><?=$data['version']?></option>
                    <?php foreach($versions as $ver){
                        if($ver['version']!=$data['version'])
                        echo '<option value="'.$ver['version'].'">'.$ver['version'].'</option>';
                    }?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Category</label>
                    <select name="category" required id="category" onkeyup="this.value=this.value" onchange="buildPath()" class="form-control select2" style="width: 100%;">
                    <option value="<?=$data['category']?>"><?=$data['category']?></option>
                    <?php foreach($categories as $cat){
                        if($cat['category']!=$data['category'])
                        echo '<option value="'.$cat['category'].'">'.$cat['category'].'</option>';
                    }?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Function</label>
                    <select name="function" id="function" onkeyup="this.value=this.value.replace(/[^a-zA-Z0-9-_.]/g, '')" onchange="buildPath()" class="form-control select2" style="width: 100%;">
                    <option value="<?=$data['function']?>"><?=$data['function']?></option>
                    <?php foreach($functions as $func){
                        if($func['function']!=$data['function'])
                        echo '<option value="'.$func['function'].'">'.$func['function'].'</option>';
                    }?>
                    </select>
                </div>
            </div>
        </div>
        <small class="form-text text-muted" id="buildPath" style="text-align: center;"></small>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Tipe</label>
                    <select name="route_type" id="route_type" onchange="setType()" class="form-control" style="width: 100%;">
                    <?php foreach($_types as $typ){
                        if($typ==$data['route_type'])
                        echo '<option value="'.$typ.'" selected>'.strtoupper($typ).'</option>';
                        else
                        echo '<option value="'.$typ.'">'.strtoupper($typ).'</option>';
                    }?>
                    </select>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <div class="form-group">
                        <label>Allowed Methods</label>
                        <select name="methods[]" required multiple="" class="form-control select22" style="width: 100%;">
                        <?php 
                        $data['methods'] = explode(',',$data['methods']);
                        foreach($_methods as $met){
                            if(in_array($met,$data['methods']))
                            echo '<option value="'.$met.'" selected>'.$met.'</option>';
                            else
                            echo '<option value="'.$met.'">'.$met.'</option>';
                        }?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Database (SQL)</label>
                    <select name="database" id="database" class="form-control" style="width: 100%;">
                    <option value="null">--not-selected--</option>
                    <?php foreach($databases as $dbs){
                        if($dbs['id']==$data['db_id'])
                        echo '<option value="'.$dbs['id'].'" selected>'.$dbs['name'].' - '.$dbs['db_type'].' - '.ucwords(substr($dbs['environment'],0,3)).'</option>';
                        else
                        echo '<option value="'.$dbs['id'].'">'.$dbs['name'].' - '.$dbs['db_type'].' - '.ucwords(substr($dbs['environment'],0,3)).'</option>';
                    }?>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Retry*</label>
                    <input type="text" class="form-control" name="retry" id="retry" value="<?=(empty($data['retry']))?'3':$data['retry']?>" placeholder="seconds">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Delay*</label>
                    <input type="text" class="form-control" name="retry_delay" id="retry_delay" value="<?=(empty($data['retry_delay']))?'3':$data['retry_delay']?>" placeholder="seconds">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Timeout*</label>
                    <input type="text" class="form-control" name="timeout" id="timeout" value="<?=(empty($data['timeout']))?'5':$data['timeout']?>" placeholder="seconds">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Enabled</label>
                    <select name="enabled" class="form-control" style="width: 100%;">
                        <option value="1" <?=($data['enabled'])? 'selected':''; ?>>ON</option>
                        <option value="0" <?=(!$data['enabled'])? 'selected':''; ?>>OFF</option>
                    </select>
                </div>
            </div>
        </div>
        <small class="form-text text-muted">*HTTP type, in second(s)</small>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label>Content Type</label>
                    <input type="text" class="form-control" name="content_type" id="content_type" value="<?=$data['content_type']?>" placeholder="application/json">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Auth Validation</label>
                    <select name="auth_id" id="auth_id" onchange="buildPath()" class="form-control select2" style="width: 100%;">
                    <option value="<?=$data['auth_id']?>"><?=$data['auth_name']?></option>
                    <?php foreach($auths as $auth){
                        if($auth['id']!=$data['auth_id'])
                        echo '<option value="'.$auth['id'].'">'.$auth['name'].'</option>';
                    }?>
                    <option value="0">No Authorization</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Content</label>
            <textarea name="content" id="content" class="form-control codepress php" rows="10" placeholder="Content"><?=htmlspecialchars($data['content'])?></textarea>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="form-group">
            <label>API Description, explain how to use and the result</label>
            <textarea name="description" id="description" class="form-control" rows="5" placeholder="Description"><?=$data['description']?></textarea>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" name="save" value="true" class="btn btn-info btn-block">SAVE</button>
                <a href="../" class="btn btn-warning btn-sm float-left">back</a>
    <?php if($edit){?><button type="submit" name="delete" onclick="return confirm('Delete it?')" value="true" class="btn btn-danger btn-xs float-right">delete</button><?php } ?>
    </div>
</div>
        </form>