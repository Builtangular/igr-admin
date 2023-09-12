<?php $this->load->view('admin/header.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Assign Query Details
            <small></small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add</li>
        </ol>
    </section>
    <style>
    #content {
        float: left;
        padding: 20px;
    }
    </style>
    <!-- Main content -->
    <section class="content">
        <!-- Your Page Content Here -->
        <div class='row'>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title"> Assign Query Details</h1>
                    </div>
                    <div class="box-body">
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
            </div>
        </div>
        <div class='row'>
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h1 class="box-title">Assign Query</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/query/research_assign_update" id="employment-form"
                        method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-2">Assign to Team</label>
                                    <div class="col-md-10">
                                        <select class="form-control b-none" id="assign_to_team" name="assign_to_team"
                                            required>
                                            <?php foreach($user_details as $data) {	
                                                if($assign_query->assigned_name == $data->full_name){ ?>
                                            <option value="<?php echo $assign_query->assigned_name;?>" selected>
                                                <?php echo $assign_query->assigned_name;?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo $data->full_name;?>">
                                                <?php echo $data->full_name; ?>
                                            </option>
                                            <?php } } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label col-md-2">Comment</label>
                                    <div class="col-md-10">
                                        <textarea name="comment" id="newexcomment" class="form-control"
                                            style="height: 200px" required></textarea>
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
                                        <input type="hidden" name="id" class="form-control" id="id"
                                            value="<?php if(!empty($single_query_data)){echo $single_query_data->id;}?>">
                                        <input type="submit" class="btn btn-info pull-right formsub" name="button"
                                            value="Submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="nav-tabs-custom">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <!-- ./ Post -->
                                <?php /* <div class="post">
                                    <?php $i = 0; $childs = array(); foreach($query_comment as $data){ $childs[] = $data->id; ?>
                                <?php if($data->parent == NULL){ ?>
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm"
                                        src="<?php echo base_url(); ?>assets/admin/img/user.png" alt="user image">
                                    <span class="username">
                                        <a href="#"><?php echo $data->user_name;?></a>
                                        <?php if($data->user_id == $userid) {?>
                                        <a href="#" class="btn-box-tool edit_comment" relid="<?php echo $data->id;?>"
                                            data-target="#myModalEdit" data-toggle="modal"><b> <i
                                                    class="fa fa-edit"></i></b></a>
                                        <a
                                            href="<?php echo base_url(); ?>admin/query/comment_query_delete/<?php echo $data->id.'?research_assign_edit/'.$data->query_id; ?>"><b><i
                                                    class="fa fa-trash"></i></b></a>
                                        <?php } else  { ?>
                                        <a href="#" class="btn-box-tool reply_comment" qid="<?php echo $data->id;?>"
                                            data-target="#myModalReply" data-toggle="modal"><b> <i
                                                    class="fa fa-reply"></i></b></a>
                                        <input type="hidden" name="user_name" id="user_name"
                                            value="<?php echo $data->user_name;?>">
                                        <?php } ?>
                                    </span>
                                    <span class="description">Date-
                                        <?php echo date("d-m-Y, g:i a", strtotime($data->updated_at)); ?></span>
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
                                <?php } } ?>
                                <!-- ./ query comment -->

                                <!-- query sub comment -->
                                <?php 
                                        $query_details = "SELECT * FROM tbl_query_comment_analyst where parent = ".$childs[$i];
                                        $sub_query_details = $this->db->query($query_details);
                                        $query_status = $sub_query_details->result_array();
                                    ?>
                                <?php foreach($query_status as $subquerycomment) { if($subquerycomment['parent'] == $childs[$i]){?>
                                <div class="user-block" style="margin-left: 40px; background-color: #CCFFFF">
                                    <img class="img-circle img-bordered-sm"
                                        src="<?php echo base_url(); ?>assets/admin/img/user.png" alt="user image">
                                    <span class="username">
                                        <a href="#"><?php echo $subquerycomment['user_name'];?></a>
                                        <?php if($subquerycomment['user_id'] == $userid) {?>
                                        <a href="#" class="btn-box-tool edit_comment"
                                            relid="<?php echo $subquerycomment['id'];?>" data-target="#myModalEdit"
                                            data-toggle="modal"><b> <i class="fa fa-edit"></i></b></a>
                                        <a
                                            href="<?php echo base_url(); ?>admin/query/comment_query_delete/<?php echo $subquerycomment['id'].'?research_assign_edit/'.$subquerycomment['query_id']; ?>"><b><i
                                                    class="fa fa-trash"></i></b></a>
                                        <?php } else  { ?>
                                        <a href="#" class="btn-box-tool reply_comment"
                                            qid="<?php echo $subquerycomment['id'];?>" data-target="#myModalReply"
                                            data-toggle="modal"><b> <i class="fa fa-reply"></i></b></a>

                                        <input type="hidden" name="sub_user_name" id="sub_user_name"
                                            value="<?php echo $subquerycomment['user_name'];?>">
                                        <?php }  ?>
                                    </span>
                                    <span class="description">Date-
                                        <?php echo date("d-m-Y, g:i a", strtotime($subquerycomment['updated_at'])); ?></span>

                                </div>
                                <div style="margin-left: 40px;">
                                    <?php echo $subquerycomment['comment'];?>
                                </div>
                                <?php if($subquerycomment['attachment']) { ?>
                                <ul class="list-inline" style="margin-left: 40px;">
                                    <li><a href="<?php echo base_url()."assets/admin/attach-file/".$subquerycomment['attachment']; ?>"
                                            target="blank" class="link-black text-sm">
                                            <b><i class="fa fa-paperclip margin-r-5"></i>
                                                <?php echo $subquerycomment['attachment']; ?></b></a>
                                    </li>
                                </ul>
                                <?php } } ?>
                                <!-- ./ query sub comment -->
                                <?php } $i++; } die;  ?>
                                <!-- ./ query comment -->
                            </div> */ ?>
                            <div class="post">
                                <?php echo $comments ?>
                            </div>
                            <!-- ./ Post -->
                        </div>
                    </div>
                </div>
                <!-- Edit Model -->
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
                                                value="<?php if(!empty($single_query_data)){echo $single_query_data->id;}?>">
                                            <input type="submit" class="btn btn-info pull-right" name="button"
                                                value="Update">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- ./ Edit Model -->
                <!-- Reply Model -->
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
                                        <input type="hidden" name="ex_comment_id" id="ex_comment_id" value="">
                                        <input type="hidden" name="rusername" id="rusername" value="">
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
                                            <input type="hidden" name="query_id" class="form-control" id="query_id"
                                                value="<?php echo $query_id;?>">
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
                <!-- ./ Reply Model -->
            </div>
        </div>
