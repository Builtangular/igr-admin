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
                    <small class="pull-right">Date: <?php echo date('d-m-Y', strtotime($order_date));?></small>
                </h2>
            </div>
        </div>
        <section class="content">
            <div class="row invoice-info">
                <div class="col-sm-8 invoice-col">
                    <b>Ship To,</b><br>
                    <?php 
                    $shipping_customer_name = explode(', ', $shipping_customer_name);
                    foreach($shipping_customer_name as $s_customer_name){ ?>
                    <b>Recipient Name: </b><?php echo $s_customer_name;?><br>
                    <?php } ?>
                    <?php  
                    $shipping_email_id = explode(', ', $shipping_email_id);
                   foreach($shipping_email_id as $s_email_address){ ?>
                    <b>Email : </b><?php echo $s_email_address;?><br>
                    <?php } ?>
                </div>
                <div class="col-sm-4 invoice-col">
                    <b>Invoice No.: </b><?php echo $invoice_no;?>
                </div>
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
                            <?php foreach($custom_invoice_details as $data){ 
                            $total = $data['price'] * $data['unit_no'];
                            $total1+= $total;
                            // var_dump($commission_dis);?>
                            <tr style="font-size: 14px;">
                                <td><?php echo $unit_no[]= $data['unit_no']; ?></td>
                                <td><?php echo $order_no[]= $data['order_no']; ?></td>
                                <td><?php echo $title[]= $data['title']; ?></td>
                                <td><?php echo $price[]= $data['price']; ?></td>
                                <td><?php echo $total; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 pull-right">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th style="width:30%">Subtotal:</th>
                                    <td><?php echo $total1; ?></td>
                                </tr>
                                <?php if($discount_type == "Percentage") { ?>
                                <tr>
                                    <th>Discount</th>
                                    <td><?php echo $discount_value;?>%</td>
                                </tr>
                                <?php } else { ?>
                                <tr>
                                    <th>Discount</th>
                                    <td><?php echo $discount_value;?></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <th>Commission Tax (50%)</th>
                                    <td><?php echo $commission_dis;?></td>
                                </tr>
                                <tr>
                                    <th>Total:</th>
                                    <td><?php echo $commission_dis;?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row no-print">
                <div class="col-xs-12">
                    <a href="<?php echo base_url();?>admin/custom_invoice/list/<?php echo $id;?>"
                        class="btn btn-default pull-left"><b><i class="fa fa-arrow-left"></i> Back</b></a>
                    <a href="<?php echo base_url(); ?>admin/custom_invoice/download/<?php echo $id;?>"
                        class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i>
                        Generate Invoice</a>
                </div>
            </div>
        </section>
    </section>
</div>
<?php $this->load->view('admin/footer.php'); ?>