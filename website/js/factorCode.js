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