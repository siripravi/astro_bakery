<style>
    .modal-dialog {
        width: 562px;
        height: 750px;
    }
</style>.
<div class="card">
    <div class="card-header">
        <h4 class="title"></h4>
    </div>
    <div class="content" style="height: 100%; width:100%;background-color: #e6e6e6;  margin: 0px;">

        <iframe src="<?php echo $filename; ?>" frameborder="0" style="width: 100%; height: 1000px;" scrolling="no"
            onload="javascript:resizeIframe(this, 1000);"></iframe>

    </div>
</div>