/*------------------------------------------------------------------

  Server Time

-------------------------------------------------------------------*/
function serverTime(){
	var date = new Date();
	var nhour = date.getUTCHours() + 3
	,	nmin = date.getUTCMinutes()
	,	nsec = date.getUTCSeconds();
	
	if (nhour >= 24)
		nhour = nhour - 24;
	if(nmin <= 9)
		nmin = "0"+nmin;
	if(nsec <= 9)
		nsec = "0"+nsec;
	
	document.getElementById('servertime').innerHTML=""+nhour+":"+nmin+":"+nsec+"";
}

// The intervals (in milliseconds) on how often to execute the code
setInterval(serverTime,1000);