async function logConnectedDevices() {
    const devices = await navigator.mediaDevices.enumerateDevices();
    var ul = document.getElementById("devices");
    while (ul.firstChild) {
        ul.removeChild(ul.lastChild);
    }
    for (let i = 0; i < devices.length; i++) {
        var li = document.createElement("li");
        li.appendChild(document.createTextNode(devices[i].kind + " - " + devices[i].label));
        ul.appendChild(li);
    }
    return devices;
}

async function playVideoFromCamera(elementId = "cameraOutput") {
    openCloseBtn = document.getElementById("openCamera");
    const videoElement = document.getElementById(elementId);
    if(openCloseBtn.innerText === "Open Camera") {
        try {
            const constraints = {
                'audio': false,
                'video': true
            };
            const stream = await navigator.mediaDevices.getUserMedia(constraints);
            videoElement.srcObject = stream;
            videoElement.onloadedmetadata = () => {
                videoElement.play();
              };

            openCloseBtn.innerText = "Close Camera";
            openCloseBtn.className = "btn btn-dark btn-block text-success";
            document.getElementById("cameraFooter").style.display = '';

        } catch(error) {
            console.error('Error opening video camera.', error);
        }
    } else {
        if (videoElement.srcObject) {
            // Stop all tracks to turn off the camera
            videoElement.srcObject.getTracks().forEach(track => track.stop());
            videoElement.srcObject = null;
            document.getElementById("isBackgroundRemoved").value = "";
            canvasElement = document.getElementById("canvas")
            canvasElement.value = null;
            ctx = canvasElement.getContext('2d');
            ctx.clearRect(0, 0, canvasElement.width, canvasElement.height);
          }
        openCloseBtn.innerText = "Open Camera";
        openCloseBtn.className = "btn btn-light btn-block text-success";
        document.getElementById("cameraFooter").style.display = 'none';
    }

}

function segmentPersons() {
    tempCanvasCtx.drawImage(video, 0, 0, videoWidth, videoHeight);
    if (previousSegmentationComplete) {
        previousSegmentationComplete = false;
        // Now classify the canvas image we have available.
        model.segmentPerson(tempCanvas, segmentationProperties)
            .then(segmentation => {
                    processSegmentation(segmentation);
                    previousSegmentationComplete = true;
            });
    }
    //Call this function repeatedly to perform segmentation on all frames of the video.
    window.requestAnimationFrame(segmentPersons);
}

function processSegmentation(segmentation) {
    var imgData = tempCanvasCtx.getImageData(0, 0, webcamCanvas.width, webcamCanvas.height);
    //Loop through the pixels in the image
    for(let i = 0; i < imgData.data.length; i+=4) {
        let pixelIndex = i/4;
        //Make the pixel transparent if it does not belong to a person using the body-pix
        //model's output data array. This removes all pixels corresponding to the
        //background.
        if(segmentation.data[pixelIndex] == 0) {
          imgData.data[i + 3] = 0.4;
        }
      }
      //Draw the updated image on the canvas
      webcamCanvasCtx.putImageData(imgData, 0, 0);
}

function blurBackground (elementId = "cameraOutput", blurPercentage = 50) {
    removeBackground(elementId, blurPercentage);
}

