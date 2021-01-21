    <div class="content-body">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <a href="<?php echo base_url('business') ?>" class="mr-5">
                        <?php echo $this->lang->line('Business') ?>
                    </a> 
                    <a href="<?php echo base_url('su/business/create') ?>" class="btn btn-primary btn-sm rounded">
                        <?php echo $this->lang->line('Add new') ?>  <?php echo $this->lang->line('Business') ?>
                    </a> 
                </h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li>
                            <a data-action="collapse"><i class="ft-minus"></i></a>
                        </li>
                        <li>
                            <a data-action="expand"><i class="ft-maximize"></i></a>
                        </li>
                        <li>
                            <a data-action="close"><i class="ft-x"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-content">
                <div id="notify" class="alert alert-success" style="display:none;">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>

                    <div class="message"></div>
                </div>
                <div class="card-body">
                    <table id="businessTable" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                        width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo $this->lang->line('Business Name') ?></th>
                            <th>Business <?php echo $this->lang->line('Address') ?></th>
                            <th>Website</th>
                            <th>Owner <?php echo $this->lang->line('Name') ?></th>
                            <th>Owner <?php echo $this->lang->line('Email') ?></th>
                            <th>Owner <?php echo $this->lang->line('Phone') ?></th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $business) { ?>   
                                <tr>
                                    <td><?php echo $business->id; ?></td>
                                    <td><?php echo $business->business_name; ?></td>
                                    <td><?php echo $business->business_addr; ?></td>
                                    <td><?php echo $business->business_website; ?></td>
                                    <td><?php echo $business->owner_name; ?></td>
                                    <td><?php echo $business->owner_email; ?></td>
                                    <td><?php echo $business->owner_mobno; ?></td>
                                    <td>
                                        <?php if ($business->status == '1') { ?>
                                            <span class="badge badge-success">Active</span>
                                        <?php }else { ?>
                                            <span class="badge badge-danger">Inactive</span>
                                        <?php } ?>   
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="<?php echo base_url('su/business/edit/'.$business->id) ?>"><i class="fa fa-pencil"> </i> Edit</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    $(document).ready(function () {
        $('.summernote').summernote({
            height: 100,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['fullscreen', ['fullscreen']],
                ['codeview', ['codeview']]
            ]
        });

        $('#businessTable').DataTable({
            'stateSave': true,
            responsive: true,
            <?php datatable_lang();?>
            'order': [],
            'columnDefs': [
                {
                    'targets': [0],
                    'orderable': false,
                },
            ], dom: 'Blfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    footer: true,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                }
            ],
        });
    });
</script>
