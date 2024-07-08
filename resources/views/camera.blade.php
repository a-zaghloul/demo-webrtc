@include('header')
<div class="p-4">

    <h1>Camera...</h1>
    <div class="container">
        <div class="m-1 row">
            <div class="col-8 mx-auto">
                <button id="openCamera" type="button" onclick="playVideoFromCamera('cameraOutput');" class="btn btn-success btn-block btn-lg">
                    Open Camera
                </button>
                <input type="hidden" id="isBackgroundRemoved" value="false"/>
            </div>
        </div>
        <div class="m-4 row border border-danger rounded-lg">
            <div class="col mx-auto p-4 d-flex justify-content-center">
                <video id="cameraOutput" class="border m-0" autoplay playsinline width="320" height="250">
                    <source src="" type="video/mp4" />
                </video>
            </div>
            <div class="col mx-auto p-4 d-flex justify-content-center">
                <canvas id="canvas" width="320" height="250" class="border m-0"></canvas>
            </div>
        </div>
        <div class="m-4 p-2 row border border-danger rounded-lg">
            <div class="col mx-auto d-flex justify-content-start">
                <button id="removeBackground" type="button" onclick="clearCanvas();removeBackground('cameraOutput');" class="btn btn-success btn-block">
                    Remove Background
                </button>
            </div>
            <div class="col mx-auto d-flex justify-content-center">
                <button id="stop" type="button" onclick="clearCanvas();" class="btn btn-danger btn-block">
                    Stop
                </button>
            </div>
            <div class="col mx-auto d-flex justify-content-end">
                <button id="blurBackground" type="button" onclick="clearCanvas();blurBackground('cameraOutput', 100);" class="btn btn-warning btn-block">
                    Blur Background
                </button>
            </div>
        </div>
    </div>
</div>
@include('footer')