function changeBackgroundColor(elementId = "cameraOutput", bgColor = "#ffffff") {
    removeBackground(elementId, 255, hexToRgb(bgColor));
}
async function removeBackground(elementId = "cameraOutput", blurPercentage = 0, bgColor = false) {
    videoElement = document.getElementById(elementId);
    isBackgroundRemoved = Boolean(document.getElementById("isBackgroundRemoved").value);
    if (!videoElement) {
      console.error('Video element not found.');
      return;
    }

    // Load the BodyPix model
    const net = await bodyPix.load();
    // Get the canvas element and set its size to match the video
    canvasElement = document.getElementById('canvas');
    canvasElement.width = 320;
    canvasElement.height = 250;
    const ctx = canvasElement.getContext('2d');
    const segmentBackground = async () => {
      if (!isBackgroundRemoved) return;
      // Perform segmentation
      const segmentation = await net.segmentPerson(videoElement);

      // Get the image data from the video element
      ctx.drawImage(videoElement, 0, 0, 320, 250);
      const imageData = ctx.getImageData(0, 0, canvasElement.width, canvasElement.height);

      // Process the segmentation mask
      const { data: pixelData } = segmentation;
      const { data: imageDataData } = imageData;

      for (let i = 0; i < pixelData.length; i++) {
        if (pixelData[i] === 0) {
          // Set background pixels to transparent
          if(bgColor) {
            imageDataData[i * 4] = bgColor[0];
            imageDataData[i * 4 + 1] = bgColor[1];
            imageDataData[i * 4 + 2] = bgColor[2];
          } else {
            imageDataData[i * 4 + 3] = blurPercentage;
          }
        }
      }

      // Put the processed image data back on the canvas
      ctx.putImageData(imageData, 0, 0);
      requestAnimationFrame(segmentBackground);
    };

    document.getElementById("isBackgroundRemoved").value = "true";
    isBackgroundRemoved = Boolean(document.getElementById("isBackgroundRemoved").value);
    canvasElement.style.display = '';
    segmentBackground();
  }

  async function clearCanvas() {
    canvasElement = document.getElementById("canvas");
    canvasElement.value = null;
    document.getElementById("canvas").style.display = 'none';
    document.getElementById("isBackgroundRemoved").value = "";
    ctx = canvasElement.getContext('2d');
    ctx.clearRect(0, 0, canvasElement.width, canvasElement.height);
  }

  function hexToRgb(hex) {
    const bigint = parseInt(hex.slice(1), 16);
    const r = (bigint >> 16) & 255;
    const g = (bigint >> 8) & 255;
    const b = bigint & 255;
    return [r, g, b];
  }


  function toggleEffectsDiv() {
    effectsDiv = document.getElementById('effectsDiv').style.display;
    if(effectsDiv == 'none') {
        document.getElementById('effectsDiv').style.display = '';
        document.getElementById('stopEffectsDiv').style.display = 'none';
    } else {
        document.getElementById('effectsDiv').style.display = 'none';
        document.getElementById('stopEffectsDiv').style.display = '';
    }
  }

  function takeSnapshotCanvas() {
    canvasElement = document.getElementById("canvas");
    if (!canvasElement) return;
    const link = document.createElement('a');
    link.href = canvasElement.toDataURL('image/png');
    link.download = 'modifiedsnapshot.png';
    link.click();
  }

  function takeSnapshotVideo() {
    videoElement = document.getElementById("cameraOutput");
    if (!videoElement) return;
    const canvas = document.createElement('canvas');
    canvas.width = videoElement.videoWidth;
    canvas.height = videoElement.videoHeight;
    const ctx = canvas.getContext('2d');
    ctx.drawImage(videoElement, 0, 0, canvas.width, canvas.height);
    const link = document.createElement('a');
    link.href = canvas.toDataURL('image/png');
    link.download = 'originalsnapshot.png';
    link.click();
  }

  (function() {
    let mediaRecorder;
    let audioChunks = [];

    document.getElementById('startRecording').addEventListener('click', async () => {
      const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
      mediaRecorder = new MediaRecorder(stream);

      mediaRecorder.ondataavailable = event => {
        audioChunks.push(event.data);
      };

      mediaRecorder.onstop = () => {
        const audioBlob = new Blob(audioChunks, { type: 'audio/wav' });
        const audioUrl = URL.createObjectURL(audioBlob);
        const audioPlayback = document.getElementById('audioPlayback');
        const downloadButton = document.getElementById('downloadRecording');

        audioPlayback.src = audioUrl;
        // audioPlayback.style.display = 'block';

        downloadButton.href = audioUrl;
        downloadButton.download = 'recording.wav';
        // downloadButton.style.display = 'block';
      };

      mediaRecorder.start();
      document.getElementById('startRecording').disabled = true;
      document.getElementById('downloadRecording').disabled = true;
      document.getElementById('stopRecording').disabled = false;

    });

    document.getElementById('stopRecording').addEventListener('click', () => {
      mediaRecorder.stop();
      document.getElementById('stopRecording').disabled = true;
      document.getElementById('downloadRecording').disabled = false;
      document.getElementById('startRecording').disabled = false;
    });
  })();
