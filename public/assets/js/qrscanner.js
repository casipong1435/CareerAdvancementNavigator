function domReady(fn){
    if (document.readyState === "complete" || document.readyState === "interactive"){
        setTimeout(fn,1)
    }else{
        document.addEventListener("DOMContentLoaded", fn)
    }
}

domReady(function(){
    var myqr = document.getElementById('you-qr-result')
    var lastResult,CountResults = 0;

    function onScanSuccess(decodeText,decodeResult){
        if (decodeText !== decodeResult){
            ++CountResults;
            lastResult = decodeResult;
            
            var result = decodeText,decodeResult;
            window.open(result, '_blank');

            myqr.innerHTML = 'you scan ${countResults} : ${decodeText}'
        }
    }

    var htmlscanner = new Html5QrcodeScanner(
        "my-qr-reader",{fps:10,qrbox:250})

        htmlscanner.render(onScanSuccess)
})