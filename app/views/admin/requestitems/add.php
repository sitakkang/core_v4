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
                            <input type="text" class="form-control" placeholder="Request Number" id="request_number">
                        </div>
                        <div class="form-group col">
                            <label class="control-label">Date</label>
                            <input class="form-control" type="date" id="date" placeholder="Date">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label class="control-label">User</label>
                            <select class="form-control" placeholder="User" id="user">
                                <?php $this->m_requestitems->select_user($data_user=NULL); ?>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label class="control-label">Status</label>
                            <select class="form-control" placeholder="Status" id="status">
                                <option value="1">Aktif</option>
                                <option value="2">Nonaktif</option>
                            </select>
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-default center-block" id="save_add_btn">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>