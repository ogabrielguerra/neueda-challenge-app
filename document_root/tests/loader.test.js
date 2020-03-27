require('jquery');

const appBaseUrl = 'http://localhost/';
class Shrimp{
    constructor(){
    }

    fixNoHttp(str){
        let newStr = "";
        if(str.indexOf("http://")===-1 && str.indexOf("https://")===-1){
            newStr = "http://"+str;
            return newStr;
        }
    }

    replaceText(str, target){
        target.value=this.fixNoHttp(str);
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
            //this.launchModal("Error!", "Please, type a valid url.")
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


}

let obj = new Shrimp();

const isJson = (str)=> {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

test('Fix http', () => {
    expect(obj.fixNoHttp("")).toMatch(/http:\/\//);
    expect(obj.fixNoHttp("aaaa")).toMatch(/http:\/\//);
    expect(obj.fixNoHttp("http")).toMatch(/http:\/\//);
    expect(obj.fixNoHttp("http:")).toMatch(/http:\/\//);
    expect(obj.fixNoHttp("http:/www.asd.com")).toMatch(/http:\/\//);
});

test('Valid/Invalid Url', () => {
    expect(obj.isValidUrl("")).toBe(false);
    expect(obj.isValidUrl("www.aaa")).toBe(false);
    expect(obj.isValidUrl("www.aaa.com")).toBe(false);
    expect(obj.isValidUrl("http://www.a.com")).toBe(false);
    expect(obj.isValidUrl("http://www.aaa.com")).toBe(true);

});