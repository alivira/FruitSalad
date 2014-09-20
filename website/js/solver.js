function Runner(){
    var codeBlock, data;
    var sleepTime = 0;
}

//option needs to be whatever option the user selects (cancer, aliens, etc)
Runner.prototype.go = function(option){
    this.getFunction(option);
    this.execute();
}

Runner.prototype.getData = function(){

}

Runner.prototype.execute = function(){

    var that = this;
    var runUnit = function(){
        this.data = this.getData();
        var before = new Date(); before = before.getTime();
        this.codeBlock.call(this.data);
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