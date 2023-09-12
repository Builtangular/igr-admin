<?php $this->load->view('admin/report-header.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update Query Details
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
                        <div class="form-group">
                            <div class="box-body no-padding">
                                <div class="mailbox-read-message">
                                    <div class="col-xs-6">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <th style="width:50%">Source:</th>
                                                            <td><?php echo $source; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:50%">Query Type:</th>
                                                            <td><?php echo $type; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Company Name:</th>
                                                            <td><?php echo $company_name; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Client Name:</th>
                                                            <td><?php echo $client_name; ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th>Phone No. :</th>
                                                            <td><?php echo $phone_no; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Designation:</th>
                                                            <td><?php echo $designation; ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th style="width:50%">Email Id:</th>
                                                        <td><?php echo $source_mail_id; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Title:</th>
                                                        <td><?php echo $scope_name.' '.$report_name; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Client Message:</th>
                                                        <td><?php echo $client_message; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Client Email:</th>
                                                        <td><?php echo $client_email; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Lead Date:</th>
                                                        <td><?php echo $lead_date; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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
                    <form action="<?php echo base_url(); ?>admin/query/assign_update" id="employment-form" method="post"
                        class="form-horizontal" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Assign</label>
                                    <div class="col-md-10">
                                        <select class="form-control b-none" id="assign_to_team" name="assign_to_team">
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
                                <div class="form-group">
                                    <label class="control-label col-md-2">Assign To Analyst</label>
                                    <div class="col-md-10">
                                        <input type="radio" name="assign_analyst" id="assign_analyst" value="1"
                                            <?php echo ($single_query_data->assign_analyst == 1)?'checked':'' ?> /> Yes
                                        &nbsp;&nbsp;
                                        <input type="radio" name="assign_analyst" id="assign_analyst1" value="0"
                                            <?php echo ($single_query_data->assign_analyst == 0)?'checked':'' ?> /> No
                                        </select>
                                    </div>
                                </div>
                                <?php if($single_query_data->assign_analyst == 1) {?>
                                <div class="form-group" id="div_comment">
                                    <label class="control-label col-md-2">Comment</label>
                                    <div class="col-md-10">
                                        <textarea name="comment" id="newexcomment" class="form-control"
                                            style="height: 200px"></textarea>
                                    </div>

                                </div>
                                <?php } else {?>
                                <div class="form-group hide" id="div_comment">
                                    <label class="control-label col-md-2">Comment</label>
                                    <div class="col-md-10">
                                        <textarea name="comment" id="comment" rows="3" class="form-control"
                                            placeholder="Comment" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group hide" id="my_div">
                                    <label class="control-label col-md-2">Attachment</label>
                                    <div class="col-md-10">
                                        <div class="btn btn-default btn-file">
                                            <i class="fa fa-paperclip"></i> Attachment
                                            <input type="file" name="attachment">
                                        </div>
                                        <p class="help-block">Max. 15MB</p>
                                    </div>
                                </div>
                                <?php }?>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="id" class="form-control" id="id"
                                value="<?php if(!empty($single_query_data)){echo $single_query_data->id;}?>">
                            <input type="submit" class="btn btn-info pull-right" style='margin-right:16px' name="button"
                                value="Submit">
                        </div>
                    </form>
                    <div class="nav-tabs-custom">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <div class="post">
                                    <?php foreach($query_comment as $data){  ?>
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm"
                                            src="<?php echo base_url(); ?>assets/admin/img/user.png" alt="user image">

                                        <span class="username">
                                            <a href="#"><?php echo $data->user_name;?></a>
                                            <?php if($data->user_id!=26) {?>
                                            <a href="#" class="btn-box-tool view_detail" relid="<?php echo $data->id;?>"
                                                data-target="#myModal" data-toggle="modal"><b> <i
                                                        class="fa fa-edit"></i></b></a>
                                            <a
                                                href="<?php echo base_url(); ?>admin/query/comment_query_delete/<?php echo $data->id.'?assign_edit/'.$data->query_id; ?>"><b><i
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
                                    <p>
                                        <?php echo $data->comment;?>
                                    </p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div id="myModalReply" class="modal fade" role="dialog">
                            <div class="modal-dialog" style='width: 700px;'>
                                <div class="modal-content">
                                    <form action="<?php echo base_url(); ?>admin/query/query_comment_update"
                                        id="employment-form" method="post" class="form-horizontal"
                                        enctype="multipart/form-data">
                                        <div class="">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <textarea class="ckeditor" name="excomment" id="newexcomment"
                                                        rows="3"></textarea>
                                                </div>
                                                <input type="hidden" name="comment_id" id="comment_id" value="">
                                                <input type="hidden" name="query_id" class="form-control" id="query_id"
                                                    value="<?php echo $data->query_id;?>">
                                                <input type="hidden" name="username" id="username"
                                                    value="<?php echo $data->user_name;?>">
                                                <input type="hidden" name="commentfor" class="form-control"
                                                    id="commentfor" value="<?php echo $data->user_name;?>">
                                            </div>
                                        </div>
                                        <div class="box-footer hide" id="myid">
                                            <input type="hidden" name="id" class="form-control" id="id"
                                                value="<?php if(!empty($single_query_data)){echo $single_query_data->id;}?>">
                                            <input type="submit" class="btn btn-info pull-right"
                                                style='margin-right:16px' name="button" value="Update">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<!-- Bootstrap 3.3.2 JS -->
<script src="https://cdn.ckeditor.com/4.22.1/standard-all/ckeditor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<!-- <script>
$(function() {
    //Add text editor
    $("#compose-textarea").wysihtml5();
});
</script> -->

<script>
// We need to turn off the automatic editor creation first.
CKEDITOR.disableAutoInline = true;
CKEDITOR.replace('comment');

/* var assign_analyst = document.getElementById('assign_analyst');
var div_comment = document.getElementById('div_comment');
assign_analyst.addEventListener('change', function() {
    if (this.value == 1) {
        div_comment.classList.remove('hide');
    } else {
        div_comment.classList.add('hide');
    }
}) */

$("input[name='assign_analyst']").click(function() {
    console.log(this.id);
    if (this.id == "assign_analyst") {
        div_comment.classList.remove('hide');
        my_div.classList.remove('hide');
        myid.classList.remove('hide');
        // $("#div_comment").show();
    } else {
        div_comment.classList.add('hide');
        my_div.classList.add('hide');
        myid.classList.add('hide');
        // $("#div_comment").hide();
    }
    // $('#div_comment').css('display', ($(this).val() === '1') ? 'block':'none');
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
                console.log(parsedData)
                var jso = JSON.parse(parsedData);
                console.log(jso.id);
                var ckValue = CKEDITOR.instances['newexcomment'].setData(jso.comment);
                document.getElementById("comment_id").value = jso.id;
            }
        });
    });
});


$(document).ready(function() {
    $('.insert_detail').click(function() {
        var qid = $(this).attr('qid'); //get the attribute value
        // var username = document.getElementById('username').value; //get the attribute value
        var commentfor = document.getElementById('commentfor').value; //get the attribute value
        // console.log(commentfor);
        document.getElementById("comment_id").value = qid;
        // document.getElementById("username").value = username;
        document.getElementById("commentfor").value = commentfor;
        /* $.ajax({
            url: "<?php echo base_url(); ?>admin/query/insert_research_query_comment",
            data: {
                qid: qid
            },
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                var parsedData = JSON.stringify(response);
                console.log(parsedData)
                var jso = JSON.parse(parsedData);
                console.log(jso.id);
                // var ckValue = CKEDITOR.instances['newexcomment'].setData(jso.comment);
                document.getElementById("comment_id").value = jso.id;
            }
        }); */
    });
});
</script>

<div class="modal fade displaycontent" id="myModal">
    <?php $this->load->view('admin/footer.php'); ?>