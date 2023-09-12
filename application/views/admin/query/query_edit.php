<?php $this->load->view('admin/report-header.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Query Details
            <small></small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Your Page Content Here -->
        <div class='row'>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title">Query Details</h1>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <div class="col-xs-6">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th style="width:25%">Source:</th>
                                            <td><?php echo $source; ?></td>
                                        </tr>
                                        <tr>
                                            <th style="width:25%">Query Type:</th>
                                            <td><?php echo $type; ?></td>
                                        </tr>
                                        <tr>
                                            <th style="width:25%">Company Name:</th>
                                            <td><?php echo $company_name; ?></td>
                                        </tr>
                                        <tr>
                                            <th style="width:25%">Client Name:</th>
                                            <td><?php echo $client_name; ?></td>
                                        </tr>
                                        <tr>
                                            <th style="width:25%">Phone No. :</th>
                                            <td><?php echo $phone_no; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-xs-6">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th style="width:25%">Email Id:</th>
                                            <td><?php echo $source_mail_id; ?></td>
                                        </tr>
                                        <tr>
                                            <th style="width:25%">Title:</th>
                                            <td><?php echo $scope_name.' '.$report_name; ?></td>
                                        </tr>
                                        <tr>
                                            <th style="width:25%">Client Email:</th>
                                            <td><?php echo $client_email; ?></td>
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
                            <div class="col-xs-12">
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
    </section>
    <section class="content">
        <!-- Your Page Content Here -->
        <div class='row'>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title">Update Query</h1>
                    </div>
                    <div class="box-body">
                        <form action="<?php echo base_url(); ?>admin/query/query_update" id="employment-form"
                            method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Assign To Team</label>
                                    <div class="col-md-10">
                                        <select class="form-control b-none" id="assign_to_team" name="assign_to_team">
                                            <?php foreach($user_details as $data) {	
                                                if($Login_user_name  == $data->full_name){ ?>
                                            <option value="<?php echo $Login_user_name;?>" selected>
                                                <?php echo $Login_user_name;?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo $data->full_name;?>">
                                                <?php echo $data->full_name; ?>
                                            </option>
                                            <?php } } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Assign To Analyst</label>
                                    <div class="col-md-4">
                                        <input type="radio" name="assign_analyst" id="assign_analyst" value="1"
                                            <?php echo ($single_query_data->assign_analyst == 1)?'checked':'' ?> /> Yes
                                        &nbsp;&nbsp;
                                        <input type="radio" name="assign_analyst" id="assign_analyst1" value="0"
                                            <?php echo ($single_query_data->assign_analyst == 0)?'checked':'' ?> /> No
                                    </div>
                                    <!-- for priority -->
                                    <?php if($single_query_data->assign_analyst == 1){ ?>
                                    <label class="control-label col-md-2" id="pri_label">Priority</label>
                                    <div class="col-md-4" id="pri_div">
                                        <input type="radio" name="priority" id="priority" value="0"
                                            <?php echo ($single_query_data->priority == 0)?'checked':'' ?> /> Priority
                                        &nbsp;&nbsp;
                                        <input type="radio" name="priority" id="priority" value="1"
                                            <?php echo ($single_query_data->priority == 1)?'checked':'' ?> /> High
                                        Priority
                                    </div>
                                    <?php }else{ ?>
                                    <label class="control-label col-md-2 hide" id="pri_label">Priority</label>
                                    <div class="col-md-4 hide" id="pri_div">
                                        <input type="radio" name="priority" id="priority" value="0"
                                            <?php echo ($single_query_data->priority == 0)?'checked':'' ?> /> Priority
                                        &nbsp;&nbsp;
                                        <input type="radio" name="priority" id="priority" value="1"
                                            <?php echo ($single_query_data->priority == 1)?'checked':'' ?> /> High
                                        Priority
                                    </div>
                                    <?php } ?>
                                    <!-- ./ for priority -->
                                </div>
                                <?php if($single_query_data->assign_analyst == 1) {?>
                                <div class="form-group" id="div_comment">
                                    <label class="control-label col-md-2">Comment</label>
                                    <div class="col-md-10">
                                        <textarea name="comment" id="newexcomment" class="form-control"
                                            style="height: 200px"></textarea>
                                    </div>
                                </div>
                                <div class="form-group" id="my_div">
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
                                        <input type="hidden" name="fullname" class="form-control" id="fullname"
                                            value="<?php if(!empty($single_user_details)){echo $single_user_details->full_name;}?>">
                                        <input type="submit" class="btn btn-info pull-right" name="button"
                                            value="Submit">
                                    </div>
                                </div>
                                <?php } else { ?>
                                <div class="form-group hide" id="div_comment">
                                    <label class="control-label col-md-2">Comment</label>
                                    <div class="col-md-10">
                                        <textarea name="comment" id="comment" rows="3" class="form-control"
                                            placeholder="Comment" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group hide" id="my_div">
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
                                        <input type="hidden" name="fullname" class="form-control" id="fullname"
                                            value="<?php if(!empty($single_user_details)){echo $single_user_details->full_name;}?>">
                                        <input type="submit" class="btn btn-info pull-right" name="button"
                                            value="Submit">
                                    </div>
                                </div>
                                <?php }?>
                            </div>
                        </form>
                    </div>
                    <div class="nav-tabs-custom">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <div class="post">
                                    <!-- Query main comment -->
                                    <?php foreach($query_comment as $data){ ?>
                                    <?php if($data->parent == NULL){?>
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm"
                                            src="<?php echo base_url(); ?>assets/admin/img/user.png" alt="user image">
                                        <span class="username">
                                            <a href="#"><?php echo $data->user_name;?></a>
                                            <?php if($data->user_id == $userid) { ?>
                                            <a href="#" class="btn-box-tool view_detail" relid="<?php echo $data->id;?>"
                                                data-target="#myModalEdit" data-toggle="modal"><b> <i
                                                        class="fa fa-edit"></i></b></a>
                                            <a
                                                href="<?php echo base_url(); ?>admin/query/comment_query_delete/<?php echo $data->id.'?query_edit/'.$data->query_id; ?>"><b><i
                                                        class="fa fa-trash"></i></b></a>
                                            <?php } else { ?>
                                            <a href="#" class="btn-box-tool insert_detail" qid="<?php echo $data->id;?>"
                                                data-target="#myModalReply" data-toggle="modal"><b> <i
                                                        class="fa fa-reply"></i></b></a>
                                            <input type="hidden" name="username" id="username"
                                                value="<?php echo $data->user_name;?>">
                                            <input type="hidden" name="commentfor" class="form-control" id="commentfor"
                                                value="<?php echo $data->user_name;?>">
                                            <?php } ?>
                                        </span>
                                        <span class="description">Date-
                                            <?php echo date("d-m-Y, g:i a", strtotime($data->updated_at)); ?></span>
                                    </div>
                                    <!-- Comment Section -->
                                    <p>
                                        <?php echo $data->comment;?>
                                    </p>
                                    <!-- Attachment section -->
                                    <?php if($data->attachment) { ?>
                                    <a href="<?php echo base_url()."assets/admin/attach-file/".$data->attachment; ?>"
                                        target="blank" class="link-black text-sm">
                                        <b><i class="fa fa-paperclip margin-r-5"></i>
                                            <?php echo $data->attachment; ?></b></a>
                                    <?php } }?>

                                    <!-- query sub comment -->
                                    <?php $query_details = "SELECT * FROM tbl_query_comment_analyst where parent = ".$data->id;
                                            $sub_query_details = $this->db->query($query_details);
                                            $query_status = $sub_query_details->result_array();
                                            ?>

                                    <?php if($query_status) { ?>
                                    <?php foreach($query_status as $subquerycomment) { ?>
                                    <!-- user details -->
                                    <div class="user-block" style="margin-left: 40px; background-color: #CCFFFF">
                                        <img class="img-circle img-bordered-sm"
                                            src="<?php echo base_url(); ?>assets/admin/img/user.png" alt="user image">
                                        <span class="username">
                                            <a href="#"><?php echo $subquerycomment['user_name'];?></a>
                                            <?php if($subquerycomment['user_id'] == $userid) { ?>
                                            <a href="#" class="btn-box-tool view_detail"
                                                relid="<?php echo $subquerycomment['id'];?>" data-target="#myModalEdit"
                                                data-toggle="modal"><b> <i class="fa fa-edit"></i></b></a>
                                            <a
                                                href="<?php echo base_url(); ?>admin/query/comment_query_delete/<?php echo $subquerycomment['id'].'?query_edit/'.$subquerycomment['query_id']; ?>"><b><i
                                                        class="fa fa-trash"></i></b></a>
                                            <?php } else { ?>
                                            <a href="#" class="btn-box-tool insert_detail"
                                                qid="<?php echo $subquerycomment['id'];?>" data-target="#myModalReply"
                                                data-toggle="modal"><b> <i class="fa fa-reply"></i></b></a>
                                            <?php } ?>
                                        </span>
                                        <span class="description">Date-
                                            <?php echo $subquerycomment['updated_at'];?></span>
                                    </div>
                                    <!-- Comment Section -->
                                    <div style="margin-left: 40px;">
                                        <?php echo $subquerycomment['comment'];?>
                                    </div>
                                    <!-- Attachment Section -->
                                    <?php if($subquerycomment['attachment']) { ?>
                                    <ul class="list-inline" style="margin-left: 40px;">
                                        <li><a href="<?php echo base_url()."assets/admin/attach-file/".$subquerycomment['attachment']; ?>"
                                                target="blank" class="link-black text-sm">
                                                <b><i class="fa fa-paperclip margin-r-5"></i>
                                                    <?php echo $subquerycomment['attachment']; ?></b></a></li>

                                    </ul>
                                    <?php } } ?>
                                    <?php } ?>
                                    <!-- ./ sub query comment -->
                                    <?php }   ?>
                                    <!-- ./ main query comment -->
                                </div>
                            </div>
                        </div>
                        <!-- Comment Edit Model -->
                        <div id="myModalEdit" class="modal fade" role="dialog">
                            <div class="modal-dialog" style='width: 700px;'>
                                <div class="modal-content">
                                    <form action="<?php echo base_url(); ?>admin/query/query_comment_update"
                                        id="employment-form" method="post" class="form-horizontal"
                                        enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <textarea class="ckeditor" name="excomment" id="newexcomment"
                                                        rows="3"></textarea>
                                                </div>
                                                <input type="hidden" name="comment_id" id="comment_id" value="">
                                                <input type="hidden" name="query" id="query" value="Query">
                                                <input type="hidden" name="exattachment" id="exattachment" value="">
                                                <input type="hidden" name="user_name" id="user_name" value="">
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-10">
                                                    <div class="btn btn-default btn-file">
                                                        <i class="fa fa-paperclip"></i> Attachment
                                                        <input type="file" name="newattachment">
                                                    </div>
                                                    <p class="help-block">Max. 15MB</p>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="hidden" name="id" class="form-control" id="id"
                                                        value="<?php if(!empty($single_query_data)){echo $single_query_data->id;}?>">
                                                    <input type="submit" class="btn btn-info pull-right"
                                                        style='margin-right:16px' name="button" value="Update">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- ./ Comment Edit Model -->
                        <!-- Comment Reply Model -->
                        <div id="myModalReply" class="modal fade" role="dialog">
                            <div class="modal-dialog" style='width: 700px;'>
                                <div class="modal-content">
                                    <form action="<?php echo base_url(); ?>admin/query/insert_sales_query_comment"
                                        id="employment-form" method="post" class="form-horizontal"
                                        enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <textarea class="ckeditor" name="replycomment" id="replycomment"
                                                        rows="3"></textarea>
                                                </div>
                                                <input type="hidden" name="ex_comment_id" id="ex_comment_id" value="">
                                                <input type="hidden" name="query_id" class="form-control" id="query_id"
                                                    value="<?php echo $data->query_id;?>">
                                                <input type="hidden" name="username" id="username"
                                                    value="<?php echo $data->user_name;?>">
                                                <input type="hidden" name="commentfor" class="form-control"
                                                    id="commentfor" value="<?php echo $data->user_name;?>">
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
                                                    <input type="submit" class="btn btn-info pull-right"
                                                        style='margin-right:16px' name="button" value="Submit">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- ./ Comment Reply Model -->
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<!-- Bootstrap 3.3.2 JS -->
<script src="https://cdn.ckeditor.com/4.22.1/standard-all/ckeditor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script>
// We need to turn off the automatic editor creation first.
CKEDITOR.disableAutoInline = true;
CKEDITOR.replace('comment');

$("input[name='assign_analyst']").click(function() {
    // console.log(this.id);
    if (this.id == "assign_analyst") {
        div_comment.classList.remove('hide');
        my_div.classList.remove('hide');
        // my_id.classList.remove('hide');
        pri_div.classList.remove('hide');
        pri_label.classList.remove('hide');
    } else {
        div_comment.classList.add('hide');
        my_div.classList.add('hide');
        // my_id.classList.add('hide');
        pri_div.classList.add('hide');
        pri_label.classList.add('hide');
    }
});
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
                // console.log(parsedData)
                var jso = JSON.parse(parsedData);
                // console.log(jso.id);
                var ckValue = CKEDITOR.instances['newexcomment'].setData(jso.comment);
                document.getElementById("comment_id").value = jso.id;
                document.getElementById("exattachment").value = jso.attachment;
                document.getElementById("user_name").value = jso.user_name;
            }
        });
    });
});

$(document).ready(function() {
    $('.insert_detail').click(function() {
        var qid = $(this).attr('qid'); //get the attribute value
        var commentfor = document.getElementById('commentfor').value; //get the attribute value
        // console.log(commentfor);
        document.getElementById("ex_comment_id").value = qid;
        document.getElementById("commentfor").value = commentfor;
    });
});
</script>

<?php $this->load->view('admin/footer.php'); ?>