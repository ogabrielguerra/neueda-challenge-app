const appBaseUrl = 'http://localhost/';
class Shrimp{
    constructor(){
        $("#step1").fadeIn();
        this.getShrinkedUrls();
        this.getTopViewUrls();
        this.getStats();
    }

    mockTest(){
        return 1;
    }
    ajaxDispatch(urlTarget, jsonData, refFunction="", scope=""){
        $.ajax({
            method: "POST",
            url : urlTarget,
            data: jsonData
        })
            .done(function(feedback) {
                //console.log("Mission accomplished!");
                let jsonReturn = JSON.parse(feedback);
                //console.log(jsonReturn);
                if(refFunction!==""){
                    refFunction(jsonReturn, scope);
                }else{
                    //console.log("Return data...");
                    return jsonReturn;
                }
            })
            .fail(function() {
                this.launchModal("Error!", "An error occurred. Please, contact the Webmaster.");
            })

            .always(function(){
                //console.log("Finish...");
            })
    }

    createUrl(userUrl){
        let jsonData = {userUrl:userUrl};
        let urlTarget = appBaseUrl+'backend/?p=handleUrl';
        let ref = this;
        this.ajaxDispatch(urlTarget, jsonData, this.completeOperation, ref);
    }

    fixNoHttp(str, target){
        let newStr = "";
        if(str.indexOf("http://")===-1 && str.indexOf("https://")===-1){
            newStr = "http://"+str;
            target.value=newStr;
        }
    }

    completeOperation(obj, scopeRef=""){
        $("#loading").hide();
        $("#userUrl").val("");
        $("#step1").hide();
        $("#step2").fadeIn();
        $("#shrinkUrlField").val(obj.urlCode);
        //Refresh urls
        scopeRef.getShrinkedUrls();
        return false;
    }

    copyToClip(){
        let copyText = document.getElementById("shrinkUrlField");
        copyText.select();
        document.execCommand("copy");
        let text = "In your clipboard: " + copyText.value;
        this.launchModal("Yay!", text);
    }

    isValidUrl(str) {
        var regex = /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
        if(!regex .test(str) || str.length<17) {
            this.launchModal("Error!", "Please, type a valid url.")
            return false;
        } else {
            return true;
        }
    }

    launchModal(title, message){
        $("#modal-title").html(title);
        $("#modal-message").html(message);
        let options = {};
        $('#modal-feedback').modal(options);
    }

    fillShrinkedUrls(data, scopeRef){
        let output = "";
        jQuery.each(data, function(i, val) {
            let jsonItem = data[i];
            let code = jsonItem.shrink_code;
            output += `<div class="item"><i class="fa fa-check"></i> <a href="${appBaseUrl}r/${code}" title="Shrinked" target="_blank">shrmp.co/${code}</a></div>`;
        });
        $("#container-last-urls").html(output);
    }

    fillTopViewUrls(data){
        let output = "";
        jQuery.each(data, function(i, val) {
            let jsonItem = data[i];
            let code = jsonItem.shrink_code;
            let numViews = jsonItem.count;
            output += `<div class="item"><i class="fa fa-eye"></i> <span class="box-num-views">${numViews} views</span> <a href="${appBaseUrl}r/${code}" title="Shrinked" target="_blank">shrmp.co/${code}</a></div>`;
        });
        $("#container-top-view-urls").html(output);
    }

    fillStats(data){
        let numViews = data.numViews;
        let numShrimps = data.numShrimps;
        let output = `<div class="item item-stats"><span>${numViews} Total</span> curious views</div><div class="item item-stats"><span>${numShrimps} Total</span> urls shrinked</div>`;
        $("#container-stats").html(output);
    }

    getShrinkedUrls(){
        this.ajaxDispatch(`${appBaseUrl}backend/?p=getUrls`, {}, this.fillShrinkedUrls);
    }

    getTopViewUrls() {
        this.ajaxDispatch(`${appBaseUrl}backend/?p=getTopViews`, {}, this.fillTopViewUrls);
    }

    getStats() {
        this.ajaxDispatch(`${appBaseUrl}backend/?p=getStats`, {}, this.fillStats);
    }
}

$(document).ready(function(){
    let shrimp = new Shrimp();

    /* EVENTS */
    $("#copyUrl").click(function(e){ shrimp.copyToClip(); });
    $("#userUrl").click(function(e){
        e.target.value="";
    });

    $("#userUrl").blur(function(e){
        let val = e.target.value;
        if(val!=="")
            shrimp.fixNoHttp(val, e.target);
    });

    $("#trigger").click(function(e){
        e.preventDefault();
        let value = $("#userUrl").val().trim();

        //Is there a url?
        if(value !== ""){
            //Is the url valid?
            if(!shrimp.isValidUrl(value) || value.indexOf(".")==-1 || value.length<13){
                shrimp.launchModal("Error!", "Please, type a valid url.");
                return false;
            }else{
                shrimp.createUrl(value);
                $("#loading").show();
            }
        }else{
            shrimp.launchModal("Error!", "Please, type your url in the form.");
            $("#userUrl").focus();
            return false;
        }
    });

});