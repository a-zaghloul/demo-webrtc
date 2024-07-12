@include('header', ['pageTitle' => 'Camera'])
<div class="m-1 row">
    <div class="col mx-auto d-flex justify-content-start"></div>
    <div class="col mx-auto p-2 rounded-lg border border-dark">
        <button id="openCamera" type="button" onclick="playVideoFromCamera('cameraOutput');" class="btn btn-light btn-block text-success">
            Open Camera
        </button>
        <input type="hidden" id="isBackgroundRemoved" value=""/>
    </div>
    <div class="col mx-auto d-flex justify-content-start"></div>
</div>
<div class="mr-4 ml-4 mt-4 row rounded-lg">
    <div class="col-3"></div>
    <div class="col mx-auto p-4 d-flex justify-content-center border border-dark border-right-0 bg-light">
        <video id="cameraOutput" class="m-0" autoplay playsinline width="320" height="250">
            <source src="" type="video/mp4" />
        </video>
    </div>
    <div class="col mx-auto p-4 d-flex justify-content-center border border-dark bg-light">
        <canvas id="canvas" width="320" height="250" class="m-0"></canvas>
    </div>
    <div class="col-3"></div>
</div>
<div id="cameraFooter" style="display:none">
    <div class="mr-4 ml-4 row rounded-lg">
        <div class="col-3"></div>
        <div class="col border-bottom border-thick">
            <button id="canvassnap" type="button" onclick="takeSnapshotVideo();" class="btn btn-outline-success mx-auto d-flex justify-content-center m-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-down-fill m-1 mr-2" viewBox="0 0 16 16">
                    <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2m2.354 6.854-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5a.5.5 0 0 1 1 0v3.793l1.146-1.147a.5.5 0 0 1 .708.708"/>
                </svg>
                Snapshot
            </button>
        </div>
        <div class="col border-bottom border-thick">
            <button id="videosnap" type="button" onclick="takeSnapshotCanvas();" class="btn btn-outline-success mx-auto d-flex justify-content-center m-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-down-fill m-1 mr-2" viewBox="0 0 16 16">
                    <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2m2.354 6.854-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5a.5.5 0 0 1 1 0v3.793l1.146-1.147a.5.5 0 0 1 .708.708"/>
                </svg>
                Snapshot
            </button>
        </div>
        <div class="col-3"></div>
    </div>
    <div id="effectsDiv" class="m-4 p-2 row border-info rounded-lg">
        <div class="col-3"></div>
        <div class="col mx-auto d-flex justify-content-start border-right bg-light">
            <button id="removeBackground" type="button" onclick="clearCanvas();removeBackground('cameraOutput');" class="btn btn-light btn-block text-success">
                Remove Background
            </button>
        </div>
        <div class="col mx-auto d-flex justify-content-center border-left border-right bg-light">
            <button id="blurBackground" type="button" onclick="clearCanvas();blurBackground('cameraOutput', 30);" class="btn btn-light btn-block text-success">
                Blur Background
            </button>
        </div>
        <div class="col mx-auto d-flex justify-content-end border-left bg-light">
            <input type="color" id="bgcolor" name="bgcolor" value="#28A745" onchange="clearCanvas();changeBackgroundColor('cameraOutput', this.value);" class="btn btn-light form-control form-control-color btn-block text-success">
        </div>
        <div class="col-3"></div>
    </div>
    <div id="stopEffectsDiv" class="m-4 p-2 row" >
        <div class="col mx-auto d-flex justify-content-start"></div>
        <div class="col mx-auto d-flex justify-content-center border border-info rounded-lg p-2">
            <button id="stop" type="button" onclick="clearCanvas();" class="btn btn-dark btn-block text-success">
                Stop Effects
            </button>
        </div>
        <div class="col mx-auto d-flex justify-content-end"></div>
    </div>
</div>
@include('footer')
