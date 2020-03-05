<?php $this->layout('template', ['title' => 'Routes List','_fluid'=>'-fluid']); ?>

<div class="row">
    <div class="col-sm-2">
        <div class="card">
            <div class="card-body">
                <a href="/<?=$crumbs[0]?>/<?=$crumbs[1]?>/add" class="btn btn-primary btn-block">Add New Route</a>
                <hr>
                <form class="form" method="post">
                    <input type="text" class="form-control" name="search" value="<?=$search?>" placeholder="Search">
                    <select name="group" class="form-control">
                        <option value='0' selected>All Groups</option>
                        <?php foreach($groups as $grp){
                            if($group==$grp['id'])
                                echo '<option value="'.$grp['id'].'" selected>'.$grp['name'].'</option>';
                            else
                                echo '<option value="'.$grp['id'].'">'.$grp['name'].'</option>';
                        }?>
                    </select>
                    <select name="version" class="form-control">
                        <option value='0' selected>All Version</option>
                        <?php foreach($versions as $ver){
                            if($version==$ver['version'])
                                echo '<option value="'.$ver['version'].'" selected>'.$ver['version'].'</option>';
                            else
                                echo '<option value="'.$ver['version'].'">'.$ver['version'].'</option>';
                        }?>
                    </select>
                    <select name="environment" class="form-control" id="inlineFormCustomSelect">
                        <option value='all' selected>All Environment</option>
                        <option value="development" <?php if($environment=='development')echo 'selected';?>>Development</option>
                        <option value="staging" <?php if($environment=='staging')echo 'selected';?>>Staging</option>
                        <option value="production" <?php if($environment=='production')echo 'selected';?>>Production</option>
                    </select>
                    <hr>
                    <button type="submit" class="btn btn-info btn-block">show</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-10">
        <div class="card">
            <div class="table-responsive">
            <form class="form" method="post">
            <input type="hidden" name="search" value="<?=$search?>">
            <input type="hidden" name="group" value="<?=$group?>">
            <input type="hidden" name="version" value="<?=$version?>">
            <input type="hidden" name="environment" value="<?=$environment?>">
            <input type="hidden" name="p" value="<?=$page?>">
            <table class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-secondary">
                        <th>Name</th>
                        <th>Group</th>
                        <th>Type</th>
                        <th>Methods</th>
                        <th>Version/Category/Function</th>
                        <th>Env</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($routes as $route){ ?>
                    <tr class="table-<?php if($route['enabled']==1){ if($route['environment']=='production') echo 'success'; 
                                else if($route['environment']=='staging') echo 'primary'; 
                                else if($route['environment']=='development') echo 'info';
                                }else echo 'danger'; ?>">
                        <td><a href="/<?=$crumbs[0]?>/<?=$crumbs[1]?>/view/<?=$route['id']?>" style="color:black;"><b><?=$route['name']?></b></a></td>
                        <td><?=$route['group_name']?></td>
                        <td><?=$route['route_type']?></td>
                        <td><?php foreach(explode(',',$route['methods']) as $method){
                            echo '<span class="badge badge-secondary">'.$method.'</span>&nbsp;';
                        }?></td>
                        <td><?php if($route['environment']=='staging') echo 'sta';
                                else if($route['environment']=='development') echo 'dev'; ?>/<?= implode('/',array_filter([$route['version'],$route['category'],$route['function']])) ?></td>
                        <td><?=substr($route['environment'],0,3)?></td>
                        <td>
                            <div class="btn-group btn-block btn-group-justified" role="group">
                                <a href="/<?=$crumbs[0]?>/<?=$crumbs[1]?>/edit/<?=$route['id']?>" class="btn btn-info btn-xs">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a>
                                <a href="/<?=$crumbs[0]?>/<?=$crumbs[1]?>/clone/<?=$route['id']?>" onclick="return confirm('Clone <?=$route['name']?> Route')" class="btn btn-warning btn-xs">clone</a>
                                <?php if($route['enabled']==1){ ?>
                                    <button name="off" value="<?=$route['id']?>" onclick="return confirm('Disable <?=$route['name']?> Route')" class="btn btn-danger btn-xs">OFF</button>
                                <?php }else{?>
                                    <button name="on" value="<?=$route['id']?>" onclick="return confirm('Enable <?=$route['name']?> Route')" class="btn btn-success btn-xs">ON</button>
                                <?php }?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            </form>
            </div>
            <div class="card-footer">
                <table class="float-left"><tr>
                    <td class="table-success">&nbsp;Prod&nbsp;</td>
                    <td class="table-primary">&nbsp;Stag&nbsp;</td>
                    <td class="table-info">&nbsp;Dev&nbsp;</td>
                    <td class="table-danger">&nbsp;Off&nbsp;</td>
                </tr></table>
                <form class="form" method="post">
                    <input type="hidden" name="search" value="<?=$search?>">
                    <input type="hidden" name="group" value="<?=$group?>">
                    <input type="hidden" name="version" value="<?=$version?>">
                    <input type="hidden" name="environment" value="<?=$environment?>">
                <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item <?php if($page<1) echo'disabled' ?>"><button type="submit" name="p" value="<?=$page-1?>" class="page-link">Prev</button></li>
                    <li class="page-item disabled"><a href="#" class="page-link"><?=$count?>-<?=$total?></a></li>
                    <li class="page-item <?php if(count($routes)<$max) echo'disabled' ?>"><button type="submit" name="p" value="<?=$page+1?>" class="page-link">Next</button></li>
                </ul>
                </form>
            </div>
        </div>
    </div>
</div>

