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
        // console.log(devices[i]);
    }
    return devices;
}

async function playVideoFromCamera(elementId = "localVideo") {
    try {
        const constraints = {
            'audio': false,
            'video': true
        };
        const stream = await navigator.mediaDevices.getUserMedia(constraints);
        // const videoElement = document.querySelector('video#localVideo');
        const videoElement = document.getElementById(elementId);
        videoElement.srcObject = stream;
    } catch(error) {
        console.error('Error opening video camera.', error);
    }
}
