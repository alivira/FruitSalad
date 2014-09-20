function httpGet(theUrl)
{
    var xmlHttp = null;

    xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", theUrl, false );
    xmlHttp.send( null );
    return xmlHttp.responseText;
}	

function httpPost(path, params) {
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
httpGet('start.php');
window.onbeforeunload = function(){ httpGet('end.php');}

function Runner(){
    var data;
    var sleepTime = 0;
}

//Runner class that handles computations
Runner.prototype.computeFunction = computeFunction;

Runner.prototype.getData = function(){
    return httpGet("tracker.php");
}

Runner.prototype.reportResult = function(result){
    result = {
        "value": result,
        "jobid": this.jobid
    };
    httpPost("tracker.php", result);
}

Runner.prototype.execute = function(){

    var that = this;
    var runUnit = function(){
        this.data = this.getData();
        var before = new Date(); before = before.getTime();
        var result = this.computeFunction(this.data);
        this.reportResult(result);
        var after = new Date(); after = after.getTime();
        var timeDiff = after - before;
        that.sleepTime = 1000 * timeDiff;
    }

    while(1){
        setTimeout(runUnit, sleepTime);
    }
}

// start runner
runner = new Runner();

// Start our heartbeat
var beat = function(){
}
setInterval(beat, 5);