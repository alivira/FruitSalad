function httpGet(theUrl)
{
    var xmlHttp = null;

    xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", theUrl, false );
    xmlHttp.send( null );
    return xmlHttp.responseText;
}

httpGet('start.php');
window.onbeforeunload = function(){ httpGet('end.php');}

function Runner(){
    var data;
    var sleepTime = 0;
}

Runner.prototype.computeFunction = computeFunction;

Runner.prototype.getData = function(){

}

Runner.prototype.reportResult = function(result){

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

runner = new Runner();


var beat = function(){
}
setInterval(beat, 5);