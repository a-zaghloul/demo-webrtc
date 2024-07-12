@include('header', ['pageTitle' => 'Audio'])
<div class="row rounded-lg">
    <div class="col-4"></div>
    <div class="col border-bottom p-1 d-flex justify-content-center bg-light rounded-pill m-2">
        <button id="startRecording" type="button" class="btn btn-outline-success btn-block rounded-pill">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-record-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-8 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
            </svg> Start Recording
        </button>
    </div>
    <div class="col border-bottom p-1 d-flex justify-content-center bg-light rounded-pill m-2">
        <button id="stopRecording" type="button" class="btn btn-outline-danger btn-block rounded-pill" disabled>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stop-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M5 6.5A1.5 1.5 0 0 1 6.5 5h3A1.5 1.5 0 0 1 11 6.5v3A1.5 1.5 0 0 1 9.5 11h-3A1.5 1.5 0 0 1 5 9.5z"/>
            </svg> Stop
        </button>
    </div>
    <div class="col border-bottom p-1 d-flex justify-content-center bg-light rounded-pill m-2">
        <a id="downloadRecording" class="btn btn-outline-success btn-block rounded-pill" disabled>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-down-fill m-1 mr-2" viewBox="0 0 16 16">
                <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2m2.354 6.854-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5a.5.5 0 0 1 1 0v3.793l1.146-1.147a.5.5 0 0 1 .708.708"/>
            </svg> Download
        </a>
    </div>
    <div class="col-4"></div>
</div>
<div class="mt-4 row rounded-lg">
    <div class="col mx-aut d-flex justify-content-center">
        <audio id="audioPlayback" controls controlsList="nodownload" style="width:30vw;" class="border-bottom border-thick bg-secondary rounded-pill p-2"></audio>
    </div>
</div>
@include('footer')
