$(document).ready(function(){

    $("#step1").fadeIn();
    const appBaseUrl = 'http://192.168.99.100/';

    function createUrl(userUrl){
        let jsonData = {userUrl:userUrl};
        let urlTarget = appBaseUrl+'backend/?p=handleUrl';
        ajaxDispatch(urlTarget, jsonData, completeOperation);
    }

    function ajaxDispatch(urlTarget, jsonData, refFunction=""){
        $.ajax({
            method: "POST",
            url : urlTarget,
            data: jsonData
        })
            .done(function(feedback) {
                //console.log("Mission accomplished!");
                let jsonReturn = JSON.parse(feedback);
                console.log(jsonReturn);
                if(refFunction!==""){
                    refFunction(jsonReturn);
                }else{
                    //console.log("Return data...");
                    return jsonReturn;
                }
            })
            .fail(function() {
                launchModal("Error!", "An error occurred. Please, contact the Webmaster.");
            })

            .always(function(){
                //console.log("Finish...");
            })
    }

    function fixNoHttp(str, target){
        let newStr = "";
        if(str.indexOf("http://")===-1 && str.indexOf("https://")===-1){
            newStr = "http://"+str;
            target.value=newStr;
        }
    }

    function completeOperation(obj){
        $("#loading").hide();
        $("#userUrl").val("");
        $("#step1").hide();
        $("#step2").fadeIn();
        $("#shrinkUrlField").val(obj.urlCode);
        //Refresh urls
        getShrinkedUrls();
        return false;
    }

    function copyToClip(){
        let copyText = document.getElementById("shrinkUrlField");
        copyText.select();
        document.execCommand("copy");
        let text = "In your clipboard: " + copyText.value;
        launchModal("Yay!", text);
    }

    function isValidUrl(str) {
        var regex = /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
        if(!regex .test(str)) {
            alert("Please enter valid URL.");
            return false;
        } else {
            return true;
        }
    }

    function launchModal(title, message){
        $("#modal-title").html(title);
        $("#modal-message").html(message);
        let options = {};
        $('#modal-feedback').modal(options);
    }

    function fillShrinkedUrls(data){
        let outputA = "";

        jQuery.each(data, function(i, val) {
            jsonItem = data[i];
            let code = jsonItem.shrink_code;
            outputA += `<div class="item"><i class="fa fa-check"></i> <a href="${appBaseUrl}r/${code}" title="Shrinked" target="_blank">shrmp.co/${code}</a></div>`;
        });

        $("#container-last-urls").html(outputA);
    }

    function fillTopViewUrls(data){
        let output = "";

        jQuery.each(data, function(i, val) {
            jsonItem = data[i];
            let code = jsonItem.shrink_code;
            let numViews = jsonItem.count;
            output += `<div class="item"><i class="fa fa-eye"></i> <span class="box-num-views">${numViews} views</span> <a href="${appBaseUrl}r/${code}" title="Shrinked" target="_blank">shrmp.co/${code}</a></div>`;
        });

        $("#container-top-view-urls").html(output);
    }

    function fillStats(data){
        console.log(data);
        let numViews = data.numViews;
        let numShrimps = data.numShrimps;

        let output = `
                <div class="item item-stats"><span>${numViews} Total</span> curious views</div>
                <div class="item item-stats"><span>${numShrimps} Total</span> urls shrinked</div>
         `;

        $("#container-stats").html(output);
    }

    function getShrinkedUrls(){
        ajaxDispatch(`${appBaseUrl}backend/?p=getUrls`, {}, fillShrinkedUrls);
    }

    function getTopViewUrls() {
        ajaxDispatch(`${appBaseUrl}backend/?p=getTopViews`, {}, fillTopViewUrls);
    }

    function getStats() {
        ajaxDispatch(`${appBaseUrl}backend/?p=getStats`, {}, fillStats);
    }

    /* EVENTS */
    //Init the process to get the urls
    getShrinkedUrls();
    getTopViewUrls();
    getStats();

    $("#copyUrl").click(function(e){ copyToClip(); });
    $("#userUrl").click(function(e){ this.value=""; });

    $("#userUrl").blur(function(e){
        let val = e.target.value;
        if(val!=="")
            fixNoHttp(val, e.target);
    });

    $("#trigger").click(function(e){
        e.preventDefault();
        let value = $("#userUrl").val().trim();

        //Is there a url?
        if(value !== ""){
            //Is the url valid?
            if(!isValidUrl(value) || value.indexOf(".")==-1 || value.length<13){
                // console.log("Invalid url");
                launchModal("Error!", "Please, type a valid url.");
                return false;
            }else{
                // console.log("Valid url: " + value);
                createUrl(value);
                $("#loading").show();
            }
        }else{
            launchModal("Error!", "Please, type your url in the form.");
            $("#userUrl").focus();
            return false;
        }
    });

});