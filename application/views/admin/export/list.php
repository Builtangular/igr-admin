<!DOCTYPE html>
<html>
<head>
  <title>Codeigniter Export Example</title>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</head>
<body>
     
    <div class="table-responsive">
    <table class="table table-hover tablesorter">
        <thead>
            <tr>
                <th class="header">Name</th>
                <th class="header">Active</th>                      
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($list_data) && !empty($list_data)) {
                foreach ($list_data as $key => $list) {
                    ?>
                    <tr>
                        <td><?php echo $list->name; ?></td>   
                        <td><?php echo $list->active; ?></td> 
                       
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="5">There is no employee.</td>    
                </tr>
            <?php } ?>
 
        </tbody>
    </table>
    <a class="pull-right btn btn-primary btn-xs" href="export/generateXls"><i class="fa fa-file-excel-o"></i> Export Data</a>
    </div> 
 
</body>
</html>