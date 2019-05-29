<div class="container">
    <table  class="table table-striped table-bordered table-hover" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Type</th>
                <th>Request Date</th>
                <th>Status Request</th>
                <th>Url Sign</th>
                <th>Remark</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($reques as $key => $value) :
                    if($value['buyer_type'] == API) {
                        $buyer_type = 'API';
                    } elseif($value['buyer_type'] == WHITELABEL) {
                        $buyer_type = 'WHITE LABEL';
                    } else {
                        $buyer_type = 'TRAVEL AGENT';
                    }
            ?>
            <tr>
                <td style="text-align: center;"><?= ($key + 1); ?></td>
                <td  style="text-align: center;">
                    <?php  
                        if($value['type'] == SELLER) : 
                    ?>
                    <span class="badge badge-success">Seller</span>
                    <?php else: ?>
                    <span class="badge badge-info">Buyer <?= "<b style='color:black;'>(".$buyer_type.")</b>"; ?></span>
                    <?php endif; ?>
                </td>
                <td  style="text-align: center;"><?= date('Y-m-d',strtotime($value['request_date'])); ?></td>
                <td style="text-align: center;">
                    <?php 
                        if($value['status_request'] == REQUESTED) {
                            echo '<span class="badge badge-warning">REQUESTED</span>';
                        } elseif($value['status_request'] == INPROGRESS ) {
                            echo '<span class="badge badge-info">IN PROGRESS</span>';
                        } elseif($value['status_request'] == WAITINGSIGN ) {
                            echo '<span class="badge badge-warning">WAITING SIGN</span>';
                        } elseif($value['status_request'] == SIGNCOMPLETE ) {
                            echo '<span class="badge badge-success"> SIGN COMPLETE</span>';
                        }elseif($value['status_request'] == REJECTED ) {
                            echo '<span class="badge badge-danger"> REJECTED</span>';
                        } else  {
                            echo '<span class="badge badge-danger">CANCEL REQUEST</span>';
                        }
                    ?>
                </td>
                <td><a style="color: blue;" href="<?= $value['doc_url']; ?>" target='_blank'><?= $value['doc_url']; ?></a></td>
                <td><?= $value['reason_reject']; ?></td>
                <td>
                    <a href="<?php echo site_url('member/cancel_request'); ?>" data-tipe="<?= $value['type']; ?>" data-id="<?= $value['id'] ?>" class="btn btn-danger cancel-confirm"><i class="fa fa-ban"></i> Cancel</a>
                </td>
            </tr>
            <?php 
                endforeach;
            ?>
        </tbody>
    </table>
</div>