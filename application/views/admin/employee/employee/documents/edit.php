<?php $this->load->view('admin/header.php'); ?>

<?php $Period = array('2010' , '2011' , '2012' , '2013' , '2014' , '2015' , '2016' , '2017' , '2018' , '2019' , '2020' , '2021' , '2022' , '2023' , '2024' , '2025' , '2026' , '2027' , '2028' , '2029' , '2030' , '2031' , '2032' , '2033' , '2034' , '2035' , '2036' , '2037' , '2038' , '2039' , '2040' , '2041' , '2042' , '2043' , '2044' , '2045' , '2046' , '2047' , '2048' , '2049' , '2050' , '2051' , '2052' , '2053' , '2054' , '2055' , '2056' , '2057' , '2058' , '2059' , '2060' , '2061' , '2062' , '2063' , '2064' , '2065' , '2066' , '2067' , '2068' , '2069' , '2070' , '2071' , '2072' , '2073' , '2074' , '2075' , '2076' , '2077' , '2078' , '2079' , '2080' , '2081' , '2082' , '2083' , '2084' , '2085' , '2086' , '2087' , '2088' , '2089' , '2090' , '2091' , '2092' , '2093' , '2094' , '2095' , '2096' , '2097' , '2098' , '2099');
?>
<style>
ul {
    list-style: none;
}

ul b::before {
    content: "\2022";
    color: green;
    font-weight: bold;
    display: inline-block;
    width: 1em;
    margin-left: -1em;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add Employee Documents
            <small></small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add</li>
        </ol>
    </section>
    <style>
    .error {
        color: red;
    }
    </style>
    <!-- Main content -->
    <section class="content">
        <!-- Your Page Content Here -->
        <div class='row'>
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title"> Upload Documents</h1>
                    </div>
                    <form
                        action="<?php echo base_url(); ?>admin/employee/update_document/<?php echo $record_id;?>"
                        id="document-form" method="post" class="form-horizontal" autocomplete="off"
                        enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Type <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                    <input type="text" id="type" name="type" value="<?php echo $single_document->doc_type;?>"
                                                class="form-control" placeholder="Type">
                                       
                                    </div>
                                    <input type="hidden" id="adhar" name="doc_type" value="Aahaar" class="form-control"
                                        placeholder="Type">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" id="my_id" style="display: none;">
                                    <label class="control-label col-md-3">Type <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" value="<?php echo $single_document->type_name;?>" id="type_name" class="form-control"
                                            placeholder=" " />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Upload <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="file" name="upload_file" id="upload_file" value="<?php echo $single_document->upload_file;?>" class="form-control"
                                            required>
                                    </div>
                                    <input type="hidden" id="adhar" name="doc_type" value="Aahaar" class="form-control"
                                        placeholder="Type">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" id="emp_id" name="emp_id" value="<?php echo $single_document->emp_id;?>" class="form-control"
                                        >
                            <input type="submit" class="btn btn-info pull-right" style='margin-right:16px' name="button"
                                value="Update">
                             <input type="hidden" name="id" class="form-control" id="id" value="<?php if(!empty($single_document)){echo $single_document->id;}?>">                     
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title">Exiting File</h1>
                    </div>
                    <div class="box-body">
                        <ul>
                       
                        <h5 class="box-title text-bold">
                                Exiting File: <a href="<?php echo base_url()."assets/admin/emp_data/document/".$single_document->upload_file; ?>" target= "blank"><?php echo $single_document->upload_file; ?></a>  
                        </h5>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->load->view('admin/footer.php'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<script>
function showDiv(select) {
    if (select.value == 1) {
        document.getElementById('my_id').style.display = "block";
    } else {
        document.getElementById('my_id').style.display = "none";
    }
}
</script>