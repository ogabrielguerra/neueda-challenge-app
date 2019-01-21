<?php require 'header.php';?>
<body>
<div id="super-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-right">
                <p>NEUEDA CHALLENGE | Gabriel Guerra</p>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</div>
<div id="header">
    <div class="container">
        <div class="row mt30">
            <div class="col-md-3">
                <a href="/" title="Shrimp Home">
                    <img src="assets/images/shrimp-logo.png" alt="Shrimp" style="width: 100%;"/></a>
            </div>
            <div class="col-md-9 text-right">
                <ul id="main-nav" class="d-none d-sm-block">
                    <li><a href="/">SHRINK YOUR LINK</a></li>
                    <li><a href="/features">YOUR LINKS</a></li>
                    <li><a href="/features">TOP 20</a></li>
                    <li><a href="/contact">CONTACT</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container box-form" style="margin-top: 100px; padding-bottom: 40px;">
    <div class="row">
        <div class="col-md-12">

            <!-- LOADING -->
            <div id="loading">
                <img src="assets/images/loading.gif"/>
                <span>LOADING...</span>
            </div>
            <!-- *** -->

            <!-- STEP 1 -->
            <form id="formUserUrl">
                <div id="step1">
                    <div class="row" style="min-height: 200px;">
                        <div class="col-md-9" style="min-height: 100%;">
                            <h3 class="mr60 patch"></h3>
                            <input type="text" class="formUrl formStep1" name="userUrl" id="userUrl" placeholder="Place your url here" value=""/>
                        </div>
                        <div class="col-md-3" style="height: 200px;">
                            <button id="trigger" class="custom-buttom"><span>Shrink</span></button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- *** -->

            <!-- STEP 2 -->
            <div id="step2">
                <div class="row" style="min-height: 200px;">
                    <div class="col-md-9" style="min-height: 100%;">
                        <h3 class="mr60 patch">Here's your url</h3>
                        <div id="shrinkUrl"><input id="shrinkUrlField" class="formUrl formStep2" placeholder="http://yoururl/shrinked/yay" value="" /></div>
                    </div>
                    <div class="col-md-3" style="height: 200px; padding-top: 34px;">
                        <button id="copyUrl" class="custom-buttom"><span>Copy Url</span></button>
                    </div>
                </div>
            </div>
            <!-- *** -->
        </div>
    </div>
</div>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2>Last Urls</h2>
                <div id="container-last-urls">
                    <p>Loading...</p>
                </div>
            </div>
            <div class="col-md-4">
                <h2>Top views</h2>
                <div id="container-top-view-urls">
                    <p>Loading...</p>
                </div>
            </div>
            <div class="col-md-4">
                <h2>Shrimp Stats</h2>
                <div id="container-stats">
                    <p>Loading...</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="modal-feedback" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="modal-message"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>