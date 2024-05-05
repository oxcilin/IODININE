 
 
const video = document.createElement("video");
const canvasElement = document.getElementById("qr-canvas");
const canvas = canvasElement.getContext("2d");
const hasil = document.getElementById("cari");
const qrResult = document.getElementById("qr-result");
const outputData = document.getElementById("outputData");
const btnScanQR = document.getElementById("btn-scan-qr");
const tgl = document.getElementById("tgl");
const nomor = document.getElementById("nomor");
const statu = document.getElementById("statu");
      let src = 'https://sutomo-mdn.sch.id/absensi/silakan.mp3';
    let audio = new Audio(src);

let scanning = false;

qrcode.callback = res => {
  if (res) {
   hasil.value=res  ;
  
  
  if (res=="YAYASAN PERGURUAN SUTOMO"){
      
      
      

    audio.play();




  alert("BERHASIL - SILAKAN MASUK");
   statu.value="true";
  document.getElementById("myBtn").click();
  
    scanning = false;

    video.srcObject.getTracks().forEach(track => {
      track.stop();
    });

    qrResult.hidden = false;
    canvasElement.hidden = true;
    btnScanQR.hidden = false;
  
  } else
  
  {
    alert("BARCODE TIDAK VALID");
      scanning = true;

    video.srcObject.getTracks().forEach(track => {
      track.start();
    });

    qrResult.hidden = true;
    canvasElement.hidden = false;
    btnScanQR.hidden = true;
      
      
      
  }
    
    
    
  }
};

btnScanQR.onclick = () => {
  navigator.mediaDevices
    .getUserMedia({ video: { facingMode: "environment" } })
    .then(function(stream) {
      scanning = true;
      qrResult.hidden = true;
      btnScanQR.hidden = true;
      canvasElement.hidden = false;
      video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
      video.srcObject = stream;
      video.play();
      tick();
      scan();
    });
};

function tick() {
  canvasElement.height = video.videoHeight;
  canvasElement.width = video.videoWidth;
  canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);

  scanning && requestAnimationFrame(tick);
}

function scan() {
  try {
    qrcode.decode();
  } catch (e) {
    setTimeout(scan, 300);
  }
}