<?php $this->load->view('admin/header.php'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            View Query Details
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mailbox</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Query Details</h3>
                        <!-- Previous and for next record -->
                        <?php
                        $privious_query_details = "SELECT * FROM tbl_query_assignment_research where id = (SELECT min(id) FROM tbl_query_assignment_research where query_id < $id AND assigned_name = '$Login_user_name' AND status = 1) ";
                        
                        $privious_query_assign_details = $this->db->query($privious_query_details);
                        $privious_status = $privious_query_assign_details->row();
                        $privious_id = $privious_status->query_id;

                        $next_query_details = "SELECT * FROM tbl_query_assignment_research where id = (SELECT max(id) FROM tbl_query_assignment_research where query_id > $id AND assigned_name = '$Login_user_name' AND status = 1)";
                        
                        $next_query_assign_details = $this->db->query($next_query_details);
                        $next_status = $next_query_assign_details->row();
                        $next_id = $next_status->query_id;
                        ?>
                        <div class="box-tools pull-right">
                            <a href="<?php echo $privious_id; ?>" class="btn btn-box-tool" data-toggle="tooltip"
                                title="Previous"><i class="fa fa-chevron-left"></i></a>
                            <a href="<?php echo $next_id; ?>" class="btn btn-box-tool" data-toggle="tooltip"
                                title="Next"><i class="fa fa-chevron-right"></i></a>
                        </div>
                        <!-- ./ Previous and for next record -->
                    </div>
                    <div class="box-body no-padding">
                        <div class="mailbox-read-message">
                            <div class="col-xs-6">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th style="width:25%">Query Type:</th>
                                                <td><?php echo $type; ?></td>
                                            </tr>
                                            <tr>
                                                <th style="width:25%">Client Name:</th>
                                                <td><?php echo $client_name; ?></td>
                                            </tr>
                                            <tr>
                                                <th style="width:25%">Company:</th>
                                                <td><?php echo $company_name; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th style="width:25%">Title:</th>
                                                <td><?php echo $scope_name.' '.$report_name; ?></td>
                                            </tr>
                                            <tr>
                                                <th style="width:25%">Designation:</th>
                                                <td><?php echo $designation; ?></td>
                                            </tr>
                                            <tr>
                                                <th style="width:25%">Lead Date:</th>
                                                <td><?php echo $lead_date; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th style="width:15%">Client Message:</th>
                                                <td><?php echo $client_message; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="box-footer">
                        <a href="<?php echo base_url();?>admin/query/research_assign_query_list"
                            class="btn btn-default pull-left"><b><i class="fa fa-arrow-left"></i> Back</b></a>
                    </div> -->
                </div>
            </div>
        </div>
        <div class='row'>
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h1 class="box-title"> Query Comment</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/query/insert_research_query_comment"
                        id="employment-form" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-2">Comment</label>
                                    <div class="col-md-10">
                                        <textarea class="ckeditor" name="replycomment" id="newexcomment"
                                            class="form-control" style="height: 200px"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="btn btn-default btn-file">
                                            <i class="fa fa-paperclip"></i> Attachment
                                            <input type="file" name="attachment">
                                        </div>
                                        <p class="help-block">Max. 15MB</p>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="hidden" name="query_id" class="form-control" id="query_id"
                                            value="<?php echo $id;?>">
                                        <input type="hidden" name="view_comment" id="view_comment" value="view_comment">
                                        <input type="hidden" name="comment_for" class="form-control" id="comment_for"
                                            value="<?php echo $user_name;?>">
                                        <input type="submit" class="btn btn-info pull-right" name="button"
                                            value="Submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    
                    <div class="nav-tabs-custom">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <div class="post">
                                    <?php foreach($query_comment as $data){ ?>
                                    <?php if($data->parent == NULL){?>
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm"
                                            src="<?php echo base_url(); ?>assets/admin/img/user.png" alt="user image">
                                        <span class="username">
                                            <a href="#"><?php echo $data->user_name;?></a>
                                            <?php if($data->user_id == $userid) {?>
                                            <a href="#" class="btn-box-tool view_detail" relid="<?php echo $data->id;?>"
                                                data-target="#myModalEdit" data-toggle="modal"><b> <i
                                                        class="fa fa-edit"></i></b></a>
                                            <a
                                                href="<?php echo base_url(); ?>admin/query/research_comment_query_delete/<?php echo $data->id.'?view_research_assign_query/'.$data->query_id; ?>"><b><i
                                                        class="fa fa-trash"></i></b></a>
                                            <?php } else { ?>
                                            <a href="#" class="btn-box-tool reply_comment" qid="<?php echo $data->id;?>"
                                                data-target="#myModalReply" data-toggle="modal"><b> <i
                                                        class="fa fa-reply"></i></b></a>
                                            <?php } ?>
                                        </span>
                                        <span class="description">Date-
                                            <?php echo date("d-m-Y, g:i a", strtotime($data->updated_at)); ?>
                                        </span>
                                    </div>
                                    <p>
                                        <?php echo $data->comment;?>
                                    </p>
                                    <?php if($data->attachment) { ?>
                                    <ul class="list-inline">
                                        <li><a href="<?php echo base_url()."assets/admin/attach-file/".$data->attachment; ?>"
                                                target="blank" class="link-black text-sm">
                                                <b><i class="fa fa-paperclip margin-r-5"></i>
                                                    <?php echo $data->attachment; ?></b></a>
                                        </li>
                                    </ul>
                                    <?php } ?>
                                    <?php } else { ?>
                                    <div class="user-block" style="margin-left: 40px; background-color: #CCFFFF">
                                        <img class="img-circle img-bordered-sm"
                                            src="<?php echo base_url(); ?>assets/admin/img/user.png" alt="user image">
                                        <span class="username">
                                            <a href="#"><?php echo $data->user_name;?></a>
                                            <?php if($data->user_id == $userid) {?>
                                            <a href="#" class="btn-box-tool view_detail"
                                                relid="<?php echo $data->id;?>" data-target="#myModalEdit"
                                                data-toggle="modal"><b> <i class="fa fa-edit"></i></b></a>
                                            <a
                                                href="<?php echo base_url(); ?>admin/query/research_comment_query_delete/<?php echo $data->id.'?view_research_assign_query/'.$data->query_id; ?>"><b><i
                                                        class="fa fa-trash"></i></b></a>
                                            <?php } else { ?>
                                            <a href="#" class="btn-box-tool reply_comment"
                                                qid="<?php echo $data->id;?>" data-target="#myModalReply"
                                                data-toggle="modal"><b> <i class="fa fa-reply"></i></b></a>
                                            <input type="hidden" name="username" id="username"
                                                value="<?php echo $data->user_name;?>">
                                            <?php } ?>
                                        </span>
                                        <span class="description">Date-
                                            <?php echo date("d-m-Y, g:i a", strtotime($data->updated_at)); ?></span>
                                    </div>
                                    <div style="margin-left: 40px;">
                                        <?php echo $data->comment;?>
                                    </div>
                                    <?php if($data->attachment) { ?>
                                    <ul class="list-inline" style="margin-left: 40px;">
                                        <li><a href="<?php echo base_url()."assets/admin/attach-file/".$data->attachment; ?>"
                                                target="blank" class="link-black text-sm">
                                                <b><i class="fa fa-paperclip margin-r-5"></i>
                                                    <?php echo $data->attachment; ?></b></a>
                                        </li>
                                    </ul>
                                    <?php } } } ?>
                                    <?php /* } */  ?>
                                </div>
                            </div>
                        </div>
                        <div id="myModalEdit" class="modal fade" role="dialog">
                            <div class="modal-dialog" style='width: 700px;'>
                                <div class="modal-content">
                                    <form action="<?php echo base_url(); ?>admin/query/research_query_comment_update"
                                        id="employment-form" method="post" class="form-horizontal"
                                        enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <textarea class="ckeditor" name="excomment" id="newexcomment"
                                                        rows="3"></textarea>
                                                </div>
                                                <input type="hidden" name="comment_id" id="comment_id" value="">
                                                <input type="hidden" name="exattachment" id="exattachment" value="">
                                                <input type="hidden" name="view_comment" id="view_comment"
                                                    value="view_comment">
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-10">
                                                    <div class="btn btn-default btn-file">
                                                        <i class="fa fa-paperclip"></i> Attachment
                                                        <input type="file" name="attachment">
                                                    </div>
                                                    <p class="help-block">Max. 15MB</p>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="hidden" name="id" class="form-control" id="id"
                                                        value="<?php if(!empty($id)){echo $id;}?>">
                                                    <input type="submit" class="btn btn-info pull-right" name="button"
                                                        value="Update">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Reply Modal -->
                        <div id="myModalReply" class="modal fade" role="dialog">
                            <div class="modal-dialog" style='width: 700px;'>
                                <div class="modal-content">
                                    <form action="<?php echo base_url(); ?>admin/query/insert_research_query_comment"
                                        id="employment-form" method="post" class="form-horizontal"
                                        enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <textarea class="ckeditor" name="replycomment" id="replycomment"
                                                        rows="3"></textarea>
                                                </div>
                                                <!--  <input type="hidden" name="ex_comment_id" id="ex_comment_id" value="">
                                                <input type="hidden" name="username" id="username"
                                                    value="<?php echo $data->user_name;?>">
                                                <input type="hidden" name="query_id" id="query_id"
                                                    value="<?php echo $data->query_id;?>"> -->
                                                <input type="hidden" name="ex_comment_id" id="ex_comment_id" value="">
                                                <input type="hidden" name="rusername" id="rusername" value="">
                                                <input type="hidden" name="view_comment" id="view_comment"
                                                    value="view_comment">
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-10">
                                                    <div class="btn btn-default btn-file">
                                                        <i class="fa fa-paperclip"></i> Attachment
                                                        <input type="file" name="attachment">
                                                    </div>
                                                    <p class="help-block">Max. 15MB</p>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="hidden" name="query_id" class="form-control"
                                                        id="query_id" value="<?php echo $query_id;?>">
                                                    <input type="hidden" name="comment_for" class="form-control"
                                                        id="comment_for" value="<?php echo $user_name;?>">
                                                    <input type="submit" class="btn btn-info pull-right" name="button"
                                                        value="Submit">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- ./ Reply Modal -->
                    </div>
                </div>
            </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Your Page Content Here -->


    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright © 2022 <a href="#">Infinium</a>.</strong> All rights reserved.
</footer>
</div><!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.3 -->
<script src="<?php echo base_url(); ?>assets/admin/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->

<script src="<?php echo base_url(); ?>assets/admin/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/admin/js/adminlte.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/demo.js" type="text/javascript"></script>

<script src="https://cdn.ckeditor.com/4.22.1/standard-all/ckeditor.js"></script>

<script>
// We need to turn off the automatic editor creation first.
CKEDITOR.disableAutoInline = true;
CKEDITOR.replace('replycomment');
</script>
<script>
$(document).ready(function() {
    $('.sidebar-menu').tree()
})
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('.view_detail').click(function() {
        var id = $(this).attr('relid'); //get the attribute value
        //   alert(var id)
        $.ajax({
            url: "<?php echo base_url(); ?>admin/query/get_comment_data",
            data: {
                id: id
            },
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                var parsedData = JSON.stringify(response);
                console.log(parsedData)
                var jso = JSON.parse(parsedData);
                console.log(jso.id);
                var ckValue = CKEDITOR.instances['newexcomment'].setData(jso.comment);
                document.getElementById("comment_id").value = jso.id;
                document.getElementById("exattachment").value = jso.attachment;
                // document.getElementById("username1").value = jso.user_name;
            }
        });
    });
});

$(document).ready(function() {
    $('.reply_comment').click(function() {
        var qid = $(this).attr('qid'); //get the attribute value
        var username = document.getElementById('username'); //get the attribute value
        var query_id = document.getElementById('query_id'); //get the attribute value
        // alert(qid);
        document.getElementById("ex_comment_id").value = qid;
        document.getElementById("username").value = username;
        document.getElementById("query_id").value = query_id;

    });
});
</script>



</body>

</html>