</div>
</section>
</div>
<!-- /.content -->
<!-- /.content-wrapper -->
<!-- Bootstrap 3.3.2 JS -->
<script src="https://cdn.ckeditor.com/4.22.1/standard-all/ckeditor.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
// We need to turn off the automatic editor creation first.
CKEDITOR.disableAutoInline = true;
CKEDITOR.replace('comment');
// CKEDITOR.replace('reply');
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('.edit_comment').click(function() {
        var id = $(this).attr('relid'); //get the attribute value
        //   alert(id)
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
                document.getElementById("username1").value = jso.user_name;
            }
        });
    });
});


$(document).ready(function() {
    $('.reply_comment').click(function() {
        var qid = $(this).attr('qid'); //get the attribute value
        // var username = document.getElementById('sub_user_name').value; //get the attribute value
        $.ajax({
            url: "<?php echo base_url(); ?>admin/query/get_comment_data",
            data: {
                id: qid
            },
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                var commentData = JSON.stringify(response);
                console.log(commentData)
                var rid = JSON.parse(commentData);
                console.log(rid.id);
                // var ckValue = CKEDITOR.instances['newexcomment'].setData(rid.comment);
                document.getElementById("ex_comment_id").value = rid.id;
                document.getElementById("rusername").value = rid.user_name;
            }
        });

    });
});
</script>
<?php $this->load->view('admin/footer.php'); ?>