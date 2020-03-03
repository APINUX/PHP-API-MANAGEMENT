<?php $this->layout('template', ['title' => 'Routes List','footerScript'=>"

<script>

$(function () {
    //Initialize Select2 Elements
    $('.select2').select2({tags: true});
    $('.select22').select2({});
    buildPath();
})

function buildPath(){
    var ver = $( '#version' ).val();
    var cat = $( '#category' ).val();
    var fun = $( '#function' ).val();
    if(ver == null || ver.length<1){
        return;
    }
    $( '#buildPath' ).html('/'+ver+'/');
    if(cat == null || cat.length<1){
        return;
    }
    $( '#buildPath' ).html('/'+ver+'/'+cat);
    if(fun != null || fun.length<1){
        $( '#buildPath' ).html('/'+ver+'/'+cat+'/'+fun);
    }
}
</script>

"]); ?>

<div class="card">
    <div class="card-header"><?= ($edit)? 'Edit': 'Add'; ?> Route</div>
    <div class="card-body">
        <form class="form" method="post">
            <div class="form-group">
                <label>API Name</label>
                <input type="text" class="form-control" name="name" value="<?=$name?>" placeholder="Name">
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Version</label>
                        <select name="version" id="version" onchange="buildPath()" class="form-control select2" style="width: 100%;">
                        <option></option>
                        <?php foreach($versions as $ver){
                            if($ver==$data['version'])
                            echo '<option value="'.$ver['version'].'" selected>'.$ver['version'].'</option>';
                            else
                            echo '<option value="'.$ver['version'].'">'.$ver['version'].'</option>';
                        }?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category" id="category" onchange="buildPath()" class="form-control select2" style="width: 100%;">
                        <option></option>
                        <?php foreach($categories as $cat){
                            if($cat==$data['category'])
                            echo '<option value="'.$cat['category'].'" selected>'.$cat['category'].'</option>';
                            else
                            echo '<option value="'.$cat['category'].'">'.$cat['category'].'</option>';
                        }?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Function</label>
                        <select name="function" id="function" onchange="buildPath()" class="form-control select2" style="width: 100%;">
                        <option></option>
                        <?php foreach($functions as $func){
                            if($func==$data['function'])
                            echo '<option value="'.$func['function'].'" selected>'.$func['function'].'</option>';
                            else
                            echo '<option value="'.$func['function'].'">'.$func['function'].'</option>';
                        }?>
                        </select>
                    </div>
                </div>
            </div>
            <small class="form-text text-muted" id="buildPath" style="text-align: center;"></small>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Tipe</label>
                        <select name="version" class="form-control" style="width: 100%;">
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
                            <select name="methods" multiple="" class="form-control select22" style="width: 100%;">
                            <?php foreach($_methods as $met){
                                if(strpos($data['methods'],$met))
                                echo '<option value="'.$met.'">'.$met.'</option>';
                                else
                                echo '<option value="'.$met.'" selected>'.$met.'</option>';
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
                        <select name="version" class="form-control" style="width: 100%;">
                        <?php foreach($databases as $dbs){
                            if($dbs==$data['api_db.id'])
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
                        <input type="text" class="form-control" name="retry" value="<?=(empty($data['retry']))?'3':$data['retry']?>" placeholder="seconds">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Delay*</label>
                        <input type="text" class="form-control" name="retry_delay" value="<?=(empty($data['retry_delay']))?'3':$data['retry_delay']?>" placeholder="seconds">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Timeout*</label>
                        <input type="text" class="form-control" name="timeout" value="<?=(empty($data['timeout']))?'30':$data['timeout']?>" placeholder="seconds">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Enabled</label>
                        <select name="enabled" class="form-control" style="width: 100%;">
                            <option value="<?=$typ?>" <?=($data['enabled'])? 'selected':''; ?>>ON</option>
                            <option value="<?=$typ?>" <?=(!$data['enabled'])? 'selected':''; ?>>OFF</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Content</label>
                <textarea name="content" id="content" class="form-control codepress php" rows="10"><?=$data['content']?></textarea>
            </div>
            <hr>
            <button type="submit" class="btn btn-info btn-block">SAVE</button>
            <small class="form-text text-muted">*HTTP type, in second(s)</small>
        </form>
    </div>
</div>