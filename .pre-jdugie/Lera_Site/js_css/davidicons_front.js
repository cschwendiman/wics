function getbanner() {  banner = new MakeArray(100);  numbanner = 12;  // number of images  
banner[0] = "<img src=http://studentorgs.utexas.edu/usbc/imgs/banner/01.gif width=\"610\" height=\"50\" border=\"0\" alt=\"USBC\">"  
banner[1] = "<img src=http://studentorgs.utexas.edu/usbc/imgs/banner/02.gif width=\"610\" height=\"50\" border=\"0\" alt=\"USBC\">"  
banner[2] = "<img src=http://studentorgs.utexas.edu/usbc/imgs/banner/03.gif width=\"610\" height=\"50\" border=\"0\" alt=\"USBC\">"  
banner[3] = "<img src=http://studentorgs.utexas.edu/usbc/imgs/banner/04.gif width=\"610\" height=\"50\" border=\"0\" alt=\"USBC\">"  
banner[4] = "<img src=http://studentorgs.utexas.edu/usbc/imgs/banner/05.gif width=\"610\" height=\"50\" border=\"0\" alt=\"USBC\">"    
banner[5] = "<img src=http://studentorgs.utexas.edu/usbc/imgs/banner/06.gif width=\"610\" height=\"50\" border=\"0\" alt=\"USBC\">"          
banner[6] = "<img src=http://studentorgs.utexas.edu/usbc/imgs/banner/07.gif width=\"610\" height=\"50\" border=\"0\" alt=\"USBC\">"  
banner[7] = "<img src=http://studentorgs.utexas.edu/usbc/imgs/banner/08.gif width=\"610\" height=\"50\" border=\"0\" alt=\"USBC\">"  
banner[8] = "<img src=http://studentorgs.utexas.edu/usbc/imgs/banner/09.gif width=\"610\" height=\"50\" border=\"0\" alt=\"USBC\">"  
banner[9] = "<img src=http://studentorgs.utexas.edu/usbc/imgs/banner/10.gif width=\"610\" height=\"50\" border=\"0\" alt=\"USBC\">"  
banner[10] = "<img src=http://studentorgs.utexas.edu/usbc/imgs/banner/11.gif width=\"610\" height=\"50\" border=\"0\" alt=\"USBC\">"  
banner[11] = "<img src=http://studentorgs.utexas.edu/usbc/imgs/banner/12.gif width=\"610\" height=\"50\" border=\"0\" alt=\"USBC\">"             
	var now = new Date()      
        var sec = now.getSeconds()             
return banner[sec % numbanner];  }  function MakeArray(n)   {     this.length = n;     for (var i = 1; i <= n; i++) {       this[i] = 0 }    return this   };