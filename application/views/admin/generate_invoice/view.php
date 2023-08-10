<?php $this->load->view('admin/header.php'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/bootstrap3-wysihtml5.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            View Invoice Details
            <small></small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
        </ol>
    </section>
    <section class="invoice">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> View Invoice Details
                    <small class="pull-right">Date: <?php echo $order_date;?></small>
                </h2>
            </div>
        </div>
        <section class="content">
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <b>Bill To,</b><br>
                    <?php $address1 = $billing_address1.' '.$billing_address2.' '.$billing_city.' '.$billing_state.' '.$billing_zipcode;?>
                    <b>Customer Name: </b><?php echo $billing_customer_name;?><br>
                    <b>Company Name: </b><?php echo $billing_company_name;?><br>
                    <b>Phone No: </b><?php echo $billing_phone_no;?><br>
                    <b>Email Id: </b><?php echo $billing_email_id;?><br>
                    <b>Address: </b><?php echo $address1;?><br>
                </div>
                <div class="col-sm-4 invoice-col">
                    <b>Ship To,</b><br>
                    <?php $address = $billing_address1.' '.$billing_address2.' '.$billing_city.' '.$billing_state.' '.$billing_zipcode;?>
                    <?php 
                    $shipping_customer_name = explode(', ', $shipping_customer_name);
                    foreach($shipping_customer_name as $s_customer_name){ ?>
                    <b>User Name: </b><?php echo $s_customer_name;?><br>
                    <?php } ?>
                    <?php  
                    $shipping_email_id = explode(', ', $shipping_email_id);
                   foreach($shipping_email_id as $s_email_address){ ?>
                    <b>Email : </b><?php echo $s_email_address;?><br>
                    <?php } ?>
                </div>
                <?php if($customer_gst_no){ ?>
                <div class="col-sm-4 invoice-col">
                    <b>Customer GST No:</b> <?php echo $customer_gst_no;?><br>
                </div>
                <?php } ?>
               <?php if($inward_no){ ?>
                <div class="col-sm-4 invoice-col">
                    <b>Inword No:</b> <?php echo $inward_no;?><br>
                </div>
                <?php } ?>
                <?php if($invoice_type == "Proforma"){ ?>
                <div class="col-sm-4 invoice-col">
                    <b>Invoice No:</b> <?php echo $invoice_no;?><br>
                </div>
                <?php } else { ?>
                <div class="col-sm-4 invoice-col">
                    <b>Invoice No:</b> <?php echo $main_invoice_no;?><br>
                </div>
                <?php } ?>

            </div>
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Qty.</th>
                                <th>Order No.</th>
                                <th>Report Title</th>
                                <th>Unit Price</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="font-size: 14px;">
                                <td><?php echo $unit_no; ?></td>
                                <td><?php echo $order_no; ?></td>
                                <td><?php echo $invoice_title; ?></td>
                                <td><?php echo $unit_price; ?></td>
                                <td><?php echo $mult; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 pull-left">

                    <!-- <p class="lead">Date : <?php echo $created_at;?></p> -->
                </div>
                <div class="col-xs-6 pull-right">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th style="width:50%">Subtotal:</th>
                                    <td><?php echo $mult;?></td>
                                </tr>
                                <tr>
                                    <th>Discount</th>
                                    <td><?php echo $percent_discount;?>%</td>
                                </tr>
                                <?php if($currency == "INR"){ ?>
                                <tr>
                                    <th>Tax (18%)</th>
                                    <td><?php echo $discount_igst;?></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <th>Total:</th>
                                    <td><?php echo $Total_amount;?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row no-print">
                <div class="col-xs-12">
                    <?php if($list){?>
                        <a href="<?php echo base_url();?>admin/generate_invoice/generated_invoice_list"
                        class="btn btn-default pull-left"><b><i class="fa fa-arrow-left"></i> Back</b></a>
                        <?php } else { ?>
                    <a href="<?php echo base_url();?>admin/generate_invoice/list/<?php echo $id;?>"
                        class="btn btn-default pull-left"><b><i class="fa fa-arrow-left"></i> Back</b></a>
                    <?php } ?>
                    <a href="<?php echo base_url(); ?>admin/generate_invoice/delete/<?php echo $id;?>"
                        class="btn btn-primary pull-right btn btn-danger" style="width: 8%; margin-top: 15px;height: 34px margin-right: 10px;"><i
                            class="fa fa-trash"></i>
                        Delete</a>
                    <form action="<?php echo base_url(); ?>admin/generate_invoice/edit/<?php echo $id; ?>"
                        method="post">
                        <button class="btn btn-primary pull-right btn-success" style="width: 7%; margin-top: 15px;height: 34px;margin-right: 5px;"><i
                                class="fa fa-edit"></i> Edit</button>
                        <?php if($list){?>
                        <input type="hidden" name="type" id="type" value="generate" class="form-control">
                        <?php } else { ?>
                        <input type="hidden" name="type" id="type" value="list" class="form-control">
                        <?php }  ?>
                    </form>
                    <?php if($invoice_type == "Main"){ ?>
                    <a href="<?php echo base_url(); ?>admin/generate_invoice/download_main_invoice/<?php echo $id;?>"
                        class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i>
                        Main Invoice</a>
                    <?php } else if($invoice_type == "Proforma") { ?>
                    <a href="<?php echo base_url(); ?>admin/generate_invoice/download/<?php echo $id;?>"
                        class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i>
                        Proforma Invoice</a>
                    <?php } ?>
                </div>
            </div>
        </section>
    </section>
</div>
<?php $this->load->view('admin/footer.php'); ?>