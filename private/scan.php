<div class="collapsible-body" style="display: block;">
	  <p>    
	    	 </p><p> ANDA  MEMENUHI SYARAT UNTUK MENGIKUTI PTMT PADA TANGGAL :  24 September 2023</p>
	  <p></p> 
	  
	 <script src="qr_packed.js"></script>
				
				 
				<form id="your_form" onsubmit="yourFunction()">
				 <input type="text" id="cari" name="cari" style="display:none">
			
				  <input name="tgl" id="tgl" value="2023-09-24" style="display:none">  
                  <input name="nomor" id="nomor" value="1303" style="display:none"> 
                   <input name="statu" id="statu" value="" style="display:none"> 
                  	 <input type="submit" id="myBtn" value="Submit" style="display:none">
			
				
			 
                <script>
                    function yourFunction(){
                    if (document.getElementsByName("cari")[0].value == "YAYASAN PERGURUAN SUTOMO")
                    {
                        var your_form = document.getElementById('your_form');
                        your_form.action = "" ;
                        
                        
                        
                    } else {
                        alert ("BARCODE TIDAK VALID");
                         
                    }
                    
                    
                }
                    
                    
                </script>
				       
	             </form> 
				    
				    
				    
				<div class="col s12">
				 
				  <a id="btn-scan-qr"><img class="col s2 btn waves-effect waves-light z-depth-5 blue accent-2 tooltipped" src="qrcode.png" data-position="right" data-tooltip="Scan Barcode untuk melanjutkan" data-tooltip-id="6e723d2e-686a-1fe1-39d4-75154a0bf393"></a><a>
				
				</a></div><a>   
				
				
				
				<div id="qr-result" hidden="">
					<span id="outputData"></span>
				  </div> 
				<canvas hidden="" id="qr-canvas"></canvas>

				  
				  
				  <br>
				  
 	   
				 <script src="qrCodeScanner.js"></script>   
			<br><br>
			
			
						
			
						
					 
					 
					 
					 
					 
                
                
        	  
	                 	  
	  
	  </a></div>