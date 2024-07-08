var _stop = false;
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

async function playVideoFromCamera(elementId = "localVideo") {
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
            openCloseBtn.className = "btn btn-danger btn-block";

        } catch(error) {
            console.error('Error opening video camera.', error);
        }
    } else {
        if (videoElement.srcObject) {
            // Stop all tracks to turn off the camera
            videoElement.srcObject.getTracks().forEach(track => track.stop());
            videoElement.srcObject = null;
            document.getElementById("isBackgroundRemoved").value = false;
            canvasElement = document.getElementById("canvas")
            canvasElement.value = null;
            ctx = canvasElement.getContext('2d');
            ctx.clearRect(0, 0, canvasElement.width, canvasElement.height);

          }
        openCloseBtn.innerText = "Open Camera";
        openCloseBtn.className = "btn btn-success btn-block";
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

function blurBackground (elementId = "localVideo", blurPercentage = 50) {
    removeBackground(elementId, blurPercentage);
}
async function removeBackground(elementId = "localVideo", blurPercentage = 0) {
    videoElement = document.getElementById(elementId);
    _stop = false;
    isBackgroundRemoved = document.getElementById("isBackgroundRemoved");
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
      if (!isBackgroundRemoved.value) return;

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
          imageDataData[i * 4 + 3] = blurPercentage;
        }
      }

      // Put the processed image data back on the canvas
      ctx.putImageData(imageData, 0, 0);

      if(! _stop) {
        requestAnimationFrame(segmentBackground);
      }
    };

    isBackgroundRemoved.value = true;
    canvasElement.style.display = 'block';
    segmentBackground();
  }

  function clearCanvas() {
    _stop = true;
    canvasElement = document.getElementById('canvas');
    canvasElement.width = 320;
    canvasElement.height = 250;
    const ctx = canvasElement.getContext('2d');
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    canvasElement.style.display = 'none';
    setTimeout(tempFunction, 10000);
    // setTimeout(myGreeting, 5000);
  }

  function tempFunction() {
    console.log('stopped...');
  }
