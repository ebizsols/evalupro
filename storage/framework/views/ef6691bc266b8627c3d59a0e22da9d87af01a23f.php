<div class="tab-pane fade   " id="LandInfo" role="tabpanel">
    <div class="inner-panel-Main-div">
        <div class="panel panel-inverse">
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body inner-panel-padding">
                    <div class="tabbable">
                        <ul class="nav nav-tabs wizard">
<!--                            <li class="active"><a class="nav-link nav-item"
                                                  href="#LandInfoAddress" data-toggle="tab"
                                                  aria-controls="LandInfoAddress"
                                                  aria-expanded="false">Address</a>
                            </li>-->
<!--                            <li><a href="#LandInfoClassCategory" class="nav-link nav-item"
                                   data-toggle="tab"
                                   aria-controls="LandInfoClassCategory"
                                   aria-expanded="false">Class & Category</a></li>-->
                            <li class="active"><a href="#LandInfoMeasurements" class="nav-link nav-item"
                                   data-toggle="tab"
                                   aria-controls="LandInfoMeasurements"
                                   aria-expanded="false">Measurements</a></li>
<!--                            <li><a href="#LandInfoNeighbourhood" class="nav-link nav-item"
                                   data-toggle="tab"
                                   aria-controls="LandInfoNeighbourhood"
                                   aria-expanded="false">Neighbourhood</a></li>-->
<!--                            <li><a href="#UploadTab" class="nav-link nav-item" data-toggle="tab" aria-controls="UploadTab" aria-expanded="false">Uploads
                                </a></li>-->
                        </ul>

                    </div>
                    <div class="tab-content" id="myTabContent21">
                       
                        <!---LandInfoMeasurements -->
                        <div class="tab-pane fade  in active" id="LandInfoMeasurements">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Land size</label>
                                            <input type="text" onblur="calculationSizeOther(this.value)" name="landSize" id="landSize"
                                                   value="<?php echo e(isset($landSize)?$landSize:''); ?>"
                                                   class="form-control"
                                                   autocomplete="nope" placeholder="Enter Land size in <?php echo e($defaultMeasurementUnit); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Sizes in Meter sq</label>
                                            <input type="text" name="sizeMeterSQ" readonly="" id="sizeMeterSQ"
                                                   value="<?php echo e(isset($sizeMeterSQ)?$sizeMeterSQ:''); ?>"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Sizes in sq feet)</label>
                                            <input type="text" name="sizeSQFeet" readonly="" id="sizeSQFeet"
                                                   value="<?php echo e(isset($sizeSQFeet)?$sizeSQFeet:''); ?>"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Municipality cutting</label>
                                            <input type="text" name="municipalityCutting" id="municipalityCutting"
                                                   value="<?php echo e(isset($municipalityCutting)?$municipalityCutting:''); ?>"
                                                   class="form-control"
                                                   autocomplete="nope">
                                        </div>
                                    </div>
                                      <?php if(isset($LandShape[0]) && !empty($LandShape[0])): ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label"><?php echo e($LandShape[0]->title); ?></label>
                                            <select name="landInfoLandShape" class="form-control">
                                                <option value="">--select One--</option>
                                                <?php $__currentLoopData = $LandShape[0]->weightageCategoryItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shape): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if(isset($landShapeMeta) && !empty($landShapeMeta) && $landShapeMeta[0]==$shape->id): ?> selected="selected" <?php endif; ?> value="<?php echo e($shape->id); ?>"><?php echo e($shape->title); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                   
                                    <?php endif; ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Structure Type</label>
                                            <input type="text" name="land_structure_type" class="form-control" id="land_structure_type" value="<?php echo e(isset($landStructureType)?$landStructureType:'0'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="control-label">Dimension</label>
                                        <div class="pb-10">
                                            <button type="button" class="btn btn-primary" id="LandInfoDimensionAddBtn">Add New Row</button>
                                        </div>
                                        <table id="LandInfoDimensionTable" class="table table-striped table-row-bordered gy-5 gs-7">
                                        <thead>
                                                <tr class="fw-bold fs-6 text-gray-800">
                                                        <th>Label</th>
                                                        <th>Value</th>
                                                        
                                                </tr>
                                        </thead>
                                        <tfoot>
                                            <?php if(isset($dimensionsMeta) && !empty($dimensionsMeta)): ?>
                                            <?php $__currentLoopData = $dimensionsMeta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dimObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><input type="hidden" name="label[]" value="<?php echo e($dimObj['label']); ?>"><?php echo e($dimObj['label']); ?></td>
                                                <td><input type="hidden" name="value[]" value="<?php echo e($dimObj['value']); ?>"><?php echo e($dimObj['value']); ?></td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </tfoot>
                                    </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!---LandInfoMeasurements -->

                        
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .cursor-pointer {
        cursor: pointer;
    }
</style>
<?php $__env->startPush('footer-script'); ?>

    <script !src="">

        $('.openModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var recipient = button.data('whatever');
            var modal = $(this);
            modal.find('.modal-title').text(recipient);
        })
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e($googleApi); ?>&callback=initialize" async defer></script>
<!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBD6kkurmjYtikPMoyinl8R0OTheMOIg30"></script>-->
<script type="text/javascript">
        function initialize() {
            // Creating map object
            var latitude=$("#latitude").val();
            var longitude =$("#longitude").val();
            if(latitude!='' && latitude>0 && longitude!='' && longitude>0)
            {
                 var map = new google.maps.Map(document.getElementById('map_canvas'), {
                zoom: 12,
                center: new google.maps.LatLng(latitude, longitude),
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });
                // creates a draggable marker to the given coords
                var vMarker = new google.maps.Marker({
                    position: new google.maps.LatLng(latitude, longitude),
                    draggable: true
                });
            }
            else
            {
                 var map = new google.maps.Map(document.getElementById('map_canvas'), {
                zoom: 12,
                center: new google.maps.LatLng(31.4832209, 74.0541922),
                mapTypeId: google.maps.MapTypeId.ROADMAP
                });
                // creates a draggable marker to the given coords
                var vMarker = new google.maps.Marker({
                    position: new google.maps.LatLng(31.4832209, 74.0541922),
                    draggable: true
                });
            }


            google.maps.event.addListener(vMarker, 'dragend', function (evt) {
                $("#latitude").val(evt.latLng.lat().toFixed(6));
                $("#longitude").val(evt.latLng.lng().toFixed(6));
                map.panTo(evt.latLng);
            });
            map.setCenter(vMarker.position);
            vMarker.setMap(map);
        }
        function calculationSizeOther(landSize)
        {
            var defaultUnite='<?php echo e($defaultMeasurementUnit); ?>';
            if(defaultUnite=='meter')
            {
                $('#sizeMeterSQ').val(landSize);
                $('#sizeSQFeet').val(landSize*3.28084);
            }
            else if(defaultUnite=='feet')
            {
                $('#sizeMeterSQ').val(landSize/3.28084);
                $('#sizeSQFeet').val(landSize);
            }
        }
    </script>
<?php $__env->stopPush(); ?><?php /**PATH /home/evalupro/public_html/Modules/Valuation/Resources/views/Admin/Property/PropertyFormInclude/LandInfo.blade.php ENDPATH**/ ?>