@include('header', ['pageTitle' => 'Camera'])
    <div class="container">
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
        <div class="m-4 row border border-dark rounded-lg bg-light">
            <div class="col mx-auto p-4 d-flex justify-content-center border border-dark">
                <video id="cameraOutput" class="m-0" autoplay playsinline width="320" height="250">
                    <source src="" type="video/mp4" />
                </video>
            </div>
            <div class="col mx-auto p-4 d-flex justify-content-center border border-dark">
                <canvas id="canvas" width="320" height="250" class="m-0"></canvas>
            </div>
        </div>
        <div id="cameraFooter" style="display:none">
            <div id="effectsDiv" class="m-4 p-2 row  border-info rounded-lg bg-light">
                <div class="col mx-auto d-flex justify-content-start border-right">
                    <button id="removeBackground" type="button" onclick="clearCanvas();removeBackground('cameraOutput');" class="btn btn-light btn-block text-success">
                        Remove Background
                    </button>
                </div>
                <div class="col mx-auto d-flex justify-content-center border-left border-right">
                    <button id="blurBackground" type="button" onclick="clearCanvas();blurBackground('cameraOutput', 30);" class="btn btn-light btn-block text-success">
                        Blur Background
                    </button>
                </div>
                <div class="col mx-auto d-flex justify-content-end border-left">
                    <input type="color" id="bgcolor" name="bgcolor" value="#28A745" onchange="clearCanvas();changeBackgroundColor('cameraOutput', this.value);" class="btn btn-light form-control form-control-color btn-block text-success">
                </div>
            </div>
            <div id="stopEffectsDiv" class="m-4 p-2 row" >
                <div class="col mx-auto d-flex justify-content-start"></div>
                <div class="col mx-auto d-flex justify-content-center border border-info rounded-lg p-2">
                    <button id="stop" type="button" onclick="clearCanvas();" class="btn btn-dark btn-block text-danger">
                        Stop Effects
                    </button>
                </div>
                <div class="col mx-auto d-flex justify-content-end"></div>
            </div>
        </div>
    </div>
</div>
@include('footer')
