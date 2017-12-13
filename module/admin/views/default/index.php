                
                
<div class="row-fluid">
    <div class="col-lg-12">
                
                <h1 class="page-header">
                    Управление <small>сайтом</small>
                </h1>
                
                <div class="row">
                    <div class="col-lg-12">
                    <?if($model)foreach($model as $item):?>
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            Новое письмо | <span class="glyphicon glyphicon-envelope"></span> <strong><?=$item->email?></strong>
                            <?=$item->text?>
                        </div>
                    <?endforeach;?>
                    </div>
                </div>
                <!-- /.row -->
                
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Таблица авторизаций</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>status</th>
                                                <th>login</th>
                                                <th>time</th>
                                                <th>ip</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?foreach($auth_log as $al):?>
                                            <tr>
                                                <td><?=$al['id']?></td>
                                                <td><?=$al['status']?></td>
                                                <td><?=$al['user']?></td>
                                                <td><?=date('d.m.Y H:i', $al['time'])?></td>
                                                <td><?=$al['ip']?></td>
                                            </tr>
                                        <?endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <a href="/admin/authlog">Посмотреть всю информацию <span class="glyphicon glyphicon-chevron-right"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                
    </div>
</div>