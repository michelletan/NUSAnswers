<div class="col-md-3 col-lg-3">
</div>
<div class="sidebar affix col-md-3 col-lg-3">
    <div class="row">
        <div class="col-md-6 col-lg-6">
        </div>
        <div class="sidebar-inner col-md-6 col-lg-6">
            <h5 class="text-uppercase">Questions</h5>
            <ul class="">
                <li><a href="">Popular</a></li>
                <li><a href="">New</a></li>
                <?php if ($is_logged_in) {?><li><a href="">My Questions</a></li><?php } ?>
            </ul>
            <h5 class="text-uppercase">Answers</h5>
            <ul class="">
                <li><a href="">Popular</a></li>
                <li><a href="">New</a></li>
                <?php if ($is_logged_in) {?><li><a href="">My Answers</a></li><?php } ?>
            </ul>
            <h5 class="text-uppercase">Tags</h5>
            <ul class="">
                <li><a href="">#cors</a></li>
                <li><a href="">#somereallylongtag</a></li>
                <li><a href="">#soc</a></li>
                <li><a href="">#cs3226</a></li>
            </ul>
        </div>
    </div>
</div>
