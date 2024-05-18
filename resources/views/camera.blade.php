@include('header')
<div class="p-4">

    <h1>Camera...</h1>
    <div class="container">
        <div class="m-1 row">
            <div class="col-8 mx-auto">
                <button id="openCamera" type="button" onclick="playVideoFromCamera('cameraOutput');" class="btn btn-success btn-block">
                    Open Camera
                </button>
            </div>
        </div>
        <div class="m-1 row">
            <div class="col-8 mx-auto  border border-danger">
            <video id="cameraOutput" class="" autoplay playsinline>
                    <source src="video/contents.mp4" type="video/mp4" />
                </video>
            </div>
        </div>
    </div>
</div>
@include('footer')
