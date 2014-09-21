computeFunction = function(data){
    var factorArray = [];
    var jobId = data.jobid;
    var jobdata = data.jobdata;
    var jobdataArray = data.split(",");
    var number = jobdataArray[0]
    var min = jobdataArray[1]
    var max = jobdataArray[2]

    for (var i=min;i<=max;i++){
        if (number % i == 0){
            factorArray.push(i);
        }
    }
    return factorArray;
}

function httpGet(theUrl)
{
    var xmlHttp = null;

    xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", theUrl, false );
    xmlHttp.send( null );
    return xmlHttp.responseText;
}	

function httpPost(path, data) {
    $.ajax({
        type: "POST",
        url: path,
        data: JSON.stringify(data),
       	contentType: "application/json",
    	success: function() {console.log("Sent data!");}
    });
    return;

    var form = document.createElement("form");
    form.setAttribute("method", "post");
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
         }
    }
    document.body.appendChild(form);
    form.submit();
}


//Define a start and stop
httpGet('../start.php');
window.onbeforeunload = function(){ httpGet('../end.php');}

function Runner(){
    var data, jobid;
    var sleepTime = 0;
}

//Runner class that handles computations
Runner.prototype.computeFunction = computeFunction;

Runner.prototype.getData = function(){
    this.data = JSON.parse(httpGet("../tracker.php"));
    this.jobid = this.data.jobid;
    return this.data !== "";
}

Runner.prototype.reportResult = function(result){
    result = {
        "value": result,
    };
    httpPost("../tracker.php?jobid=" + this.jobid, result);
}


Runner.prototype.computeFunction = function() {return "Some result";};
Runner.prototype.execute = function(){

    var that = this;
    var runUnit = function(){
        if (!that.getData()) {
		return;
	}
        
        var before = new Date(); before = before.getTime();
        var result = that.computeFunction(that.data);
        that.reportResult(result);
        var after = new Date(); after = after.getTime();
        that.sleepTime = after - before;
    }

    runUnit();
    setInterval(runUnit, this.sleepTime);

}

//Create pointers to text fields to update
score = document.getElementById("score");
currentTime = new Date(); currentTime = currentTime.getTime();
var time = function(){
    timeSpent = document.getElementById("time");
    var newTime = new Date(); newTime = newTime.getTime();
    tDiff = (newTime - currentTime)/1000;
    timeSpent.innerHTML = parseInt(tDiff);
}
setInterval(time, 30);



// start runner
runner = new Runner();
runner.execute();



// Start our heartbeat
var beat = function(){
    httpGet("../heartbeat.php");
}
setInterval(beat, 5000);
