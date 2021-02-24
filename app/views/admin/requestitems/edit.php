<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <?php if(!empty($panel)){echo $panel;}?>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="form-group col">
                            <label class="control-label">Request Numb</label>
                            <input type="text" class="form-control" placeholder="Request Number" value="<?php echo $header_table->request_number;?>" id="request_number">
                        </div>
                        <div class="form-group col">
                            <label class="control-label">Date</label>
                            <input class="form-control" type="date" id="date" placeholder="Date" value="<?php echo $header_table->date;?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label class="control-label">User</label>
                            <select class="form-control" placeholder="User" id="user">
                                <?php $this->m_requestitems->select_user($header_table->user); ?>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label class="control-label">Status</label>
                            <select class="form-control" placeholder="Status" id="status">
                                <option value="1" <?php if($header_table->status==1) echo 'selected="selected"'; ?>>Aktif</option>
                                <option value="2" <?php if($header_table->status==2) echo 'selected="selected"'; ?>>Nonaktif</option>
                            </select>
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-default center-block" id="save_add_btn">Update</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <?php if(!empty($panel_detail)){echo $panel_detail;}?>
                </div>
                <div class="card-body">
                    <button id="add_btn" class="btn btn-default"><i class="fa fa-items-plus"></i> Tambah Items </button><hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="tabel_custom">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Items</th>
                                    <th>Items Brands</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div id="popup_menu" class="popup_box">
    <button class="btn btn-default btn-block" id="edit_btn"><i class="ion-edit"></i>&nbsp;&nbsp;Ubah</button>
    <button class="btn btn-default btn-block" id="delete_btn"><i class="ion-trash-a"></i>&nbsp;&nbsp;Hapus</button>
</div>